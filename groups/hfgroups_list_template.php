<?php 
$args = array(
    'post_type' => 'hf_group',
    'orderby'   => 'title',
    'order'     => 'ASC',
    'posts_per_page' => -1,
);

$event_query = new WP_Query( $args );
if ( $event_query->have_posts() ) : 
while ( $event_query->have_posts() ) : $event_query->the_post(); 

$start_of_day = strtotime('yesterday midnight');
$latest_event_args = array(
  'post_type' => 'hf_event',
  'orderby'   => 'meta_value_num',
  'meta_key'  => 'start_date_time',
  'order'     => 'ASC',
  'posts_per_page' => 1,
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

?>
<div class="card" style="margin-bottom: 30px;">
  <div class="card-block">
    <div class="row">
      <div class="col-sm-2 align-self-center">
        <?php if(has_post_thumbnail()): ?>
        <img class="img-fluid" src="<?= the_post_thumbnail_url() ?>" />
        <?php else: ?>
        <img class="img-fluid" src="<?= get_template_directory_uri() ?>/images/hackforge_logo_black.png" />
        <?php endif; ?>
      </div>
      <div class="col-sm">
        <h4 class="card-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
        <!--<h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>-->
        <p class="card-text"><?php the_excerpt(); ?></p>
      </div>
      <div class="col-sm-4">
        <?php if ( $latest_event_query->have_posts() ) : while ( $latest_event_query->have_posts() ) : $latest_event_query->the_post(); 
          $start_date_time = get_field('start_date_time');
          if($start_date_time) $start_date = new DateTime($start_date_time);
          else $start_date = null;

          $end_date_time = get_field('end_date_time');
          if($end_date_time) $end_date = new DateTime($end_date_time);
          else $end_date = null; ?>
          <div style="padding-top: 9px; ">
            <h6 class="card-subtitle mb-2 text-muted">Next Event</h6>
            <p class="card-text">
              <?php the_title(); ?>
              <br />
              <small class="text-muted"><?= $start_date->format('l, M j, Y') ?></small>
              <br />
              <small class="text-muted">
                  <?= $start_date->format('g:i A') ?>
                  <?php if($end_date) : echo " - " . $end_date->format('g:i A'); endif; ?>
              </small>
            </p>
          </div>
        <?php endwhile; endif; ?>
      </div>
    </div>
    
  </div>
</div>
<?php endwhile; ?>

<?php else : get_template_part( 'template-parts/post/content', 'none' ); endif; ?>

