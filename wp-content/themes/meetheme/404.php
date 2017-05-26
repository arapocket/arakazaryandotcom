<?php
	/**
	* 404.php
	* The main post loop in MeeTheme
	* @author Pluton
	* @package MeeTheme
	* @since 1.0.0
	*/
	get_header();
?>
	<div class="no-page">
	    <div><img src="<?php echo get_template_directory_uri(); ?>/assets/images/404.jpg"></div>
	    <div class="no-page-text"><h2><?php echo __('Sorry!', 'pluton'); ?></h2>
		<p><?php echo __('The page you were looking for 
		could not be found.', 'pluton'); ?></p>
		<a class="button" href="<?php echo home_url(); ?>"><?php echo __('Back to homepage', 'pluton'); ?></a>
		</div>
  	</div>
<?php get_footer();