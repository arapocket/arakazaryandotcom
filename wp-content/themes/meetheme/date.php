<?php
    /**
    * date.php
    * The main post loop in MeeTheme
    * @author Pluton
    * @package MeeTheme
    * @since 1.0.0
    */
    get_header();
    global $meetheme;
?>
    <!-- Main content -->
    <div id="blog-main-content" class="blog-main">
        <?php if ($meetheme['blog_layout']==3): ?>
            <div class="blog-full blog-listing">
                <div class="blog-top">
                    <div class="blog-title">
                        <h2><?php printf( __( 'Date Archives: %s', 'pluton' ), single_month_title( '', false ) ); ?></h2>
                        <?php if (function_exists('pluton_get_breadcrumbs')): ?>
                            <?php pluton_get_breadcrumbs(); ?>
                        <?php endif ?>
                    </div>
                </div>
                <div class="row">
                    <?php get_template_part('loop/loop-blog', 'list'); ?>
                </div>
                <div class="row">
                    <?php echo function_exists('pluton_pagination') ? pluton_pagination() : posts_nav_link(); ?>
                </div>
            </div>
        <?php else: ?>
            <div class="blog-left blog-listing">
                <div class="blog-top">
                    <div class="blog-title">
                        <h2><?php printf( __( 'Date Archives: %s', 'pluton' ), single_month_title( '', false ) ); ?></h2>
                        <?php if (function_exists('pluton_get_breadcrumbs')): ?>
                            <?php pluton_get_breadcrumbs(); ?>
                        <?php endif ?>
                    </div>
                </div>
                <div class="row">
                    <?php get_template_part('loop/loop-blog', 'list'); ?>
                </div>
                <div class="row">
                    <?php echo function_exists('pluton_pagination') ? pluton_pagination() : posts_nav_link(); ?>
                </div>
            </div>
            <div class="blog-right">
                <?php get_sidebar(); ?>
            </div>
        <?php endif ?>
    </div>
    <!-- End / Main content -->

<?php get_footer();