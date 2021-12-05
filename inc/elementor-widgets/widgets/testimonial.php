<?php
namespace Marianelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Marian elementor testimonial section widget.
 *
 * @since 1.0
 */
class Marian_Testimonial extends Widget_Base {

	public function get_name() {
		return 'marian-testimonial';
	}

	public function get_title() {
		return __( 'Testimonial Section', 'marian-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'marian-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  testimonial content ------------------------------
		$this->start_controls_section(
			'testimonial_content',
			[
				'label' => __( 'Testimonial contents', 'marian-companion' ),
			]
        );
        
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Sec Title', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Testimonial', 'marian-companion' ),
            ]
        );
		$this->add_control(
            'sliders', [
                'label' => __( 'Create New Slider', 'marian-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ client_name }}}',
                'fields' => [
                    [
                        'name' => 'client_img',
                        'label' => __( 'Client Image', 'marian-companion' ),
                        'description' => __( 'Best size is 100x100', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'client_name',
                        'label' => __( 'Client Name', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Clifford Frazier', 'marian-companion' ),
                    ],
                    [
                        'name' => 'client_designation',
                        'label' => __( 'Client Designation', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Creative Director', 'marian-companion' ),
                    ],
                    [
                        'name' => 'feedback_stars',
                        'label' => __( 'Rating', 'marian-companion' ),
                        'type' => Controls_Manager::CHOOSE,
                        'options' => [
                            '1' => [
                                'title' => __( 'Star 1', 'plugin-domain' ),
                                'icon' => 'eicon-star',
                            ],
                            '2' => [
                                'title' => __( 'Star 2', 'plugin-domain' ),
                                'icon' => 'eicon-star',
                            ],
                            '3' => [
                                'title' => __( 'Star 3', 'plugin-domain' ),
                                'icon' => 'eicon-star',
                            ],
                            '4' => [
                                'title' => __( 'Star 4', 'plugin-domain' ),
                                'icon' => 'eicon-star',
                            ],
                            '5' => [
                                'title' => __( 'Star 5', 'plugin-domain' ),
                                'icon' => 'eicon-star',
                            ],
                        ],
                        'toggle' => true,
                    ],
                    [
                        'name' => 'text',
                        'label' => __( 'Review', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'Yorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.', 'marian-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'client_name'           => __( 'Clifford Frazier', 'marian-companion' ),
                        'client_designation'    => __( 'Creative Director', 'marian-companion' ),
                        'feedback_stars'        => 'star_5',
                        'text'                  => __( 'Yorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.', 'marian-companion' ),
                    ],
                    [      
                        'client_name'           => __( 'Clifford Frazier', 'marian-companion' ),
                        'client_designation'    => __( 'Creative Director', 'marian-companion' ),
                        'feedback_stars'        => 'star_5',
                        'text'                  => __( 'Yorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi.', 'marian-companion' ),
                    ],
                ]
            ]
        );
        $this->end_controls_section(); // End Hero content


    /**
     * Style Tab
     * ------------------------------ Style Title ------------------------------
     *
     */
        $this->start_controls_section(
			'style_title', [
				'label' => __( 'Style Hero Section', 'marian-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'quotation_col', [
				'label' => __( 'Double Quotation Color', 'marian-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial_area .single_testmonial .author_thumb::before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}
    
	protected function render() {
    $this->load_widget_script();
    $settings  = $this->get_settings();
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sliders = !empty( $settings['sliders'] ) ? $settings['sliders'] : '';
    ?>
    
    <!-- Testimonial Start -->
    <div class="testimonial-area testimonial-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-9 col-lg-9 col-md-9">
                    <div class="h1-testimonial-active">
                        <?php 
                        if( is_array( $sliders ) && count( $sliders ) > 0 ) {
                            foreach( $sliders as $item ) {
                                $client_name = !empty( $item['client_name'] ) ? $item['client_name'] : '';
                                $client_img   = !empty( $item['client_img']['id'] ) ? wp_get_attachment_image( $item['client_img']['id'], 'marian_testimonial_thumb_100x100', '', array( 'alt' => $client_name ) ) : '';
                                $client_designation = !empty( $item['client_designation'] ) ? $item['client_designation'] : '';
                                $feedback_stars = !empty( $item['feedback_stars'] ) ? $item['feedback_stars'] : '';
                                $text = !empty( $item['text'] ) ? $item['text'] : '';
                                ?>
                                <div class="single-testimonial pt-65">
                                    <div class="font-back-tittle mb-105">
                                        <div class="archivment-front">
                                            <?php
                                                if ( $client_img ) {
                                                    echo wp_kses_post($client_img);
                                                }
                                            ?>
                                        </div>
                                        <?php
                                            if ( $sec_title ) {
                                                echo '<h3 class="archivment-back">'.esc_html($sec_title).'</h3>';
                                            }
                                        ?>
                                    </div>
                                    <div class="testimonial-caption text-center">
                                        <?php
                                            if ( $text ) {
                                                echo '<p>'.wp_kses_post($text).'</p>';
                                            }
                                            if ( $feedback_stars != '' ) {
                                                echo '<div class="testimonial-ratting">';
                                                for ($i = 1; $i <= 5; $i++) {
                    
                                                    if ($feedback_stars >= $i) {
                                                        echo '<i class="fas fa-star"></i>';
                                                    }
                                                }
                                                echo '</div>';
                                            }
                                        ?>
                                        <div class="rattiong-caption">
                                            <?php
                                                if ( $client_name ) {
                                                    echo '<span>'.esc_html($client_name).', <span>'.esc_html($client_designation).'</span> </span>';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonial_end -->
    <?php
    } 

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            /* 4. Testimonial Active*/
            var testimonial = $('.h1-testimonial-active');
                if(testimonial.length){
                testimonial.slick({
                    dots: false,
                    infinite: true,
                    speed: 1000,
                    autoplay:false,
                    arrows: true,
                    prevArrow: '<button type="button" class="slick-prev"><i class="ti-angle-left"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="ti-angle-right"></i></button>',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: false,
                        arrow:true
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows:false
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows:false,
                        }
                    }
                    ]
                });
            }   
        })(jQuery);
        </script>
        <?php 
        }
    }	
}