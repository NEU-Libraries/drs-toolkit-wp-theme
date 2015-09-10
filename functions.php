<?php
  add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
  function theme_enqueue_styles() {
     wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
  }

  function quest_get_footer_copyright(){
    $footer = '<a alt="Northeastern University, University Libraries" class="northeastern-logo" href="http://www.northeastern.edu"><span class="sr-only">Northeastern University</span></a>';
    return $footer;
  }
