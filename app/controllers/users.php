<?php

    /**
    * 
    */
    class Users extends Controller {

        public function __construct() {
        }

        public function index( $params ) {
            $varsToRender = array(
                'Users' => User::all(),
                'other' => 'my other var'
            );
            $this->setVarstoRender( $varsToRender );
            // $this->setView( 'create' );
            // View::setLayout( 'test-layout' );
        }

        public function create( $params ) {
            // View::setLayout( 'test-layout' );
        }

        public function edit( $params ) {
            $id = ( isset( $params[ 'id' ] ) ) ? $params[ 'id' ] : '';
            $varsToRender = array(
                'User' => User::find( $id )
            );
            $this->setVarstoRender( $varsToRender );
        }

        public function editPassword( $params ) {
            $id = ( isset( $params[ 'id' ] ) ) ? $params[ 'id' ] : '';
            $varsToRender = array(
                'User' => User::find( $id )
            );
            $this->setVarstoRender( $varsToRender );
        }

        public function show( $params ) {
            $id = ( isset( $params[ 'id' ] ) ) ? $params[ 'id' ] : '';
            $varsToRender = array(
                'User' => User::find( $id )
            );
            $this->setVarstoRender( $varsToRender );
            View::setLayout( 'test-layout' );
        }

        public function update( $params ) {
            View::setLayout( false );
            $id = ( isset( $params[ 'id' ] ) ) ? $params[ 'id' ] : '';
            $subAction = ( isset( $params[ 'sub-action' ] ) ) ? $params[ 'sub-action' ] : '';
            extract( $params[ 'users' ] );

            if ( $subAction == 'edit' ) {
                $fieldsToAdd = array( 'username' => $username, 'email' => $email );
            } else if ( $subAction == 'edit-password' ) {
                $fieldsToAdd = array( 'password' => md5( $password ) );
            }

            if ( User::update( $id, $fieldsToAdd ) ) {
                $json = array( 'info' => 'success', 'msg' => 'User edited successfully' );
            } else {
                $json = array( 'info' => 'error', 'msg' => 'Error edited user' );
            }

            switch ( ( isset( $params[ 'format' ] ) ) ? $params[ 'format' ] : '' ) {
                case 'json':
                    echo json_encode( $json );
                    die();
                break;
                
                default:
                    $toEcho = '<script type="text/javascript">';
                    $toEcho .= 'alert( "'. $json[ 'msg' ] .'" );';
                    $toEcho .= '</script>';
                    echo $toEcho;
                    if ( $json[ 'info' ] == 'success' ) {
                        header( 'Location: ./' );
                    } else {
                        header( 'Location: ./?controller=users&action=edit&id=' . $id );
                    }
                break;
            }

        }

        public function delete( $params ) {
            View::setLayout( false );
            if ( User::destroy( $params[ 'id' ] ) ) {
                $json = array( 'info' => 'success', 'msg' => 'User deleted successfully' );
            } else {
                $json = array( 'info' => 'error', 'msg' => 'Error delete User' );
            }

            switch ( ( isset( $params[ 'format' ] ) ) ? $params[ 'format' ] : '' ) {
                case 'json':
                    echo json_encode( $json );
                    die();
                break;
                
                default:
                    $toEcho = '<script type="text/javascript">';
                    $toEcho .= 'alert( "'. $json[ 'msg' ] .'" );';
                    $toEcho .= '</script>';
                    echo $toEcho;
                    if ( $json[ 'info' ] == 'success' ) {
                        header( 'Location: ./' );
                    }
                break;
            }
        }

        public function adding( $params ) {
            View::setLayout( false );
            $fieldsToAdd = $params[ 'users' ];
            extract( $fieldsToAdd );
            $fieldsToAdd = array(
                'username' => $username,
                'password' => $password,
                'email' => $email
            ); 

            if( User::create( $fieldsToAdd ) ) {
                $json = array( 'info' => 'success', 'msg' => 'User added successfully' );
            } else {
                $json = array( 'info' => 'error', 'msg' => 'Error adding the user' );
            }

            switch ( ( isset( $params[ 'format' ] ) ) ? $params[ 'format' ] : '' ) {
                case 'json':
                    echo json_encode( $json );
                    die();
                break;
                
                default:
                    $toEcho = '<script type="text/javascript">';
                    $toEcho .= 'alert( "'. $json[ 'msg' ] .'" );';
                    $toEcho .= '</script>';
                    echo $toEcho;
                    if ( $json[ 'info' ] == 'success' ) {
                        header( 'Location: ./' );
                    } else {
                        header( 'Location: ./?controller=users&action=create' );
                    }
                break;
            }
        }

        public function check( $params ) {
            View::setLayout( false );
            $type = $params[ 'type' ];
            $q = $params[ 'q' ];
            switch ( $type ) {
                case 'username':
                    $user = User::find( $q, 'username' );
                    if ( is_null( $user ) ) {
                        $json = array( 'info' => 'success' );
                    } else if ( is_array( $user ) ) {
                        $json = array( 'info' => 'token', 'msg' => 'Username is already in use' );
                    } else if ( !$user ) {
                        $json = array( 'info' => 'error', 'msg' => 'Error checking username' );
                    }
                break;
                case 'email':
                    $user = User::find( $q, 'email' );
                    if ( is_null( $user ) ) {
                        $json = array( 'info' => 'success' );
                    } else if ( is_array( $user ) ) {
                        $json = array( 'info' => 'token', 'msg' => 'Email is already in use' );
                    } else if ( !$user ) {
                        $json = array( 'info' => 'error', 'msg' => 'Error checking email' );
                    }
                break;
            }

            switch ( ( isset( $params[ 'format' ] ) ) ? $params[ 'format' ] : '' ) {
                case 'json':
                    echo json_encode( $json );
                    die();
                break;
            }
        }
    }