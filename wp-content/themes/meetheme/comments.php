<?php
	/**
	* comments.php
	* The main post loop in MeeTheme
	* @author Pluton
	* @package MeeTheme
	* @since 1.0.0
	*/
	$fields =  array(
		'author' => '<label class="col-md-4 col-sm-12" for="name"><input type="text" name="author" id="name" placeholder="Name" /></label>',
		'email'  => '<label class="col-md-4 col-sm-12" for="email"><input type="text" name="email" id="email" placeholder="Email" /></label>',
	);

	$custom_comment_form = array( 
		'fields' => apply_filters( 'comment_form_default_fields', $fields ),
	  	'comment_field' => '<label class="col-xs-12" for="cmt"><textarea name="comment" id="message" cols="45" rows="10" placeholder="Comment" ></textarea></label>',
	  	'logged_in_as' => '<p class="logged-in-as col-md-12 col-sm-12">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a> <a href="%3$s">Log out?</a>','pluton' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
	  	'cancel_reply_link' => __( 'Cancel' , 'pluton' ),
	  	'comment_notes_before' => '<h5 class="col-md-12">Leave a Comment</h5>',
	  	'comment_notes_after' => '',
	  	'title_reply' => '',
	  	'label_submit' => __( 'Send Message' , 'pluton' ),
	);
?>


		
	<?php 
		if( have_comments() ){
		  	wp_list_comments('type=comment&callback=pluton_comment');
		}
		paginate_comments_links();
	?>

	<div class="cmt-form">

		<div class="row">
			  <!-- Add comment Form field -->
			  <?php comment_form($custom_comment_form); ?>
		</div>
	</div>