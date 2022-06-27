<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Sparkle Store Pro
 */

if ( ! function_exists( 'sparklestore_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function sparklestore_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<div class="blog-post-thumbnail">
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php
						the_post_thumbnail( 'post-thumbnail' );
					?>
				</a>
			</div>
			
		<?php

		endif; // End is_singular().
	}
endif;

if( ! function_exists( 'sparklestore_post_format_media' ) ) :

    /**
     * Posts format declaration function.
     *
     * @since 1.0.0
     */
    function sparklestore_post_format_media( $postformat ) {

        global $post;

        if( is_singular( ) ){

          $imagesize = 'post-thumbnail';

        }else{

            $imagesize = '';
        }

        if ($postformat == "gallery") {

            if (function_exists('has_block') && has_block('gallery', $post->post_content)) {
				
                $post_blocks = parse_blocks($post->post_content);

                $key = array_search('core/gallery', array_column($post_blocks, 'blockName'));
                
				$gallery_attachment_ids = $post_blocks[$key]['attrs']['ids'];

            }else {
                
                $gallery = get_post_gallery( $post->ID, false );

                $gallery_attachment_ids = array();

                if( count($gallery) and isset($gallery['ids'])) {

                    $gallery_attachment_ids = explode ( ",", $gallery['ids'] );

                }
            }

            if ( ! empty( $gallery_attachment_ids ) ){ ?>

                <div class="postgallery-carousel owl-carousel blog-post-thumbnail">

                    <?php foreach ( $gallery_attachment_ids as $gallery_attachment_id ) { ?>
                        
                        <img src="<?php echo wp_get_attachment_image_url($gallery_attachment_id, $imagesize); ?>"/>
                        
                    <?php } ?>

                </div>
                
            <?php } else { ?>
                
                <div class="blog-post-thumbnail">
                    <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                        <?php
                          the_post_thumbnail( $imagesize );
                        ?>
                    </a>
                </div>

            <?php } } else if( $postformat == "video" ){
            
              $get_content  = apply_filters( 'the_content', get_the_content() );
              $get_video    = get_media_embedded_in_content( $get_content, array( 'video', 'object', 'embed', 'iframe' ) );

              if( !empty( $get_video ) ){ ?>

                  <div class="video blog-post-thumbnail">
                      <?php echo $get_video[0]; // WPCS xss ok. ?>
                  </div>

          <?php }else{ ?>

                  <div class="blog-post-thumbnail">
                      <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                          <?php
                            the_post_thumbnail( $imagesize );
                          ?>
                      </a>
                  </div>

          <?php  } }else if( $postformat == "audio" ){

              $get_content  = apply_filters( 'the_content', get_the_content() );
              $get_audio    = get_media_embedded_in_content( $get_content, array( 'audio', 'iframe' ) );

              if( !empty( $get_audio ) ){ ?>

                  <div class="audio blog-post-thumbnail">
                      <?php echo $get_audio[0]; // WPCS xss ok. ?>
                  </div>

          <?php }else{  ?>

                  <div class="blog-post-thumbnail">
                      <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                          <?php
                            the_post_thumbnail( $imagesize );
                          ?>
                      </a>
                  </div>

		  <?php } }else if( $postformat == "quote" ) { ?>
			
				<div class="blog-post-thumbnail">
					<div class="post-format-media-quote">
						<?php
							if (function_exists('has_block') && has_block('quote', $post->post_content)) {
								$post_blocks = parse_blocks($post->post_content);
								$key = array_search('core/quote', array_column($post_blocks, 'blockName'));
								$wuote_content = $post_blocks[$key];
								echo $wuote_content['innerContent'][0];
							}
						?>
					</div>
				</div>

          <?php }else{ ?>

                  <div class="blog-post-thumbnail">
                      <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                          <?php
                            the_post_thumbnail( $imagesize );
                          ?>
                      </a>
                  </div>

          <?php }

    }

endif;

if ( ! function_exists( 'sparklestore_pro_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function sparklestore_pro_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( ' %s', 'post date', 'sparklestore-pro' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<div><span class="posted-on">' . $posted_on . '</span></div>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'sparklestore_pro_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function sparklestore_pro_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( ' %s', 'post author', 'sparklestore-pro' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<div><span class="byline"> ' . $byline . '</span></div>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'sparklestore_pro_comments' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function sparklestore_pro_comments() {

		echo '<span class="comments-link"><i class="fa fa-comments"></i> ';
			
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( '0 <span class="screen-reader-text"> on %s</span>', 'sparklestore-pro' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);

		echo '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'sparklestore_post_meta' ) ){
    /**
     * Post Meta Function
     *
     * @since 1.0.0
     */
    function sparklestore_post_meta() { 
		global $post;
		global $blogpagetemplate;
		if( $blogpagetemplate) {
			$postdate        = rwmb_meta('sparklestore_post_date_options','', $blogpagetemplate);
			$postauthor      = rwmb_meta('sparklestore_post_author_options', '', $blogpagetemplate);
			$postcomment     = rwmb_meta('sparklestore_post_comments_options', '', $blogpagetemplate);
			
			$postdate = $postdate ? 'on' : 'off';
			$postauthor = $postauthor ? 'on' : 'off';
			$postcomment = $postcomment ? 'on' : 'off';
		}else{
			$postdate    = get_theme_mod( 'sparklestore_post_date_options', 'on' );
			$postauthor  = get_theme_mod( 'sparklestore_post_author_options', 'on' );
			$postcomment = get_theme_mod( 'sparklestore_post_comments_options', 'on' );
		}
		
		if( $postdate == 'on' || $postcomment == 'on' || $postauthor == 'on'){
      ?>

        <div class="site-entry-meta metainfo">
            <?php
                if( !empty( $postdate ) && $postdate == 'on' ) { sparklestore_pro_posted_on(); }
                if( !empty( $postauthor ) && $postauthor == 'on' ) { sparklestore_pro_posted_by(); }
                if( !empty( $postcomment ) && $postcomment == 'on' ) { sparklestore_pro_comments(); }
            ?>
        </div><!-- .entry-meta -->

       <?php
        }
    }
}
add_action( 'sparklestore_post_meta', 'sparklestore_post_meta' , 10 );

if ( ! function_exists( 'sparklestore_pro_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function sparklestore_pro_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'sparklestore-pro' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'sparklestore-pro' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'sparklestore-pro' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'sparklestore-pro' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'sparklestore-pro' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'sparklestore-pro' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'sparklestore_category' ) ) :
	/**
	 * Category Lists.
	 */
	function sparklestore_category() {
	/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'sparklestore-pro' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links"><i class="fas fa-folder-open"></i>' . '%1$s' . '</span>', $categories_list ); // WPCS: XSS OK.
		}
	}
endif;

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function sparklestore_excerpt_length( $length ) {
	global $blogpagetemplate;
	
	$excerpt_length = get_theme_mod( 'sparklestore_post_excerpt_length', 40 );
	if( $blogpagetemplate ) {
		$excerpt_length = rwmb_meta('sparklestore_post_excerpt_length', '', $blogpagetemplate);
	}
	if( is_admin() ){

		return $length;

	}else{

		return $excerpt_length;

	}

}
add_filter( 'excerpt_length', 'sparklestore_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function sparklestore_excerpt_more( $more ) {

    if( is_admin() ){

        return $more;
    }

    return '...';
}
add_filter( 'excerpt_more', 'sparklestore_excerpt_more' );