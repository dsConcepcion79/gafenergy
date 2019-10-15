<?php
/*
  Template Name: Sitemap
 * Description: Sitemap template
 *
 * @package    WordPress
 * @subpackage EchBase
 */
get_header(); ?>



    <div class="container container-narrow">

          <h1><?php the_title(); ?></h1>

          <?php the_content(); ?>

          <h2>Pages</h2>

          <ul>
            <?php
            // Add pages you'd like to exclude in the exclude here
            wp_list_pages(
              array(
                'exclude' => '',
                'title_li' => '',
              )
            );
            ?>
          </ul>

          <h2>News</h2>
          <?php
            $args = array(
            'posts_per_page' => -1,
            'post_type' => 'post'
            );
            $the_query = new WP_Query( $args );
            if( $the_query->have_posts() ):
           ?>
            <ul>
           <?php
            while ( $the_query->have_posts() ) : $the_query->the_post();
           ?>
              <li>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </li>
           <?php
            endwhile;
            ?>
            </ul>
            <?php
            endif;
            wp_reset_postdata();
           ?>

           <h2>Leadership Team</h2>
           <?php
             $args = array(
             'posts_per_page' => -1,
             'post_type' => 'team'
             );
             $the_query = new WP_Query( $args );
             if( $the_query->have_posts() ):
            ?>
             <ul>
            <?php
             while ( $the_query->have_posts() ) : $the_query->the_post();
            ?>
               <li>
                 <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
               </li>
            <?php
             endwhile;
             ?>
             </ul>
             <?php
             endif;
             wp_reset_postdata();
            ?>
    </div>

<?php get_footer(); ?>
