<?php

    /**
    * 
    */
    class Books extends Controller {

        public function __construct() {
        }

        public function index( $params ) {
            $varsToRender = array(
                'Books' => Book::all(),
                'welcome' => 'hi, i\'m index from Books controller'
            );
            $this->setVarstoRender( $varsToRender );
        }

        public function create( $params ) {

        }

        public function edit( $params ) {
            $varsToRender = array(
                'Book' => Book::find( $params[ 'id' ] )
            );
            $this->setVarstoRender( $varsToRender );
        }

        public function show( $params ) {
            $varsToRender = array(
                'Book' => Book::find( $params[ 'id' ] )
            );
            $this->setVarstoRender( $varsToRender );
        }

        public function update( $params ) {
            View::setLayout( false );
            extract( $params[ 'books' ] );
            $fieldsToAdd = array(
                'title' => $title,
                'author' => $author,
                'isbn' => $isbn
            );

            if ( Book::update( $params[ 'id' ], $fieldsToAdd ) ) {
                $response = array( 'info' => 'success', 'msg' => 'Book edited successfully', 'redirect' => './?controller=books' );
            } else {
                $response = array( 'info' => 'error', 'msg' => 'Error editing the Book', 'redirect' => './?controller=books&action=edit&id='. $params[ 'id' ] );
            }

            switch ( Config::getFormat() ) {
                default:
                    $toEcho = '<script type="text/javascript">';
                    $toEcho .= 'alert( "'. $response[ 'msg' ] .'" );';
                    $toEcho .= 'location.href = "'. $response[ 'redirect' ] .'";';
                    $toEcho .= '</script>';
                    echo $toEcho;
                break;
            }
        }

        public function delete( $params ) {
            View::setLayout( false );
            if ( Book::destroy( $params[ 'id' ] ) ) {
                $response = array( 'info' => 'success', 'msg' => 'Book deleted successfully', 'redirect' => './?controller=books' );
            } else {
                $response = array( 'info' => 'error', 'msg' => 'Error delete Book' );
            }

            switch ( Config::getFormat() ) {
                default:
                    $toEcho = '<script type="text/javascript">';
                    $toEcho .= 'alert( "'. $response[ 'msg' ] .'" );';
                    $toEcho .= ( isset( $response[ 'redirect' ] ) ) ? 'location.href = "'. $response[ 'redirect' ] .'"' : '' ;
                    $toEcho .= '</script>';
                    echo $toEcho;
                break;
            }
        }

        public function adding( $params ) {
            View::setLayout( false );
            extract( $params[ 'books' ] );
            $fieldsToAdd = array(
                'title' => $title,
                'author' => $author,
                'isbn' => $isbn
            ); 

            if ( Book::create( $fieldsToAdd ) ) {
                $response = array( 'info' => 'success', 'msg' => 'Book added successfully', 'redirect' => './?controller=books' );
            } else {
                $response = array( 'info' => 'error', 'msg' => 'Error adding the book', 'redirect' => './?controller=books&action=new' );
            }

            switch ( Config::getFormat() ) {
                default:
                    $toEcho = '<script type="text/javascript">';
                    $toEcho .= 'alert( "'. $response[ 'msg' ] .'" );';
                    $toEcho .= 'location.href = "'. $response[ 'redirect' ] .'";';
                    $toEcho .= '</script>';
                    echo $toEcho;
                break;
            }
        }
    }