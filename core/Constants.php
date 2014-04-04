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