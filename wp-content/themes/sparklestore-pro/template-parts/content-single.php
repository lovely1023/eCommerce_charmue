<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sparkle Store Pro
 */

$postformat = get_post_format(); 
$sparklestore_post_tags_options = get_theme_mod('sparklestore_post_tags_options', 'on');
$sparklestore_post_features_options = get_theme_mod('sparklestore_post_features_options', 'on');

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?> itemtype="http://schema.org/BlogPosting" itemtype="http://schema.org/BlogPosting">

	<?php
		if( $sparklestore_post_features_options == 'on'):

			sparklestore_post_format_media( $postformat );

		endif;
	?>

	<!-- <div class="box"> -->

	<?php 

		the_title( '<h2><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); 

		if ( 'post' === get_post_type() ){ do_action( 'sparklestore_post_meta', 10 ); } 
	?>
	
	<div class="entry-content">
		<?php
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
		?>
	</div>

	<?php if( $sparklestore_post_tags_options == 'on'): ?>
		<div class="posts-tag">        
			<?php the_tags( '<ul><li><i class="fa fa-tag"></i></li><li>', '</li><li>', '</li></ul>' ); ?>
		</div>
	<?php endif; ?>
		
	<!-- </div> -->

</article><!-- #post-<?php the_ID(); ?> -->