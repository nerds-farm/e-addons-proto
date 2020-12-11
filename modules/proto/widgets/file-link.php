<?php

namespace EAddonsProto\Modules\Proto\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;
use EAddonsForElementor\Base\Base_Widget;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

/**
 * Elementor Tokens
 *
 * Elementor widget for Dinamic Content Elements
 *
 */
class File_Link extends Base_Widget {

    /**
     * Get widget name.
     *
     * Retrieve Elementor_File_Link_Widget widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'file_link';
    }

    /**
     * Get widget title.
     *
     * Retrieve Elementor_File_Link_Widget widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('File Link', 'e-addons');
    }

    /**
     * Get widget icon.
     *
     * Retrieve Elementor_File_Link_Widget widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-link';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the Elementor_File_Link_Widget widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['media'];
    }

    /**
     * Register Elementor_File_Link_Widget widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

        $this->start_controls_section(
                'settings_section',
                [
                    'label' => __('Settings', 'e-addons'),
                    'tab' => Controls_Manager::TAB_CONTENT,
                ]
        );

        $this->add_control(
                'file_link',
                [
                    'label' => __('Select File', 'e-addons'),
                    'type' => 'file',
                    'placeholder' => __('Select File', 'e-addons'),
                    'description' => __('Select file from media library or upload', 'e-addons'),
                ]
        );
        /* $this->add_control(
          'file_links',
          [
          'label' => __( 'Select File', 'e-addons' ),
          'type'	=> 'file',
          'placeholder' => __( 'Choose some Files', 'e-addons' ),
          'multiple' => true,
          'description' => __( 'Select file from media library or upload', 'e-addons' ),
          ]
          ); */

        $this->add_control(
                'link_text',
                [
                    'label' => __('Text', 'e-addons'),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __('Ex. Open File', 'e-addons'),
                    'description' => __('Text that should be displayed as a link', 'e-addons'),
                    'default' => 'Open File',
                ]
        );

        $this->add_control(
                'link_target',
                [
                    'label' => __('Target', 'e-addons'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '' => __('Default', 'e-addons'),
                        '_parent' => __('Parent', 'e-addons'),
                        '_blank' => __('Blank', 'e-addons'),
                    ],
                ]
        );

        $this->add_control(
                'link_rel',
                [
                    'label' => __('Rel', 'e-addons'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        '' => __('Default', 'e-addons'),
                        'nofollow' => __('Nofollow', 'e-addons'),
                    ],
                ]
        );

        $this->add_control(
                'link_css_class',
                [
                    'label' => __('CSS Class', 'e-addons'),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __('Ex. file-link', 'e-addons'),
                    'description' => __('CSS class to add to the link', 'e-addons'),
                ]
        );

        $this->end_controls_section();
    }

    /**
     * Render Elementor_File_Link_Widget widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

        $target = (!empty($settings['link_target'])) ? ' target="' . $settings['link_target'] . '"' : '';
        $rel = (!empty($settings['link_rel'])) ? ' rel="' . $settings['link_rel'] . '"' : '';
        $class = (!empty($settings['link_css_class'])) ? ' class="' . $settings['link_css_class'] . '"' : '';

        $link = wp_get_attachment_url($settings['file_link']);
        echo '<a href="' . $link . '"' . $target . $rel . $class . '>' . $settings['link_text'] . '</a>';
    }

}
