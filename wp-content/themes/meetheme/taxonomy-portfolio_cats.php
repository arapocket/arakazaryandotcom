<?php
	/**
	 * taxonomy-portfolio_cats.php
	 * The project archive used in MeeTheme
	 * @author Pluton
	 * @package MeeTheme
	 * @since 1.0.0
	 */
	get_header();
	global $meetheme;
?>
	<!-- Main content -->
    <div id="main-portfolio-cats">
        <!-- Work -->
        <div id="work">
            <div class="container">
                <div class="row">
                    <?php get_template_part('loop/loop', 'portfolio'); ?>
	    		</div>
	    	</div>
	    </div>
	</div>

<?php get_footer();