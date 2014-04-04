<?php

    /**
    *
    */
    class Bootstrap {
        
        public function __construct() {
            
        }

        static public function init() {
            self::loadModels();
            self::loadController();
        }

        static public function loadModels( $modelsPath = MODELS_PATH ) {
            include_once( $modelsPath . 'Database.class.php' );
            $modelsFiles = scandir( $modelsPath );

            foreach ( $modelsFiles as $model ) {
                if ( $model == '.' || $model == '..'|| $model == 'Database.class.php' ) {
                    continue;
                } if ( is_dir( $modelsPath . $model ) ) {
                    //self::loadModels( $modelsPath . $model . '/' );
                } else if ( is_readable( $modelsPath . $model ) ) {
                    include_once( $modelsPath . $model );
                }
            }
        }

        static public function loadController() {
            $controller = Controller;
            $action = Action;

            if ( !class_exists( 'Controller' ) ) include_once( CONTROLLERS_PATH . 'Controller.class.php' );

            if ( is_readable( CONTROLLERS_PATH . $controller . '.php' ) ) {
                include_once( CONTROLLERS_PATH . $controller . '.php' );
                $objController = ( class_exists( $controller ) ) ? new $controller : NULL;

                Controller::prepareItems( $objController, $action );
                View::render( $objController, $action );
            } else {
                die( 'The "' . $controller . '" Controller is missing' );
            }
        }
    }