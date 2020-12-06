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
				->get_root()
				->add_section( $this );
		}

		protected function load_settings(): sv_block_heading {
			/* font size calculation for headings */
			if($this->get_module( 'sv_common' )) {
				$default_font_sizes = array([], [], [], [], [], [], []);
				$common_font_size = $this->get_module('sv_common')->get_setting('font_size')->get_data();
				$default_font_sizes_multiplier = array(
					1 => 2.5,
					2 => 2,
					3 => 2,
					4 => 1.5,
					5 => 1.25,
					6 => 1,
				);
			}else{
				$common_font_size = false;
			}
			
			$i = 1;
			while ($i <= 6) {
				$this->get_setting( 'h'.$i.'_font_family' )
					->set_title( __( 'Font Family', 'sv100' ) )
					->set_description( __( 'Choose a font for your text.', 'sv100' ) )
					->set_options( $this->get_module( 'sv_webfontloader' ) ? $this->get_module( 'sv_webfontloader' )->get_font_options() : array('' => __('Please activate module SV Webfontloader for this Feature.', 'sv100')) )
					->set_is_responsive(true)
					->load_type( 'select' );

				$value = false;
				if($this->get_module( 'sv_common' ) && $common_font_size) {
					/* font size calculation with support for every breakpoint */
					foreach ($common_font_size as $key => $val) {
						$value = $default_font_sizes[$i][$key] = $val * $default_font_sizes_multiplier[$i];
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
					->set_default_value( '#1e1e1e' )
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
			$this->get_script( 'style_no_margin' )
				->set_is_gutenberg()
				->set_path( 'lib/css/common/style_no_margin.css' );

			return $this;
		}
		public function enqueue_scripts(): sv_block_heading {
			if(!$this->has_block_frontend('heading')){
				return $this;
			}

			if(!is_admin()){
				$this->load_settings()->register_scripts();
			}

			foreach($this->get_scripts() as $script){
				$script->set_is_enqueued();
			}

			return $this;
		}
	}