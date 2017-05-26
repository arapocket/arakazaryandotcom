<?php global $meetheme; 

 $page_width 	= get_post_meta( get_the_ID(), 'meetheme_page_width', true );
 if ($page_width=='page-half') {
	$page_width_class = 'page-half';
 } else {
	$page_width_class = 'page-full';
 }

?>
<!-- Introduction -->
<article class="content <?php echo esc_attr($page_width_class);?> introduction noscroll" id="chapterintroduction">
    <div class="inner">
        <?php if ($meetheme['slider_title']): ?>
            <h2><?php echo stripslashes($meetheme['slider_title']); ?></h2>
        <?php endif ?>
        <?php if ($meetheme['slider_sub_title']): ?>
            <span class="title"><?php echo stripslashes($meetheme['slider_sub_title']); ?></span>
        <?php endif ?>
    </div>
    <div id="owl-demo" class="owl-carousel introduction-carousel">
        <?php if (isset($meetheme['slider_gallery']) && $meetheme['slider_gallery']): ?>
            <?php $slider_gallery = explode(',', $meetheme['slider_gallery']); ?>
            <?php foreach ($slider_gallery as $key => $value): ?>
                <?php $url = wp_get_attachment_url( $value ); ?>
                <div class="item"><img src="<?php echo esc_url( $url ); ?>" alt="" /></div>
            <?php endforeach ?>
        <?php else: ?>
            <div class="item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/profile.jpg" alt="" /></div>
            <div class="item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/profile-01.jpg" alt="" /></div>
            <div class="item"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/profile-02.jpg" alt="" /></div>
        <?php endif; ?>
    </div>
</article>