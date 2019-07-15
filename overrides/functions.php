<?php
/**
 * Deal with the custom RSS templates.
 */
function my_custom_rss() {
  load_template( dirname( __FILE__ ) . '/whatsnewfeed.php' );
}
remove_all_actions( 'do_feed_rss2' );
add_action( 'do_feed_rss2', 'my_custom_rss', 10, 1 );
