<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


global $post, $woocommerce, $product, $woocommerce_loop;

if ( ! $product->is_purchasable() ) {
	return;
}

?>


	<div class="one-product-page">
		<div class="container">
			<h1 itemprop="name" class="product_title entry-title"><?php the_title(); ?></h1>
			<div class="top-content">
				<div class="left">
					<div class="images">
						<div class="wrap-main-pic">
							<?php
								if ( has_post_thumbnail() ) {

									$image_title 	= esc_attr( get_the_title( get_post_thumbnail_id() ) );
									$image_caption 	= get_post( get_post_thumbnail_id() )->post_excerpt;
									$image_link  	= wp_get_attachment_url( get_post_thumbnail_id() );
									$image       	= get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
										'title'	=> $image_title,
										'alt'	=> $image_title
									) );

									$attachment_count = count( $product->get_gallery_attachment_ids() );

									if ( $attachment_count > 0 ) {
										$gallery = '[product-gallery]';
									} else {
										$gallery = '';
									}

									echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="woocommerce-main-image zoom" title="%s" data-rel="prettyPhoto' . $gallery . '">%s</a>', $image_link, $image_caption, $image ), $post->ID );

								} else {

									echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );

								}
							?>
						</div>

						<div class="wrap-gall">
							<?php do_action( 'woocommerce_product_thumbnails' ); ?>
						</div>

					</div>
				</div><!-- end .top-content .left -->
				<div class="right">
					<div class="description">
						<div class="content-format">
							<?php the_content(); ?>
						</div>
					</div>
					<div class="price-and-add-to-cart">
						<?php
							// Availability
							$availability      = $product->get_availability();
							$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

							echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
						?>

						<?php if ( $product->is_in_stock() ) : ?>

							<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

							<form class="cart" method="post" enctype='multipart/form-data'>
								<div class="qty-n-price">
									<div class="qty">
										<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

										<?php
											if ( ! $product->is_sold_individually() ) {
												woocommerce_quantity_input( array(
													'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
													'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
													'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) // $_GET were $_POST
												) );
											}
										?>
									</div>
									<div class="price">
										<div itemprop="offers" itemscope itemtype="http://schema.org/Offer">

											<p class="price"><?php echo $product->get_price_html(); ?></p>

											<meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
											<meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
											<link itemprop="availability" href="http://schema.org/<?php echo $product->is_in_stock() ? 'InStock' : 'OutOfStock'; ?>" />

										</div>
									</div>
								</div>

								<input type="hidden" class="show-me-id" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

								<!--<button type="submit" class="single_add_to_cart_button button alt"><?php echo $product->single_add_to_cart_text(); ?></button>-->
								<div class="button-wrapper-for-popup" data-effect="mfp-zoom-in">
									<button type="submit"
										data-quantity="1" data-product_id="<?php echo $product->id; ?>"
										class="button alt single_add_to_cart_button add_to_cart_button product_type_simple">
										<?php echo $product->single_add_to_cart_text(); ?>
									</button>
								</div>

								<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
							</form>

							<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

						<?php endif; ?>
					</div>
				</div><!-- end .top-content .right -->
			</div>

			<div class="content-format second-cont-block">
				<?php
					$mykey_values = get_post_custom_values( 'product_details_meta' );
					foreach ( $mykey_values as $key => $value ) {
						echo $value;
					}
				?>
			</div>

			<div class="related-posts">
				<?php
				if ( empty( $product ) || ! $product->exists() ) {
					return;
				}

				$related = $product->get_related( $posts_per_page );

				if ( sizeof( $related ) == 0 ) return;

				$args = apply_filters( 'woocommerce_related_products_args', array(
					'post_type'            => 'product',
					'ignore_sticky_posts'  => 1,
					'no_found_rows'        => 1,
					'posts_per_page'       => 3,
					'orderby'              => $orderby,
					'order'                => 'ASC',
					'post__in'             => $related,
					'post__not_in'         => array( $product->id )
				) );

				$products = new WP_Query( $args );

				$woocommerce_loop['columns'] = $columns;

				if ( $products->have_posts() ) : ?>

					<div class="related products">

						<h2><?php _e( 'Related Products', 'woocommerce' ); ?></h2>

						<?php woocommerce_product_loop_start(); ?>

						<?php while ( $products->have_posts() ) : $products->the_post(); ?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

						<?php woocommerce_product_loop_end(); ?>

					</div>

				<?php endif;

				//wp_reset_postdata();
				?>
			</div>

			<div class="mailing-form">
				<form action="/" method="post">
					<div class="sign-up-email">
						<label for="email-sign-up-1">Sign Up for E-Mail Updates</label>
						<input type="email" placeholder="joe.doe@example.com" value="" name="email" id="email-sign-up-1">
					</div>
					<div class="sign-up-button">
						<button class="btn btn-default" type="submit">SIGN UP</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="empty-block-for-sticky-footer pb"></div><!-- do not remove this empty element -->
</div><!-- end .wrapper-for-sticky-footer-structure -->
