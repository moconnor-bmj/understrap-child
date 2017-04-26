<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_html( $container ); ?>" id="content">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon" role="contentinfo">

					<div class="bmj-footer">
						<div class="legal">
							<ul>
								<li><a href="http://group.bmj.com/group/contact/">Contact us</a>  </li>
								<li><a href="http://group.bmj.com/group/about/legal/terms/">Website terms &amp; conditions</a>  </li>
								<li><a href="http://group.bmj.com/group/about/legal/privacy/">Privacy policy</a>  </li>
								<li><a href="http://group.bmj.com/group/about/revenue-sources">Revenue sources</a> </li>
								<li><a title="Home page" href="/">Home</a>  </li>
								<li><a href="javascript:scrollTo(0,0);">Top</a></li>
							</ul>
							<div class=""><p>&copy; BMJ Publishing Group Limited <?php echo date("Y"); ?>. All rights reserved.</p></div>
						</div>
					</div>

					<!--<div class="site-info">
						<a href="<?php echo esc_url( __( 'http://wordpress.org/',
						'understrap' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'understrap' ),
						'WordPress' ); ?></a>
						<span class="sep"> | </span>
						<?php printf( __( 'Theme: %1$s by %2$s.', 'understrap' ), $the_theme->get( 'Name' ),
						'<a href="http://understrap.com/">understrap.com</a>' ); ?>
						(<?php printf( __( 'Version: %1$s', 'understrap' ), $the_theme->get( 'Version' ) ); ?>)
					</div> .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
