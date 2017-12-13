<?php 
if($_GET['json']){
  $result = array();
  if ( have_posts() ) : while ( have_posts() ) : the_post(); 
    $start_date_time = get_field('start_date_time');
    if($start_date_time) $start_date = new DateTime($start_date_time);
    else $start_date = null;


    $end_date_time = get_field('end_date_time');
    if($end_date_time) $end_date = new DateTime($end_date_time);
    else $end_date = null;

    $group_post = get_field('group'); 
    if($group_post) $group = $group_post->post_title;
    else $group = "";

  $item_result = array(
    'title' => get_the_title(),
    'content' => get_the_content(),
    'excerpt' => get_the_excerpt(),
    'start_date_time' => $start_date->format("U"),
    'end_date_time' => $end_date ? $end_date->format("U") : "0",
    'admission_cost' => get_field('admission_cost'),
    'meetup_link' => get_field('meetup'),
    'facebook_link' => get_field('facebook'),
    'group' => $group
  );

  $result[] = $item_result;
  endwhile; endif;
  echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
  die;
}