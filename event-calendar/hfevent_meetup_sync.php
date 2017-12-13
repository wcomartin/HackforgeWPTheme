<?php
register_activation_hook(__FILE__, 'meetup_sync_activation');
function meetup_sync_activation() {
    if (! wp_next_scheduled ( 'meetup_sync_schedule' )) {
	wp_schedule_event(time(), 'hourly', 'meetup_sync_schedule');
    }
}

register_deactivation_hook(__FILE__, 'meetup_sync_deactivation');
function meetup_sync_deactivation() {
	wp_clear_scheduled_hook('meetup_sync_schedule');
}

add_action('meetup_sync_schedule', 'sync_meetup_events');
function sync_meetup_events() {
	session_start();
    include(dirname(__DIR__) . '/lib/meetup-php-sdk/meetup.php');

    $args = array( 
        'post_type' => 'hf_social_account',
        'meta_key' => 'api_type',
	    'meta_value' => 'meetup',
    );

    $myposts = get_posts( $args );
    
}