<?php
//require_once dirname( __DIR__ ) . '/wp-load.php';

//wp_mail('rohitkc7@gmail.com','subject','body','');
if ( !function_exists( 'wp_new_user_notification' ) ) {
  function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user            = new WP_User($user_id);
        $user_data       = get_userdata( $user_id );
        $firstname       = $user_data->first_name;
        $user_login      = stripslashes( $user_data->user_login );
		echo htmlentities($user);    

        
        // URLs
        $site_url  = site_url();
        $ads_url   = site_url( 'ads/' );
        $login_url = site_url();
         
        // Email variables
        $headers            = 'From: EXAMPLE.INFO <info@example.info>' . "rn";
        $blog_name          = get_option( 'blogname' );
        $admin_subject      = 'New User Registration on ' . $blog_name;
        $welcome_subject    = 'Welcome to Robodesk!';
        $welcome_email      = stripslashes( $user_data->user_email );
        $admin_email        = get_option('admin_email');
       
        $admin_message =
<<<EOT
<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head><body>
<div class="content">
    <div class="wrapper">
        <p>New user registration on your blog: {$blog_name}.</p>
        <p>Username: {$user_login}</p>
        <p>Email: {$welcome_email}</p>
    </div>
</div>
</body></html>
EOT;
     
        $welcome_message =
<<<EOT
<!DOCTYPE html><html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head><body>
<div class="content">
<div class="wrapper">
<table width="100%"><tr><td>
Hello {$firstname},<br />
To log into your account, 
go <a href="{$login_url}">visit our site</a> 
and use the credentials below.<br />
Your Username: {$user_login}<br />
Your Password: {$plaintext_pass}<br />
</td></tr></table>
</div>
</div>
</body></html>
EOT;
print_r($admin_email);
//die()
        wp_mail( $admin_email, $admin_subject, $admin_message, $headers );
        wp_mail( $welcome_email, $welcome_subject, $welcome_message, $headers );

} // End of wp_new_user_notification()
}


