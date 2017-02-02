<?php //touch('wp-content/themes/understrap-child/category-patient_perspectives.php'); ?>
<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */
?>

<?php $container = get_theme_mod('understrap_container_type'); ?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?> - <?php bloginfo('description'); ?>">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

  <div class="hfeed site" id="page">

    <!-- ******************* The Navbar Area ******************* -->
    <div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar">

      <a class="skip-link screen-reader-text sr-only" href="#content"><?php _e( 'Skip to content', 'understrap' ); ?></a>
	
	<!-- ******************* LEADERBOARD - remove to include file !!! ******************* -->
	<div class="ad-leaderboard hidden-sm-down" style="display: block; background-color: #f1f1f1; text-align: center; padding: 1.52rem 0;">
         <img src="http://placehold.it/728x90/52c9f5/ffffff?text=Leaderboard"></div>
    </div>
    <!-- ******************* END LEADERBOARD - remove to include file !!! ******************* -->


	  <nav class="navbar navbar-dark bg-primary site-navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

        <div class="container" id="content">

          <div class="navbar-header">

            <!-- .navbar-toggle is used as the toggle for collapsed navbar content -->
            <button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse" data-target=".exCollapsingNavbar" aria-controls="exCollapsingNavbar" aria-expanded="false" aria-label="Toggle navigation"></button>

            <!-- Your site title as branding in the menu -->
            <?php if (!has_custom_logo()) { ?>
              <a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                <?php bloginfo( 'name' ); ?>
              </a>
            <?php } else { the_custom_logo(); } ?><!-- end custom logo -->

          </div>

          <!-- The WordPress Menu goes here -->
          <?php wp_nav_menu(
            array(
              'theme_location' => 'primary',
              'container_class' => 'collapse navbar-toggleable-sm exCollapsingNavbar',
              'menu_class' => 'nav navbar-nav',
              'fallback_cb' => '',
              'menu_id' => 'main-menu',
              'walker' => new wp_bootstrap_navwalker()
            )
          ); ?> 
        </div> <!-- .container -->

      </nav><!-- .site-navigation -->
     </div><!-- .wrapper-navbar end -->

    
    <!---  Custom PHP for The BMJ site link -->


<div id="content" class="container-fluid hidden-md-up bmjMob">		
  <div class="bmj_text">
    <p>
        <a href="//bmj.com/thebmj">Access thebmj.com - <img alt="The BMJ logo" title="The BMJ" src="/wp-content/uploads/2016/12/thebmj_logo.png"></a> 
    </p> 
  </div>
</div>


    
    

   