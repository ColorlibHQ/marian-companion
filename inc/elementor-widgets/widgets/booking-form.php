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
 * Marian elementor booking form section widget.
 *
 * @since 1.0
 */
class Marian_Booking_Form extends Widget_Base {

	public function get_name() {
		return 'marian-booking-form';
	}

	public function get_title() {
		return __( 'Booking Form', 'marian-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'marian-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Booking Form content ------------------------------
		$this->start_controls_section(
			'booking_form_content',
			[
				'label' => __( 'Booking Form contents', 'marian-companion' ),
			]
        );
        
        $this->add_control(
            'btn_title',
            [
                'label'         => __( 'Button Title', 'marian-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => __( 'Book Now', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'action_url',
            [
                'label'         => __( 'Form Action URL', 'marian-companion' ),
                'type'          => Controls_Manager::URL,
                'label_block'   => true,
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
				'label' => __( 'Style Certificate Section', 'marian-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
            'title_col', [
                'label' => __( 'Title Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property_certificates .section_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'highlighted_col', [
                'label' => __( 'Highlighted Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property_certificates .section_title h3 span' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->end_controls_section();
	}
    
	protected function render() {
    $settings  = $this->get_settings();
    $btn_title = !empty( $settings['btn_title'] ) ? $settings['btn_title'] : '';
    $action_url = !empty( $settings['action_url']['url'] ) ? $settings['action_url']['url'] : '';
    ?>

    <!-- Booking Room Start-->
    <div class="booking-area">
        <div class="container">
            <div class="row ">
            <div class="col-12">
            <form action="">
            <div class="booking-wrap d-flex justify-content-between align-items-center">
                
                <!-- select in date -->
                <div class="single-select-box mb-30">
                    <!-- select out date -->
                    <div class="boking-tittle">
                        <span> Check In Date:</span>
                    </div>
                    <div class="boking-datepicker">
                        <div role="wrapper" class="gj-datepicker gj-datepicker-md gj-unselectable"><input id="datepicker1" placeholder="10/12/2020" data-type="datepicker" data-guid="f24247db-b7a0-5903-838a-4d1570976eb6" data-datepicker="true" class="gj-textbox-md" role="input"><i class="gj-icon" role="right-icon">event</i></div>

                        <!-- <input id="datepicker1" class="gj-textbox-md" placeholder="10/12/2020" />
                        <i class="gj-icon" role="right-icon">event</i> -->
                    </div>
                </div>
                <!-- Single Select Box -->
                <div class="single-select-box mb-30">
                    <!-- select out date -->
                    <div class="boking-tittle">
                        <span>Check OutDate:</span>
                    </div>
                    <div class="boking-datepicker">
                        <div role="wrapper" class="gj-datepicker gj-datepicker-md gj-unselectable"><input id="datepicker2" placeholder="12/12/2020" data-type="datepicker" data-guid="caf815a6-dfb7-06ce-c250-8aaf95a26cfd" data-datepicker="true" class="gj-textbox-md" role="input"><i class="gj-icon" role="right-icon">event</i></div>
                    </div>
                </div>
                <!-- Single Select Box -->
                <div class="single-select-box mb-30">
                    <div class="boking-tittle">
                        <span>Adults:</span>
                    </div>
                    <div class="select-this">
                        <form action="#">
                            <div class="select-itms">
                                <select name="select" id="select1">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Single Select Box -->
                <div class="single-select-box mb-30">
                    <div class="boking-tittle">
                        <span>Children:</span>
                    </div>
                    <div class="select-this">
                        <form action="#">
                            <div class="select-itms">
                                <select name="select" id="select2">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Single Select Box -->
                <div class="single-select-box mb-30">
                    <div class="boking-tittle">
                        <span>Rooms:</span>
                    </div>
                    <div class="select-this">
                        <form action="#">
                            <div class="select-itms">
                                <select name="select" id="select3">
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Single Select Box -->
                <div class="single-select-box pt-45 mb-30">
                    <?php 
                        if ( $btn_title ) { 
                            echo '<a href="'.esc_url( $action_url ).'" class="btn select-btn">'.esc_html( $btn_title ).'</a>';
                        }
                    ?>
                </div>
            

            </div>
        </form>
            </div>
            </div>
        </div>
    </div>
    <!-- Booking Room End-->
    <?php
    } 
}