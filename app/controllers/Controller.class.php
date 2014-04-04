<?php
    interface iController {
        public function getVarstoRender();
        public function setVarstoRender( $varstoRender );
    }

    /**
    * 
    */
    abstract class Controller implements iController {
        private $varstoRender = array();
        private $actionAlternative = array(
            'new' => 'create',
            'modificar' => 'edit',
            'edit-password' => 'editPassword'
        );
        private $view;

        public function getAction( $action ) {
            foreach ( $this->actionAlternative as $key => $value ) {
                if ( $action == $key ) {
                    $action = $value;
                    break;
                }
            }
            
            return( $action );
        }

        public function setView( $view ) {
          $this->view = $view;
        }

        public function getView( $action ) {
            if ( empty( $this->view ) ) {
              return( $this->getAction( $action ) );
            }

            return( $this->view );
        }
        
        public function getVarstoRender() {
            return( $this->varstoRender );
        }

        public function setVarstoRender( $varstoRender ) {
            $this->varstoRender = $varstoRender;
        }

        public static function prepareItems( $objController, $action ) {
            if ( !empty( $objController ) ) {
                if ( !empty( $action ) && method_exists( $objController, $action ) ) {
                  $action = $objController->getAction( $action );
                  $objController->$action( Config::getParams() );
                } else {
                    die( '<h1>The "' . $action . '" Action is invalid</h1>' );
                }
            } else {
                die( 'Unable to load the "' . $controller . '" Controller' );
            }
        }
    }

?>