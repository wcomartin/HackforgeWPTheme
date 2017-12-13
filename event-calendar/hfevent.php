<?php

add_action( 'init', 'create_event_post_type' );
function create_event_post_type() {
  register_post_type( 'hf_event',
    array(
      'labels' => array(
        'name' => __( 'Events' ),
        'singular_name' => __( 'Event' )
      ),
      'menu_position' => 5,
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'events'),
      'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields')
    )
  );

  if(function_exists("register_field_group"))
    {
        register_field_group(array (
            'id' => 'acf_event-custom-fields',
            'title' => 'Event Info',
            'fields' => array (
                array (
                    'key' => 'field_59146b52cb0e5',
                    'label' => 'Start Date Time',
                    'name' => 'start_date_time',
                    'type' => 'date_time_picker',
                    'required' => 1,
                    'show_date' => 'true',
                    'date_format' => 'm/d/y',
                    'time_format' => 'h:mm tt',
                    'show_week_number' => 'false',
                    'picker' => 'select',
                    'save_as_timestamp' => 'true',
                    'get_as_timestamp' => 'false',
                ),
                array (
                    'key' => 'field_59146b84cb0e6',
                    'label' => 'End Date Time',
                    'name' => 'end_date_time',
                    'type' => 'date_time_picker',
                    'show_date' => 'true',
                    'date_format' => 'm/d/y',
                    'time_format' => 'h:mm tt',
                    'show_week_number' => 'false',
                    'picker' => 'select',
                    'save_as_timestamp' => 'true',
                    'get_as_timestamp' => 'false',
                ),
                array (
                    'key' => 'field_59146d28c029e',
                    'label' => 'Group',
                    'name' => 'group',
                    'type' => 'post_object',
                    'post_type' => array (
                        0 => 'hf_group',
                    ),
                    'taxonomy' => array (
                        0 => 'all',
                    ),
                    'allow_null' => 1,
                    'multiple' => 0,
                ),
                array (
                    'key' => 'hf_event_template',
                    'label' => 'Template',
                    'name' => 'template',
                    'type' => 'select',
                    'required' => 1,
                    'choices' => array (
                        'top_image' => 'Top Image',
                        'left_image' => 'Left Image',
                    ),
                    'default_value' => 'top_image',
                    'allow_null' => 0,
                    'multiple' => 0,
                ),
                array (
                    'key' => 'field_59146b96cb0e7',
                    'label' => 'Admission Cost',
                    'name' => 'admission_cost',
                    'type' => 'number',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'min' => '',
                    'max' => '',
                    'step' => 1,
                ),
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'hf_event',
                        'order_no' => 0,
                        'group_no' => 0,
                    ),
                ),
            ),
            'options' => array (
                'position' => 'normal',
                'layout' => 'default',
                'hide_on_screen' => array (
                    0 => 'custom_fields',
                ),
            ),
            'menu_order' => 0,
        ));

        register_field_group(array (
            'id' => 'acf_event-social-fields',
            'title' => 'Event Social',
            'fields' => array (
                array (
                    'key' => 'field_59146bbdcb0e8',
                    'label' => 'Meetup',
                    'name' => 'meetup',
                    'type' => 'text',
                    'default_value' => '',
                    'placeholder' => 'https://www.meetup.com/hackforge-windsor/events/',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'none',
                    'maxlength' => '',
                ),
                array (
                    'key' => 'field_meetup_sync',
                    'label' => 'Meetup Sync',
                    'name' => 'meetup_sync',
                    'type' => 'post_object',
                    'post_type' => array (
                        0 => 'hf_social_account',
                    ),
                    'taxonomy' => array (
                        0 => 'all',
                    ),
                    'allow_null' => 1,
                    'multiple' => 0,
                ),
                array (
                    'key' => 'field_59146befcb0e9',
                    'label' => 'Facebook',
                    'name' => 'facebook',
                    'type' => 'text',
                    'default_value' => '',
                    'placeholder' => 'http://facebook.com/event/...',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'none',
                    'maxlength' => '',
                ),
                array (
                    'key' => 'hf_event_eventbrite',
                    'label' => 'Eventbrite',
                    'name' => 'eventbrite',
                    'type' => 'text',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'none',
                    'maxlength' => '',
                ),
                array (
                    'key' => 'hf_event_facebook_id',
                    'label' => 'Facebook ID **DONT TOUCH**',
                    'name' => 'facebook_id',
                    'type' => 'text'
                ),
                array (
                    'key' => 'hf_event_meetup_id',
                    'label' => 'Meetup ID **DONT TOUCH**',
                    'name' => 'meetup_id',
                    'type' => 'text'
                ),
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'hf_event',
                        'order_no' => 0,
                        'group_no' => 0,
                    ),
                ),
            ),
            'options' => array (
                'position' => 'normal',
                'layout' => 'default',
                'hide_on_screen' => array (
                    0 => 'custom_fields',
                ),
            ),
            'menu_order' => 0,
        ));

        
    }
}

add_action( 'init', 'create_social_account_post_type' );
function create_social_account_post_type() {
  register_post_type( 'hf_social_account',
    array(
      'labels' => array(
        'name' => __( 'Social Accounts' ),
        'singular_name' => __( 'Social Account' )
      ),
      'menu_position' => 70,
      'public' => true,
      'supports' => array('title', 'custom-fields')
    )
  );
  if(function_exists("register_field_group")) {
        register_field_group(array (
            'id' => 'acf_social_account-custom-fields',
            'title' => 'Social Account Custom Fields',
            'fields' => array (
                array (
                    'key' => 'field_api_url',
                    'label' => 'API URL',
                    'name' => 'api_url',
                    'type' => 'text',
                    'required' => 1,
                    'formatting' => 'none'
                ),
                array (
                    'key' => 'field_api_group_page',
                    'label' => 'Group Page',
                    'name' => 'api_group_page',
                    'type' => 'text',
                    'formatting' => 'none'
                ),
                array (
                    'key' => 'field_api_token',
                    'label' => 'Token',
                    'name' => 'api_token',
                    'type' => 'text',
                    'formatting' => 'none'
                ),
                array (
                    'key' => 'field_api_app_id',
                    'label' => 'App ID',
                    'name' => 'api_app_id',
                    'type' => 'text',
                    'formatting' => 'none'
                ),
                array (
                    'key' => 'field_api_app_secret',
                    'label' => 'App Secret',
                    'name' => 'api_app_secret',
                    'type' => 'text',
                    'formatting' => 'none'
                ),
                array (
                    'key' => 'field_api_type',
                    'label' => 'Type',
                    'name' => 'api_type',
                    'type' => 'select',
                    'required' => 1,
                    'choices' => array (
                        'facebook' => 'Facebook',
                        'meetup' => 'Meetup',
                        'eventbrite' => 'Eventbrite',
                    ),
                    'allow_null' => 0,
                    'multiple' => 0,
                ),
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'hf_social_account',
                        'order_no' => 0,
                        'group_no' => 0,
                    ),
                ),
            ),
            'options' => array (
                'position' => 'normal',
                'layout' => 'default',
                'hide_on_screen' => array (
                    0 => 'custom_fields',
                ),
            ),
            'menu_order' => 0,
        ));
    }

}

add_shortcode('hfevent_list', 'shortcode_hfevent_list');
function shortcode_hfevent_list() {
  ob_start();
  include(dirname(__FILE__) . "/hfevent_list_template.php");
  return ob_get_clean();
}

add_shortcode('hfevent_calendar', 'shortcode_hfevent_calendar');
function shortcode_hfevent_calendar() {
  ob_start();
  include(dirname(__FILE__) . "/hfevent_calendar_template.php");
  return ob_get_clean();
}

add_filter('single_template', 'hfevent_single_template');
function hfevent_single_template($template){
    global $wp_query, $post;
    if($post->post_type == 'hf_event') {
        $template_type = get_field('template', $post->post_id);
        if ($template_type == null || $template_type == "top_image") {
            $template = dirname(__FILE__) . '/hfevent_single_template.php';
        }
        elseif($template_type == "left_image"){
            $template = dirname(__FILE__) . '/hfevent_single_template_2.php';
        }
    }
    return $template;
}

add_filter('archive_template', 'hfevent_archive_template');
function hfevent_archive_template($template){
    if ('hf_event' == get_post_type(get_queried_object_id()) && !$template) {
        $template = dirname(__FILE__) . '/hfevent_archive_template.php';
    }
    return $template;
}

add_action( 'pre_get_posts', 'hfevent_query'); 
function hfevent_query($query){
  if(is_post_type_archive( 'hf_event' )):
    $query->set( 'orderby', 'meta_value_num');
	$query->set( 'meta_key', 'start_date_time');
    $query->set( 'order', 'ASC');
    $query->set( 'posts_per_page', -1);
  endif;    
};

// Facebook/Meetup Event Sync
require_once('hfevent_facebook_sync.php');
require_once('hfevent_meetup_sync.php');