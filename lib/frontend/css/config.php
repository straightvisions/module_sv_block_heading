<?php
	// ##### SETTINGS #####

	// Fetches all settings and creates new variables with the setting ID as name and setting data as value.
	// This reduces the lines of code for the needed setting values.
	foreach ( $script->get_parent()->get_settings() as $setting ) {
		if ( $setting->get_type() !== false ) {
			${ $setting->get_ID() } = $setting->get_data();
		}
	}

	$i = 1;
	while ($i <= 6) {
		$properties					= array();

		// Font Size
		$key				= 'h'.$i.'_font_size';
		$value				= $$key;

		if($value) {
			$properties['font-size']	= $setting->prepare_css_property_responsive($value,'','px');
		}

		// Line Height
		$key				= 'h'.$i.'_line_height';
		$value				= $$key;

		if($value) {
			$properties['line-height']	= $setting->prepare_css_property_responsive($value);
		}

		// Text Color
		$key				= 'h'.$i.'_text_color';
		$value				= $$key;

		if($value){
			$properties['color']		= $setting->prepare_css_property_responsive($value,'rgba(',')');
		}

		// Font
		// @todo: double code
		$key				= 'h'.$i.'_font_family';
		$value				= $$key;

		$font_family				= false;
		$font_weight				= false;

		foreach($value as $breakpoint => $val) {
			if($val) {
				$f							= $setting->get_parent()->get_module('sv_webfontloader')->get_font_by_label($val);
				$font_family[$breakpoint]	= $f['family'];
				$font_weight[$breakpoint]	= $f['weight'];
			}else{
				$font_family[$breakpoint]	= false;
				$font_weight[$breakpoint]	= false;
			}
		}

		if($font_family && (count(array_unique($font_family)) > 1 || array_unique($font_family)['mobile'] !== false)){
			$properties['font-family']	= $setting->prepare_css_property_responsive($font_family,'',', sans-serif;');
			$properties['font-weight']	= $setting->prepare_css_property_responsive($font_weight,'','');
		}

		// Margin
		$key				= 'h'.$i.'_margin';
		$value				= $$key;

		if($value) {
			$imploded		= false;
			foreach($value as $breakpoint => $val) {
				$top = (isset($val['top']) && strlen($val['top']) > 0) ? $val['top'] : false;
				$right = (isset($val['right']) && strlen($val['right']) > 0) ? $val['right'] : false;
				$bottom = (isset($val['bottom']) && strlen($val['bottom']) > 0) ? $val['bottom'] : false;
				$left = (isset($val['left']) && strlen($val['left']) > 0) ? $val['left'] : false;

				if($top !== false || $right !== false || $bottom !== false || $left !== false) {
					$imploded[$breakpoint] = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
				}
			}
			if($imploded) {
				$properties['margin'] = $setting->prepare_css_property_responsive($imploded, '', '');
			}
		}

		// Padding
		// @todo: same as margin, refactor to avoid doubled code
		$key				= 'h'.$i.'_padding';
		$value				= $$key;

		if($value) {
			$imploded		= false;
			foreach($value as $breakpoint => $val) {
				$top = (isset($val['top']) && strlen($val['top']) > 0) ? $val['top'] : false;
				$right = (isset($val['right']) && strlen($val['right']) > 0) ? $val['right'] : false;
				$bottom = (isset($val['bottom']) && strlen($val['bottom']) > 0) ? $val['bottom'] : false;
				$left = (isset($val['left']) && strlen($val['left']) > 0) ? $val['left'] : false;

				if($top !== false || $right !== false || $bottom !== false || $left !== false) {
					$imploded[$breakpoint] = $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
				}
			}
			if($imploded) {
				$properties['padding'] = $setting->prepare_css_property_responsive($imploded, '', '');
			}
		}

		// border
		$key				= 'h'.$i.'_border';
		$value				= $$key;

		if($value) {
			if($value['top_width']){
				$val		= $value['top_width'].' '.$value['top_style'].' rgba('.$value['color'].')';
				$properties['border-top'] = $setting->prepare_css_property_responsive($val, '', '');
			}
			if($value['right_width']){
				$val		= $value['right_width'].' '.$value['right_style'].' rgba('.$value['color'].')';
				$properties['border-right'] = $setting->prepare_css_property_responsive($val, '', '');
			}
			if($value['bottom_width']){
				$val		= $value['bottom_width'].' '.$value['bottom_style'].' rgba('.$value['color'].')';
				$properties['border-bottom'] = $setting->prepare_css_property_responsive($val, '', '');
			}
			if($value['left_width']){
				$val		= $value['left_width'].' '.$value['left_style'].' rgba('.$value['color'].')';
				$properties['border-left'] = $setting->prepare_css_property_responsive($val, '', '');
			}

			if($value['top_left_radius']+$value['top_right_radius']+$value['bottom_right_radius']+$value['bottom_left_radius']!==0) {
				$value_radius = $value['top_left_radius'] . ' ' . $value['top_right_radius'] . ' ' . $value['bottom_right_radius'] . ' ' . $value['bottom_left_radius'];
				$properties['border-radius'] = $setting->prepare_css_property_responsive($value_radius, '', '');
			}
		}

		echo $setting->build_css(
			is_admin() ? '.edit-post-visual-editor.editor-styles-wrapper h'.$i : '.sv100_sv_content_wrapper article h'.$i,
			$properties
		);

		$i++;
	}