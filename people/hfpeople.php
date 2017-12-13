<?php

add_action( 'init', 'create_people_post_type' );
function create_people_post_type() {
  register_post_type( 'hf_people',
    array(
      'labels' => array(
        'name' => __( 'People' ),
        'singular_name' => __( 'Person' )
      ),
      'menu_position' => 5,
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'people'),
      'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
    )
  );

  if(function_exists("register_field_group"))
    {
        register_field_group(array (
            'id' => 'acf_people-custom-fields',
            'title' => 'People Custom Fields',
            'fields' => array (
                array (
                    'key' => 'field_people_email',
                    'label' => 'Email',
                    'name' => 'email',
                    'type' => 'text',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'none',
                    'maxlength' => '',
                ),
                array (
                    'key' => 'field_people_website',
                    'label' => 'Website',
                    'name' => 'website',
                    'type' => 'text',
                    'default_value' => '',
                    'placeholder' => '',
                    'prepend' => '',
                    'append' => '',
                    'formatting' => 'none',
                    'maxlength' => '',
                ),
            ),
            'location' => array (
                array (
                    array (
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'hf_people',
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