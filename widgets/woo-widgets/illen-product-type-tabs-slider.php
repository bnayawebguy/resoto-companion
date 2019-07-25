<?php
class Illen_Product_Type_Tabs_Slider extends \Elementor\Widget_Base {

	public function get_name() {
        return 'product-type-tab-slider';
    }

	public function get_title() {
        return esc_html__( 'Product Type Tab Slider', 'illen' );
    }

	public function get_icon() {
        return 'fa fa-code';
    }

	public function get_categories() {
        return [ 'illen-woo-elements' ];
    }

    public function get_script_depends() {
		return [ 'owl-carousel' ];
	}

	protected function _register_controls() {
        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'illen-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'product_types',
				[
					'label' => __( 'Product Types', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'multiple' => true,
					'options' => [
						'featured' => __( 'Featured Products', 'illen-companion' ),
						'new' => __( 'New Products', 'illen-companion' ),
						'onsale' => __( 'Onsale Products', 'illen-companion' ),
						'best' => __( 'Best Selling Products', 'illen-companion' ),
					]
				]
			);

			$this->add_control(
				'product_type_titles',
				[
					'label' => __( 'Product Type Titles', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'featured_title',
				[
					'label' => __( 'Featured Product Title', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Featured Products', 'illen-companion' ),
				]
			);

			$this->add_control(
				'new_title',
				[
					'label' => __( 'New Product Title', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'New Products', 'illen-companion' ),
				]
			);

			$this->add_control(
				'onsale_title',
				[
					'label' => __( 'Onsale Product Title', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'On Sale', 'illen-companion' ),
				]
			);

			$this->add_control(
				'best_title',
				[
					'label' => __( 'Best Product Title', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Best Seller', 'illen-companion' ),
				]
			);

			$this->add_control(
				'no_of_products',
				[
					'label' => __( 'No. of products', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'no' ],
					'range' => [
						'no' => [
							'min' => 1,
							'max' => 100,
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
				'skin_color',
				[
					'label' => __( 'Skin Color', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .illen-product-type-tabs-slider .tab-list-nav-wrap ul li a:hover, {{WRAPPER}} .illen-product-type-tabs-slider .tab-list-nav-wrap ul li a.active' => 'background-color: {{VALUE}}',
						'{{WRAPPER}} .illen-product-type-tabs-slider .tab-list-nav-wrap, {{WRAPPER}} .illen-product-type-tabs-slider .tab-list-nav-wrap .nav button:hover' => 'border-color: {{VALUE}} ',
						'{{WRAPPER}} .illen-product-type-tabs-slider .tab-list-nav-wrap .nav button:hover' => 'color: {{VALUE}}',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'carousel_section',
			[
				'label' => __( 'Carousel', 'illen-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_responsive_control(
				'column',
				[
					'label' => __( 'No. of Column', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'no' => [
							'min' => 2,
							'max' => 4,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => [
						'size' => 4,
						'unit' => 'no',
					],
					'tablet_default' => [
						'size' => 3,
						'unit' => 'no',
					],
					'mobile_default' => [
						'size' => 2,
						'unit' => 'no',
					],
				]
			);

			$this->add_responsive_control(
				'margin',
				[
					'label' => __( 'Item Gap', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => 10,
							'max' => 50,
						],
					],
					'devices' => [ 'desktop', 'tablet', 'mobile' ],
					'desktop_default' => [
						'size' => 20,
						'unit' => 'px',
					],
					'tablet_default' => [
						'size' => 20,
						'unit' => 'px',
					],
					'mobile_default' => [
						'size' => 10,
						'unit' => 'px',
					],
				]
			);

			$this->add_control(
				'nav',
				[
					'label' => __( 'Display Nav', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'illen-companion' ),
					'label_off' => __( 'Hide', 'illen-companion' ),
					'return_value' => 'true',
					'default' => 'true',
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label' => __( 'Autoplay', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => __( 'Yes', 'illen-companion' ),
					'label_off' => __( 'No', 'illen-companion' ),
					'return_value' => 'true',
					'default' => 'true',
				]
			);

		$this->end_controls_section();
    }

    /** Render Layout **/
	protected function render() {
		$settings = $this->get_settings_for_display();

		$product_types = $settings['product_types'];
		$no_of_products = $settings['no_of_products']['size'];

		if( !empty( $product_types ) ) {
			$counter = 1;
			?>
			<div id="<?php echo 'illen-product-type-tabs-slider-'.esc_attr( $this->get_id() ); ?>" class="illen-product-type-tabs-slider">
				<div class="tab-list-nav-wrap">
					<ul class="tab-list">
						<?php
							foreach( $product_types as $product_type ) {
								$product_type_title = $product_type.'_title';
								$active_class = ( $counter == 1 ) ? 'active' : '';
								?>
								<li>
									<a class="<?php echo esc_attr($active_class); ?>" data-toggle="tab" href="#ptts-<?php echo esc_attr( $product_type ); ?>">
										<?php echo esc_html( $settings[$product_type_title] ); ?>
									</a>
								</li>
								<?php
								$counter++;
							}
							$counter = 1;
						?>
					</ul>
					<?php if( $settings['nav'] ) : ?>
						<div class="nav">
							<button class="prev-slide"><i class="pe-7s-angle-left"></i></button>
							<button class="next-slide"><i class="pe-7s-angle-right"></i></button>
						</div>
					<?php endif; ?>
				</div>

				<div class="all-product-contents">
					<?php
						foreach( $product_types as $product_type ) {
							$active_class = ( $counter == 1 ) ? 'active' : '';
							?>
							<div id="ptts-<?php echo esc_attr( $product_type ); ?>" class="specific-products-wrap owl-carousel <?php echo esc_attr($active_class); ?>">
								<?php
									$product_query_args = $this->product_query_args( $settings, $product_type );

									$product_query = new WP_Query( $product_query_args );

									if( $product_query->have_posts() ) {
										while( $product_query->have_posts() ) {
											$product_query->the_post();

											wc_get_template_part( 'content', 'product' );
										} wp_reset_postdata();
									}
								?>
							</div>
							<?php
							$counter++;
						}
					?>
				</div>
			</div>
			<?php
		}

		$this->render_scripts( $settings );
	}

	/** Product Query Arguments **/
	public function product_query_args( $settings, $product_type ) {
		$product_query_arguments = array();

		if( $product_type == 'featured' ) {
			$meta_query  = WC()->query->get_meta_query();
			$tax_query   = WC()->query->get_tax_query();
			$tax_query[] = array(
			    'taxonomy' => 'product_visibility',
			    'field'    => 'name',
			    'terms'    => 'featured',
			    'operator' => 'IN',
			);
			 
			$product_query_arguments = array(
			    'post_type'           => 'product',
			    'posts_per_page'      => $settings['no_of_products']['size'],
			    'meta_query'          => $meta_query,
			    'tax_query'           => $tax_query,
			);
		} elseif( $product_type == 'new' ) {
			$product_query_arguments = array(
			    'post_type'           => 'product',
			    'posts_per_page'      => $settings['no_of_products']['size'],
			);
		} elseif( $product_type == 'onsale' ) {
			$product_query_arguments = array(
			    'post_type'      => 'product',
			    'posts_per_page' => $settings['no_of_products']['size'],
			    'meta_query'     => array(
			        'relation' => 'OR',
			        array( // Simple products type
			            'key'           => '_sale_price',
			            'value'         => 0,
			            'compare'       => '>',
			            'type'          => 'numeric'
			        ),
			        array( // Variable products type
			            'key'           => '_min_variation_sale_price',
			            'value'         => 0,
			            'compare'       => '>',
			            'type'          => 'numeric'
			        )
			    )
			);
		} elseif( $product_type == 'best' ) {
			$product_query_arguments = array(
				'post_type' 			=> 'product',
				'ignore_sticky_posts'   => 1,
				'posts_per_page'		=> $settings['no_of_products']['size'],			
				'meta_key' 		 		=> 'total_sales',
				'orderby' 		 		=> 'meta_value_num',
			);
		}

		return $product_query_arguments;
	}

	/** Render Element Javascript **/
	public function render_scripts( $settings ) {
		$uid = 'illen-product-type-tabs-slider-' . esc_attr($this->get_id());
		$autoplay = ( $settings['autoplay'] ) ? 'true' : 'false';
		?>
		<script type="text/javascript">

			jQuery(document).ready( function($) {
				var ptts = $('#<?php echo esc_attr($uid); ?>');

				ptts.find('a[data-toggle="tab"]').on('click', function (e) {
					e.preventDefault();

					var tab_link = $(this).attr('href');

					$(this).parents('ul').find('a').removeClass('active');
					$(this).addClass('active');

					$(this).parents('.tab-list-nav-wrap').next('.all-product-contents').find('.specific-products-wrap').removeClass('active');
					$(this).parents('.tab-list-nav-wrap').next('.all-product-contents').find(tab_link).addClass('active');
				});

				var ocarous = ptts.find('.specific-products-wrap').owlCarousel({
					responsive : {
					    // Mobile Devices
					    0 : {
					       items: <?php echo esc_attr($settings['column_mobile']['size']); ?>,
					       margin: <?php echo esc_attr($settings['margin_mobile']['size']); ?>
					    },
					    // Tablet
					    481 : {
					        items: <?php echo esc_attr($settings['column_tablet']['size']); ?>,
					        margin: <?php echo esc_attr($settings['margin_tablet']['size']); ?>
					    },
					    // Desktop
					    769 : {
					        items: <?php echo esc_attr($settings['column']['size']); ?>,
					        margin: <?php echo esc_attr($settings['margin']['size']); ?>
					    }
					},
					nav : false,
					autoplay : <?php echo esc_attr( $autoplay ); ?>,
					autoplayHoverPause : true
				});

				ptts.find('.next-slide').on('click', function(e) {
					e.preventDefault();
					ocarous.trigger('next.owl.carousel');
				});

				ptts.find('.prev-slide').on('click', function(e) {
					e.preventDefault();
					ocarous.trigger('prev.owl.carousel');
				});
			});

		</script>
		<?php
	}

	protected function _content_template() {}
}