<?php
/**!
 * Login Scripts
 */

// Show less info to users on failed login for security.
// Will not let a valid username be known.
add_filter( 'login_errors', function() {
	return "<strong>ERROR</strong>: Incorrect Username or Password";
});

// Custom Login theme
add_action( 'login_enqueue_scripts', function() {
	$background_url = !empty(get_theme_mod('login_background')) ? esc_url(get_theme_mod('login_background')) : get_template_directory_uri(). '/assets/images/banners/login-background.jpeg';
	$logo_url = !empty(get_site_icon_url()) ? esc_url(get_site_icon_url()) : esc_url(get_template_directory_uri().'/assets/images/logos/allenOLogo.jpeg');

	echo '
	<style type="text/css">
		body.login {
			background-image: url("'.$background_url.'");
			background-size: cover;
			background-repeat: no-repeat;
			background-attachment: fixed;
		}
		
		#login h1 a,
		.login h1 a {
			background-image: url('.$logo_url.');
		}
		
		body.login #backtoblog,
		body.login #nav {
			background-color: white;
			padding-top: 10px;
			padding-bottom: 10px;
			box-shadow: 0 1px 3px rgba(0,0,0,.13);
		}
	</style>';
});

// Replace WordPress URL with Website URL
add_filter( 'login_headerurl', function(){
	return home_url();
});

// Replace WordPress title with Website title
add_filter( 'login_headertext', function(){
	return get_bloginfo('description');
});

// Disable Sign-up page
add_action( 'signup_header', function() {
	wp_redirect(home_url());
	die();
});

?>