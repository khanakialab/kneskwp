<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php echo get_field('head_start_customcode', 'option', false); ?>
	<title>
		<?php
			echo wp_title('', true, 'right');
		?>
	</title>

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,600i,700,700i,800,800i|Josefin+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">

	<script type="text/javascript">
		var admin_ajax_url = <?php echo json_encode(admin_url('admin-ajax.php')); ?>;
		var base_url = "<?php echo site_url(); ?>";
		var theme_url = "<?php echo get_template_directory_uri() ?>";
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>