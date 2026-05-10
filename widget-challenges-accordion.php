<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Challenges Accordion Widget.
 *
 * Elementor widget that displays an accordion of challenges.
 */
class Challenges_Accordion_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'challenges_accordion_widget';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Challenges Accordion Widget', 'text-domain' );
	}

	/**
	 * Get widget icon.
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-accordion';
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

		// Content Section
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'text-domain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title', [
				'label' => esc_html__( 'Title', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Challenge Title', 'text-domain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'dot_color',
			[
				'label' => esc_html__( 'Dot Color', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#7ecf4a',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .challenge-dot' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'description', [
				'label' => esc_html__( 'Description', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Challenge description goes here.', 'text-domain' ),
			]
		);

		$this->add_control(
			'accordion_items',
			[
				'label' => esc_html__( 'Accordion Items', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => 'Variable Products',
						'description' => 'The client sold clothing in multiple sizes and colors, each with their own stock levels. Getting this to work cleanly in WooCommerce without the UI breaking or stock miscounting took careful setup and a fair amount of custom CSS work.',
						'dot_color' => '#7ecf4a',
					],
					[
						'title' => 'Payment Gateway Conflicts',
						'description' => 'The client wanted both Stripe and PayPal running at the same time. They were conflicting in the checkout and causing sessions to drop. I debugged it until both gateways worked without any friction for the customer.',
						'dot_color' => '#7ecf4a',
					],
					[
						'title' => 'Site Speed',
						'description' => 'The product image gallery was heavy and the site was slow because of it. I compressed everything, set up lazy loading, and configured caching properly. The store ended up fast enough to handle traffic spikes without slowing down.',
						'dot_color' => '#7ecf4a',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		// Style Tab - Item
		$this->start_controls_section(
			'section_style_item',
			[
				'label' => esc_html__( 'Item', 'text-domain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_item_style' );

		$this->start_control_tab(
			'tab_item_normal',
			[
				'label' => esc_html__( 'Normal', 'text-domain' ),
			]
		);

		$this->add_control(
			'item_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .challenge-card' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_border_color',
			[
				'label' => esc_html__( 'Border Color', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#d6e8c4',
				'selectors' => [
					'{{WRAPPER}} .challenge-card' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_control_tab();

		$this->start_control_tab(
			'tab_item_active',
			[
				'label' => esc_html__( 'Active', 'text-domain' ),
			]
		);

		$this->add_control(
			'item_active_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .challenge-card.active' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_active_border_color',
			[
				'label' => esc_html__( 'Border Color', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#7ecf4a',
				'selectors' => [
					'{{WRAPPER}} .challenge-card.active' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_control_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'item_padding',
			[
				'label' => esc_html__( 'Padding', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .challenge-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'item_spacing',
			[
				'label' => esc_html__( 'Spacing Between Items', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .challenge-card:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Tab - Title
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => esc_html__( 'Title', 'text-domain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#141a0e',
				'selectors' => [
					'{{WRAPPER}} .challenge-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .challenge-title',
			]
		);

		$this->add_responsive_control(
			'title_alignment',
			[
				'label' => esc_html__( 'Alignment', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'text-domain' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'text-domain' ),
						'icon' => 'eicon-text-align-center',
					],
					'flex-end' => [
						'title' => esc_html__( 'Right', 'text-domain' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .challenge-header' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Tab - Description
		$this->start_controls_section(
			'section_style_description',
			[
				'label' => esc_html__( 'Description', 'text-domain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' => esc_html__( 'Color', 'text-domain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#5a6b47',
				'selectors' => [
					'{{WRAPPER}} .challenge-body' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .challenge-body',
			]
		);

		$this->add_responsive_control(
			'description_alignment',
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
					'{{WRAPPER}} .challenge-body' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Get default styling.
	 */
	protected function get_default_styles() {
		$id = $this->get_id();
		return "
			#challenges-accordion-$id {
				display: flex;
				flex-direction: column;
				gap: 16px;
			}
			#challenges-accordion-$id .challenge-card {
				border: 1.5px solid #d6e8c4;
				border-radius: 18px;
				padding: 26px 28px;
				transition: all 0.3s ease;
				cursor: pointer;
				overflow: hidden;
			}
			#challenges-accordion-$id .challenge-header {
				display: flex;
				align-items: center;
				gap: 10px;
			}
			#challenges-accordion-$id .challenge-dot {
				width: 8px;
				height: 8px;
				border-radius: 50%;
				flex-shrink: 0;
			}
			#challenges-accordion-$id .challenge-title {
				font-size: 0.96rem;
				font-weight: 700;
				margin: 0;
			}
			#challenges-accordion-$id .challenge-content {
				max-height: 0;
				transition: max-height 0.4s ease-out;
			}
			#challenges-accordion-$id .challenge-card.active .challenge-content {
				max-height: 1000px;
			}
			#challenges-accordion-$id .challenge-body {
				font-size: 0.88rem;
				line-height: 1.82;
				padding-top: 10px;
				margin: 0;
			}
			@media (max-width: 768px) {
				#challenges-accordion-$id .challenge-card {
					padding: 20px;
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

		if ( empty( $settings['accordion_items'] ) ) {
			return;
		}
		?>
		<style><?php echo $this->get_default_styles(); ?></style>

		<div id="challenges-accordion-<?php echo esc_attr( $id ); ?>" class="challenges-accordion">
			<?php foreach ( $settings['accordion_items'] as $index => $item ) :
				$active_class = ( $index === 0 ) ? 'active' : '';

				$repeater_setting_key_title = $this->get_repeater_setting_key( 'title', 'accordion_items', $index );
				$repeater_setting_key_description = $this->get_repeater_setting_key( 'description', 'accordion_items', $index );

				$this->add_inline_editing_attributes( $repeater_setting_key_title, 'none' );
				$this->add_inline_editing_attributes( $repeater_setting_key_description, 'none' );
				?>
				<div class="challenge-card elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?> <?php echo esc_attr( $active_class ); ?>">
					<div class="challenge-header">
						<span class="challenge-dot"></span>
						<h3 class="challenge-title" <?php echo $this->get_render_attribute_string( $repeater_setting_key_title ); ?>>
							<?php echo esc_html( $item['title'] ); ?>
						</h3>
					</div>
					<div class="challenge-content">
						<p class="challenge-body" <?php echo $this->get_render_attribute_string( $repeater_setting_key_description ); ?>>
							<?php echo esc_html( $item['description'] ); ?>
						</p>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<script>
		(function() {
			const accordion = document.getElementById('challenges-accordion-<?php echo esc_attr( $id ); ?>');
			if (!accordion) return;

			const cards = accordion.querySelectorAll('.challenge-card');
			cards.forEach(card => {
				card.addEventListener('click', function() {
					// Toggle active class on the clicked card
					const isActive = this.classList.contains('active');

					// Optional: Close other cards (Accordion behavior)
					// cards.forEach(c => c.classList.remove('active'));

					if (isActive) {
						this.classList.remove('active');
					} else {
						this.classList.add('active');
					}
				});
			});
		})();
		</script>
		<?php
	}

	/**
	 * Render widget output in the editor.
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<# if ( settings.accordion_items.length ) {
			var id = view.getID();
		#>
		<style>
			#challenges-accordion-{{ id }} {
				display: flex;
				flex-direction: column;
				gap: 16px;
			}
			#challenges-accordion-{{ id }} .challenge-card {
				border: 1.5px solid #d6e8c4;
				border-radius: 18px;
				padding: 26px 28px;
				transition: all 0.3s ease;
				cursor: pointer;
				overflow: hidden;
			}
			#challenges-accordion-{{ id }} .challenge-header {
				display: flex;
				align-items: center;
				gap: 10px;
			}
			#challenges-accordion-{{ id }} .challenge-dot {
				width: 8px;
				height: 8px;
				border-radius: 50%;
				flex-shrink: 0;
			}
			#challenges-accordion-{{ id }} .challenge-title {
				font-size: 0.96rem;
				font-weight: 700;
				margin: 0;
			}
			#challenges-accordion-{{ id }} .challenge-content {
				max-height: 0;
				transition: max-height 0.4s ease-out;
			}
			#challenges-accordion-{{ id }} .challenge-card.active .challenge-content {
				max-height: 1000px;
			}
			#challenges-accordion-{{ id }} .challenge-body {
				font-size: 0.88rem;
				line-height: 1.82;
				padding-top: 10px;
				margin: 0;
			}
			@media (max-width: 768px) {
				#challenges-accordion-{{ id }} .challenge-card {
					padding: 20px;
				}
			}
		</style>

		<div id="challenges-accordion-{{ id }}" class="challenges-accordion">
			<# _.each( settings.accordion_items, function( item, index ) {
				var activeClass = ( index === 0 ) ? 'active' : '';
				var repeater_setting_key_title = view.getRepeaterSettingKey( 'title', 'accordion_items', index );
				var repeater_setting_key_description = view.getRepeaterSettingKey( 'description', 'accordion_items', index );

				view.addInlineEditingAttributes( repeater_setting_key_title, 'none' );
				view.addInlineEditingAttributes( repeater_setting_key_description, 'none' );
			#>
				<div class="challenge-card elementor-repeater-item-{{ item._id }} {{ activeClass }}" data-id="{{ index }}">
					<div class="challenge-header">
						<span class="challenge-dot"></span>
						<h3 class="challenge-title" {{{ view.getRenderAttributeString( repeater_setting_key_title ) }}}>
							{{{ item.title }}}
						</h3>
					</div>
					<div class="challenge-content">
						<p class="challenge-body" {{{ view.getRenderAttributeString( repeater_setting_key_description ) }}}>
							{{{ item.description }}}
						</p>
					</div>
				</div>
			<# } ); #>
		</div>

		<script>
		(function() {
			// In the editor, we need to re-run the script when the widget is rendered
			const accordion = document.getElementById('challenges-accordion-{{ id }}');
			if (!accordion) return;

			const cards = accordion.querySelectorAll('.challenge-card');
			cards.forEach(card => {
				card.addEventListener('click', function() {
					this.classList.toggle('active');
				});
			});
		})();
		</script>
		<# } #>
		<?php
	}
}
