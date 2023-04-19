<?php
namespace owpElementor;

$elementor_widgets             = owpElementorPlugin::instance()->modules_manager->get_modules_list();
$oe_elementor_widgets_settings = get_option( 'oe_elementor_widgets_settings', 0 );
if ( empty( $oe_elementor_widgets_settings ) && $oe_elementor_widgets_settings !== 0 ) {
	$oe_elementor_widgets_settings = array();
}

?>


<div id="ocean-elementor-widgets-control" class="column-wrap clr">
	<form class="save_panel_settings">
		<input type="hidden" name="option_name" value="oe_elementor_widgets_settings" />

		<div id="ocean-elementor-widgets-disable-bulk" class="oceanwp-tp-switcher column-wrap clr">
			<label for="oceanwp-switch-elementor-widgets-disable-bulk" class="column-name">
				<input type="checkbox" role="checkbox" name="elementor-widgets-disable-bulk" value="true" <?php checked( ( $oe_elementor_widgets_settings === 0 ) ); ?> id="oceanwp-switch-elementor-widgets-disable-bulk" class="oe-switcher-bulk" />
				<span class="slider round"></span>
			</label>
		</div>

		<div id="ocean-elementor-widgets-items" class="column-wrap clr">
			<?php foreach ( $elementor_widgets as $widget_key ) : ?>
				<?php
				$widget_label = ucwords( str_replace( '-', ' ', $widget_key ) );
				if ( $oe_elementor_widgets_settings === 0 ) {
					$checked_val = true;
				} else {
					$checked_val = ! empty( $oe_elementor_widgets_settings[ $widget_key ] );
				}
				?>
				<div id="ocean-elementor-widgets-<?php echo $widget_key; ?>" class="oceanwp-tp-small-block column-wrap clr">
						<h3 class="title"><?php echo esc_attr( $widget_label ); ?></h3>
                        <label for="oceanwp-elementor-widgets-switch-[<?php echo esc_attr( $widget_key ); ?>]" class="oceanwp-tp-switcher column-name">
                            <input type="checkbox" role="checkbox" name="oe_elementor_widgets_settings[<?php echo esc_attr( $widget_key ); ?>]" value="true" id="oceanwp-elementor-widgets-switch-[<?php echo esc_attr( $widget_key ); ?>]" <?php checked( $checked_val ); ?>>
                            <span class="slider round"></span>
                        </label>
				</div>
			<?php endforeach; ?>
		</div>
		<?php submit_button(); ?>
	</form>
</div>
