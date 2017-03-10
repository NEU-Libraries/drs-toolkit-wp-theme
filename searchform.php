<?php
/**
 * The template for displaying search form.
 *
 * @package Quest
 */

$home_func = (function_exists('drstk_home_url')) ? 'drstk_home_url' : 'home_url';

?>
<form class="search" action="<?php echo esc_url($home_func('/search/')); ?>" method="get">
  <fieldset>
    <legend class="sr-only">Search</legend>
    <div class="text">
      <label for="q" class="sr-only">Search</label>
      <input name="q" id="drs-input" type="text" placeholder="<?php esc_attr( _e( get_option('drstk_search_placeholder') == '' ? 'Search ...' : get_option('drstk_search_placeholder'), 'quest' ) ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>"/>
      <button class="fa fa-search"><?php _e( 'Search', 'quest' ) ?></button>
    </div>
  </fieldset>
</form>
