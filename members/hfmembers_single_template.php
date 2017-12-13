<?php get_header('home'); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<h1 class="display-4"><?php the_title(); ?></h1>

<div class="row">
    <div class="col-xl-8 col-md-6">

        <?php if(has_post_thumbnail()): ?>
            <img class="float-left img-thumbnail m-2" style="width: 150px" src="<?= the_post_thumbnail_url() ?>" />
        <?php else: ?>
            <img class="float-left img-thumbnail m-2" style="width: 150px" src="<?= get_template_directory_uri() ?>/images/hackforge_logo_black.png" />
        <?php endif; ?>

        <h4><?php 
        $skill_list = explode(",", get_field('skillz'));
        foreach($skill_list as $key => $skill): 
            $cleaned_skill = trim($skill);
            echo "<a class='badge badge-pill badge-primary m-1' href='/members/?skillz=$cleaned_skill&display=list'>$cleaned_skill</a>";
        endforeach;
        ?></h4>

        <div class='lead'><?php the_content(); ?></div>
    </div>
    <div class="col-xl-4 col-md-6">
        <ul class="list-group">
            <?php $facebook = get_field('facebook'); if($facebook){ ?>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-1">
                            <i class='fa fa-facebook'></i>
                        </div>
                        <div class="col">
                            <a target='_blank' href='https://facebook.com/<?php echo $facebook; ?>'><?php echo $facebook; ?></a>
                        </div>
                    </div>
                </li>
            <?php } ?>

            <?php $linkedin = get_field('linkedin'); if($linkedin){ ?>
                <li class="list-group-item">
                <div class="row">
                    <div class="col-1">
                        <i class='fa fa-linkedin'></i>
                    </div>
                    <div class="col">
                        <a target='_blank' href='https://linkedin.com/in/<?php echo $linkedin; ?>'><?php echo $linkedin; ?></a>
                    </div>
                </div>
            </li>
            <?php } ?>

            <?php $twitter = get_field('twitter'); if($twitter){ ?>
                <li class="list-group-item">
                <div class="row">
                    <div class="col-1">
                        <i class='fa fa-twitter'></i>
                    </div>
                    <div class="col">
                        <a target='_blank' href='https://twitter.com/<?php echo $twitter; ?>'><?php echo $twitter; ?></a>
                    </div>
                </div>
            </li>
            <?php } ?>

            <?php $github = get_field('github'); if($github){ ?>
                <li class="list-group-item">
                <div class="row">
                    <div class="col-1">
                        <i class='fa fa-github'></i>
                    </div>
                    <div class="col">
                        <a target='_blank' href='https://github.com/<?php echo $github; ?>'><?php echo $github; ?></a>
                    </div>
                </div>
            </li>
            <?php } ?>

            <?php $bitbucket = get_field('bitbucket'); if($bitbucket){ ?>
                <li class="list-group-item">
                <div class="row">
                    <div class="col-1">
                        <i class='fa fa-bitbucket'></i>
                    </div>
                    <div class="col">
                        <a target='_blank' href='https://bitbucket.com/<?php echo $bitbucket; ?>'><?php echo $bitbucket; ?></a>
                    </div>
                </div>
            </li>
            <?php } ?>

            <?php $website = get_field('website'); if($website){ ?>
                <li class="list-group-item">
                <div class="row">
                    <div class="col-1">
                        <i class='fa fa-link'></i>
                    </div>
                    <div class="col">
                        <a target='_blank' href='<?php echo $website; ?>'><?php echo $website; ?></a>
                    </div>
                </div>
            </li>
            <?php } ?>

            <?php $email = get_field('email'); if($email){ ?>
                <li class="list-group-item">
                <div class="row">
                    <div class="col-1">
                        <i class='fa fa-envelope-o'></i>
                    </div>
                    <div class="col">
                        <a target='_blank' href='mailto:<?php echo $email; ?>'><?php echo $email; ?></a>
                    </div>
                </div>
            </li>
            <?php } ?>
            
        </ul>
    </div>
</div>
<?php endwhile; else : get_template_part( 'template-parts/post/content', 'none' ); endif; get_footer('home'); ?>