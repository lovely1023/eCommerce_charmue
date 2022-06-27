<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Sparkle Store Pro
 */

get_header();

$page_layout = get_theme_mod( 'sparklestore_layout_sidebar', 'rightsidebar');

?>

<?php do_action( 'sparklestore-breadcrumbs' ); ?>

<div class="main-content container">

	<div class="site-wrapper <?php echo esc_attr( $page_layout ); ?>">

		<?php if( $page_layout == 'leftsidebar') get_sidebar('left'); ?>
		
		<div id="primary" class="content-area <?php echo esc_attr( $layout  ); ?>" data-layout="<?php echo esc_attr( $layout  ); ?>">
			<main id="main" class="site-main articlesListing blog-grid" role="main">
				<?php
					if ( have_posts() ) :
						
						if( !empty( $layout ) && $layout == 'masonry2-rsidebar'){

							echo '<div class="sparklestore-masonry">';
						}

						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/**
							 * Run the loop for the search to output the results.
							 * If you want to overload this in a child theme then include a file
							 * called content-search.php and that will be used instead.
							 */
							get_template_part( 'template-parts/content', 'search' );

						endwhile;

						if( !empty( $layout ) && $layout == 'masonry2-rsidebar'){

							echo '</div>';
						}

						the_posts_pagination( 
							array(
								'prev_text' => esc_html__( 'Prev', 'sparklestore-pro' ),
								'next_text' => esc_html__( 'Next', 'sparklestore-pro' ),
							)
						);

						else :

							get_template_part( 'template-parts/content', 'none' );

					endif; 
				?>
			</main>
		</div>
			
		<?php if( $page_layout == 'rightsidebar') get_sidebar(); ?>

	</div>
</div>

<?php get_footer();