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

<div class="custom-footer">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <?php do_action('add_first_footer'); ?>
      </div>
    </div>
  </div>
</div>

<footer id="colophon" class="copyright quest-row" role="contentinfo">
  <div class="<?php echo $footer_container_cls; ?>">
    <div class="row">
      <div class="col-md-12 copyright-text">
      
        <div class="col-md-3">
          <a alt="Northeastern University" class="northeastern-logo" href="http://www.northeastern.edu">
            <span class="sr-only">Northeastern University</span>
          </a>
        </div>
        <div class="col-md-7">
          <ul class="nav nav-pills">
            <li><a href="https://my.northeastern.edu/" target="_blank">myNortheastern</a></li>
            <li><a href="https://prod-web.neu.edu/webapp6/employeelookup/public/main.action" target="_blank">Find Faculty &amp; Staff</a></li>
            <li><a href="http://www.northeastern.edu/neuhome/adminlinks/findaz.html" target="_blank">Find A-Z</a></li>
            <li><a href="http://www.northeastern.edu/emergency/index.html" target="_blank">Emergency Information</a></li>
            <li><a href="http://www.northeastern.edu/search/index.html" target="_blank">Search</a></li>
          </ul>
          <address>360 Huntington Ave., Boston, Massachusetts 02115 · 617.373.2000 ·  TTY 617.373.3768<br>
            <span class="fa fa-copyright"></span> <?php echo date('Y');?> Northeastern University
          </address>
        </div>
        <div class="col-md-2">
          <ul class="nu-social">
            <li>
              <a class="youtube" href="https://www.youtube.com/northeastern" target="_blank">
                <span class="sr-only">Northern University on YouTube</span>
                <span aria-hidden="" class="fa fa-youtube"></span>
              </a>
            </li>
            <li>
              <a class="twitter" href="http://twitter.com/northeastern" target="_blank">
                <span class="sr-only">Northern University on Twitter</span>
                <span aria-hidden="" class="fa fa-twitter"></span>
              </a>
            </li>
            <li>
              <a class="facebook" href="http://www.facebook.com/northeastern" target="_blank">
                <span class="sr-only">Northeastern on Facebook</span>
                <span aria-hidden="" class="fa fa-facebook"></span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <!-- end row -->
  </div>
  <!-- end container -->
</footer> <!-- end quest-row -->

</div><!-- #page -->

<?php wp_footer(); ?>

<a href="#0" class="cd-top" title="Back to top"><i class="fa fa-angle-up"></i><span class="sr-only">Back to top</span></a>

<?php get_footer('additions'); ?>
</body>
</html>
