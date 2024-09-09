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
class Anber_post_carousel extends Widget_Base {

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
        return 'Anber_post_carousel';
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
        return __('Anber post Carousel', 'anber-ea');
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
        return 'eicon-posts-carousel';
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
        return ['anber-carousel-script'];
    }

    public function get_style_depends() {
        return ['adon-comon-style', 'anber-carousel-style', 'anber-carousel'];
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
                    'label' => __('Post Carousel Controler', 'anber-ea'),
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
        $this->add_responsive_control(
                'post_carousel_item',
                [
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'label' => esc_html__('Item Number', 'anber-ea'),
                    'size_units' => [], // Optional, can leave empty
                    'range' => [
                        'px' => [// Using 'px' as an example; adjust according to your needs
                            'min' => 1,
                            'max' => 10,
                            'step' => 1,
                        ],
                    ],
                    'devices' => ['desktop', 'tablet', 'mobile'], // Ensures values for all devices
                    'desktop_default' => [
                        'size' => 3, // Default for desktop
                    ],
                    'tablet_default' => [
                        'size' => 2, // Default for tablet
                    ],
                    'mobile_default' => [
                        'size' => 1, // Default for mobile
                    ],
                ]
        );

        $this->add_control(
                'post_meta_option',
                [
                    'label' => esc_html__('Post Meta Options', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );
        $this->add_control(
                'show_title',
                [
                    'label' => esc_html__('Show Title', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'anber-ea'),
                    'label_off' => esc_html__('Hide', 'anber-ea'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );
        $this->add_control(
                'show_catname',
                [
                    'label' => esc_html__('Show Category', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'anber-ea'),
                    'label_off' => esc_html__('Hide', 'anber-ea'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );
        $this->add_control(
                'show_thumbline',
                [
                    'label' => esc_html__('Show Thumbnail', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'anber-ea'),
                    'label_off' => esc_html__('Hide', 'anber-ea'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );
        $this->add_control(
                'show_content',
                [
                    'label' => esc_html__('Show Content', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'anber-ea'),
                    'label_off' => esc_html__('Hide', 'anber-ea'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );
        $this->add_control(
                'show_postdate',
                [
                    'label' => esc_html__('Show Date', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'anber-ea'),
                    'label_off' => esc_html__('Hide', 'anber-ea'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );
        $this->add_control(
                'show_aurthor',
                [
                    'label' => esc_html__('Show Aurthor', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'anber-ea'),
                    'label_off' => esc_html__('Hide', 'anber-ea'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );
        $this->add_control(
                'show_rdm',
                [
                    'label' => esc_html__('Show Read More', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SWITCHER,
                    'label_on' => esc_html__('Show', 'anber-ea'),
                    'label_off' => esc_html__('Hide', 'anber-ea'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
        );

        $this->add_control(
                'navigation_options',
                [
                    'label' => esc_html__('Navigation Options', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
        );
        $this->add_control(
                'post_carousel_control',
                [
                    'label' => esc_html__('Button Style', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'default' => 'both',
                    'options' => [
                        'both' => esc_html__('Default', 'anber-ea'),
                        'nav' => esc_html__('Nave', 'anber-ea'),
                        'dots' => esc_html__('Dots', 'anber-ea'),
                    ],
                ]
        );
        $this->add_control(
                'post_previous_icon',
                [
                    'label' => esc_html__('Next Icon', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-angle-left',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'post_carousel_control' => ['both', 'nav']
                    ],
                ]
        );
        $this->add_control(
                'post_next_icon',
                [
                    'label' => esc_html__('Previous Icon', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-chevron-right',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'post_carousel_control' => ['both', 'nav']
                    ],
                ]
        );
        $this->add_control(
                'post_icon_color',
                [
                    'label' => esc_html__('Icon Color', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .owl-nav svg' => 'fill: {{VALUE}}',
                        '{{WRAPPER}} .owl-nav svg path' => 'fill: {{VALUE}}',
                    ],
                    'condition' => [
                        'post_carousel_control' => ['both', 'nav']
                    ],
                ]
        );
        $this->add_control(
                'icon_width',
                [
                    'label' => esc_html__('Width', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 10,
                            'max' => 100,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 30,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-nav svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'post_carousel_control' => ['both', 'nav']
                    ],
                ]
        );
        $this->add_control(
                'icon_position',
                [
                    'label' => esc_html__('Nav Position', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                            'step' => 100,
                        ],
                        '%' => [
                            'min' => -50,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => -50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-nav .owl-next' => 'right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .owl-nav .owl-prev' => 'left: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'post_carousel_control' => ['both', 'nav']
                    ],
                ]
        );
        $this->add_control(
                'dot_options',
                [
                    'label' => esc_html__('Dot Options', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'post_carousel_control' => ['both', 'dots']
                    ],
                ]
        );
        $this->add_control(
                'dot_width',
                [
                    'label' => esc_html__('Dot Width', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 5,
                            'max' => 100,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 5,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-dot span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                    ],
                    'condition' => [
                        'post_carousel_control' => ['both', 'dots']
                    ],
                ]
        );
        $this->add_control(
                'dot_icon_color',
                [
                    'label' => esc_html__('Dot Color', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .owl-dot span' => 'background: {{VALUE}}',
                    ],
                    'condition' => [
                        'post_carousel_control' => ['both', 'dots']
                    ],
                ]
        );
        $this->add_control(
                'dot_active_color',
                [
                    'label' => esc_html__('Dot Active Color', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .owl-dot.active span' => 'background: {{VALUE}} !important',
                    ],
                    'condition' => [
                        'post_carousel_control' => ['both', 'dots']
                    ],
                ]
        );
        $this->add_control(
                'dot_position',
                [
                    'label' => esc_html__('Dot Position', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => -100,
                            'max' => 100,
                            'step' => 100,
                        ],
                        '%' => [
                            'min' => -50,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => -50,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .owl-dots' => 'top: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'post_carousel_control' => ['both', 'dots']
                    ],
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                'item_wrapper',
                [
                    'label' => esc_html__('Item Wrapper Style', 'anber-ea'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
                            'min' => 5,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 5,
                    ],
                ]
        );

        $this->add_control(
                'content_alignment',
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
                        '{{WRAPPER}} .media' => 'text-align: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background',
                    'types' => ['classic', 'gradient', 'video'],
                    'selector' => '{{WRAPPER}} .post-item',
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow',
                    'selector' => '{{WRAPPER}} .post-item',
                ]
        );
        $this->add_responsive_control(
                'item_wrapper_padding',
                [
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'label' => esc_html__('Padding', 'anber-ea'),
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .post-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                'item_wrapper_border',
                [
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'label' => esc_html__('Radius Border', 'anber-ea'),
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .post-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
                'post_title_style',
                [
                    'label' => esc_html__('Title Style', 'anber-ea'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                'post_title_control_color',
                [
                    'label' => esc_html__('Title Color', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .blgtitle' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .apps-blog-post-box-meta-114 svg path' => 'stroke: {{VALUE}}',
                    ],
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'title_control_typo',
                    'label' => esc_html__('Title Typography', 'anber-ea'),
                    'selector' => '{{WRAPPER}} .blgtitle',
                ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
                'post_content_style',
                [
                    'label' => esc_html__('Content Style', 'anber-ea'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                'post_content_control_color',
                [
                    'label' => esc_html__('Color', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .blg-content' => 'color: {{VALUE}}',
                        '{{WRAPPER}} .apps-blog-post-box-meta-114' => 'color: {{VALUE}}',
                        
                        
                    ],
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'post_content_typo',
                    'label' => esc_html__('Title Typography', 'anber-ea'),
                    'selector' => '{{WRAPPER}} .blg-content',
                    
                ]
        );

        $this->add_control(
                'post_content_img_dimension',
                [
                    'label' => esc_html__('Image Dimension', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
                    'description' => esc_html__('Ste Custome Width and Height for Post thumbline.', 'anber-ea'),
                    'default' => [
                        'width' => '',
                        'height' => '',
                    ],
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
                    'selector' => '{{WRAPPER}} .post_link',
                ]
        );
        // Start Tabs
        $this->start_controls_tabs('style_tabs');

        // Normal Tab
        $this->start_controls_tab(
                'normal_tab',
                [
                    'label' => __('Normal', 'anber-ea'),
                ]
        );

        $this->add_control(
                'normal_text_color',
                [
                    'label' => __('Text Color', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .post_link' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .post_link svg' => 'fill: {{VALUE}};',
                        '{{WRAPPER}} .post_link svg path' => 'fill: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'normal_background',
                    'label' => __('Background', 'anber-ea'),
                    'types' => ['classic', 'gradient', 'video'],
                    'selector' => '{{WRAPPER}} .post_link',
                    'exclude' => ['image'],
                    'fields_options' => [
                        'background' => [
                            'default' => 'classic',
                        ],
                        'color' => [
                            'default' => '#fff',
                        ],
                    ],
                ]
        );

        $this->end_controls_tab(); // End Normal Tab
        // Hover Tab
        $this->start_controls_tab(
                'hover_tab',
                [
                    'label' => __('Hover', 'anber-ea'),
                ]
        );

        $this->add_control(
                'hover_text_color',
                [
                    'label' => __('Text Color', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .post_link:hover' => 'color: {{VALUE}};',
                        '{{WRAPPER}} .post_link:hover svg' => 'fill: {{VALUE}};',
                        '{{WRAPPER}} .post_link:hover svg path' => 'fill: {{VALUE}};',
                    ],
                ]
        );

        $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'hover_background',
                    'label' => __('Background'),
                    'types' => ['classic', 'gradient'],
                    'selector' => '{{WRAPPER}} .post_link:hover',
                ]
        );

        $this->end_controls_tab(); // End Hover Tab
        $this->end_controls_tabs(); // Close Tabs
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
                        '{{WRAPPER}} .postbtn-wrwp' => 'justify-content: {{VALUE}};',
                    ],
                ]
        );
        $this->add_control(
                'post_button_icon',
                [
                    'label' => esc_html__('Button Icon', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-angle-right',
                        'library' => 'fa-solid',
                    ],
                ]
        );
        $this->add_control(
                'post_button_icon_width',
                [
                    'label' => esc_html__('Button Icon Width', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 15,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} span.iconsvg svg' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_control(
                'post_button_icon_width_gap',
                [
                    'label' => esc_html__('Button Icon Gap', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} a.post_link' => 'gap: {{SIZE}}{{UNIT}};',
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
                        'right' => 30,
                        'bottom' => 10,
                        'left' => 30,
                        'unit' => 'px',
                        'isLinked' => false,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .post_link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                'button_margin',
                [
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'label' => esc_html__('Margin', 'anber-ea'),
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'default' => [
                        'top' => 10,
                        'right' => 0,
                        'bottom' => 10,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => false,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .post_link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        '{{WRAPPER}} .post_link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

Plugin::instance()->widgets_manager->register(new Anber_post_carousel());
