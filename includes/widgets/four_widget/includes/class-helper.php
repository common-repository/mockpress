<?php

/**
 *  Helper.
 *
 * @package Helper
 */

namespace Four_Widget\Classes;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class UFW_Helper
{

    public static function is_elementor_updated()
    {
        if (class_exists('Elementor\Icons_Manager')) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Return the new icon name.
     *
     * @since 1.16.1
     *
     * @param string $control_name name of the control.
     * @return string of the updated control name.
     */
    
    public static function get_new_icon_name($control_name)
    {
        if (class_exists('Elementor\Icons_Manager')) {
            return 'new_' . $control_name . '[value]';
        } else {
            return $control_name;
        }
    }
}

if ( ! function_exists( 'fourwidget_get_example_text' ) ) {
	function fourwidget_get_example_text( $type = '' ) {
		switch ( $type ) {
			case 'title':
				return esc_html__( 'Example Title', 'fourwidget' );
				break;
			case 'subtitle':
				return esc_html__( 'Example Subtitle', 'fourwidget' );
				break;
			case 'excerpt_short':
				return esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus nisl vitae magna pulvinar laoreet.', 'fourwidget' );
				break;
			case 'excerpt_long':
				return esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus nisl vitae magna pulvinar laoreet. Nullam erat ipsum, mattis nec mollis ac, accumsan a enim. Nunc at euismod arcu. Aliquam ullamcorper eros justo, vel mollis neque facilisis vel. Proin augue tortor, condimentum id sapien a, tempus venenatis massa. Aliquam egestas eget diam sed sagittis. Vivamus consectetur purus vel felis molestie sollicitudin. Vivamus sit amet enim nisl. Cras vitae varius metus, a hendrerit ex. Sed in mi dolor. Proin pretium nibh non volutpat efficitur.', 'fourwidget' );
				break;
			default:
				return esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris tempus nisl vitae magna pulvinar laoreet. Nullam erat ipsum, mattis nec mollis ac, accumsan a enim. Nunc at euismod arcu. Aliquam ullamcorper eros justo, vel mollis neque facilisis vel.', 'fourwidget' );
				break;
		}
	}
}

if ( ! function_exists( 'fourwidget_get_select_type_options_pool' ) ) {
	/**
	 * Function that returns array with pool of options for select fields in framework
	 *
	 *
	 * @param string $type - type of select field
	 * @param bool $enable_default - add first element empty for default value
	 * @param array $exclude - array of items to exclude
	 * @param array $include - array of items to include
	 *
	 * @return array escaped output
	 */
	function fourwidget_get_select_type_options_pool( $type, $enable_default = true, $exclude = array(), $include = array() ) {
		$options = array();
		if ( $enable_default ) {
			$options[''] = esc_html__( 'Default', 'fourwidget' );
		}
		switch ( $type ) {
			case 'content_width':
				$options['1400'] = esc_html__( '1400px', 'fourwidget' );
				$options['1300'] = esc_html__( '1300px', 'fourwidget' );
				$options['1200'] = esc_html__( '1200px', 'fourwidget' );
				$options['1100'] = esc_html__( '1100px', 'fourwidget' );
				$options['1000'] = esc_html__( '1000px', 'fourwidget' );
				$options['800']  = esc_html__( '800px', 'fourwidget' );
				break;
			case 'title_tag':
				$options['h1'] = 'H1';
				$options['h2'] = 'H2';
				$options['h3'] = 'H3';
				$options['h4'] = 'H4';
				$options['h5'] = 'H5';
				$options['h6'] = 'H6';
				$options['p']  = 'P';
				break;
			case 'link_target':
				$options['_self']  = esc_html__( 'Same Window', 'fourwidget' );
				$options['_blank'] = esc_html__( 'New Window', 'fourwidget' );
				break;
			case 'border_style':
				$options['solid']  = esc_html__( 'Solid', 'fourwidget' );
				$options['dashed'] = esc_html__( 'Dashed', 'fourwidget' );
				$options['dotted'] = esc_html__( 'Dotted', 'fourwidget' );
				break;
			case 'font_weight':
				$options['100'] = esc_html__( 'Thin (100)', 'fourwidget' );
				$options['200'] = esc_html__( 'Extra Light (200)', 'fourwidget' );
				$options['300'] = esc_html__( 'Light (300)', 'fourwidget' );
				$options['400'] = esc_html__( 'Normal (400)', 'fourwidget' );
				$options['500'] = esc_html__( 'Medium (500)', 'fourwidget' );
				$options['600'] = esc_html__( 'Semi Bold (600)', 'fourwidget' );
				$options['700'] = esc_html__( 'Bold (700)', 'fourwidget' );
				$options['800'] = esc_html__( 'Extra Bold (800)', 'fourwidget' );
				$options['900'] = esc_html__( 'Black (900)', 'fourwidget' );
				break;
			case 'font_style':
				$options['normal']  = esc_html__( 'Normal', 'fourwidget' );
				$options['italic']  = esc_html__( 'Italic', 'fourwidget' );
				$options['oblique'] = esc_html__( 'Oblique', 'fourwidget' );
				$options['initial'] = esc_html__( 'Initial', 'fourwidget' );
				$options['inherit'] = esc_html__( 'Inherit', 'fourwidget' );
				break;
			case 'text_transform':
				$options['none']       = esc_html__( 'None', 'fourwidget' );
				$options['capitalize'] = esc_html__( 'Capitalize', 'fourwidget' );
				$options['uppercase']  = esc_html__( 'Uppercase', 'fourwidget' );
				$options['lowercase']  = esc_html__( 'Lowercase', 'fourwidget' );
				$options['initial']    = esc_html__( 'Initial', 'fourwidget' );
				$options['inherit']    = esc_html__( 'Inherit', 'fourwidget' );
				break;
			case 'text_decoration':
				$options['none']         = esc_html__( 'None', 'fourwidget' );
				$options['underline']    = esc_html__( 'Underline', 'fourwidget' );
				$options['overline']     = esc_html__( 'Overline', 'fourwidget' );
				$options['line-through'] = esc_html__( 'Line-Through', 'fourwidget' );
				$options['initial']      = esc_html__( 'Initial', 'fourwidget' );
				$options['inherit']      = esc_html__( 'Inherit', 'fourwidget' );
				break;
			case 'list_behavior':
				$options['columns'] = esc_html__( 'Gallery', 'fourwidget' );
				$options['masonry'] = esc_html__( 'Masonry', 'fourwidget' );
				break;
			case 'columns_number':
				$options['1'] = esc_html__( 'One', 'fourwidget' );
				$options['2'] = esc_html__( 'Two', 'fourwidget' );
				$options['3'] = esc_html__( 'Three', 'fourwidget' );
				$options['4'] = esc_html__( 'Four', 'fourwidget' );
				$options['5'] = esc_html__( 'Five', 'fourwidget' );
				$options['6'] = esc_html__( 'Six', 'fourwidget' );
				$options['8'] = esc_html__( 'Eight', 'fourwidget' );
				break;
			case 'items_space':
				$options['huge']   = esc_html__( 'Huge (34)', 'fourwidget' );
				$options['large']  = esc_html__( 'Large (25)', 'fourwidget' );
				$options['medium'] = esc_html__( 'Medium (20)', 'fourwidget' );
				$options['normal'] = esc_html__( 'Normal (15)', 'fourwidget' );
				$options['small']  = esc_html__( 'Small (10)', 'fourwidget' );
				$options['tiny']   = esc_html__( 'Tiny (5)', 'fourwidget' );
				$options['no']     = esc_html__( 'No (0)', 'fourwidget' );
				break;
			case 'order_by':
				$options['date']       = esc_html__( 'Date', 'fourwidget' );
				$options['ID']         = esc_html__( 'ID', 'fourwidget' );
				$options['menu_order'] = esc_html__( 'Menu Order', 'fourwidget' );
				$options['name']       = esc_html__( 'Post Name', 'fourwidget' );
				$options['rand']       = esc_html__( 'Random', 'fourwidget' );
				$options['title']      = esc_html__( 'Title', 'fourwidget' );
				break;
			case 'order':
				$options['DESC'] = esc_html__( 'Descending', 'fourwidget' );
				$options['ASC']  = esc_html__( 'Ascending', 'fourwidget' );
				break;
			case 'columns_responsive':
				$options['predefined'] = esc_html__( 'Predefined', 'fourwidget' );
				$options['custom']     = esc_html__( 'Custom', 'fourwidget' );
				break;
			case 'yes_no':
				$options['yes'] = esc_html__( 'Yes', 'fourwidget' );
				$options['no']  = esc_html__( 'No', 'fourwidget' );
				break;
			case 'no_yes':
				$options['no']  = esc_html__( 'No', 'fourwidget' );
				$options['yes'] = esc_html__( 'Yes', 'fourwidget' );
				break;
			case 'sidebar_layouts':
				$options['no-sidebar']       = esc_html__( 'No Sidebar', 'fourwidget' );
				$options['sidebar-33-right'] = esc_html__( 'Sidebar 1/3 Right', 'fourwidget' );
				$options['sidebar-25-right'] = esc_html__( 'Sidebar 1/4 Right', 'fourwidget' );
				$options['sidebar-33-left']  = esc_html__( 'Sidebar 1/3 Left', 'fourwidget' );
				$options['sidebar-25-left']  = esc_html__( 'Sidebar 1/4 Left', 'fourwidget' );
				break;
			case 'icon_source':
				$options['icon_pack']  = esc_html__( 'Icon Pack', 'fourwidget' );
				$options['svg_path']   = esc_html__( 'SVG Path', 'fourwidget' );
				$options['predefined'] = esc_html__( 'Predefined', 'fourwidget' );
				break;
			case 'list_image_dimension':
				$options['full']      = esc_html__( 'Original', 'fourwidget' );
				$options['thumbnail'] = esc_html__( 'Thumbnail', 'fourwidget' );
				$options['medium']    = esc_html__( 'Medium', 'fourwidget' );
				$options['large']     = esc_html__( 'Large', 'fourwidget' );
				$options['custom']    = esc_html__( 'Custom', 'fourwidget' );
				$options              = apply_filters( 'fourwidget_filter_framework_pool_list_image_dimension', $options );
				break;
			case 'masonry_images_proportion':
				$options['original'] = esc_html__( 'Original', 'fourwidget' );
				$options['fixed']    = esc_html__( 'Fixed', 'fourwidget' );
				break;
			case 'alignment_icons':
				$options['left']   = array(
					'title' => esc_html__( 'Left', 'fourwidget' ),
					'icon'  => 'eicon-text-align-left',
				);
				$options['center'] = array(
					'title' => esc_html__( 'Center', 'fourwidget' ),
					'icon'  => 'eicon-text-align-center',
				);
				$options['right']  = array(
					'title' => esc_html__( 'Right', 'fourwidget' ),
					'icon'  => 'eicon-text-align-right',
				);
				break;
			case 'alignment_icons_flex':
				$options['flex-start'] = array(
					'title' => esc_html__( 'Flex Start', 'fourwidget' ),
					'icon'  => 'eicon-h-align-left',
				);
				$options['center']     = array(
					'title' => esc_html__( 'Center', 'fourwidget' ),
					'icon'  => 'eicon-h-align-center',
				);
				$options['flex-end']   = array(
					'title' => esc_html__( 'Flex End', 'fourwidget' ),
					'icon'  => 'eicon-h-align-right',
				);
				break;
			case 'alignment_flex':
				$options['flex-start'] = esc_html__( 'Flex Start', 'fourwidget' );
				$options['center']     = esc_html__( 'Center', 'fourwidget' );
				$options['flex-end']   = esc_html__( 'Flex End', 'fourwidget' );
				break;
			case 'appear_animation':
				$options['none']        = esc_html__( 'None', 'fourwidget' );
				$options['from-bottom'] = esc_html__( 'From Bottom', 'fourwidget' );
				$options['from-top']    = esc_html__( 'From Top', 'fourwidget' );
				$options['from-left']   = esc_html__( 'From Left', 'fourwidget' );
				$options['from-right']  = esc_html__( 'From Right', 'fourwidget' );
				$options['fade']        = esc_html__( 'Fade In', 'fourwidget' );
				break;
			case 'appear_delay':
				$options['random'] = esc_html__( 'Random', 'fourwidget' );
				$options['ms']     = esc_html__( 'Set ms', 'fourwidget' );
				break;
		}

		if ( ! empty( $exclude ) ) {
			foreach ( $exclude as $e ) {
				if ( array_key_exists( $e, $options ) ) {
					unset( $options[ $e ] );
				}
			}
		}

		if ( ! empty( $include ) ) {
			foreach ( $include as $key => $value ) {
				if ( ! array_key_exists( $key, $options ) ) {
					$options[ $key ] = $value;
				}
			}
		}

		//return apply_filters( 'fourwidget_filter_select_type_option', $options, $type, $enable_default, $exclude );
        return $options;
	}
}

if ( ! function_exists( 'fourwidget_framework_elementor_get_group_types' ) ) {
	function fourwidget_framework_elementor_get_group_types() {
		$group_types = array(
			'typography',
			'text_shadow',
			'box_shadow',
			'border',
			'background',
			'image_size',
		);

		return $group_types;
	}
}

if ( ! function_exists( 'fourwidget_framework_elementor_get_tab_controls_types' ) ) {
	function fourwidget_framework_elementor_get_tab_controls_types() {
		$tabs_types = array(
			'start_controls_tabs',
			'start_controls_tab',
			'end_controls_tab',
			'end_controls_tabs',
		);

		return $tabs_types;
	}
}


