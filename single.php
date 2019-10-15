<?php
/**
 * Description: Single News template
 *
 * @package    WordPress
 * @subpackage EchBase
 */
get_header(); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<article class="single-page">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
          <h1><?php the_title(); ?></h1>
         <?php /* <header class="article-meta">
            Posted <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('F j, Y'); ?></time>
          </header> */ ?>

          <?php if ( has_post_thumbnail() ) { ?>
            <div class="image-wrapper">
              <?php the_post_thumbnail('large'); ?>
            </div>
          <?php } ?>

          <div class="post-content">
  			     <?php the_content(); ?>
          </div>

				  <div class="news-pagination clearfix">
						<div class="next-previous">
							<span class="nav-previous"><?php previous_post_link('%link','&laquo; %title', false, '25'); ?></span>
							<span class="nav-next"><?php next_post_link('%link','%title &raquo;', false, '25'); ?></span>
						</div>
			  	</div>

  			</div>
  	  </div>
    </div>
</article>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
