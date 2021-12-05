<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * @Packge     : Marian Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author     URI : http://colorlib.com/wp/
 *
 */


/*===========================================================
	Get elementor templates
============================================================*/
function get_elementor_templates() {
	$options = [];
	$args = [
		'post_type' => 'elementor_library',
		'posts_per_page' => -1,
	];

	$page_templates = get_posts($args);

	if (!empty($page_templates) && !is_wp_error($page_templates)) {
		foreach ($page_templates as $post) {
			$options[$post->ID] = $post->post_title;
		}
	}
	return $options;
}

// Section Heading
function marian_section_heading( $title = '', $subtitle = '' ) {
	if( $title || $subtitle ) :
	?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-heading text-center">
						<?php
						// Sub title
						if ( $subtitle ) {
							echo '<p>' . esc_html( $subtitle ) . '</p>';
						}
						// Title
						if ( $title ) {
							echo '<h2>' . esc_html( $title ) . '</h2>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
	endif;
}

// Enqueue scripts
add_action( 'wp_enqueue_scripts', 'marian_companion_frontend_scripts', 99 );
function marian_companion_frontend_scripts() {

	wp_enqueue_script( 'marian-companion-script', plugins_url( '../js/loadmore-ajax.js', __FILE__ ), array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'marian-common-js', plugins_url( '../js/common.js', __FILE__ ), array( 'jquery' ), '1.0', true );

}
// 
add_action( 'wp_ajax_marian_portfolio_ajax', 'marian_portfolio_ajax' );

add_action( 'wp_ajax_nopriv_marian_portfolio_ajax', 'marian_portfolio_ajax' );
function marian_portfolio_ajax( ){

	ob_start();

	if( !empty( $_POST['elsettings'] ) ):


		$items = array_slice( $_POST['elsettings'], $_POST['postNumber'] );

	    $i = 0;
	    foreach( $items as $val ):

	    $tagclass = sanitize_title_with_dashes( $val['label'] );
	    $i++;
	?>
	<div class="single_gallery_item <?php echo esc_attr( $tagclass ); ?>">
	    <?php 
	    if( !empty( $val['img']['url'] ) ){
	        echo '<img src="'.esc_url( $val['img']['url'] ).'" />';
	    }
	    ?>
	    <div class="gallery-hover-overlay d-flex align-items-center justify-content-center">
	        <div class="port-hover-text text-center">
	            <?php 
	            if( !empty( $val['title'] ) ){
	                echo marian_heading_tag(
	                    array(
	                        'tag'  => 'h4',
	                        'text' => esc_html( $val['title'] )
	                    )
	                );
	            }

	            if( !empty( $val['sub-title-url'] ) &&  !empty( $val['sub-title'] ) ){
	                echo '<a href="'.esc_url( $val['sub-title-url'] ).'">'.esc_html( $val['sub-title'] ).'</a>';
	            }else{
	                echo '<p>'.esc_html( $val['sub-title'] ).'</p>';
	            }
	            ?>
	            
	        </div>
	    </div>
	</div>

	<?php 

	if( !empty( $_POST['postIncrNumber'] ) ){

	    if( $i == $_POST['postIncrNumber'] ){
	        break;
	    }
	}
	    endforeach;
	endif;
	echo ob_get_clean();
	die();
}

	// Update the post/page by your arguments
	function marian_update_the_followed_post_page_status( $title = 'Hello world!', $type = 'post', $status = 'draft', $message = false ){

		// Get the post/page by title
		$target_post_id = get_page_by_title( $title, OBJECT, $type);

		// Post/page arguments
		$target_post = array(
			'ID'    => $target_post_id->ID,
			'post_status'   => $type,
		);

		if ( $message == true ) {
			// Update the post/page
			$update_status = wp_update_post( $target_post, true );
		} else {
			// Update the post/page
			$update_status = wp_update_post( $target_post, false );
		}

		return $update_status;
	}


/*=========================================================
    Cases Section
========================================================*/
function marian_case_section( $post_order ){ 
	$cases = new WP_Query( array(
		'post_type' => 'case',
		'order' => $post_order,

	) );
	
	if( $cases->have_posts() ) {
		while ( $cases->have_posts() ) {
			$cases->the_post();			
			$case_cat = get_the_terms(get_the_ID(), 'case-cat');
			$case_img      = get_the_post_thumbnail( get_the_ID(), 'marian_case_study_thumb_362x240', '', array( 'alt' => get_the_title() ) );
			?>
			<div class="single_case">
				<?php 
					if ( $case_img ) {
						echo '
							<div class="case_thumb">
								'.$case_img.'
							</div>
						';
					}
				?>
				<div class="case_heading">
					<span><?php echo $case_cat[0]->name?></span>
					<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
				</div>
			</div>
			<?php
		}
	}
}

// Related marian for Single Page
function marian_related_items( $current_post_id = null, $post_item = 3, $post_order = 'DESC', $have_related_listing_title = 'Related Listings' ){
	$related_listings = new WP_Query( array(
        'post_type' => 'listing',
        'order' => $post_order,
        'posts_per_page' => $post_item,
		'post__not_in' => array( $current_post_id ),
    ) );
	?>
	
    <!-- related_listing start  -->
    <div class="explorer_europe">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title text-center mb-50">
						<?php
							if ( $have_related_listing_title ) {
								echo '
									<h3>'.esc_html( $have_related_listing_title ).'</h3>
								';
							}
						?>
                    </div>
                </div>
            </div>
			<div class="row">
				<?php
				if( $related_listings->have_posts() ) {
					while ( $related_listings->have_posts() ) {
						$related_listings->the_post();			
						$recipe_img = get_the_post_thumbnail( get_the_ID(), 'marian_listing_thumb_362x250', '', array( 'alt' => get_the_title() ) );
						$listing_address = ! empty( marian_meta( 'listing_address') ) ? marian_meta( 'listing_address') : 'N/A';
						$phone_number = ! empty( marian_meta( 'phone_number') ) ? marian_meta( 'phone_number') : 'N/A';
						$listing_email = ! empty( marian_meta( 'listing_email') ) ? marian_meta( 'listing_email') : 'N/A';
						?>
						<div class="col-xl-4 col-lg-4 col-md-6">
							<div class="single_explorer">
								<?php
									if ( has_post_thumbnail() ) {
										echo '
											<div class="thumb">
												'.$recipe_img.'
											</div>
										';
									}
								?>
								<div class="explorer_bottom d-flex">
									<div class="icon">
										<i class="flaticon-beach"></i>
									</div>
									<div class="explorer_info">
										<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
										<?php
											if ( $listing_address != '' ) {
												echo '<p>'.wp_kses_post($listing_address).'</p>';
											}
											if ( $phone_number != '' || $listing_email != '' ) {
												?>
												<ul>
													<?php
													if( $phone_number ) {
														echo '
															<li> <i class="fa fa-phone"></i>
															'.$phone_number.'</li>
														';
													}
													if( $listing_email ) {
														echo '
															<li> <i class="fa fa-envelope"></i>
															'.$listing_email.'</li>
														';
													}
													?>
												</ul>
												<?php
											}
										?>
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
	</div>
	<!-- related_listing end  -->
	<?php
}

function marian_get_tabbed_contents( $sec_title = 'Explore Europe', $selected_countries ) {
	$i = 0;
	?>

	<div class="explorer_europe">
        <div class="container">
            <div class="explorer_wrap">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-md-4">
						<?php
							if ( $sec_title ) {
								echo '<h3>'.esc_html($sec_title).'</h3>';
							}
						?>
                    </div>
                    <div class="col-xl-6 col-md-8">
                        <div class="explorer_tab">
                            <nav>
                                <div class="nav" id="nav-tab" role="tablist">
									<?php
									foreach( $selected_countries as $country ) {
										$i++;
										$country_term = get_term_by('id', $country, 'listing_country');
										echo '
										<a class="nav-item nav-link'.($i==1?' active':'').'" id="nav-'.$country_term->slug.'-tab" data-toggle="tab"
                                        href="#nav-'.$country_term->slug.'" role="tab" aria-controls="'.$country_term->slug.'"
                                        aria-selected="'.($i==1?'true':'false').'">'.$country_term->name.'</a>
										';
									}
									?>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="nav-tabContent">
				<?php
				$j = 0;
				foreach( $selected_countries as $country ) {
					$j++;
					$country_term = get_term_by('id', $country, 'listing_country');
					echo '
						<div class="tab-pane fade'.($j==1?' show active':'').'" id="nav-'.$country_term->slug.'" role="tabpanel" aria-labelledby="nav-'.$country_term->slug.'-tab">
					';
						?>
						<div class="row">
							<?php
							$tabbed_listings = new WP_Query( array(
								'post_type' => 'listing',
								'posts_per_page' => -1,
								'tax_query' => array( 
									array(
										'taxonomy' => 'listing_country',
										'field'	   => 'slug',
										'terms'	   => $country_term->slug,
									)
								),
							) );

							if( $tabbed_listings->have_posts() ) {
								while ( $tabbed_listings->have_posts() ) {
									$tabbed_listings->the_post();			
									$listing_img = get_the_post_thumbnail( get_the_ID(), 'marian_listing_thumb_362x250', '', array( 'alt' => get_the_title() ) );
									$listing_address = ! empty( marian_meta( 'listing_address') ) ? marian_meta( 'listing_address') : 'N/A';
									$phone_number = ! empty( marian_meta( 'phone_number') ) ? marian_meta( 'phone_number') : 'N/A';
									$listing_email = ! empty( marian_meta( 'listing_email') ) ? marian_meta( 'listing_email') : 'N/A';
									?>
									<div class="col-xl-4 col-lg-4 col-md-6">
										<div class="single_explorer">
											<?php
											if ( has_post_thumbnail() ) {
												echo '
													<div class="thumb">
														'.$listing_img.'
													</div>
												';
											}
											?>
											<div class="explorer_bottom d-flex">
												<div class="icon">
													<i class="flaticon-beach"></i>
												</div>
												<div class="explorer_info">
													<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
													<p><?php echo $listing_address?></p>
													<ul>
														<li> <i class="fa fa-phone"></i>
														<?php echo $phone_number?></li>
														<li><i class="fa fa-envelope"></i> <?php echo $listing_email?></li>
													</ul>
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
					<?php
				}
				?>
			</div>
		</div>
	</div>
	<?php
}


// Add the custom columns to the listing post type:
add_filter( 'manage_listing_posts_columns', 'set_custom_edit_listing_columns' );
function set_custom_edit_listing_columns($columns) {
    // unset( $columns['author'] );
    $columns['listing_price'] = __( 'Listing Price', 'marian_companion' );
    $columns['listing_area'] = __( 'Listing Area', 'marian_companion' );

    return $columns;
}

// Add the data to the custom columns for the listing post type:
add_action( 'manage_listing_posts_custom_column' , 'custom_listing_column', 10, 2 );
function custom_listing_column( $column, $post_id ) {

    switch ( $column ) {

        case 'listing_price' :
            echo get_post_meta( $post_id , '_marian_listing_price' , true ); 
            break;

        case 'listing_area' :
            echo get_post_meta( $post_id , '_marian_listing_area' , true ); 
            break;

    }
}


add_action('wp_ajax_prop_datas', 'search_prop_form_datas');
add_action('wp_ajax_nopriv_prop_datas', 'search_prop_form_datas');

// Search listings form data handling
if ( ! function_exists( 'search_prop_form_datas' ) ) {
	function search_prop_form_datas() {
		// Check the nonce
		check_ajax_referer( 'search_prop_data_nonce', 'nonce' );

		// Catch our datas and sanitize them
		$search_text	= isset( $_POST['search_text'] ) ? sanitize_text_field( $_POST['search_text'] ) : '';
		$search_category	= isset( $_POST['search_category'] ) ? sanitize_text_field($_POST['search_category']) : '';
		$search_location	= isset( $_POST['search_location'] ) ? sanitize_text_field($_POST['search_location']) : '';
		$search_area_from	= isset( $_POST['search_area_from'] ) ? sanitize_text_field($_POST['search_area_from']) : '';
		$search_area_to	= isset( $_POST['search_area_to'] ) ? sanitize_text_field( $_POST['search_area_to'] ) : '';
		$price_min	= isset( $_POST['price_min'] ) ? sanitize_text_field( $_POST['price_min'] ) : '';
		$price_max	= isset( $_POST['price_max'] ) ? sanitize_text_field( $_POST['price_max'] ) : '';

		$response = [];

		if ( $search_text == '' || $search_category == '' || $search_location == '' || $search_area_from == '' || $search_area_to == '' || $price_min == '' || $price_max == '' ) {
			$response['response'] = 'error';
			$response['message']  = __( 'Sorry! Empty field is not allowed.', 'marian-companion' );
		} else {
			$item = 0;
			$cat_term = get_term($search_category, 'listing_category');
			$cat_slug = $cat_term->slug;
			$loc_term = get_term($search_location, 'listing_country');
			$loc_slug = $loc_term->slug;
			$response = [];
			ob_start();
			// $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
			$properties = new WP_Query( array(
				'post_type' => 'listing',
				'tax_query' => array(
					'relation' => 'AND',
					array(
						'taxonomy' => 'listing_category',
						'field'    => 'slug',
						'terms'    => $cat_slug,
						// 'compare' => '=',
					),
					array(
						'taxonomy' => 'listing_country',
						'field'    => 'slug',
						'terms'    => $loc_slug,
						// 'compare' => '=',
					),
				),
				'meta_query' => array(
					'relation' => 'AND',
					array(
						'key'     => '_marian_listing_price',
						'value'   => array($price_min, $price_max),
						'type'    => 'numeric',
						'compare' => 'BETWEEN',
					),
					array(
						'key'     => '_marian_listing_area',
						'value'   => array($search_area_from, $search_area_to),
						'type'    => 'numeric',
						'compare' => 'BETWEEN',
					),
				),
				'posts_per_page' => '6',
				// 'paged'          => $paged,
			) );
			if( $properties->have_posts() ) {
				while ( $properties->have_posts() ) {
					$properties->the_post();		
					$property_img = get_the_post_thumbnail( get_the_ID(), 'marian_listing_thumb_362x250', '', array( 'alt' => get_the_title() ) );
					$listing_address = ! empty( real_estate_meta( 'listing_address') ) ? real_estate_meta( 'listing_address') : '';
					$phone_number = ! empty( real_estate_meta( 'phone_number') ) ? real_estate_meta( 'phone_number') : '';
					$listing_email = ! empty( real_estate_meta( 'listing_email') ) ? real_estate_meta( 'listing_email') : '';
					$item++;
					?>
					<div class="col-xl-6 col-lg-6 col-md-6">
						<div class="single_explorer">
							<div class="thumb">
								<?php
									if ( has_post_thumbnail() ) {
										echo $property_img;
									}
								?>
							</div>
							<div class="explorer_bottom d-flex">
								<div class="icon">
									<i class="flaticon-beach"></i>
								</div>
								<div class="explorer_info">
									<h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
									<p><?php echo $listing_address?></p>
									<ul>
										<li> <i class="fa fa-phone"></i>
										<?php echo $phone_number?></li>
										<li><i class="fa fa-envelope"></i> <?php echo $listing_email?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
				echo '<span class="total-search-count" data-total-search-count="'.$item.'"></span>';
				wp_reset_postdata();
			} else {
				echo '<h2 class="text-center">Sorry! We could not find any property with your criteria.</h2>';
				// echo '<h2 class="text-center">Prop type '.$prop_type.'</h2>';
			}
			$response = ob_get_clean();
		}

		// Return response
		echo json_encode( $response );
		exit();
	}
}
