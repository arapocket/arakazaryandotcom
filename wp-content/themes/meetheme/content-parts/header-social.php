<?php global $meetheme; ?>
<div class="social">
	<?php foreach ($meetheme['header_social_list'] as $value): ?>
		<a href="<?php echo esc_url($value['url']); ?>" class="mee-social" target="_blank"><i class="fa <?php echo esc_attr($value['title']); ?>"></i></a>
	<?php endforeach ?>
</div>