<?php
/**
 * Displays the page section of the theme.
 *
 */
?>

<?php get_header(); ?>

        <div class="container">
            <div class="content-format">
                <?php woocommerce_content(); ?>
            </div><!-- end .content-format -->
        </div><!-- end .container -->

        <div class="empty-block-for-sticky-footer pb"></div><!-- do not remove this empty element -->
    </div><!-- end .wrapper-for-sticky-footer-structure -->

<?php get_footer(); ?>