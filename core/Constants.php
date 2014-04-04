<?php
/**
 *
 * @category   Core
 * @package    FrameworkMVC
 * @author     Yeison Molina <yam.music@hotmail.com>
 * @copyright  2014 Code Yam's
 * @version    0.1.001
 * @link       http://github.com/yammusic
 * 
 */


    // {{{ Constants File

    /**
     * Constants defined for the operation of the framework
     */
    
    defined( 'PS' ) || define( 'PS', DIRECTORY_SEPARATOR );
    defined( 'PATH' ) || define( 'PATH', realpath( '.' . PS ) );
    defined( 'APP_PATH' ) || define( 'APP_PATH', PATH . 'app' . PS );
    defined( 'ASSETS_PATH' ) || define( 'ASSETS_PATH', APP_PATH . 'assets' . PS );
    defined( 'STYLESHEETS_PATH' ) || define( 'STYLESHEETS_PATH', ASSETS_PATH . 'stylesheets' . PS );
    defined( 'JAVASCRIPTS_PATH' ) || define( 'JAVASCRIPTS_PATH', ASSETS_PATH . 'javascripts' . PS );
    defined( 'CONTROLLERS_PATH' ) || define( 'CONTROLLERS_PATH', APP_PATH . 'controllers' . PS );
    defined( 'MODELS_PATH' ) || define( 'MODELS_PATH', APP_PATH . 'models' . PS );
    defined( 'VIEWS_PATH' ) || define( 'VIEWS_PATH', APP_PATH . 'views' . PS );
    defined( 'CORE_PATH' ) || define( 'CORE_PATH', PATH . 'core' . PS );

    defined( 'CHARSET' ) || define( 'CHARSET', 'utf-8' );
    defined( 'LANG' ) || define( 'LANG', 'en_EN' );