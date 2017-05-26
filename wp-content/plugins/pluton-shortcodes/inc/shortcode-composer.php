<?php
	/*-----------------------------------------------------------------------------------*/
	/*	Space
	/*-----------------------------------------------------------------------------------*/
	function pluton_shortcode_space( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'height' => '50'
	    ), $atts ) );
	   return '<div style="clear:both; width:100%; height:'.$height.'px"></div>';
	}
	add_shortcode( 'pluton-space', 'pluton_shortcode_space' );


	/*-----------------------------------------------------------------------------------*/
	/*	Line
	/*-----------------------------------------------------------------------------------*/
	function pluton_shortcode_line( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'line_top' => ''
		), $atts ) );
	   return '<div class="full-divider" style="margin-top:'.$line_top.'"></div>';
	}
	add_shortcode( 'pluton-line', 'pluton_shortcode_line' );


	/*-----------------------------------------------------------------------------------*/
	/*	Mee Title
	/*-----------------------------------------------------------------------------------*/
	function pluton_shortcode_mee_title( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'tt_title' => '',
	    ), $atts ) );

		$output  = '';

	    ob_start();
		?>
			<div class="the-title">
				<?php if ($tt_title): ?>
					<h3><?php echo stripslashes($tt_title); ?></h3>
				<?php endif ?>
				<?php if ($content): ?>
					<p><?php echo stripslashes($content); ?></p>
				<?php endif ?>
            </div>
		<?php
		$result = ob_get_contents();
		ob_end_clean();
		$output .= $result;

	   	return $output;
	}
	add_shortcode( 'pluton-mee-title', 'pluton_shortcode_mee_title' );


	/*-----------------------------------------------------------------------------------*/
	/*	Contact Form7
	/*-----------------------------------------------------------------------------------*/
	function pluton_shortcode_contact_form7( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'contact_form7_id' => '',
			'contact_title'	=> '',
	    ), $atts ) );

		$output  = '';

	    if ($contact_form7_id) {
	    	$sc = '[contact-form-7 id="'.$contact_form7_id.'" title="Contact form 7 '.$contact_form7_id.'"]';
	    	ob_start();
			?>
				<div class="contact-form">
					<?php if ($contact_title): ?>
						<h3><?php echo stripslashes($contact_title); ?></h3>
					<?php endif ?>
					<?php echo do_shortcode($sc); ?>
				</div>
			<?php
			$result = ob_get_contents();
			ob_end_clean();
			$output .= $result;
	    } else {
	    	$output .= __('No Contact Form7', 'pluton');
	    }

	   	return $output;
	}
	add_shortcode( 'pluton-contact-form7', 'pluton_shortcode_contact_form7' );


	/*-----------------------------------------------------------------------------------*/
	/*	About Info
	/*-----------------------------------------------------------------------------------*/
	function pluton_shortcode_about_info( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'about_desc' => ''
	    ), $atts ) );

		$output  = '';

			ob_start();
		?>

		    <div class="about-con">
				<?php echo rawurldecode(base64_decode($about_desc)); ?>
		    </div>

		<?php
			$result = ob_get_contents();
			ob_end_clean();
			$output .= $result;

	   	return $output;
	}
	add_shortcode( 'pluton-aboutinfo', 'pluton_shortcode_about_info' );


	/*-----------------------------------------------------------------------------------*/
	/*	Skill
	/*-----------------------------------------------------------------------------------*/
	function pluton_shortcode_skill( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'sk_title' => '',
			'sk_desc' => '',
			'sk_percent' => '',
	    ), $atts ) );

		$output  = '';

	    ob_start();
		?>
			<div class="mee-skill">
				<div class="col-6">
					<span class="chart" data-percent="<?php echo $sk_percent; ?>">
						<span class="percent"></span>
					</span>
				</div>
				<div class="col-6 chart-text">
					<?php if ($sk_title): ?>
						<h4><?php echo stripslashes($sk_title); ?></h4>
					<?php endif ?>
					<?php if ($sk_desc): ?>
						<p><?php echo stripslashes($sk_desc); ?></p>
					<?php endif ?>
				</div>
            </div>
		<?php
		$result = ob_get_contents();
		ob_end_clean();
		$output .= $result;

	   	return $output;
	}
	add_shortcode( 'pluton-skill', 'pluton_shortcode_skill' );

	/*-----------------------------------------------------------------------------------*/
	/*	Process Bar
	/*-----------------------------------------------------------------------------------*/
	function pluton_shortcode_process_bar( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'pr_title' => '',
			'pr_percent' => '',
	    ), $atts ) );

		$output  = '';
		$pro_id  = rand(1,1000);

	    ob_start();
		?>
			<div class="progressbar-main margin-top50">
				<?php if ($pr_title): ?>
					<div class="progress-bar-description"><?php echo stripslashes($pr_title); ?></div>
				<?php endif ?>
              	<div class="progress" id="progressBar<?php echo esc_attr( $pro_id ); ?>">
                	<div class="progress-value" style="width: <?php echo esc_attr( $pr_percent ); ?>%;"><span><?php echo $pr_percent; ?></span></div>
              	</div>
            </div>
            <script type="text/javascript">
            jQuery(document).ready(function($) {
            	progressBar(<?php echo esc_js( $pr_percent ); ?>, $('#progressBar<?php echo esc_js( $pro_id ); ?>'));
            });
            </script>
		<?php
		$result = ob_get_contents();
		ob_end_clean();
		$output .= $result;

	   	return $output;
	}
	add_shortcode( 'pluton-process-bar', 'pluton_shortcode_process_bar' );


	/*-----------------------------------------------------------------------------------*/
	/*	Experience
	/*-----------------------------------------------------------------------------------*/
	function pluton_shortcode_experience( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'ex_title' => '',
			'ex_sub_title' => '',
			'ex_year' => '',
			'ex_icon_class' => '',
	    ), $atts ) );

		$output  = '';

	    ob_start();
		?>
			<div class="experience-details">
              	<div class="col-6 margin-bottom50 margin-top50">
	                <div class="col-3 icon-block"><i class="fa <?php echo $ex_icon_class; ?>"></i></div>
	                <div class="flot-left">
	                	<?php if ($ex_title): ?>
	                		<h5><?php echo stripslashes($ex_title); ?></h5>
	                	<?php endif ?>
	                	<?php if ($ex_sub_title): ?>
	                		<h4><?php echo stripslashes($ex_sub_title); ?></h4>
	                	<?php endif ?>
	                	<?php if ($ex_year): ?>
	                		<span><?php echo stripslashes($ex_year); ?></span>
	                	<?php endif ?>
	                </div>
              	</div>
              	<?php if ($content): ?>
              		<div class="col-6 margin-bottom50 margin-top50"><?php echo stripslashes($content) ?></div>
              	<?php endif ?>
            </div>
		<?php
		$result = ob_get_contents();
		ob_end_clean();
		$output .= $result;

	   	return $output;
	}
	add_shortcode( 'pluton-experience', 'pluton_shortcode_experience' );



	/*-----------------------------------------------------------------------------------*/
	/*	Portfolio
	/*-----------------------------------------------------------------------------------*/
	function pluton_shortcode_portfolio( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'posts_per_page' => '',
			'portfolio_cats' => '',
			'porftolio_id' => '',
			'orderby' => '',
			'order' => '',
			'offset' => '',
	    ), $atts ) );
		$output  = '';

	    // Fix for pagination
        if( is_front_page() ) { $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1; } else { $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; }

        // General args
        $args = array(
            'paged' => $paged,
            'post_type' => 'portfolio',
            'posts_per_page' => $posts_per_page,
            'order' => $order,
            'orderby' => $orderby,
            'offset' => $offset
        );

        // Category args
        if ( isset( $portfolio_cats ) && $portfolio_cats != '' ) {
            $terms = explode( ' ', $portfolio_cats);
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'portfolio_cats',
                    'field' => 'id',
                    'terms' => $terms,
                    'operator' => 'IN',
                )
            );
        }
		//
		$porftolio_id = isset($atts['porftolio_id']) ? $atts['porftolio_id'] : 'grid-gallery';
        // Do the query
        $block_query = new WP_Query( $args );

        ob_start();
		?>
			<div class="portfolio-con">
            	<div class="container-sub margin-top50">
              		<div class="row">
                		<div id="<?=$porftolio_id?>" class="grid-gallery">
                  			<section class="grid-wrap">
                    			<ul class="grid">
									<?php
						                if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();

						                    /**
						                     * Get blog posts by blog layout.
						                     */
						                    $taxonomy = 'portfolio_cats';
										    $post_id  = (int)get_the_id();

										    $post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'ids' ) );

										    if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {
										      	$term_ids = implode( ',' , $post_terms );

										      	$args = array(
										          	'orderby'                  => 'name',
										          	'order'                    => 'ASC',
										          	'include'                  => $term_ids,
										          	'taxonomy'                 => $taxonomy,
										      	);

										      	$categories = get_categories( $args );
										      	$cats_slug  = array();
										      	$cats_name  = array();
										      	foreach ( $categories as $category ) {
										        	$cats_slug[] = $category->slug;
										        	$cats_name[] = $category->name;
										      	}
										    }
						            ?>
						                <li>
					                        <figure>
					                        	<?php if (has_post_thumbnail( )): ?>
					                        		<?php the_post_thumbnail( ); ?>
					                        	<?php endif ?>
					                          	<figcaption>
					                            	<div class="figcaption-details"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-plus.png" height="82" width="82" alt="" />
					                              		<h3><?php the_title( ); ?></h3>
					                              		<span><?php echo implode(", ", $cats_name); ?></span>
					                              	</div>
					                          	</figcaption>
					                        </figure>
					                    </li>
						            <?php
						                endwhile;
						                else :

						                    /**
						                     * Display no posts message if none are found.
						                     */
						                    get_template_part('loop/content','none');

						                endif;
						            ?>
							    </ul>
							</section>

							<section class="slideshow">
                    			<ul>
									<?php
						                if ( $block_query->have_posts() ) : while ( $block_query->have_posts() ) : $block_query->the_post();

						                    /**
						                     * Get blog posts by blog layout.
						                     */
						                    $portfolio_type = get_post_meta( get_the_ID(), 'meetheme_portfolio_type', true );
						                    $taxonomy = 'portfolio_cats';
										    $post_id  = (int)get_the_id();

										    $post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'ids' ) );

										    if ( !empty( $post_terms ) && !is_wp_error( $post_terms ) ) {
										      	$term_ids = implode( ',' , $post_terms );

										      	$args = array(
										          	'orderby'                  => 'name',
										          	'order'                    => 'ASC',
										          	'include'                  => $term_ids,
										          	'taxonomy'                 => $taxonomy,
										      	);

										      	$categories = get_categories( $args );
										      	$cats_slug  = array();
										      	$cats_name  = array();
										      	foreach ( $categories as $category ) {
										        	$cats_slug[] = $category->slug;
										        	$cats_name[] = $category->name;
										      	}
										    }
						            ?>
											<li>
						                        <figure>
						                          	<figcaption>
						                            	<h3><?php the_title( ); ?></h3>
						                            	<span><?php echo implode(", ", $cats_name); ?></span>
						                            	<?php the_content( ); ?>
						                          	</figcaption>
						                          	<?php echo get_template_part('portfolios-formats/portfolio', $portfolio_type); ?>
						                        </figure>
						                    </li>
									<?php
						                endwhile;
						                else :

						                    /**
						                     * Display no posts message if none are found.
						                     */
						                    get_template_part('loop/content','none');

						                endif;
						            ?>
						            <?php wp_reset_query(); ?>
							        <div class="clearfix"></div>
							        <script type="text/javascript">
							        jQuery(document).ready(function($) {
							            new CBPGridGallery( document.getElementById('<?=$porftolio_id?>') );
							        });
							        </script>
                    			</ul>
                    			<nav> <span class="fa nav-prev"></span> <span class="fa nav-next"></span> <span class="fa nav-close"></span> </nav>
                    		</section>
                    	</div>
                    </div>
                </div>
            </div>
		<?php
		$result = ob_get_contents();
		ob_end_clean();
		$output .= $result;

	   	return $output;
	}
	add_shortcode( 'pluton-portfolio', 'pluton_shortcode_portfolio' );


	/*-----------------------------------------------------------------------------------*/
	/*	Contact Info
	/*-----------------------------------------------------------------------------------*/
	function pluton_shortcode_contact_info( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'ct_title' => '',
			'ct_desc' => '',
			'ct_icon_class' => '',
	    ), $atts ) );

		$output  = '';

	    ob_start();
		?>
			<div class="contact-text contact-details">
              	<div class="col-2 icon-block address"><i class="fa <?php echo $ct_icon_class; ?>"></i></div>
              	<div class="flot-left">
					<?php if ($ct_title): ?>
              			<strong><?php echo stripslashes($ct_title); ?></strong><br>
					<?php endif ?>
                	<?php echo stripslashes($ct_desc); ?>
                </div>
            </div>
		<?php
		$result = ob_get_contents();
		ob_end_clean();
		$output .= $result;

	   	return $output;
	}
	add_shortcode( 'pluton-contact-info', 'pluton_shortcode_contact_info' );


	/*-----------------------------------------------------------------------------------*/
	/*	Mee Social List
	/*-----------------------------------------------------------------------------------*/
	function pluton_shortcode_mee_social( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'so_link1' => '',
			'so_link2' => '',
			'so_link3' => '',
			'so_link4' => '',
			'so_link5' => '',
			'so_link6' => '',
			'so_link7' => '',
			'so_link8' => '',
			'so_link9' => '',
			'so_link10' => '',
			'so_icon_class1' => '',
			'so_icon_class2' => '',
			'so_icon_class3' => '',
			'so_icon_class4' => '',
			'so_icon_class5' => '',
			'so_icon_class6' => '',
			'so_icon_class7' => '',
			'so_icon_class8' => '',
			'so_icon_class9' => '',
			'so_icon_class10' => '',
	    ), $atts ) );

	    $social_list = array();
	    $social_list['so_link1'] = $so_link1;
		$social_list['so_link2'] = $so_link2;
		$social_list['so_link3'] = $so_link3;
		$social_list['so_link4'] = $so_link4;
		$social_list['so_link5'] = $so_link5;
		$social_list['so_link6'] = $so_link6;
		$social_list['so_link7'] = $so_link7;
		$social_list['so_link8'] = $so_link8;
		$social_list['so_link9'] = $so_link9;
		$social_list['so_link10'] = $so_link10;
		$social_list['so_icon_class1'] = $so_icon_class1;
		$social_list['so_icon_class2'] = $so_icon_class2;
		$social_list['so_icon_class3'] = $so_icon_class3;
		$social_list['so_icon_class4'] = $so_icon_class4;
		$social_list['so_icon_class5'] = $so_icon_class5;
		$social_list['so_icon_class6'] = $so_icon_class6;
		$social_list['so_icon_class7'] = $so_icon_class7;
		$social_list['so_icon_class8'] = $so_icon_class8;
		$social_list['so_icon_class9'] = $so_icon_class9;
		$social_list['so_icon_class10'] = $so_icon_class10;

		$output  = '';

	    ob_start();
		?>
			<div class="contact-social margin-top30">
				<?php for($i=1; $i < 11; $i++) { ?>
					<?php if ($social_list['so_link'.$i]): ?>
						<a href="<?php echo esc_url( $social_list['so_link'.$i] ); ?>" target="_blank"><i class="fa <?php echo esc_attr( $social_list['so_icon_class'.$i] ); ?>"></i></a>
					<?php endif ?>
				<?php } ?>
            </div>
		<?php
		$result = ob_get_contents();
		ob_end_clean();
		$output .= $result;

	   	return $output;
	}
	add_shortcode( 'pluton-mee-social', 'pluton_shortcode_mee_social' );