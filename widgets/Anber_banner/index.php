<?php

namespace Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use ELementor\Repeater;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Anber Ea Demo
 *
 * Anber Ea widget for Demo.
 *
 * @since 1.0.0
 */
class Anber_banner extends Widget_Base {

    /**
     * Retrieve the widget name.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'anber-ea-banner';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Banner Design', 'anber-ea');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-banner';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['anbar-category'];
    }

    /**
     * Retrieve the list of scripts the widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.0.0
     *
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends() {
        return ['anber-ea'];
    }

    public function get_style_depends() {
        return ['adon-comon-style'];
    }

    /**
     * Register the widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
                'section_select_layout',
                [
                    'label' => __('Banner Layout', 'anber-ea'),
                ]
        );

        $this->add_control(
                'layout',
                [
                    'label' => __('Select Layout', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                        'layout-1' => __('Layout 1', 'anber-ea'),
                    ],
                    'default' => 'layout-1',
                    'toggle' => true,
                ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
                '_section_banner_content',
                [
                    'label' => __('Banner Content', 'anber-ea'),
                ]
        );
        $this->add_control(
                'banner_image',
                [
                    'label' => __('Banner BG Image', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
        );

        $this->add_control(
                'banner_title',
                [
                    'label' => esc_html__('Banner Title', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                ]
        );

        $this->add_control(
                'banner_content',
                [
                    'label' => esc_html__('Banner Content', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                    'label_block' => true,
                ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
                'button_title',
                [
                    'label' => esc_html__('Button Text', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'default' => esc_html__('Contact', 'anber-ea'),
                    'label_block' => true,
                ]
        );

        $repeater->add_control(
                'button_link',
                [
                    'label' => esc_html__('Link', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::URL,
                    'options' => ['url', 'is_external', 'nofollow'],
                    'default' => [
                        'url' => '',
                        'is_external' => true,
                        'nofollow' => true,
                    ],
                    'label_block' => true,
                ]
        );

        $repeater->add_control(
                'icon',
                [
                    'label' => esc_html__('Icon', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-chevron-right',
                        'library' => 'fa-solid',
                    ],
                ]
        );

        $repeater->add_responsive_control(
                'icon_width',
                [
                    'label' => esc_html__('Icon Width', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .my-icon-wrapper i' => 'width: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} {{CURRENT_ITEM}} .my-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}};', // For SVG icons
                    ],
                ]
        );

        $repeater->add_control(
                'icon_color',
                [
                    'label' => esc_html__('Icon Color', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}} .my-icon-wrapper i' => 'color: {{VALUE}};',
                        '{{WRAPPER}} {{CURRENT_ITEM}} .my-icon-wrapper svg' => 'fill: {{VALUE}};',
                    ],
                ]
        );

        $repeater->add_control(
                'icon_gap',
                [
                    'label' => esc_html__('Icon Gap', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 5,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 10,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .banner_cta_button' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        // Start Tabs
        $repeater->start_controls_tabs('style_tabs');

        // Normal Tab
        $repeater->start_controls_tab(
                'normal_tab',
                [
                    'label' => __('Normal', 'anber-ea'),
                ]
        );

        $repeater->add_control(
                'normal_text_color',
                [
                    'label' => __('Text Color', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $repeater->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'normal_background',
                    'label' => __('Background', 'anber-ea'),
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
                ]
        );

        $repeater->end_controls_tab(); // End Normal Tab
        // Hover Tab
        $repeater->start_controls_tab(
                'hover_tab',
                [
                    'label' => __('Hover', 'anber-ea'),
                ]
        );

        $repeater->add_control(
                'hover_text_color',
                [
                    'label' => __('Text Color', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
                    ],
                ]
        );

        $repeater->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'hover_background',
                    'label' => __('Background'),
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}:hover',
                ]
        );

        $repeater->end_controls_tab(); // End Hover Tab
        $repeater->end_controls_tabs(); // Close Tabs

        $this->add_control(
                'button_list',
                [
                    'label' => esc_html__('Buttons', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => [
                        [
                            'button_title' => esc_html__('Button #1', 'anber-ea'),
                            'button_link' => [
                                'url' => '#',
                                'is_external' => false,
                                'nofollow' => false,
                            ],
                        ],
                        [
                            'button_title' => esc_html__('Button #2', 'anber-ea'),
                            'button_link' => [
                                'url' => '#',
                                'is_external' => false,
                                'nofollow' => false,
                            ],
                        ],
                    ],
                    'title_field' => '{{{ button_title }}}',
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'banner_style',
                [
                    'label' => esc_html__('General Style', 'anber-ea'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                'banner_width',
                [
                    'label' => esc_html__('Wrapper Width', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => '%',
                        'size' => 50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .banner_title_wrap' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_control(
                'banner_alignment',
                [
                    'label' => esc_html__('Alignment', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => esc_html__('Left', 'anber-ea'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'anber-ea'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => esc_html__('Right', 'anber-ea'),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .banner_title_wrap' => 'text-align: {{VALUE}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                'banner_control_margin',
                [
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'label' => esc_html__('Padding', 'anber-ea'),
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .inner_page_banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_control(
                'item_gap',
                [
                    'label' => esc_html__('Item Gap', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 10,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .banner_title_wrap' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );

        $this->add_control(
                'overlayer_switcher',
                [
                    'label' => esc_html__('Show Overlay', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'textdomain'),
                    'label_off' => esc_html__('Hide', 'textdomain'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );
        $this->add_control(
                'overlayer_color',
                [
                    'label' => esc_html__('Overlay Color', 'textdomain'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .overlayer' => 'background: {{VALUE}}',
                    ],
                ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
                'banner_title_style',
                [
                    'label' => esc_html__('Title Style', 'anber-ea'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                'banner_title_control_color',
                [
                    'label' => esc_html__('Title Color', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .banner_title' => 'color: {{VALUE}}',
                    ],
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => '_subtitle_control_typo',
                    'label' => esc_html__('Title Typography', 'anber-ea'),
                    'selector' => '{{WRAPPER}} .banner_title',
                ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
                'banner_content_style',
                [
                    'label' => esc_html__('Content Style', 'anber-ea'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                'banner_content_control_color',
                [
                    'label' => esc_html__('Color', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .banner_content' => 'color: {{VALUE}}',
                    ],
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_control_typo',
                    'label' => esc_html__('Title Typography', 'anber-ea'),
                    'selector' => '{{WRAPPER}} .banner_content',
                ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
                'button_content_style',
                [
                    'label' => esc_html__('Button Style', 'anber-ea'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'button_control_typo',
                    'label' => esc_html__('Button Typography', 'anber-ea'),
                    'selector' => '{{WRAPPER}} .banner_cta_button',
                ]
        );
        $this->add_control(
                'button_wrwpper_align',
                [
                    'label' => esc_html__('Alignment', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'flex-start' => [
                            'title' => esc_html__('Left', 'anber-ea'),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => esc_html__('Center', 'anber-ea'),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'end' => [
                            'title' => esc_html__('Right', 'anber-ea'),
                            'icon' => 'eicon-text-align-right',
                        ],
                    ],
                    'default' => 'center',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .button_wrapper' => 'justify-content: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'button_control_alignment',
                [
                    'label' => esc_html__('Button Direction', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::CHOOSE,
                    'options' => [
                        'row' => [
                            'title' => esc_html__('Row', 'anber-ea'),
                            'icon' => 'eicon-arrow-down',
                        ],
                        'column' => [
                            'title' => esc_html__('Column', 'anber-ea'),
                            'icon' => 'eicon-arrow-right',
                        ],
                    ],
                    'default' => 'column',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .button_wrapper' => 'flex-direction: {{VALUE}};',
                    ],
                ]
        );

        $this->add_control(
                'button_gap',
                [
                    'label' => esc_html__('Button Gap', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 10,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .button_wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                'button_control_padding',
                [
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'label' => esc_html__('Padding', 'anber-ea'),
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'default' => [
                        'top' => 10,
                        'right' => 10,
                        'bottom' => 10,
                        'left' => 10,
                        'unit' => 'px',
                        'isLinked' => false,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .banner_cta_button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_control(
                'button_border_radius',
                [
                    'label' => esc_html__('Border Radius', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'default' => [
                        'top' => 5,
                        'right' => 5,
                        'bottom' => 5,
                        'left' => 5,
                        'unit' => 'px',
                        'isLinked' => false,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .banner_cta_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->end_controls_section();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings();
        ?>

        <?php

        include dirname(__FILE__) . '/layout-1.php';
    }
}

Plugin::instance()->widgets_manager->register(new Anber_banner());
