<?php

require_once( get_template_directory() ."/vendor/autoload.php");

class Slider extends WPBakeryShortCode {

    public $twig;

    public function __construct(){

        $loader = new Twig_Loader_Filesystem(get_template_directory() .'/shortcodes/custom/tpl');
        $this->twig = new   \Twig\Environment($loader, array(
            'cache' => false,
        ));
        
        add_action( 'init', array( $this, 'mapping' ) );
        add_shortcode( 'Slider', array( $this, 'html' ) );
    

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
            $pages[$post->ID] = $post->post_name;
        }
            
        // Map the block with vc_map()
        $subparams = [
            [
              "type" => "colorpicker",
              "heading" => "Background color",
              "param_name" => "bg_color"
            ],
                 [
               "type" => "attach_image",
               "heading" => "Background image",
               "param_name" => "bg_img"
             ],
             [
               "type" => "attach_image",
               "heading" => "Background image mobile",
               "param_name" => "bg_img_mobile"
             ],
             [
               "type" => "attach_image",
               "heading" => "Model image",
               "param_name" => "model_img"
             ],
             [
               "type" => "attach_image",
               "heading" => "Model image mobile",
               "param_name" => "model_img_mobile"
             ],
                   [
               "type" => "attach_image",
               "heading" => "Object image",
               "param_name" => "object_img"
             ],
                   [
               "type" => "attach_image",
               "heading" => "Object image mobile",
               "param_name" => "object_img_mobile"
             ],
                   [
                       "type" => "textarea",
                       "heading" => "Slide content",
                       "param_name" => "slide_content"
                   ],
             [
               "type" => "textfield",
                       "heading" => "Button link",
                       "param_name" => "btn_link"
             ],
             [
               "type" => "textfield",
                       "heading" => "Button text",
                       "param_name" => "btn_txt"
             ],
             [
               "type" => "colorpicker",
                       "heading" => "Button color",
                       "param_name" => "btn_color"
             ]
        ];

        vc_map( 
            array(
                'name' => __('Slider', 'text-domain'),
                'base' => 'Slider',
                'description' => __('Modulo slider', 'text-domain'), 
                'category' => __('BrandSpa', 'text-domain'),   
                'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',        
                'params' => array(
                    array(
                        'type' => 'param_group',
                        'param_name' => 'slides',
                        'params' => $subparams,
                        'group' => 'General',
                    ),
                ),
            )
        );
        
    }

    private function parseSlides($slides) {
        $parseAtts = function_exists('vc_param_group_parse_atts') ? vc_param_group_parse_atts( $slides ) : [];
        
        $arrResult = array_map(function($slide) {
            if(!empty($slide)) {
                $slide['bg_img'] = getAttachment($slide, 'bg_img');
                $slide['bg_img_mobile'] = getAttachment($slide, 'bg_img_mobile');
                $slide['model_img'] = getAttachment($slide, 'model_img');
                $slide['model_img_mobile'] = getAttachment($slide, 'model_img_mobile');
                $slide['object_img'] = getAttachment($slide, 'object_img');
                $slide['object_img_mobile'] = getAttachment($slide, 'object_img_mobile');
            }
    
            return $slide;
    
        }, $parseAtts);
    
        return $arrResult;
    }    

    public function html($atts){

        $at = shortcode_atts( [ 'slides' => '' ], $atts );
        $at = $this->parseSlides($at['slides']);
        return $this->twig->render('Slider.php', ['slides'=>$at, 'template'=> get_template_directory_uri()]);

    }

}
new Slider();