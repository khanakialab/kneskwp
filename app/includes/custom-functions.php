<?php
$renderNavBar = function ($atts=[]) use ($timber) {
	extract(shortcode_atts(array(
        "logo" => get_field('logo_white', 'option'),
        "css_class" => '',
    ), $atts));
	$navHtml = wp_nav_menu(array(
			'menu' => 'Primary',
			'container' => false,
			'menu_class' => 'nav-menu hidden-xs hidden-sm hidden-md',
			'echo' => false
		));

		$logo = $logo ?: get_field('logo_white', 'option');
		$context = $timber::get_context();
		$context['logo'] = $logo;
		$context['navHtml'] = $navHtml;
		$context['css_class'] = $css_class;

		return $timber::compile('navbar.twig', $context);
};


$renderFooter = function ($atts=[]) use ($timber) {


	$navHtml = wp_nav_menu(array(
		'menu' => 'Footer',
		'container' => false,
		'menu_class' => 'nav-menu hidden-xs hidden-sm hidden-md footer-menu',
		'echo' => false
	));

	$navHtmlPrivacy = wp_nav_menu(array(
		'menu' => 'Privacy',
		'container' => false,
		'menu_class' => 'nav-menu hidden-xs hidden-sm hidden-md footer-menu',
		'echo' => false
	));
	
	$data = array(
		'logo' => get_field('logo', 'option'),
		'copyright' => get_field('copyright', 'option'),
		'email' => get_field('email', 'option'),
		'phone' => get_field('phone', 'option'),
		'phone_href' => get_field('phone_href', 'option'),
		'social_icons' => get_field('social_icons', 'option'),
		'navHtml' => $navHtml,
		'navHtmlPrivacy' => $navHtmlPrivacy
	);

	return $timber::compile('footer.twig', $data);
};



add_filter('timber_context', function($data) use ($renderNavBar, $renderFooter) {
	$data['navbar'] = $renderNavBar();
	$data['footer'] = $renderFooter();
	return $data;
});



add_action( 'wp_ajax_signup_newsletter', 'signup_newsletter' );
add_action( 'wp_ajax_nopriv_signup_newsletter', 'signup_newsletter' );
function signup_newsletter() {
	$email = $_REQUEST['email'];

	$adminEmail = get_field('admin_email', 'option');
	wp_mail( $adminEmail, 'Subscribe', $email);

	$response = \App\Oye\ResponseHelper::ok('200', 'subscription_success', 'Subscription successfull.');
	// $response = \App\Oye\ResponseHelper::error('400', 'subscription_failed', 'Subscription failed.');
	echo json_encode($response);
	die();
}