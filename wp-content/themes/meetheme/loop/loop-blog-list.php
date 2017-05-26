    <div class="isotope">
      <div class="grid-sizer blog-list "></div>
<?php
  if ( have_posts() ) : while ( have_posts() ) : the_post(); 

    /**
     * Get blog posts by blog layout.
     */
    ?>
		  <?php get_template_part( 'loop/loop-blog-list', 'item' ); ?>

  <?php endwhile;
  else :

    /**
     * Display no posts message if none are found.
     */
    get_template_part('loop/content','none');

  endif;
?>
    </div>