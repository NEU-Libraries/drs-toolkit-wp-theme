<?php
  global $quest_child_defaults;
  $quest_child_defaults['colors_footer_link'] = '#d44040';
  $quest_child_defaults['colors_footer_link_hover'] = '#c00';
  $quest_child_defaults['colors_footer_dsg_bg'] = '#494949';
  $quest_child_defaults['colors_footer_dsg_color'] = 'rgb(212, 215, 217)';
  $quest_child_defaults['colors_galleries_link'] = '#c00';
  $quest_child_defaults['colors_galleries_caption_bg'] = '#FFF'; //'#f5f5f5';
  $quest_child_defaults['colors_footer_nulogo'] = 'nu-light';
  $quest_child_defaults['colors_header_nulogo'] = 'nu-light';
  $quest_child_defaults['colors_global_button_bg'] = '#FFF';
  $quest_child_defaults['colors_global_button_color'] = '#c00';
  $quest_child_defaults['choices'] = array();
  $quest_child_defaults['choices']['colors_footer_nulogo'] = array(
			'nu-light'   => __( 'Northeastern Logo- light', 'quest' ),
			'nu-dark' => __( 'Northeastern Logo- dark', 'quest' )
		);
  $quest_child_defaults['choices']['colors_header_nulogo'] = array(
  		'lib-light'   => __( 'Library Logo- light', 'quest' ),
  		'lib-dark' => __( 'Library Logo-dark', 'quest' ),
      'nu-light'   => __( 'Northeastern Logo- light', 'quest' ),
  		'nu-dark' => __( 'Northeastern Logo- dark', 'quest' ),
  	);


  add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
  function theme_enqueue_styles() {
     wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
     wp_enqueue_style( 'override-style', get_stylesheet_directory_uri() . '/overrides.css' );
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
  add_action('switch_theme', 'drs_main_menu');
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

    /*add stock credits page */

    global $user_ID;
    $page['post_type']    = 'page';
    $page['post_content'] = "<h3>People</h3><br/><h5>Project Staff</h5>Fill this in with staff members.<h5>Project Alumni</h5>Fill this in with project alumni.<br/><br/><h3>Credit and Copyright</h3><h5>Citing this project</h5>Put information here about how you would like others to cite your group.<h5>Copyright and licensing</h5>Fill in this section after talking to Northeastern's copyright officer. They will help you determine what to put in this section, depending on what rights you own to your content and your own wishes on what people can do with your content.<br/><h3>DRS Project Toolkit</h3>This project was created on a customized WordPress instance using the <a href='http://dsg.neu.edu/wiki/DSG_DRS_Project_Toolkit' target='_blank'>DRS Project Toolkit</a>. These tools, as well as archival, hosting, and support systems, are provided by the Northeastern University Library Digital Scholarship group. The DSG specializes in the Digital Humanities and helps faculty, staff, and students in the Northeastern community showcase their projects to the public.";
    $page['post_parent']  = 0;
    $page['post_author']  = $user_ID;
    $page['post_status']  = 'publish';
    $page['post_title']   = 'Credit';
    $page = apply_filters('quest_child_add_new_page', $page, 'teams');
    $pageid = wp_insert_post ($page);

    $page2['post_type'] = 'page';
    $page2['post_content'] = '<div class="row">[drstk_gallery id="neu:rx914h41q, neu:rx914g88d, neu:rx914h14t, neu:rx914f43v" caption="on" caption-align="center" auto="on" nav="on" metadata="Title,Creator" max-height="500"]</div><div class="row"><br/><p> &nbsp;  </p><br/></div><div class="row"><div class="col-md-4"><p>Curabitur erat velit, consequat volutpat faucibus ac, lacinia at orci. Fusce commodo urna in nulla rutrum, lacinia ultrices lectus aliquam. Integer arcu augue, mollis eget sapien a, suscipit laoreet sapien. Nunc id molestie nunc, non posuere sem. Sed sodales libero sit amet tincidunt pulvinar. In est nisi, gravida nec velit vitae, tristique aliquet nisi. Proin in lacus at arcu vestibulum elementum</p><p class="text-center"><a href="#" class="btn button">Link Goes Here</a></p></div><div class="col-md-4"><p>Curabitur erat velit, consequat volutpat faucibus ac, lacinia at orci. Fusce commodo urna in nulla rutrum, lacinia ultrices lectus aliquam. Integer arcu augue, mollis eget sapien a, suscipit laoreet sapien. Nunc id molestie nunc, non posuere sem. Sed sodales libero sit amet tincidunt pulvinar. In est nisi, gravida nec velit vitae, tristique aliquet nisi. Proin in lacus at arcu vestibulum elementum</p><p class="text-center"><a href="#" class="btn button">Link Goes Here</a></p></div><div class="col-md-4"><p>Curabitur erat velit, consequat volutpat faucibus ac, lacinia at orci. Fusce commodo urna in nulla rutrum, lacinia ultrices lectus aliquam. Integer arcu augue, mollis eget sapien a, suscipit laoreet sapien. Nunc id molestie nunc, non posuere sem. Sed sodales libero sit amet tincidunt pulvinar. In est nisi, gravida nec velit vitae, tristique aliquet nisi. Proin in lacus at arcu vestibulum elementum</p><p class="text-center"><a href="#" class="btn button">Link Goes Here</a></p></div></div>';
    $page2['post_parent']  = 0;
    $page2['post_author']  = $user_ID;
    $page2['post_status']  = 'publish';
    $page2['post_title']   = 'Home';
    $page2 = apply_filters('quest_child_add_new_page', $page2, 'teams');
    $pageid2 = wp_insert_post ($page2);
    update_option( 'page_on_front', $pageid2 );
    update_option( 'show_on_front', 'page' );

  	if ( $new_menu_id > 0 ) {
  		// set our new MENU up at our theme's nav menu location
      if ( !has_nav_menu( 'primary' ) ) {
        set_theme_mod( 'nav_menu_locations' , array( 'primary' => $new_menu_id ) );
      }
  		// add a menu item to that new menu
  		wp_update_nav_menu_item( $new_menu_id , 0, $page_args_1 );
      wp_update_nav_menu_item( $new_menu_id , 0, $page_args_2 );
      wp_update_nav_menu_item( $new_menu_id , 0, $page_args_3 );
      if ($pageid == 0) { /* Add Page Failed */ } {
        $page_path = get_page_uri($pageid);
        $page_args_4 = array(
          'menu-item-object' => 'page',
          'menu-item-title' => 'Credit',
          'menu-item-object-id' => $pageid,
          'menu-item-type' => 'post_type',
          'menu-item-status' => 'publish',
        );
        wp_update_nav_menu_item( $new_menu_id, 0, $page_args_4 );
      }
  	}
  }

  /*adds analytics*/
  add_action('wp_footer', 'add_google_analytics');
  function add_google_analytics(){
    require_once( get_stylesheet_directory() . '/analytics.php' );
  }

  /*adds custom DSG footer*/
  function add_dsg_footer(){
    $dsgfooter = '<div class="dsg-footer"><div class="container"><div class="row"><div class="col-sm-12"><p>This project was created using the <a href="https://github.com/NEU-Libraries/drs-toolkit-wp-plugin" target="_blank">DRS Project Toolkit</a> with help from the <a href="http://dsg.neu.edu" target="_blank">Digital Scholarship Group</a> at the <a href="http://library.northeastern.edu" target="_blank">Northeastern University Library</a>.</p></div></div></div></div>';
    echo $dsgfooter;
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

  /*adds NU LOGO to header */
  add_action( 'quest_before_header', 'nu_before_header', 10, 0 );
  function nu_before_header(){
    echo "<header class='secondary-header nu-header'><div class='container'><div class='row'><div class='col-md-6'><a href='http://northeastern.edu' target='_blank' class='northeastern-logo'></a></div></div></div></header>";
  }

  /*adds customization colors for footer links, footer nu logo, and header nu logo*/
  add_action( 'customize_register', 'quest_child_customize_register' );
  function quest_child_customize_register($wp_customize) {
    global $quest_child_defaults;

    $section_id = 'colors_global';
    $setting_id = $section_id . '_button_bg';

		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $quest_child_defaults[$setting_id],
				'type'              => 'theme_mod',
				'sanitize_callback' => 'quest_child_sanitize_choice'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'    => __( 'Button Background Color', 'quest' ),
					'section'  => $section_id,
					'settings' => $setting_id,
					'type'     => 'select',
					'choices'  => $quest_child_defaults['choices'][$setting_id]
				)
			)
		);

    $setting_id = $section_id . '_button_color';

		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $quest_child_defaults[$setting_id],
				'type'              => 'theme_mod',
				'sanitize_callback' => 'quest_child_sanitize_choice'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'    => __( 'Button Text and Border Color', 'quest' ),
					'section'  => $section_id,
					'settings' => $setting_id,
					'type'     => 'select',
					'choices'  => $quest_child_defaults['choices'][$setting_id]
				)
			)
		);

    $section_id = 'colors_header';
    $setting_id = $section_id . '_nulogo';

		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $quest_child_defaults[$setting_id],
				'type'              => 'theme_mod',
				'sanitize_callback' => 'quest_child_sanitize_choice'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'    => __( 'NU Logo Color', 'quest' ),
					'section'  => $section_id,
					'settings' => $setting_id,
					'type'     => 'select',
					'choices'  => $quest_child_defaults['choices'][$setting_id]
				)
			)
		);

    $section_id = 'colors_footer';
    $setting_id = $section_id . '_nulogo';

		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $quest_child_defaults[$setting_id],
				'type'              => 'theme_mod',
				'sanitize_callback' => 'quest_child_sanitize_choice'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'    => __( 'NU Logo Color', 'quest' ),
					'section'  => $section_id,
					'settings' => $setting_id,
					'type'     => 'select',
					'choices'  => $quest_child_defaults['choices'][$setting_id]
				)
			)
		);

    $setting_id = $section_id . '_link';

    $wp_customize->add_setting(
      $setting_id,
      array(
        'default'           => $quest_child_defaults[$setting_id],
        'type'              => 'theme_mod',
        'sanitize_callback' => 'maybe_hash_hex_color',
      )
    );
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        $setting_id,
        array(
          'label'    => __( 'Link Color', 'quest' ),
          'section'  => $section_id,
          'settings' => $setting_id
        )
      )
    );

    $setting_id = $section_id . '_link_hover';

    $wp_customize->add_setting(
      $setting_id,
      array(
        'default'           => $quest_child_defaults[$setting_id],
        'type'              => 'theme_mod',
        'sanitize_callback' => 'maybe_hash_hex_color',
      )
    );
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        $setting_id,
        array(
          'label'    => __( 'Link Hover Color', 'quest' ),
          'section'  => $section_id,
          'settings' => $setting_id
        )
      )
    );

    $setting_id = $section_id . '_dsg_bg';

    $wp_customize->add_setting(
      $setting_id,
      array(
        'default'           => $quest_child_defaults[$setting_id],
        'type'              => 'theme_mod',
        'sanitize_callback' => 'maybe_hash_hex_color',
      )
    );
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        $setting_id,
        array(
          'label'    => __( 'DSG Footer Background Color', 'quest' ),
          'section'  => $section_id,
          'settings' => $setting_id
        )
      )
    );

    $setting_id = $section_id . '_dsg_color';

    $wp_customize->add_setting(
      $setting_id,
      array(
        'default'           => $quest_child_defaults[$setting_id],
        'type'              => 'theme_mod',
        'sanitize_callback' => 'maybe_hash_hex_color',
      )
    );
    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        $setting_id,
        array(
          'label'    => __( 'DSG Footer Text Color', 'quest' ),
          'section'  => $section_id,
          'settings' => $setting_id
        )
      )
    );

    $panel_id = 'colors';
    $section_id = 'colors_galleries';
    $wp_customize->add_section( $section_id,
			array(
				'title'      => __( 'Galleries', 'quest' ),
				'priority'   => 35,
				'capability' => 'edit_theme_options',
				'panel'      => $panel_id
			)
		);
    $setting_id = $section_id . '_link';

    $wp_customize->add_setting(
      $setting_id,
      array(
        'default'           => $quest_child_defaults[$setting_id],
        'type'              => 'theme_mod',
        'sanitize_callback' => 'maybe_hash_hex_color',
      )
    );

    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        $setting_id,
        array(
          'label'    => __( 'Link Color', 'quest' ),
          'section'  => $section_id,
          'settings' => $setting_id
        )
      )
    );

    $setting_id = $section_id . '_caption_bg';

    $wp_customize->add_setting(
      $setting_id,
      array(
        'default'           => $quest_child_defaults[$setting_id],
        'type'              => 'theme_mod',
        'sanitize_callback' => 'maybe_hash_hex_color',
      )
    );

    $wp_customize->add_control(
      new WP_Customize_Color_Control(
        $wp_customize,
        $setting_id,
        array(
          'label'    => __( 'Caption Background Color', 'quest' ),
          'section'  => $section_id,
          'settings' => $setting_id
        )
      )
    );
  }

/* spits out css with custom variables */
  add_action('wp_head', 'quest_child_add_css');
  function quest_child_add_css(){
    global $quest_child_defaults;
    $footer_link_color = get_theme_mod( 'colors_footer_link', $quest_child_defaults['colors_footer_link']);
    $footer_link_hover = get_theme_mod( 'colors_footer_link_hover', $quest_child_defaults['colors_footer_link_hover']);
    $gallery_bg_color = get_theme_mod( 'colors_galleries_caption_bg', $quest_child_defaults['colors_galleries_caption_bg']);
    $gallery_link_color = get_theme_mod( 'colors_galleries_link', $quest_child_defaults['colors_galleries_link']);
    $dsg_footer_bg = get_theme_mod( 'colors_footer_dsg_bg', $quest_child_defaults['colors_footer_dsg_bg']);
    $dsg_footer_color = get_theme_mod( 'colors_footer_dsg_color', $quest_child_defaults['colors_footer_dsg_color']);
    $nulogo_footer_color = get_theme_mod( 'colors_footer_nulogo', $quest_child_defaults['colors_footer_nulogo']);
    $nulogo_header_color = get_theme_mod( 'colors_header_nulogo', $quest_child_defaults['colors_header_nulogo']);
    if (strpos($nulogo_header_color, "lib") !== false){ $logo_height = ".nu-header .northeastern-logo{height:70px;}";} else {$logo_height = ".nu-header .northeastern-logo{height:50px;}";}
    $btn_color = get_theme_mod( 'colors_global_button_color', $quest_child_defaults['colors_global_button_color']);
    $link_color = quest_get_mod ('colors_global_accent', quest_get_default('colors_global_accent'));
    $footer_social_color = quest_get_mod( 'colors_footer_sc_si', quest_get_default('colors_footer_sc_si'));
    $footer_social_hover = quest_get_mod( 'colors_footer_sc_si_hover', quest_get_default('colors_footer_sc_si_hover'));
    $alt_color = quest_get_mod( 'colors_global_alt', quest_get_default('colors_global_alt'));
    $text_color = quest_get_mod( 'colors_global_text', quest_get_default('colors_global_text'));
    echo '<style type="text/css">footer .nav-pills > li > a, .footer a, .dsg-footer a{color:'.$footer_link_color.'} footer .nav-pills > li > a:hover, footer .nav-pills > li > a:focus, .dsg-footer p a:hover{color:'.$footer_link_hover.'} .nu-social > li > a{color:'.$footer_social_color.'} .nu-social > li > a:hover, .nu-social > li > a:focus{color:'.$footer_social_hover.'} .cell .info, .brick{ background-color:'.$gallery_bg_color.'} .cell .info, .cell .a, .brick, .brick a{ color:'.$gallery_link_color.'}.carousel-caption { background-color:rgba('.hex2rgb($gallery_bg_color).', .8)} .carousel-control{color:'.$link_color.'}.dsg-footer {background-color:'.$dsg_footer_bg.';color:'.$dsg_footer_color.'}figcaption .label{ background-color:'.$alt_color.';color:'.$text_color.'} footer .northeastern-logo{background-image: url('.site_url().'/wp-content/themes/quest-child/images/'.$nulogo_footer_color.'.svg);} .nu-header .northeastern-logo{background-image: url('.site_url().'/wp-content/themes/quest-child/images/'.$nulogo_header_color.'.svg);} '.$logo_height.'.btn{color:'.$btn_color.';}</style>';
  }


  function hex2rgb($hex) {
     $hex = str_replace("#", "", $hex);
     if(strlen($hex) == 3) {
        $r = hexdec(substr($hex,0,1).substr($hex,0,1));
        $g = hexdec(substr($hex,1,1).substr($hex,1,1));
        $b = hexdec(substr($hex,2,1).substr($hex,2,1));
     } else {
        $r = hexdec(substr($hex,0,2));
        $g = hexdec(substr($hex,2,2));
        $b = hexdec(substr($hex,4,2));
     }
     $rgb = array($r, $g, $b);
     return implode(",", $rgb); // returns the rgb values separated by commas
  }

/* moves search from hover icon to plain menu */
  function quest_search_menu_icon( $items, $args ) {
		if ( quest_get_mod( 'layout_header_search' ) && $args->theme_location === 'primary' ) {
			$items .= '<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown" id="menu-item-search">' .
			          get_search_form( false )
			          . '</li>';
		}

		return $items;
	}

  function quest_child_sanitize_choice( $value, $setting ) {
    global $quest_child_defaults;
		if ( is_object( $setting ) ) {
			$setting = $setting->id;
		}
		$options = $quest_child_defaults['choices'][$setting];
		if ( ! in_array( $value, array_keys( $options ) ) ) {
			$value = $quest_child_defaults[$setting];
		}
		return $value;
	}

  function quest_main_cls() {
		$view = quest_get_view();
		$pos  = quest_get_mod( 'layout_' . $view . '_sidebar' );
		if ( $pos === 'none' || !is_active_sidebar('sidebar-1')) {
			echo 'col-md-12';
		} else {
			echo 'col-md-9';
		}
	}
