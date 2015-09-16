<div class="footer">
    <div class="container">
        <div class="inner-footer">
            <?php if(!dynamic_sidebar('soc-networks')) : ?>
                <span>We in Social Networks</span>
            <?php endif; ?>
            <?php wp_nav_menu(array(
                'theme_location' => 'footer_menu',
                'container' => 'div',
                'container_class' => 'menu',
                'menu' => '',
                'menu_class' => 'menu'
            )); ?>
            <p class="copyright">All right reserved &copy;MEETRAH GmbH</p>
        </div>
    </div><!-- end .container -->
</div><!-- end .footer -->
</div><!-- end .body-inner -->
<?php wp_footer(); ?>
</body>
</html>
