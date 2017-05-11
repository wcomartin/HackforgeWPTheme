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
              <img class="img-fluid" src="<?= get_template_directory_uri() ?>/images/hackforge_logo_white.png" />
            </div>
            <div class="col-8 col-lg-12">
              <p class="lead" style="margin: 0">A Home for Windsor's Tech Community</p>
            </div>
          </div>
        </div>
      </div>

      <div id="newsletter">
        <form>
          <div class="input-group">
            <input type="email" class="form-control" placeholder="Signup for the Newsletter" />
            <span class="input-group-btn">
              <button class="btn btn-outline-info" type="button"><span class="fa fa-send"></span></button>
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

          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="#" title="Facebook">
                <span class="fa fa-lg fa-facebook"></span>
                <span class="hidden-lg-up">Facebook</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" title="Twitter">
                <span class="fa fa-lg fa-twitter"></span>
                <span class="hidden-lg-up">Twitter</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" title="Instagram">
                <span class="fa fa-lg fa-instagram"></span>
                <span class="hidden-lg-up">Instagram</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" title="Chat on Discord">
                <span style="vertical-align: -28%;" class="fa-lg icon-Discord-Logo-Black"></span>
                <span class="hidden-lg-up">Discord</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <hr class="separator" />