<?php
if( !defined( 'WPINC' ) ){
    die;
}
/**
 * @Packge     : Marian Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */

 
 
/**************************************
*Creating Blog Widget
***************************************/
 
class marian_blog_widget extends WP_Widget {


function __construct() {

parent::__construct(
// Base ID of your widget
'marian_blog_widget', 


// Widget name will appear in UI
esc_html__( '[ Marian ] Latest Post Thumbnail', 'marian-companion' ), 

// Widget description
array( 'description' => esc_html__( 'Show most latest blog post.', 'marian-companion' ), ) 
);

}

// This is where the action happens
public function widget( $args, $instance ) {
$title 			= apply_filters( 'marian_blog_sectiontitle', $instance['sectiontitle'] );
$postnumber 	= apply_filters( 'marian_blog_postnumber', $instance['postnumber'] );
$style 			= apply_filters( 'marian_blog_style', $instance['style'] );

// before and after widget arguments are defined by themes
echo wp_kses_post( $args['before_widget'] );
if ( ! empty( $title ) )
echo wp_kses_post( $args['before_title'] . $title . $args['after_title'] );

    
?>

    <div class="latest-blog-posts">
		<?php 	
		$blogargs = array(
			'post_type' 	 => 'post',
			'posts_per_page' => esc_html( $postnumber ),
		);
		
		$query = new WP_Query( $blogargs );
		
		if( $query->have_posts() ):
		while( $query->have_posts() ):
			$query->the_post();
		?>
		<?php 

		if( $style != '2' ):
		?>
        	<?php 
        	if( get_the_post_thumbnail()):
        	?>
            <div class="media post_item">
             <?php the_post_thumbnail('marian_widget_post_thumb', ['class' => 'img-fluid']); ?>

			 <div class="media-body">
				<a href="<?php the_permalink(); ?>">
					<h3><?php echo wp_trim_words( get_the_title(), 5 ); ?></h3>
				</a>
				<p><?php echo esc_html( get_the_date() ); ?></p>
			 </div>
            </div>
            <?php 
        	endif;
            ?>
		<?php 
		else:
		?>
        <div class="footer-single--blog-post">
            <a href="<?php echo esc_url( marian_blog_date_permalink() ); ?>" class="blog-post-date">
                <p><?php echo esc_html( get_the_date() ); ?></p>
            </a>
            <a href="<?php the_permalink(); ?>" class="blog-post-title">
                <h6><?php the_title(); ?></h6>
            </a>
        </div>
		<?php 
		endif;
		//
    	endwhile;
    	endif;
        ?>
    </div>

<?php
echo wp_kses_post( $args['after_widget'] );
}
		
// Widget Backend 
public function form( $instance ) {

// Section Title
if ( isset( $instance[ 'sectiontitle' ] ) ) {
	$sectiontitle = $instance[ 'sectiontitle' ];
}else {
	$sectiontitle = '';
}
//	Post Number
if ( isset( $instance[ 'postnumber' ] ) ) {
	$postnumber = $instance[ 'postnumber' ];
}else {
	$postnumber = '4';
}
//	Style
if ( isset( $instance[ 'style' ] ) ) {
	$style = $instance[ 'style' ];
}else {
	$style = '1';
}




// Widget admin form
?>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'sectiontitle' ) ); ?>"><?php esc_html_e( 'Section Title:' ,'marian-companion'); ?></label> 
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'sectiontitle' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sectiontitle' ) ); ?>" type="text" value="<?php echo esc_attr( $sectiontitle ); ?>" />
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'postnumber' ) ); ?>"><?php esc_html_e( 'Post Number:' ,'marian-companion'); ?></label> 
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'postnumber' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postnumber' ) ); ?>" type="number" value="<?php echo esc_attr( $postnumber ); ?>" />
</p>
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>"><?php esc_html_e( 'Set Style:' ,'marian-companion'); ?></label> 

<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
	<option value="1" <?php echo esc_attr( ( $style == '1' ) ? 'selected' : '' ); ?>><?php esc_html_e( 'Style 1', 'marian-companion'); ?></option>
	<option value="2" <?php echo esc_attr( ( $style == '2' ) ? 'selected' : '' ); ?>><?php esc_html_e( 'Style 2', 'marian-companion'); ?></option>
</select>
</p>

<?php 
}

	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {

	
$instance = array();
$instance['sectiontitle'] 	 = ( ! empty( $new_instance['sectiontitle'] ) ) ? strip_tags( $new_instance['sectiontitle'] ) : '';
$instance['postnumber'] 	 = ( ! empty( $new_instance['postnumber'] ) ) ? strip_tags( $new_instance['postnumber'] ) : '';
$instance['style'] 	 	 	 = ( ! empty( $new_instance['style'] ) ) ? strip_tags( $new_instance['style'] ) : '';


return $instance;
}
} // Class marian_bannervideo_widget ends here


// Register and load the widget
function marian_blog_load_widget() {
	register_widget( 'marian_blog_widget' );
}
add_action( 'widgets_init', 'marian_blog_load_widget' );