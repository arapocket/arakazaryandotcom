<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> data-title="<?php bloginfo( 'name' ); ?> ">
    
    <div class="preload"><ul class="loader"><li></li><li></li><li></li></ul></div>
    
    <div id="container" class="container">
        <?php global $meetheme; ?>
        <!-- Left Menu / Logo-->
        <aside class="menu" id="menu">
            <div class="logo">
                <a href="<?php echo home_url(); ?>">
                    <!-- Logo image-->
                    <img src="<?php echo esc_url($meetheme['general_logo']['url']); ?>" width="140" height="140" alt="<?php bloginfo('name'); ?>"/>
                    <!-- Logo name-->
                    <span><?php echo stripslashes($meetheme['header_text']); ?></span>
                </a>
            </div>
            <!-- Mobile Navigation-->
            <a href="#menu1" class="menu-link"></a>
            <?php if( is_page( ) && basename( get_page_template() ) == 'one-page.php' ): ?>
                <nav id="menu1" role="navigation">
                    <?php
                        wp_nav_menu(array(
                            'theme_location'    => 'onepage_menu',
                            'depth'             => 3,
                            'container'         => false,
                            'menu_id'           => 'nav',
                            'items_wrap'        => '<ul>%3$s</ul>',
                            'fallback_cb'       => 'pluton_bootstrap_navwalker::fallback',
                            'walker'            => new pluton_bootstrap_navwalker(),
                        ));
                    ?>
                    <?php if ($meetheme['header_social_icon']==1): ?>
		                <?php get_template_part('content-parts/header', 'social'); ?>
		            <?php endif ?>
                </nav>
            <?php else: ?>
                <nav id="menu1" role="navigation">
                    <?php
                        wp_nav_menu(array(
                            'theme_location'    => 'main_menu',
                            'depth'             => 3,
                            'container'         => false,
                            'menu_id'           => 'nav',
                            'items_wrap'        => '<ul>%3$s</ul>',
                            'fallback_cb'       => 'pluton_bootstrap_navwalker2::fallback',
                            'walker'            => new pluton_bootstrap_navwalker2(),
                        ));
                    ?>
                    <?php if ($meetheme['header_social_icon']==1): ?>
		                <?php get_template_part('content-parts/header', 'social'); ?>
		            <?php endif ?>
                </nav>
            <?php endif ?>

            <div class="copyright"><?php echo stripslashes($meetheme['header_copyright_text']); ?></div>
        </aside>
        <a href="#menu" class="totop-link">Go to the top</a>
        <?php if( is_page( ) && basename( get_page_template() ) == 'one-page.php' ): ?>
        <div class="content-scroller">
            <div class="content-wrapper">
                <?php get_template_part('content-parts/home', 'slider'); ?>
        <?php endif ?>