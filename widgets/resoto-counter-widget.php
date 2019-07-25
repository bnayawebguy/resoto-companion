<?php
class Resoto_Counter_Widget extends \Elementor\Widget_Base {
	/** Widget Name **/
	public function get_name() {
        return 'resoto-counter';
    }

    /** Widget Title **/
	public function get_title() {
        return esc_html__( 'Counter', 'resoto-companion' );
    }

    /** Widget Icon **/
	public function get_icon() {
        return 'fa fa-code';
    }

    /** Categories **/
	public function get_categories() {
        return [ 'resoto-elements' ];
    }

    /** Script Dependencies **/
    public function get_script_depends() {
		return [ 'jquery-numerator' ];
	}

	/** Widget Controls **/
	protected function _register_controls() {

        $this->start_controls_section(
			'counter_content_section',
			[
				'label' => __( 'Counter', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'counter_image',
				[
					'label' => __( 'Counter Image', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
					'default' => [
						'url' => \Elementor\Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'starting_no',
				[
					'label' => __( 'Starting Number', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 0
				]
			);

			$this->add_control(
				'ending_no',
				[
					'label' => __( 'Ending Number', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 100
				]
			);

			$this->add_control(
				'duration',
				[
					'label' => __( 'Animaion Duration', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'default' => 2000
				]
			);

			$this->add_control(
				'title',
				[
					'label' => __( 'Title', 'resoto-companion' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => __( 'Cool Number', 'resoto-companion' ),
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_style_section',
			[
				'label' => __( 'Title', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'title_color',
				[
					'label' => __( 'Title Color', 'resoto-domain' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .resoto-counter .title' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'title_typography',
					'label' => __( 'Typography', 'resoto-companion' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .resoto-counter .title',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'counter_style_section',
			[
				'label' => __( 'Counter', 'resoto-companion' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'counter_color',
				[
					'label' => __( 'Counter Color', 'resoto-domain' ),
					'type' => \Elementor\Controls_Manager::COLOR,
					'scheme' => [
						'type' => \Elementor\Scheme_Color::get_type(),
						'value' => \Elementor\Scheme_Color::COLOR_1,
					],
					'selectors' => [
						'{{WRAPPER}} .resoto-counter .counter' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Typography::get_type(),
				[
					'name' => 'counter_typography',
					'label' => __( 'Typography', 'resoto-companion' ),
					'scheme' => \Elementor\Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .resoto-counter .counter',
				]
			);

		$this->end_controls_section();

    }

    /** Render Layout **/
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$counter_start = ( isset( $settings['starting_no'] ) ) ? $settings['starting_no'] : 0;
		$counter_end = ( isset( $settings['ending_no'] ) ) ? $settings['ending_no'] : 0;
		$duration = ( isset( $settings['duration'] ) ) ? $settings['duration'] : 500;
		
		?>
		<div data-duration="<?php echo esc_attr( $duration ); ?>" data-start="<?php echo esc_attr( $counter_start ); ?>" data-end="<?php echo esc_attr( $counter_end ); ?>" id="resoto-counter-<?php echo esc_attr( $this->get_id() ); ?>" class="resoto-counter">
			<?php if( !empty( $settings['counter_image'] ) ) : ?>
				<div class="counter-icon">
					<img src="<?php echo esc_url( $settings['counter_image']['url'] ); ?>" />
				</div>
			<?php endif; ?>
			
			<div class="counter-title">
				<span class="counter"></span>
				<span class="title">
					<?php echo esc_html( $settings['title'] ); ?>
				</span>
			</div>

		</div>
		<?php
		$this->render_scripts( $settings );		
	}

	public function render_scripts( $settings ) {
		$uid = 'resoto-counter-' . $this->get_id();
		?>
			<script>
				jQuery(document).ready(function ($) {
					var counter = $('#<?php echo esc_attr( $uid ); ?>');
					var counter_start = counter.attr('data-start');
					var counter_end = counter.attr('data-end');
					var duration = counter.attr('data-duration');
					$('#<?php echo esc_attr($uid); ?> .counter').numerator( {
						easing: 'linear',
				        duration: parseInt(duration),
				        rounding: 0,
				        toValue: parseInt(counter_end),
				        fromValue: parseInt(counter_start),
					} );
				});
			</script>
		<?php
	}

	protected function _content_template() {}
}