<?php 
$paged = ( get_query_var( "paged" ) ) ? get_query_var( "paged" ) : 1;
$start_of_day = strtotime("yesterday midnight");

$args = array(
    "post_type" => "hf_event",
    "orderby"   => "meta_value_num",
	"meta_key"  => "start_date_time",
    "order"     => "ASC",
    "posts_per_page" => 6,
    "paged"          => $paged,
    "meta_query"  => array(
        "relation" => "OR",
        array(
            "key"     => "start_date_time",
            "value"   => $start_of_day,
            "compare" => ">=",
            "type"    => "Numeric"
        ),
        array(
            "key"     => "end_date_time",
            "value"   => $start_of_day,
            "compare" => ">=",
            "type"    => "Numeric"
        )
    )
);

$event_query = new WP_Query( $args );
if ( $event_query->have_posts() ) :
    echo "<div class=\"card-deck\" style=\"margin-bottom: 30px\">";
    $count = 0;
    while ( $event_query->have_posts() ) : $event_query->the_post(); 
        $start_date_time = get_field("start_date_time");
        if($start_date_time) $start_date = new DateTime($start_date_time);
        else $start_date = null;


        $end_date_time = get_field("end_date_time");
        if($end_date_time) $end_date = new DateTime($end_date_time);
        else $end_date = null;

        if($count % 2 == 0 && $count > 0) echo "</div><div class='card-deck' style='margin-bottom: 30px'>";
        $count++;
    ?>

    <div class="card">
        <?php if( has_post_thumbnail() ) { ?>
            <div class="card-img-top" style="height: 200px; background-image: url('<?= the_post_thumbnail_url() ?>'); background-position: center; background-size: cover;"></div>
        <?php } ?>
        <div class="card-block">
            <h4 class="card-title mb-0"><?php the_title() ?></h4>
            <?php 
            $group_post = get_field("group"); 
                if($group_post) :
                    echo "<p class=\"text-muted\"><small>Hosted By: " . $group_post->post_title . "</small></p>";
                endif;
            ?>
            <p class="mb-0"><?= $start_date->format("l, M j, Y") ?>
            <p><small class="text-muted">
                <?= $start_date->format("g:i A") ?>
                <?php if($end_date) : echo " - " . $end_date->format("g:i A"); endif; ?>
            </small></p>
            <p class="card-text"><?php the_excerpt() ?></p>
        </div>
        <div class="card-footer">
            <a href="<?php the_permalink() ?>" class="btn btn-primary btn-block">See Event</a>
        </div>
    </div>

    <?php 
    endwhile; 
    echo "</div>";
    ?>

    <div class="clearfix">
        <div class="pull-right"><?php next_posts_link(  "Next Page <span class='fa fa-arrow-right'></span>", $event_query->max_num_pages ); ?></div>
        <div><?php previous_posts_link("<span class='fa fa-arrow-left'></span> Previous Page"); ?></div>
    </div>

<?php else : get_template_part( "template-parts/post/content", "none" ); endif; ?>

