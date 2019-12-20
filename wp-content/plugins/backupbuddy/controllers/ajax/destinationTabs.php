<?php
/**
 * Destination Tabs AJAX Controller
 *
 * @package BackupBuddy
 */

backupbuddy_core::verifyAjaxAccess();

require_once pb_backupbuddy::plugin_path() . '/destinations/bootstrap.php';
pb_backupbuddy::$ui->ajax_header( true, false, 'destination-tabs' );

pb_backupbuddy::load_style( 'admin.js' );
pb_backupbuddy::load_style( 'admin' );
pb_backupbuddy::load_style( 'destination_picker.css' );
pb_backupbuddy::load_script( 'jquery' );
pb_backupbuddy::load_script( 'jquery-ui-core' );
pb_backupbuddy::load_script( 'jquery-ui-widget' );
pb_backupbuddy::load_script( 'backupbuddy.min.js' );
pb_backupbuddy::load_style( 'backupbuddy-core.css' );

pb_backupbuddy::load_style( 'backupProcess.css' );
pb_backupbuddy::load_style( 'backupProcess2.css' );

// Destinations may hide the add and test buttons by altering these variables.
global $pb_hide_save;
global $pb_hide_test;
$pb_hide_save = false;
$pb_hide_test = false;
$mode         = 'destination';

$picker_url = pb_backupbuddy::ajax_url( 'destinationTabs' );
if ( 'migration' == $mode ) {
	$picker_url = pb_backupbuddy::ajax_url( 'migration_picker' );
} elseif ( pb_backupbuddy::_GET( 'tab' ) ) {
	$picker_url .= pb_backupbuddy::_GET( 'tab' );
}
?>

<script>
	jQuery(function() {

		jQuery( '.tab.add-new a' ).on( 'click', function(){
			jQuery( '.bb_destinations-adding' ).hide();
			jQuery( '.bb_destinations' ).show();
		});

		jQuery( '.bb_destination-new-item a' ).click( function(e){
			e.preventDefault();

			if ( jQuery(this).parent('.bb_destination-item').hasClass('bb_destination-item-disabled') ) {
				alert( 'Error #848448: This destination is not available on your server.' );
				return false;
			}

			sendURL = '<?php echo pb_backupbuddy::ajax_url( 'destination_picker' ); ?>&add=' + jQuery(this).attr('rel') + '&filter=' + jQuery(this).attr('rel') + '&callback_data=' + jQuery('#pb_backupbuddy_archive_send').attr('rel') + '&sending=0';
			jQuery.post( sendURL,
				function(data) {
					data = jQuery.trim( data );
					jQuery( '.bb_destinations' ).hide();
					jQuery( '.bb_destinations-adding' ).html( data ).show();
				}
			);
		});

		// Save a remote destination settings.
		jQuery( '.pb_backupbuddy_destpicker_save' ).click( function(e) {
			e.preventDefault();

			var pb_remote_id = jQuery(this).closest('.backupbuddy-destination-wrap').attr('data-destination_id');
			var new_title = jQuery(this).closest('form').find( '#pb_backupbuddy_title' ).val();
			var configToggler = jQuery(this).closest('.backupbuddy-destination-wrap').find('.backupbuddy-destination-config');
			jQuery(this).closest('form').find( '.pb_backupbuddy_destpicker_saveload' ).show();
			jQuery.post( '<?php echo pb_backupbuddy::ajax_url( 'remote_save' ); ?>&pb_backupbuddy_destinationid=' + pb_remote_id, jQuery(this).parent( 'form' ).serialize(),
				function(data) {
					//data = jQuery.trim( data );

					if ( data.success ) {
						if ( 'added' === data.status ) {
							<?php if ( pb_backupbuddy::_GET( 'quickstart' ) != '' ) { ?>
								var win = window.dialogArguments || opener || parent || top;
								win.pb_backupbuddy_quickstart_destinationselected();
								win.tb_remove();
								return false;
							<?php } ?>

							window.location.href = '<?php echo $picker_url . '&callback_data=' . pb_backupbuddy::_GET( 'callback_data' ); ?>&sending=<?php echo pb_backupbuddy::_GET( 'sending' ); ?>&alert_notice=' + encodeURIComponent( 'New destination successfully added.' );
						} else if ( 'saved' === data.status ) {
							jQuery( '.pb_backupbuddy_destpicker_saveload' ).hide();
							jQuery( '.nav-tab-active' ).find( '.destination_title' ).text( new_title );
							configToggler.toggle();
							configToggler.closest('.backupbuddy-destination-wrap').find( 'iframe' ).attr( 'src', function ( i, val ) { return val; }); // Refresh iframe.
						}
					} else {
						jQuery( '.pb_backupbuddy_destpicker_saveload' ).hide();
						alert( "Error: \n\n" + data.error );
					}

				}
			);

			return false;
		} );

		// Test a remote destination.
		jQuery( '.pb_backupbuddy_destpicker_test' ).click( function(e) {
			e.preventDefault();

			jQuery(this).children( '.pb_backupbuddy_destpicker_testload' ).show();
			jQuery.post( '<?php echo pb_backupbuddy::ajax_url( 'remote_test' ); ?>', jQuery(this).parent( 'form' ).serialize(),
				function(data) {
					jQuery( '.pb_backupbuddy_destpicker_testload' ).hide();
					data = jQuery.trim( data );
					alert( data );
				}
			);

			return false;
		} );

		// Delete a remote destination settings.
		jQuery( '.pb_backupbuddy_destpicker_delete' ).click( function(e) {
			e.preventDefault();

			if ( !confirm( 'Are you sure you want to delete this destination?' ) ) {
				return false;
			}

			var pb_remote_id = jQuery(this).closest('.backupbuddy-destination-wrap').attr('data-destination_id');
			jQuery.post( '<?php echo pb_backupbuddy::ajax_url( 'remote_delete' ); ?>&pb_backupbuddy_destinationid=' + pb_remote_id, jQuery(this).parent( 'form' ).serialize(),
				function(data) {
					data = jQuery.trim( data );

					if ( data == 'Destination deleted.' ) {

						window.location.href = '<?php echo $picker_url . '&callback_data=' . pb_backupbuddy::_GET( 'callback_data' ); ?>&sending=<?php echo pb_backupbuddy::_GET( 'sending' ); ?>&alert_notice=' + encodeURIComponent( 'Destination deleted.' );

					} else { // Show message if not success.

						alert( 'Error #82724. Details: `' + data + '`.' );

					}

				}
			);

			return false;
		} );

		jQuery( '.bb_destination_config_icon' ).on( 'click', function(e){
			e.preventDefault();
			jQuery( '.backupbuddy-destination-wrap[data-destination_id="' + jQuery(this).attr('data-id') + '"]' ).find( '.backupbuddy-destination-config' ).toggle();
		});

	});
</script>

<?php
$active_tab = pb_backupbuddy::_GET( 'tab' );

echo '<div class="backupbuddy-tabs">';

echo '<ul class="tab-controls">';

$first = true;
foreach ( pb_backupbuddy::$options['remote_destinations'] as $destination_id => $destination ) {
	if ( 'live' == $destination['type'] ) { // Hide Live from tab listing.
		continue;
	}

	$href             = '#destination-' . $destination['type'] . '-' . $destination_id;
	$title_style      = '';
	$hover_title_text = __( 'Destination type', 'it-l10n-backupbuddy' ) . ': ' . $destination['type'] . '. ID: ' . $destination_id;
	if ( isset( $destination['disabled'] ) && '1' == $destination['disabled'] ) {
		$title_style       = 'text-decoration: line-through';
		$hover_title_text .= ' [' . __( 'DISABLED', 'it-l10n-backupbuddy' ) . ']';
	}
	$label = '<span title="' . esc_attr( $hover_title_text ) . '" class="destination_title" style="' . esc_attr( $title_style ) . '">' . esc_html( $destination['title'] ) . '<span class="bb_destination_config_icon" data-id="' . esc_attr( $destination_id ) . '" title="Show configuration options"></span>';

	$class  = ' ' . sanitize_title( strip_tags( $label ) );
	$class .= ' type-' . esc_attr( $destination['type'] );
	if ( $active_tab ) {
		$class .= ( '#' . $active_tab === $href ) ? ' active' : '';
	} else {
		$class .= $first ? ' active' : '';
	}

	printf( '<li class="tab%s"><a href="%s">%s</a>', esc_attr( $class ), esc_attr( $href ), $label );
	$first = false;
}

if ( false === apply_filters( 'itbub_disable_add_destination_tab', false ) ) {
	$add_href  = '#add';
	$add_label = esc_html__( 'Add New', 'it-l10n-backupbuddy' );
	$add_class = ' add-new';
	if ( '#' . $active_tab === $add_href ) {
		$add_class .= ' active';
	} elseif ( $first ) {
		$add_class .= ' active';
	}
	printf( '<li class="tab%s"><a href="%s">%s</a>', esc_attr( $add_class ), esc_attr( $add_href ), $add_label );
}

echo '</ul>';


if ( '' != pb_backupbuddy::_GET( 'alert_notice' ) ) {
	pb_backupbuddy::alert( htmlentities( pb_backupbuddy::_GET( 'alert_notice' ) ) );
}

$first = true;
foreach ( pb_backupbuddy::$options['remote_destinations'] as $destination_id => $destination ) {
	if ( 'live' == $destination['type'] ) { // Hide Live from tab listing.
		continue;
	}

	$tab_id = 'destination-' . $destination['type'] . '-' . $destination_id;
	$class  = ( ( ! $active_tab && $first ) || $tab_id === $active_tab ) ? ' active' : '';
	printf( '<div id="%s" class="tab-contents%s">', esc_attr( $tab_id ), esc_attr( $class ) );

	echo '<div class="backupbuddy-destination-wrap" data-destination_id="' . esc_attr( $destination_id ) . '">';

	// SETTINGS CONFIG FORM.
	echo '<div class="backupbuddy-destination-config" style="display: none;">';
	echo '<h3 style="margin-left: 0;">' . esc_html__( 'Destination Settings', 'it-l10n-backupbuddy' ) . '</h3>';
	$settings = pb_backupbuddy_destinations::configure( $destination, 'edit', $destination_id );
	if ( false === $settings ) {
		echo 'Error #556656b. Unable to display configuration. This destination\'s settings may be corrupt. Removing this destination. Please refresh the page.';
		unset( pb_backupbuddy::$options['remote_destinations'][ $destination_id ] );
		pb_backupbuddy::save();
	} else {
		$test_button = '';
		if ( true !== $pb_hide_test ) {
			$test_button = '<a href="#" class="button secondary-button pb_backupbuddy_destpicker_test" href="#" title="Test destination settings.">Test Settings<img class="pb_backupbuddy_destpicker_testload" src="' . pb_backupbuddy::plugin_url() . '/images/loading.gif" title="Testing... This may take several seconds..."></a>';
		}
		if ( false === apply_filters( 'itbub_disable_delete_destination_button', false ) ) :
			$save_and_delete_button = '<a href="#" class="button secondary-button pb_backupbuddy_destpicker_delete" href="javascript:void(0)" title="Delete this Destination">Delete Destination</a>';
		endif;
		echo $settings->display_settings(
			'Save Settings', // title.
			$save_and_delete_button . '&nbsp;&nbsp;' . $test_button . '&nbsp;&nbsp;', // before.
			' <img class="pb_backupbuddy_destpicker_saveload" src="' . pb_backupbuddy::plugin_url() . '/images/loading.gif" title="Saving... This may take a few seconds...">', // after.
			'pb_backupbuddy_destpicker_save' // class.
		);
	}
	echo '</div><!-- .backupbuddy-destination-config -->';

	$url = pb_backupbuddy::ajax_url( 'remoteClient' ) . '&destination_id=' . $destination_id;
	echo '<iframe id="pb_backupbuddy_iframe-dest-' . esc_attr( $destination_id ) . '" src="' . esc_attr( $url ) . '" width="100%" height="3000" frameBorder="0">Error #4584594579. Browser not compatible with iframes.</iframe>';
	echo '</div><!-- .backupbuddy-destination-wrap -->';

	echo '</div><!-- #' . esc_html( $tab_id ) . '-->';

	$first = false;
}

printf( '<div id="add" class="tab-contents%s">', ( 'add' === $active_tab || $first ? ' active' : '' ) );

$destination_type = pb_backupbuddy::_GET( 'add' );

require_once pb_backupbuddy::plugin_path() . '/destinations/bootstrap.php';
?>
<div class="bb_destinations" style="display: block; margin: 0;">
	<div class="bb_destinations-group bb_destinations-new" style="display: block;">
		Backups are by default stored in your local backup directory<?php pb_backupbuddy::tip( backupbuddy_core::getBackupDirectory() ); ?> configured on the Settings page.
		<br>
		You may also send backups to additional remote destinations or directories for safe keeping & redundancy.
		<br><br>

		<h2>What kind of destination do you want to add?</h2><br>
		<ul>
			<?php
			$best_count   = 0;
			$normal_count = 0;
			$legacy_count = 0;
			$best         = '';
			$normal       = '';
			$legacy       = '';

			foreach ( pb_backupbuddy_destinations::get_destinations_list( true ) as $destination_name => $destination ) {
				// Hide Live from Remote Destinations page.
				if ( 'live' == $destination['type'] ) {
					continue;
				}
				if ( empty( $destination['name'] ) ) {
					continue;
				}

				$disable_class = '';
				if ( true !== $destination['compatible'] ) {
					$disable_class = 'bb_destination-item-disabled';
				}

				$this_dest  = '';
				$this_dest .= '<li class="bb_destination-item bb_destination-' . $destination_name . ' bb_destination-new-item ' . $disable_class . '">';
				if ( 'stash3' == $destination_name ) {
					$this_dest .= '<div class="bb-ribbon"><span>New</span></div>';
				}
				$this_dest .= '<a href="javascript:void(0)" rel="' . $destination_name . '">';
				$this_dest .= $destination['name'];
				if ( true !== $destination['compatible'] ) {
					$this_dest .= ' [Unavailable; ' . $destination['compatibility'] . ']';
				}
				$this_dest .= '</a></li>';

				$category = isset( $destination['category'] ) ? $destination['category'] : false;

				if ( 'best' === $category ) {
					$best .= $this_dest;
					$best_count++;
					if ( $best_count > 4 ) {
						$best      .= '<span class="bb_destination-break"></span>';
						$best_count = 0;
					}
				} elseif ( 'legacy' === $category ) {
					$legacy .= $this_dest;
					$legacy_count++;
					if ( $legacy_count > 4 ) {
						$legacy      .= '<span class="bb_destination-break"></span>';
						$legacy_count = 0;
					}
				} elseif ( 'normal' === $category ) {
					$normal .= $this_dest;
					$normal_count++;
					if ( $normal_count > 4 ) {
						$normal      .= '<span class="bb_destination-break"></span>';
						$normal_count = 0;
					}
				}
			}

			echo '<h3>' . esc_html__( 'Preferred', 'it-l10n-backupbuddy' ) . '</h3>' . $best;
			echo '<br><br><hr style="max-width: 1200px;"><br>';
			echo '<h3>' . esc_html__( 'Normal', 'it-l10n-backupbuddy' ) . '</h3>' . $normal;
			echo '<br><br><hr style="max-width: 1200px;"><br>';
			echo '<h3>' . esc_html__( 'Legacy', 'it-l10n-backupbuddy' ) . '</h3>' . $legacy;

			echo '<br><br><hr style="max-width: 1200px;"><br>';
			?>
		</ul>

		<h3><?php esc_html_e( 'Discontinued', 'it-l10n-backupbuddy' ); ?></h3>
		<br>
		<span class="description"><?php esc_html_e( 'Stash (v1), Dropbox (v1), and AmazonS3 (v1) destinations have been discontinued as these legacy APIs have been discontinued by their providers. Please use their newer respective versions instead.', 'it-l10n-backupbuddy' ); ?></span>
	</div>
</div>
<div class="bb_destinations-adding"></div>
<?php
echo '</div><!-- #add.tab -->';

echo '</div><!-- .tabs-container -->';
echo '</div><!-- .backupbuddy-tabs -->';

pb_backupbuddy::$ui->ajax_footer();
die();
