<?php
class Illen_Category_Tabs_Slider extends \Elementor\Widget_Base {

	public function get_name() {
        return 'category-tab-slider';
    }

	public function get_title() {
        return esc_html__( 'Category Tab Slider', 'illen' );
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

		$woo_categories = $this->get_woo_categories();

        $this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'illen-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_tag',
			[
				'label' => __( 'Title Tag', 'illen-companion' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'span',
				'options' => illen_companion_title_tags()
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => __( 'Title Typography', 'illen-companion' ),
				'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .parent-category-title .title',
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => __( 'Layout', 'illen-companion' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1'  => __( 'Layout 1', 'illen-companion' ),
					'layout-2' => __( 'Layout 2', 'illen-companion' ),
				],
			]
		);

		$this->add_control(
			'product_layout',
			[
				'label' => __( 'Product Layout', 'illen-companion' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'layout-1',
				'options' => [
					'layout-1'  => __( 'Layout 1', 'illen-companion' ),
					'layout-2' => __( 'Layout 2', 'illen-companion' ),
				],
			]
		);

		$this->add_control(
			'parent_category',
			[
				'label' => __( 'Parent Category', 'illen-companion' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'none',
				'options' => $woo_categories,
			]
		);

		$this->add_control(
			'ad_image',
			[
				'label' => __( 'Ad Image', 'illen-companion' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'ad_link',
			[
				'label' => __( 'Ad Link', 'illen-companion' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://link-to-ad.com', 'illen-companion' ),
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
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
					'{{WRAPPER}} .illen-category-tabs-slider .parent-category-title, {{WRAPPER}} .illen-category-tabs-slider.layout-1 .owl-carousel .owl-dot.active' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .illen-category-tabs-slider .pro-cat-list ul a:hover, {{WRAPPER}} .illen-category-tabs-slider .pro-cat-list ul a.active, {{WRAPPER}} .illen-category-tabs-slider.layout-1 .owl-carousel .owl-nav button, {{WRAPPER}} .illen-category-tabs-slider.layout-2 .pro-cat-list i.nv-btn:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .illen-category-tabs-slider.layout-2 .pro-cat-list' => 'border-bottom-color: {{VALUE}}',
					'{{WRAPPER}} .illen-category-tabs-slider.layout-1 .owl-carousel .owl-dot, {{WRAPPER}} .illen-category-tabs-slider.layout-2 .pro-cat-list i.nv-btn:hover' => 'border-color: {{VALUE}} ',
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
				'dots',
				[
					'label' => __( 'Display Pagination', 'illen-companion' ),
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

		if( $settings['layout'] == 'layout-2' ) {
			$this->render_layout_2($settings);
		} else {
			$this->render_layout_1($settings);
		}

		$this->render_scripts( $settings );
	}

	/** Layout 1 **/
	public function render_layout_1($settings) {
		$product_layout = $settings['product_layout'];
		$ad_image = $settings['ad_image'];
		$ad_link = $settings['ad_link'];
		$no_of_products = $settings['no_of_products']['size'];
		$title_tag = $settings['title_tag'];
		$parent_category = get_term_by( 'slug', $settings['parent_category'], 'product_cat', 'ARRAY_A' );
		$child_terms = get_terms( array(
			'taxonomy' => 'product_cat',
		    'parent' => $parent_category['term_id'],
		) );

		$widget_id = $this->get_id();

		if( !empty( $parent_category ) ) {
			$thumbnail_id = get_term_meta( $parent_category['term_id'], 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );
			?>
			<div id="<?php echo 'illen-category-tabs-slider-' . esc_attr($widget_id); ?>" class="illen-category-tabs-slider <?php echo esc_attr( $settings['layout'] ); ?>">
				
				<div class="pro-cat-list">
					<div class="parent-category-title">
						<span class="cat-icon"><img src="<?php echo esc_url( $image ); ?>"></span>
						<?php echo '<' . esc_html( $title_tag ) . ' class="title">'; ?>
							<?php echo esc_html( $parent_category['name'] ); ?>
						<?php echo '</' . esc_html( $title_tag ) . '>'; ?>
					</div>

					<?php $this->get_child_term_list($child_terms, $settings['layout']); ?>

				</div>

				<div class="pro-ad-list-wrapper">

					<?php $this->get_ad( $ad_link['url'], $ad_image['url'] ); ?>

					<?php $this->get_pro_list($child_terms, $no_of_products, $product_layout); ?>

				</div>

			</div>
			<?php
		}
	}

	/** Layout 2 **/
	public function render_layout_2($settings) {
		$product_layout = $settings['product_layout'];
		$ad_image = $settings['ad_image'];
		$ad_link = $settings['ad_link'];
		$no_of_products = $settings['no_of_products']['size'];
		$title_tag = $settings['title_tag'];
		$parent_category = get_term_by( 'slug', $settings['parent_category'], 'product_cat', 'ARRAY_A' );
		$child_terms = get_terms( array(
			'taxonomy' => 'product_cat',
		    'parent' => $parent_category['term_id'],
		) );

		$widget_id = $this->get_id();

		if( !empty( $parent_category ) ) {
			$thumbnail_id = get_term_meta( $parent_category['term_id'], 'thumbnail_id', true );
			$image = wp_get_attachment_url( $thumbnail_id );
			?>
			<div id="<?php echo 'illen-category-tabs-slider-' . esc_attr($widget_id); ?>" class="illen-category-tabs-slider <?php echo esc_attr( $settings['layout'] ); ?>">
				
				<div class="pro-cat-list">
					<div class="parent-category-title">
						<span class="cat-icon"><img src="<?php echo esc_url( $image ); ?>"></span>
						<?php echo '<' . esc_html( $title_tag ) . ' class="title">'; ?>
							<?php echo esc_html( $parent_category['name'] ); ?>
						<?php echo '</' . esc_html( $title_tag ) . '>'; ?>
					</div>

					<?php $this->get_child_term_list($child_terms, $settings['layout']); ?>

				</div>

				<div class="pro-ad-list-wrapper">
					
					<div class="ad-wrapp">
						<?php $this->get_ad( $ad_link['url'], $ad_image['url'] ); ?>
					</div>

					<?php $this->get_pro_list($child_terms, $no_of_products, $product_layout); ?>

				</div>

			</div>
			<?php
		}
	}

	/** Render Element Javascript **/
	public function render_scripts( $settings ) {
		$uid = 'illen-category-tabs-slider-' . esc_attr($this->get_id());
		$nav = ( $settings['nav'] ) ? 'true' : 'false';
		$dots = ( $settings['dots'] ) ? 'true' : 'false';
		$autoplay = ( $settings['autoplay'] ) ? 'true' : 'false';
		?>
		<script type="text/javascript">

			//jQuery(document).ready( function($) {
			jQuery(document).ready( function($) {
				var cat_tab_wrap = $('#<?php echo $uid; ?>');

				cat_tab_wrap.find('a[data-toggle="tab"]').on('click', function (e) {
					e.preventDefault();

					var tab_link = $(this).attr('href');

					$(this).parents('ul').find('a').removeClass('active');
					$(this).addClass('active');

					$(this).parents('.pro-cat-list').next('.pro-ad-list-wrapper').find('.cat-pro-contents').removeClass('active');
					$(this).parents('.pro-cat-list').next('.pro-ad-list-wrapper').find(tab_link).addClass('active');
				});

				var ocarous = cat_tab_wrap.find('.cat-pro-contents').owlCarousel({
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
					nav : <?php echo esc_attr( $nav ); ?>,
					navText : ['<i class="pe-7s-angle-left"></i>', '<i class="pe-7s-angle-right"></i>'],
					dots : <?php echo esc_attr( $dots ); ?>,
					autoplay : <?php echo esc_attr( $autoplay ); ?>,
					autoplayHoverPause : true
				});

				cat_tab_wrap.find('.owl-tg-next').on('click', function(e) {
					e.preventDefault();
					ocarous.trigger('next.owl.carousel');
				});

				cat_tab_wrap.find('.owl-tg-prev').on('click', function(e) {
					e.preventDefault();
					ocarous.trigger('prev.owl.carousel');
				});
			});

		</script>
		<?php
	}

	protected function _content_template() {}

	/**
	 * Get Woocommerce Categories
	 **/
	public function get_woo_categories() {

		$woo_cats = array();
		$woo_cats[0] = __( 'Select a category', 'illen-companion' );

		$terms = get_terms( array(
		    'taxonomy' => 'product_cat',
		    'hide_empty' => false,
		) );

		if( !empty( $terms ) ) {
			foreach( $terms as $term ) {
				$woo_cats[ $term->slug ] = $term->name;
			}
		}

		return $woo_cats;
	}

	/** Get Term List **/
	public function get_child_term_list($child_terms, $layout='layout-1' ) {
		if( !empty( $child_terms ) ) : $counter = 1;
			?>
			<ul>
				<?php foreach( $child_terms as $term ) : ?>
					<?php
						$term_uid = 'ilp-' . esc_attr( $term->slug );

						$active_class = '';
						if($counter == 1) {
							$active_class = 'active';
						}
					?>
					<li>
						<a class="<?php echo esc_attr($active_class); ?>" href="#<?php echo esc_attr( $term_uid ); ?>" aria-controls="<?php echo esc_attr( $term_uid ); ?>" role="tab" data-toggle="tab"><?php echo esc_html( $term->name ); ?></a>
					</li>
					<?php $counter++; ?>
				<?php endforeach; ?>

				<?php
					if( $layout == 'layout-2' ) {
						?>
						<li>
							<i class="pe-7s-angle-left owl-tg-prev nv-btn"></i>
							<i class="pe-7s-angle-right owl-tg-next nv-btn"></i>
						</li>
						<?php
					}
				?>
			</ul>
			<?php
		endif;
	}

	/** Get Ad Section **/
	public function get_ad( $ad_link, $ad_image ) {
		if( $ad_image ) :
		?>
			<?php if( $ad_link ) : ?>
				<a href="<?php echo esc_url( $ad_link ); ?>">
			<?php endif; ?>
			<div class="ad" style="background-image: url('<?php echo esc_url( $ad_image ); ?>');"></div>
			<?php if( $ad_link ) : ?>
			</a>
			<?php endif; ?>
		<?php
		endif;
	}

	/** Get Product Lists **/
	public function get_pro_list($child_terms, $no_of_products, $product_layout) {
		if( !empty( $child_terms ) ) : $counter = 1;
			?>
			<div class="cat-pro-content">
				<?php foreach( $child_terms as $term ) : ?>
					<?php
						$term_uid = 'ilp-' . esc_attr( $term->slug );
						$active_class = '';
						if($counter == 1) {
							$active_class = 'active';
						}
						$pro_query = new WP_Query( array(
							'post_type' => 'product',
							'posts_per_page' => $no_of_products,
							'tax_query' => array(
								array(
									'taxonomy' => 'product_cat',
									'field'    => 'slug',
									'terms'    => $term->slug,
								),
							),
						) );

						if( $pro_query->have_posts() ) {
							echo "<div class='cat-pro-contents owl-carousel " . $active_class . "' id='". esc_attr( $term_uid ) ."'>";
							while( $pro_query->have_posts() ) {
								$pro_query->the_post();
								wc_get_template_part( 'content', 'product-' . $product_layout );
							}
							echo "</div>";
						}
						$counter++;
					?>
				<?php endforeach; ?>
			</div>
		<?php
		endif;
	}

}