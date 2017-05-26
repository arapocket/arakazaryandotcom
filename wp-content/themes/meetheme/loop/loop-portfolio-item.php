<!--Project-->
<div id="portfolio-<?php the_ID(); ?>" class="one-third column work">

	<a id="work<?php echo get_the_id();  ?>" href="javascript:void(0)" data-id="<?php echo get_the_id(); ?>">
		<div class="info">
			<div class="inner">
				<h3><?php echo get_the_title(); ?></h3>
				<p><?php echo strip_tags(get_the_term_list(get_the_id(),'projects_cats', '',', ' ), '') ?></p>
			</div>
		</div>
		<?php the_post_thumbnail('portfolio-4columns'); ?>
	</a>
</div>