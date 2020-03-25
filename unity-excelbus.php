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