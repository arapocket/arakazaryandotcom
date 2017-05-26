<?php
    global $meetheme;
    $format = get_post_format();
    if( false === $format ){
        $format = 'standard';
    }
    if ($meetheme['blog_style']=='list') {
        $class_blog = 'blog-list blog-style-list';
    } else {
        $class_blog = 'blog-list blog-style-grid';
    }
    $class_blog .= ' isotope-item';
?>

<div <?php post_class($class_blog); ?>>
    <div class="blog-img">
        <?php get_template_part( 'posts-formats/post', $format ); ?>
    </div>
    <div class="blog-list-details">
        <?php if( in_array('date',$meetheme['blog_metas']) ) : ?>
            <span class="date"><?php the_time( 'l / M d, Y' ); ?> / </span>
        <?php endif; ?>
        <h3 class="blog-post-title"><a href="<?php the_permalink(); ?>"><?php the_title( ); ?></a></h3>
        <?php get_template_part('content-parts/blog', 'metas'); ?>
        <div class="title-divider"></div>
        <?php if ($meetheme['blog_content']=='content'): ?>
            <?php the_excerpt(); ?>
            <?php
                wp_link_pages( array(
                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'pluton' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                ) );
            ?>
        <?php else: ?>
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>"><?php echo $meetheme['blog_continue_reading']; ?></a>
        <?php endif ?>
        <?php if ($meetheme['blog_switch_social']==1): ?>
            <?php get_template_part('content-parts/blog', 'social'); ?>
        <?php endif ?>
    </div>
</div>