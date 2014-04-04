<?php
    defined( 'PATH' ) || define( 'PATH', realpath( './' ) );
    defined( 'APP_PATH' ) || define( 'APP_PATH', PATH . '/app/' );
    defined( 'ASSETS_PATH' ) || define( 'ASSETS_PATH', APP_PATH . 'assets/' );
    defined( 'STYLESHEETS_PATH' ) || define( 'STYLESHEETS_PATH', ASSETS_PATH . 'stylesheets/' );
    defined( 'JAVASCRIPTS_PATH' ) || define( 'JAVASCRIPTS_PATH', ASSETS_PATH . 'javascripts/' );
    defined( 'CONTROLLERS_PATH' ) || define( 'CONTROLLERS_PATH', APP_PATH . 'controllers/' );
    defined( 'MODELS_PATH' ) || define( 'MODELS_PATH', APP_PATH . 'models/' );
    defined( 'VIEWS_PATH' ) || define( 'VIEWS_PATH', APP_PATH . 'views/' );
    defined( 'CORE_PATH' ) || define( 'CORE_PATH', PATH . '/core/' );

    defined( 'CHARSET' ) || define( 'CHARSET', 'utf-8' );
    defined( 'LANG' ) || define( 'LANG', 'en' );

    /**
    * Config
    */
    class Config {
        private static $defaultController = 'users';
        private static $defaultAction = 'index';
        private static $params = array();
        private static $titleDocument = 'CRUD MVC Testing';
        private static $format;

        static public function setParams( $params ) {
            self::$params = $params;
        }

        static public function getParams() {
            return( $_REQUEST );
        }

        static public function getParam( $param, $default = null ) {
            return( ( isset( self::$params[ $param ] ) ) ? self::$params[ $param ] : $default );
        }

        static public function setFormat( $format ) {
            self::$format = $format;
        }

        static public function getFormat() {
            $params = self::getParams();
            $format = ( isset( $params[ 'format' ] ) ) ? $params[ 'format' ] : self::$format;
            return( $format );
        }

        static public function getDefaultController() {
            return( self::$defaultController );
        }

        static public function getDefaultAction() {
            return( self::$defaultAction );
        }

        static public function getController() {
            if ( !isset( $_GET[ 'controller' ] ) || empty( $_GET[ 'controller' ] ) || is_null( $_GET[ 'controller' ] ) ) return( self::getDefaultController() );
            return( $_GET[ 'controller' ] );
        }

        static public function getAction() {
            if ( !isset( $_GET[ 'action' ] ) || empty( $_GET[ 'action' ] ) || is_null( $_GET[ 'action' ] ) ) return( self::getDefaultAction() );
            return( $_GET[ 'action' ] );
        }

        static public function loadCore( $corePath = CORE_PATH ) {
            $coreFiles = scandir( $corePath );
            foreach ( $coreFiles as $value ) {
                if ( $value == '.' || $value == '..' || $value == 'Config.php' ) {
                    continue;
                } else if ( is_dir( $corePath . $value ) ) {
                    self::loadCore( $corePath . $value . '/' );
                } else if ( is_readable( $corePath . $value ) ) {
                    include_once( $corePath . $value );
                } else die( 'Fail to load file: ' . $corePath . $value );
            }
        }

        static public function isAjax() {
            if ( isset( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) && strtolower( $_SERVER[ 'HTTP_X_REQUESTED_WITH' ] ) == 'xmlhttprequest' ) {
                return( true );
            } else {
                return( false );
            }
        }

        static public function getTitleDocument() {
            return( self::$titleDocument );
        }

        static public function setTitleDocument( $title ) {
            self::$titleDocument = $title;
        }
    }
    
    defined( 'Controller' ) || define( 'Controller', Config::getController() );
    defined( 'Action' ) || define( 'Action', Config::getAction() );
