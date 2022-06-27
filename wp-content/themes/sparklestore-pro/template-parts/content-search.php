<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sparkle Store Pro
 */

$postformat = get_post_format();

$post_content_type = get_theme_mod( 'sparklestore_post_description_options', 'excerpt' );
$blogreadmore_btn = get_theme_mod( 'sparklestore_blogtemplate_btn', 'Read More' );
$text_align = get_theme_mod('sparklestore_post_description_text_alignment', 'left');


?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?> itemtype="http://schema.org/BlogPosting" itemtype="http://schema.org/BlogPosting">

	<?php
        sparklestore_post_format_media( $postformat );
	?>

	<div class="box text-<?php echo esc_attr($text_align); ?>">

		<?php 

			the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); 

			if ( 'post' === get_post_type() ){ do_action( 'sparklestore_post_meta', 10 ); } 
		?>
		
		<div class="entry-content">
			<?php
				if ( 'excerpt' === $post_content_type ) {

					the_excerpt();

				} elseif ( 'content' === $post_content_type ) {

					the_content( sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'sparklestore-pro' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					) );
				}
			?>
		</div>

		<?php if ( 'excerpt' === $post_content_type ) { ?>
	        <div class="site-button">
				<a class="btn btn-primary" href="<?php the_permalink(); ?>">
					<?php echo esc_html( $blogreadmore_btn ); ?>
				</a>
			</div>
		<?php } ?>
		
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
