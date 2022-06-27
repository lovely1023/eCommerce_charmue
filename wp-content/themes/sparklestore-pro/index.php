<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sparkle Store Pro
 */

$blog_layout = get_theme_mod( 'sparklestore_home_page_blog_layout', 'default' );

$page_layout = get_theme_mod( 'sparklestore_home_page_blog_sidebar', 'rightsidebar' );

$post_content_type = get_theme_mod( 'sparklestore_post_description_options', 'excerpt' );
$blogreadmore_btn = get_theme_mod( 'sparklestore_blogtemplate_btn', 'Read More' );
$text_align = get_theme_mod('sparklestore_post_description_text_alignment', 'center');

$template_args = array(
    'post_content_type' => $post_content_type,
    'blogreadmore_btn' => $blogreadmore_btn,
    'text_align'    => $text_align
);


get_header(); ?>

<div class="main-content container">

	<div class="site-wrapper <?php echo esc_attr( $page_layout ); ?>">

		<?php if( $page_layout == 'leftsidebar') get_sidebar('left'); ?>

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

                                get_template_part('template-parts/content', get_post_format(), $template_args);

                            }elseif( $blog_layout == 'masonry' ){

                                get_template_part( 'template-parts/bloglayout/blog', 'masonry', $template_args );

                            }elseif( $blog_layout == 'gridview' ){

                                get_template_part( 'template-parts/bloglayout/blog', 'gridview', $template_args );

                            }elseif( $blog_layout == 'alternateview' ){

                                get_template_part( 'template-parts/bloglayout/blog', 'alternative', $template_args );

                            }elseif( $blog_layout == 'largelistview' ){

                                get_template_part( 'template-parts/bloglayout/blog', 'largelistview', $template_args );

                            }else{

                                get_template_part('template-parts/content', get_post_format(), $template_args);

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
			
		<?php if( $page_layout == 'rightsidebar') get_sidebar(); ?>

	</div>
</div>

<?php get_footer();