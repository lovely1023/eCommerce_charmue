<?php
/**
 * The template for displaying author bio on single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Sparkle Store Pro
 */

	$author_id         = get_the_author_meta( 'ID' );
	$author_avatar     = get_avatar( $author_id, 150 );
	$author_post_link  = get_the_author_posts_link();
	$author_bio        = get_the_author_meta( 'description' );
	$author_email      = get_the_author_meta('email');
?>

<div class="aboutauthor box">
    <?php if ( $author_avatar ) { ?>
        <div class="authorimage">
            <?php echo wp_kses_post( $author_avatar ); ?>
        </div>
    <?php } ?>

    <div class="authorinfo">
        <?php if ( $author_post_link ) { ?>
            <h4 class="name"><?php echo wp_kses_post( $author_post_link ); ?></h4>
        <?php } ?>

        <?php if ( $author_bio ) { ?>
            <p class="text">
                <?php echo wp_kses_post( $author_bio ); ?>
            </p>
        <?php } ?>
    </div>
</div><!-- About author -->
