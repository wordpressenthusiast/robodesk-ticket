<?php

get_header();


$term_post = get_the_terms(get_the_ID(), 'robodesk_tickets_topic');
$term_post_priority = get_the_terms(get_the_ID(), 'robodesk_tickets_priority');
$robodesk_tickets_status = get_post_meta(get_the_ID(), 'robodesk_tickets_status', true);
$robodesk_ticket_username = get_post_meta(get_the_ID(), 'User', true);
$robodesk_ticket_email = get_post_meta(get_the_ID(), 'From', true);


global $post;
global $current_user;
// var_dump($current_user);

$user_roles = $current_user->roles;



if (is_user_logged_in()) {
	if (in_array('administrator', $user_roles) || in_array('support_customer', $user_roles) || in_array('support_manager', $user_roles) || in_array('support_agent', $user_roles) || in_array('subscriber', $user_roles)) {

		?>

		<div class="ticket-page">
			<div class="content">
				<div class="ticket-content">
					<h3>
						<?php the_title(); ?>
					</h3>
					<p>
						<?php the_content(); ?>
					</p>
					<div class="ticket-info">
						<div class="single-ticket-block">
							<h5>
								<?php _e('Ticket Status', 'robodesk'); ?>
							</h5>
							<div class="ticket-table">
								<table>
									<tbody>
										<tr>
											<td>
												<?php _e('Ticket ID', 'robodesk'); ?>
											</td>
											<td>#
												<?php echo get_the_ID(); ?>
											</td>
										</tr>
										<tr>
											<td>
												<?php _e('Status', 'robodesk'); ?>
											</td>
											<td>
												<?php echo $robodesk_tickets_status; ?>
											</td>
										</tr>
										<tr>
											<td>
												<?php _e('Topic', 'robodesk'); ?>
											</td>
											<td>
												<?php
												if (is_array($term_post) && !empty($term_post)) {
													echo ($term_post[0]->name);
												} else {
													echo '--';
												}
												?>
											</td>
										</tr>
										<tr>
											<td>
												<?php _e('Created Date', 'robodesk'); ?>
											</td>
											<td>
												<?php echo get_the_date(); ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="single-ticket-block">
							<h5>
								<?php _e('User', 'robodesk'); ?>
							</h5>
							<div class="ticket-table">
								<table>
									<tbody>
										<tr>
											<td>
												<?php _e('Name', 'robodesk'); ?>
											</td>
											<td>
												<?php echo ($robodesk_ticket_username); ?>
											</td>
										</tr>
										<tr>
											<td>
												<?php _e('Email', 'robodesk'); ?>
											</td>
											<td>
												<?php echo ($robodesk_ticket_email); ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<?php

					if (isset($_POST['submit_tickets'])) {
						$tickets_reply = $_POST['tickets_reply'];
						$robodesk_tickets_comment_data = array(
							'comment_post_ID' => $post->ID,
							'comment_content' => $tickets_reply,
							'comment_author' => $current_user->display_name,
							'comment_author_email' => $current_user->user_email,
							'comment_type' => 'tickets_replies',
							'user_id' => $current_user->ID,
							'comment_date' => get_the_date(__('M d')),
							'comment_approved' => 1,
						);
						$commentid = wp_insert_comment($robodesk_tickets_comment_data);
					}

					/*get replies*/

					$args = array(

						'post_id' => $post->ID,
						'type' => 'tickets_replies'
					);

					$get_tickets_replies = get_comments($args);

					function filter_media_comment_status($open, $post_id)
					{
						$post = get_post($post_id);
						if ($post->post_type == 'robodesk_tickets') {
							return false;
						}
						return $open;
					}
					add_filter('comments_open', 'filter_media_comment_status', 10, 2);
					?>
					<div class="reply-detail">
						<?php foreach ($get_tickets_replies as $replies) { ?>
							<div class="avatar-message user-message">
								<div class="panel-image user">
									<img class="avatar" alt="Avatar"
										src="//www.gravatar.com/avatar/394b69f87b5e402481cbf8ce069ce8ac?s=80&amp;d=mm">
								</div>
								<div class="panel-heading user">
									<h6>
										<?php echo ($replies->comment_author); ?>
									</h6>
									<span class="date"><b>Posted:</b>
										<?php echo ($replies->comment_date_gmt); ?>
									</span>
									<!--<span class="date"><b>Posted:</b> <?php echo date('F j, Y'); ?></span>-->
								</div>
								<div class="panel-reply user">
									<p>
										<?php echo $replies->comment_content; ?>
									</p>
								</div>
							</div>

						<?php } ?>

					</div>
					<form class="registered_form" id="loginform" name="loginform" action="" method="post">
						<h3>Post a Reply</h3>
						<div class="form-group">
							<textarea name="tickets_reply" id="tickets_editor" placeholder="Write your message"></textarea>
							<script>ClassicEditor
									.create(document.querySelector('#tickets_editor'), {

										toolbar: {
											items: [
												'heading',
												'|',
												'bold',
												'italic',
												'link',
												'bulletedList',
												'numberedList',
												'|',
												'indent',
												'outdent',
												'|'
											]
										},
										language: 'en',
										image: {
											toolbar: [
												'imageTextAlternative',
												'imageStyle:full',
												'imageStyle:side'
											]
										},
										table: {
											contentToolbar: [
												'tableColumn',
												'tableRow',
												'mergeTableCells'
											]
										},
										licenseKey: '',

									})
									.then(editor => {
										window.editor = editor;
									})
									.catch(error => {
										console.error('Oops, something went wrong!');
										console.error('Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:');
										console.warn('Build id: k2i30chx32nf-8o65j7c6blw0');
										console.error(error);
									});
							</script>


							<button type="Submit" name="submit_tickets" class="btn">Submit Ticket</button>
							<script>
								if (window.history.replaceState) {
									window.history.replaceState(null, null, window.location.href);
								}
							</script>
					</form>
					<div class="button-bottom">
						<a href="http://193.235.147.161/wp/robodesk/my-ticket/" class="btn">Back to Tickets</a>
						<a href="" class="btn btn-logout">Log Out</a>
					</div>
				</div>
			</div>
		</div>

		<?php

	} else {

		_e('<p class="tickets_notice_error">You are not allowded to view this tickets</p>', 'robodesk');
	}
} else {

	_e('<p class="tickets_notice_error">Please log in to view tickets</p>', 'robodesk');
}


get_footer();