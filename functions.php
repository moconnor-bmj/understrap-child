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
    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), '0.1.0', true );
	wp_enqueue_script( 'my-script', get_stylesheet_directory_uri() . '/js/jquery.matchHeight-min.js', array(), true );
}

/* Custom Action - Hide word 'category' in category title 
 * Added by moconnor-bmj
*/
function custom_get_the_archive_title ($title) { if ( is_category() ) { $title = single_cat_title( '', false ); } return $title;   } 
add_action( 'get_the_archive_title', 'custom_get_the_archive_title' );


/* Prevent HTML from being stripped out in category descriptions 
 * Added by moconnor-bmj
*/

foreach ( array( 'pre_term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_filter_kses' );
}
 
foreach ( array( 'term_description' ) as $filter ) {
    remove_filter( $filter, 'wp_kses_data' );
}

/**
 * Display navigation to next/previous post when applicable.
 * Added by moconnor-bmj
*/
if ( ! function_exists( 'understrap_post_nav' ) ) :

	function understrap_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>

		<div class="row">
			<div class="col-md-12">
				<nav class="navigation post-navigation">
					<h1 class="sr-only"><?php _e( 'Post navigation', 'understrap' ); ?></h1>
					<div class="nav-links">
						<?php

							if ( get_previous_post_link() ) {
								previous_post_link( '<div class="nav-previous">%link</div>', _x( '<i class="fa fa-angle-double-left" aria-hidden="true"></i>
&nbsp;%title', 'Previous post link', 'understrap' ) );
							}
							if ( get_next_post_link() ) {
								next_post_link( '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<i class="fa fa-angle-double-right" aria-hidden="true"></i>
</span>', 'Next post link', 'understrap' ) );
							}
						?>
					</div><!-- .nav-links -->
				</nav><!-- .navigation -->
			</div>
		</div>
		<?php
	}
endif;


/**
 * Edited meta information for the current post-date/time and author.
 * By request, removed 'by author' & 'Edited on' date - 
  * Added by moconnor-bmj
*/
 

if ( ! function_exists( 'understrap_posted_on' ) ) :

function understrap_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> 
    <!--- Time updated (edited on) commented out by request (moconnor-bmj)--->
    <!---<time class="updated" datetime="%3$s">' . __( ' Edited %4$s', 'understrap' ) . '</time>-->';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( '%s', 'understrap' ),
		'<span>' . $time_string . '</span>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'understrap' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span>
  <!--- Author byline commented out by request (moconnor-bmj)--->
  <!---<span class="byline"> ' . $byline . '</span>--->';

}
endif;


if ( ! function_exists( 'understrap_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function understrap_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( __( ', ', 'understrap' ) );
		if ( $categories_list && understrap_categorized_blog() ) {
			printf( '<span class="cat-links">' . __( '%s', 'understrap' ) . '</span>', $categories_list );
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', __( ', ', 'understrap' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links">' . __( '%s', 'understrap' ) . '</span>', $tags_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( '0 Comments', 'understrap' ), __( '1 Comment', 'understrap' ), __( '% Comments', 'understrap' ) );
		echo '</span>';
	}

		edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'understrap' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;


/**
 * Filter the excerpt length to 30 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 * Added by moconnor-bmj
*/
function wp_example_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'wp_example_excerpt_length');

/**
 * Modify The Read More Link Text (2 functions)
 * Added by moconnor-bmj
*/
function modify_read_more_link() {
    return '<a class="btn btn-secondary understrap-read-more-link" href="' . get_permalink() . '">More...</a>';
}
add_filter( 'the_content_more_link', 'modify_read_more_link' );

if ( ! function_exists( 'all_excerpts_get_more_link' ) ) {
	/**
	 * Adds a custom read more link to all excerpts, manually or automatically generated
	 *
	 * @param string $post_excerpt Posts's excerpt.
	 *
	 * @return string
	 */
	function all_excerpts_get_more_link( $post_excerpt ) {

		return $post_excerpt . ' [...]<p><a class="btn btn-secondary understrap-read-more-link" href="' . get_permalink( get_the_ID() ) . '">' . __( 'More...',
		'understrap' ) . '</a></p>';
	}
}
add_filter( 'wp_trim_excerpt', 'all_excerpts_get_more_link' );



/**
 *Add shortcode for embedding Careers iFrame widget.
 *
 * WP strips out iFrame markup by default. This is a fix.
 * Added by moconnor-bmj
*/
add_shortcode('iframe', 'careers_iframe');

function careers_iframe($atts, $content) {
 if (!$atts['width']) { $atts['width'] = 345; }
 if (!$atts['height']) { $atts['height'] = 400; }

 return '<iframe border="0" class="shortcode_iframe" src="' . $atts['src'] . '" width="' . $atts['width'] . '" height="' . $atts['height'] . '"></iframe>';
}

