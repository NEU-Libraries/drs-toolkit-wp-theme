<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Quest
 */

/**
 * Filter Footer container class
 */
$footer_container_cls = apply_filters( 'quest_footer_container_cls', 'container' );

?>

<?php if ( is_active_sidebar( 'footer-widget' ) ) : ?>
  <footer class="quest-row main-footer">
    <div class="<?php echo $footer_container_cls; ?>">
      <div class="row">
        <?php dynamic_sidebar( 'footer-widget' ); ?>
      </div>
    </div>
  </footer>
<?php endif; ?>

<?php do_action('add_first_footer'); ?>

<footer id="colophon" class="copyright quest-row" role="contentinfo">
  <div class="<?php echo $footer_container_cls; ?>">
    <div class="row">
      <div class="col-md-12 copyright-text">
        <?php do_action('add_second_footer'); ?>
      </div>
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</footer> <!-- end quest-row -->

</div><!-- #page -->

<?php wp_footer(); ?>

<a href="#0" class="cd-top" title="Back to top"><i class="fa fa-angle-up"></i><span class="sr-only">Back to top</span></a>

</body>
</html>
