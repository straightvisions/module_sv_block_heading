<?php if ( current_user_can( 'activate_plugins' ) ) { ?>
	<div class="sv_setting_subpage">
		<h2><?php _e('H'.$i, 'sv100'); ?></h2>
		<h3 class="divider"><?php _e( 'Font', 'sv100' ); ?></h3>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'h'.$i.'_font_family' )->form();
				echo $module->get_setting( 'h'.$i.'_font_size' )->form();
			?>
		</div>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'h'.$i.'_line_height' )->form();
				echo $module->get_setting( 'h'.$i.'_text_color' )->form();
			?>
		</div>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'h'.$i.'_margin' )->form();
				echo $module->get_setting( 'h'.$i.'_padding' )->form();
			?>
		</div>
		<div class="sv_setting_flex">
			<?php
				echo $module->get_setting( 'h'.$i.'_border' )->form();
			?>
		</div>
	</div>
<?php } ?>