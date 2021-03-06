<?php
/**
 * Description: News Archive template
 *
 * @package    WordPress
 * @subpackage GAF Energy
 */
get_header(); ?>


<?php
  $newscount = 0;
?>

<section class="intro">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-9 col-lg-8 col-xl-6 xs-h30 v45-30 caption antialiased">
        <h1><?php single_post_title(); ?></h1>
      </div>
    </div>
  </div>
</section>

<section class="articles posts-list">
    <div class="container">
      <div class="row">

         <?php if ( have_posts() ) :
          while ( have_posts() ) : the_post();
          $newscount++;
         ?>
           <div class="col-sm-6">
             <article>
              <?php /* <header class="article-meta">
                 Posted <time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('F j, Y'); ?></time>
               </header> */ ?>
               <h3>
                 <a href="<?php the_permalink(); ?>">
                   <?php the_title(); ?>
                 </a>
               </h3>
               <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
             </article>
           </div>
           <?php if ($newscount %2 == 0) { echo '</div><div class="row">'; } ?>
          <?php endwhile; ?>
            <div class="col-sm-12">
              <div class="news-navigation">
					       <?php articles_paginate($query); ?>
				      </div>
            </div>

          <?php else : ?>
            <h2>Coming Soon</h2>
          <?php endif; ?>

        </div>
      </div>
    </section>

<?php get_footer(); ?>
