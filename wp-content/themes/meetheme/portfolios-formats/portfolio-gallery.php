<?php
	global $post;
	$attachments = get_post_meta( $post->ID, 'meetheme_portfolio_gallery', true );
	if ( $attachments ) :
?>
    <div class="owl-carousel">
        <?php foreach ( $attachments as $attachment ){ ?>
        	<div class="item"><img src="<?php echo esc_url($attachment); ?>" alt="<?php get_the_title() ?>"></div>
  		<?php } ?>
    </div>
<?php endif;