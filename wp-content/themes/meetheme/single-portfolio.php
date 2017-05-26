<?php
	/**
	* single-projects.php
	* The main post loop in MeeTheme
	* @author Pluton
	* @package MeeTheme
	* @since 1.0.0
	*/
	get_header();
	the_post();
	global $meetheme;
	$project_type = get_post_meta( $post->ID, 'meetheme_portfolio_type', true );
?>
	<div id="main-single-portfolio">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <?php get_template_part('portfolios-formats/portfolio', $project_type); ?>
                </div>
                <div class="w-caption">
                    <h2><?php the_title( ); ?></h2>
                    <h3><i><?php echo get_post_meta( $post->ID, 'meetheme_portfolio_title', true ); ?></i></h3>
                    <div class="w-ct">
                    	<?php the_content( ); ?>
                    </div>
                </div>
			</div>
		</div>
	</div>

<?php get_footer();