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
if ( ! class_exists( 'Esf_Multifeed_Facebook_Frontend' ) ){

class Esf_Multifeed_Facebook_Frontend {

	/**
	 * Constructor.
	 *
	 * Fire all required wp actions
	 *
	 * @since  1.0.0
	 */
	function __construct(){

		add_filter( 'efbl_filter_queried_data', [
			$this,
			'check_multiple_pages'
		] );

		add_filter( 'efbl_filter_load_more_data', [
			$this,
			'get_more_posts'
		] );

	}

	/**
	 * Check if instance has multiple pages
	 *
	 * @param $instance
	 * @since  1.0.0
	 */
	public function check_multiple_pages( $instance ) {

		if( !isset( $instance['fanpage_id'] ) ) return false;
		$fanpage_ids = explode(',', $instance['fanpage_id'] );
		$duration = $instance['cache_unit'] . '-' . substr( $instance['cache_duration'], 0, 1 );

		if( is_array( $fanpage_ids ) ){
			$mix_posts = []; $errors = [];
			$page_username = efbl_get_page_username( $instance['fanpage_id'] );


			if( isset( $instance['filter'] ) && !empty( $instance['filter'] ) && $this->is_valid_filter( $instance['filter'] ) ){
				$trasneint_name = 'efbl_'.$instance['filter'].'_posts_'.str_replace(' ', '', $page_username).'-'.$instance['post_limit'].'-'.$duration;
				$posts_json = json_decode( get_transient( $trasneint_name ) );
				$all_posts = $posts_json->data;
			}else{
				$trasneint_name = 'efbl_posts_'.str_replace(' ', '', $page_username).'-'.$instance['post_limit'].'-'.$duration;
				$posts_json = json_decode( get_transient( $trasneint_name ) );
				$all_posts = $posts_json->posts->data;
			}

			// If mixed posts already exists in cache
			if( isset( $all_posts ) && !empty( $all_posts ) ){
				return apply_filters( 'efbl_query_posts_return', array(
					'posts' => $all_posts,
					'error' => '',
					'next_posts_url' => '',
					'transient_name' => $trasneint_name,
					'is_saved_posts' => true,
					'access_token' => '',
					'cache_seconds' => ''
				));
			}

			$total_pages = 0;
			foreach ( $fanpage_ids as $check_fanpage_id) {
				$check_fanpage_id = str_replace(' ', '', $check_fanpage_id);
				if ( isset( $check_fanpage_id ) && ! empty( $check_fanpage_id ) ) {
					$total_pages++;
				}
			}
			if( $total_pages > 1  ){
				$instance['test_mode'] = true;
			}else{
				$instance['test_mode'] = false;
			}

			// Loop through each page id, get it's feed and merge in a array
			foreach ( $fanpage_ids as $fanpage_id){
				$fanpage_id = str_replace(' ', '', $fanpage_id);

				if( isset( $fanpage_id ) && !empty( $fanpage_id ) ){
					$efbl = new Easy_Facebook_Likebox();
					$page_feed = $efbl->query_posts( $fanpage_id, $instance );
					if( isset( $page_feed['posts'] ) && !empty( $page_feed['posts'] ) && empty( $page_feed['error'] ) ){
						$mix_posts[$fanpage_id] = $page_feed;
					} else {
						$errors[$fanpage_id]['error'] = $page_feed['error'];
					}
				}
			}

			if( isset( $mix_posts ) && !empty( $mix_posts ) && $total_pages > 1 ){
				$cache_seconds = efbl_get_cache_seconds( $instance );
				$sorted_posts = $this->sort_by_created_time( $mix_posts, $instance, $trasneint_name);
				$posts_object = $this->create_object( $instance, $sorted_posts['sorted_posts'], $sorted_posts['next_posts_url'] );
				set_transient( $trasneint_name, json_encode($posts_object), $cache_seconds );

				return apply_filters( 'efbl_query_posts_return', array(
					'posts' => $sorted_posts['sorted_posts'],
					'error' => $json_decoded->error,
					'next_posts_url' => $sorted_posts['next_posts_url'],
					'transient_name' => $trasneint_name,
					'is_saved_posts' => $is_saved_posts,
					'access_token' => $access_token,
					'cache_seconds' => $cache_seconds
				));

			}else{

				return apply_filters( 'efbl_query_posts_return', array(
					'posts' => $page_feed['posts'],
					'error' => $json_decoded->error,
					'next_posts_url' => $next_post_url,
					'transient_name' => $trasneint_name,
					'is_saved_posts' => $is_saved_posts,
					'access_token' => $access_token,
					'cache_seconds' => $cache_seconds
				));
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
	 * @since 1.0.0
	 * @return array
	 */
	private function sort_by_created_time( $mix_posts, $instance){
		if( isset( $mix_posts ) && !empty( $mix_posts ) ){

			$all_posts = [];
			$next_posts_url = null;

			foreach ( $mix_posts as $post ){
				$all_posts = array_merge( $all_posts, $post['posts'] );
				$next_posts_url = $next_posts_url.','.$post['next_posts_url'];
			}

			$ord = [];
			foreach ( $all_posts as $single_post ){
				$ord[] = strtotime($single_post->created_time);
			}

			array_multisort($ord, SORT_DESC, $all_posts);
			$all_posts = array_slice($all_posts, 0, $instance['post_limit']);
			return [ 'sorted_posts' => $all_posts, 'next_posts_url' => $next_posts_url];

		}
	}

	/**
	 * Get more posts on load more
	 *
	 * @since 1.0.0
	 * @return array|false
	 */
	public function get_more_posts(){

		if( !isset( $_POST['shortcode_atts'] ) && empty( $_POST['shortcode_atts'] ) ) return false;

		if( isset( $_POST['current_items'] ) ){
			$current_items = intval( $_POST['current_items'] );
		}
		$shortcode_atts = $_POST['shortcode_atts'];
		$shortcode_atts = explode( "+", $shortcode_atts );
		$feeds_per_page = $shortcode_atts['0'];
		$cache_seconds = $shortcode_atts['3'];
		$transient_name = $shortcode_atts['6'];
		$filter = $shortcode_atts['7'];
		$posts_json = get_transient( $transient_name );
		$posts_data = json_decode( $posts_json );

		if ( isset( $filter ) && $this->is_valid_filter( $filter ) ) {
			$posts_data_filter = $posts_data->data;
		}else{
			$posts_data_filter = $posts_data->posts->data;
		}

		$next_posts = array_slice( $posts_data_filter, $current_items, $feeds_per_page );
		if ( isset( $filter ) && $this->is_valid_filter( $filter ) ) {
			$next_posts_url = $posts_data->paging->next;
		}else{
			$next_posts_url = $posts_data->posts->paging->next;
		}

		// If posts are not already cached fetch new one
		if ( empty( $next_posts ) ) {
			if( isset( $next_posts_url ) ){
				$next_posts_urls = explode(',', $next_posts_url );
				$mix_posts = [];
				$new_next_posts_url = null;
				if( isset( $next_posts_urls ) && !empty( $next_posts_urls ) ){
					foreach ( $next_posts_urls as $next_posts_url_single ){
						if( !empty( $next_posts_url_single ) ){
							$next_posts_json   = jws_fetchUrl( $next_posts_url_single );
							$next_json_decoded = json_decode( $next_posts_json );
							if( isset( $next_json_decoded->data ) && !empty( $next_json_decoded->data ) ){
								$mix_posts[]['posts'] = $next_json_decoded->data;
								$next_paging_url = $next_json_decoded->paging->next;
								$new_next_posts_url = $new_next_posts_url.','.$next_paging_url;
							}
						}
					}

					$instance = [ 'post_limit' => $feeds_per_page, 'filter' => $filter ];
					$sorted_posts = $this->sort_by_created_time( $mix_posts, $instance );
					if( is_array( $posts_data_filter ) && is_array( $sorted_posts['sorted_posts'] ) && ! empty( $posts_data_filter ) && ! empty( $sorted_posts['sorted_posts'] ) ){
						$final_posts     = array_merge( $posts_data_filter, $sorted_posts['sorted_posts'] );
					} else {
						$final_posts = array();
					}


					$final_posts_arr = $this->create_object( $instance, $final_posts, $new_next_posts_url );
					if ( ! isset( $final_posts_arr->error ) && ! empty( $sorted_posts['sorted_posts'] ) ) {
						set_transient( $transient_name, json_encode( $final_posts_arr ), $cache_seconds );
					} else {
						return false;
					}

					$next_posts = $sorted_posts['sorted_posts'];
					$next_posts_url = $sorted_posts['next_posts_url'];
				}
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
	 * @since 1.0.0
	 * @return array|false
	 */
	private function create_object( $instance, $posts, $next_url ){
		if( !isset( $instance ) && !isset( $posts ) ) return false;
		$object = [];
		$posts_object['data'] = $posts;

		if( isset( $instance['filter'] ) && !empty( $instance['filter'] ) && $this->is_valid_filter( $instance['filter'] ) ){
			$object =  $posts_object;
		}else{
			$object['posts'] = ( object ) $posts_object;
		}

		if( isset( $next_url ) && !empty( $next_url ) ){
			$paging_object['next'] =  $next_url;
			$object_paging = ( object ) $paging_object;
			if( isset( $instance['filter'] ) && !empty( $instance['filter'] ) && $this->is_valid_filter( $instance['filter'] ) ){
				$object['paging'] = ( object ) $object_paging;
			}else{
				$object['posts']->paging = ( object ) $object_paging;
			}
		}

		return  $object;
	}

	/**
	 * Check if filter value is valid
	 *
	 * @param $filter
	 *
	 * @since 1.0.0
	 * @return bool
	 */
	private function is_valid_filter( $filter ){
		if( !isset( $filter ) && empty( $filter ) ) return false;

		$filters = apply_filters( 'esfmf_available_filter', ['mentioned', 'events', 'albums', 'videos', 'images'] );

		if( in_array( $filter, $filters ) ){
			return  true;
		}else{
			return  false;
		}

	}


}
new Esf_Multifeed_Facebook_Frontend();
}