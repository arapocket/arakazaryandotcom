<?php
    /**
    * Template Name: Page Right Sidebar
    * page-left.php
    * @author Pluton
    * @package MeeTheme
    * @since 1.0.0
    */
    get_header();
    the_post();
    global $meetheme;
?>

    <!-- Main page -->
    <div id="page-main-content" <?php post_class('blog-main'); ?>>
        <div class="blog-left">
            <div class="blog-top">
                <div class="blog-title blog-details-title">
                    <h2><?php the_title( ); ?></h2>
                </div>
            </div>
            <div class="blog-details">
                <div class="blog-content">
                    <?php
                        the_content();
                        wp_link_pages();
                    ?>
                </div>
                <?php if( comments_open() ) {  ?>
                    <div class="comments-main">
                        <?php comments_template(); ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="blog-right">
            <?php get_sidebar(); ?>
        </div>
    </div>
    <!-- End / Main content -->

<?php get_footer();