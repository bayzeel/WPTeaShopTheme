<?php get_header(); ?>

        <?php $slider = new WP_Query(array('post_type' => 'slider', 'order' => 'ASC')) ?>
        <?php if ( $slider->have_posts() ) : ?>
                <div class="big-slider">
                    <div class="main-slider">
                        <ul class="slides">
                        <?php while ($slider->have_posts() ) : $slider->the_post(); ?>
                            <li>
                                <a href="<?php echo get_post_meta($post->ID, 'slide-link', true); ?>">
                                    <?php the_post_thumbnail(); ?>
                                    <div class="item-inner">
                                        <h2><?php the_title(); ?></h2>
                                    </div>
                                </a>
                            </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            <?php else: ?>
            <div class="container page-home">
                <div class="content-format">
                    <h2>Please, add some posts to slider.</h2>
                </div>
            </div>
            <?php endif; ?>

        <div class="container page-home">
            <div class="content-format">
                <p class="h3">Premium Detox Tea - 100% organic and certified - Fast Delivery</p>
            </div>
        </div>

        <div class="container page-home">
            <div class="index-products">
                <ul>
                    <?php
                    $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 3, 'orderby' =>'date','order' => 'ASC' );
                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>

                        <li class="product">

                            <!--<a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">-->

                            <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, 'shop_catalog'); else echo '<img src="'.woocommerce_placeholder_img_src().'" alt="Placeholder" width="333px" height="333px" />'; ?>

                            <div class="text-info">
                                <div class="hide-link-with-copy-attr">
                                    <a id="id-<?php the_id(); ?>" href="<?php the_permalink(); ?>"></a>
                                </div>

                                <h3><?php the_title(); ?></h3>

                                <?php echo $product->get_price_html(); ?>

                                <!--</a>-->

                                <div class="excerpt">
                                    <?php woocommerce_template_single_excerpt($loop->post, $product); ?>
                                </div>

                                <?php woocommerce_template_loop_add_to_cart($loop->post, $product); ?>

                                <i class="fa fa-chevron-down"></i>

                                <div class="active-arrow-bottom"></div>
                            </div>
                        </li><!-- /span3 -->
                    <?php endwhile; ?>
                    <?php wp_reset_query(); ?>
                </ul>
                <div class="extended-description">
                    <div class="inner">
                        <div class="left">
                            <img src="" alt="">
                        </div>
                        <div class="right">
                            <h3><a href="#"></a></h3>
                            <span class="amount"></span>
                            <div class="excerpt"></div>
                            <a href="#" class="button add_to_cart_button"></a>
                        </div>
                    </div>
                    <div class="nav-arrows-ext-desc nav-left">
                        <img src="<?php bloginfo('template_url') ?>/images/slider-arrow-left.png" alt="">
                    </div>
                    <div class="nav-arrows-ext-desc nav-right">
                        <img src="<?php bloginfo('template_url') ?>/images/slider-arrow-right.png" alt="">
                    </div>
                </div>
            </div><!-- end .index-products -->
        </div><!-- end .container -->

        <div class="container page-home">
            <div class="content-format">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
                <?php else: ?>
                    <h2>Index page content</h2>
                <?php endif; ?>
            </div><!-- end .content-format -->
        </div><!-- end .container -->

        <div class="container page-home">
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

        <div class="empty-block-for-sticky-footer pb"></div><!-- do not remove this empty element -->
    </div><!-- end .wrapper-for-sticky-footer-structure -->

<?php get_footer(); ?>

