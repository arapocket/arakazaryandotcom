<?php
	global $post;
	$url = '';
	$url = get_post_meta( $post->ID, 'meetheme_post_image', true );
	if ($url == '') {
	    $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	}
?>
<?php if ($url !=''): ?>
    <div class="image head"><img src="<?php echo esc_url($url); ?>" alt="<?php the_title(); ?>"></div>
<?php endif;