<?php get_header('home'); ?>

<style>
@media (min-width: 576px) {
    .card-columns {
        column-count: 2;
    }
}

@media (min-width: 768px) {
    .card-columns {
        column-count: 3;
    }
}

@media (min-width: 992px) {
    .card-columns {
        column-count: 4;
    }
}

@media (min-width: 1200px) {
    .card-columns {
        column-count: 5;
    }
}
</style>

<form action="<?php echo home_url('members'); ?>" method="GET">
  <div class="d-flex mb-3">
    <div class="w-100 mr-3">
      <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
        <input type="text" class="form-control" name="skillz" placeholder="Search Skillz" 
               value="<?php echo $_GET[ 'skillz' ] ?>" />
        <span class="input-group-btn">
          <button class="btn btn-primary" type="submit">Search!</button>
        </span>
      </div>
      <small class="form-text text-muted">Search skillz with a comma separated list.</small>
    </div>

    <div>
      <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-primary<?php if( empty($_GET['display']) || $_GET['display'] == 'list' ) { echo ' active'; } ?>">
          <input type="radio" name="display" value="list" autocomplete="off" 
                 <?php if( empty($_GET['display']) || $_GET['display'] == 'list' ) { echo 'checked'; } ?> 
                 onChange="this.form.submit()">
          <i class="fa fa-th-list" aria-hidden="true"></i>
        </label>
        <label class="btn btn-primary<?php if(!empty($_GET['display']) && $_GET['display'] == 'grid') { echo ' active'; } ?>">
          <input type="radio" name="display" value="grid" autocomplete="off" 
                 <?php if(!empty($_GET['display']) && $_GET['display'] == 'grid') { echo 'checked'; } ?> 
                 onChange="this.form.submit()">
          <i class="fa fa-th-large" aria-hidden="true"></i>
        </label>
      </div>
    </div>
  </div>
</form>

<?php 

if ( have_posts() ) : 
if ( empty($_GET['display']) || $_GET['display'] == 'list') : ?>
  <?php while ( have_posts() ) : the_post(); ?>
  <div class="card" style="margin-bottom: 30px;">
    <div class="card-block">
      <div class="row">

        <div class="col-sm-2 align-self-center">
          <?php if(has_post_thumbnail()): ?>
          <img class="img-fluid" style="width: 100%" src="<?= the_post_thumbnail_url() ?>" />
          <?php else: ?>
          <img class="img-fluid" style="width: 100%" src="<?= get_template_directory_uri() ?>/images/hackforge_logo_black.png" />
          <?php endif; ?>
        </div>
        
        <div class="col">
          <h4 class="card-title mt-2 mt-sm-0"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>

          <?php
            $skillzSearched = array ();
            $skillzNotSearched = array ();
            
            foreach(explode(",", get_field('skillz')) as $key => $skill): 
              $cleaned_skill = strtolower(trim($skill));
              $searchedSkillz = explode(",", $_GET['skillz']);
              $isSearched = false;
              
              foreach( $searchedSkillz as $key => $search ) {
                $cleaned_search = strtolower(trim($search));
                if ( !empty($cleaned_search) && strpos($cleaned_skill, $cleaned_search) !== false )
                  $isSearched = true;
              }

              if($isSearched) $skillzSearched[] = $skill;
              else $skillzNotSearched[] = $skill;
            endforeach;
            
            echo '<div>';
            foreach ($skillzSearched as $skill) {
              echo "<span class='badge badge-primary mr-1'>$skill</span>";
            }
            foreach ($skillzNotSearched as $skill) {
              echo "<span class='badge badge-default mr-1'>$skill</span>";
            }
            echo '</div>';
            ?>

          <p class="card-text"><?php the_excerpt(); ?></p>
        </div>

      </div>
      
    </div>
  </div>

  <?php endwhile; 
endif; 

if ( !empty($_GET['display']) && $_GET['display'] == 'grid') : ?>
  <div class="card-columns">
    <?php while ( have_posts() ) : the_post(); ?>
    <div class="card">
    <!-- <div class="card-header"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></div> -->
      <img class="card-img-top" style="width: 100%" src="<?php 
        if(has_post_thumbnail()){ 
          echo the_post_thumbnail_url(); 
        } else {
          echo get_template_directory_uri() . "/images/hackforge_logo_black.png";
        }
      ?>" />
      <div class="card-block">
      <h4 class="card-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
        <p class="card-text">
        <?php
        $skillzSearched = array ();
        $skillzNotSearched = array ();
        
        foreach(explode(",", get_field('skillz')) as $key => $skill): 
          $cleaned_skill = strtolower(trim($skill));
          $searchedSkillz = explode(",", $_GET['skillz']);
          $isSearched = false;
          
          foreach( $searchedSkillz as $key => $search ) {
            $cleaned_search = strtolower(trim($search));
            if ( !empty($cleaned_search) && strpos($cleaned_skill, $cleaned_search) !== false )
              $isSearched = true;
          }

          if($isSearched) $skillzSearched[] = $skill;
          else $skillzNotSearched[] = $skill;
        endforeach;

        foreach ($skillzSearched as $skill) {
          echo "<span class='badge badge-primary mr-1'>$skill</span>";
        }
        ?>
        </p>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
  <?php 
endif; 

else : get_template_part( 'template-parts/post/content', 'none' ); endif; get_footer('home'); ?>