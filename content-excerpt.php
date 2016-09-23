<?php
/**
 * @package Quest
 */

$view = quest_get_view();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-normal' ); ?>>
	<header class="entry-header">
		<?php get_template_part( 'partials/content', 'sticky' ); ?>

		<?php do_action('quest_single_' . $view . '_before_ft_img'); ?>

		<?php if ( ! quest_get_mod( 'layout_' . $view . '_ft-img-hide' ) && has_post_thumbnail() ) : ?>

			<div class="post-image blog-normal effect slide-top" <?php echo quest_featured_image_width( $view ) ?>>
				<a href="<?php the_permalink() ?>"><?php the_post_thumbnail( 'blog-normal' ); ?></a>

				<div class="overlay">
					<div class="caption">
						<a href="<?php the_permalink() ?>"><?php _e( 'View more', 'quest' ); ?></a>
					</div>
					<a href="<?php the_permalink() ?>" class="expand">+</a>
					<a href="#" class="close-overlay hidden">x</a>
				</div>
			</div>

		<?php endif; ?>

		<?php do_action('quest_single_' . $view . '_after_ft_img'); ?>
		<h4 class="post-title entry-title"><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark">
		<?php the_title(); ?>
	</a></h4>
		<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php quest_post_meta(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

	</header>
	<!-- .entry-header -->

	<div class="entry-content">
		<?php echo relevanssi_do_excerpt($post, $query_string); ?>
		<a href="<?php the_permalink(); ?>" class="post-entry-read-more small" title="<?php the_title(); ?>">Read More <i class="fa fa-angle-double-right"></i></a>
	</div>
	<!-- .entry-content -->
</article><!-- #post-## -->
