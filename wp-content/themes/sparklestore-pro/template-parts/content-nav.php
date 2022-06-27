<nav class="navigation post-navigation" role="navigation">
    <div class="nav-links">
        <?php 
            if( $prev_post = get_previous_post() ): 
                echo'<div class="nav-previous">';
                    $prevpost = get_the_post_thumbnail( $prev_post->ID, 'thumbnail', array('class' => 'pagination-previous')); 
                    previous_post_link( '%link',"$prevpost <span>".esc_html__('Previous Post','sparklestore-pro')."</span> %title", TRUE ); 
                echo'</div>';
            endif; 
                
            if( $next_post = get_next_post() ): 
                echo'<div class="nav-next">';
                    $nextpost = get_the_post_thumbnail( $next_post->ID, 'thumbnail', array('class' => 'pagination-next')); 
                    next_post_link( '%link',"$nextpost  <span>".esc_html__('Next Post','sparklestore-pro')."</span> %title", TRUE ); 
                echo'</div>';
            endif;
        ?>
    </div>
</nav>