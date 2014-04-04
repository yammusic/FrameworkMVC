$checkUserOrEmail = false;

jQuery( function( $ ) {

    var $formNewUser = $( "form#formNewUser" );
    var $formEditUser = $( "form#formEditUser" );
    var $formNewUserSubmit = $( "form#formNewUser input[ type='submit' ]" );
    var $formEditUserSubmit = $( "form#formEditUser input[ type='submit' ]" );
    var $inputUsername = $formNewUser.find( "input#username" );
    var $inputEmail = $formNewUser.find( "input#email" );
    var $inputPassword = $formNewUser.find( "input#password" );
    var $inputRePassword = $formNewUser.find( "input#re-password" );

    $( "span.tooltip-form" ).hide();

    $formNewUserSubmit.click( function( event ) {
        event.preventDefault();

        if ( $inputPassword.val() == $inputRePassword.val() ) {
            var $src = $formNewUser.serialize();

            if ( $checkUserOrEmail ) {
                $checkUserOrEmail = false;

                $.ajax( {
                    cache : false,
                    type : 'POST',
                    dataType : 'json',
                    data : $src,
                    url : '?controller=users&action=adding&format=json',
                    success : function( response ) {
                        if ( response.info == 'success' ) {
                            alert( response.msg );
                            window.location.href = "./";
                        } else if ( response.info == 'error' ) {
                            alert( response.msg );
                        }
                    }
                } );
            } else {
                return( false );
            }
        } else {
            $inputRePassword.parent().find( 'span.tooltip-form' ).html( 'Passwords are not the same').show( 'fast' );
        }
    });

    $inputRePassword.change( function() {
        if ( $inputPassword.val() != $inputRePassword.val() ) {
            $inputRePassword.parent().find( 'span.tooltip-form' ).html( 'Passwords are not the same').show( 'fast' );
        } else {
            $inputRePassword.parent().find( 'span.tooltip-form' ).hide( 'fast' );
        }
    });

    $formEditUser.find( 'input#re-password' ).change( function() {
        if ( $formEditUser.find( 'input#password' ).val() != $( this ).val() ) {
            $( this ).parent().find( 'span.tooltip-form' ).html( 'Passwords are not the same').show( 'fast' );
        } else {
            $( this ).parent().find( 'span.tooltip-form' ).hide( 'fast' );
            $checkUserOrEmail = true;
        }
    });

    $formEditUserSubmit.click( function( event ) {
        event.preventDefault();

        var $src = $formEditUser.serialize();

        if ( $checkUserOrEmail ) {
            $checkUserOrEmail = false;

            $.ajax( {
                cache : false,
                type : 'POST',
                dataType : 'json',
                data : $src,
                url : '?controller=users&action=update&format=json',
                success : function( response ) {
                    if ( response.info == 'success' ) {
                        alert( response.msg );
                        window.location.href = "./";
                    } else if ( response.info == 'error' ) {
                        alert( response.msg );
                    }
                }
            } );
        } else {
            return( false );
        }
    } );

} );

function checkUserOrEmail( that ) {
    var type = that.attr( 'id' );
    var q = that.val();

    $.ajax( {
        cache : false,
        type : 'POST',
        dataType : 'json',
        data : 'type='+ type +'&q='+ q,
        url : '?controller=users&action=check&format=json',
        success : function( response ) {
            if ( response.info == 'success' ) {
                $checkUserOrEmail = true;
                that.parent().find( 'span.tooltip-form' ).empty().hide( 'fast' );
            } else if ( response.info == 'token' ) {
                $checkUserOrEmail = true;
                that.parent().find( 'span.tooltip-form' ).empty().html( response.msg ).show( 'fast' );
            }
        }
    } );
}

function destroyUser( that ) {
    var r = confirm( "Are you sure to want delete this user?" );

    if ( r ) {
        var id = that.data( 'id' );

        $.ajax( {
            cache : false,
            type : 'POST',
            dataType : 'json',
            data : 'id='+ id,
            url : '?controller=users&action=delete&format=json',
            success : function( response ) {
                if ( response.info == 'success' ) {
                    alert( response.msg );
                    window.location.href = "./";
                } else if ( response.info == 'error' ) {
                    alert( response.msg );
                }
            }
        } );
    } else {
        return( false );
    }
}