<?php
	namespace sv100;

	class sv_block_heading extends init {
		public function init() {
			$this->set_module_title( __( 'Block: Heading', 'sv100' ) )
				->set_module_desc( __( 'Settings for Gutenberg Block', 'sv100' ) )
				->set_css_cache_active()
				->set_section_title( $this->get_module_title() )
				->set_section_desc( $this->get_module_desc() )
				->set_section_template_path()
				->set_section_order(5000)
				->set_section_icon('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M0 1h24v2h-24v-2zm0 6h24v-2h-24v2zm0 7h24v-4h-24v4zm0 5h24v-2h-24v2zm0 4h24v-2h-24v2z"/></svg>')
				->set_block_handle('wp-block-heading')
				->set_block_name('core/heading')
				->get_root()
				->add_section( $this );
		}

		protected function load_settings(): sv_block_heading {
			$i = 1;
			while ($i <= 6) {
				$this->get_setting( 'h'.$i.'_hyphens' )
					->set_title( __( 'Hyphens', 'sv100' ) )
					->set_description( __( 'Choose hyphens behavior.', 'sv100' ) )
					->set_options(array(
						'none'		=> __('none', 'sv100'),
						'manual'	=> __('manual', 'sv100'),
						'auto'		=> __('auto', 'sv100')
					))
					->set_default_value( 'manual' )
					->set_is_responsive(true)
					->load_type( 'select' );

				$this->get_setting( 'h'.$i.'_font_family' )
					->set_title( __( 'Font Family', 'sv100' ) )
					->set_description( __( 'Choose a font for your text.', 'sv100' ) )
					->set_options( $this->get_module( 'sv_webfontloader' ) ? $this->get_module( 'sv_webfontloader' )->get_font_options() : array('' => __('Please activate module SV Webfontloader for this Feature.', 'sv100')) )
					->set_is_responsive(true)
					->load_type( 'select' );

				$value = false;
				if($this->get_module( 'sv_common' ) && $this->get_module('sv_common')->get_setting('font_size') && is_array($this->get_module('sv_common')->get_setting('font_size')->get_data())) {
					/* font size calculation with support for every breakpoint */
					foreach ($this->get_module('sv_common')->get_setting('font_size')->get_data() as $key => $val) {
						$default_font_sizes_multiplier = array(
							1 => 2.5,
							2 => 2,
							3 => 2,
							4 => 1.5,
							5 => 1.25,
							6 => 1,
						);
						$default_font_sizes		= array([], [], [], [], [], [], []);
						$multiplier				= $default_font_sizes_multiplier[$i];
						$value					= $default_font_sizes[$i][$key] =
							floatval($val) * floatval($multiplier);
					}
				}
				
				$this->get_setting( 'h'.$i.'_font_size' )
					->set_title( __( 'Font Size', 'sv100' ) )
					->set_description( __( 'Font Size in Pixel.', 'sv100' ) )
					->set_default_value( $value )
					->set_is_responsive(true)
					->load_type( 'number' );

				$this->get_setting( 'h'.$i.'_line_height' )
					->set_title( __( 'Line Height', 'sv100' ) )
					->set_description( __( 'Set line height as multiplier or with a unit.', 'sv100' ) )
					->set_is_responsive(true)
					->load_type( 'text' );

				$this->get_setting( 'h'.$i.'_text_color' )
					->set_title( __( 'Text Color', 'sv100' ) )
					->set_is_responsive(true)
					->load_type( 'color' );

				$this->get_setting( 'h'.$i.'_margin' )
					->set_title( __( 'Margin', 'sv100' ) )
					->set_is_responsive(true)
					->set_default_value(array(
						'top'		=> '30px',
						'right'		=> 'auto',
						'bottom'	=> '20px',
						'left'		=> 'auto'
					))
					->load_type( 'margin' );

				$this->get_setting( 'h'.$i.'_padding' )
					->set_title( __( 'Padding', 'sv100' ) )
					->set_is_responsive(true)
					->load_type( 'margin' );

				$this->get_setting( 'h'.$i.'_border' )
					->set_title( __( 'Border', 'sv100' ) )
					->set_is_responsive(true)
					->load_type( 'border' );

				$i++;
			}

			return $this;
		}

		protected function register_scripts(): sv_block_heading {
			parent::register_scripts();

			// Register Styles
			$this->get_script( 'h1' )->set_block_style(__('Like H1', 'sv100'));
			$this->get_script( 'h2' )->set_block_style(__('Like H2', 'sv100'));
			$this->get_script( 'h3' )->set_block_style(__('Like H3', 'sv100'));
			$this->get_script( 'h4' )->set_block_style(__('Like H4', 'sv100'));
			$this->get_script( 'h5' )->set_block_style(__('Like H5', 'sv100'));
			$this->get_script( 'h6' )->set_block_style(__('Like H6', 'sv100'));

			return $this;
		}
	}