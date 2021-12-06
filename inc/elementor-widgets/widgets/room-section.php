<?php
namespace Marianelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Marian elementor room section widget.
 *
 * @since 1.0
 */
class Marian_Room_Section extends Widget_Base {

	public function get_name() {
		return 'marian-room';
	}

	public function get_title() {
		return __( 'Features Section', 'marian-companion' );
	}

	public function get_icon() {
		return 'eicon-posts-group';
	}

	public function get_categories() {
		return [ 'marian-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  room content ------------------------------
        $this->start_controls_section(
            'left_room_content',
            [
                'label' => __( 'Left Room Settings', 'marian-companion' ),
            ]
        );

        $this->add_control(
            'left_sec_img',
            [
                'label' => esc_html__( 'BG Image', 'marian-companion' ),
                'description' => esc_html__( 'Best size is 960x801', 'marian-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'left_sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Our resturent', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'left_sec_title',
            [
                'label' => esc_html__( 'Section Title', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Dining & Drinks', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'left_sec_text',
            [
                'label' => esc_html__( 'Semi Sub Title', 'marian-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim <br>veniam, quis nostrud.',
            ]
        );
        $this->add_control(
            'left_btn_title',
            [
                'label' => esc_html__( 'Section Text', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Learn More', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'left_btn_url',
            [
                'label' => esc_html__( 'Button URL', 'marian-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );
        $this->end_controls_section(); // End left content

        // Right Content
        $this->start_controls_section(
            'right_room_content',
            [
                'label' => __( 'Right Room Settings', 'marian-companion' ),
            ]
        );

        $this->add_control(
            'right_sec_img',
            [
                'label' => esc_html__( 'BG Image', 'marian-companion' ),
                'description' => esc_html__( 'Best size is 960x801', 'marian-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'right_sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Our Pool', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'right_sec_title',
            [
                'label' => esc_html__( 'Section Title', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Swimming Pool', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'right_sec_text',
            [
                'label' => esc_html__( 'Semi Sub Title', 'marian-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br> tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim <br>veniam, quis nostrud.',
            ]
        );
        $this->add_control(
            'right_btn_title',
            [
                'label' => esc_html__( 'Section Text', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Learn More', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'right_btn_url',
            [
                'label' => esc_html__( 'Button URL', 'marian-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
            ]
        );
        $this->end_controls_section(); // End left content

        //------------------------------ Style title ------------------------------
        
        // Top Section Styles
        $this->start_controls_section(
            'about_sec_style', [
                'label' => __( 'About Section Styles', 'marian-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_col', [
                'label' => __( 'Title Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dining-area .dining-caption span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'big_title_col', [
                'label' => __( 'Big Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dining-area .dining-caption h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_col', [
                'label' => __( 'Button Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dining-area .dining-caption .border-btn' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                    '{{WRAPPER}} .dining-area .dining-caption .border-btn:hover' => 'background: {{VALUE}}; border-color: transparent; color: #fff;',
                ],
            ]
        );
        $this->add_control(
            'btn_hov_col', [
                'label' => __( 'Button Hover Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dining-area .dining-caption .border-btn:hover' => 'background: {{VALUE}}; border-color: transparent; color: #fff;',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
    $settings   = $this->get_settings();
    // Left Section
    $left_sec_title  = !empty( $settings['left_sec_title'] ) ? $settings['left_sec_title'] : '';
    $left_sec_img    = !empty( $settings['left_sec_img']['url'] ) ? $settings['left_sec_img']['url'] : '';
    $left_sub_title  = !empty( $settings['left_sub_title'] ) ? $settings['left_sub_title'] : '';
    $left_sec_text  = !empty( $settings['left_sec_text'] ) ? $settings['left_sec_text'] : '';
    $left_btn_title  = !empty( $settings['left_btn_title'] ) ? $settings['left_btn_title'] : '';
    $left_btn_url  = !empty( $settings['left_btn_url']['url'] ) ? $settings['left_btn_url']['url'] : '';
    // Right Section
    $right_sec_title  = !empty( $settings['right_sec_title'] ) ? $settings['right_sec_title'] : '';
    $right_sec_img    = !empty( $settings['right_sec_img']['url'] ) ? $settings['right_sec_img']['url'] : '';
    $right_sub_title  = !empty( $settings['right_sub_title'] ) ? $settings['right_sub_title'] : '';
    $right_sec_text  = !empty( $settings['right_sec_text'] ) ? $settings['right_sec_text'] : '';
    $right_btn_title  = !empty( $settings['right_btn_title'] ) ? $settings['right_btn_title'] : '';
    $right_btn_url  = !empty( $settings['right_btn_url']['url'] ) ? $settings['right_btn_url']['url'] : '';
    ?>

    <style>
        .dining-area .single-dining-area.left-img::before {
            background-image: url(<?php echo esc_url( $left_sec_img )?>);
        }
        .dining-area .single-dining-area.right-img::before {
            background-image: url(<?php echo esc_url( $right_sec_img )?>);
        }
    </style>
    
    <div class="dining-area dining-padding-top">
        <!-- Single Left img -->
        <div class="single-dining-area left-img">
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-8 col-md-8">
                        <div class="dining-caption">
                            <?php 
                                if ( $left_sub_title ) { 
                                    echo '<span>'.esc_html($left_sub_title).'</span>';
                                }
                                if ( $left_sec_title ) { 
                                    echo '<h3>'.esc_html($left_sec_title).'</h3>';
                                }
                                if ( $left_sec_text ) { 
                                    echo '<p>'.wp_kses_post($left_sec_text).'</p>';
                                }
                                if ( $left_btn_title ) { 
                                    echo '<a href="'.esc_url($left_btn_url).'" class="btn border-btn">'.esc_html($left_btn_title).' <i class="ti-angle-right"></i></a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- single Right img -->
        <div class="single-dining-area right-img">
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-lg-8 col-md-8">
                        <div class="dining-caption text-right">
                            <?php 
                                if ( $right_sub_title ) { 
                                    echo '<span>'.esc_html($right_sub_title).'</span>';
                                }
                                if ( $right_sec_title ) { 
                                    echo '<h3>'.esc_html($right_sec_title).'</h3>';
                                }
                                if ( $right_sec_text ) { 
                                    echo '<p>'.wp_kses_post($right_sec_text).'</p>';
                                }
                                if ( $right_btn_title ) { 
                                    echo '<a href="'.esc_url($right_btn_url).'" class="btn border-btn">'.esc_html($right_btn_title).' <i class="ti-angle-right"></i></a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
}