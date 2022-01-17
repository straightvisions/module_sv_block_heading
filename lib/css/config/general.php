<?php
	$i = 1;
	while ($i <= 6) {
		echo $_s->build_css(
			is_admin() ? '.editor-styles-wrapper h'.$i.'.wp-block-heading' : 'h'.$i,
			array_merge(
				$module->get_setting('h'.$i.'_hyphens')->get_css_data('-webkit-hyphens'),
				$module->get_setting('h'.$i.'_hyphens')->get_css_data('-moz-hyphens'),
				$module->get_setting('h'.$i.'_hyphens')->get_css_data('hyphens'),
				$module->get_setting('h'.$i.'_font_family')->get_css_data('font-family'),
				$module->get_setting('h'.$i.'_font_size')->get_css_data('font-size','','px'),
				$module->get_setting('h'.$i.'_line_height')->get_css_data('line-height'),
				$module->get_setting('h'.$i.'_text_color')->get_css_data(),
				$module->get_setting('h'.$i.'_padding')->get_css_data('padding'),
				$module->get_setting('h'.$i.'_margin')->get_css_data(),
				$module->get_setting('h'.$i.'_border')->get_css_data()
			)
		);

		$i++;
	}