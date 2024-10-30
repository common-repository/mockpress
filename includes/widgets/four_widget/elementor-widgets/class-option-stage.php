<?php

namespace Four_Widget;

use function Four_Widget\Classes\fourwidget_framework_elementor_get_group_types;
use function Four_Widget\Classes\fourwidget_framework_elementor_get_tab_controls_types;
use function Four_Widget\Classes\fourwidget_get_example_text;
use function Four_Widget\Classes\fourwidget_get_select_type_options_pool;

if (!defined('ABSPATH')) {
    exit;   // Exit if accessed directly.
}


class Option_Stage
{
    public $options;

    public function __construct()
    {
        $this->init_option_from_array();
        $this->init_option();
    }

    function set_option($params)
    {
        $key = $params['name'];

        $this->options[$key] = $params;
    }

    function init_option_from_array()
    {

        $this->set_option(
            array(
                'field_type'    => 'repeater',
                'name'          => 'children',
                'label_group_repeater' => 'Stage Process',
                'title'         => esc_html__('Items', 'fourwidget'),
                'default_value' => array(
                    array(
                        'item_title' => esc_html__('Item Title 1', 'fourwidget'),
                        'item_text'  => fourwidget_get_example_text('excerpt_short'),
                    ),
                    array(
                        'item_title' => esc_html__('Item Title 2', 'fourwidget'),
                        'item_text'  => fourwidget_get_example_text('excerpt_short'),
                    ),
                    array(
                        'item_title' => esc_html__('Item Title 3', 'fourwidget'),
                        'item_text'  => fourwidget_get_example_text('excerpt_short'),
                    ),
                ),
                'items'         => array(
                    // array(
                    //     'field_type' => 'icons',
                    //     'name'       => 'icon_type',
                    //     'title'      => esc_html__('Icon Type', 'fourwidget'),
                    // ),
                    // array(
                    //     'field_type' => 'divider',
                    //     'name'       => 'item_divider_a',
                    //     'title'      => esc_html__('Divider', 'fourwidget'),
                    // ),
                    array(
                        'field_type'    => 'text',
                        'name'          => 'item_title',
                        'title'         => esc_html__('Title', 'fourwidget'),
                        'default_value' => esc_html__('Item Title', 'fourwidget'),
                    ),
                    array(
                        'field_type'    => 'textarea',
                        'name'          => 'item_text',
                        'title'         => esc_html__('Text', 'fourwidget'),
                        'default_value' => fourwidget_get_example_text('excerpt_short'),
                    ),
                    array(
                        'field_type' => 'divider',
                        'name'       => 'item_divider_b',
                        'title'      => esc_html__('Divider', 'fourwidget'),
                    ),
                    // array(
                    //     'field_type' => 'slider',
                    //     'name'       => 'item_margin-top',
                    //     'title'      => esc_html__('Item Offset', 'fourwidget'),
                    //     'size_units' => array('px', '%', 'em'),
                    //     // 'responsive' => true,
                    //     'selectors'  => array(
                    //         '{{WRAPPER}} .qodef-qi-process.qodef-item-layout--horizontal {{CURRENT_ITEM}}.qodef-process-item' => 'margin-top: {{SIZE}}{{UNIT}};',
                    //         '{{WRAPPER}} .qodef-qi-process.qodef-item-layout--vertical {{CURRENT_ITEM}}.qodef-process-item' => 'margin-left: {{SIZE}}{{UNIT}};',
                    //     ),
                    // ),
                    // array(
                    //     'field_type' => 'slider',
                    //     'name'       => 'item_icon_holder_size',
                    //     'title'      => esc_html__('Item Holder Size', 'fourwidget'),
                    //     'size_units' => array( '%'),
                    //     // 'default'    => array('size' => 100 , 'unit' => '%'),
                    //     // 'responsive' => true,
                    //     'selectors'  => array(
                    //         '{{WRAPPER}} {{CURRENT_ITEM}} .qodef-e-icon' => 'padding-bottom: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                    //     ),
                    // ),
                    // array(
                    //     'field_type' => 'slider',
                    //     'name'       => 'item_icon_holder_height',
                    //     'title'      => esc_html__('Item Holder Height', 'fourwidget'),
                    //     'size_units' => array('px', 'em'),
                    //     'responsive' => true,
                    //     'default'    => array('unit' => 'px', 'size' => 100),
                    //     'selectors'  => array(
                    //         '{{WRAPPER}} {{CURRENT_ITEM}} .qodef-e-icon' => 'height: {{SIZE}}{{UNIT}};',
                    //     ),
                    // ),
                    array(
                        'field_type' => 'typography',
                        'name'       => 'item_icon_typography',
                        'title'      => esc_html__('Item Typography', 'fourwidget'),
                        'selector'   => '{{WRAPPER}} {{CURRENT_ITEM}} .qodef-e-icon > .qodef-e-item-icon-text',
                        'group'      => esc_html__('Style', 'fourwidget'),
                    ),
                    array(
                        'field_type' => 'color',
                        'name'       => 'item_icon_color',
                        'title'      => esc_html__('Item Color', 'fourwidget'),
                        'selectors'  => array(
                            '{{WRAPPER}} {{CURRENT_ITEM}} .qodef-e-icon' => 'color: {{VALUE}};',
                        ),
                    ),
                    array(
                        'field_type' => 'background',
                        'name'       => 'item_icon_holder_background',
                        'title'      => esc_html__('Item Holder Background', 'fourwidget'),
                        'types'      => array('classic', 'gradient'),
                        'selector'   => '{{WRAPPER}} {{CURRENT_ITEM}} .qodef-e-icon',
                    ),
                    // array(
                    //     'field_type' => 'dimensions',
                    //     'name'       => 'item_icon_holder_radius',
                    //     'title'      => esc_html__('Item Holder Radius', 'fourwidget'),
                    //     'size_units' => array('px', '%', 'em'),
                    //     'responsive' => true,
                    //     'selectors'  => array(
                    //         '{{WRAPPER}} {{CURRENT_ITEM}} .qodef-e-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    //     ),
                    // ),
                    // array(
                    //     'field_type' => 'border',
                    //     'name'       => 'item_icon_border',
                    //     'title'      => esc_html__('Item Border', 'fourwidget'),
                    //     'selector'   => '{{WRAPPER}} {{CURRENT_ITEM}} .qodef-e-icon',
                    // ),
                    array(
                        'field_type' => 'divider',
                        'name'       => 'item_divider_d',
                        'title'      => esc_html__('Divider', 'fourwidget'),
                    ),
                    array(
                        'field_type' => 'slider',
                        'name'       => 'item_line_top_offset',
                        'title'      => esc_html__('Line Top Offset', 'fourwidget'),
                        'size_units' => array('px', '%', 'em'),
                        // 'responsive' => true,
                        'selectors'  => array(
                            '{{WRAPPER}} {{CURRENT_ITEM}} .qodef-e-line' => 'top: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .qodef-qi-process.qodef-item-layout--horizontal {{CURRENT_ITEM}} .qodef-e-line' => 'top: {{SIZE}}{{UNIT}};',
                        ),
                        'group'      => esc_html__('Style', 'fourwidget'),
                    ),
                    array(
                        'field_type' => 'number',
                        'name'       => 'line_transform_rotate',
                        'title'      => esc_html__('Line Rotation', 'fourwidget'),
                        'min'        => 0,
                        'max'        => 360,
                        'step'       => 1,
                        'default'    => 0,
                        'selectors'  => array(
                            '{{WRAPPER}} {{CURRENT_ITEM}} .qodef-e-line' => 'transform:rotate({{VALUE}}deg);',
                        ),
                    ),
                ),
            )
        );
    }

    function init_option()
    {




        $this->set_option(
            array(
                'field_type'    => 'choose',
                'name'          => 'alignment',
                'title'         => esc_html__('Alignment', 'fourwidget'),
                'options'       => fourwidget_get_select_type_options_pool('alignment_icons', false),
                'selectors'     => array(
                    '{{WRAPPER}} .qodef-e-content' => 'text-align: {{VALUE}};',
                ),
                'default_value' => 'center',
                'group'         => esc_html__('Style', 'fourwidget'),
            )
        );
        $this->set_option(
            array(
                'field_type' => 'divider',
                'name'       => 'alignment_divider',
                'title'      => esc_html__('Divider', 'fourwidget'),
                'group'      => esc_html__('Style', 'fourwidget'),
            )
        );
        $this->set_option(
            array(
                'field_type'    => 'select',
                'name'          => 'item_title_tag',
                'title'         => esc_html__('Title Tag', 'fourwidget'),
                'options'       => fourwidget_get_select_type_options_pool('title_tag', false),
                'default_value' => 'h5',
                'group'         => esc_html__('Style', 'fourwidget'),
            )
        );
        $this->set_option(
            array(
                'field_type' => 'color',
                'name'       => 'item_title_color',
                'title'      => esc_html__('Title Color', 'fourwidget'),
                'selectors'  => array(
                    '{{WRAPPER}} .qodef-qi-process .qodef-e-title' => 'color: {{VALUE}};',
                ),
                'group'      => esc_html__('Style', 'fourwidget'),
            )
        );
        $this->set_option(
            array(
                'field_type' => 'typography',
                'name'       => 'item_author_typography',
                'title'      => esc_html__('Title Typography', 'fourwidget'),
                'selector'   => '{{WRAPPER}} .qodef-qi-process .qodef-e-title',
                'group'      => esc_html__('Style', 'fourwidget'),
            )
        );
        $this->set_option(
            array(
                'field_type' => 'divider',
                'name'       => 'title_text_divider',
                'title'      => esc_html__('Divider', 'fourwidget'),
                'group'      => esc_html__('Style', 'fourwidget'),
            )
        );
        $this->set_option(
            array(
                'field_type' => 'color',
                'name'       => 'item_text_color',
                'title'      => esc_html__('Text Color', 'fourwidget'),
                'selectors'  => array(
                    '{{WRAPPER}} .qodef-qi-process .qodef-e-text' => 'color: {{VALUE}};',
                ),
                'group'      => esc_html__('Style', 'fourwidget'),
            )
        );
        $this->set_option(
            array(
                'field_type' => 'typography',
                'name'       => 'item_text_typography',
                'title'      => esc_html__('Text Typography', 'fourwidget'),
                'selector'   => '{{WRAPPER}} .qodef-qi-process .qodef-e-text',
                'group'      => esc_html__('Style', 'fourwidget'),
            )
        );
        $this->set_option(
            array(
                'field_type' => 'divider',
                'name'       => 'text_line_divider',
                'title'      => esc_html__('Divider', 'fourwidget'),
                'group'      => esc_html__('Style', 'fourwidget'),
            )
        );
        // $this->set_option(
        //     array(
        //         'field_type' => 'slider',
        //         'name'       => 'global_item_margin_top',
        //         'title'      => esc_html__('Item Offset', 'fourwidget'),
        //         'size_units' => array('px', '%', 'em'),
        //         'responsive' => true,
        //         'selectors'  => array(
        //             '{{WRAPPER}} .qodef-qi-process.qodef-item-layout--horizontal .qodef-process-item' => 'margin-top: {{SIZE}}{{UNIT}};',
        //             '{{WRAPPER}} .qodef-qi-process.qodef-item-layout--vertical .qodef-process-item' => 'margin-left: {{SIZE}}{{UNIT}};',
        //         ),
        //         'group'      => esc_html__('Style', 'fourwidget'),
        //     )
        // );

        // $this->set_option(
        //     array(
        //         'field_type' => 'slider',
        //         'name'       => 'global_item_icon_holder_size',
        //         'title'      => esc_html__('Item Holder Size', 'fourwidget'),
        //         'size_units' => array('px', '%', 'em'),
        //         'responsive' => true,
        //         'selectors'  => array(
        //             '{{WRAPPER}} .qodef-e-icon' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
        //         ),
        //         'group'      => esc_html__('Style', 'fourwidget'),
        //     )
        // );

        $this->set_option(
            array(
                'field_type' => 'dimensions',
                'name'       => 'item_icon_holder_radius',
                'title'      => esc_html__('Item Holder Radius', 'fourwidget'),
                'size_units' => array('px', '%', 'em'),
                'default'    => array('size' => 0 , 'unit' => 'px'),
                // 'responsive' => true,
                'selectors'  => array( 
                    '{{WRAPPER}} .qodef-e-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'group'     => esc_html__('Style', 'fourwidget')
            )
        );

        $this->set_option(
            array(
                'field_type' => 'typography',
                'name'       => 'global_item_icon_typography',
                'title'      => esc_html__('Item Typography', 'fourwidget'),
                'selector'   => '{{WRAPPER}} .qodef-e-icon > .qodef-e-item-icon-text',
                'group'      => esc_html__('Style', 'fourwidget'),
            )
        );

        $this->set_option(
            array(
                'field_type' => 'color',
                'name'       => 'global_item_icon_color',
                'title'      => esc_html__('Item Color', 'fourwidget'),
                'selectors'  => array(
                    '{{WRAPPER}} .qodef-e-icon' => 'color: {{VALUE}};',
                ),
                'group'      => esc_html__('Style', 'fourwidget'),
            )
        );

        $this->set_option(
            array(
                'field_type' => 'background',
                'name'       => 'global_item_icon_holder_background',
                'title'      => esc_html__('Item Holder Background', 'fourwidget'),
                'types'      => array('classic', 'gradient'),
                'selector'   => '{{WRAPPER}} .qodef-e-icon',
                'group'      => esc_html__('Style', 'fourwidget'),
            )
        );

        // $this->set_option(
        //     array(
        //         'field_type' => 'dimensions',
        //         'name'       => 'global_item_icon_holder_radius',
        //         'title'      => esc_html__('Item Holder Radius', 'fourwidget'),
        //         'size_units' => array('px', '%', 'em'),
        //         'responsive' => true,
        //         'selectors'  => array(
        //             '{{WRAPPER}} .qodef-e-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        //         ),
        //         'group'      => esc_html__('Style', 'fourwidget'),
        //     )
        // );

        // $this->set_option(
        //     array(
        //         'field_type' => 'border',
        //         'name'       => 'global_item_icon_border',
        //         'title'      => esc_html__('Item Border', 'fourwidget'),
        //         'selector'   => '{{WRAPPER}} .qodef-e-icon',
        //         'group'      => esc_html__('Style', 'fourwidget'),
        //     )
        // );
        $this->set_option(
            array(
                'field_type' => 'select',
                'name'       => 'line_border_style',
                'title'      => esc_html__('Line Border Style', 'fourwidget'),
                'options'    => fourwidget_get_select_type_options_pool('border_style', false),
                'selectors'  => array(
                    '{{WRAPPER}} .qodef-qi-process.qodef-item-layout--horizontal .qodef-e-line-inner' => 'border-bottom-style: {{VALUE}};',
                    '{{WRAPPER}} .qodef-qi-process.qodef-item-layout--vertical .qodef-e-line-inner' => 'border-left-style: {{VALUE}};',
                ),
                'group'      => esc_html__('Line Style', 'fourwidget'),
            )
        );
        $this->set_option(
            array(
                'field_type' => 'color',
                'name'       => 'line_border_color',
                'title'      => esc_html__('Line Border Color', 'fourwidget'),
                'selectors'  => array(
                    '{{WRAPPER}} .qodef-qi-process .qodef-e-line-inner' => 'border-color: {{VALUE}};',
                ),
                'group'      => esc_html__('Line Style', 'fourwidget'),
            )
        );
        $this->set_option(
            array(
                'field_type' => 'slider',
                'name'       => 'line_thickness',
                'title'      => esc_html__('Line Thickness', 'fourwidget'),
                'size_units' => array('px'),
                'responsive' => true,
                'selectors'  => array(
                    '{{WRAPPER}} .qodef-e-line-inner' => 'border-width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .qodef-qi-process.qodef-item-layout--horizontal .qodef-e-line' => 'top: calc(50% - {{SIZE}}{{UNIT}}/2);',
                ),
                'group'      => esc_html__('Line Style', 'fourwidget'),
            )
        );
        $this->set_option(
            array(
                'field_type' => 'slider',
                'name'       => 'title_margin_top',
                'title'      => esc_html__('Item Title Margin Top', 'fourwidget'),
                'size_units' => array('px', '%', 'em'),
                'responsive' => true,
                'selectors'  => array(
                    '{{WRAPPER}} .qodef-qi-process .qodef-e-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                ),
                'group'      => esc_html__('Spacing Style', 'fourwidget'),
            )
        );
        $this->set_option(
            array(
                'field_type' => 'slider',
                'name'       => 'text_margin_top',
                'title'      => esc_html__('Item Text Margin Top', 'fourwidget'),
                'size_units' => array('px', '%', 'em'),
                'responsive' => true,
                'selectors'  => array(
                    '{{WRAPPER}} .qodef-qi-process .qodef-e-text' => 'margin-top: {{SIZE}}{{UNIT}};',
                ),
                'group'      => esc_html__('Spacing Style', 'fourwidget'),
            )
        );
        $this->set_option(
            array(
                'field_type' => 'dimensions',
                'name'       => 'text_padding',
                'title'      => esc_html__('Item Text padding', 'fourwidget'),
                'size_units' => array('px', '%', 'em'),
                
                'selectors'  => array(
                    '{{WRAPPER}} .qodef-qi-process .qodef-e-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'group'      => esc_html__('Spacing Style', 'fourwidget'),
            )
        );



        // $this->set_option(
        //     array(
        //         'field_type'    => 'select',
        //         'name'          => 'appear_animation',
        //         'title'         => esc_html__('Enable Appear Animation', 'fourwidget'),
        //         'options'       => fourwidget_get_select_type_options_pool('yes_no', false),
        //         'default_value' => 'yes',
        //         'group'         => esc_html__('Appear Animation', 'fourwidget'),
        //     )
        // );
    }

    function convert_options_types_to_elementor_types($option)
    {
        $type = $option['field_type'];

        switch ($type):
            case 'text':
                $elementor_type = \Elementor\Controls_Manager::TEXT;
                break;
            case 'link':
                $elementor_type = \Elementor\Controls_Manager::URL;
                break;
            case 'textarea':
            case 'textarea_html':
                $elementor_type = \Elementor\Controls_Manager::TEXTAREA;
                break;
            case 'html':
                $elementor_type = \Elementor\Controls_Manager::WYSIWYG;
                break;
            case 'code':
                $elementor_type = \Elementor\Controls_Manager::CODE;
                break;
            case 'select':
                $elementor_type = \Elementor\Controls_Manager::SELECT;
                break;
            case 'choose':
                $elementor_type = \Elementor\Controls_Manager::CHOOSE;
                break;
            case 'checkbox':
                $elementor_type = \Elementor\Controls_Manager::SWITCHER;
                break;
            case 'color':
                $elementor_type = \Elementor\Controls_Manager::COLOR;
                break;
            case 'hidden':
                $elementor_type = \Elementor\Controls_Manager::HIDDEN;
                break;
            case 'image':
                if (isset($option['multiple']) && 'yes' === $option['multiple']) {
                    $elementor_type = \Elementor\Controls_Manager::GALLERY;
                } else {
                    $elementor_type = \Elementor\Controls_Manager::MEDIA;
                }
                break;
            case 'date':
                $elementor_type = \Elementor\Controls_Manager::DATE_TIME;
                break;
            case 'icons':
                $elementor_type = \Elementor\Controls_Manager::ICONS;
                break;
            case 'slider':
                $elementor_type = \Elementor\Controls_Manager::SLIDER;
                break;
            case 'dimensions':
                $elementor_type = \Elementor\Controls_Manager::DIMENSIONS;
                break;
            case 'repeater':
                $elementor_type = \Elementor\Controls_Manager::REPEATER;
                break;
            case 'divider':
                $elementor_type = \Elementor\Controls_Manager::DIVIDER;
                break;
            case 'number':
                $elementor_type = \Elementor\Controls_Manager::NUMBER;
                break;
            case 'select2':
                $elementor_type = \Elementor\Controls_Manager::SELECT2;
                break;
            case 'typography':
                $elementor_type = \Elementor\Group_Control_Typography::get_type();
                break;
            case 'fonts':
                $elementor_type = \Elementor\Controls_Manager::FONT;
                break;
            case 'text_shadow':
                $elementor_type = \Elementor\Group_Control_Text_Shadow::get_type();
                break;
            case 'box_shadow':
                $elementor_type = \Elementor\Group_Control_Box_Shadow::get_type();
                break;
            case 'border':
                $elementor_type = \Elementor\Group_Control_Border::get_type();
                break;
            case 'background':
                $elementor_type = \Elementor\Group_Control_Background::get_type();
                break;
            case 'image_size':
                $elementor_type = \Elementor\Group_Control_Image_Size::get_type();
                break;
            default:
                $elementor_type = \Elementor\Controls_Manager::TEXT;
                break;
        endswitch;

        return $elementor_type;
    }

    function convert_items_arr_repeater($arr)
    {
        $ret = array();
        foreach ($arr as $key) {
            $tmp_val = array(
                'name' => $key['name'],
                'title' => $key['title']
            );
            if (isset($key['default_value']))
                $tmp_val['default_value'] = $key['default_value'];
            if (isset($key['responsive']))
                $tmp_val['responsive'] = $key['responsive'];


            $x = array_diff_key($key, $tmp_val);
            $x['label'] = $tmp_val['title'];
            if (isset($key['default_value']))
                $x['default'] = $tmp_val['default_value'];
            if (isset($key['responsive']))
                $x['responsive_enabled'] = $key['responsive'];


            $ret[$tmp_val['name']] = $x;
        }
        return $ret;
    }

    function generate_option_params()
    {
        $params = array();
        foreach ($this->options as $key) {
            // main content setting
            if (!isset($key['group'])) {
                $general_key = array();
                if (($key['field_type'] === 'repeater') && ($key['name'] === 'children')) {
                    $general_key['field_type'] = 'repeater';
                    $general_key['label'] = 'Stage Process';
                    $general_key['default'] = $key['default_value'];
                    $general_key['title_field'] = 'Stage';

                    $general_key['items'] = $this->convert_items_arr_repeater($key['items']);

                    $params[$key['label_group_repeater']]['fields']['children'] = $general_key;
                }
            }

            // group setting
            if (isset($key['group'])) {
                $paramkey = strtolower(str_replace(" ", "-", $key['group'])) . "-elementor";
                $tmp_name = $key['name'];
                $tmp_default_value = '';
                if (isset($key['default_value']))
                    $tmp_default_value = $key['default_value'];

                $tmp_title = $key['title'];
                $newkey = array();
                $newkey['label'] = $tmp_title;
                if ($tmp_default_value !== '')
                    $newkey['default'] = $tmp_default_value;

                foreach ($key as $key2 => $key2value) {
                    if (($key2 !== 'name') && ($key2 !== 'title') && ($key2 !== 'group') && ($key2 !== 'default_value')) {
                        $newkey[$key2] = $key2value;
                    }
                }




                $params[$paramkey]['fields'][$tmp_name] = $newkey;
            }
        }
        return $params;
    }

    function create_log($params)
    {
        $fp = fopen("proc2.json", "w");
        fwrite($fp, json_encode($params, JSON_PRETTY_PRINT));
        fclose($fp);
    }

    function create_controls($elementor_object)
    {
        $controls = $this->generate_option_params();

        // $this->create_log($controls);

        foreach ($controls as $control_key => $control) {
            $tab = \Elementor\Controls_Manager::TAB_CONTENT;

            // If options group contain Style word put that options inside Elementor Style tab
            if (strpos($control_key, 'style') !== false) {
                $tab = \Elementor\Controls_Manager::TAB_STYLE;
            }

            $elementor_object->start_controls_section(
                $control_key,
                array(
                    'label' => ucwords(str_replace(array('-elementor', '-'), array('', ' '), $control_key)),
                    'tab'   => $tab,
                )
            );

            foreach ($control['fields'] as $field_key => $field) {
                if (isset($field['field_type']) && 'repeater' === $field['field_type']) {
                    $repeater = new \Elementor\Repeater();

                    foreach ($field['items'] as $item_key => $item) {
                        $item['type'] = $this->convert_options_types_to_elementor_types($item);

                        if (isset($item['field_type']) && in_array($item['field_type'], fourwidget_framework_elementor_get_group_types(), true)) {
                            $repeater->add_group_control(
                                $item['type'],
                                array_merge(
                                    array(
                                        'name' => $item_key,
                                    ),
                                    $item
                                )
                            );
                        } elseif (isset($item['responsive_enabled']) && true === $item['responsive_enabled']) {
                            $repeater->add_responsive_control(
                                $item_key,
                                $item
                            );
                        } else {
                            $repeater->add_control(
                                $item_key,
                                $item
                            );
                        }
                    }

                    $field['fields'] = $repeater->get_controls();
                    unset($field['items']);
                }

                if (isset($field['field_type']) && in_array($field['field_type'], fourwidget_framework_elementor_get_tab_controls_types(), true)) {
                    $tabs_settings = array();

                    if (isset($field['label']) && !empty($field['label'])) {
                        $tabs_settings['label'] = $field['label'];
                    }
                    $function = $field['field_type'];
                    $elementor_object->$function(
                        $field_key,
                        $tabs_settings
                    );
                } else {

                    $field['type'] = $this->convert_options_types_to_elementor_types($field);

                    if (isset($field['field_type']) && in_array($field['field_type'], fourwidget_framework_elementor_get_group_types(), true)) {
                        $elementor_object->add_group_control(
                            $field['type'],
                            array_merge(
                                array(
                                    'name' => $field_key,
                                ),
                                $field
                            )
                        );
                    } elseif (isset($field['responsive_enabled']) && true === $field['responsive_enabled']) {
                        $elementor_object->add_responsive_control(
                            $field_key,
                            $field
                        );
                    } else {
                        $elementor_object->add_control(
                            $field_key,
                            $field
                        );
                    }
                }
            }

            $elementor_object->end_controls_section();
        }
    }
}
