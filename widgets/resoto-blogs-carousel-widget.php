<?php
class Resoto_Blogs_Carousel_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'resoto-blogs-carousel';
    }

	public function get_title() {
        return esc_html__( 'Blogs Carousel', 'resoto-companion' );
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
			'blogs_query_section',
			[
				'label' => __( 'Blogs Query', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'blogs_categories',
				[
					'label' => __( 'Blogs Categories', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'multiple' => true,
					'options' => resoto_companion_category_lists(),
					'default' => [ 'all' ],
				]
			);

			$this->add_control(
				'no_of_posts',
				[
					'label' => __( 'No. of Posts', 'resoto-companion' ),
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
				'readmore_text',
				[
					'label' => __( 'Readmore Text', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Read More', 'resoto-companion' ),
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'blogs_carousel_section',
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
				'dots',
				[
					'label' => __( 'Dots', 'resoto-companion' ),
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
			'date_style',
			[
				'label' => __( 'Date Text', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'date_color',
				[
					'label' => __( 'Color', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .resoto-blogs-carousel .post-date' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'date_bgcolor',
				[
					'label' => __( 'Background Color', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .resoto-blogs-carousel .post-date' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'date_typography',
					'label' => __( 'Typography', 'resoto-companion' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .resoto-blogs-carousel .post-date',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'cats_style',
			[
				'label' => __( 'Categories', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs(
				'cats_style_tabs'
			);

				$this->start_controls_tab(
					'cats_style_normal_tab',
					[
						'label' => __( 'Normal', 'resoto-companion' ),
					]
				);

					$this->add_control(
						'cats_color_normal',
						[
							'label' => __( 'Color', 'resoto-companion' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'scheme' => [
								'type' => \Elementor\Scheme_Color::get_type(),
								'value' => \Elementor\Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .resoto-blogs-carousel .blog-metas .cats a' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' => 'cats_typography_normal',
							'label' => __( 'Typography', 'resoto-companion' ),
							'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
							'selector' => '{{WRAPPER}} .resoto-blogs-carousel .blog-metas .cats a',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'cats_style_hover_tab',
					[
						'label' => __( 'Hover', 'resoto-companion' ),
					]
				);

					$this->add_control(
						'cats_color_hover',
						[
							'label' => __( 'Color', 'resoto-companion' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'scheme' => [
								'type' => \Elementor\Scheme_Color::get_type(),
								'value' => \Elementor\Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .resoto-blogs-carousel .blog-metas .cats a:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' => 'cats_typography_hover',
							'label' => __( 'Typography', 'resoto-companion' ),
							'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
							'selector' => '{{WRAPPER}} .resoto-blogs-carousel .blog-metas .cats a:hover',
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'comments_style',
			[
				'label' => __( 'Comments', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'comments_color',
				[
					'label' => __( 'Color', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .resoto-blogs-carousel .blog-metas .post-comments, {{WRAPPER}} .resoto-blogs-carousel .blog-metas .post-comments:before' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'comments_typography',
					'label' => __( 'Typography', 'resoto-companion' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .resoto-blogs-carousel .blog-metas .post-comments, {{WRAPPER}} .resoto-blogs-carousel .blog-metas .post-comments:before',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style',
			[
				'label' => __( 'Post Title', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'title_margin',
				[
					'label' => __( 'Margin', 'plugin-domain' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'allowed_dimensions' => 'vertical',
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .resoto-blogs-carousel .blog-title' => 'margin: {{TOP}}{{UNIT}} 0 {{BOTTOM}}{{UNIT}} 0;',
					],
				]
			);

			$this->start_controls_tabs(
				'title_style_tabs'
			);

				$this->start_controls_tab(
					'title_style_normal_tab',
					[
						'label' => __( 'Normal', 'resoto-companion' ),
					]
				);

					$this->add_control(
						'title_color_normal',
						[
							'label' => __( 'Color', 'resoto-companion' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'scheme' => [
								'type' => \Elementor\Scheme_Color::get_type(),
								'value' => \Elementor\Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .resoto-blogs-carousel .blog-title a' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' => 'title_typography_normal',
							'label' => __( 'Typography', 'resoto-companion' ),
							'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
							'selector' => '{{WRAPPER}} .resoto-blogs-carousel .blog-title a',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'title_style_hover_tab',
					[
						'label' => __( 'Hover', 'resoto-companion' ),
					]
				);

					$this->add_control(
						'title_color_hover',
						[
							'label' => __( 'Color', 'resoto-companion' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'scheme' => [
								'type' => \Elementor\Scheme_Color::get_type(),
								'value' => \Elementor\Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .resoto-blogs-carousel .blog-title a:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' => 'title_typography_hover',
							'label' => __( 'Typography', 'resoto-companion' ),
							'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
							'selector' => '{{WRAPPER}} .resoto-blogs-carousel .blog-title a',
						]
					);

				$this->end_controls_tab();



			$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'readmore_style',
			[
				'label' => __( 'Readmore Text', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs(
				'readmore_style_tabs'
			);

				$this->start_controls_tab(
					'readmore_style_normal_tab',
					[
						'label' => __( 'Normal', 'resoto-companion' ),
					]
				);

					$this->add_control(
						'readmore_color_normal',
						[
							'label' => __( 'Color', 'resoto-companion' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'scheme' => [
								'type' => \Elementor\Scheme_Color::get_type(),
								'value' => \Elementor\Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .resoto-blogs-carousel .readmore-btn' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' => 'readmore_typography_normal',
							'label' => __( 'Typography', 'resoto-companion' ),
							'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
							'selector' => '{{WRAPPER}} .resoto-blogs-carousel .readmore-btn',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'readmore_style_hover_tab',
					[
						'label' => __( 'Hover', 'resoto-companion' ),
					]
				);

					$this->add_control(
						'readmore_color_hover',
						[
							'label' => __( 'Color', 'resoto-companion' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'scheme' => [
								'type' => \Elementor\Scheme_Color::get_type(),
								'value' => \Elementor\Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .resoto-blogs-carousel .readmore-btn:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_group_control(
						\Elementor\Group_Control_Typography::get_type(),
						[
							'name' => 'readmore_typography_hover',
							'label' => __( 'Typography', 'resoto-companion' ),
							'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
							'selector' => '{{WRAPPER}} .resoto-blogs-carousel .readmore-btn:hover',
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'dots_style',
			[
				'label' => __( 'Dots', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'dots_size',
				[
					'label' => __( 'Size', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 3,
							'max' => 20,
							'step' => 1,
						]
					],
					'default' => [
						'unit' => 'px',
						'size' => 15,
					],
					'selectors' => [
						'{{WRAPPER}} .resoto-blogs-carousel .owl-dots button.owl-dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
					],
				]
			);

			$this->start_controls_tabs(
				'dots_style_tabs'
			);

				$this->start_controls_tab(
					'dots_style_normal_tab',
					[
						'label' => __( 'Normal', 'resoto-companion' ),
					]
				);

					$this->add_control(
						'dots_color_normal',
						[
							'label' => __( 'Color', 'resoto-companion' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'scheme' => [
								'type' => \Elementor\Scheme_Color::get_type(),
								'value' => \Elementor\Scheme_Color::COLOR_1,
							],
							'selectors' => [
								'{{WRAPPER}} .resoto-blogs-carousel .owl-dots button.owl-dot' => 'border-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'dots_style_hover_tab',
					[
						'label' => __( 'Hover', 'resoto-companion' ),
					]
				);

					$this->add_control(
						'dots_color_hover',
						[
							'label' => __( 'Color', 'resoto-companion' ),
							'type' => \Elementor\Controls_Manager::COLOR,
							'scheme' => [
								'type' => \Elementor\Scheme_Color::get_type(),
								'value' => \Elementor\Scheme_Color::COLOR_1,
							],
							'default' => '#ec6a2a',
							'selectors' => [
								'{{WRAPPER}} .resoto-blogs-carousel .owl-dots button.owl-dot.active, .resoto-blogs-carousel .owl-dots button.owl-dot:hover' => 'border-color: {{VALUE}}',
								'{{WRAPPER}} .resoto-blogs-carousel .owl-dots button.owl-dot.active, .resoto-blogs-carousel .owl-dots button.owl-dot:hover' => 'background-color: {{VALUE}}',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();	

    }

    /** Render Layout **/
	protected function render() {
		$settings = $this->get_settings_for_display();

		$cat_ids = $this->category_id_to_slug( $settings['blogs_categories'] );

		$no_of_posts = (isset( $settings[ 'no_of_posts' ]['size'] )) ? $settings[ 'no_of_posts' ]['size'] : 10;

		$blogs_query = new WP_Query( array(
			'posts_per_page' => $no_of_posts,
			'order_by' => $settings['order_by'],
			'category__in' => $cat_ids,
			'order' => $settings['order'],
		) );

		if( $blogs_query->have_posts() ) :
		?>
			<div class="resoto-blogs-carousel owl-carousel" id="resoto-blogs-carousel-<?php echo esc_attr( $this->get_id() ); ?>">

				<?php while( $blogs_query->have_posts() ) : $blogs_query->the_post(); ?>
					<?php if( has_post_thumbnail() ) : ?>
						<?php
							$img = wp_get_attachment_image_src( get_post_thumbnail_id(), 'resoto-blogs-carousel' );
							$img_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
						?>
						<div class="blog-post">
							<div class="blog-image">
								<span class="post-date"><?php esc_html_e(get_the_date()); ?></span>
								<img src="<?php echo esc_url( $img[0] ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">		
							</div>

							<div class="blog-metas">
								<span class="cats">
									<?php
										echo wp_kses_post(get_the_category_list( __( ', ', 'resoto-companion' ) ));
									?>
								</span>

								<span class="post-comments">
									<i class="lni-bubble"></i>
									<?php comments_number( 'no comments', 'one comment', '% comments' ); ?>
								</span>
							</div>

							<h3 class="blog-title">
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
								</a>
							</h3>
							
							<?php if( $settings['readmore_text'] ) : ?>
								<a href="<?php the_permalink(); ?>" class="readmore-btn">
									<?php esc_html_e( $settings['readmore_text'] ); ?>
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
		$uid = 'resoto-blogs-carousel-' . esc_attr($this->get_id());
		$loop = ( $settings['loop'] ) ? 'true' : 'false';
		$dots = ( $settings['dots'] ) ? 'true' : 'false';
		$autoplay = ( $settings['autoplay'] ) ? 'true' : 'false';
		$pause_on_hover = ( $settings['pause_on_hover'] ) ? 'true' : 'false';
		$margin = ( isset( $settings['margin'] ) ) ? $settings['margin'] : 0;
		?>
		<script type="text/javascript">
			jQuery(document).ready( function($) {
				$('#<?php echo esc_attr( $uid ); ?>').owlCarousel({
					items: 3,
					nav: false,
					dots: <?php echo esc_attr( $dots ); ?>,
					loop: <?php echo esc_attr($loop); ?>,
					autoplay: <?php echo esc_attr($autoplay); ?>,
					autoplayHoverPause: <?php echo esc_attr($pause_on_hover); ?>,
					margin: <?php echo esc_attr( $margin ); ?>,
				});
			});
		</script>
		<?php
	}

	protected function _content_template() {}

	public function category_id_to_slug( $cats ) {
		$category_ids = array();

		if(!empty( $cats )) {
			foreach( $cats as $key => $slug ) {
				$cat = get_category_by_slug( $slug );
				$category_ids[] = $cat->term_id;
			}
		}
	}
}