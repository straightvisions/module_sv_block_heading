<?php if ( current_user_can( 'activate_plugins' ) ) { ?>
	<div class="sv_section_description"><?php echo $module->get_section_desc(); ?></div>
	<div class="sv_setting_subpages">
		<ul class="sv_setting_subpages_nav"></ul>
		<?php
			$i = 1;
			while ($i <= 6) {
				require( $module->get_path( 'lib/backend/tpl/general.php' ) );
				$i++;
			}
		?>
	</div>
	<?php
}