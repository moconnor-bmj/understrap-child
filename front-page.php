<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
// On WooCommerce pages there is no need for sidebars as they leave
// too little space for WooCommerce itself. We check if WooCommerce
// is active and the current page is a WooCommerce page and we do
// not render sidebars.
$is_woocommerce = false;
$this_page_id   = get_queried_object_id();
if ( class_exists( 'WooCommerce' ) ) {

	if ( is_woocommerce() || is_shop() || get_option( 'woocommerce_shop_page_id' ) === $this_page_id ||
	     get_option( 'woocommerce_cart_page_id' ) == $this_page_id || get_option( 'woocommerce_checkout_page_id' ) == $this_page_id ||
	     get_option( 'woocommerce_pay_page_id' ) == $this_page_id || get_option( 'woocommerce_thanks_page_id' ) === $this_page_id ||
	     get_option( 'woocommerce_myaccount_page_id' ) == $this_page_id || get_option( 'woocommerce_edit_address_page_id' ) == $this_page_id ||
	     get_option( 'woocommerce_view_order_page_id' ) == $this_page_id || get_option( 'woocommerce_terms_page_id' ) == $this_page_id
	) {

		$is_woocommerce = true;
	}
}
?>

    <div class="wrapper" id="page-wrapper">

        <div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

            <div class="row">

                <!-- Do the left sidebar check -->
                <?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

                <?php 
				$obj = get_queried_object();
				$catName = $obj->slug;
				$args = array(
				'posts_per_page'   => 1,
				'tag_id'           => 14779,  
				'orderby'          => 'modified',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish'
				);
				$posts_array = new WP_Query( $args );
				if ($posts_array->have_posts()) : while ($posts_array->have_posts()) : $posts_array->the_post();
			?>
                <div id="featuredPost">
                    <article <?php post_class( 'class-name' ); ?> id="post-
                    <?php the_ID(); ?> " >
                        <div class="col-lg-5 col-md-12 col-sm-12">
                            <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
                        </div>
                        <div class="col-lg-7 col-md-12 col-sm-12">
                            <div class="entry-header ">
                                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                          '</a></h2>' ); ?>
                                <?php if ( 'post' == get_post_type() ) : ?>
                                <div class="entry-meta">
                                    <?php understrap_posted_on(); ?>
                                </div>
                                <!-- .entry-meta -->

                                <?php endif; ?>

                            </div>
                            <!-- .entry-header -->
                            <div class="entry-content">
                             <?php the_content();  ?>
                            </div>
                            <!-- .entry-content -->
                        </div>
                        <footer class="entry-footer">
                            <?php understrap_entry_footer(); ?>
                        </footer>
                        <!-- .entry-footer -->
                    </article>
                    <?php endwhile; endif; wp_reset_query()?>
                </div>
                <!-- #featuredPost end -->


                <div id="featuredCategory" class="row">
                    <h3 class="featuredCat"><a href="<?php echo get_category_link(14778); ?>"><span>
                  <?php echo get_cat_name(14778); ?></span></a></h3>
                    <?php 
                    $args = array(
                    'posts_per_page'   => 6,
                    'category_name'	   => 'featured',
                    'category__not_in' => array( 14781,14780 ), //not in editable topics category (id = 14781), columnists (id = 14780), guest writers (id = 223)
                    'orderby'          => 'date',
                    'order'            => 'DESC',
                    'post_type'        => 'post',
                    'post_status'      => 'publish',
                    'post__not_in'     => $do_not_duplicate
                      );
                    $posts_array = new WP_Query( $args );
                    if ($posts_array->have_posts()) : while ($posts_array->have_posts()) : $posts_array->the_post();

                 ?>
                    <div class="col-md-4 col-sm-6">
                        <article <?php post_class(); ?> id="post-
                            <?php the_ID(); ?>">
                            <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
                            <div class="entry-header ">
                                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                    '</a></h2>' ); ?>
                                <?php if ( 'post' == get_post_type() ) : ?>
                                <div class="entry-footer">
                                    <?php understrap_posted_on(); ?><br />
                                    <?php understrap_entry_footer(); ?>
                                </div>
                                <!-- .entry-footer -->

                               

                                <?php endif; ?>
                            </div>
                            <!-- .entry-header -->
                        </article>
                    </div>
                    <?php endwhile; endif; wp_reset_query()?>
                </div>
                <!-- #featuredCategory end -->

                <div id="latestCategory" class="row">
                    <h3 class="latestCat"><a href="/latest/"><span>Latest</span></a></h3>
                    <?php 
                    $args = array(
                    'posts_per_page'   => 9,
                    'orderby'          => 'most_recent',
                    'category__not_in' => array( 14778), //not in featured (id = 14778)
                    'order'            => 'DESC',
                    'post_type'        => 'post',
                    'post_status'      => 'publish',
                    'post__not_in'     => $do_not_duplicate
                      );
                    
                    $posts_array = new WP_Query( $args );
                    if ($posts_array->have_posts()) : while ($posts_array->have_posts()) : $posts_array->the_post();

                 ?>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <article <?php post_class(); ?> id="post-
                            <?php the_ID(); ?>">
                            <?php //echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
                            <div class="entry-header ">
                                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                    '</a></h2>' ); ?>
                                <?php if ( 'post' == get_post_type() ) : ?>
                                <div class="entry-footer">
                                    <?php understrap_posted_on(); ?><br />
                                    <?php understrap_entry_footer(); ?>
                                </div>
                                <!-- .entry-footer -->

                                <?php endif; ?>
                            </div>
                            <!-- .entry-header -->
                        </article>
                    </div>
                    <?php endwhile; endif; wp_reset_query()?>
                </div>
                <!-- #latestCategory end -->

                <div id="editableCategory" class="row">
                    <h3 class="topicsCat"><a href="<?php echo get_category_link(14781); ?>"><span>
              <?php echo get_cat_name(14781); ?></span></a></h3>
                    <?php 
                    $args = array(
                    'posts_per_page'   => 3,
                    'cat'	             => 14781,
                    'category__not_in' => array( 14778,14780,223 ), //not in featured (id = 14778), columnists (id = 14780), guest writers (id = 223)
                    'orderby'          => 'date',
                    'order'            => 'DESC',
                    'post_type'        => 'post',
                    'post_status'      => 'publish',
                    'post__not_in' => $do_not_duplicate
                      );
                    
                    $posts_array = new WP_Query( $args );
                    if ($posts_array->have_posts()) : while ($posts_array->have_posts()) : $posts_array->the_post();

                 ?>
                    <div class="col-md-4 col-sm-6">
                        <article <?php post_class(); ?> id="post-
                            <?php the_ID(); ?>">
                            <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
                            <div class="entry-header ">
                                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                    '</a></h2>' ); ?>
                                <?php if ( 'post' == get_post_type() ) : ?>
                                <div class="entry-footer">
                                    <?php understrap_posted_on(); ?><br />
                                    <?php understrap_entry_footer(); ?>
                                </div>
                                <!-- .entry-footer -->

                                <?php endif; ?>
                            </div>
                            <!-- .entry-header -->
                        </article>
                    </div>
                    <?php endwhile; endif; wp_reset_query()?>
                </div>
                <!-- #editableCategory end -->
                
                <div id="columnistsCategory" class="row">
                  <h3 class="columnistCat"><a href="<?php echo get_category_link(14780); ?>"><span>
                  <?php echo get_cat_name(14780); ?></span></a></h3>
                    <?php 
                    $args = array(
                    'posts_per_page'   => 3,
                    'cat'	             => 14780,
                    'category__not_in' => array( 14778,14781,223 ), //not in featured (id = 14778), editable category (id = 14781), guest writers (id = 3)
                    'tag_id'           => 14783,
                    'orderby'          => 'date',
                    'order'            => 'DESC',
                    'post_type'        => 'post',
                    'post_status'      => 'publish',
                    'post__not_in' => $do_not_duplicate
                      );
                    
                    $posts_array = new WP_Query( $args );
                    if ($posts_array->have_posts()) : while ($posts_array->have_posts()) : $posts_array->the_post();

                 ?>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <article <?php post_class(); ?> id="post-
                            <?php the_ID(); ?>">
                            <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
                            <div class="entry-header ">
                                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                    '</a></h2>' ); ?>
                                <?php if ( 'post' == get_post_type() ) : ?>
                                <div class="entry-footer">
                                    <?php understrap_posted_on(); ?><br />
                                    <?php understrap_entry_footer(); ?>
                                </div>
                                <!-- .entry-footer -->

                                <?php endif; ?>
                            </div>
                            <!-- .entry-header -->
                        </article>
                    </div>
                    <?php endwhile; endif; wp_reset_query()?>
                </div>


            </div>
            <!-- .row end -->

            <!-- Do the right sidebar check -->
            <?php if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

            <?php if ( ! $is_woocommerce ) : get_sidebar( 'right' ); ?>
            <?php endif; ?>

            <?php endif; ?>

        </div>
        <!-- .container end -->

                <div id="guestCategory" class="row">
                    <h3 class="guestCat"><a href="<?php echo get_category_link(223); ?>"><span>
        <?php echo get_cat_name(223); ?></span></a></h3>
                    <?php 
            $args = array(
            'posts_per_page'   => 4,
            'cat'	             => 223,
            //'category__not_in' => array( 14778,14781,14780 ), //not in featured (id = 14778), editable category (id = 14781), columnists (id = 14780)
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'post',
            'post_status'      => 'publish',
            'post__not_in' => $do_not_duplicate
              );
            
            $posts_array = new WP_Query( $args );
            if ($posts_array->have_posts()) : while ($posts_array->have_posts()) : $posts_array->the_post();

         ?>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <article <?php post_class(); ?> id="post-
                            <?php the_ID(); ?>">
                            <?php // echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
                            <div class="entry-header ">
                                <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
            '</a></h2>' ); ?>
                                <?php if ( 'post' == get_post_type() ) : ?>
                                <div class="entry-footer">
                                    <?php understrap_posted_on(); ?><br />
                                    <?php understrap_entry_footer(); ?>
                                </div>
                                <!-- .entry-footer -->

                                <?php endif; ?>
                            </div>
                            <!-- .entry-header -->
                        </article>
                    </div>
                    <?php endwhile; endif; wp_reset_query()?>
                </div>
        <!-- Container end -->
    </div>
    <!-- Wrapper end -->
<script>
jQuery(function ($) {
    $('article').matchHeight();
});
</script>
    <?php get_footer(); ?>
