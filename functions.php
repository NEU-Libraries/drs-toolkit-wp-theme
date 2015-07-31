<?php
add_action( 'wp_enqueue_scripts', 'drs_enqueue_styles' );
function drs_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
//     wp_enqueue_style( 'child-style',
//         get_stylesheet_directory_uri() . '/style.css',
//         array('parent-style')
//     );
}

/*COPIED FROM minamaze/admin/main/options/01.general-settings.php*/
/* Add custom intro section [Extend for more options in future update] */
function drs_custom_intro() {

	if ( ! is_front_page() ) {
		echo	'<div id="intro" class="option1"><div id="intro-core">',
				'<h1 class="page-title"><span>',
				drs_title_select(),
				'</span></h1>',
				thinkup_input_breadcrumbswitch(),
				'</div></div>';
	} else {
		echo '';
	}
}

/*COPIED FROM minamaze/admin/main/options/01.general-settings.php*/
function drs_title_select() {
	global $post;
  global $wp_query;
  $template_type = $wp_query->query_vars['drstk_template_type'];

  if ($template_type == 'search'){
    printf( __('Search', 'lan-thinkupthemes'));
  } elseif ($template_type == 'browse'){
    printf( __('Browse', 'lan-thinkupthemes'));
  } elseif ($template_type == 'collections'){
    printf( __('Collections', 'lan-thinkupthemes'));
  } elseif ($template_type == 'collection'){
    printf( __('Browse', 'lan-thinkupthemes'));
  } elseif ($template_type == 'item'){
    return;
  } elseif ( is_page() ) {
		printf( __( '%s', 'lan-thinkupthemes' ), get_the_title() );
	} elseif ( is_attachment() ) {
		printf( __( 'Blog Post Image: %s', 'lan-thinkupthemes' ), esc_attr( get_the_title( $post->post_parent ) ) );
	} else if ( is_single() ) {
		printf( __( '%s', 'lan-thinkupthemes' ), get_the_title() );
	} else if ( is_search() ) {
		printf( __( 'Search Results: %s', 'lan-thinkupthemes' ), get_search_query() );
	} else if ( is_404() ) {
		printf( __( 'Page Not Found', 'lan-thinkupthemes' ) );
	} else if ( is_category() ) {
		printf( __( 'Category Archives: %s', 'lan-thinkupthemes' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		printf( __( 'Tag Archives: %s', 'lan-thinkupthemes' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		the_post();
		printf( __( 'Author Archives: %s', 'lan-thinkupthemes' ), get_the_author() );
		rewind_posts();
	} elseif ( is_day() ) {
		printf( __( 'Daily Archives: %s', 'lan-thinkupthemes' ), get_the_date() );
	} elseif ( is_month() ) {
		printf( __( 'Monthly Archives: %s', 'lan-thinkupthemes' ), get_the_date( 'F Y' ) );
	} elseif ( is_year() ) {
		printf( __( 'Yearly Archives: %s', 'lan-thinkupthemes' ), get_the_date( 'Y' ) );
	} elseif ( thinkup_is_blog() ) {
		printf( __( 'Blog', 'lan-thinkupthemes' ) );
	} else {
		printf( __( '%s', 'lan-thinkupthemes' ), get_the_title() );
	}
}

/*to overwrite thinkup_input_copyright() from minamaze/admin/main/options/04.footer.php*/
function drs_copyright() {
global $thinkup_footer_copyright;
  echo '<address>360 Huntington Ave., Boston, Massachusetts 02115 · 617.373.2000 ·  TTY 617.373.3768<br>© '.date('Y').' Northeastern University</address>';
  printf( __( '<div>Theme developed by %1$s Powered by %2$s', 'lan-thinkupthemes' ) , '<a href="//www.thinkupthemes.com/" target="_blank">Think Up Themes Ltd</a>.', '<a href="//www.wordpress.org/" target="_blank">Wordpress</a>.</div>');
}

/*adds nu lib logo to header*/
function drs_nu_logo(){
  echo '<a alt="Northeastern University, University Libraries" class="northeastern-logo" href="http://library.northeastern.edu"><img alt="Northeastern University, University Libraries" src="'.get_stylesheet_directory_uri().'/nu-lib-lockup-white.svg" /><span class="sr-only">Northeastern University</span></a>';
}

/*adds nu logo to footer */
function drs_nu_footer_logo(){
  echo '<a alt="Northeastern University, University Libraries" class="northeastern-logo" href="http://www..northeastern.edu"><span class="sr-only">Northeastern University</span></a>';
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

add_action( 'thinkup_sidebar_html', 'drs_sidebar');
function drs_sidebar(){
  global $wp_query;
  $template_type = $wp_query->query_vars['drstk_template_type'];
  if ($template_type == 'search'){
    echo '<div id="sidebar"><div id="sidebar-core"></div></div>';
  }
}

add_action('init', 'drs_main_menu');
function drs_main_menu() {

  $new_menu_id = wp_create_nav_menu('Main Menu');
	$page_args_1 = array(
    'menu-item-url' => '/search',
		'menu-item-title' => 'Search',
		'menu-item-status' => 'publish',
	);
  $page_args_2 = array(
    'menu-item-url' => '/browse',
    'menu-item-title' => 'Browse',
    'menu-item-status' => 'publish',
  );
  $page_args_3 = array(
    'menu-item-url' => '/collections',
    'menu-item-title' => 'Collections',
    'menu-item-status' => 'publish',
  );
	if ( $new_menu_id > 0 ) {
		// set our new MENU up at our theme's nav menu location
    if ( !has_nav_menu( 'header_menu' ) ) {
      set_theme_mod( 'nav_menu_locations' , array( 'header_menu' => $new_menu_id ) );
    }
		// add a menu item to that new menu
		wp_update_nav_menu_item( $new_menu_id , 0, $page_args_1 );
    wp_update_nav_menu_item( $new_menu_id , 0, $page_args_2 );
    wp_update_nav_menu_item( $new_menu_id , 0, $page_args_3 );
	}
}

add_action('init', 'drs_nu_footer_menu');
function drs_nu_footer_menu() {

  $new_menu_id = wp_create_nav_menu('NU Footer Menu');
	$page_args_1 = array(
    'menu-item-url' => 'http://myneu.neu.edu/cp/home/displaylogin',
		'menu-item-title' => 'myNEU',
		'menu-item-status' => 'publish',
	);
  $page_args_2 = array(
    'menu-item-url' => 'https://prod-web.neu.edu/webapp6/employeelookup/public/main.action',
    'menu-item-title' => 'Find Faculty & Staff',
    'menu-item-status' => 'publish',
  );
  $page_args_3 = array(
    'menu-item-url' => 'http://www.northeastern.edu/neuhome/adminlinks/findaz.html',
    'menu-item-title' => 'Find A-Z',
    'menu-item-status' => 'publish',
  );
  $page_args_4 = array(
    'menu-item-url' => 'http://www.northeastern.edu/emergency/index.html',
    'menu-item-title' => 'Emergency Information',
    'menu-item-status' => 'publish',
  );
  $page_args_5 = array(
    'menu-item-url' => 'http://www.northeastern.edu/search/index.html',
    'menu-item-title' => 'Search',
    'menu-item-status' => 'publish',
  );
	if ( $new_menu_id > 0 ) {
		// set our new MENU up at our theme's nav menu location
    if ( !has_nav_menu( 'sub_footer_menu' ) ) {
      set_theme_mod( 'nav_menu_locations' , array( 'sub_footer_menu' => $new_menu_id ) );
    }
		// add a menu item to that new menu
		wp_update_nav_menu_item( $new_menu_id , 0, $page_args_1 );
    wp_update_nav_menu_item( $new_menu_id , 0, $page_args_2 );
    wp_update_nav_menu_item( $new_menu_id , 0, $page_args_3 );
    wp_update_nav_menu_item( $new_menu_id , 0, $page_args_4 );
    wp_update_nav_menu_item( $new_menu_id , 0, $page_args_5 );

	}
}

add_action('wp_footer', 'add_google_analytics');
function add_google_analytics(){
  require_once( get_stylesheet_directory() . '/analytics.php' );
}
