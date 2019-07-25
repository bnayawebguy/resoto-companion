<?php
	/** Helper Functions **/

	/** Order List **/
	function resoto_companion_order_list() {
		return array(
			'ASC' => esc_html( 'Ascending', 'resoto-companion' ),
			'DESC' => esc_html( 'descending', 'resoto-companion' ),
		);
	}

	/** Orderby List **/
	function resoto_companion_orderby_list() {
		return array(
			'none' => esc_html( 'None', 'resoto-companion' ),
			'date' => esc_html( 'Date', 'resoto-companion' ),
			'ID' => esc_html( 'ID', 'resoto-companion' ),
			'author' => esc_html( 'Author', 'resoto-companion' ),
			'title' => esc_html( 'Title', 'resoto-companion' ),
			'rand' => esc_html( 'Random', 'resoto-companion' ),
		);
	}

	/** Category Lists **/
	function resoto_companion_category_lists() {
		$categories = get_categories();
		$category_list = array();

		$category_list['all'] = esc_html__( 'All Category', 'resoto-companion' );

		foreach( $categories as $category ) {
			$category_list[$category->slug] = $category->name;
		}

		return $category_list;
	}