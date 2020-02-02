<?php

if ( ! function_exists( 'viewcounter_popular_posts' ) ) {

	function viewcounter_popular_posts() {

		$posts = viewcounter_get_posts();

		if ( ! empty( $posts ) ) {
			$html = '<ul>';

			foreach ( $posts as $post ) {
				setup_postdata( $post );

			$html .= '
			<li>';

				if ( has_post_thumbnail( $post->ID ) ) {
					$html .= '
					<span class="post-thumbnail">
					' . get_the_post_thumbnail( $post->ID, 'thumbnail_size' ) . '
					</span>';
				}

				$html .= '
					<a class="post-title" href="' . get_permalink( $post->ID ) . '">' . get_the_title( $post->ID ) . '</a>';

				$excerpt = '';

				if ( empty( $post->post_excerpt ) ) :
					$text = strip_tags( apply_filters('the_content', $post->post_content), '<a>' );
				else :
					$text = $post->post_excerpt;
				endif;

				if ( ! empty( $text ) )
					$excerpt = mb_strimwidth($text,0,100,'...');

				if ( ! empty( $excerpt ) )
					$html .= '

				<div class="post-excerpt">' . esc_html( $excerpt ) . '</div>';

				$html .= '
			</li>';
			}

			wp_reset_postdata();

			$html .= '</ul>';
		}

		return $html;

	}

}


if ( ! function_exists( 'viewcounter_get_posts' ) ) {

	function viewcounter_get_posts( $args = [] ) {
		$args =	array(
				'posts_per_page' => 5,
				'order'			 => 'desc',
				'post_type'		 => 'post'
		);

		return get_posts( $args );
	}

}