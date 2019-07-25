<?php
class Illen_Category_Tabs_Grid extends \Elementor\Widget_Base {

	public function get_name() {
        return 'category-tabs-grid';
    }

	public function get_title() {
        return esc_html__( 'Category Tabs Grid', 'illen' );
    }

	public function get_icon() {
        return 'fa fa-code';
    }

	public function get_categories() {
        return [ 'illen-woo-elements' ];
    }

    public function get_script_depends() {
		return [ 'jquery' ];
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
				'title',
				[
					'label' => __( 'Title', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'SHOP BY CATEGORIES', 'illen-companion' ),
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
					'selector' => '{{WRAPPER}} .title-link-wrap .title',
				]
			);

			$this->add_control(
				'view_all_text',
				[
					'label' => __( 'View All Text', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'VIEW ALL CATEGORIES', 'illen-companion' ),
				]
			);

			$this->add_control(
				'view_all_link',
				[
					'label' => __( 'View All Link', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::URL,
					'placeholder' => __( 'https://your-link.com', 'illen-companion' ),
					'show_external' => true,
					'default' => [
						'url' => '',
						'is_external' => true,
						'nofollow' => true,
					],
				]
			);

			$this->add_control(
				'categories',
				[
					'label' => __( 'Categories', 'illen-companion' ),
					'type' => \Elementor\Controls_Manager::SELECT2,
					'multiple' => true,
					'options' => $woo_categories,
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
							'step' => 1,
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
					],
				]
			);

		$this->end_controls_section();

    }

    /** Render Layout **/
	protected function render() {
		$settings = $this->get_settings_for_display();

		$title_tag = isset( $settings['title_tag'] ) ? $settings['title_tag'] : 'span';
		?>
		<div id="illen-category-tabs-<?php echo esc_attr( $this->get_id() ); ?>" class="illen-category-tabs">
			<div class="title-link-wrap">
				<?php if( $settings['title'] ) : ?>
					<?php echo '<' . esc_attr( $title_tag ) . ' class="title">'; ?>
						<?php echo esc_html( $settings['title'] ); ?>
					<?php echo '</' . esc_attr( $title_tag ) . '>'; ?>
				<?php endif; ?>

				<?php if( $settings['view_all_text'] && $settings['view_all_link']['url'] ) : ?>
					<a data-toggle="ctab" href="<?php echo esc_url( $settings['view_all_link']['url'] ); ?>" class="view-all-btn">
						<?php echo esc_html( $settings['view_all_text'] ); ?>
					</a>
				<?php endif; ?>
			</div>

			<?php if( !empty( $settings['categories'] ) ) : ?>
				<?php
					$terms = get_terms( array(
						'slug' => $settings['categories'],
						'taxonomy' => 'product_cat',
					) );
					$counter = 1; $active_class = '';
				?>
				<div class="cat-tab-pro-wrap">
					<div class="cat-list-wrap">
						<ul class="cat-list">
							<?php foreach( $terms as $term ) : ?>
								<?php
									$utid = '#utid-' . $term->slug;
									$active_class = ( $counter == 1 ) ? 'active' : '';
								?>
								<li>
									<a class="<?php echo esc_attr( $active_class ); ?>" data-toggle="ctab" href="<?php echo esc_attr( $utid ); ?>"><?php echo esc_html( $term->name ); ?></a>
								</li>
								<?php $counter++; ?>
							<?php endforeach; $counter = 1; ?>
						</ul>
					</div>
					<div class="products-container <?php echo esc_attr( 'column-' . $settings['column']['size'] ); ?>">
						<?php foreach( $terms as $term ) : ?>
							<?php
								$utid = 'utid-' . $term->slug;
								$active_class = ( $counter == 1 ) ? 'active' : '';
							?>
							<div id="<?php echo esc_attr( $utid ); ?>" class="cat-all-products <?php echo esc_attr( $active_class ); ?>">
								<?php
									$pro_query = new WP_Query( array(
										'post_type' => 'product',
										'posts_per_page' => $settings['no_of_products']['size'],
										'tax_query' => array(
											array(
												'taxonomy' => 'product_cat',
												'field'    => 'slug',
												'terms'    => $term->slug,
											),
										),
									) );

									if( $pro_query->have_posts() ) {
										while( $pro_query->have_posts() ) {
											$pro_query->the_post();
											wc_get_template_part( 'content', 'product-grid' );
										}
									}
								?>
							</div>
							<?php $counter++; ?>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
		<?php
		$this->render_scripts( $settings );		
	}

	public function render_scripts( $settings ) {
		$uid = 'illen-category-tabs-' . $this->get_id();
		?>
			<script>
				jQuery(document).ready(function ($) {
					var ctab_wrap = $('#<?php echo esc_attr( $uid ); ?>');

					ctab_wrap.find('a[data-toggle="ctab"]').on( 'click', function(e) {
						e.preventDefault();
						var wuid = $(this).attr('href');

						$(this).parents('.cat-tab-pro-wrap').find('a[data-toggle="ctab"]').removeClass('active');
						$(this).addClass('active');

						$(this).parents('.cat-tab-pro-wrap').find('.cat-all-products').removeClass('active');
						$(this).parents('.cat-tab-pro-wrap').find(wuid).addClass('active');
					} );
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
	public function get_pro_list($child_terms, $no_of_products) {
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
								wc_get_template_part( 'content', 'product' );
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