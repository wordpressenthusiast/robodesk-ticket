<?php
// If this file is called directly, abort.
if (!defined('ABSPATH')) {
	die;
}

require_once plugin_dir_path(__FILE__) . 'robodesk-tickets-add-on-shortcodes.php';
require_once plugin_dir_path(__FILE__) . 'robodesk-notifications.php';




/**
 * Robodesk Tickets enqueue scripts and styles
 */
if (!function_exists('robodesk_tickets_addon_style_script')) {
	function robodesk_tickets_addon_style_script($tag)
	{
		//$robodesk_tickests_plugin_url = plugin_dir_url( __FILE__ );
		wp_enqueue_style('robodesk_tickets_addon', plugin_dir_url(__FILE__) . "assets/css/robodesk_tickets_addon.css");
		// wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/example.js', array(), '1.0.0', true );
		wp_enqueue_style('robodesk_tickets_addon_font', "https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap");
		wp_enqueue_script('robodesk_tickets_addon_js', plugin_dir_url(__FILE__) . "assets/js/robodesk_tickets_addon.js");
		wp_enqueue_script('robodesk_tickets_addon_editor', plugin_dir_url(__FILE__) . "assets/js/ckeditor.js");
		$page_id = get_queried_object_id();
		$page_object = get_page($page_id);

		//	if ( strpos($page_object->post_content, '[robodesk_tickets_create_ticket]')  || strpos($page_object->post_content, '[robodesk_tickets_ticket_single]') ){
		//		wp_enqueue_script( 'robodesk_tickets_dropzone_js',  plugin_dir_url( __FILE__ ). "assets/js/robodesk_tickets_dropzone.js");
		//	}
	}

	add_action('wp_enqueue_scripts', 'robodesk_tickets_addon_style_script', 99);

}

/**
 * Robodesk Tickets admin enqueue scripts and styles
 */

if (!function_exists('robodesk_tickets_addon_admin_style_script')) {
	function robodesk_tickets_addon_admin_style_script($tag)
	{

		wp_enqueue_style('robodesk_tickets_addon_admin', plugin_dir_url(__FILE__) . "assets/css/robodesk_tickets_addon_admin.css");

	}

	add_action('admin_enqueue_scripts', 'robodesk_tickets_addon_admin_style_script', 99);

}



/**
 * Create robodesk custom post type
 */

if (!function_exists('robodesk_tickets_custom_post_type')) {
	function robodesk_tickets_custom_post_type()
	{
		$labels = array(
			'name' => __('Tickets', 'robodesk'),
			'singular_name' => __('Robodesk Tickets', 'robodesk'),
			// 'menu_name'           => __( 'Tickets %%PENDING_COUNT%%','robodesk'),
			'menu_name' => __('Tickets', 'robodesk'),
			'parent_item_colon' => __('Parent Robodesk tickets', 'robodesk'),
			'all_items' => __('All Robodesk tickets', 'robodesk'),
			'view_item' => __('View Robodesk tickets', 'robodesk'),
			'add_new_item' => __('Add New Robodesk tickets', 'robodesk'),
			'add_new' => __('Add New', 'robodesk'),
			'edit_item' => __('Edit Robodesk tickets', 'robodesk'),
			'update_item' => __('Update Robodesk tickets', 'robodesk'),
			'search_items' => __('Search Robodesk tickets', 'robodesk'),
			'not_found' => __('Not Found', 'robodesk'),
			'not_found_in_trash' => __('Not found in Trash', 'robodesk')
		);
		$args = array(
			'label' => __('Tickets', 'robodesk'),
			'description' => __('Tickets', 'robodesk'),
			'labels' => $labels,
			'supports' => array('title', 'editor', 'comments', 'custom-fields', 'author'),
			'public' => true,
			'hierarchical' => true,
			'show_ui' => true,
			'menu_icon' => 'dashicons-feedback',
			'show_in_menu' => true,
			'show_in_nav_menus' => true,
			'show_in_admin_bar' => true,
			'has_archive' => true,
			'can_export' => true,
			'exclude_from_search' => false,
			'yarpp_support' => true,
			'publicly_queryable' => true,
			'capability_type' => array('robodesk_ticket', 'robodesk_tickets'),
			'map_meta_cap' => true,

		);
		register_post_type('robodesk_tickets', $args);
	}

	add_action('init', 'robodesk_tickets_custom_post_type', 0);
}


/**
 * Register Topic Taxonomy for the CPT 'Tickets post type' .
 *
 * @since    1.0.0
 */
if (!function_exists('robodesk_tickets_custom_taxonomy')) {
	function robodesk_tickets_custom_taxonomy()
	{

		$labels = array(
			'name' => _x('Tickets Topic', 'taxonomy general name', 'robodesk'),
			'singular_name' => _x('Tickets Topic', 'taxonomy singular name', 'robodesk'),
			'search_items' => __('Search Tickets Topic', 'robodesk'),
			'all_items' => __('All Tickets Topic', 'robodesk'),
			'parent_item' => __('Parent Tickets Topic', 'robodesk'),
			'parent_item_colon' => __('Parent Tickets Topic:', 'robodesk'),
			'edit_item' => __('Edit Tickets Topic', 'robodesk'),
			'update_item' => __('Update Tickets Topic', 'robodesk'),
			'add_new_item' => __('Add New Tickets Topic', 'robodesk'),
			'new_item_name' => __('New Topic', 'robodesk'),
			'menu_name' => __('Tickets Topic', 'robodesk'),
		);

		register_taxonomy('robodesk_tickets_topic', array('robodesk_tickets'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'robodesk_tickets_topic'),
		));
	}
	add_action('init', 'robodesk_tickets_custom_taxonomy', 0);
}



/**
 * Register Priority Taxonomy for the CPT 'Tickets post type' .
 *
 * @since    1.0.0
 */
if (!function_exists('robodesk_tickets_priority_taxonomy')) {
	function robodesk_tickets_priority_taxonomy()
	{

		$labels = array(
			'name' => _x('Tickets Priority', 'Tickets Priority', 'robodesk'),
			'singular_name' => _x('Tickets Priority', 'Tickets Priority', 'robodesk'),
			'search_items' => __('Search Tickets Priority', 'robodesk'),
			'all_items' => __('All Tickets Priority', 'robodesk'),
			'parent_item' => __('Parent Tickets Priority', 'robodesk'),
			'parent_item_colon' => __('Parent Tickets Priority:', 'robodesk'),
			'edit_item' => __('Edit Tickets Priority', 'robodesk'),
			'update_item' => __('Update Tickets Priority', 'robodesk'),
			'add_new_item' => __('Add New Tickets Priority', 'robodesk'),
			'new_item_name' => __('New Priority', 'robodesk'),
			'menu_name' => __('Tickets Priority', 'robodesk'),
		);

		register_taxonomy('robodesk_tickets_priority', array('robodesk_tickets'), array(
			'hierarchical' => true,
			'labels' => $labels,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'robodesk_tickets_priority'),
		));
	}
	add_action('init', 'robodesk_tickets_priority_taxonomy', 0);
}


/*create robodesk tickets user roles;*/


/*user role for Support Customer*/

$result = add_role('support_customer', __(
	'Support Customer', 'robodesk'),
	array(
		'read' => true,  // true allows this capability
		'edit_posts' => true,
		'delete_posts' => false, // Use false to explicitly deny
	));

/*user role for Support Manager*/
$result = add_role('support_manager', __(
	'Support Manager', 'robodesk'),
	array(
		'read' => true,  // true allows this capability
		'edit_posts' => true,
		'delete_posts' => true, // Use false to explicitly deny
	));


/*user role for Support Agent*/
$result = add_role('support_agent', __(
	'Support Agent', 'robodesk'),
	array(
		'read' => true,  // true allows this capability
		'edit_posts' => true,
		'delete_posts' => true, // Use false to explicitly deny
	));



//add role capabilities
add_action('admin_init', 'robodesk_add_role_caps', 999);

function robodesk_add_role_caps()
{

	$roles = array('support_agent', 'administrator');
	foreach ($roles as $the_role) {
		$role = get_role($the_role);

		$role->add_cap('read');
		$role->add_cap('delete_robodesk_tickets');
		$role->add_cap('read_robodesk_tickets');
		$role->add_cap('read_private_robodesk_ticekts');
		$role->add_cap('edit_robodesk_tickets');
		$role->add_cap('edit_other_robodesk_tickets');
		$role->add_cap('edit_published_robodesk_tickets');
		$role->add_cap('publish_robodesk_tickets');
		$role->add_cap('delete_others_robodesk_tickets');
		$role->add_cap('delete_published_robodesk_tickets');
		$role->add_cap('delete_private_robodesk_tickets');


	}
}

add_filter('wp_dropdown_users', 'robodesk');
function test($output)
{
	global $post;

	//Doing it only for the custom post type
	if ($post->post_type == ('robodesk_tickets')) {
		$users = get_users(array('role' => 'support_customer'));
		$output .= "<p>Assign this post to</p> <select id='post_author_override' name='post_author_override' class=''>";
		foreach ($users as $user) {
			$output .= "<option value='" . $user->id . "'>" . $user->user_login . "</option>";
		}
		$output .= "</select>";
	}
	return $output;
}

/**
 * add custom fields for custom post type
 */
if (!function_exists('robodesk_ticket_fields')) {
	function robodesk_ticket_fields()
	{
		add_meta_box('robodesk_tickets_meta_fields', 'User Details', 'robodesk_meta_ticket_field_callback', 'robodesk_tickets', 'side', 'default');

	}
	add_action('add_meta_boxes', 'robodesk_ticket_fields');

}


// Metabox HTML
if (!function_exists('robodesk_meta_ticket_field_callback')) {
	function robodesk_meta_ticket_field_callback($post)
	{

		wp_nonce_field('robodesk_ticket_metabox_nonce', 'robodesk_ticket_meta_fields_nonce');
		$robodesk_ticket_username = get_post_meta($post->ID, 'User', true);
		$robodesk_ticket_email = get_post_meta($post->ID, 'From', true);
		//$robodesk_ticket_convert_to_faq = get_post_meta( $post->ID, 'robodesk_ticket_convert_to_faq', true );

		//update_post_meta($post->ID, 'Username' , $ticekt_user);
		//update_post_meta($post->ID, 'E-mail', $ticket_email);
		?>

		<!-- <label class="cpm-checkbox"><h4>  <?php // _e( 'Convert to FAQ?', 'robodesk' );?></h4></label>
			<input type="checkbox" name="robodesk_ticket_convert_to_faq"  value="yes" <?php //checked($robodesk_ticket_convert_to_faq, 'yes'); ?>> -->


		<label for="robodesk_design">
			<h4>
				<?php _e('Name', 'robodesk'); ?>
			</h4>
		</label>
		<input type="text" id="" class="widefat" name="User" value="<?php echo esc_attr($robodesk_ticket_username); ?>"
			size="25" readonly />


		<label for="robodesk_design">
			<h4>
				<?php _e('Email', 'robodesk'); ?>
			</h4>
		</label>
		<input type="email" id="" class="widefat" name="From" value="<?php echo esc_attr($robodesk_ticket_email); ?>" size="25"
			readonly />

		<?php
	}

}





/**
 * add attachment fields for custom post type
 */
if (!function_exists('robodesk_ticket_attachment_fields')) {
	function robodesk_ticket_attachment_fields()
	{
		add_meta_box('robodesk_tickets_meta_attachment_fields', 'Submitted Attachment', 'robodesk_meta_ticket_attachment_field_callback', 'robodesk_tickets', 'normal', 'default');

	}
	add_action('add_meta_boxes', 'robodesk_ticket_attachment_fields');

}



// Metabox HTML

if (!function_exists('robodesk_meta_ticket_attachment_field_callback')) {
	function robodesk_meta_ticket_attachment_field_callback($post)
	{

		wp_nonce_field('robodesk_ticket_metabox_nonce', 'robodesk_ticket_meta_attachment_fields_nonce');

		$robodesk_ticket_attachment = get_post_meta($post->ID, '_thumbnail_id', true);
		$img_atts = wp_get_attachment_image_src($robodesk_ticket_attachment, 'thumbnail');


		$attachment_page = wp_get_attachment_url($robodesk_ticket_attachment);

		?>


		<label for="robodesk_design">
			<h4>
				<?php _e('Attachment', 'robodesk'); ?>
			</h4>
		</label>

		<img src="<?php //echo $img_atts[0]; ?>">
		<a target="_blank" href="<?php echo ($attachment_page); ?>">
			<?php echo ($attachment_page); ?>
		</a>


		<?php
	}

}


/**
 * add tickets status box for admin to select tickets status.
 */
if (!function_exists('robodesk_ticket_status_fields')) {
	function robodesk_ticket_status_fields()
	{
		add_meta_box('robodesk_tickets_meta_status_fields', 'Tickets Status', 'robodesk_meta_ticket_status_field_callback', 'robodesk_tickets', 'side', 'default');

	}
	add_action('add_meta_boxes', 'robodesk_ticket_status_fields');

}

// Metabox HTML
if (!function_exists('robodesk_meta_ticket_status_field_callback')) {
	function robodesk_meta_ticket_status_field_callback($post)
	{

		wp_nonce_field('robodesk_ticket_metabox_nonce', 'robodesk_ticket_meta_status_fields_nonce');

		$robodesk_ticket_status = get_post_meta($post->ID, 'robodesk_tickets_status', true);

		?>


		<label for="robodesk_design">
			<h4>
				<?php _e('Select Tickets Status', 'robodesk'); ?>
			</h4>
		</label>

		<select class="widefat" name="tickets_status">
			<option value="Open" <?php if ($robodesk_ticket_status == "Open")
				echo 'selected="selected"'; ?>>
				<?php _e('Open', 'robodesk'); ?>
			</option>
			<option value="Closed" <?php if ($robodesk_ticket_status == "Closed")
				echo 'selected="selected"'; ?>>
				<?php _e('Closed', 'robodesk'); ?>
			</option>
		</select>
		<?php
	}

}


// save meta box function
if (!function_exists('robodesk_ticket_save_status_meta_box_data')) {
	function robodesk_ticket_save_status_meta_box_data($post_id)
	{

		if (!isset($_POST['robodesk_ticket_meta_status_fields_nonce']) || !wp_verify_nonce($_POST['robodesk_ticket_meta_status_fields_nonce'], 'robodesk_ticket_metabox_nonce'))
			return;

		if (!current_user_can('edit_post', $post_id))
			return;

		if (isset($_POST['tickets_status'])) {
			update_post_meta($post_id, 'robodesk_tickets_status', sanitize_text_field($_POST['tickets_status']));
		}

	}

}
add_action('save_post', 'robodesk_ticket_save_status_meta_box_data');


/**
 * Insert user submitted query to tickets post type
 */
if (!function_exists('robodesk_ticket_fields_insert_ticket')) {
	function robodesk_ticket_fields_insert_ticket()
	{

		$message = wp_strip_all_tags($_POST['message']);
		$email = $_POST['email'];
		$name = $_POST['name'];

		// for robodesk tickets add on
		global $post;

		$robodesk_tickets = array(
			'post_title' => $message,
			'post_content' => '',
			'post_status' => 'publish',           // Choose: publish, preview, future, draft, etc.
			'post_type' => 'robodesk_tickets'  //'post',page' or use a custom post type if you want to

		);

		$pid = wp_insert_post($robodesk_tickets);


		// echo $email;
		// echo $name;



		if (!empty($email)) {
			update_post_meta($pid, 'robodesk_ticket_email', $email);

			# code...
		}

		if (!empty($name)) {
			update_post_meta($pid, 'robodesk_ticket_username', $name);
		}

	}
	add_action('robodesk_after_contact_success_message', 'robodesk_ticket_fields_insert_ticket');

}


/**
 * Insert user submitted query to tickets post type
 */
if (!function_exists('robodesk_ticket_show_related_faqs')) {
	function robodesk_ticket_show_related_faqs()
	{

		$robodesk_tickets_related_query = new WP_Query(array('posts_per_page' => -1, 's' => esc_attr($_POST['message']), 'post_type' => 'faqs'));

		if ($robodesk_tickets_related_query->have_posts()): ?>
			<p class="suggested-faq">
				<?php _e('In the meantime, you may be able to find a FAQS. Here are some populars FAQs related to your Query', 'robodesk'); ?>
			</p>
			<?php
			while ($robodesk_tickets_related_query->have_posts()):
				$robodesk_tickets_related_query->the_post();

				global $post;
				$robodesk_id = $post->ID;


				?>

				<div class="chat_msg_item chat_msg_item_admin card">

					<div class="robodesk-featured">
						<div class="faqoress-img">
							<img src='<?php echo plugin_dir_url(__FILE__) . "img/robodesk-content.png"; ?>'>
						</div>

						<div class="robodesk-content">
							<h3><a class="robodesk_title" id="<?php echo ($robodesk_id); ?>" data-title="<?php the_title(); ?>" href="#">
									<?php the_title(); ?>
								</a></h3>
							<p>
								<?php echo wp_trim_words(get_the_content(), 15, '...'); ?>
							</p>
						</div>
					</div>
				</div>

			<?php endwhile;
			wp_reset_postdata();

			// else :
			// 	_e("No post Were found on this keyword", 'robodesk');

		endif;
	}

	add_action('robodesk_contact_success_message', 'robodesk_ticket_show_related_faqs');
}






if (!function_exists('robodesk_tickets_support_customer_registration_save')) {
	function robodesk_tickets_support_customer_registration_save()
	{


		$robodesk_tickets_not_logged_name = $_POST['name'];
		$robodesk_tickets_not_logged_email = $_POST['email'];


		$robodesk_email_exists = email_exists($robodesk_tickets_not_logged_email);


		if ($robodesk_email_exists) {
			//echo "That E-mail is registered to user number " . $exists;

		} else {

			$robodesk_userdata = array(
				'user_login' => $robodesk_tickets_not_logged_name,
				'user_email' => $robodesk_tickets_not_logged_email


			);
			$user_id = wp_insert_user($robodesk_userdata);
			wp_new_user_notification($user_id, null, 'both');

			// echo $user_id;


			$user = new WP_User($user_id);

			$user->remove_role('subscriber');
			$user->add_role('support_customer');


		}
	}
	add_action('robodesk_before_contact_success_message', 'robodesk_tickets_support_customer_registration_save');
}

/**
 * My tickets search by topic or id
 */
if (!function_exists('robodesk_ticket_my_tickets_search')) {
	function robodesk_ticket_my_tickets_search($post)
	{


		$the_query = new WP_Query(array('posts_per_page' => -1, 's' => esc_attr($_POST['search_keyword']), 'post_type' => 'robodesk_tickets', 'author' => get_current_user_id()));


		if ($the_query->have_posts()):
			while ($the_query->have_posts()):
				$the_query->the_post();
				global $post;
				$robodesk_user_tickets_id = $post->ID;
				?>
				<ul>
					<li>
						<a class="robodesk_tickets_title" id="<?php echo ($robodesk_user_tickets_id); ?>" data-title="<?php the_title(); ?>"
							href="<?php echo get_permalink(); ?>">
							<?php the_title(); ?>
						</a>
					</li>
				</ul>
			<?php endwhile;
			wp_reset_postdata();

		else:
			_e("No post Were found on this keyword", 'robodesk');

		endif;

		die();

	}

	add_action('wp_ajax_robodesk_ticket_my_tickets_search', 'robodesk_ticket_my_tickets_search');
}




function load_robodesk_tickets_template($template)
{
	global $post;

	if ('robodesk_tickets' === $post->post_type && locate_template(array('single-robodesk-tickets.php')) !== $template) {
		/*
		 * This is a 'movie' post
		 * AND a 'single movie template' is not found on
		 * theme or child theme directories, so load it
		 * from our plugin directory.
		 */
		return plugin_dir_path(__FILE__) . 'single-robodesk-tickets.php';
	}

	return $template;
}

add_filter('single_template', 'load_robodesk_tickets_template');

