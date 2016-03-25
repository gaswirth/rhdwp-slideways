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

			<section id="full-1" class="full-image">
				<img src="<?php echo RHD_UPLOAD_URL; ?>/2016/03/A.-Ewoldt-2016-5.jpg" alt="Ali Ewoldt">
			</section>

			<section id="news" class="scrolled-slide">
				<h2 class="section-title">Latest News</h2>
				<div class="section-content">
					<?php if ( have_posts() ) : ?>
						<div class="news-entries">
							<?php while ( have_posts() ) : the_post(); ?>
								<?php if ( has_post_thumbnail() ) : ?>
									<article id="news-<?php the_ID(); ?>" <?php post_class( 'news-entry' ); ?>>

										<?php $ext_url = esc_url( get_post_meta( get_the_ID(), '_ext-link', true ) ); ?>

										<header class="news-header">
											<?php
											if ( $ext_url )
												echo "<a href='$ext_url'>";

											the_post_thumbnail( 'medium' );

											if ( $ext_url )
												echo '</a>';
											?>
										</header><!-- .entry-header -->

										<div class="news-content">
											<?php the_content(); ?>
										</div><!-- .entry-content -->

									</article><!-- #post -->
									<hr class="news-sep">
								<?php endif; ?>
						<?php endwhile; ?>

						<?php rhd_archive_pagination(); ?>

						</div><!-- .news-entries -->
					<?php endif; ?>
				</div>
			</section>

			<section id="full-2" class="full-image">
				<img src="<?php echo RHD_UPLOAD_URL; ?>/2016/03/A.-Ewoldt-2016-3.jpg" alt="Ali Ewoldt">
			</section>

			<section id="about" class="scrolled-slide">
				<?php
				$section_args['name'] = 'about';
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

			<section id="full-3" class="full-image">
				<img src="<?php echo RHD_UPLOAD_URL; ?>/2016/03/A.-Ewoldt-1.jpg" alt="Ali Ewoldt">
			</section>

			<section id="resume" class="slide">
				<?php
				$section_args['name'] = 'resume';
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

			<section id="full-4" class="full-image">
				<img src="<?php echo RHD_UPLOAD_URL; ?>/2016/03/A.-Ewoldt-2016-2.jpg" alt="Ali Ewoldt">
			</section>

			<section id="photos" class="slide">
				<?php
				$section_args['name'] = 'photos';
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

			<section id="full-5" class="full-image">
				<img src="<?php echo RHD_UPLOAD_URL; ?>/2016/03/A.-Ewoldt-2016-4.jpg" alt="Ali Ewoldt">
			</section>

			<section id="video" class="scrolled-slide">
				<?php
				$section_args['name'] = 'video';
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

			<section id="full-6" class="full-image">
				<img src="<?php echo RHD_UPLOAD_URL; ?>/2016/03/A.-Ewoldt-2016-1.jpg" alt="Ali Ewoldt">
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
				</div>
			</section>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>