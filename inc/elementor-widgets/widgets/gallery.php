<?php
namespace Marianelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Marian elementor gallery section widget.
 *
 * @since 1.0
 */
class Marian_Gallery extends Widget_Base {

	public function get_name() {
		return 'marian-gallery';
	}

	public function get_title() {
		return __( 'Imgae Gallery', 'marian-companion' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'marian-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  gallery content ------------------------------
		$this->start_controls_section(
			'gallery_content',
			[
				'label' => __( 'Gallery content', 'marian-companion' ),
			]
        );

		$this->add_control(
            'galleries', [
                'label' => __( 'Create New', 'marian-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ item_title }}}',
                'fields' => [
                    [
                        'name' => 'item_title',
                        'label' => __( 'Title', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Gallery 1', 'marian-companion' ),
                    ],
                    [
                        'name' => 'item_img',
                        'label' => __( 'Image', 'marian-companion' ),
                        'label' => __( 'Best size is 640x419', 'marian-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                    ],
                ],
                'default'   => [
                    [      
                        'item_title'    => __( 'Gallery 1', 'marian-companion' ),
                    ],
                    [      
                        'item_title'    => __( 'Gallery 2', 'marian-companion' ),
                    ],
                    [      
                        'item_title'    => __( 'Gallery 3', 'marian-companion' ),
                    ],
                ]
            ]
		);
		$this->end_controls_section(); // End facilities content

    /**
     * Style Tab
     * ------------------------------ Style Section Heading ------------------------------
     *
     */

        $this->start_controls_section(
            'style_room_section', [
                'label' => __( 'Style Facilities Section', 'marian-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'big_title_col', [
                'label' => __( 'Section Title Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our_facilitics_area .section_title h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'single_item_styles_seperator',
            [
                'label' => esc_html__( 'Single Item Styles', 'marian-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'icon_col', [
                'label' => __( 'Icon Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our_facilitics_area .single_feature .icon i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'hover_icon_col', [
                'label' => __( 'On Hover Item Icon Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our_facilitics_area .single_feature:hover .icon i' => 'color: {{VALUE}} !important;',
                ],
            ]
        );
        $this->add_control(
            'title_col', [
                'label' => __( 'Title Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our_facilitics_area .single_feature h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'text_col', [
                'label' => __( 'Text Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our_facilitics_area .single_feature p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'anchor_txt_color', [
                'label' => __( 'Anchor Text Color', 'marian-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .our_facilitics_area .single_feature a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();

	}

	protected function render() {
    $this->load_widget_script();
    $settings   = $this->get_settings();
    $galleries  = !empty( $settings['galleries'] ) ? $settings['galleries'] : '';
    ?>

    <!-- Gallery img Start-->
    <div class="gallery-area fix">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="gallery-active owl-carousel">
                        <?php 
                        if( is_array( $galleries ) && count( $galleries ) > 0 ) {
                            foreach( $galleries as $item ) {
                                $item_title = $item['item_title'] ? $item['item_title'] : '';
                                $item_img = ( !empty( $item['item_img']['url'] ) ) ? $item['item_img']['url'] : '';
                                ?>
                                <div class="gallery-img">
                                    <a href="#"><img src="<?php echo esc_url( $item_img )?>" alt="<?php echo esc_attr( $item_title )?>"></a>
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
    <!-- Gallery img End-->
    <?php
    }

    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            /* 5. Gallery Active */
            var client_list = $('.gallery-active');
            if(client_list.length){
            client_list.owlCarousel({
                slidesToShow: 3,
                slidesToScroll: 1,
                loop: true,
                autoplay:true,
                speed: 3000,
                smartSpeed:2000,
                nav: false,
                dots: false,
                margin: 0,

                autoplayHoverPause: true,
                responsive : {
                0 : {
                    nav: false,
                    items: 2,
                },
                768 : {
                    nav: false,
                    items: 3,
                }
                }
            });
            }
        })(jQuery);
        </script>
        <?php 
        }
    }	
}