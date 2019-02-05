<?php

$ad_spot_id = td_util::get_http_post_val('ad_spot_id');

if (empty($ad_spot_id)) {
	$ad_spot_id = td_global::$current_ad_id;

	if (!isset($ad_spot_id)) {
		return;
	}
}

$ad_fields = td_api_ad::get_key( $ad_spot_id, 'fields' );

$ad_field_code_title = 'YOUR AD CODE';
$ad_field_code_description = 'Paste your ad code here. Google AdSense will be made responsive automatically.';

// ad_field_notice - if is present => it is shown
// all other fields - (if is present and not 'false') or it is not preset => it is shown
if (isset($ad_fields['ad_field_notice']) && $ad_fields['ad_field_notice'] !== false) {
	?>
	<div class="td-box-row">
		<div class="td-box-description td-box-full">
			<span class="td-box-title">Notice:</span>
			<p>
				<?php
					echo $ad_fields['ad_field_notice'];
				?>
			</p>
		</div>
		<div class="td-box-row-margin-bottom"></div>
	</div>
<?php
}


if (!isset($ad_fields['ad_field_code']) || (isset($ad_fields['ad_field_code']) && $ad_fields['ad_field_code'] !== false)) {
	?>

	<!-- ad box code -->
	<div class="td-box-row">
		<div class="td-box-description">
        <span class="td-box-title">
	        <?php
	        if ( isset( $ad_fields['ad_field_code']['title'] ) ) {
		        echo $ad_fields['ad_field_code']['title'];
	        } else {
		        echo $ad_field_code_title;
	        }
	        ?>
        </span>

			<p>
				<?php
				if ( isset( $ad_fields['ad_field_code']['desc'] ) ) {
					echo $ad_fields['ad_field_code']['desc'];
				} else {
					echo $ad_field_code_description;
				}
				?>
			</p>
		</div>
		<div class="td-box-control-full">
			<?php
			echo td_panel_generator::textarea( array(
				'ds'        => 'td_ads',
				'item_id'   => $ad_spot_id,
				'option_id' => 'ad_code',
			) );
			?>
		</div>
	</div>

	<?php
}




if (!isset($ad_fields['ad_field_title']) || (isset($ad_fields['ad_field_title']) && $ad_fields['ad_field_title'] !== false)) {
	?>

	<!-- A title for the Ad-->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title">AD title:</span>

			<p>A title for the Ad, like - <strong>Advertisement</strong> - if you leave it blank the ad spot will
				not have a title</p>
		</div>
		<div class="td-box-control-full">
			<?php
			echo td_panel_generator::input( array(
				'ds'        => 'td_option',
				'option_id' => 'tds_' . $ad_spot_id . '_title'
			) );
			?>
		</div>
	</div>

	<?php
}



if (!isset($ad_fields['ad_field_after_paragraph']) || (isset($ad_fields['ad_field_after_paragraph']) && $ad_fields['ad_field_after_paragraph'] !== false)) {
	?>

	<!-- After paragraph  //alignment & after paragraph settings only for inline ads-->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title">AFTER PARAGRAPH:</span>

			<p>After how many paragraphs the ad will display. The theme will analyze the content of each post and it
				will inject an ad after the selected number of paragraphs</p>
		</div>
		<div class="td-box-control-full">
			<?php
			echo td_panel_generator::input( array(
				'ds'        => 'td_option',
				'option_id' => 'tds_inline_ad_paragraph'
			) );
			?>
		</div>
	</div>

	<?php
}


if (!isset($ad_fields['ad_field_position_content']) || (isset($ad_fields['ad_field_position_content']) && $ad_fields['ad_field_position_content'] !== false)) {
	?>

	<!-- DISPLAY VIEW -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title">AD POSITION IN CONTENT</span>
			<p>Ad position in content. Float left, full post width or float right.</p>
		</div>
		<div class="td-box-control-full td-panel-module">
			<?php
			$template_dir = get_template_directory();
			$template_dir_uri = get_template_directory_uri();
			$img_left = $template_dir . '/images/panel/ads/rec-left.png';
			$img_center = $template_dir . '/images/panel/ads/rec-center.png';
			$img_right = $template_dir . '/images/panel/ads/rec-right.png';

			if (file_exists($img_left)) {
				$img_left = $template_dir_uri . '/images/panel/ads/rec-left.png';
			} else {
				$img_left = $template_dir_uri . '/includes/wp_booster/wp-admin/images/panel/rec-left.png';
			}

			if (file_exists($img_center)) {
				$img_center = $template_dir_uri . '/images/panel/ads/rec-center.png';
			} else {
				$img_center = $template_dir_uri . '/includes/wp_booster/wp-admin/images/panel/rec-center.png';
			}

			if (file_exists($img_right)) {
				$img_right = $template_dir_uri . '/images/panel/ads/rec-right.png';
			} else {
				$img_right = $template_dir_uri . '/includes/wp_booster/wp-admin/images/panel/rec-right.png';
			}

			echo td_panel_generator::visual_select_o(array(
				'ds' => 'td_option',
				'option_id' => 'tds_inline_ad_align',
				'values' => array(
					array('text' => '', 'title' => 'Left', 'val' => 'left', 'img' => $img_left),
					array('text' => '', 'title' => 'Full Width', 'val' => '', 'img' => $img_center),
					array('text' => '', 'title' => 'Right', 'val' => 'right', 'img' => $img_right)
				)
			));
			?>
		</div>
	</div>

<?php
}


if (!isset($ad_fields['ad_field_advantage_usage']) || (isset($ad_fields['ad_field_advantage_usage']) && $ad_fields['ad_field_advantage_usage'] !== false)) {
	?>
	<div class="td-box-row">
		<div class="td-box-description td-box-full">
			<span class="td-box-title">Advance usage:</span>

			<p>
				<?php
				if ( isset( $ad_fields['ad_field_advantage_usage'] ) ) {
					echo $ad_fields['ad_field_advantage_usage'];
				} else {
					//echo 'If you leave the AdSense size boxes on Auto, the theme will automatically resize the <strong>google ads</strong>. For more info follow this <a href="http://forum.tagdiv.com/header-ad/" target="_blank">link</a>';
					echo 'If you leave the AdSense size boxes on Auto, the theme will automatically resize the <strong>Google Ads</strong>.';
				}
				?>
			</p>
		</div>
		<div class="td-box-row-margin-bottom"></div>
	</div>
<?php
}


if (!isset($ad_fields['ad_field_desktop']) || (isset($ad_fields['ad_field_desktop']) && $ad_fields['ad_field_desktop'] !== false)) {
	?>

	<!-- disable ad on monitor -->
	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title td-title-on-row">DISABLE ON DESKTOP</span>

			<p></p>
		</div>
		<div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox( array(
	            'ds'          => 'td_ads',
	            'item_id'     => $ad_spot_id,
	            'option_id'   => 'disable_m',
	            'true_value'  => 'yes',
	            'false_value' => ''
            ) );
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense size: </span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown( array(
	                    'ds'        => 'td_ads',
	                    'item_id'   => $ad_spot_id,
	                    'option_id' => 'm_size',
	                    'values'    => td_panel_generator::$google_ad_sizes
                    ) );
                    ?>
            </span>

		</div>
	</div>

<?php
}
?>

<!-- disable ad on tablet landscape -->
<?php
if (!isset($ad_fields['ad_field_landscape']) || (isset($ad_fields['ad_field_landscape']) && $ad_fields['ad_field_landscape'] !== false)) {
	?>

	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title td-title-on-row">DISABLE ON TABLET LANDSCAPE</span>

			<p></p>
		</div>
		<div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox( array(
	            'ds'          => 'td_ads',
	            'item_id'     => $ad_spot_id,
	            'option_id'   => 'disable_tl',
	            'true_value'  => 'yes',
	            'false_value' => ''
            ) );
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense size: </span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown( array(
	                    'ds'        => 'td_ads',
	                    'item_id'   => $ad_spot_id,
	                    'option_id' => 'tl_size',
	                    'values'    => td_panel_generator::$google_ad_sizes
                    ) );
                    ?>
            </span>

		</div>
	</div>

<?php
}
?>


<!-- disable ad on tablet portrait -->
<?php
if (!isset($ad_fields['ad_field_portrait']) || (isset($ad_fields['ad_field_portrait']) && $ad_fields['ad_field_portrait'] !== false)) {
	?>

	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title td-title-on-row">DISABLE ON TABLET PORTRAIT</span>

			<p></p>
		</div>
		<div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox( array(
	            'ds'          => 'td_ads',
	            'item_id'     => $ad_spot_id,
	            'option_id'   => 'disable_tp',
	            'true_value'  => 'yes',
	            'false_value' => ''
            ) );
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense size: </span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown( array(
	                    'ds'        => 'td_ads',
	                    'item_id'   => $ad_spot_id,
	                    'option_id' => 'tp_size',
	                    'values'    => td_panel_generator::$google_ad_sizes
                    ) );
                    ?>
            </span>

		</div>
	</div>

<?php
}
?>


<!-- disable ad on phones -->
<?php
if (!isset($ad_fields['ad_field_phone']) || (isset($ad_fields['ad_field_phone']) && $ad_fields['ad_field_phone'] !== false)) {
	?>

	<div class="td-box-row">
		<div class="td-box-description">
			<span class="td-box-title">DISABLE ON PHONE</span>

			<p>
				<?php
				if ( isset( $ad_fields['ad_field_phone']['desc'] ) ) {
					echo $ad_fields['ad_field_phone']['desc'];
				}
				?>
			</p>
		</div>
		<div class="td-box-control-full">
            <span>
            <?php
            echo td_panel_generator::checkbox( array(
	            'ds'          => 'td_ads',
	            'item_id'     => $ad_spot_id,
	            'option_id'   => 'disable_p',
	            'true_value'  => 'yes',
	            'false_value' => ''
            ) );
            ?>
            </span>
            <span class="td-content-float-right td_float_clear_both td-content-padding-right-40">
                <span class="td-content-padding-right-40 td-adsense-size">AdSense size: </span>
                <span class="td-content-float-right">
                    <?php
                    echo td_panel_generator::dropdown( array(
	                    'ds'        => 'td_ads',
	                    'item_id'   => $ad_spot_id,
	                    'option_id' => 'p_size',
	                    'values'    => td_panel_generator::$google_ad_sizes
                    ) );
                    ?>
            </span>
		</div>
	</div>

<?php
}
?>