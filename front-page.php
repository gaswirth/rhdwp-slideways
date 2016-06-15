<?php
/**
 * The Front Page template file.
 *
 * @package WordPress
 * @subpackage rhd
 */

get_header();

// General get_posts() arguments
$section_args = array(
  'post_type'   => 'page',
  'post_status' => 'publish',
  'numberposts' => 1
);
?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<section id="full-1" class="image-sep">
				<img src="<?php echo RHD_UPLOAD_URL; ?>/2016/06/Sheri-1.jpg" alt="Ali Ewoldt">
				<div class="scroll-text">Scroll &rarr;</div>
			</section>

			<section id="actress" class="scrolled-slide">
				<?php
				$section_args['name'] = 'actress';
				$section = get_posts( $section_args );
				?>

				<div class="section-content">
					<h2 class="section-title"><?php echo $section[0]->post_title; ?></h2>
					<?php
					if ( $section ) {
						echo apply_filters( 'the_content', $section[0]->post_content );
					}
					?>
				</div>
			</section>

			<section id="full-2" class="image-sep">
				<img src="<?php echo RHD_UPLOAD_URL; ?>/2016/06/Sheri-2.jpg" alt="Ali Ewoldt">
			</section>

			<section id="entrepreneur" class="scrolled-slide">
				<?php
				$section_args['name'] = 'entrepreneur';
				$section = get_posts( $section_args );
				?>

				<h2 class="section-title"><?php echo $section[0]->post_title; ?></h2>

				<div class="section-content">
					<?php
						if ( $section ) {
							echo apply_filters( 'the_content', $section[0]->post_content );
						}
					?>
				</div>
			</section>

			<section id="full-3" class="image-sep">
				<img src="<?php echo RHD_UPLOAD_URL; ?>/2016/06/Sheri-3.jpg" alt="Ali Ewoldt">
			</section>

			<section id="rock-the-audition" class="scrolled-slide">
				<?php
				$section_args['name'] = 'rock-the-performance';
				$section = get_posts( $section_args );
				?>

				<h2 class="section-title"><?php echo $section[0]->post_title; ?></h2>

				<div class="section-content">
					<?php
						if ( $section ) {
							echo apply_filters( 'the_content', $section[0]->post_content );
						}
					?>
				</div>
			</section>

			<section id="full-4" class="image-sep">
				<img src="<?php echo RHD_UPLOAD_URL; ?>/2016/06/Sheri-4.jpg" alt="Ali Ewoldt">
			</section>

			<section id="contact" class="scrolled-slide">
				<?php
				$section_args['name'] = 'contact';
				$section = get_posts( $section_args );
				?>

				<h2 class="section-title"><?php echo $section[0]->post_title; ?></h2>

				<div class="section-content">
					<?php
						if ( $section ) {
							echo apply_filters( 'the_content', $section[0]->post_content );
						}
					?>

					<footer id="colophon">
						<div class="site-info">
							<p>
								<?php echo '&copy;' . date( 'Y' ); ?> <?php echo bloginfo( 'name' ); ?><br />
								Photography by <a href="//dirtysugar.smugmug.com" target="_blank">Dirty Sugar</a><br />
								Site by <a href="//roundhouse-designs.com" target="_blank">Roundhouse<img id="rhd-logo-footer" src="//assets.roundhouse-designs.com/images/rhd-black-house.png" alt="Roundhouse Designs">Designs</a>
							</p>
						</div><!-- .site-info -->
					</footer>
				</div>
			</section>
			
			<section id="full-5" class="image-sep">
				<img src="<?php echo RHD_UPLOAD_URL; ?>/2016/06/Sheri-5.jpg" alt="Ali Ewoldt">
			</section>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>