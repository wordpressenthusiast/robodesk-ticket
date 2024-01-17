<?php


/**
 * Tickets Add On Shortcode files
 */
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
	die;
}


// error_reporting(E_ALL);
// ini_set("display_errors", 1);

/**
 * Create User Login shortcode for registered user
 */

if (!function_exists('robodesk_tickets_registered_user_login_form')) {
	function robodesk_tickets_registered_user_login_form()
	{

		ob_start();


		// if( is_user_logged_in() ) {

		// 	global $current_user;
		// 	$user = get_currentuserinfo();

		// 	$user->display_name;

		// 	echo "Your are Logged In as : " . "$user->display_name";

		// 	exit;
		// }
		/*login form handler for registered user*/
		if ($_POST) {

			global $wpdb;

			//We shall SQL escape all inputs  
			$username = $wpdb->escape($_REQUEST['username']);
			$password = $wpdb->escape($_REQUEST['password']);
			// $remember = $wpdb->escape($_REQUEST['rememberme']);  

			// if($remember) $remember = "true";  
			// else $remember = "false";  

			$login_data = array();
			$login_data['user_login'] = $username;
			$login_data['user_password'] = $password;
			//$login_data['remember'] = $remember;  

			$user_verify = wp_signon($login_data, false);

			if (is_wp_error($user_verify)) {
				echo "Invalid login details";
				// Note, I have created a page called "Error" that is a child of the login page to handle errors. This can be anything, but it seemed a good way to me to handle errors.  
			} else {
				echo "Login in Successful "; //"<script type='text/javascript'>window.location.href='". home_url() ."'</script>";  
				exit();
			}

		} else {

			// No login details entered - you should probably add some more user feedback here, but this does the bare minimum  

			//echo "Invalid login details";  

		}


		?>

		<div class="register-page">
			<div class="content">
				<div class="form-header">
					<h3 class="robodesk_tickets_header">Welcome back to Robodesk</h3>
					<p>Login with your registered Email & Password.</p>
				</div>
				<form class="registered_form" id="loginform" name="loginform" action="" method="post">
					<input name="email" id="robodesk_tickets_user_login" class="required" type="email" placeholder="Email Address" />
					<input name="password" id="robodesk_tickets_user_pass" class="required" type="password" placeholder="Password" />
					<p>
						<input id="checkbox-signup rememberme" class="form-checkbox" name="rememberme" value="forever"
							type="checkbox">Remember me
						<a href="http://193.235.147.161/wp/robodesk/forget-password" class="link-btn">Forget your password?</a>
					</p>
					<button id="robodesk_tickets_login_submit" class="btn">Login Now</button>
				</form>
				<div class="social-login">
					<h5>Or login with</h5>
					<a href="#" class="facebook-btn">
						<i class="fa fa-facebook fa-lg"></i>
						facebook
					</a>
					<a href="#" class="google-btn">
						<i class="fa fa-google-plus fa-lg"></i>
						Google
					</a>
				</div>
				<div class="message">Don't have an account? <a href="http://193.235.147.161/wp/robodesk/sign-up">Register Now</a>
				</div>
			</div>
		</div>
		<?php



		$robodesk_tickets_user_login = ob_get_clean();
		return $robodesk_tickets_user_login;


	}

	add_shortcode('robodesk_tickets_user_login_form', 'robodesk_tickets_registered_user_login_form');
}



/*Sign in form*/
if (!function_exists('robodesk_tickets_user_signup_form')) {
	function robodesk_tickets_user_signup_form()
	{

		ob_start(); ?>


		<div class="register-page">
			<div class="content">
				<div class="form">
					<div class="form-header">
						<h3>Create your free Account</h3>
						<p>Come join our community! Let's setup your account.</p>
					</div>
					<form class="registered_form" name="signupform" id="signupform" action="" method="post">
						<input name="first-name" class="input-name required" type="text" placeholder="First Name" />
						<input name="last-name" class="input-name required" type="text" placeholder="Last Name" />
						<input name="email" class="required" type="email" placeholder="Email Address" />
						<input name="password" class="required" type="password" placeholder="Password" />

						<p class="consent-text">
							<input id="checkbox-signup rememberme" class="form-checkbox" name="rememberme" value="forever"
								type="checkbox">
							I agree to the Terms and Privacy Policy.
						</p>

						<button id="robodesk_tickets_signup_submit" class="btn">Create Account</button>
					</form>
					<div class="social-login">
						<h5>Or Sign Up with</h5>
						<a href="#" class="facebook-btn">
							<i class="fa fa-facebook fa-lg"></i>
							facebook
						</a>
						<a href="#" class="google-btn">
							<i class="fa fa-google-plus fa-lg"></i>
							Google
						</a>
					</div>
					<div class="message">Already registered? <a href="http://193.235.147.161/wp/robodesk/login">Log In</a></div>
				</div>
			</div>
		</div>



		<?php



		$robodesk_tickets_user_signup = ob_get_clean();
		return $robodesk_tickets_user_signup;


	}

	add_shortcode('robodesk_tickets_signup_form', 'robodesk_tickets_user_signup_form');
}



/*Forget Password*/

if (!function_exists('robodesk_tickets_user_forget_password_form')) {
	function robodesk_tickets_user_forget_password_form()
	{

		ob_start(); ?>


		<div class="register-page password-page">
			<div class="content">
				<div class="form">
					<div class="form-header">
						<h3>Forget Your Password</h3>
						<p>Looks like you forget your password. If you have forgotten your password you can reset here</p>
					</div>
					<form class="registered_form" name="forget_password" id="forget_password" action="" method="post">
						<input name="email" id="robodesk_tickets_email" class="required" type="email" placeholder="Email Address">
						<div class="reset-button">
							<button id="reset_submit" class="btn">Reset Password</button>
							<a href="http://193.235.147.161/wp/robodesk/login" class="link-btn">Back to login</a>
						</div>
					</form>
					<form class="registered_form" name="forget_password" id="forget_password" action="" method="post">
						<input name="password" class="required" type="password" placeholder="Password">
						<input name="password" class="required" type="password" placeholder="Confirm Password">
						<div class="reset-button">
							<button id="reset_submit" class="btn">Change Password</button>
						</div>
					</form>
				</div>
			</div>
		</div>



		<?php



		$robodesk_tickets_forget_password = ob_get_clean();
		return $robodesk_tickets_forget_password;


	}

	add_shortcode('robodesk_tickets_forget_password_form', 'robodesk_tickets_user_forget_password_form');
}



/*Create Ticket Shortcode*/


if (!function_exists('robodesk_tickets_user_create_ticket')) {
	function robodesk_tickets_user_create_ticket()
	{


		ob_start();


		?>

		<div class="ticket-page">
			<div class="content">
				<div class="ticket-form">
					<div class="form">
						<div class="form-header">
							<h3>
								<?php _e('Open a new ticket', 'robodesk'); ?>
							</h3>
							<p>
								<?php _e('Please fill in the form below to open a new ticket.', 'robodesk'); ?>
							</p>
						</div>

						<?php
						global $current_user;
						// var_dump($current_user);
				
						$user_roles = $current_user->roles;

						if (is_user_logged_in()) {

							if (in_array('support_customer', $user_roles)) {


								if (isset($_POST['submit_tickets'])) {
									/*save user created tickets to tickets post type*/
									$tickets_success = "";
									$user = wp_get_current_user();
									$user_name = $user->user_login;
									$user_email = $user->user_email;

									$tickets_title = $_POST['tickets_title'];
									$tickts_description = $_POST['message'];
									$category_id = $_POST['tickets_topic'];
									$tickets_priority_id = $_POST['tickets_priority'];


									global $post;

									$robodesk_create_tickets = array(
										'post_title' => $tickets_title,
										'post_content' => $tickts_description,
										'post_status' => 'publish',           // Choose: publish, preview, future, draft, etc.
										'post_type' => 'robodesk_tickets',  //'post',page' or use a custom post type if you want to
										'tax_input' => array(
											'robodesk_tickets_topic' => array($category_id),
											'robodesk_tickets_priority' => array($tickets_priority_id)
										),
									);

									$ticket_id = wp_insert_post($robodesk_create_tickets);

									if (is_wp_error($ticket_id)) {
										echo $ticket_id->get_error_message();
									} else {
										$ticket_success = "<p class='tickets_notice_success'>Thank yoy !!, Your ticket created Successfully. We will get back to you.</p>";
										_e($ticket_success, 'robodesk');

										update_post_meta($ticket_id, 'robodesk_ticket_email', $user_email);
										update_post_meta($ticket_id, 'robodesk_ticket_username', $user_name);
										update_post_meta($ticket_id, 'robodesk_tickets_status', 'Open');

										/*media upload functions*/
										if (!function_exists('wp_generate_attachment_metadata')) {
											require_once(ABSPATH . "wp-admin" . '/includes/image.php');
											require_once(ABSPATH . "wp-admin" . '/includes/file.php');
											require_once(ABSPATH . "wp-admin" . '/includes/media.php');
										}
										if ($_FILES) {
											foreach ($_FILES as $file => $array) {
												if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK) {
													//return "upload error : " . $_FILES[$file]['error'];
												}
												$attachment_files = $_FILES['file'];
												$attach_id = media_handle_upload($file, $ticket_id);
											}
										}
										if ($attach_id > 0) {
											//and if you want to set that image as Post  then use:
											update_post_meta($ticket_id, '_thumbnail_id', $attach_id);
										}

									}
								}

								//echo "Sorry, support team members cannot submit tickets from here. If you need to open a ticket, please go to your admin panel or click here to open a new ticket.";
				
								?>

								<form class="registered_form" name="" id="" action="" method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label>
											<?php _e('Select Topic', 'robodesk'); ?>
										</label>
										<select name="tickets_topic">
											<option>
												<?php _e('— Select a Help Topic —', 'robodesk'); ?>
											</option>

											<?php

											$args = array(
												'taxonomy' => 'robodesk_tickets_topic',
												'orderby' => 'name',
												'order' => 'ASC',
												'hide_empty' => 0,
											);

											$cats = get_categories($args);
											//var_dump($cats);
											foreach ($cats as $cat) {
												echo "<option value=" . $cat->term_id . " >" . $cat->name . "</option>";
											}
											?>

										</select>
									</div>
									<div class="form-group">
										<label>
											<?php _e('Select Priority', 'robodesk'); ?>
										</label>
										<select name="tickets_priority">
											<option>
												<?php _e('— Select a Help Priority —', 'robodesk'); ?>
											</option>

											<?php

											$argsp = array(
												'taxonomy' => 'robodesk_tickets_priority',
												'orderby' => 'name',
												'order' => 'ASC',
												'hide_empty' => 0,
											);

											$cats_priority = get_categories($argsp);
											//var_dump($cats);
											foreach ($cats_priority as $catp) {
												echo "<option value=" . $catp->term_id . " >" . $catp->name . "</option>";
											}
											?>

										</select>
									</div>
									<div class="form-group">
										<label>
											<?php _e('Subject', 'robodesk'); ?>
										</label>
										<input name="tickets_title" id="" class="required" type="text">
									</div>
									<div class="form-group">
										<label>
											<?php _e('Description', 'robodesk'); ?>
										</label>
										<textarea name="message" placeholder="Write your message"></textarea>
									</div>
									<div class="form-group file-area">
										<label>
											<?php _e('Attachment', 'robodesk'); ?>
										</label>
										<div id="drop-zone">
											<p id="btn_file_uploader" class="file_uploader_text">
												<?php _e('Drop files here or choose them', 'robodesk'); ?>
											</p>
											<div id="clickHere">
												<input type="file" name="file" id="file" multiple />
											</div>
											<div id='filename'></div>
										</div>
									</div>
									<button id="" name="submit_tickets" class="btn">
										<?php _e('Submit Ticket', 'robodesk'); ?>
									</button>
								</form>

								<?php
							} else {



								echo "Sorry, support team members cannot submit tickets from here. If you need to open a ticket, please go to your admin panel or click here to open a new ticket.";

								?>

							<?php } ?>
						</div>
					</div>
					<div class="button-bottom">
						<a href="http://193.235.147.161/wp/robodesk/my-ticket/" class="btn">
							<?php _e('My Tickets', 'robodesk'); ?>
						</a>
						<a href="" class="btn btn-logout">
							<?php _e('Log Out', 'robodesk'); ?>
						</a>
					</div>
					<?php
						} else {

							_e('Please login to create tickets', 'robodesk');
						}
						?>
			</div>
		</div>

		<?php
		$robodesk_tickets_user_frontend = ob_get_clean();
		return $robodesk_tickets_user_frontend;
	}
	add_shortcode('robodesk_tickets_create_ticket', 'robodesk_tickets_user_create_ticket');
}


/*My Tickets Shortcode*/

if (!function_exists('robodesk_tickets_user_my_ticket')) {
	function robodesk_tickets_user_my_ticket()
	{
		ob_start();

		global $post;

		if (is_user_logged_in()) {

			get_current_user_id() == $post->post_author

				?>

			<div class="ticket-page">
				<div class="content">
					<div class="ticket-section">
						<div class="ticket-header">
							<h3>
								<?php _e('My Tickets', 'robodesk'); ?>
							</h3>
							<a href="http://193.235.147.161/wp/robodesk/create-ticket/" style="font-weight: 700;">
								<?php _e('+ MAKE SUPPORT REQUEST', 'robodesk'); ?>
							</a>
						</div>
						<div class="ticket-search">
							<div class="search">
								<input type="search" class="searchterm" placeholder="Search by topic or id"
									value="<?php echo get_search_query(); ?>" name="postSearch_tickets" id="tickets-search">
								<button type="submit" id="searchsubmit" class="searchbutton">
									<i class="fa fa-search"></i>
								</button>
							</div>
							<div id="tickets_datafetch"></div>
						</div>
						<div class="top-btn">
							<a href="#" class="btn btn-credential">
								<?php _e('Private Credentials', 'robodesk'); ?>
							</a>
							<div class="faq-pc-modal" style="display: none;">
								<a href="#" class=" faq-close-btn">
									<?php _e('x', 'robodesk'); ?>
								</a>
								<div class="faq-pc-modal-content">
									<h3>
										<?php _e('Add Private Credentials', 'robodesk'); ?>
									</h3>
									<form class="faq-pc-form">
										<div class="faq-form-group">
											<label>
												<?php _e('System', 'robodesk'); ?>
											</label>
											<input type="text" name="system" placeholder="cPanel, WordPress, FTP, ..." required="">
										</div>
										<div class="faq-form-group">
											<label>
												<?php _e('Username', 'robodesk'); ?>
											</label>
											<input type="text" name="username" placeholder="" required="">
										</div>
										<div class="faq-form-group">
											<label>
												<?php _e('Password', 'robodesk'); ?>
											</label>
											<input type="password" name="password" placeholder="" required="">
										</div>
										<div class="faq-form-group">
											<label>
												<?php _e('URL', 'robodesk'); ?>
											</label>
											<input type="url" name="url" placeholder="www.example.com" required="">
										</div>
										<div class="faq-form-group">
											<label>
												<?php _e('Note', 'robodesk'); ?>
											</label>
											<textarea></textarea>
										</div>
										<div class="faq-form-group checkbox-row">
											<input type="checkbox" required="">
											<label>
												<?php _e('Reset encryption key on Save', 'robodesk'); ?>
											</label>
										</div>
										<div class="faq-pc-btn">
											<button class="btn" type="submit">
												<?php _e('Save', 'robodesk'); ?>
											</button>
											<button class="btn faq-close-btn">
												<?php _e('Cancel', 'robodesk'); ?>
											</button>
										</div>
									</form>
								</div>
							</div>
							<a href="" class="btn btn-logout">
								<?php _e('Log Out', 'robodesk'); ?>
							</a>
						</div>
						<div class="ticket-table">
							<table>
								<thead>
									<tr>
										<th>
											<?php _e('Ticket ID', 'robodesk'); ?>
										</th>
										<th>
											<?php _e('Status', 'robodesk'); ?>
										</th>
										<th>
											<?php _e('Date', 'robodesk'); ?>
										</th>
										<th>
											<?php _e('Topic', 'robodesk'); ?>
										</th>
										<th>
											<?php _e('Priority', 'robodesk'); ?>
										</th>
										<th>
											<?php _e('Subject', 'robodesk'); ?>
										</th>
									</tr>
								</thead>

								<tbody>

									<!-- get user created tickets -->

									<?php

									$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
									$terms = get_terms(array(
										'taxonomy' => 'robodesk_tickets_topic',
										'hide_empty' => false,
									));


									$current_user = wp_get_current_user();
									$is_admin = in_array('administrator', $current_user->roles);

									$author_param = $is_admin ? '' : get_current_user_id();

									$args = array(
										'post_type' => 'robodesk_tickets',
										'author' => $author_param,
										'posts_per_page' => 5,
										'paged' => $paged
									);

									// $args = array(
									// 	'post_type' => 'robodesk_tickets',
									// 	'author' => get_current_user_id(),
									// 	'posts_per_page' => 5,
									// 	'paged' => $paged
						
									// );
						
									$query = new WP_Query($args);

									//var_dump($query);
						
									if ($query->have_posts()) {
										while ($query->have_posts()):
											$query->the_post();
											$term_post = get_the_terms(get_the_ID(), 'robodesk_tickets_topic');
											$term_post_priority = get_the_terms(get_the_ID(), 'robodesk_tickets_priority');

											?>
											<tr>

												<td> <a href="<?php echo get_post_permalink(); ?>">#
														<?php echo get_the_ID(); ?>
													</a> </td>
												<td>
													<?php $robodesk_tickets_status = get_post_meta(get_the_ID(), 'robodesk_tickets_status', true); ?>
													<span class="ticket-label ticket-status <?php echo $robodesk_tickets_status; ?>">
														<?php echo $robodesk_tickets_status; ?>
													</span>
												</td>
												<td>
													<time datetime="<?php echo get_the_date(); ?>">
														<?php echo get_the_date(); ?>
													</time>
												</td>
												<td>

													<span class="ticket-label">
														<?php
														if (is_array($term_post) && !empty($term_post)) {
															echo ($term_post[0]->name);
														} else {
															echo '--';
														}
														?>
													</span>
												</td>
												<td>
													<span class="ticket-label">
														<?php
														if (is_array($term_post_priority) && !empty($term_post)) {
															echo ($term_post_priority[0]->name);
														} else {
															echo '--';
														}
														?>
													</span>

												</td>
												<td>
													<span class="ticket-label">
														<?php the_title(); ?>
													</span>
												</td>

											</tr>

											<?php
										endwhile;
										wp_reset_postdata();
										?>
									</tbody>
								</table>

							</div>
						</div>
						<div class="button-bottom">
							<?php

							$total_pages = $query->max_num_pages;

							if ($total_pages > 1) {

								$current_page = max(1, get_query_var('paged'));

								echo paginate_links(array(
									'base' => get_pagenum_link(1) . '%_%',
									'format' => 'page/%#%',
									'current' => $current_page,
									'total' => $total_pages,
									'prev_text' => __('&laquo'),
									'next_text' => __('&raquo'),
									'type' => 'list',
								));
							}

									}
									?>
					</div>

				</div>
			</div>
			</div>


			<?php
		} else {

			_e('No tickets Found', 'robodesk');

		}
		$robodesk_tickets_user_frontend = ob_get_clean();
		return $robodesk_tickets_user_frontend;
	}
	add_shortcode('robodesk_tickets_frontend_my_ticket', 'robodesk_tickets_user_my_ticket');
}

/*Tickets single shortcode*/

if (!function_exists('robodesk_tickets_user_ticket_single')) {
	function robodesk_tickets_user_ticket_single()
	{
		ob_start(); ?>

		<div class="ticket-page">
			<div class="content">
				<div class="ticket-content">
					<h3>Test</h3>
					<div class="ticket-info">
						<div class="single-ticket-block">
							<h5>Ticket Status</h5>
							<div class="ticket-table">
								<table>
									<tbody>
										<tr>
											<td>Ticket ID</td>
											<td>#37861</td>
										</tr>
										<tr>
											<td>Status</td>
											<td>Open</td>
										</tr>
										<tr>
											<td>Topic</td>
											<td>Feedback</td>
										</tr>
										<tr>
											<td>Created Date</td>
											<td>August 20, 2020 11:54 am</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="single-ticket-block">
							<h5>User</h5>
							<div class="ticket-table">
								<table>
									<tbody>
										<tr>
											<td>Name</td>
											<td>Nikita Pudasaini</td>
										</tr>
										<tr>
											<td>Email</td>
											<td>nikita@gmail.com</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="reply-detail">
						<div class="avatar-message user-message">
							<div class="panel-image user">
								<img class="avatar" alt="Avatar"
									src="//www.gravatar.com/avatar/394b69f87b5e402481cbf8ce069ce8ac?s=80&amp;d=mm">
							</div>
							<div class="panel-heading user">
								<h6>Demo</h6>
								<span class="date"><b>Posted:</b> 18/08/2020</span>
							</div>
							<div class="panel-reply user">
								<p>Moiz Test</p>
							</div>
						</div>
						<div class="avatar-message response">
							<div class="panel-image">
								<img class="avatar" alt="Avatar"
									src="//www.gravatar.com/avatar/394b69f87b5e402481cbf8ce069ce8ac?s=80&amp;d=mm">
							</div>
							<div class="panel-heading">
								<h6>Support</h6>
								<span class="date"><b>Posted:</b> 08/29/20</span>
							</div>
							<div class="panel-reply">
								<p>Fine :)</p>
							</div>
						</div>
					</div>
					<form class="registered_form" id="loginform" name="loginform" action="" method="post">
						<h3>Post a Reply</h3>
						<div class="form-group">
							<textarea name="message" placeholder="Write your message"></textarea>
							<div id="drop-zone">
								<p id="btn_file_uploader" class="file_uploader_text">Drop files here or choose them</p>
								<div id="clickHere">
									<input type="file" name="file" id="file" multiple />
								</div>
								<div id='filename'></div>
							</div>
							<button id="" class="btn">Submit Ticket</button>
					</form>
					<div class="button-bottom">
						<a href="http://193.235.147.161/wp/robodesk/my-ticket/" class="btn">Back to Tickets</a>
						<a href="" class="btn btn-logout">Log Out</a>
					</div>
				</div>
			</div>
		</div>
		<?php
		$robodesk_tickets_user_frontend = ob_get_clean();
		return $robodesk_tickets_user_frontend;
	}
	add_shortcode('robodesk_tickets_ticket_single', 'robodesk_tickets_user_ticket_single');
}