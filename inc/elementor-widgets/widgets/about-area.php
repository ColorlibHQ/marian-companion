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
 * Marian elementor about section widget.
 *
 * @since 1.0
 */
class Marian_About_Section extends Widget_Base {

	public function get_name() {
		return 'marian-about-us';
	}

	public function get_title() {
		return __( 'About Section', 'marian-companion' );
	}

	public function get_icon() {
		return 'eicon-column';
	}

	public function get_categories() {
		return [ 'marian-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  About Us content ------------------------------
        $this->start_controls_section(
            'left_content',
            [
                'label' => __( 'Left Section Settings', 'marian-companion' ),
            ]
        );

        $this->add_control(
            'sec_img1',
            [
                'label' => esc_html__( 'Left Image 1', 'marian-companion' ),
                'description' => esc_html__( 'Best size is 759x558', 'marian-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'sec_img2',
            [
                'label' => esc_html__( 'Left Image 2', 'marian-companion' ),
                'description' => esc_html__( 'Best size is 351x373', 'marian-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'sec_img_shape',
            [
                'label' => esc_html__( 'Left Shape Image', 'marian-companion' ),
                'description' => esc_html__( 'Best size is 645x616', 'marian-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'animated_text',
            [
                'label' => esc_html__( 'Animated Text', 'marian-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'   => '25 Years of Service <br> Experience',
            ]
        );
        $this->end_controls_section(); // End left content

        // Right section
        $this->start_controls_section(
            'right_content',
            [
                'label' => __( 'Right Section Settings', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'About our company', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'marian-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Make the customer the hero of your story', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'semi_sub_title',
            [
                'label' => esc_html__( 'Semi Sub Title', 'marian-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisic- ing elit, sed do eiusmod tempor inc.', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'sec_text',
            [
                'label' => esc_html__( 'Section Text', 'marian-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'btn_title',
            [
                'label' => esc_html__( 'Button Title', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'Learn More', 'marian-companion' ),
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
            'sub_title_col', [
                'label' => __( 'Sub Title Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .customer-caption span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'title_col', [
                'label' => __( 'Big & Semi Sub Title Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .customer-caption h2, .customer-caption .caption-details .pera-dtails' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'btn_col', [
                'label' => __( 'Button Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .customer-caption .caption-details .btn' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'btn_hov_col', [
                'label' => __( 'Button Hover Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .customer-caption .caption-details .btn:hover' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
    $settings   = $this->get_settings();
    $animated_text  = !empty( $settings['animated_text'] ) ? $settings['animated_text'] : '';
    $sec_img1    = !empty( $settings['sec_img1']['id'] ) ? wp_get_attachment_image( $settings['sec_img1']['id'], 'marian_about1_thumb_759x558', '', array( 'class' => 'customar-img1', 'alt' => $animated_text ) ) : '';
    $sec_img2    = !empty( $settings['sec_img2']['id'] ) ? wp_get_attachment_image( $settings['sec_img2']['id'], 'marian_about2_thumb_351x373', '', array( 'class' => 'customar-img2', 'alt' => $animated_text . ' colorful image' ) ) : '';
    $sec_img_shape    = !empty( $settings['sec_img_shape']['url'] ) ? $settings['sec_img_shape']['url'] : '';
    $sub_title  = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $semi_sub_title  = !empty( $settings['semi_sub_title'] ) ? $settings['semi_sub_title'] : '';
    $sec_text  = !empty( $settings['sec_text'] ) ? $settings['sec_text'] : '';
    $btn_title  = !empty( $settings['btn_title'] ) ? $settings['btn_title'] : '';
    $btn_url  = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    ?>

    <style>
        .customer-img::before {
            background-image: url(<?php echo esc_url( $sec_img_shape )?>);
        }
    </style>
    
    <!-- Make customer Start-->
    <section class="make-customer-area customar-padding fix">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-xl-5 col-lg-6">
                    <div class="customer-img mb-120">
                        <?php 
                            if ( $sec_img1 ) { 
                                echo wp_kses_post($sec_img1);
                            }
                            if ( $sec_img2 ) { 
                                echo wp_kses_post($sec_img2);
                            }
                        ?>
                        <?php 
                            if ( $animated_text ) { 
                                echo '
                                <div class="service-experience heartbeat">
                                    <h3>'.wp_kses_post($animated_text).'</h3>
                                </div>
                                ';
                            }
                        ?>
                    </div>
                </div>
                <div class=" col-xl-4 col-lg-4">
                    <div class="customer-caption">
                        <?php 
                            if ( $sub_title ) { 
                                echo '<span>'.esc_html($sub_title).'</span>';
                            }
                            if ( $sec_title ) { 
                                echo '<h2>'.esc_html($sec_title).'</h2>';
                            }
                        ?>
                        <div class="caption-details">
                            <?php 
                                if ( $semi_sub_title ) { 
                                    echo '<p class="pera-dtails">'.wp_kses_post($semi_sub_title).'</p>';
                                }
                                if ( $sec_text ) { 
                                    echo '<p>'.wp_kses_post($sec_text).'</p>';
                                }
                                if ( $btn_title ) { 
                                    echo '<a href="'.esc_url($btn_url).'" class="btn more-btn1">'.esc_html($btn_title).' <i class="ti-angle-right"></i> </a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Make customer End-->
    <?php
    }
}