<?php

function knesk_widgets_init() {
	register_sidebar( array(
	'name'          => __( 'Widget Area', 'knesktd' ),
	'id'            => 'sidebar-1',
	'description'   => __( 'Add widgets here to appear in your sidebar.', 'knesktd' ),
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h2 class="widget-title">',
	'after_title'   => '</h2>',
	) );
 
	register_sidebar( array(
		'name'          => __( 'Footer Column', 'knesktd' ),
		'id'            => 'footercol-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'knesktd' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'knesk_widgets_init' );

?>