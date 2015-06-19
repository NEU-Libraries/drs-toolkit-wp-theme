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
  printf( __('<address>360 Huntington Ave., Boston, Massachusetts 02115 · 617.373.2000 ·  TTY 617.373.3768<br>© 2013 Northeastern University</address>'));
  printf( __( '<div>Theme developed by %1$s. Powered by %2$s.', 'lan-thinkupthemes' ) , '<a href="//www.thinkupthemes.com/" target="_blank">Think Up Themes Ltd</a>', '<a href="//www.wordpress.org/" target="_blank">Wordpress</a></div>');
}

/*adds nu logo to footer */
function drs_nu_logo(){
  echo '<a alt="Northeastern University" class="northeastern-logo" href="http://www.northeastern.edu"><span class="sr-only">Northeastern University</span></a>';
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
