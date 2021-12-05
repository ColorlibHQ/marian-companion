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
 * Marian elementor quotation section widget.
 *
 * @since 1.0
 */
class Marian_Quotation_Section extends Widget_Base {

	public function get_name() {
		return 'marian-quotation';
	}

	public function get_title() {
		return __( 'Quotation Section', 'marian-companion' );
	}

	public function get_icon() {
		return 'eicon-column';
	}

	public function get_categories() {
		return [ 'marian-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  quotation content ------------------------------
        $this->start_controls_section(
            'left_content',
            [
                'label' => __( 'Left Section Settings', 'marian-companion' ),
            ]
        );

        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Experience Value', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get a free <br> quotation Today!',
            ]
        );
        $this->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => __( 'Have any questions in mind?', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'btn_label',
            [
                'label' => esc_html__( 'Button Label', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => __( 'Contact Us', 'marian-companion' ),
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

        // Right section
        $this->start_controls_section(
            'right_content',
            [
                'label' => __( 'Right Section Settings', 'marian-companion' ),
            ]
        );
        
        $this->add_control(
            'sec_img',
            [
                'label' => esc_html__( 'Right Image', 'marian-companion' ),
                'description' => esc_html__( 'Best size is 922x656', 'marian-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
            ]
        );
        $this->add_control(
            'phone_label',
            [
                'label' => esc_html__( 'Phone Label', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( 'say Hello,', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'phone_number',
            [
                'label' => esc_html__( 'Phone Number', 'marian-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__( '+44 563 986 4785', 'marian-companion' ),
            ]
        );
        $this->end_controls_section(); // End left content

        //------------------------------ Style title ------------------------------
        
        // Top Section Styles
        $this->start_controls_section(
            'quotation_styles', [
                'label' => __( 'Quotation Section Styles', 'marian-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_col', [
                'label' => __( 'Title Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quotation_area .quotation_text .quotation_info h3' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control(
            'highlighted_col', [
                'label' => __( 'Highlighted Text Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quotation_area .quotation_text .quotation_info .boxed-btn3' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                    '{{WRAPPER}} .quotation_area .quotation_text .quotation_info .boxed-btn3:hover' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .quotation_area .quotation_text .sayhello .icon i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .quotation_area .quotation_text .sayhello .num h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
    $settings   = $this->get_settings();  
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $text   = !empty( $settings['text'] ) ? $settings['text'] : '';
    $btn_label  = !empty( $settings['btn_label'] ) ? $settings['btn_label'] : '';
    $btn_url    = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    $sec_img    = $settings['sec_img']['url'] ? $settings['sec_img']['url'] : '';
    $phone_label   = !empty( $settings['phone_label'] ) ? $settings['phone_label'] : '';
    $phone_number   = !empty( $settings['phone_number'] ) ? $settings['phone_number'] : '';
    ?>

    <style>
        .quotation_area::before {
            background-image: url(<?php echo esc_url($sec_img)?>);
        }
    </style>

    <!-- quotation_area_start  -->
    <div class="quotation_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="quotation_text d-flex align-items-center justify-content-between">
                        <div class="quotation_info">
                            <?php 
                                if ( $sec_title ) { 
                                    echo '<h3>'.wp_kses_post(nl2br($sec_title)).'</h3>';
                                }
                                if ( $text ) { 
                                    echo '<p>'.wp_kses_post( nl2br($text) ).'</p>';
                                }
                                if ( $btn_label ) { 
                                    echo '<a class="boxed-btn3" href="'.esc_url( $btn_url ).'">'.esc_html( $btn_label ).'</a>';
                                }
                            ?>
                        </div>
                        <div class="sayhello d-flex align-items-center">
                            <div class="icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="num">
                                <?php 
                                    if ( $phone_label ) { 
                                        echo '<span>'.esc_html($phone_label).'</span>';
                                    }
                                    if ( $phone_number ) { 
                                        echo '<h3>'.esc_html( $phone_number ).'</h3>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- quotation_area_end  -->
    <?php
    }
}