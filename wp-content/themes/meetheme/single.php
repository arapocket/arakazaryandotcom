<?php
    /**
    * single.php
    * The main post loop in MeeTheme
    * @author Pluton
    * @package MeeTheme
    * @since 1.0.0
    */
    get_header();
    the_post();

    global $meetheme;
    $format = get_post_format();
    if( false === $format ){
    	$format = 'standard';
    }
?>
    <!-- Main content -->
    <div id="blog-main-content" <?php post_class('blog-main'); ?>>
        <?php if ($meetheme['blog_layout']==3): ?>
            <div class="blog-full">
                <div class="blog-top">
                    <div class="blog-title blog-details-title">
                        <h2><?php the_title( ); ?></h2>
                        <?php if (function_exists('pluton_get_breadcrumbs')): ?>
                            <?php pluton_get_breadcrumbs(); ?>
                        <?php endif ?>
                        <?php get_template_part('content-parts/blog', 'metas'); ?>
                    </div>
                </div>
                <div class="blog-details">
                    <div class="blog-details-img">
                        <?php get_template_part( 'posts-formats/post', $format ); ?>
                    </div>
                    <div class="blog-content">
                        <?php the_content( ); ?>
                        <?php
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'pluton' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                            ) );
                        ?>
                    </div>

                    <?php if ($meetheme['blog_switch_social']==1): ?>
                        <div class="blog-share">
                            <?php get_template_part('content-parts/blog', 'social'); ?>
                        </div>
                    <?php endif ?>

                    <?php if( comments_open() ) {  ?>
                        <div class="comments-main">
                            <?php comments_template(); ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php else: ?>
            <div class="blog-left">
                <div class="blog-top">
                    <div class="blog-title blog-details-title">
                        <h2><?php the_title( ); ?></h2>
                        <?php if (function_exists('pluton_get_breadcrumbs')): ?>
                            <?php pluton_get_breadcrumbs(); ?>
                        <?php endif ?>
                        <?php get_template_part('content-parts/blog', 'metas'); ?>
                    </div>
                </div>
                <div class="blog-details">
                    <div class="blog-details-img">
                        <?php get_template_part( 'posts-formats/post', $format ); ?>
                    </div>
                    <div class="blog-content">
                        <?php the_content( ); ?>
                        <?php
                            wp_link_pages( array(
                                'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'pluton' ) . '</span>',
                                'after'       => '</div>',
                                'link_before' => '<span>',
                                'link_after'  => '</span>',
                            ) );
                        ?>
                    </div>

                    <?php if ($meetheme['blog_switch_social']==1): ?>
                        <div class="blog-share">
                            <?php get_template_part('content-parts/blog', 'social'); ?>
                        </div>
                    <?php endif ?>

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
        <?php endif ?>
    </div>
    <!-- End / Main content -->

<?php get_footer();