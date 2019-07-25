<?php
class Resoto_Testimonial_Carousel_Widget extends \Elementor\Widget_Base {

	public function get_name() {
        return 'resoto-testimonial-carousel';
    }

	public function get_title() {
        return esc_html__( 'Testimonial Carousel', 'resoto-companion' );
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
			'testimonial_section',
			[
				'label' => __( 'Testimonial', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
				'image',
				[
					'label' => __( 'Choose Image', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'name', [
					'label' => __( 'Client Name', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'John Doe' , 'resoto-companion' ),
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'designation', [
					'label' => __( 'Designation', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Managing Director' , 'resoto-companion' ),
					'label_block' => true,
				]
			);

			$repeater->add_control(
				'testimony', [
					'label' => __( 'Testimony', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'default' => __( 'John Doe has to say something about the co.' , 'resoto-companion' ),
					'show_label' => false,
				]
			);

			$this->add_control(
				'testimonials',
				[
					'label' => __( 'Testimonials', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'name' => __( 'John Doe', 'resoto-companion' ),
							'designation' => __( 'Managing Director', 'resoto-companion' ),
							'testimony' => __( 'John Doe has to say something about the resort.', 'resoto-companion' ),
						],
						[
							'name' => __( 'Sarah Doe', 'resoto-companion' ),
							'designation' => __( 'Blogger', 'resoto-companion' ),
							'testimony' => __( 'Sarah has to say something about the resort.', 'resoto-companion' ),
						],						
					],
					'title_field' => '{{{ name }}}',
				]
			);			

		$this->end_controls_section();

		$this->start_controls_section(
			'testimonial_carousel_section',
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
			'testimonial_box_style',
			[
				'label' => __( 'Testimonial Box', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'testimonial_bgcolor',
				[
					'label' => __( 'Background Color', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'default' => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .resoto-testimonial-carousel .testimonial' => 'background-color: {{VALUE}}'
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'testimonial_border',
					'label' => __( 'Border', 'resoto-companion' ),
					'selector' => '{{WRAPPER}} .resoto-testimonial-carousel .testimonial',
				]
			);

			$this->add_control(
				'testimonial_padding',
				[
					'label' => __( 'Padding', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .resoto-testimonial-carousel .testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'testimonial_name_style',
			[
				'label' => __( 'Client Name', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'name_color',
				[
					'label' => __( 'Color', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .resoto-testimonial-carousel .testimonial .name' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'name_typography',
					'label' => __( 'Typography', 'resoto-companion' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .resoto-testimonial-carousel .testimonial .name',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'testimonial_testimony_style',
			[
				'label' => __( 'Testimony', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'testimony_color',
				[
					'label' => __( 'Color', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .resoto-testimonial-carousel .testimonial .testimony' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'testimony_typography',
					'label' => __( 'Typography', 'resoto-companion' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .resoto-testimonial-carousel .testimonial .testimony',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'testimonial_designation_style',
			[
				'label' => __( 'Designation', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'design_color',
				[
					'label' => __( 'Color', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .resoto-testimonial-carousel .testimonial .designation' => 'color: {{VALUE}}'
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'design_typography',
					'label' => __( 'Typography', 'resoto-companion' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .resoto-testimonial-carousel .testimonial .designation',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'testimonial_quote_style',
			[
				'label' => __( 'Quote Sign', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'quote_color',
				[
					'label' => __( 'Color', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'default' => '#ffffff',
					'selectors' => [
						'{{WRAPPER}} .resoto-testimonial-carousel .lni-quotation' => 'color: {{VALUE}}'
					],
				]
			);

			$this->add_control(
				'quote_bgcolor',
				[
					'label' => __( 'Color', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'default' => '#ec6a2a',
					'selectors' => [
						'{{WRAPPER}} .resoto-testimonial-carousel .lni-quotation' => 'background-color: {{VALUE}}'
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(),
				[
					'name' => 'quote_border',
					'label' => __( 'Border', 'resoto-companion' ),
					'selector' => '{{WRAPPER}} .resoto-testimonial-carousel .lni-quotation',
				]
			);

		$this->end_controls_section();
    }

    /** Render Layout **/
	protected function render() {
		$settings = $this->get_settings_for_display();

		$testimonials = $settings['testimonials'];
		
		if( !empty( $testimonials ) ) :
		?>
			<div class="resoto-testimonial-carousel owl-carousel" id="resoto-testimonial-carousel-<?php echo esc_attr( $this->get_id() ); ?>">

				<?php foreach( $testimonials as $testimonial ) : ?>
					<div class="testimonial">
						<?php if( $testimonial['image'] ) : ?>
							<?php
								$img = wp_get_attachment_image_src( $testimonial['image']['id'], 'resoto-testimonial-carousel' );
								$img_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
							?>
							<div class="image">
								<img src="<?php echo esc_url( $img[0] ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>" />	
							</div>
						<?php endif; ?>
						
						<?php if( $testimonial['testimony'] ) : ?>
							<div class="testimony">
								<?php echo esc_html( $testimonial['testimony'] ); ?>
							</div>
						<?php endif; ?>

						<div class="name-design">
							<?php if( $testimonial['name'] ) : ?>
								<h4 class="name"><?php echo esc_html( $testimonial['name'] ); ?></h4>
							<?php endif; ?>

							<?php if( $testimonial['designation'] ) : ?>
								<span class="designation"><?php echo esc_html( $testimonial['designation'] ); ?></span>
							<?php endif; ?>
						</div>

						<span class="lni-quotation"></span>
					</div>

				<?php endforeach; ?>
				
			</div>
		<?php
		endif;


		$this->render_scripts( $settings );
		
	}

	/** Render Element Javascript **/
	public function render_scripts( $settings ) {
		$uid = 'resoto-testimonial-carousel-' . esc_attr($this->get_id());

		$loop = ( $settings['loop'] ) ? 'true' : 'false';
		$margin = ( isset( $settings['margin'] ) ) ? $settings['margin'] : 0;
		$autoplay = ( $settings['autoplay'] ) ? 'true' : 'false';
		$pause_on_hover = ( $settings['pause_on_hover'] ) ? 'true' : 'false';
		?>
		<script type="text/javascript">
			jQuery(document).ready( function($) {
				$('#<?php echo esc_attr( $uid ); ?>').owlCarousel({
					items: 3,
					margin: <?php echo esc_attr( $margin ); ?>,
					loop: <?php echo esc_attr($loop); ?>,
					autoplay: <?php echo esc_attr($autoplay); ?>,
					autoplayHoverPause: <?php echo esc_attr($pause_on_hover); ?>,
				});
			});
		</script>
		<?php
	}

	protected function _content_template() {}
}