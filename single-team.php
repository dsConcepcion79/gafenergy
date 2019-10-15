<?php
/**
 * Description: Single Leadership Team template
 *
 * @package    WordPress
 * @subpackage EchBase
 */
get_header(); ?>

<?php
  if ( have_posts() ) : while ( have_posts() ) : the_post();
  $do_not_duplicate = $post->ID;
?>

  <section class="profile-banner" role="banner">
    <div class="banner-wrapper">
      <div class="row">
        <div class="col-sm-12 banner-inner">
          <div class="image-wrapper">
            <?php the_post_thumbnail('leadership-bio'); ?>
          </div>
        </div>
      </div>
     <div class="container">
      <div class="row">
        <div class="col-lg-7 caption">
          <h1><?php the_title(); ?></h1>
          <?php if (get_field('role')) { ?>
            <h2><?php the_field('role'); ?></h2>
          <?php } ?>
          <?php the_content(); ?>
        </div>
      </div>
    </div>
  </section>

  <section class="post-cards">
    <div class="container">
      <h2>Our Leadership</h2>
      <div class="row">
        <?php
        $args = array(
        'post_type' => 'team',
        'posts_per_page' => -1,
        'order' => 'asc'
        );
        $the_query = new WP_Query( $args );
        if( $the_query->have_posts() ):
          $postcount=0;
        while ( $the_query->have_posts() ) : $the_query->the_post();

          if( $post->ID == $do_not_duplicate ) continue;

          $postcount++;
          $postid = get_the_ID();
          $role = get_field('role',$postid);
      ?>
      <div class="col-sm-4">
        <article>
          <a href="<?php the_permalink(); ?>">
            <div class="image-wrapper">
              <?php the_post_thumbnail('post-card'); ?>
            </div>
            <h3><?php the_title(); ?></h3>
            <?php if ($role) { ?>
              <p><?php echo $role; ?></p>
            <?php } ?>
          </a>
        </article>
      </div>
      <?php

        endwhile;
        endif;

        wp_reset_postdata();
      ?>
      </div>
    </div>
  </section>

<?php endwhile; endif; ?>

<?php get_footer(); ?>
