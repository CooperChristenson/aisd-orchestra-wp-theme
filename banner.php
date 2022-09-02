<header class="banner cover overlay background<?php if(is_admin_bar_showing()) { echo ' navbar-admin-space'; } ?>">
  <div class="inner">
    <p id="main-title"> <?php bloginfo( 'name' ); ?></p>
    <footer id="header">
      <div class="row">
        <div class="col-12 social">
          <?php my_social_media_icons(); ?>
        </div>
      </div>
    </footer>
  </div>
</header>