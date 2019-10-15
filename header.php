<?php /* GAF Energy */ ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-5RPR5PB');</script>
    <!-- End Google Tag Manager -->
    <?php get_template_part('partials/favicons'); ?>
  </head>

  <body <?php body_class(); ?> <?php if (get_field('menu_over_banner')) { echo 'id="content-no-padding"'; } ?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5RPR5PB" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
      <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ech-base' ); ?></a>
      <header id="header">
    		<div class="container">
                <a href="<?php bloginfo('url'); ?>" class="brand-logo header-logo">
                  <?php get_template_part('img/inline-svg/inline', 'gaf-logo'); ?>
                </a>
      	        <button type="button" class="navbar-toggle collapsed">
    	            <span class="sr-only">Toggle Navigation</span>
    	            <span class="icon-bar"></span>
    	            <span class="icon-bar"></span>
    	            <span class="icon-bar"></span>
    	          </button>
        			  <nav class="main-menu">
                  <div class="nav-inner">
        		        <?php
        		          $args = array(
        		            'theme_location' => 'header',
        		            'menu' => 'Header Menu',
        		          );
        		          wp_nav_menu($args);
        		        ?>
                  </div>
        		   </nav>
    		</div>
      </header>
      <main class="content" id="content">
