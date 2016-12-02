<?php
function understrap_remove_scripts() {
    wp_dequeue_style( 'understrap-styles' );
    wp_deregister_style( 'understrap-styles' );

    wp_dequeue_script( 'understrap-scripts' );
    wp_deregister_script( 'understrap-scripts' );

    // Removes the parent themes stylesheet and scripts from inc/enqueue.php
}
add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array());
    wp_enqueue_style( 'child-understrap-font-styles', get_stylesheet_directory_uri() . '/css/fonts.css', array());
    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Yanone+Kaffeesatz%3A200%2C300%2C400%2C700&#038;ver=4.5.4' );
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), '0.1.0', true );
}


/**
 * Archive Post Class
 * @since 1.0.0
 *
 * Breaks the posts into three columns
 * @link http://www.billerickson.net/code/grid-loop-using-post-class
 *
 * @param array $classes
 * @return array
 * 
 * @Added by: moconnor-bmj
 */

function be_archive_post_class( $classes ) {
	global $wp_query;
	if( ! $wp_query->is_main_query() )
		return $classes;
		
    $classes[] = 'col-md-6';
        if( 0 == $wp_query->current_post )
            $classes[] = 'myFeaturedPosts';
        return $classes;
}
add_filter( 'post_class', 'be_archive_post_class' ); 


/**************************************************************************
 * Add author box to end of posts
 * 
 *
 * @Added by: moconnor-bmj
 */
        function wpb_author_info_box( $content ) {

        global $post;

        // Detect if it is a single post with a post author
        if ( is_single() && isset( $post->post_author ) ) {

        // Get author's display name 
        $display_name = get_the_author_meta( 'display_name', $post->post_author );

        // If display name is not available then use nickname as display name
        if ( empty( $display_name ) )
        $display_name = get_the_author_meta( 'nickname', $post->post_author );

        // Get author's biographical information or description
        $user_description = get_the_author_meta( 'user_description', $post->post_author );

        // Get author's website URL 
        $user_website = get_the_author_meta('url', $post->post_author);

        // Get link to the author archive page
        $user_posts = get_author_posts_url( get_the_author_meta( 'ID' , $post->post_author));
        
        if ( ! empty( $display_name ) )

        $author_details = '<p class="author_name">About ' . $display_name . '</p>';

        if ( ! empty( $user_description ) )
        // Author avatar and bio

        $author_details .= '<p class="author_details">' . get_avatar( get_the_author_meta('user_email') , 90 ) . nl2br( $user_description ). '</p>';

        $author_details .= '<p class="author_links"><a href="'. $user_posts .'">View all posts by ' . $display_name . '</a>';  

        // Check if author has a website in their profile
        if ( ! empty( $user_website ) ) {

        // Display author website link
        $author_details .= ' | <a href="' . $user_website .'" target="_blank" rel="nofollow">Website</a></p>';

        } else { 
        // if there is no author website then just close the paragraph
        $author_details .= '</p>';
        }

        // Pass all this info to post content  
        $content = $content . '<footer class="author_bio_section" >' . $author_details . '</footer>';
        }
        return $content;
        }

        // Add our function to the post content filter 
        add_action( 'the_content', 'wpb_author_info_box' );

        // Allow HTML in author bio section 
        remove_filter('pre_user_description', 'wp_filter_kses');


