<?php 
get_header('home');
if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
        <?php 
        $group_post = get_field('group'); 

        $start_date_time = get_field('start_date_time');
        if($start_date_time) {
            try {
                $start_date = new DateTime("@" . $start_date_time);
            } catch (Exception $e) {
                $start_date = new DateTime($start_date_time);
            }
        }
        $end_date_time = get_field('end_date_time');
        if($end_date_time) {
            try {
                $end_date = new DateTime("@" . $end_date_time);
            } catch (Exception $e) {
                $end_date = new DateTime($end_date_time);
            }
        }

        $admission_cost = get_field('admission_cost');

        $facebook_link = get_field('facebook');
        $meetup_link = get_field('meetup');
        $eventbrite_link = get_field('eventbrite');
        ?>
        <div class="row">
        
        <div class="col-md-4"><?php the_post_thumbnail(); ?></div>
        <div class="col-md-8">
        <?php edit_post_link('edit', '<p class="pull-right">', '</p>'); ?>
        <h2><?php the_title(); ?></h2>
        <p>Hosted By: <?php if($group_post) : ?>
            <a href='<?= $group_post->guid ?>'><?= $group_post->post_title ?></a>
        <?php endif; ?></p>

        <hr />

        <div class="row align-items-center">
            <div class="col-1">
                <p class="text-center text-muted"><span class="fa fa-clock-o fa-2x"></span></p>
            </div>
            <div class="col">
                <p class="lead" style="margin-bottom: 0;"><?= $start_date->format('l, M j, Y') ?>
                <p class="lead"><small class="text-muted">
                    <?= $start_date->format('g:i A') ?>
                    <?php if($end_date) : echo " - " . $end_date->format('g:i A'); endif; ?>
                </small></p>
            </div>
            <?php if($admission_cost): ?>
            <div class="col">
                <p class="lead text-right">$<?= money_format('%i', $admission_cost) ?></p>
            </div>
            <?php endif; ?>
        </div>

        <?php 
            $links = array();
            if($facebook_link){
                $links[] = array(
                    'name' => "Facebook",
                    'link' => $facebook_link
                );
            }

            if($meetup_link){
                $links[] = array(
                    'name' => "Meetup",
                    'link' => $meetup_link
                );
            }

            if($eventbrite_link){
                $links[] = array(
                    'name' => "Eventbrite",
                    'link' => $eventbrite_link
                );
            }
            ?>
        <p>
        <?php foreach($links as $key => $link){
            if($key > 0){
                echo " | ";
            }
            echo "<a href=" . $link['link'] . " target=\"_blank\">" . $link['name'] . "</a>";
        } ?>
        </p>

        <?php the_content(); ?>
        </div>

        <hr class="separator" />

    <?php endwhile;
else :
    get_template_part( 'template-parts/post/content', 'none' );
endif; 

get_footer('home'); ?>