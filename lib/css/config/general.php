<?php
	
	
	
	$i = 1;
	while ($i <= 6) {
		
		$selector_editor =
			'.editor-styles-wrapper h'.$i.'.wp-block-heading'
			.', .editor-styles-wrapper h1.wp-block-heading.is-style-h'.$i
			.', .editor-styles-wrapper h2.wp-block-heading.is-style-h'.$i
			.', .editor-styles-wrapper h3.wp-block-heading.is-style-h'.$i
			.', .editor-styles-wrapper h4.wp-block-heading.is-style-h'.$i
			.', .editor-styles-wrapper h5.wp-block-heading.is-style-h'.$i
			.', .editor-styles-wrapper h6.wp-block-heading.is-style-h'.$i;
		
		$selector_frontend =
			'h'.$i
			.', h1.is-style-h'.$i
			.', h2.is-style-h'.$i
			.', h3.is-style-h'.$i
			.', h4.is-style-h'.$i
			.', h5.is-style-h'.$i
			.', h6.is-style-h'.$i;
			
		echo $_s->build_css(
			is_admin() ? $selector_editor : $selector_frontend,
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