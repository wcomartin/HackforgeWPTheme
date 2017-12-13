<?php

add_action( 'init', 'create_group_post_type' );
function create_group_post_type() {
  register_post_type( 'hf_group',
    array(
      'labels' => array(
        'name' => __( 'Groups' ),
        'singular_name' => __( 'Group' )
      ),
      'menu_position' => 5,
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'groups'),
      'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields')
    )
  );

  if(function_exists("register_field_group"))
    {
        register_field_group(array (
            'id' => 'acf_group-custom-fields',
            'title' => 'Group Custom Fields',
            'fields' => array (
                array (
                    'key' => 'hf_group_organizer',
                    'label' => 'Organizer',
                    'name' => 'organizer',
                    'type' => 'post_object',
                    'post_type' => array (
                        0 => 'hf_people',
                    ),
                    'taxonomy' => array (
                        0 => 'all',
                    ),
                    'allow_null' => 1,
                    'multiple' => 1,
                ),
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'hf_group',
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

function shortcode_hfgroups_list() {
  ob_start();
  include(dirname(__FILE__) . "/hfgroups_list_template.php");
  return ob_get_clean();
}
add_shortcode('hfgroups_list', 'shortcode_hfgroups_list');

function hfgroups_single_template($template){
    if ('hf_group' == get_post_type(get_queried_object_id()) && !$template) {
        $template = dirname(__FILE__) . '/hfgroups_single_template.php';
    }
    return $template;
}
add_filter('single_template', 'hfgroups_single_template');

function hfgroups_archive_template($template){
    if ('hf_group' == get_post_type(get_queried_object_id()) && !$template) {
        $template = dirname(__FILE__) . '/hfgroups_archive_template.php';
    }
    return $template;
}
add_filter('archive_template', 'hfgroups_archive_template');


function hfgroups_query($query){
  if(is_post_type_archive( 'hf_group' )):
    $query->set( 'order', 'ASC' );
    $query->set( 'orderby', 'title' );
    $query->set( 'posts_per_page', -1);
  endif;    
};
add_action( 'pre_get_posts', 'hfgroups_query');