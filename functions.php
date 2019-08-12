<?php
  global $quest_child_defaults;
  $quest_child_defaults['colors_footer_link'] = '#FFF';
  $quest_child_defaults['colors_footer_link_hover'] = '#eaa5a5';
  $quest_child_defaults['colors_footer_dsg_bg'] = '#494949';
  $quest_child_defaults['colors_footer_dsg_color'] = 'rgb(212, 215, 217)';
  $quest_child_defaults['colors_galleries_link'] = '#c00';
  $quest_child_defaults['colors_galleries_caption_bg'] = '#FFF'; //'#f5f5f5';
  $quest_child_defaults['layout_global_breadcrumb'] = 'yes';
  $quest_child_defaults['colors_footer_nulogo'] = 'nu-light';
  $quest_child_defaults['colors_header_nulogo'] = 'nu-light';
  $quest_child_defaults['colors_global_button_bg'] = '#c00';
  $quest_child_defaults['colors_global_button_color'] = '#FFF';
  $quest_child_defaults['colors_panels_color'] = '#333';
  $quest_child_defaults['colors_panels_bg_color'] = '#FFF';
  $quest_child_defaults['colors_panels_border_color'] = '#ddd';
  $quest_child_defaults['colors_panels_header_color'] = '#333';
  $quest_child_defaults['colors_panels_header_bg_color'] = '#f5f5f5';
  $quest_child_defaults['colors_sidebar_bg_color'] = '#FFF';
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
  $quest_child_defaults['choices']['layout_global_breadcrumb'] = array(
      "yes" => __("Yes", "quest"),
      "no" => __("No", "quest"),
  );


  /**
   * Enqueue scripts and styles.
   */
  function quest_scripts() {
		if( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
			// Enqueue required styles
			wp_enqueue_style( 'quest-bootstrap', get_template_directory_uri() . '/assets/plugins/bootstrap/css/bootstrap.min.css' );
			wp_enqueue_style( 'smartmenus', get_template_directory_uri() . '/assets/plugins/smartmenus/addons/bootstrap/jquery.smartmenus.bootstrap.css' );
			wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/plugins/font-awesome/css/font-awesome.min.css' );
			wp_enqueue_style( 'animate-css', get_template_directory_uri() . '/assets/plugins/animate/animate.css' );
			wp_enqueue_style( 'slit-slider', get_template_directory_uri() . '/assets/plugins/FullscreenSlitSlider/css/style.css' );
			wp_enqueue_style( 'colorbox', get_template_directory_uri() . '/assets/plugins/colorbox/colorbox.css' );
			wp_enqueue_style( 'Quest-style', get_stylesheet_uri(), array(
				'quest-bootstrap',
				'smartmenus',
				'font-awesome',
				'animate-css',
				'slit-slider',
				'colorbox'
			) );

			// Enqueue required scripts
			wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/plugins/modernizr/modernizr.custom.js' );
			wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/plugins/bootstrap/js/bootstrap.js', array(
				'jquery',
				'masonry'
			) );
			wp_enqueue_script( 'smoothscroll', get_template_directory_uri() . '/assets/plugins/smoothscroll/SmoothScroll.js' );
			wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/plugins/wow/wow.min.js' );
			wp_enqueue_script( 'ba-cond', get_template_directory_uri() . '/assets/plugins/FullscreenSlitSlider/js/jquery.ba-cond.js', array( 'jquery' ) );
			wp_enqueue_script( 'slit-slider', get_template_directory_uri() . '/assets/plugins/FullscreenSlitSlider/js/jquery.slitslider.js' );
			wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/assets/plugins/colorbox/jquery.colorbox-min.js', array( 'jquery' ) );
			wp_enqueue_script( 'imagesloaded', get_template_directory_uri() . '/assets/plugins/imagesloaded/imagesloaded.pkgd.js', array( 'jquery' ) );
			wp_enqueue_script( 'smartmenus', get_template_directory_uri() . '/assets/plugins/smartmenus/jquery.smartmenus.js' );
			wp_enqueue_script( 'bs-smartmenus', get_template_directory_uri() . '/assets/plugins/smartmenus/addons/bootstrap/jquery.smartmenus.bootstrap.js' );
			wp_enqueue_script( 'smartmenus-keyboard', get_template_directory_uri() . '/assets/plugins/smartmenus/addons/keyboard/jquery.smartmenus.keyboard.js' );
			wp_enqueue_script( 'quest-js', get_template_directory_uri() . '/assets/js/quest.js' );

		} else {

			// Enqueue required styles
			wp_enqueue_style( 'quest-all-css', get_template_directory_uri() . '/assets/css/plugins-all.min.css' );
			wp_enqueue_style( 'Quest-style', get_stylesheet_uri(), array( 'quest-all-css' ) );
			
			// Enqueue required scripts
			wp_enqueue_script( 'quest-all-js', get_template_directory_uri() . '/assets/js/quest-and-plugins.js', array(
				'jquery',
				'masonry'
			) );
		}

 		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
 			wp_enqueue_script( 'comment-reply' );
 		}

 	}

  add_action( 'wp_enqueue_scripts', 'quest_scripts' );

  function theme_enqueue_styles() {

    // quest-child css and scripts should load before the overrides css and js
    wp_register_script('header-helper', get_stylesheet_directory_uri() . '/scripts.js', array( 'jquery' ));
    wp_register_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('parent-style');
    wp_enqueue_script('header-helper', array('jquery'));

    // check for custom override javascript
    if (file_exists(dirname(__FILE__) . '/overrides/scripts.js')) {
      wp_register_script('override-js', get_stylesheet_directory_uri() . '/overrides/scripts.js', array( 'jquery' ));
      wp_enqueue_script('override-js', array('jquery'));
    } elseif (file_exists(dirname(__FILE__).'/overrides.js')){
      wp_register_script('override-js', get_stylesheet_directory_uri() . '/overrides.js', array( 'jquery' ));
      wp_enqueue_script('override-js', array('jquery'));
    }

    // check for custom override styles
    if (file_exists(dirname(__FILE__) . '/overrides/style.css')) {
      wp_register_style('override-style', get_stylesheet_directory_uri() . '/overrides/style.css', array('quest-all-css', 'Quest-style'));
      wp_enqueue_style('override-style');
    } elseif (file_exists(dirname(__FILE__) . '/overrides.css')) {
      wp_register_style('override-style', get_stylesheet_directory_uri() . '/overrides.css', array('quest-all-css', 'Quest-style'));
      wp_enqueue_style('override-style');
    }

  }
  add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

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
    $home_func = (function_exists(drstk_home_url)) ? 'drstk_home_url' : 'home_url';
    $new_menu_id = wp_create_nav_menu('DRS Main Menu');
    $page_args_1 = array(
      'menu-item-url' => $home_func('/search/'),
      'menu-item-title' => get_option('drstk_search_page_title') == '' ? 'Search' : get_option('drstk_search_page_title'),
      'menu-item-status' => 'publish',
    );
    $page_args_2 = array(
      'menu-item-url' => $home_func('/browse/'),
      'menu-item-title' => get_option('drstk_browse_page_title') == '' ? 'Browse' : get_option('drstk_browse_page_title'),
      'menu-item-status' => 'publish',
    );
    $page_args_3 = array(
      'menu-item-url' => $home_func('/collections/'),
      'menu-item-title' => get_option('drstk_collections_page_title') == '' ? 'Collections' : get_option('drstk_collections_page_title'),
      'menu-item-status' => 'publish',
    );

    /*add stock credits page */

    global $user_ID;
    $page['post_type']    = 'page';
    $page['post_content'] = "<h3>People</h3><br/><h5>Project Staff</h5>Fill this in with staff members.<h5>Project Alumni</h5>Fill this in with project alumni.<br/><br/><h3>Credit and Copyright</h3><h5>Citing this project</h5>Put information here about how you would like others to cite your group.<h5>Copyright and licensing</h5>Fill in this section after talking to Northeastern's copyright officer. They will help you determine what to put in this section, depending on what rights you own to your content and your own wishes on what people can do with your content.<br/><h3>CERES: Exhibit Toolkit</h3>This project was created on a customized WordPress instance using the <a href='http://dsg.neu.edu/wiki/DSG_DRS_Project_Toolkit' target='_blank'>CERES: Exhibit Toolkit</a>. These tools, as well as archival, hosting, and support systems, are provided by the Northeastern University Library Digital Scholarship group. The DSG specializes in the Digital Humanities and helps faculty, staff, and students in the Northeastern community showcase their projects to the public.";
    $page['post_parent']  = 0;
    $page['post_author']  = $user_ID;
    $page['post_status']  = 'publish';
    $page['post_title']   = 'Credit';
    $page = apply_filters('quest_child_add_new_page', $page, 'teams');
    $pageid = wp_insert_post ($page);

    $page2['post_type'] = 'page';
    $page2['post_content'] = '<div class="row">[drstk_gallery id="neu:rx914h41q, neu:rx914g88d, neu:rx914h14t, neu:rx914f43v" caption="on" caption-align="center" auto="on" nav="on" metadata="full_title_ssi,creator_ssi" max-height="500"]</div><div class="row"><br/><p> &nbsp;  </p><br/></div><div class="row"><div class="col-md-4"><p>Curabitur erat velit, consequat volutpat faucibus ac, lacinia at orci. Fusce commodo urna in nulla rutrum, lacinia ultrices lectus aliquam. Integer arcu augue, mollis eget sapien a, suscipit laoreet sapien. Nunc id molestie nunc, non posuere sem. Sed sodales libero sit amet tincidunt pulvinar. In est nisi, gravida nec velit vitae, tristique aliquet nisi. Proin in lacus at arcu vestibulum elementum</p><p class="text-center"><a href="#" class="btn button">Link Goes Here</a></p></div><div class="col-md-4"><p>Curabitur erat velit, consequat volutpat faucibus ac, lacinia at orci. Fusce commodo urna in nulla rutrum, lacinia ultrices lectus aliquam. Integer arcu augue, mollis eget sapien a, suscipit laoreet sapien. Nunc id molestie nunc, non posuere sem. Sed sodales libero sit amet tincidunt pulvinar. In est nisi, gravida nec velit vitae, tristique aliquet nisi. Proin in lacus at arcu vestibulum elementum</p><p class="text-center"><a href="#" class="btn button">Link Goes Here</a></p></div><div class="col-md-4"><p>Curabitur erat velit, consequat volutpat faucibus ac, lacinia at orci. Fusce commodo urna in nulla rutrum, lacinia ultrices lectus aliquam. Integer arcu augue, mollis eget sapien a, suscipit laoreet sapien. Nunc id molestie nunc, non posuere sem. Sed sodales libero sit amet tincidunt pulvinar. In est nisi, gravida nec velit vitae, tristique aliquet nisi. Proin in lacus at arcu vestibulum elementum</p><p class="text-center"><a href="#" class="btn button">Link Goes Here</a></p></div></div>';
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
    if (file_exists(dirname(__FILE__) . '/analytics.php')) {
      require_once( get_stylesheet_directory() . '/analytics.php' );
    } else {
      echo "<script>function add_google_tracking(){ return; }</script>";
    }
  }

  /*overrides quest_page_title in template_tags to add custom DRSTK titles*/
  function quest_page_title() {
    global $wp_query;
    add_filter('query_vars', 'drstk_add_query_var');
    $template_type = isset($wp_query->query_vars['drstk_template_type']) ? $wp_query->query_vars['drstk_template_type'] : "";
    $search_title = get_option('drstk_search_page_title') == '' ? 'Search' : get_option('drstk_search_page_title');
    $browse_title = get_option('drstk_browse_page_title') == '' ? 'Browse' : get_option('drstk_browse_page_title');
    $collections_title = get_option('drstk_collections_page_title') == '' ? 'Collections' : get_option('drstk_collections_page_title');
    $collection_title = get_option('drstk_collection_page_title') == '' ? 'Browse' : get_option('drstk_collection_page_title');
    $mirador_title = get_option('drstk_mirador_page_title') == '' ? 'Book View' : get_option('drstk_mirador_page_title');

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
    } elseif ($template_type == 'mirador'){
      printf( __($mirador_title, 'quest'));
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
    add_filter('query_vars', 'drstk_add_query_var');
    if (isset($wp_query->query_vars['drstk_template_type'])){
      $template_type = $wp_query->query_vars['drstk_template_type'];
    } else {
      $template_type = '';
    }

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
    global $quest_child_defaults;
    $nulogo_header_color = get_theme_mod( 'colors_header_nulogo', $quest_child_defaults['colors_header_nulogo']);
    
    $html = '';
    $html .= "<header class='secondary-header nu-header'><div class='container'><div class='row'><div class='col-md-6'>";
    
    if (strpos($nulogo_header_color, 'lib') !== false){
      $html .= "<a href='http://library.northeastern.edu' target='_blank' class='northeastern-logo'>";
    } else {
      $html .= "<a href='http://northeastern.edu' target='_blank' class='northeastern-logo'>";
    }
    $html .= "<span class='sr-only'>Northeastern University</span></a></div></div></div></header>";
    //$html .= "<img src='https://library.northeastern.edu/sites/default/files/public/wysiwyg/u-473/2019/nu_library_white.png' 
    //               alt='Northeastern University logo' /></a></div></div></div></header>";
    echo $html;
  }

  /*adds customization colors for footer links, footer nu logo, and header nu logo*/
  add_action( 'customize_register', 'quest_child_customize_register' );
  function quest_child_customize_register($wp_customize) {
    global $quest_child_defaults;

    $section_id = "layout_global";
    $setting_id = $section_id . "_breadcrumb";

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
					'label'    => __( 'Show Breadcrumbs', 'quest' ),
					'section'  => $section_id,
					'settings' => $setting_id,
					'type'     => 'select',
					'choices'  => $quest_child_defaults['choices'][$setting_id]
				)
			)
		);

    $section_id = 'colors_global';
    $setting_id = $section_id . '_button_bg';

		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $quest_child_defaults[$setting_id],
				'type'              => 'theme_mod',
				'sanitize_callback' => 'maybe_hash_hex_color'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'    => __( 'Button Background Color', 'quest' ),
					'section'  => $section_id,
					'settings' => $setting_id,
				)
			)
		);

    $setting_id = $section_id . '_button_color';

    $wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $quest_child_defaults[$setting_id],
				'type'              => 'theme_mod',
				'sanitize_callback' => 'maybe_hash_hex_color'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'    => __( 'Button Text and Border Color', 'quest' ),
					'section'  => $section_id,
					'settings' => $setting_id,
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
				'priority'   => 36,
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

    $panel_id = 'colors';
    $section_id = 'colors_panels';
    $wp_customize->add_section( $section_id,
			array(
				'title'      => __( 'Panels', 'quest' ),
				'priority'   => 36,
				'capability' => 'edit_theme_options',
				'panel'      => $panel_id
			)
		);

    $setting_id = $section_id . '_color';

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
          'label'    => __( 'Text Color', 'quest' ),
          'section'  => $section_id,
          'settings' => $setting_id
        )
      )
    );

    $setting_id = $section_id . '_bg_color';

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
          'label'    => __( 'Background Color', 'quest' ),
          'section'  => $section_id,
          'settings' => $setting_id
        )
      )
    );

    $setting_id = $section_id . '_border_color';

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
          'label'    => __( 'Border Color', 'quest' ),
          'section'  => $section_id,
          'settings' => $setting_id
        )
      )
    );

    $setting_id = $section_id . '_header_color';

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
          'label'    => __( 'Header Text Color', 'quest' ),
          'section'  => $section_id,
          'settings' => $setting_id
        )
      )
    );

    $setting_id = $section_id . '_header_bg_color';

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
          'label'    => __( 'Header Background Color', 'quest' ),
          'section'  => $section_id,
          'settings' => $setting_id
        )
      )
    );

    $panel_id = 'colors';
    $section_id = 'colors_sidebar';
    $wp_customize->add_section( $section_id,
			array(
				'title'      => __( 'Sidebar', 'quest' ),
				'priority'   => 36,
				'capability' => 'edit_theme_options',
				'panel'      => $panel_id
			)
		);

    $setting_id = $section_id . '_bg_color';

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
          'label'    => __( 'Background Color', 'quest' ),
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
    $custom_footer_bg = get_theme_mod( 'colors_footer_dsg_bg', $quest_child_defaults['colors_footer_dsg_bg']);
    $custom_footer_color = get_theme_mod( 'colors_footer_dsg_color', $quest_child_defaults['colors_footer_dsg_color']);
    $nulogo_footer_color = get_theme_mod( 'colors_footer_nulogo', $quest_child_defaults['colors_footer_nulogo']);
    $nulogo_header_color = get_theme_mod( 'colors_header_nulogo', $quest_child_defaults['colors_header_nulogo']);
    
    if (strpos($nulogo_header_color, "lib") !== false) {
        $logo_height = ".nu-header .northeastern-logo{height:70px;}";
    } else {
        $logo_height = ".nu-header .northeastern-logo{height:50px;}";
    }
    
    $btn_color = get_theme_mod( 'colors_global_button_color', $quest_child_defaults['colors_global_button_color']);
    $btn_bg_color = get_theme_mod( 'colors_global_button_bg', $quest_child_defaults['colors_global_button_bg']);
    $panel_color = get_theme_mod( 'colors_panels_color', $quest_child_defaults['colors_panels_color']);
    $panel_bg_color = get_theme_mod( 'colors_panels_bg_color', $quest_child_defaults['colors_panels_bg_color']);
    $panel_border_color = get_theme_mod( 'colors_panels_border_color', $quest_child_defaults['colors_panels_border_color']);
    $panel_header_color = get_theme_mod( 'colors_panels_header_color', $quest_child_defaults['colors_panels_header_color']);
    $panel_header_bg_color = get_theme_mod( 'colors_panels_header_bg_color', $quest_child_defaults['colors_panels_header_bg_color']);
    $sidebar_bg_color = get_theme_mod( 'colors_sidebar_bg_color', $quest_child_defaults['colors_sidebar_bg_color']);
    $link_color = quest_get_mod ('colors_global_accent', quest_get_default('colors_global_accent'));
    $footer_social_color = quest_get_mod( 'colors_footer_sc_si', quest_get_default('colors_footer_sc_si'));
    $footer_social_hover = quest_get_mod( 'colors_footer_sc_si_hover', quest_get_default('colors_footer_sc_si_hover'));
    $alt_color = quest_get_mod( 'colors_global_alt', quest_get_default('colors_global_alt'));
    $text_color = quest_get_mod( 'colors_global_text', quest_get_default('colors_global_text'));
    $accent_color = quest_get_mod( 'colors_global_accent_shade', quest_get_default('colors_global_accent_shade'));
    $breadcrumbs = get_theme_mod( 'layout_global_breadcrumb', $quest_child_defaults['layout_global_breadcrumb']);

    $styleHtml = "<style type='text/css'>";
    $styleHtml .= " footer .nav-pills > li > a, .footer a, .custom-footer a {color: $footer_link_color } ";
    $styleHtml .= " footer .nav-pills > li > a:hover, footer .nav-pills > li > a:focus, .custom-footer p a:hover {color: $footer_link_hover }";
    $styleHtml .= " .nu-social > li > a{color: $footer_social_color}";
    $styleHtml .= " .nu-social > li > a:hover, .nu-social > li > a:focus{color: $footer_social_hover }";
    $styleHtml .= " .cell .info, .brick{ background-color: $gallery_bg_color }";
    $styleHtml .= " .cell .info, .cell .a, .brick, .brick a{ color: $gallery_link_color } ";
    $styleHtml .= " .carousel-caption { background-color:rgba('" . hex2rgb($gallery_bg_color) . " , .8) ' ;}";
    $styleHtml .= " .carousel-indicators .active{background-color: $link_color }";
    $styleHtml .= " .carousel-indicators li {border-color: $link_color }";
    $styleHtml .= " .carousel-control{color: $link_color }";
    $styleHtml .= " .custom-footer {background-color: $custom_footer_bg ; color: $custom_footer_color }";
    $styleHtml .= " figcaption .label{ background-color: $alt_color; color: $text_color } ";
    $styleHtml .= " .drs-item .thumbnail figure .fa{ color: $text_color }";
    $styleHtml .= " footer .northeastern-logo{background-image: url('" .get_stylesheet_directory_uri() . "/images/$nulogo_footer_color.svg);}";
    $styleHtml .= " .nu-header .northeastern-logo{background-image: url('" .get_stylesheet_directory_uri(). "/images/$nulogo_header_color.svg);} "; 
    $styleHtml .= " .$logo_height.btn, .button{color: $btn_color }; ";
    $styleHtml .= " background-color: $btn_bg_color !important;border-color: $btn_color ;} ";
    $styleHtml .= " .button: hover{box-shadow: 0 0 5px $btn_color  !important;} "; 
    $styleHtml .= " .panel-default{border-radius:2px; border-color: $panel_border_color; box-shadow:0 1px 1px rgba('" . hex2rgb($panel_border_color) . " , .5) ' ;}"; 
    $styleHtml .= " .panel-default > .panel-body{color: $panel_color ;background-color: $panel_bg_color }";
    
    
    if ($breadcrumbs == "no"){
      $styleHtml .= ' ul.breadcrumbs{display:none;}';
    }
    $styleHtml .= " .panel-default > .panel-heading { border-color: $panel_border_color ;";
    $styleHtml .= " color: $panel_header_color ; background-color: $panel_header_bg_color ; }";
    $styleHtml .= " #secondary{background-color: $sidebar_bg_color } ";
    $styleHtml .= " .current-menu-item a { color: $accent_color }";
    $styleHtml .= " </style>";
    echo $styleHtml;
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

  add_filter( 'plugin_action_links', 'disable_plugin_deactivation', 10, 4 );
  function disable_plugin_deactivation( $actions, $plugin_file, $plugin_data, $context ) {
    // Remove edit and deactive link for drs-tk plugin
    if ( array_key_exists( 'edit', $actions ) && in_array( $plugin_file, array( 'drs-tk/drs-tk.php'))) unset( $actions['edit'] );
    if ( array_key_exists( 'deactivate', $actions ) && in_array( $plugin_file, array( 'drs-tk/drs-tk.php'))) unset( $actions['deactivate'] );
    return $actions;
   }

 if ( ! function_exists('write_log')) {
  function write_log ( $log )  {
     if ( is_array( $log ) || is_object( $log ) ) {
        error_log( print_r( $log, true ) );
     } else {
        error_log( $log );
     }
  }
}

// remove core Menu Breadcrumb item markup filter
remove_all_filters( 'menu_breadcrumb_item_markup' );

// add my own Menu Breadcrumb item filter
function my_menu_breadcrumb_item_markup( $markup, $breadcrumb ) {
    // $markup is in the format of <a href="{Menu Item URL}">{Menu Item Title}</a>
    // $breadcrumb is the Menu item object itself
    return '<li>' . $markup . '</li>';
}
add_filter( 'menu_breadcrumb_item_markup', 'my_menu_breadcrumb_item_markup', 10, 2 );

// overrides the default breadcrumb behavior -- this allows single pages/posts to have their menu placement reflect their breadcrumb path (not drs items)
function quest_breadcrumb() {
  global $post;

  if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {
    woocommerce_breadcrumb( array(
      'wrap_before' => '<ul class="breadcrumbs">',
      'wrap_after'  => '</ul>',
      'delimiter'   => '',
      'before'      => '<li>',
      'after'       => '</li>'
    ) );

    return;
  }

  if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
    echo '<ul class="breadcrumbs">';
    bbp_breadcrumb( array(
      'delimiter' => '',
      'before'    => '<li>',
      'after'     => '</li>'
    ) );
    echo '</ul>';

    return;
  }


  echo '<ul class="breadcrumbs">';

  if ( ! is_front_page() ) {
    echo '<li><a href="';
    echo home_url();
    echo '">' . __( 'Home', 'quest' );
    echo "</a></li>";
  }

  if ( is_category() || is_single() && ! is_singular( 'portfolio' ) ) {
    $category = get_the_category();
    if ( isset( $category[0] ) ) {
      $ID = $category[0]->cat_ID;
      echo '<li>' . get_category_parents( $ID, true, '', false ) . '</li>';
    }
  }

  if ( is_singular( 'portfolio' ) ) {
    echo get_the_term_list( $post->ID, 'portfolio_category', '<li>', ' - ', '</li>' );
  }
  if ( is_home() ) {
    echo '<li>' . get_option( 'blog_title', 'Blog' ) . '</li>';
  }
  if ( is_single() || is_page() ) {
    //this is the only part modified from this function
    $breadcrumb = array();
  	// Get current page
    $current = $post;

  	// Check if current post has ancestors
  	if($current->ancestors) {
  		$ancestors = array_reverse($current->ancestors);

  		// Step through ancestors array to build breadcrumb
      if (count($ancestors) > 0){
        foreach($ancestors as $i => $text){
    			$breadcrumb[$i] = '<li><a href="' . get_page_link($text) . '" title="' . esc_attr(apply_filters('the_title', get_the_title($text))) . '">'.get_the_title($text).'</a></li>';
    		}
      }
  	}

  	// Insert a link to the current page
  	$breadcrumb[] = '<li><a href="' . get_page_link($current->ID) . '" title="' . esc_attr(apply_filters('the_title', $current->post_title)) . '">'.get_the_title($current).'</a></li>';

  	// Display breacrumb with demarcator
  	echo implode('', $breadcrumb);
  }
  if ( is_tag() ) {
    echo '<li>' . "Tag: " . single_tag_title( '', false ) . '</li>';
  }
  if ( is_404() ) {
    echo '<li>' . __( "404 - Page not Found", 'quest' ) . '</li>';
  }
  if ( is_search() ) {
    echo '<li>' . __( "Search", 'quest' ) . '</li>';
  }
  if ( is_year() ) {
    echo '<li>' . get_the_time( 'Y' ) . '</li>';
  }

  echo "</ul>";
}

// custom functions.php file allowed in overrides folder
if (file_exists(dirname(__FILE__) . '/overrides/functions.php')) {
  require_once('overrides/functions.php');
}

/* for item appears in */
add_filter('relevanssi_pre_excerpt_content', 'remove_shortcodes', 10, 3);
function remove_shortcodes($content, $post, $query){
  $content = preg_replace("/\[[^\]]*\]/", " ", $content);
  return $content;
}

/*for search results - strip shortcodes */
add_filter( 'the_content', 'remove_shortcodes_filter', 10 );
function remove_shortcodes_filter( $content ) {
  if (is_search()){
    $content = preg_replace("/\[[^\]]*\]/", " ", $content);
  }
  return $content;
}

/*allows for overrides admin.css*/
function drstk_add_admin_css(){
  if (file_exists(dirname(__FILE__) . '/overrides/admin.css')) {
    wp_register_style('override-admin-style', get_stylesheet_directory_uri() . '/overrides/admin.css' );
    wp_enqueue_style('override-admin-style');
  }
}
add_action('admin_enqueue_scripts', 'drstk_add_admin_css', 20);

function drstk_remove_core_updates(){
  global $wp_version;
  
  $updateObject = (object) array(
      'last_checked'=> time(),
      'version_checked'=> $wp_version,
      'locale' => 'en-US',
      'current' => '',
      'updates' => array(),
      
  );
  return $updateObject;
}
add_filter('pre_site_transient_update_core','drstk_remove_core_updates');
//add_filter('pre_site_transient_update_plugins','drstk_remove_core_updates');
//add_filter('pre_site_transient_update_themes','drstk_remove_core_updates');
