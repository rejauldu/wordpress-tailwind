<?php
/*
Template Name: Contact Us
*/
if (isset($_POST['fname']) && isset($_POST['email']) && isset($_POST['message'])) {
    $name = sanitize_text_field($_POST['fname']);
    $email = sanitize_email($_POST['email']);
    $message = sanitize_text_field($_POST['message']);

    $submission_data = array(
        'post_title' => 'Contact Submission: ' . $name,
        'post_content' => $message,
        'post_status' => 'publish',
        'post_type' => 'contact_submission',
        'meta_input' => array(
            '_contact_email' => $email,
        ),
    );

    $submission_id = wp_insert_post($submission_data);
}
get_header();
?>
	
	<!-- site-content -->
	<div class="site-content clearfix">
		
		<!-- main-column -->
		<div class="main-column">
			<?php
				if (have_posts()) :
					while (have_posts()) : the_post(); ?>

					<div class="container">
						<div class="row">
							<div class="col-md-6">
								<form action="" method="post">
									<label for="fname">Name:</label>
									<input type="text" name="fname" id="fname" required>
									
									<label for="email">Email:</label>
									<input type="email" name="email" id="email" required>
									
									<label for="message">Message:</label>
									<textarea name="message" id="message" rows="5" required></textarea>
									
									<input type="submit" value="Submit">
								</form>
							</div>
						</div>
					</div>

					<?php endwhile;
				endif;
			?>
		</div><!-- /main-column -->

		<?php get_sidebar(); ?>
		
	</div><!-- /site-content -->
		<div id="page"></div>
	<?php get_footer();

?>