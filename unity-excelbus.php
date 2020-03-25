<?php 
/**
 * Plugin name: UnityExcelbus
 * Plugin URI: https://github.com/joanezandrades/unity-excelbus
 * Description: Plugin que faz upload de arquivos excel e transforma os dados da planilha em publicações/atualizações
 * da tabela dos horários de ônibus.
 * Version: 0.1.0
 * Author: JA93
 * Author URI: http://unitycode.tech
 * Text domain: unex
 * License: GPL2
*/
if (!defined('ABSPATH')) :
    exit;
endif;

/**
 * Constants
 */
define('TEXT_DOMAIN', 'unity_excelbus');
define('PREFIX', 'unex');

/**
 * Load archives
 */
require_once(plugin_dir_path(__FILE__) . '/entities/PHPExcel.php');


/**
 * Class UnityExcelbus
 */
class UnityExcelbus {
    private static $instance;

    public static function start()
    {
        if (self::$instance == NULL) :
            self::$instance == new self();
        endif;

        return self::$instance;
    }

    /**
     * Construct class for hooks and enqueue scripts
     */
    private function __construct()
    {
        # Add plugin from menu panel
        add_action('admin_menu', array($this, 'create_menu_panel'));

        # Enqueue scripts
        add_action('admin_enqueue_scripts', array($this, 'register_and_enqueue_scripts'));
    }


    /**
     * Function register_and_enqueue_scripts
     * Register and enqueue scripts & styles
     */
    public function register_and_enqueue_scripts()
    {
        # Register dependencies js
        wp_register_script('jquery', plugins_url() . '/unity-excelbus/js/jquery-3.4.1.min.js', array(), false);
        wp_register_script('jquery-ui', plugins_url() . '/unity-excelbus/js/jquery-ui.min.js', array('jquery'), false);
        wp_register_script('rest-uploader', plugins_url() . '/unity-excelbus/js/upload-rest.js', array('jquery'), false);

        # Enqueue JS
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui');

        # Enqueue Upload js with rest api and nonce token
        $upload_vars = array(
            'endpoint'  => esc_url_raw(rest_url('/wp/v2/media/')),
            'nonce'     => wp_create_nonce('wp_rest')
        );
        wp_localize_script('rest-uploader', 'RestVars', $upload_vars);
    }


    /**
     * Function create_menu_panel
     */
    public function create_menu_panel()
    {
        # Settings
        $page_title = 'Unity Excelbus';
        $menu_title = 'Unity Excelbus';
        $menu_slug  = PREFIX;
        $icon_url   = '';
        $position   = 10;

        add_menu_page($page_title, $menu_title, 'administrator', $menu_slug, 'UnityExcelbus::page_home', $icon_url, $position);
    }



    /**
     * Function page_home plugin
     */
    public function page_home()
    {
        echo 'Olá';
    }

}

UnityExcelbus::start();