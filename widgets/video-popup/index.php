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
class Vpopup extends Widget_Base {

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
        return 'vpopup';
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
        return __('Video Popup', 'anber-ea');
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
        return 'eicon-video-playlist';
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
        return ['anber-magnific-popup'];
    }

    public function get_style_depends() {
        return ['anber-magnific-popup'];
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
                    'label' => __('Layout', 'anber-ea'),
                ]
        );
        $this->add_control(
                'poster_image',
                [
                    'label' => __('Poster Image', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
        );
        $this->add_control(
                'video_url',
                [
                    'label' => esc_html__('Video URL', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                ]
        );
        $this->add_control(
                'video_title',
                [
                    'label' => esc_html__('Video Title Text', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'label_block' => true,
                ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
                '_button_style',
                [
                    'label' => esc_html__('Button Style', 'anber-ea'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                '_button_control_alignment',
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
                    'default' => 'left',
                    'toggle' => true,
                    'selectors' => [
                        '{{WRAPPER}} .vpop' => 'text-align: {{VALUE}};',
                    ],
                ]
        );
        $this->add_responsive_control(
                '_button_control_margin',
                [
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'label' => esc_html__('Margin', 'anber-ea'),
                    'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                    'selectors' => [
                        '{{WRAPPER}} .vpop_img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
                '_title_style',
                [
                    'label' => esc_html__('Title Style', 'anber-ea'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
        );
        $this->add_control(
                '_title_control_color',
                [
                    'label' => esc_html__('Title Color', 'anber-ea'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .video-title' => 'color: {{VALUE}}',
                    ],
                ]
        );
        $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => '_subtitle_control_typo',
                    'label' => esc_html__('Title Typography', 'anber-ea'),
                    'selector' => '{{WRAPPER}} .video-title',
                ]
        );
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

        include dirname(__FILE__) . '/popupbox.php';
    }
}

Plugin::instance()->widgets_manager->register(new Vpopup());
