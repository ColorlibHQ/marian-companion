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
 * Marian elementor hero section widget.
 *
 * @since 1.0
 */
class Marian_Hero extends Widget_Base {

	public function get_name() {
		return 'marian-hero';
	}

	public function get_title() {
		return __( 'Hero Section', 'marian-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'marian-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Hero content ------------------------------
		$this->start_controls_section(
			'hero_content',
			[
				'label' => __( 'Hero section content', 'marian-companion' ),
			]
        );
        
		$this->add_control(
            'sliders', [
                'label' => __( 'Create New Slider', 'marian-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ sec_title }}}',
                'fields' => [
                    [
                        'name' => 'item_img',
                        'label' => __( 'Item Image', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                        'default'     => [
                            'url'   => Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name' => 'sec_title',
                        'label' => __( 'Title', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'top hotel in the city', 'marian-companion' ),
                    ],
                    [
                        'name' => 'sub_title',
                        'label' => __( 'Sub Title', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Hotel & Resourt', 'marian-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'sec_title'    => __( 'top hotel in the city', 'marian-companion' ),
                        'sub_title'    => __( 'Hotel & Resourt', 'marian-companion' ),
                    ],
                    [      
                        'sec_title'    => __( 'top hotel in the city', 'marian-companion' ),
                        'sub_title'    => __( 'Hotel & Resourt', 'marian-companion' ),
                    ],
                    [      
                        'sec_title'    => __( 'top hotel in the city', 'marian-companion' ),
                        'sub_title'    => __( 'Hotel & Resourt', 'marian-companion' ),
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
			'title_col', [
				'label' => __( 'Big Title Color', 'marian-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider-area .h1-slider-caption h1' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'sub_title_col', [
				'label' => __( 'Sub Title Color', 'marian-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider-area .h1-slider-caption h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'border_col', [
				'label' => __( 'Border Color', 'marian-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider-area .h1-slider-caption h3::before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .slider-area .h1-slider-caption h3::after' => 'background: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();
	}
    
	protected function render() {
    $this->load_widget_script();
    $settings  = $this->get_settings();
    $sliders = !empty( $settings['sliders'] ) ? $settings['sliders'] : '';
    ?>

    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="slider-active dot-style">
            <?php 
            if( is_array( $sliders ) && count( $sliders ) > 0 ) {
                foreach( $sliders as $item ) {
                    $sec_img   = !empty( $item['item_img']['url'] ) ? $item['item_img']['url'] : '';
                    $sec_title = !empty( $item['sec_title'] ) ? $item['sec_title'] : '';
                    $sub_title = !empty( $item['sub_title'] ) ? $item['sub_title'] : '';
                    ?>
                    <div class="single-slider  hero-overly slider-height d-flex align-items-center" data-background="<?php echo esc_url( $sec_img ); ?>" >
                        <div class="container">
                            <div class="row justify-content-center text-center">
                                <div class="col-xl-9">
                                    <div class="h1-slider-caption">
                                        <?php 
                                            if ( $sec_title ) { 
                                                echo '<h1 data-animation="fadeInUp" data-delay=".4s">'.esc_html( $sec_title ).'</h1>';
                                            }
                                            if ( $sub_title ) { 
                                                echo '<h3 data-animation="fadeInDown" data-delay=".4s">'.esc_html( $sub_title ).'</h3>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <!-- slider Area End-->
    <?php
    } 

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
                   
            /* 3. MainSlider-1 */
                // h1-hero-active
                function mainSlider() {
                var BasicSlider = $('.slider-active');
                BasicSlider.on('init', function (e, slick) {
                    var $firstAnimatingElements = $('.single-slider:first-child').find('[data-animation]');
                    doAnimations($firstAnimatingElements);
                });
                BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
                    var $animatingElements = $('.single-slider[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
                    doAnimations($animatingElements);
                });
                BasicSlider.slick({
                    autoplay: false,
                    autoplaySpeed: 4000,
                    dots: true,
                    fade: true,
                    arrows: false,
                    // prevArrow: '<button type="button" class="slick-prev"><img src="img/hero_thumb/arrow-left.png" alt=""><img class="secondary-img" src="img/hero_thumb/left-white.png" alt=""></button>',
                    // nextArrow: '<button type="button" class="slick-next"><img src="img/hero_thumb/arrow-right.png" alt=""><img class="secondary-img" src="img/hero_thumb/right-white.png" alt=""></button>',
                    responsive: [{
                        breakpoint: 1024,
                        settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        }
                    },
                    {
                        breakpoint: 991,
                        settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false
                        }
                    }
                    ]
                });

                function doAnimations(elements) {
                    var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                    elements.each(function () {
                    var $this = $(this);
                    var $animationDelay = $this.data('delay');
                    var $animationType = 'animated ' + $this.data('animation');
                    $this.css({
                        'animation-delay': $animationDelay,
                        '-webkit-animation-delay': $animationDelay
                    });
                    $this.addClass($animationType).one(animationEndEvents, function () {
                        $this.removeClass($animationType);
                    });
                    });
                }
                }
                mainSlider();
        })(jQuery);
        </script>
        <?php 
        }
    }	
}