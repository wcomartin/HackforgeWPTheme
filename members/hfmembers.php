<?php

$fe = fopen('php://stderr', 'w');
fwrite($fe, 'error message');

add_action( 'init', 'create_member_post_type' );
function create_member_post_type() {
  register_post_type( 'hf_member',
    array(
      'labels' => array(
        'name' => __( 'Members' ),
        'singular_name' => __( 'Member' )
      ),
      'menu_position' => 5,
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'members'),
      'supports' => array('title', 'editor', 'thumbnail', 'custom-fields')
    )
  );

  if(function_exists("register_field_group"))
  {
      register_field_group(array (
          'id' => 'acf_member-custom-fields',
          'title' => 'Member Custom Fields',
          'fields' => array (
              array (
                  'key' => 'hf_member_skillz',
                  'label' => 'Skillz',
                  'name' => 'skillz',
                  'type' => 'text',
                  'instructions' => 'comma separated list'
              ),
              array (
                'key' => 'hf_member_facebook',
                'label' => 'facebook',
                'name' => 'facebook',
                'type' => 'text'
            ),
            array (
                'key' => 'hf_member_linkedin',
                'label' => 'linkedin',
                'name' => 'linkedin',
                'type' => 'text'
            ),
            array (
                'key' => 'hf_member_twitter',
                'label' => 'twitter',
                'name' => 'twitter',
                'type' => 'text'
            ),
            array (
                'key' => 'hf_member_github',
                'label' => 'github',
                'name' => 'github',
                'type' => 'text'
            ),
            array (
                'key' => 'hf_member_bitbucket',
                'label' => 'bitbucket',
                'name' => 'bitbucket',
                'type' => 'text'
            ),
            array (
                'key' => 'hf_member_website',
                'label' => 'website',
                'name' => 'website',
                'type' => 'text'
            ),
            array (
                'key' => 'hf_member_email',
                'label' => 'email',
                'name' => 'email',
                'type' => 'text'
            ),
            array (
                'key' => 'hf_member_other1',
                'label' => 'other',
                'name' => 'other',
                'type' => 'text'
            ),
            array (
                'key' => 'hf_member_other2',
                'label' => 'other',
                'name' => 'other',
                'type' => 'text'
            ),
            array (
                'key' => 'hf_member_other3',
                'label' => 'other',
                'name' => 'other',
                'type' => 'text'
            ),
            array (
                'key' => 'hf_member_other4',
                'label' => 'other',
                'name' => 'other',
                'type' => 'text'
            ),
            array (
                'key' => 'hf_member_other5',
                'label' => 'other',
                'name' => 'other',
                'type' => 'text'
            ),
          ),
          'location' => array (
              array (
                  array (
                      'param' => 'post_type',
                      'operator' => '==',
                      'value' => 'hf_member',
                      'order_no' => 0,
                      'group_no' => 0,
                  ),
              ),
          ),
          'options' => array (
              'position' => 'acf_after_title',
              'layout' => 'default',
              'hide_on_screen' => array (
                  0 => 'custom_fields',
              ),
          ),
          'menu_order' => 0,
      ));
  }
}

add_filter('single_template', 'hfmembers_single_template');
function hfmembers_single_template($template){
    global $wp_query, $post;
    if($post->post_type == 'hf_member') {
        $template = dirname(__FILE__) . '/hfmembers_single_template.php';
    }
    return $template;
}

function hfmembers_archive_template($template){
    global $post;
    if ( is_post_type_archive ( 'hf_member' ) ) {
        $template = dirname(__FILE__) . '/hfmembers_archive_template.php';
    }
    return $template;
}
add_filter('archive_template', 'hfmembers_archive_template');

function hfmembers_query($query){
    if(is_post_type_archive( 'hf_member' )):
        $query->set( 'order', 'ASC' );
        $query->set( 'orderby', 'title' );
        $query->set( 'posts_per_page', -1);
    endif;    
};
add_action( 'pre_get_posts', 'hfmembers_query'); 

// action
add_action('pre_get_posts', 'hfmembers_pre_get_posts');

function hfmembers_pre_get_posts( $query ) {
	if( is_admin() ) return;
	
    if( !$query->is_main_query() ) return;
    
    $meta_query = $query->get('meta_query');
    
    if( !empty($_GET[ 'skillz' ]) ) {

        $values = explode(',', $_GET[ 'skillz' ]);

        $meta_query_skillz = array (
            'relation' => 'OR'
        );

        foreach( $values as $key => $value ) {
            $meta_query_skillz[] = array (
                'key'		=> 'skillz',
                'value'		=> $value,
                'compare'	=> 'LIKE',
            );
        }

        $meta_query[] = $meta_query_skillz;
    }
    $query->set('meta_query', $meta_query);
    return;
}