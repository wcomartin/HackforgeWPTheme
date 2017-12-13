<?php
// register_activation_hook(__FILE__, 'facebook_sync_activation');
// function facebook_sync_activation() {
//     if (! wp_next_scheduled ( 'facebook_sync_event' )) {
// 	    wp_schedule_event(time(), 'hourly', 'facebook_sync_event');
//     }
// }

// register_deactivation_hook(__FILE__, 'facebook_sync_deactivation');
// function facebook_sync_deactivation() {
// 	wp_clear_scheduled_hook('facebook_sync_event');
// }

add_action('admin_head-edit.php', 'addFacebookImportButton');
function addFacebookImportButton(){
    global $current_screen;
    if('hf_event' != $current_screen->post_type){ return; }
    ?>
        <script type="text/javascript">
        jQuery(document).ready(function($) {
            jQuery(jQuery('.wrap :first-child')[0]).next().after("<a  id='facebook-import' class='page-title-action'>Import</a>");
            jQuery('#facebook-import').click(function(e) { 
                console.log(e);
                jQuery.post("<?php echo esc_url( admin_url('admin-post.php') ); ?>", {
                    action: 'facebook_sync'
                })
            });
        })
        </script>
    <?php
}

add_action('admin_post_facebook_sync', 'sync_facebook_events');

// add_action('facebook_sync_event', 'sync_facebook_events');
function sync_facebook_events() {
    error_log('Sync Facebook Start');
	session_start();
    include(dirname(__DIR__) . '/lib/facebook-php-sdk/src/facebook.php');

    $args = array( 
        'post_type' => 'hf_social_account',
        'meta_key' => 'api_type',
	    'meta_value' => 'facebook',
    );

    $myposts = get_posts( $args );
    foreach ( $myposts as $post ) :
        $api_url =  get_field('api_url', $post->ID);
        $api_app_id =  get_field('api_app_id', $post->ID);
        $api_app_secret =  get_field('api_app_secret', $post->ID);
        $api_token =  get_field('api_token', $post->ID);
        $api_group_page =  get_field('api_group_page', $post->ID);

        $since_date = date('Y-m-d', strtotime('first day of this month'));
        $until_date = date('Y-m-d', strtotime('last day of next month'));
        
        // unix timestamp months
        $since_unix_timestamp = strtotime($since_date);
        $until_unix_timestamp = strtotime($until_date);

        $fields="id,name,description,place,timezone,start_time,end_time,cover";
        $params = array(
            "fields" => $fields,
            "access_token" => $api_token,
            "since" => $since_unix_timestamp,
            "until" => $until_unix_timestamp
        );
        $json_link = "https://graph.facebook.com/v2.7/{$api_group_page}/events/?" . http_build_query($params);
        
        $json = file_get_contents($json_link);
        $obj = json_decode($json, true, 512, JSON_BIGINT_AS_STRING);
        foreach($obj['data'] as $event) :
            $userTimezone = new DateTimeZone($event['timezone']);
            $gmtTimezone = new DateTimeZone('GMT');
            $myDateTime = new DateTime($event['start_time'], $gmtTimezone);
            $offset = $userTimezone->getOffset($myDateTime);
            $existing_events = get_posts( array( 
                'post_type' => 'hf_event',
                'post_status'    => 'any',
                'meta_key' => 'facebook_id',
                'meta_value' => $event['id'],
            ) );
            if(count($existing_events) == 0) :
                $post_id = wp_insert_post(array(
                    'post_type' => 'hf_event',
                    'post_title' => $event["name"],
                    'post_content' => $event['description'],
                    'comment_status' => 'closed',
                    'ping_status' => 'closed'
                ));
                if ($post_id) :
                    add_post_meta($post_id, 'facebook_id', $event['id']);
                    add_post_meta($post_id, 'start_date_time', strtotime($event['start_time']) + $offset);
                    add_post_meta($post_id, 'end_date_time', strtotime($event['end_time']) + $offset);
                    add_post_meta($post_id, 'facebook', "https://www.facebook.com/events/" . $event['id']);

                    require_once(ABSPATH . 'wp-admin/includes/media.php');
                    require_once(ABSPATH . 'wp-admin/includes/file.php');
                    require_once(ABSPATH . 'wp-admin/includes/image.php');
                    media_sideload_image($event['cover']['source'], $post_id);
                    $attachments = get_children($post_id);
                    foreach ( $attachments as $attachment_id => $attachment );
                    set_post_thumbnail($post_id, $attachment_id);
                endif;
            endif;
        endforeach;
    endforeach;
    error_log('Sync Facebook End');
}