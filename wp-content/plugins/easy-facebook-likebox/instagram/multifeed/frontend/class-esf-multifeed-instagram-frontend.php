<?php
/*
* Stop execution if someone tried to get file directly.
*/ 
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Frontend Class to create Custom Post Type and handling shortcodes
 *
 * @since  1.0.0
 */
if ( ! class_exists( 'Esf_Multifeed_Instagram_Frontend' ) ){

class Esf_Multifeed_Instagram_Frontend {

	/**
	 * Constructor.
	 *
	 * Fire all required wp actions
	 *
	 * @since  1.0.0
	 */
	function __construct(){

		add_filter( 'esf_insta_filter_queried_data', [
			$this,
			'check_multiple_accounts'
		] );

		add_filter( 'esf_insta_filter_load_more_data', [
			$this,
			'get_more_posts'
		] );
	}

	/**
	 * Check if instance has multiple accounts
	 *
	 * @param $instance
	 * @since  1.0.0
	 */
	public function check_multiple_accounts( $instance ) {

		if( !isset( $instance['user_id'] ) ) return false;
		$account_ids = explode(',', $instance['user_id'] );
		$duration = $instance['cache_unit'] . '-' . substr( $instance['cache_duration'], 0, 1 );

		if( is_array( $account_ids ) ){
			$mix_posts = []; $errors = [];
			$mif_instagram_type = esf_insta_instagram_type();
			$trasneint_name = "esf_insta_user_posts-{$instance['user_id']}-{$instance['feeds_per_page']}-{$mif_instagram_type}-{$duration}";
			$posts_json = get_transient( $trasneint_name ) ;

			if( isset( $posts_json ) && !empty( $posts_json ) ){
				$posts_json = json_decode( $posts_json );
				return apply_filters( 'esf_insta_query_feed_return', $posts_json );
			}
			$cache_seconds = esf_insta_get_cache_seconds( $instance );
			$total_accounts = 0;
			foreach ( $account_ids as $check_fanpage_id) {
				$check_fanpage_id = str_replace(' ', '', $check_fanpage_id);
				if ( isset( $check_fanpage_id ) && ! empty( $check_fanpage_id ) ) {
					$total_accounts++;
				}
			}
			if( $total_accounts > 1  ){
				$test_mode = true;
			}else{
				$test_mode = false;
			}

			// Loop through each account id, get it's feed and merge in a array
			foreach ( $account_ids as $account_id){
				$account_id = str_replace(' ', '', $account_id);
				if( isset( $account_id ) && !empty( $account_id ) ){
					$esf_insta = new ESF_Instagram_Frontend();
					$account_feed = $esf_insta->esf_insta_get_feeds( $instance['feeds_per_page'], 0, $cache_seconds,  $account_id, '', $test_mode, $duration );
					if( isset( $account_feed->data ) && !empty( $account_feed->data ) ){
						$mix_posts[$account_id] = $account_feed;
					} else {
						$errors[$account_id]['error'] = $account_feed->error;
					}
				}
			}

			if( isset( $mix_posts ) && !empty( $mix_posts ) && $total_accounts > 1 ){
				$sorted_posts = $this->sort_by_created_time( $mix_posts, $instance);
				$posts_object = $this->create_object( $instance, $sorted_posts['sorted_posts'], $sorted_posts['next_posts_url'] );
				set_transient( $trasneint_name, wp_json_encode( $posts_object ), $cache_seconds );
				return apply_filters( 'esf_insta_query_feed_return', $posts_object );

			}else{
				return apply_filters( 'esf_insta_query_feed_return', $account_feed );

			}
		}
	}

	/**
	 * Sort mixed posts by created time
	 *
	 * @param $mix_posts
	 * @param $instance
	 * @param $trasneint_name
	 *
	 * @return array
	 */
	private function sort_by_created_time( $mix_posts, $instance){
		if( isset( $mix_posts ) && !empty( $mix_posts ) ){

			$all_posts = [];
			$next_posts_url = null;

			foreach ( $mix_posts as $post ){
				$all_posts = array_merge( $all_posts, $post->data );
				$next_posts_url = $next_posts_url.','.$post->pagination;
			}

			$ord = [];
			foreach ( $all_posts as $single_post ){
				$ord[] = strtotime($single_post->timestamp);
			}
			array_multisort($ord, SORT_DESC, $all_posts);
			$all_posts = array_slice($all_posts, 0, $instance['feeds_per_page']);
			return [ 'sorted_posts' => $all_posts, 'next_posts_url' => $next_posts_url];
		}
	}

	/**
	 * Get mixed more posts on load more
	 *
	 * @since 1.1.0
	 * @return array|false
	 */
	public function get_more_posts(){

		if( !isset( $_POST['shortcode_atts'] ) && empty( $_POST['shortcode_atts'] ) ) return false;

		if( isset( $_POST['current_items'] ) ){
			$current_items = intval( $_POST['current_items'] );
		}
		$shortcode_atts = $_POST['shortcode_atts'];
		$shortcode_atts = explode( "+", $shortcode_atts );
		$cache_seconds = $shortcode_atts['4'];
		$feeds_per_page = $shortcode_atts['1'];
		$trasneint_name = sanitize_text_field( $_POST['transient_name'] );
		$esf_insta_posts = get_transient( $trasneint_name );
		if ( $esf_insta_posts ) {
			$esf_insta_posts = json_decode( $esf_insta_posts );
			$next_posts_url = $esf_insta_posts->pagination;
			$esf_insta_posts = $esf_insta_posts->data;
		}
		$next_posts = array_slice( $esf_insta_posts, $current_items, $feeds_per_page );

		// If posts are not already cached fetch new one
		if ( empty( $next_posts ) && isset( $next_posts_url ) ) {
				$next_posts_urls = explode(',', $next_posts_url );

				$new_next_posts_url = null;

				if( isset( $next_posts_urls ) && !empty( $next_posts_urls ) ){
					$mix_posts = array();
					foreach ( $next_posts_urls as $next_posts_url_single ){

						if( !empty( $next_posts_url_single ) ){

							$next_posts_json   = jws_fetchUrl( $next_posts_url_single );
							$next_json_decoded = json_decode( $next_posts_json );
							if( isset( $next_json_decoded->data ) && !empty( $next_json_decoded->data ) ){
								$mix_posts[] = (object) ['data' => $next_json_decoded->data];
								$next_paging_url = $next_json_decoded->paging->next;
								$new_next_posts_url = $new_next_posts_url.','.$next_paging_url;
							}
						}
					}
					$instance = [ 'feeds_per_page' => $feeds_per_page ];
					$sorted_posts = $this->sort_by_created_time( $mix_posts, $instance );
					$final_posts     = array_merge( $esf_insta_posts, $sorted_posts['sorted_posts'] );
					$final_posts_arr = $this->create_object( $instance, $final_posts, $new_next_posts_url );

					if ( ! isset( $final_posts_arr->error ) && ! empty( $sorted_posts['sorted_posts'] ) ) {
						set_transient( $trasneint_name, wp_json_encode( $final_posts_arr ), $cache_seconds );
					} else {
						return false;
					}
					$next_posts = $sorted_posts['sorted_posts'];
					$next_posts_url = $sorted_posts['next_posts_url'];
				}
		}
		return  [ 'next-posts' => $next_posts, 'next-posts-url' => $next_posts_url];
	}

	/**
	 * Create object like default posts to make popup work properly
	 *
	 * @param $instance
	 * @param $posts
	 * @param $next_url
	 *
	 * @return array|false
	 */
	private function create_object( $instance, $posts, $next_url ){
		if( !isset( $instance ) && !isset( $posts ) ) return false;
		$object = [];
		$posts_object['data'] = $posts;
		if( isset( $next_url ) && !empty( $next_url ) ){
			$object = ( object ) $posts_object;
			$object->pagination =  $next_url;
		}
		return  $object;
	}

}
new Esf_Multifeed_Instagram_Frontend();
}