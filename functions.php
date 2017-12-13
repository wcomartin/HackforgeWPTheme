<?php 

add_theme_support( 'post-thumbnails' ); 

require_once('wp-bootstrap-navwalker.php');
require_once(dirname(__FILE__) . '/event-calendar/hfevent.php');
require_once(dirname(__FILE__) . '/groups/hfgroups.php');
require_once(dirname(__FILE__) . '/people/hfpeople.php');
require_once(dirname(__FILE__) . '/members/hfmembers.php');

function hf_enqueue_scripts() {
    // Scripts
    wp_enqueue_script('jquery');
    wp_enqueue_script('tether', 'https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js', array('jquery'));
    wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js', array('tether'));
    wp_enqueue_script('font-awesome', 'https://use.fontawesome.com/7e4938e866.js');

    // Styles
    wp_enqueue_style( 'bootstrap', "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" );
    wp_enqueue_style( 'icomoon', get_template_directory_uri() . "/icomoon.css");
    wp_enqueue_style( 'style', get_template_directory_uri() . "/style.css");
}
add_action("wp_enqueue_scripts", "hf_enqueue_scripts");
