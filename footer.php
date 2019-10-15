	</main><!-- content -->
	<footer class="bg-ltgrey">
		<div class="container">
			<div class="footer-brands">
				<div class="footer-brand justify-content-start">
					<a href="<?php bloginfo('url'); ?>" class="brand-logo">
						<?php get_template_part('img/inline-svg/inline', 'gaf-logo'); ?>
					</a>
					<div class="footer-contacts">
						<?php if (get_field('address', 'option')) { ?>
							<p>
								<?php the_field('address', 'option'); ?>
								<?php if (get_field('phone', 'option')) { ?>
									<br/>
									<a href="tel:<?php the_field('phone', 'option'); ?>" class="phone"><?php the_field('phone', 'option'); ?></a>
								<?php } ?>
							</p>
						<?php } ?>
						<?php if (get_field('email', 'option')) { ?>
							<p>
								<a href="mailto:<?php the_field('email', 'option'); ?>"><?php the_field('email', 'option'); ?></a>
							</p>
						<?php } ?>
						<div class="linkedin-follow">
							<script src="https://platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
							<script type="IN/FollowCompany" data-id="18957531" data-counter="none"></script>
						</div>
					</div>
				</div>
				<div class="footer-parent-brand">
					<a href="https://www.standardindustries.com/" class="parent-brand-logo">
						<?php /* get_template_part('img/inline-svg/inline', 'standard-logo'); */ ?>
						<img class="lazy" data-src="<?php bloginfo('template_directory'); ?>/img/Standard-logo.png" src="<?php bloginfo('template_directory'); ?>/img/x.gif" alt="Standard Industries" />
					</a>
				</div>
			</div>
			<div class="footer">
				<?php
					$args = array(
						'theme_location' => 'footer',
						'menu' => 'Footer Menu',
					);
					wp_nav_menu($args);
				?>
				<div class="copyright">
					&copy; <?php echo date("Y"); ?> GAF Energy LLC. All rights reserved.
				</div>
			</div>
		</div>
	</footer>


<?php wp_footer(); ?>

</body>
</html>
