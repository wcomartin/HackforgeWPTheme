<?php get_header('home');
if ( have_posts() ) : while ( have_posts() ) : the_post(); 

$organizers = get_field('organizer');
?>

<?php edit_post_link('edit', '<p class="pull-right">', '</p>'); ?>
<h1><?php the_title('<h3 class="display-4">', '</h3>'); ?></h1>
<hr />
<div class="row">
  <div class="col">
    <?php if($organizers) : ?>
    <h5 style="font-weight: lighter;">Organizer<?php if(count($organizers) > 1): echo "s"; endif; ?></h5>
    <ul class="list-unstyled mb-3">
      <?php foreach($organizers as $organizer) : ?>
        <li>
          <?= $organizer->post_title; ?>
          <?php $email = get_field('email', $organizer->ID);
          if($email) : ?>
             - <a href="<?= $email ?>"><?= $email ?></a>
          <?php endif; ?>
          <?php $website = get_field('website', $organizer->ID);
          if($website) : ?>
             - <a href="<?= $website ?>" target="_blank"><?= $website ?></a>
          <?php endif; ?>
        </li>
      <?php endforeach; ?>
    </ul>
    <hr />
    <?php  endif; ?>
    <?php the_content(); ?>
  </div>
  <div class="col-md-4">

    <div style="margin-bottom: 20px">
      <?php if(has_post_thumbnail()): ?>
      <img class="img-fluid" src="<?= the_post_thumbnail_url() ?>" />
      <?php else: ?>
      <img class="img-fluid" src="<?= get_template_directory_uri() ?>/images/hackforge_logo_black.png" />
      <?php endif; ?>
    </div>
    <hr />

  <?php $start_of_day = strtotime('yesterday midnight');
    $latest_event_args = array(
      'post_type' => 'hf_event',
      'orderby'   => 'meta_value_num',
      'meta_key'  => 'start_date_time',
      'order'     => 'ASC',
      'meta_query'  => array(
        'relation' => 'AND',
        array(
          'key'     => 'group',
          'value'   => get_the_ID(),
          'compare' => '=',
          'type'    => 'Numeric'
        ),
        array(
          'relation' => 'OR',
          array(
            'key'     => 'start_date_time',
            'value'   => $start_of_day,
            'compare' => '>=',
            'type'    => 'Numeric'
          ),
          array(
            'key'     => 'end_date_time',
            'value'   => $start_of_day,
            'compare' => '>=',
            'type'    => 'Numeric'
          )
        )
      )
    );
    $latest_event_query = new WP_Query( $latest_event_args );
    if ( $latest_event_query->have_posts() ) : ?>
    <h2 style="font-weight: lighter;">Events</h2>
    <?php while ( $latest_event_query->have_posts() ) : $latest_event_query->the_post(); 
      $start_date_time = get_field('start_date_time');
      if($start_date_time) $start_date = new DateTime($start_date_time);
      else $start_date = null;

      $end_date_time = get_field('end_date_time');
      if($end_date_time) $end_date = new DateTime($end_date_time);
      else $end_date = null; 
      ?>
      <div class="card" style="margin-bottom: 20px">
        <div class="card-block">
          <h6 class="card-title mb-2 h4"><?php the_title(); ?></h6>
          <p class="card-text mb-0"><?= $start_date->format('l, M j, Y') ?></p>
          <p class="card-text">
            <?= $start_date->format('g:i A') ?>
            <?php if($end_date) : echo " - " . $end_date->format('g:i A'); endif; ?>
          </p>
        </div>
        <div class="card-footer">
          <a href="<?php the_permalink() ?>" class="btn btn-primary btn-block">See Event</a>
        </div>
      </div>
    <?php endwhile; endif; ?>
  </div>
</div>

<hr class="separator" />

<?php endwhile; else : get_template_part( 'template-parts/post/content', 'none' ); endif; 
get_footer('home'); ?>