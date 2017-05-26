<?php
	/**
	* Template Name: Fullwidth Template
	*
	* @author Pluton
	* @package MeeTheme
	* @since 1.0.0
	*/

	get_header();
	the_post();
	global $meetheme;
?>
	<!-- Main page -->
    <div class="blog-main">
        <div class="blog-full">
            <div class="blog-details">
                <div class="blog-content">
                    <?php
                        the_content();
                        wp_link_pages();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End / Main content -->
<?php get_footer();