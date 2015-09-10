<?php
  add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
  function theme_enqueue_styles() {
     wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  }

  /*adds NU footer */
  function quest_get_footer_copyright(){
    $footer = '<div class="col-md-3"><a alt="Northeastern University" class="northeastern-logo" href="http://www.northeastern.edu"><span class="sr-only">Northeastern University</span></a></div><div class="col-md-6"><ul class="nav nav-pills"><li><a href="http://myneu.neu.edu/cp/home/displaylogin" target="_blank">myNEU</a></li><li><a href="https://prod-web.neu.edu/webapp6/employeelookup/public/main.action" target="_blank">Find Faculty &amp; Staff</a></li><li><a href="http://www.northeastern.edu/neuhome/adminlinks/findaz.html" target="_blank">Find A-Z</a></li><li><a href="http://www.northeastern.edu/emergency/index.html" target="_blank">Emergency Information</a></li><li><a href="http://www.northeastern.edu/search/index.html" target="_blank">Search</a></li></ul><address>360 Huntington Ave., Boston, Massachusetts 02115 · 617.373.2000 ·  TTY 617.373.3768<br><span class="fa fa-copyright"></span> '.date('Y').' Northeastern University</address></div><div class="col-md-3"><ul class="nu-social"><li><a class="youtube" href="https://www.youtube.com/northeastern" target="_blank"><span class="sr-only">Northern University on YouTube</span><span aria-hidden="" class="fa fa-youtube"></span></a></li><li><a class="twitter" href="http://twitter.com/northeastern" target="_blank"><span class="sr-only">Northern University on Twitter</span><span aria-hidden="" class="fa fa-twitter"></span></a></li><li><a class="facebook" href="http://www.facebook.com/northeastern" target="_blank"><span class="sr-only">Northeastern on Facebook</span><span aria-hidden="" class="fa fa-facebook"></span></a></li></ul></div>';
    return $footer;
  }

  /*disables comments on all attachment pages*/
  function filter_media_comment_status( $open, $post_id ) {
  	$post = get_post( $post_id );
  	if( $post->post_type == 'attachment' ) {
  		return false;
  	}
  	return $open;
  }
  add_filter( 'comments_open', 'filter_media_comment_status', 10 , 2 );


  /* adds toolkit main menu and assigns to primary*/
  add_action('init', 'drs_main_menu');
  function drs_main_menu() {
    $new_menu_id = wp_create_nav_menu('DRS Main Menu');
  	$page_args_1 = array(
      'menu-item-url' => site_url().'/search',
  		'menu-item-title' => get_option('drstk_search_page_title') == '' ? 'Search' : get_option('drstk_search_page_title'),
  		'menu-item-status' => 'publish',
  	);
    $page_args_2 = array(
      'menu-item-url' => site_url().'/browse',
      'menu-item-title' => get_option('drstk_browse_page_title') == '' ? 'Browse' : get_option('drstk_browse_page_title'),
      'menu-item-status' => 'publish',
    );
    $page_args_3 = array(
      'menu-item-url' => site_url().'/collections',
      'menu-item-title' => get_option('drstk_collections_page_title') == '' ? 'Collections' : get_option('drstk_collections_page_title'),
      'menu-item-status' => 'publish',
    );
  	if ( $new_menu_id > 0 ) {
  		// set our new MENU up at our theme's nav menu location
      if ( !has_nav_menu( 'primary' ) ) {
        set_theme_mod( 'nav_menu_locations' , array( 'primary' => $new_menu_id ) );
      }
  		// add a menu item to that new menu
  		wp_update_nav_menu_item( $new_menu_id , 0, $page_args_1 );
      wp_update_nav_menu_item( $new_menu_id , 0, $page_args_2 );
      wp_update_nav_menu_item( $new_menu_id , 0, $page_args_3 );
  	}
  }

  /*adds analytics*/
  add_action('wp_footer', 'add_google_analytics');
  function add_google_analytics(){
    require_once( get_stylesheet_directory() . '/analytics.php' );
  }

  /*overrides quest_page_title in template_tags to add custom DRSTK titles*/
  function quest_page_title() {
    global $wp_query;
    $template_type = $wp_query->query_vars['drstk_template_type'];
    $search_title = get_option('drstk_search_page_title') == '' ? 'Search' : get_option('drstk_search_page_title');
    $browse_title = get_option('drstk_browse_page_title') == '' ? 'Browse' : get_option('drstk_browse_page_title');
    $collections_title = get_option('drstk_collections_page_title') == '' ? 'Collections' : get_option('drstk_collections_page_title');
    $collection_title = get_option('drstk_collection_page_title') == '' ? 'Browse' : get_option('drstk_collection_page_title');

    if ($template_type == 'search'){
      printf( __($search_title, 'quest'));
    } elseif ($template_type == 'browse'){
      printf( __($browse_title, 'quest'));
    } elseif ($template_type == 'collections'){
      printf( __($collections_title, 'quest'));
    } elseif ($template_type == 'collection'){
      printf( __($collection_title, 'quest'));
    } elseif ($template_type == 'item'){
      return;
    } else if ( ( function_exists( 'is_woocommerce' ) && is_woocommerce() && is_product() ) || ( function_exists( 'is_bbpress' ) && is_bbpress() ) ) {
      the_title();
    } else if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
      woocommerce_page_title();
    } else if ( is_archive() ) {
      single_cat_title();
    } else if ( is_home() ) {
      echo get_bloginfo( 'name' );
    } else if ( is_search() ) {
      echo __( 'Search results for: ', 'quest' ) . get_search_query();
    } else {
      the_title();
    }
  }

  /* overries quest_get_view in template_tags to add custom views for DRSTK*/
  function quest_get_view() {

		// Post types
		$post_types   = get_post_types( array( 'public' => true, '_builtin' => false ) );
		$post_types[] = 'post';

		// Post parent
		$parent_post_type = '';
		if ( is_attachment() ) {
			$post_parent      = get_post()->post_parent;
			$parent_post_type = get_post_type( $post_parent );
		}

		$view = 'post';

		// Blog
    global $wp_query;
    $template_type = $wp_query->query_vars['drstk_template_type'];

    if ($template_type == 'search'){
      $view = 'search';
    } elseif ($template_type == 'browse'){
      $view = 'search';
    } elseif ($template_type == 'collections'){
      $view = 'search';
    } elseif ($template_type == 'collection'){
      $view = 'search';
    } elseif ($template_type == 'item'){
      return;
    } elseif ( is_home() ) {
			$view = 'blog';
		} // Archives
		else if ( is_archive() ) {
			$view = 'archive';
		} // Search results
		else if ( is_search() ) {
			$view = 'search';
		} // Posts and public custom post types
		else if ( is_singular( $post_types ) || ( is_attachment() && in_array( $parent_post_type, $post_types ) ) ) {
			$view = 'post';
		} // Pages
		else if ( is_page() || ( is_attachment() && 'page' === $parent_post_type ) ) {
			$view = 'page';
		}

		return $view;
	}
