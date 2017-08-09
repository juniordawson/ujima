<header class="cf">

    <div class="tool-bar cf">
      <div class="wrapper cf">

       <a class="brand" href="<?= esc_url(home_url('/')); ?>"><h1 class="logo"><img src="/ujima/wp-content/themes/ujima-theme/dist/images/ujima-logo.png" alt="<?php bloginfo('name'); ?>" /></h1></a>
        

        <div class="tool-bar-nav">
          <div class="tool-bar-nav-links">
            <a href="" class="tool-bar-link tool-bar-link-icon"><span class="icon-radio-antenna icon-large"></span><span class="mb-hide">Listen live</span></a>
            <a href="" class="tool-bar-link tool-bar-link-icon"><span class="icon-radio icon-large"></span><span class="mb-hide">Listen again</span></a>
            <a href="" class="tool-bar-link  bdl-1">Advertise</a>
          </div>

          <?php get_template_part('templates/social-links'); ?>


        </div>
      </div>
    </div>


    <div class="wrapper main-nav cf">
      <div id="mobile-header">
        <a href="#sidr-main" id="simple-menu" class="icon-menu"></a>
      </div>
      <nav class="nav-primary" id="sidr">
        <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']);
        endif;
        ?>
      </nav>
    </div>

</header>