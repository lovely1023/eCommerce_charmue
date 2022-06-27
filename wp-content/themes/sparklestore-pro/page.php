<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sparkle Store Pro
*/
$page_layout = rwmb_meta('sidebar_layout');
if( empty($page_layout) || $page_layout == 'default') $page_layout = get_theme_mod( 'sparklestore_layout_sidebar', 'rightsidebar');

get_header(); ?>

<?php do_action( 'sparklestore-breadcrumbs' ); ?>

<div class="container">

    <div class="site-wrapper <?php echo esc_attr( $page_layout ); ?>">
    
        <?php if( $page_layout == 'leftsidebar') get_sidebar('left'); ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main articlesListing" role="main">
                <?php
                    while ( have_posts() ) : the_post();

                    get_template_part( 'template-parts/content', 'page' );

                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :

                        comments_template();

                    endif;

                    endwhile; // End of the loop.
                ?>
			</main>
		</div>
			
		<?php if( $page_layout == 'rightsidebar') get_sidebar(); ?>

	</div>
</div>

<?php get_footer();