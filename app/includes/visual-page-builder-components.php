<?php
add_action( 'vc_before_init', 'vc_before_init_actions' );

function vc_before_init_actions() {

    /*
	Element Description: Page Header
	*/
	class vcPageHeader extends WPBakeryShortCode {
		function __construct() {
			add_action( 'init', array( $this, 'vc_pageheader_mapping' ) );
			add_shortcode( 'vc_pageheader', array( $this, 'vc_pageheader_html' ) );

		}

		public function vc_pageheader_mapping() {

			/* Stop all if VC is not enabled */
			if ( !defined( 'WPB_VC_VERSION' ) ) {
					return;
			}

			vc_map(
				array(
					'name' => __('Page Header', 'text-domain'),
					'base' => 'vc_pageheader',
					'description' => __('Page Header Section', 'text-domain'),
					'category' => __('Custom Elements', 'text-domain'),
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => __( 'Title', 'js_composer' ),
							'param_name' => 'title',
							'value' => 'Page Title',
							'description' => __( '' ),
						),
						array(
							'type' => 'checkbox',
							'heading' => __( 'Show Breadcrumb ?', 'js_composer' ),
							'param_name' => 'breadcrumb',
							'description' => __( '' ),
							'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
						),
						array(
							'type'     => 'dropdown',
							'heading' => __( 'Text Align', 'js_composer' ),
							'param_name' => 'textalign',
							'description' => __( '' ),
							'value'  => array(
								'Left' => 'vc_align_left',
								'Right' => 'vc_align_right',
								'Center' => 'vc_align_center',
							),
						)
					)
				)
			);
		}



		public function vc_pageheader_html( $atts ) {
            global $timber;

			
                $atts = shortcode_atts(
					array(
						'title'   => '',
						'breadcrumb' => '',
                        'textalign' => 'vc_align_left',
                        'uniqid' => 'c'.uniqid()
					),
					$atts
				);
		
			$html = '';
			
            $context = $timber::get_context();
            $data = array_merge($context, $atts);
            // $context['content'] = $value['article'];
            // $context['css_class'] = $value['css_class'];
            // logconsole($data);
            $html .= $timber::compile('website/hello.twig', $data);
            
            
			// $html = ob_get_contents();
			wp_reset_postdata();
			// ob_end_clean();
			return $html;

		}

	}

    new vcPageHeader();
    

    class vcHelloWorld2 extends WPBakeryShortCode {
		function __construct() {
			add_action( 'init', array( $this, 'vc_helloworld2_mapping' ) );
			add_shortcode( 'vc_helloworld2', array( $this, 'vc_helloworld2_html' ) );

		}

		public function vc_helloworld2_mapping() {

			/* Stop all if VC is not enabled */
			if ( !defined( 'WPB_VC_VERSION' ) ) {
					return;
			}

			vc_map(
				array(
					'name' => __('Hello World 2', 'text-domain'),
					'base' => 'vc_helloworld2',
					'description' => __('Hello World 2 Section', 'text-domain'),
					'category' => __('Custom Elements', 'text-domain'),
					'params' => array(
						array(
							'type' => 'textfield',
							'heading' => __( 'Title', 'js_composer' ),
							'param_name' => 'title',
							'value' => 'Page Title',
							'description' => __( '' ),
						),
						array(
							'type' => 'checkbox',
							'heading' => __( 'Show Breadcrumb ?', 'js_composer' ),
							'param_name' => 'breadcrumb',
							'description' => __( '' ),
							'value' => array( __( 'Yes', 'js_composer' ) => 'yes' ),
						),
						array(
							'type'     => 'dropdown',
							'heading' => __( 'Text Align', 'js_composer' ),
							'param_name' => 'textalign',
							'description' => __( '' ),
							'value'  => array(
								'Left' => 'vc_align_left',
								'Right' => 'vc_align_right',
								'Center' => 'vc_align_center',
							),
						)
					)
				)
			);
		}



		public function vc_helloworld2_html( $atts ) {
            global $timber;

			
                $atts = shortcode_atts(
					array(
						'title'   => '',
						'breadcrumb' => '',
                        'textalign' => 'vc_align_left',
                        'uniqid' => 'c'.uniqid()
					),
					$atts
				);
		
			$html = '';
			
            $context = $timber::get_context();
            $data = array_merge($context, $atts);
            // $context['content'] = $value['article'];
            // $context['css_class'] = $value['css_class'];
            // logconsole($data);
            $html .= $timber::compile('website/hello2.twig', $data);
            
            
			// $html = ob_get_contents();
			wp_reset_postdata();
			// ob_end_clean();
			return $html;

		}

	}

	new vcHelloWorld2();

}
