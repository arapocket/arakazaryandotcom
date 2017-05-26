<?php $link_video = get_post_meta( $post->ID, "meetheme_portfolio_video", true ); ?>
<?php if ( $link_video ) : ?>
	<div class="portfolio-post-video">
		<?php echo apply_filters('the_content', $link_video); ?>
	</div>
	<div class="clearfix"></div>
<?php endif;