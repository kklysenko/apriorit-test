<?php

if( ! defined('ABSPATH') ) exit;

function register_viewcounter_widget() {
	register_widget( 'Viewcounter_Widget' );
}
add_action( 'widgets_init', 'register_viewcounter_widget' );

class Viewcounter_Widget extends WP_Widget {

	private $vc_defaults;

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
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];
		echo __( 'Привет мир, от Hostinger.ru', 'hstngr_widget_domain' );
		echo $args['after_widget'];
		}

}


?>