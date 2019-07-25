<?php
class Resoto_Rooms_Carousel_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'resoto-room-carousel';
    }

	public function get_title() {
        return esc_html__( 'Rooms Carousel', 'resoto-companion' );
    }

	public function get_icon() {
        return 'fa fa-code';
    }

	public function get_categories() {
        return [ 'resoto-elements' ];
    }

    public function get_script_depends() {
		return [ 'owl-carousel' ];
	}

	protected function _register_controls() {

        $this->start_controls_section(
			'rooms_query_section',
			[
				'label' => __( 'Rooms Query', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'no_of_rooms',
				[
					'label' => __( 'No. of Rooms', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'no' ],
					'range' => [
						'no' => [
							'min' => 3,
							'max' => 20,
							'step' => 1,
						]
					],
					'default' => [
						'unit' => 'no',
						'size' => 10,
					],
					'selectors' => [
						'{{WRAPPER}} .box' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'order_by',
				[
					'label' => __( 'Order By', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'none',
					'options' => resoto_companion_orderby_list()
				]
			);

			$this->add_control(
				'order',
				[
					'label' => __( 'Order', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::SELECT,
					'default' => 'ASC',
					'options' => resoto_companion_order_list()
				]
			);

			$this->add_control(
				'price_prefix',
				[
					'label' => __( 'Price Prefix Text', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'From', 'resoto-companion' ),
				]
			);

			$this->add_control(
				'btn_text',
				[
					'label' => __( 'Button Text', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'BOOK NOW', 'resoto-companion' ),
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'rooms_carousel_section',
			[
				'label' => __( 'Carousel', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'margin',
				[
					'label' => __( 'Margin Between Slides', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 0,
					'max' => 100,
					'step' => 1,
					'default' => 0,
				]
			);

			$this->add_control(
				'loop',
				[
					'label' => __( 'Loop Slides', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'resoto-companion' ),
					'label_off' => __( 'No', 'resoto-companion' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'nav',
				[
					'label' => __( 'Navigation Arrow', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'resoto-companion' ),
					'label_off' => __( 'Hide', 'resoto-companion' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label' => __( 'Autoplay', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'resoto-companion' ),
					'label_off' => __( 'No', 'resoto-companion' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label' => __( 'Pause On Hover', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'resoto-companion' ),
					'label_off' => __( 'No', 'resoto-companion' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'rooms_price_style',
			[
				'label' => __( 'Price Text', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'price_text_color',
				[
					'label' => __( 'Color', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .resoto-rooms-carousel .room-post .room-price' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'price_typography',
					'label' => __( 'Typography', 'resoto-companion' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .resoto-rooms-carousel .room-post .room-price',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'rooms_title_style',
			[
				'label' => __( 'Rooms Title', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'title_color',
				[
					'label' => __( 'Color', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .resoto-rooms-carousel .room-post .room-price-title .room-title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'label' => __( 'Typography', 'resoto-companion' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .resoto-rooms-carousel .room-post .room-price-title .room-title',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'rooms_btn_style',
			[
				'label' => __( 'Button', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'btn_color',
				[
					'label' => __( 'Color', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .resoto-rooms-carousel .room-post .buy-now-btn' => 'color: {{VALUE}}',
						'{{WRAPPER}} .resoto-rooms-carousel .room-post .buy-now-btn:after' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'btn_typography',
					'label' => __( 'Typography', 'resoto-companion' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .resoto-rooms-carousel .room-post .buy-now-btn',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'arrow_style',
			[
				'label' => __( 'Arrow', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs(
				'arrow_style_tabs'
			);

				$this->start_controls_tab(
					'arrow_style_normal_tab',
					[
						'label' => __( 'Normal', 'resoto-companion' ),
					]
				);

					$this->add_control(
						'arrow_color_normal',
						[
							'label' => __( 'Color', 'resoto-companion' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'scheme' => [
								'type' => \Elementor\Scheme_Color::get_type(),
								'value' => \Elementor\Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .resoto-rooms-carousel .owl-nav button.owl-prev, {{WRAPPER}} .resoto-rooms-carousel .owl-nav button.owl-next' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'arrow_bgcolor_normal',
						[
							'label' => __( 'Background Color', 'resoto-companion' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'scheme' => [
								'type' => \Elementor\Scheme_Color::get_type(),
								'value' => \Elementor\Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .resoto-rooms-carousel .owl-nav button.owl-prev, {{WRAPPER}} .resoto-rooms-carousel .owl-nav button.owl-next' => 'background-color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 'arrow_border_normal',
							'label' => __( 'Border', 'resoto-companion' ),
							'selector' => '{{WRAPPER}} .resoto-rooms-carousel .owl-nav button.owl-prev:hover, {{WRAPPER}} .resoto-rooms-carousel .owl-nav button.owl-next:hover',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'arrow_style_hover_tab',
					[
						'label' => __( 'Hover', 'resoto-companion' ),
					]
				);

					$this->add_control(
						'arrow_color_hover',
						[
							'label' => __( 'Color', 'resoto-companion' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'scheme' => [
								'type' => \Elementor\Scheme_Color::get_type(),
								'value' => \Elementor\Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .resoto-rooms-carousel .owl-nav button.owl-prev:hover, {{WRAPPER}} .resoto-rooms-carousel .owl-nav button.owl-next:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'arrow_bgcolor_hover',
						[
							'label' => __( 'Background Color', 'resoto-companion' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'scheme' => [
								'type' => \Elementor\Scheme_Color::get_type(),
								'value' => \Elementor\Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .resoto-rooms-carousel .owl-nav button.owl-prev:hover, {{WRAPPER}} .resoto-rooms-carousel .owl-nav button.owl-next:hover' => 'background-color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Border::get_type(),
						[
							'name' => 'arrow_border_hover',
							'label' => __( 'Border', 'resoto-companion' ),
							'selector' => '{{WRAPPER}} .resoto-rooms-carousel .owl-nav button.owl-prev:hover, {{WRAPPER}} .resoto-rooms-carousel .owl-nav button.owl-next:hover',
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

    }

    /** Render Layout **/
	protected function render() {
		$settings = $this->get_settings_for_display();

		$no_of_rooms = (isset( $settings[ 'no_of_rooms' ]['size'] )) ? $settings[ 'no_of_rooms' ]['size'] : 10;

		$room_query = new WP_Query( array(
			'post_type' => 'hb_room',
			'posts_per_page' => $no_of_rooms,
			'order_by' => $settings['order_by'],
			'order' => $settings['order'],
		) );

		if( $room_query->have_posts() ) :
		?>
			<div class="resoto-rooms-carousel owl-carousel" id="resoto-rooms-carousel-<?php echo esc_attr( $this->get_id() ); ?>">

				<?php while( $room_query->have_posts() ) : $room_query->the_post(); ?>
					<?php if( has_post_thumbnail() ) : ?>
						<?php
							$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'resoto-room-carousel' );
							$img_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );

							$plan = hb_room_get_selected_plan( get_the_ID() );
							$prices = hb_room_get_selected_plan( get_the_ID() );
							$prices = isset( $prices->prices ) ? $prices->prices : array();

							if( $prices ) {
								$min_price = is_numeric( min( $prices ) ) ? min( $prices ) : 0;
								$min = $min_price + ( hb_price_including_tax() ? ( $min_price * hb_get_tax_settings() ) : 0 );
							}
						?>
						<div class="room-post">
							<div class="room-image">
								<img src="<?php echo esc_url( $img[0] ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">		
							</div>
							<div class="room-price-title">
								<span class="room-price">
									<?php if( $settings['price_prefix'] ) : ?>
										<?php echo esc_html( $settings['price_prefix'] ); ?>
									<?php endif; ?>
									<?php echo hb_format_price( $min ) ?>
								</span>
								<h3 class="room-title">
									<?php the_title(); ?>
								</h3>
							</div>
							
							<?php if( $settings['btn_text'] ) : ?>
								<a href="<?php the_permalink(); ?>" class="buy-now-btn">
									<?php esc_html_e( $settings['btn_text'] ); ?>
								</a>
							<?php endif; ?>
						</div>
					<?php endif; ?>

				<?php endwhile; ?>
				
			</div>
		<?php
		endif;
		wp_reset_postdata();

		$this->render_scripts( $settings );
	}

	/** Render Element Javascript **/
	public function render_scripts( $settings ) {
		$uid = 'resoto-rooms-carousel-' . esc_attr($this->get_id());
		$loop = ( $settings['loop'] ) ? 'true' : 'false';
		$nav = ( $settings['nav'] ) ? 'true' : 'false';
		$autoplay = ( $settings['autoplay'] ) ? 'true' : 'false';
		$pause_on_hover = ( $settings['pause_on_hover'] ) ? 'true' : 'false';
		$margin = ( isset( $settings['margin'] ) ) ? $settings['margin'] : 0;
		?>
		<script type="text/javascript">
			jQuery(document).ready( function($) {
				$('#<?php echo esc_attr( $uid ); ?>').owlCarousel({
					items: 3,
					nav: <?php echo esc_attr($nav); ?>,
					loop: <?php echo esc_attr($loop); ?>,
					autoplay: <?php echo esc_attr($autoplay); ?>,
					autoplayHoverPause: <?php echo esc_attr($pause_on_hover); ?>,
					navText: ['<i class="lni-arrow-left"></i>', '<i class="lni-arrow-right"></i>'],
					margin: <?php echo esc_attr( $margin ); ?>,
				});
			});
		</script>
		<?php
	}

	protected function _content_template() {}
}