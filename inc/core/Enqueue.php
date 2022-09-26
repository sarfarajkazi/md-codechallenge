<?php

/**
 * @package LibraryBookSearch
 */

namespace INC_DIR\core;


class Enqueue
{
    public function register(){
        add_action( 'wp_enqueue_scripts', array( $this, 'lbs_front_enqueue' ) );
    }
    public function lbs_front_enqueue(){
        wp_enqueue_style( 'lbs_range_slider', LBS_PLUGIN_NAME_URL . 'assets/css/range-slider.css' );
        wp_enqueue_style( 'lbs_front_enqueue', LBS_PLUGIN_NAME_URL . 'assets/css/lbs-custom-css.css' );

        wp_enqueue_script('lbs_range_slider',LBS_PLUGIN_NAME_URL . 'assets/js/range-slider.js',array('jquery'),false,true);
        wp_enqueue_script('lbs_front_enqueue',LBS_PLUGIN_NAME_URL . 'assets/js/lbs-custom-js.js',array('jquery'),time(),true);
    }
}