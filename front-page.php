<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package RNB_School_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
            ?>

            <section class="home-left">
				<?php
				if ( function_exists( 'get_field' ) ) {
					if ( get_field( 'left_section_heading' ) ) {
						echo '<h2>';
						the_field( 'left_section_heading' );
						echo '</h2>';
					}
					if ( get_field( 'left_section_content' ) ) {
						echo '<p>';
						the_field( 'left_section_content' );
						echo '</p>';
					}
				}
				?>
			</section>

			<section class="home-right">
				<?php
				if ( function_exists( 'get_field' ) ) {
					if ( get_field( 'right_section_heading' ) ) {
						echo '<h2>';
						the_field( 'right_section_heading' );
						echo '</h2>';
					}
					if ( get_field( 'right_section_content' ) ) {
						echo '<p>';
						the_field( 'right_section_content' );
						echo '</p>';
					}
				}
				?>
			</section>

            <!-- Need this for most sites -->
            <section class="home-blog"> 
				<h2><?php esc_html_e( 'Recent News', 'rnb' ); ?></h2>
				<?php
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 3
				);
				$blog_query = new WP_Query( $args );
				if( $blog_query -> have_posts() ) {
					while ( $blog_query -> have_posts()) {
						$blog_query -> the_post();
						?>
						<article>
							<h3>
								<?php the_post_thumbnail('featured-image')?>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
						</article>
						<?php
					}
					wp_reset_postdata();
				}
				?>
			</section>

            <?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
