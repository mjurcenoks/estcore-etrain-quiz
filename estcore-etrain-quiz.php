<?php
/*
* Plugin Name: Estcore ETrain Quiz
* Description: The plugin for WordPress quiz.
* Plugin URI: https://estcore.ru/
* Version: 1.0.0
* Author: Estcore LLC
* Author URI: https://estcore.ru/
* Support: https://estcore.ru/
* License: GPL-2.0+
* License URI: http://www.gnu.org/licenses/gpl-2.0.txt
* Text Domain: estcore-eq
* Domain Path: /languages/
*/

namespace Estcore;

if ( !defined( 'ABSPATH' ) ) exit();
if ( !defined( 'ESTCORE_EQ_URL' ) ) {  define( 'ESTCORE_EQ_URL' , plugin_dir_url( __FILE__ ) ); }
if ( !defined('ESTCORE_EQ_DIR') ) { define( 'ESTCORE_EQ_DIR' , plugin_dir_path( __FILE__ ) ); }

class Estcore_ETrain_Quiz {

    private Estcore_ETrain_Quiz_Questions_Bank $elements_provider;

    const VERSION = '1.0.0';

    public function __construct() {
        $elements_provider =   new Estcore_ETrain_Quiz_Questions_Bank();
    }

    public function init() {

        load_plugin_textdomain( 'estcore-eq', false, '/' . basename(dirname(__FILE__)) . '/languages/' );

        //etrain_quiz_common = new Estcore_ETrain_Quiz_Common();

        if ( is_admin() ) {



            /*add_action('admin_init', array('Estcore_ETrain_Quiz_Admin', 'eeq_general_settings'));
            add_action('admin_menu', array('Estcore_ETrain_Quiz_Admin', 'eeq_menu_page'));
            add_action('restrict_manage_posts', array('Estcore_ETrain_Quiz_Register_Quiz', 'eeq_set_quiz_filter') );
            add_filter('parse_query', array('Estcore_ETrain_Quiz_Register_Quiz', 'eeq_filter_quiz_by') );
            add_filter('manage_eeq-etrain-quiz_posts_columns', array('Estcore_ETrain_Quiz_Register_Quiz', 'eeq_quiz_column'), 10, 1);
            add_filter('manage_eeq-etrain-quiz_posts_custom_column', array('Estcore_ETrain_Quiz_Register_Quiz', 'eeq_quiz_column_data'), 10, 2);
            add_filter('manage_quiz-submission_posts_columns', array('Estcore_ETrain_Quiz_Register_Quiz', 'eeq_submit_quiz_column'), 10, 1);
            add_action('add_meta_boxes', array('Estcore_ETrain_Quiz_Register_Quiz', 'eeq_quiz_meta_box'));
            add_action('save_post_eeq-etrain-quiz', array('Estcore_ETrain_Quiz_Register_Quiz', 'eeq_save_quiz'), 10, 1);
            add_filter('manage_quiz-submission_posts_custom_column', array('Estcore_ETrain_Quiz_Register_Quiz', 'eeq_submit_quiz_column_data'), 10, 2);
            add_action('save_post_quiz-submission', array('Estcore_ETrain_Quiz_Register_Quiz', 'eeq_save_submitted_quiz'), 10, 1);*/

        } else {
            //add_shortcode('eeq-etrain-quiz', array('Estcore_ETrain_Quiz_Shortcode', 'eeq_etrain_quiz'));
            //add_shortcode('eeq-submitted-quiz', array('Estcore_ETrain_Quiz_Shortcode', 'eeq_submitted_quiz'));
            //add_shortcode('eeq-my-account', array('Estcore_ETrain_Quiz_Shortcode', 'eeq_my_account'));
            //add_action('init', array('Estcore_ETrain_Quiz_Frontend', 'eeq_flush_rewrite_rules'));
        }
    }

    public static function activation() {

    }

    public static function deactivation() {

    }

    /** @noinspection PhpIncludeInspection */
    public static function autoload($class ) {

        $prefix = 'Estcore_ETrain_Quiz_';
        if ( stripos( $class, $prefix ) !== 0 ) { return; }
        $filename = $class . '.php';
        if ( false === strpos( $filename, '\\' ) ) {
            $filename = strtolower( str_replace( 'Estcore_ETrain_Quiz', 'eeq', $filename ) );
            $filename = strtolower( str_replace( '_', '-', $filename ) );
        } else {
            $filename  = str_replace( '\\', DIRECTORY_SEPARATOR, $filename );
        }
        $filepath = dirname( __FILE__ ) . '/includes/' . $filename;
        if ( file_exists( $filepath ) ) { require_once $filepath; }

    }

    public static function bootstrap() {

        spl_autoload_register( array( 'Estcore_ETrain_Quiz', 'autoload' ) );

        $plugin = new self();

        add_action( 'init', array( 'Estcore_ETrain_Quiz_Questions_Bank', 'eeq_reg_questions_tax' ) );

        // add_action( 'init', array( $plugin, 'init' ) );
        // add_action( 'init', array( 'Estcore_ETrain_Quiz_Register_Quiz', 'eeq_reg_quiz' ) );
        // Банк задач
        // add_action( 'wp_enqueue_scripts', array('Estcore_ETrain_Quiz_Enqueue','eeq_frontend_enqueue') );
        // add_action( 'admin_enqueue_scripts', array('Estcore_ETrain_Quiz_Enqueue','eeq_backend_enqueue') );

    }
}

Estcore_ETrain_Quiz::bootstrap();

register_activation_hook( __FILE__, array( 'Estcore_ETrain_Quiz', 'activation' ) );
register_deactivation_hook( __FILE__, array( 'Estcore_ETrain_Quiz', 'deactivation' ) );
