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
 * Marian elementor Certificates section widget.
 *
 * @since 1.0
 */
class Marian_Certificates extends Widget_Base {

	public function get_name() {
		return 'marian-certificates';
	}

	public function get_title() {
		return __( 'Certificates Section', 'marian-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'marian-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Certificates content ------------------------------
		$this->start_controls_section(
			'certificates_content',
			[
				'label' => __( 'Certificates contents', 'marian-companion' ),
			]
        );
        
        $this->add_control(
            'sec_title',
            [
                'label'         => __( 'Section Title', 'marian-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => 'Property <span>Certificates</span>'
            ]
        );
		$this->add_control(
            'certificates', [
                'label' => __( 'Create New Slider', 'marian-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ title }}}',
                'fields' => [
                    [
                        'name' => 'certificate_img',
                        'label' => __( 'Certificate Image', 'marian-companion' ),
                        'description' => __( 'Best size is 195x257', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'title',
                        'label' => __( 'Certificate Title', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Certificate of Appreciation', 'marian-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'title'    => __( 'Certificate of Appreciation', 'marian-companion' ),
                    ],
                    [      
                        'title'    => __( 'Certificate of Architecture', 'marian-companion' ),
                    ],
                    [      
                        'title'    => __( 'Certificate of Engineer', 'marian-companion' ),
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
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $certificates = !empty( $settings['certificates'] ) ? $settings['certificates'] : '';
    ?>

    <!-- property_certificates_start  -->
    <div class="property_certificates">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="section_title">
                        <?php 
                            if ( $sec_title ) { 
                                echo '<h3>'.wp_kses_post( nl2br($sec_title) ).'</h3>';
                            }
                        ?>
                        <div class="devider">
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="certificate_listing d-flex justify-content-between align-items-center">
                        <?php 
                        if( is_array( $certificates ) && count( $certificates ) > 0 ) {
                            foreach( $certificates as $item ) {
                                $title = !empty( $item['title'] ) ? $item['title'] : '';
                                $certificate_img   = !empty( $item['certificate_img']['id'] ) ? wp_get_attachment_image( $item['certificate_img']['id'], 'marian_certificate_img_195x257', '', array( 'alt' => $title ) ) : '';
                                ?>
                                <div class="single_list">
                                    <?php
                                        if ( $certificate_img ) {
                                            echo '
                                            <div class="thumb">
                                                '.$certificate_img.'
                                            </div>
                                            ';
                                        }
                                    ?>
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
    <!-- property_certificates_end  -->
    <?php
    } 
}