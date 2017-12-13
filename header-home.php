<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <?php wp_head(); ?>
</head>
<body>

  <div class="row" style="margin: 0;">
    <div class="col-lg-3 col-xl-4" id="intro">
      <div class="row align-items-center" id="logo-slogan">
        <div class="col text-center">
          <div class="row align-items-center">
            <div class="col-4 col-lg-12">
              <img class="img-fluid" src="<?= get_template_directory_uri() ?>/images/hackforge_logo_white2.png" />
            </div>
            <div class="col-8 col-lg-12">
              <p class="lead" style="margin: 0">A Home for Windsor's Tech Community</p>
            </div>
          </div>
        </div>
      </div>

      <div id="newsletter">
        <ul class="nav justify-content-center">
          <li class="nav-item">
            <a class="nav-link" href="https://www.facebook.com/Hackforge/" title="Facebook" target="_blank">
              <span class="fa fa-2x fa-facebook"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://twitter.com/hackforge" title="Twitter" target="_blank">
              <span class="fa fa-2x fa-twitter"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://www.instagram.com/hackforge/" title="Instagram" target="_blank">
              <span class="fa fa-2x fa-instagram"></span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://discord.gg/qMp47yd" title="Chat on Discord" target="_blank">
              <span style="vertical-align: -28%;" class="fa-2x icon-Discord-Logo-Black"></span>
            </a>
          </li>
        </ul>
        <form action="//hackf.us3.list-manage.com/subscribe/post?u=036c9bbcb9b5b871608ab3b2a&amp;id=cf7d17ebdf" method="post" target="_blank" novalidate>
          <div class="input-group">
            <input type="email" name="EMAIL" class="form-control" placeholder="Signup for the Newsletter" />
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_036c9bbcb9b5b871608ab3b2a_cf7d17ebdf" tabindex="-1" value=""></div>
            <span class="input-group-btn">
              <button value="Subscribe" name="subscribe" class="btn btn-outline-info" type="submit"><span class="fa fa-send"></span></button>
            </span>
          </div>
        </form>
      </div>
    </div>
    <div class="col-lg-9 offset-lg-3 col-xl-8 offset-xl-4" id="content">
      <nav class="navbar navbar-toggleable-md navbar-light" style="background-color: none;">
        <button class="navbar-toggler navbar-toggler-right" type="button"
          data-toggle="collapse" data-target="#mainNav"
          aria-controls="mainNav" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand mb-0 hidden-lg-up">Windsor Hackforge</h1>
        <div class="collapse navbar-collapse" id="mainNav">
            <?php
                wp_nav_menu( array(
                'theme_location' => 'navbar',
                'menu_id' => 'top-menu',
                'container'      => false,
                'menu_class'     => 'mr-auto navbar-nav',
                'fallback_cb'    => '__return_false',
                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'          => 2,
                'walker'         => new bootstrap_4_walker_nav_menu()
                ) );
            ?>
          <!--<ul class="navbar-nav mr-auto">
            <li class="nav-item active"><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Events</a></li>
            <li class="nav-item"><a class="nav-link" href="#">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact Us</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Initiatives</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Membership</a></li>
          </ul>-->

          
        </div>
      </nav>
      <hr class="separator" />