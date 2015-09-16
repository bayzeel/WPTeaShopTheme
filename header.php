<!doctype html>
<html lang="EN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body>
<div class="body-inner">
    <div class="wrapper-for-sticky-footer-structure">
        <div class="container">
            <div class="header">
                    <?php wp_nav_menu(array(
                        'theme_location' => 'header_menu',
                        'container' => 'div',
                        'container_class' => 'menu-wrapper',
                        'menu' => '',
                        'menu_class' => 'menu'
                    )); ?>
                <div class="clr head-marg"></div>
                <a class="logo-wrap" href="<?php echo home_url(); ?>">
                    <img class="logo" src="<?php bloginfo('template_url') ?>/images/logo.svg" alt="Logo"/>
                </a>
                <div class="clr"></div>

            </div><!-- end .header -->
        </div><!-- end .container -->
