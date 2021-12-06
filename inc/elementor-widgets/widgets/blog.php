<?php
namespace Marianelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Marian elementor blog section widget.
 *
 * @since 1.0
 */

class Marian_Blog extends Widget_Base {

	public function get_name() {
		return 'marian-blog';
	}

	public function get_title() {
		return __( 'Blog', 'marian-companion' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'marian-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  Blog content ------------------------------
        $this->start_controls_section(
            'blog_content',
            [
                'label' => __( 'Latest Blog Setting', 'marian-companion' ),
            ]
        );
        $this->add_control(
            'shade_title',
            [
                'label'         => __( 'Shade Title', 'marian-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => __( 'Our Blog', 'marian-companion' )
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label'         => __( 'Section Title', 'marian-companion' ),
                'type'          => Controls_Manager::TEXT,
                'label_block'   => true,
                'default'       => __( 'Recent News', 'marian-companion' )
            ]
        );
		$this->add_control(
			'post_num',
			[
				'label'         => esc_html__( 'Post Item', 'marian-companion' ),
				'type'          => Controls_Manager::NUMBER,
				'label_block'   => false,
                'default'       => absint(3),
                'min'           => 1,
                'max'           => 6,
			]
		);
		$this->add_control(
			'post_order',
			[
				'label'         => esc_html__( 'Post Order', 'marian-companion' ),
				'type'          => Controls_Manager::SWITCHER,
				'label_block'   => false,
				'label_on'      => 'ASC',
				'label_off'     => 'DESC',
                'default'       => 'yes',
                'options'       => [
                    'no'        => 'ASC',
                    'yes'       => 'DESC'
                ]
			]
		);

        $this->end_controls_section(); // End few words content

        //------------------------------ Style Section ------------------------------
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style Section Heading', 'marian-companion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'section_title_color', [
                'label'     => __( 'Section Title Color', 'marian-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .font-back-tittle .archivment-front h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'highlighted_color', [
                'label'     => __( 'Highlighted Color', 'marian-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-area .single-blog .blog-caption .blog-cap-top span' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .blog-area .single-blog .blog-caption .blog-cap-top ul li a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-area .single-blog .blog-caption .blog-cap-mid p a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
    $settings   = $this->get_settings();
    $shade_title  = !empty( $settings['shade_title'] ) ? esc_html($settings['shade_title']) : '';
    $sec_title  = !empty( $settings['sec_title'] ) ? esc_html($settings['sec_title']) : '';
    $post_num   = !empty( $settings['post_num'] ) ? $settings['post_num'] : '';
    $post_order = !empty( $settings['post_order'] ) ? $settings['post_order'] : '';
    $post_order = $post_order == 'yes' ? 'DESC' : 'ASC';
    ?>

    <!-- Blog Start -->
    <div class="blog-area blog-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <!-- Seciton Tittle  -->
                    <div class="font-back-tittle mb-50">
                        <?php 
                            if ( $shade_title ) { 
                                echo '
                                <div class="archivment-front">
                                    <h3>'.esc_html($shade_title).'</h3>
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
                    if( function_exists( 'marian_latest_blog' ) ) {
                        marian_latest_blog( $post_num, $post_order );
                    }
                ?>
            </div>
        </div>
    </div>
    <?php
	}
}
