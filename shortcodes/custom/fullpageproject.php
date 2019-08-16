<?php

    require_once( get_template_directory() ."/vendor/autoload.php");

    class FullPageProject extends WPBakeryShortCode {

        public $twig;

        public function __construct(){

            $loader = new Twig_Loader_Filesystem(get_template_directory() .'/shortcodes/custom/tpl');
            $this->twig = new   \Twig\Environment($loader, array(
                'cache' => false,
			));
			
            add_action( 'init', array( $this, 'mapping' ) );
            add_shortcode( 'fullpageproject', array( $this, 'html' ) );
        

        }

        public function mapping(){
            // Stop all if VC is not enabled
	        if ( !defined( 'WPB_VC_VERSION' ) ) {
	            return;
            }
            
            $query = new WP_Query( array( 'post_type' => 'page' ) );
            $posts = $query->posts;

            $pages = [];
            foreach($posts as $post){
                $pages[$post->post_title] = $post->ID;
			}
	         
	        // Map the block with vc_map()
	        vc_map( 
	            array(
	                'name' => __('Full page project', 'text-domain'),
	                'base' => 'fullpageproject',
	                'description' => __('Modulo de pantalla completa', 'text-domain'), 
	                'category' => __('BrandSpa', 'text-domain'),   
	                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
	                'params' => array(  
						array(
	                        'type' => 'colorpicker',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Color del texto', 'text-domain' ),
	                        'param_name' => 'textcolor',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( '', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'General',
                        ),

	                    array(
	                        'type' => 'textfield',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Categoría', 'text-domain' ),
	                        'param_name' => 'category',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( '', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'General',
	                    ), 

	                    array(
	                        'type' => 'textfield',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Título', 'text-domain' ),
	                        'param_name' => 'title',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( '', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'General',
	                    ), 
						array(
	                        'type' => 'dropdown',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Proyecto', 'text-domain' ),
	                        'param_name' => 'project',
	                        'value' => $pages,
	                        'description' => __( '', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'General',
                        ),
                        
                        array(
	                        'type' => 'attach_image',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Logo/Imagen', 'text-domain' ),
	                        'param_name' => 'logoimage',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( '', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'General',
                        ),

	                    array(
	                        'type' => 'textarea',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Descripción', 'text-domain' ),
	                        'param_name' => 'description',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( '', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'General',
                        ),
                        
                        array(
	                        'type' => 'attach_image',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Imagen', 'text-domain' ),
	                        'param_name' => 'bgimage',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( '', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Fondo',
                        ),

                        array(
	                        'type' => 'colorpicker',
	                        'holder' => 'h3',
	                        'class' => 'title-class',
	                        'heading' => __( 'Color', 'text-domain' ),
	                        'param_name' => 'bgcolor',
	                        'value' => __( '', 'text-domain' ),
	                        'description' => __( '', 'text-domain' ),
	                        'admin_label' => false,
	                        'weight' => 0,
	                        'group' => 'Fondo',
                        ),
                        
	                ),
	            )
            );
            
        }

        public function html($atts){
            extract(
	            shortcode_atts(
	                array(
						'textcolor'   => '',
	                    'category'   => '',
	                    'title' => '',
						'project' => '',
						'logoimage'   => '',
	                    'description' => '',
						'bgimage' => '',
						'bgcolor'   => ''
	                ), 
	                $atts
	            )
			);

			$atts['lang'] = get_locale();
			$atts['bgimage'] = array_key_exists('bgimage', $atts) ? wp_get_attachment_image_src($atts['bgimage'], 'full')[0]: '';
			$atts['logoimage'] = array_key_exists('logoimage', $atts) ? wp_get_attachment_image_src($atts['logoimage'], 'full')[0] : '';
			$atts['project'] = array_key_exists('project', $atts) ? get_post_permalink($atts['project']) : '';
			
            return $this->twig->render('fullpageproject.php', $atts);

        }

    }
    new FullPageProject();