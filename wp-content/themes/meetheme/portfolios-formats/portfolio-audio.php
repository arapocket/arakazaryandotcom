<?php $link_audio = get_post_meta( $post->ID, "meetheme_portfolio_audio", true ); ?>
<?php if ( $link_audio ) : ?>
	<div class="portfolio-post-audio">
		<?php echo apply_filters('the_content', $link_audio); ?>
	</div>
<?php endif;