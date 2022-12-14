<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link http://allenorchestra.org
 *
 * @package WordPress
 * @subpackage AO
 * @since 1.0
 * @version 2.0
 */
	get_header();
	if(!is_paged()){
		get_template_part('banner');
	}
?>
<main class="index">

	<?php !is_paged() ? get_template_part('sidebar') : ''; ?>
	<script>
		$(document).ready(function() {
			var $grid = $('#grid').isotope({
				itemSelector: '.grid-item',
				percentPosition: true
			});
			$grid.imagesLoaded().progress(function() {
				$grid.isotope('layout');
			});
		});
	</script>

	<section class="posts">
		<header class="divider">
			<h3><span><?php echo get_bloginfo( 'name' ); ?> Updates</span></h3>
		</header>
		<div class="container">
			<div class="row grid" id="grid">
				<?php
					// Iteriate through the first 10 non-sticky posts
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = array(
						'post__not_in' => get_option( 'sticky_posts' ),
						'posts_per_page' => get_option( 'posts_per_page' ),
						'paged' => $paged
					);
					$wp_query = new WP_Query( $args );
					if ( $wp_query->have_posts() ) : while ( $wp_query->have_posts() ) : $wp_query->the_post();
				?>
				<div class="col-xs-12 col-sm-6 grid-item">
					<div class="card post">
						<?php get_featured_image(); ?>
						<div class="card-body">
							<h2><a class="post-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="post-date date">
								<time datetime="" itemprop="datePublished">
									<?php the_time('F jS, Y') ?> <?php edit_post_link('edit'); ?>
								</time>
							</div>
							<?php the_content(); ?>
						</div>
					</div>
				</div>
				<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
			</div>
			<div class="row">
				<div class="col-12">
					<?php bittersweet_pagination(); ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php get_footer(); ?>