<?php
	global $meetheme;
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>
<?php if ($url !=''): ?>
	<div class="image head">
		<?php the_post_thumbnail('full' ); ?>
	</div>
<?php endif;