<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sparkle Store Pro
 */

$blog_layout = get_theme_mod( 'sparklestore_archive_layout', 'default' );
$page_sidebar = get_theme_mod( 'sparklestore_archive_sidebar', 'rightsidebar');

get_header(); ?>

<?php do_action( 'sparklestore-breadcrumbs' ); ?>

<div class="main-content container">

	<div class="site-wrapper <?php echo esc_attr( $page_sidebar ); ?>">

		<?php if( $page_sidebar == 'leftsidebar') get_sidebar('left'); ?>

		<div id="primary" class="content-area <?php echo esc_attr( $blog_layout  ); ?>" data-layout="<?php echo esc_attr( $blog_layout  ); ?>">
			<main id="main" class="site-main articlesListing blog-grid" role="main">
				<?php
					if ( have_posts() ) :
						
						if( !empty( $blog_layout ) && $blog_layout == 'masonry'){

							echo '<div class="sparklestore-masonry">';
						}

						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/**
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                            */
                            if( $blog_layout == 'default' ){   

                                get_template_part('template-parts/content', get_post_format());

                            }elseif( $blog_layout == 'masonry' ){

                                get_template_part( 'template-parts/bloglayout/blog', 'masonry' );

                            }elseif( $blog_layout == 'gridview' ){

                                get_template_part( 'template-parts/bloglayout/blog', 'gridview' );

                            }elseif( $blog_layout == 'alternateview' ){

                                get_template_part( 'template-parts/bloglayout/blog', 'alternative' );

                            }elseif( $blog_layout == 'largelistview' ){

                                get_template_part( 'template-parts/bloglayout/blog', 'largelistview' );

                            }else{

                                get_template_part('template-parts/content', get_post_format());

                            }

						endwhile;

						if( !empty( $blog_layout ) && $blog_layout == 'masonry'){

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
			
		<?php if( $page_sidebar == 'rightsidebar') get_sidebar(); ?>

	</div>
</div>

<?php get_footer();