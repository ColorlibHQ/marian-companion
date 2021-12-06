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
 * Marian elementor apartments section widget.
 *
 * @since 1.0
 */
class Marian_Apartments extends Widget_Base {

	public function get_name() {
		return 'marian-apartments';
	}

	public function get_title() {
		return __( 'Apartments Section', 'marian-companion' );
	}

	public function get_icon() {
		return 'eicon-apps';
	}

	public function get_categories() {
		return [ 'marian-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  apartments content ------------------------------
		$this->start_controls_section(
			'apartments_content',
			[
				'label' => __( 'Apartments contents', 'marian-companion' ),
			]
        );
        
        $this->add_control(
            'sec_title_back',
            [
                'label' => esc_html__( 'Sec Title Back', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Our Rooms', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Our Rooms', 'marian-companion' ),
            ]
        );
		$this->add_control(
            'apartments', [
                'label' => __( 'Create New Slider', 'marian-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'apartment_img',
                        'label' => __( 'Image', 'marian-companion' ),
                        'description' => __( 'Best size is 360x371', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'title',
                        'label' => __( 'Title', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Classic Double Bed', 'marian-companion' ),
                    ],
                    [
                        'name' => 'price',
                        'label' => __( 'Price', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( '150', 'marian-companion' ),
                    ],
                    [
                        'name' => 'price_label',
                        'label' => __( 'Price Label', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'par night', 'marian-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'title'         => __( 'Classic Double Bed', 'marian-companion' ),
                        'price'         => __( '150', 'marian-companion' ),
                        'price_label'   => __( 'par night', 'marian-companion' ),
                    ],
                    [      
                        'title'         => __( 'Classic Double Bed', 'marian-companion' ),
                        'price'         => __( '150', 'marian-companion' ),
                        'price_label'   => __( 'par night', 'marian-companion' ),
                    ],
                    [      
                        'title'         => __( 'Classic Double Bed', 'marian-companion' ),
                        'price'         => __( '150', 'marian-companion' ),
                        'price_label'   => __( 'par night', 'marian-companion' ),
                    ],
                    [      
                        'title'         => __( 'Classic Double Bed', 'marian-companion' ),
                        'price'         => __( '150', 'marian-companion' ),
                        'price_label'   => __( 'par night', 'marian-companion' ),
                    ],
                    [      
                        'title'         => __( 'Classic Double Bed', 'marian-companion' ),
                        'price'         => __( '150', 'marian-companion' ),
                        'price_label'   => __( 'par night', 'marian-companion' ),
                    ],
                    [      
                        'title'         => __( 'Classic Double Bed', 'marian-companion' ),
                        'price'         => __( '150', 'marian-companion' ),
                        'price_label'   => __( 'par night', 'marian-companion' ),
                    ],
                ]
            ]
        );
        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'View More', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'btn_url',
            [
                'label' => esc_html__( 'Button URL', 'marian-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );
        $this->end_controls_section(); // End Hero content

        //------------------------------ Style title ------------------------------
        
        // Top Section Styles
        $this->start_controls_section(
            'apartment_sec_style', [
                'label' => __( 'Apartments Section Styles', 'marian-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_col', [
                'label' => __( 'Title Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .room-area .font-back-tittle .archivment-front h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_col', [
                'label' => __( 'Button Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .room-area .room-btn .btn' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_hov_col', [
                'label' => __( 'Button Hover Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .room-area .room-btn .btn:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
	}
    
	protected function render() {
    $settings  = $this->get_settings();
    $sec_title_back = !empty( $settings['sec_title_back'] ) ? $settings['sec_title_back'] : '';
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $apartments = !empty( $settings['apartments'] ) ? $settings['apartments'] : '';
    $btn_title = !empty( $settings['btn_title'] ) ? $settings['btn_title'] : '';
    $btn_url = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    $dynamic_class = !is_front_page() ? ' r-padding1' : '';
    ?>

    <!-- Room Start -->
    <section class="room-area<?php echo esc_attr($dynamic_class)?>">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="font-back-tittle mb-45">
                        <?php
                            if ( $sec_title_back ) {
                                echo '
                                <div class="archivment-front">
                                    <h3>'.esc_html($sec_title_back).'</h3>
                                </div>
                                ';
                            }
                            if ( $sec_title ) {
                                echo '<h3 class="archivment-back">'.esc_html($sec_title).'</h3>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                if( is_array( $apartments ) && count( $apartments ) > 0 ) {
                    foreach( $apartments as $item ) {
                        $title = !empty( $item['title'] ) ? $item['title'] : '';
                        $apartment_img = !empty( $item['apartment_img']['id'] ) ? wp_get_attachment_image( $item['apartment_img']['id'], 'marian_apartment_thumb_360x371', '', array( 'alt' => $title ) ) : '';
                        $price = !empty( $item['price'] ) ? $item['price'] : '';
                        $price_label = !empty( $item['price_label'] ) ? $item['price_label'] : '';
                        ?>
                        <div class="col-xl-4 col-lg-6 col-md-6">
                            <div class="single-room mb-50">
                                <?php
                                    if ( $apartment_img ) {
                                        echo '
                                        <div class="room-img">
                                            '.wp_kses_post($apartment_img).'
                                        </div>
                                        ';
                                    }
                                ?>
                                <div class="room-caption">
                                    <?php
                                        if ( $title ) {
                                            echo '<h3>'.esc_html($title).'</h3>';
                                        }
                                        if ( $price ) {
                                            echo '
                                            <div class="per-night">
                                                <span><u>$</u>'.esc_html($price).' <span>/ '.esc_html($price_label).'</span></span>
                                            </div>
                                            ';
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

            <?php
                if ( $btn_title ) {
                    echo '
                    <div class="row justify-content-center">
                        <div class="room-btn pt-70">
                            <a href="'.esc_url($btn_url).'" class="btn view-btn1">'.esc_html($btn_title).' <i class="ti-angle-right"></i> </a>
                        </div>
                    </div>
                    ';
                }
            ?>
        </div>
    </section>
    <?php
    }
}