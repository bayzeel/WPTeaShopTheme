<?php get_header(); ?>

        <div class="container cart">
            <div class="content-format">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
                <?php else: ?>
                    <h2>Cart content</h2>
                <?php endif; ?>
            </div><!-- end .content-format -->
        </div><!-- end .container -->

        <div class="empty-block-for-sticky-footer pb"></div><!-- do not remove this empty element -->
    </div><!-- end .wrapper-for-sticky-footer-structure -->

<?php get_footer(); ?>

