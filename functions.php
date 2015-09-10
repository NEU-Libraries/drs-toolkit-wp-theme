<?php
  add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
  function theme_enqueue_styles() {
     wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  }

  function quest_get_footer_copyright(){
    $footer = '<div class="col-md-3"><a alt="Northeastern University" class="northeastern-logo" href="http://www.northeastern.edu"><span class="sr-only">Northeastern University</span></a></div><div class="col-md-6"><ul class="nav nav-pills nav-justified"><li><a href="http://myneu.neu.edu/cp/home/displaylogin" target="_blank">myNEU</a></li><li><a href="https://prod-web.neu.edu/webapp6/employeelookup/public/main.action" target="_blank">Find Faculty &amp; Staff</a></li><li><a href="http://www.northeastern.edu/neuhome/adminlinks/findaz.html" target="_blank">Find A-Z</a></li><li><a href="http://www.northeastern.edu/emergency/index.html" target="_blank">Emergency Information</a></li><li><a href="http://www.northeastern.edu/search/index.html" target="_blank">Search</a></li></ul><address>360 Huntington Ave., Boston, Massachusetts 02115 · 617.373.2000 ·  TTY 617.373.3768<br><span class="fa fa-copyright"></span> '.date('Y').' Northeastern University</address></div><div class="col-md-3"><ul class="nu-social"><li><a class="youtube" href="https://www.youtube.com/northeastern" target="_blank"><span class="sr-only">Northern University on YouTube</span><span aria-hidden="" class="fa fa-youtube"></span></a></li><li><a class="twitter" href="http://twitter.com/northeastern" target="_blank"><span class="sr-only">Northern University on Twitter</span><span aria-hidden="" class="fa fa-twitter"></span></a></li><li><a class="facebook" href="http://www.facebook.com/northeastern" target="_blank"><span class="sr-only">Northeastern on Facebook</span><span aria-hidden="" class="fa fa-facebook"></span></a></li></ul></div>';
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
