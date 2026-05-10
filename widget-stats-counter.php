<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Stats Counter Widget.
 *
 * Elementor widget that displays a grid of statistics.
 */
class Stats_Counter_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'stats_counter_widget';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Stats Counter Widget', 'text-domain' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-counter';
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Register widget controls.
	 *
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'text-domain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'number', [
				'label' => esc_html__( 'Number', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '12', 'text-domain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'suffix', [
				'label' => esc_html__( 'Suffix', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'd', 'text-domain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'label', [
				'label' => esc_html__( 'Label', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Description', 'text-domain' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'stats_list',
			[
				'label' => esc_html__( 'Stat Items', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'number' => '12',
						'suffix' => 'd',
						'label' => 'Store launched in 12 days',
					],
					[
						'number' => '200',
						'suffix' => '+',
						'label' => 'Orders in the first month',
					],
					[
						'number' => '1.8',
						'suffix' => 's',
						'label' => 'Page load time, down from 6.2s',
					],
				],
				'title_field' => '{{{ number }}}{{{ suffix }}}',
			]
		);

		$this->end_controls_section();

		// Style Tab - Container
		$this->start_controls_section(
			'section_style_container',
			[
				'label' => esc_html__( 'Container', 'text-domain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__( 'Background Color', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stats-grid' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Tab - Number
		$this->start_controls_section(
			'section_style_number',
			[
				'label' => esc_html__( 'Number', 'text-domain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'number_color',
			[
				'label' => esc_html__( 'Color', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stat-num' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'suffix_color',
			[
				'label' => esc_html__( 'Suffix Color', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stat-num span.stat-suffix' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'number_typography',
				'selector' => '{{WRAPPER}} .stat-num',
			]
		);

		$this->add_responsive_control(
			'number_alignment',
			[
				'label' => esc_html__( 'Alignment', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'text-domain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'text-domain' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'text-domain' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .stat-num' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Tab - Label
		$this->start_controls_section(
			'section_style_label',
			[
				'label' => esc_html__( 'Label', 'text-domain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'label_color',
			[
				'label' => esc_html__( 'Color', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .stat-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'label_typography',
				'selector' => '{{WRAPPER}} .stat-label',
			]
		);

		$this->add_responsive_control(
			'label_alignment',
			[
				'label' => esc_html__( 'Alignment', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'text-domain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'text-domain' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'text-domain' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .stat-label' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Get basic default styling.
	 */
	protected function get_default_styles() {
		$id = $this->get_id();
		return "
			#stats-grid-$id {
				display: flex;
				flex-wrap: wrap;
				gap: 20px;
				justify-content: center;
				padding: 30px;
				border-radius: 18px;
				transition: all 0.3s ease;
			}
			#stats-grid-$id .stat-item {
				flex: 1;
				min-width: 200px;
				text-align: center;
				padding: 10px;
			}
			#stats-grid-$id .stat-num {
				font-family: 'Fraunces', serif;
				font-size: 2.5rem;
				font-weight: 700;
				line-height: 1.1;
				color: #141a0e;
				margin-bottom: 8px;
			}
			#stats-grid-$id .stat-num .stat-suffix {
				color: #7ecf4a;
			}
			#stats-grid-$id .stat-label {
				font-family: 'Plus Jakarta Sans', sans-serif;
				font-size: 0.9rem;
				font-weight: 600;
				color: #8a9b76;
				line-height: 1.5;
			}
			@media (max-width: 768px) {
				#stats-grid-$id {
					flex-direction: column;
					align-items: center;
				}
				#stats-grid-$id .stat-item {
					width: 100%;
					min-width: auto;
				}
			}
		";
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$id = $this->get_id();

		if ( empty( $settings['stats_list'] ) ) {
			return;
		}
		?>
		<style><?php echo $this->get_default_styles(); ?></style>

		<div id="stats-grid-<?php echo esc_attr( $id ); ?>" class="stats-grid">
			<?php foreach ( $settings['stats_list'] as $index => $item ) :
				$repeater_setting_key_number = $this->get_repeater_setting_key( 'number', 'stats_list', $index );
				$repeater_setting_key_suffix = $this->get_repeater_setting_key( 'suffix', 'stats_list', $index );
				$repeater_setting_key_label = $this->get_repeater_setting_key( 'label', 'stats_list', $index );

				$this->add_inline_editing_attributes( $repeater_setting_key_number, 'none' );
				$this->add_inline_editing_attributes( $repeater_setting_key_suffix, 'none' );
				$this->add_inline_editing_attributes( $repeater_setting_key_label, 'none' );
				?>
				<div class="stat-item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
					<div class="stat-num">
						<span <?php echo $this->get_render_attribute_string( $repeater_setting_key_number ); ?>><?php echo esc_html( $item['number'] ); ?></span><span class="stat-suffix" <?php echo $this->get_render_attribute_string( $repeater_setting_key_suffix ); ?>><?php echo esc_html( $item['suffix'] ); ?></span>
					</div>
					<div class="stat-label" <?php echo $this->get_render_attribute_string( $repeater_setting_key_label ); ?>>
						<?php echo esc_html( $item['label'] ); ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<?php
	}

	/**
	 * Render widget output in the editor.
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<# if ( settings.stats_list.length ) {
			var id = view.getID();
		#>
		<style>
			#stats-grid-{{ id }} {
				display: flex;
				flex-wrap: wrap;
				gap: 20px;
				justify-content: center;
				padding: 30px;
				border-radius: 18px;
			}
			#stats-grid-{{ id }} .stat-item {
				flex: 1;
				min-width: 200px;
				text-align: center;
				padding: 10px;
			}
			#stats-grid-{{ id }} .stat-num {
				font-family: 'Fraunces', serif;
				font-size: 2.5rem;
				font-weight: 700;
				line-height: 1.1;
				color: #141a0e;
				margin-bottom: 8px;
			}
			#stats-grid-{{ id }} .stat-num .stat-suffix {
				color: #7ecf4a;
			}
			#stats-grid-{{ id }} .stat-label {
				font-family: 'Plus Jakarta Sans', sans-serif;
				font-size: 0.9rem;
				font-weight: 600;
				color: #8a9b76;
				line-height: 1.5;
			}
			@media (max-width: 768px) {
				#stats-grid-{{ id }} {
					flex-direction: column;
					align-items: center;
				}
				#stats-grid-{{ id }} .stat-item {
					width: 100%;
					min-width: auto;
				}
			}
		</style>

		<div id="stats-grid-{{ id }}" class="stats-grid">
			<# _.each( settings.stats_list, function( item, index ) {
				var repeater_setting_key_number = view.getRepeaterSettingKey( 'number', 'stats_list', index );
				var repeater_setting_key_suffix = view.getRepeaterSettingKey( 'suffix', 'stats_list', index );
				var repeater_setting_key_label = view.getRepeaterSettingKey( 'label', 'stats_list', index );

				view.addInlineEditingAttributes( repeater_setting_key_number, 'none' );
				view.addInlineEditingAttributes( repeater_setting_key_suffix, 'none' );
				view.addInlineEditingAttributes( repeater_setting_key_label, 'none' );
			#>
				<div class="stat-item elementor-repeater-item-{{ item._id }}">
					<div class="stat-num">
						<span {{{ view.getRenderAttributeString( repeater_setting_key_number ) }}}>{{{ item.number }}}</span><span class="stat-suffix" {{{ view.getRenderAttributeString( repeater_setting_key_suffix ) }}}>{{{ item.suffix }}}</span>
					</div>
					<div class="stat-label" {{{ view.getRenderAttributeString( repeater_setting_key_label ) }}}>
						{{{ item.label }}}
					</div>
				</div>
			<# } ); #>
		</div>
		<# } #>
		<?php
	}
}
