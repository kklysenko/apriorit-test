<?php

if( ! defined('ABSPATH') ) exit;

function register_viewcounter_widget() {
	register_widget( 'Viewcounter_Widget' );
}
add_action( 'widgets_init', 'register_viewcounter_widget' );

class Viewcounter_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'Viewcounter_Widget',
			'Popular Posts',
			array(
				'description' => __( 'Displays most popular posts in a period', 'view-counter' )
			)
		);
	}

	public function widget( $args, $instance ) {
		$select_options = ['day','week','year'];
		$title = apply_filters( 'widget_title', $instance['title'] );
		$html = $args['before_widget'];
		if ( ! empty( $title ) )
		$html .= $args['before_title'] . $title . $args['after_title'];
		$html .= '<div class="viewcounter-order">Order by:';
		$html .= '<select>';
			foreach ($select_options as $key => $value) {
				$html .= '
				<option value="' . $value .'" >' . $value . '</option>';
			}
		$html .= '</select></div>';
		$html .= viewcounter_popular_posts();
		$html .= $args['after_widget'];
		echo $html;
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
	}

}


?>