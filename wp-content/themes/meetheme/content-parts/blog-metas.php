<?php global $meetheme; ?>
<div class="post-details">
	<?php if( in_array('author',$meetheme['blog_metas']) ) : ?>
		<span><a href="<?php echo get_author_posts_url($post->post_author); ?>"><?php echo get_the_author_meta('display_name' ); ?></a> / </span>
	<?php endif; ?>
	<?php if( in_array('tags',$meetheme['blog_metas']) ) :  ?>
		<?php
            $posttags = get_the_tags();
            if ($posttags) {
                $tag_val = array();
              	foreach($posttags as $tag) {
              		$tag_link = get_tag_link( $tag->term_id );
                	$tag_val[] = '<a href="'.$tag_link.'">'.$tag->name.'</a>'; 
              	}
        ?>
            <span><?php echo implode(', ', $tag_val); ?> / </span>
        <?php } ?>
	<?php endif; ?>
	<?php if( in_array('category',$meetheme['blog_metas'])  && has_category() ) :  ?>
		<span><?php the_category(', '); ?> / </span>
	<?php endif; ?>
	<?php if( in_array('comment',$meetheme['blog_metas']) && comments_open() ) : ?>
		<span><a href="<?php comments_link(); ?>"><?php comments_number( __('0 Comments','pluton'), __('1 Comment','pluton'), __('% Comments','pluton') ); ?></a></span>
	<?php endif; ?>
</div>