<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

		<div class="container shop">
			<div class="all-shop-products">

				<?php
				$args = array('post_type' => 'product', 'stock' => 1, 'orderby' => 'date', 'order' => 'ASC');
				$loop = new WP_Query($args);
				while ($loop->have_posts()) : $loop->the_post();
					global $product; ?>

					<div class="shop-product">

						<h3>
							<a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h3>

						<div class="img-wrap">
							<a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>">
								<?php if (has_post_thumbnail($loop->post->ID)) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" width="333px" height="333px" />'; ?>
							</a>
						</div>
						<?php echo $product->get_price_html(); ?>

					</div>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>

			</div>
		</div>

	<div class="empty-block-for-sticky-footer pb"></div><!-- do not remove this empty element -->
</div><!-- end .wrapper-for-sticky-footer-structure -->

<?php get_footer(); ?>
