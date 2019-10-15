<?php
/*
 * Description: Default page template
 *
 * @package GAF Energy
 */
get_header(); ?>

	<?php
		if ( have_posts() ) : while ( have_posts() ) : the_post();

		$page_width = get_field('default_page_width');
	?>

		<?php if ($page_width == 'Contained') { ?>
			<div class="container container-narrow">
				<h1><?php the_title(); ?></h1>
		<?php } ?>

		<?php the_content(); ?>

		<?php if ($page_width == 'Contained') { ?>
			</div>
		<?php } ?>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>
