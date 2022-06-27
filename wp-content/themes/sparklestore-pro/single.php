<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Sparkle Store Pro
 */
get_header();
$page_layout = rwmb_meta('sidebar_layout');
if( empty($page_layout) || $page_layout == 'default') $page_layout = get_theme_mod( 'sparklestore_single_blog_sidebar', 'rightsidebar');

?>

<?php do_action('sparklestore-breadcrumbs'); ?>

<div class="main-content container">

	<div class="site-wrapper <?php echo esc_attr( $page_layout ); ?>">

		<?php if( $page_layout == 'leftsidebar') get_sidebar('left'); ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main articlesListing" role="main">
				<?php
					if ( have_posts() ) :
						
						/* Start the Loop */
						while ( have_posts() ) : the_post();

							/*
							* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
                            get_template_part('template-parts/content', 'single');

                        endwhile;
                        
                            $authoroptions = get_theme_mod( 'sparklestore_post_author_section_options', 'off' );
                                
                            if( !empty( $authoroptions ) && $authoroptions == 'on' ){
                                /**
                                 * Posts Author
                                */
                                get_template_part( 'template-parts/content', 'author' );
                            }

							if( get_theme_mod('sparklestore_post_pagination_section_options', 'on') == 'on'): 
								/**
								 * Post Previous & Next Nav 
								*/
								get_template_part( 'template-parts/content', 'nav' );
							endif; 

							
							// If comments are open or we have at least one comment, load up the comment template.
							if (comments_open() || get_comments_number()) :

								comments_template();

							endif;

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