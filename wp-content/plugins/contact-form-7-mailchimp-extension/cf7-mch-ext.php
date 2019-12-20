<?php
/*
Plugin Name: Contact Form 7 Extension For Mailchimp
Plugin URI: http://renzojohnson.com/contributions/contact-form-7-mailchimp-extension
Description: Integrate Contact Form 7 with Mailchimp. Automatically add form submissions to predetermined lists in Mailchimp, using its latest API.
Author: Renzo Johnson
Author URI: http://renzojohnson.com
Text Domain: contact-form-7
Domain Path: /languages/
Version: 0.5.10
*/

/*  Copyright 2013-2019 Renzo Johnson (email: renzojohnson at gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

if ( ! defined( 'SPARTAN_MCE_VERSION' ) ) {

		define( 'SPARTAN_MCE_VERSION', '0.5.10' );
		define( 'SPARTAN_MCE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		define( 'SPARTAN_MCE_PLUGIN_NAME', trim( dirname( SPARTAN_MCE_PLUGIN_BASENAME ), '/' ) );
		define( 'SPARTAN_MCE_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );
		define( 'SPARTAN_MCE_PLUGIN_URL', untrailingslashit( plugins_url( '', __FILE__ ) ) );

}

require_once( SPARTAN_MCE_PLUGIN_DIR . '/lib/mailchimp.php' );

if ( ! function_exists ( 'mc_meta_links'  ) ) {

	function mc_meta_links( $links, $file ) {
			if ( $file === 'contact-form-7-mailchimp-extension/cf7-mch-ext.php' ) {
					$links[] = '<a href="'.MCE_URL.'" target="_blank" title="ChimpMatic Lite Documentation">ChimpMatic Documentation</a>';
					// $links[] = '<a href="'.MCE_URL.'" target="_blank" title="Starter Guide">Starter Guide</a>';
					$links[] = '<a href="//www.paypal.me/renzojohnson" target="_blank" title="Donate"><strong>Donate</strong></a>';
			}
			return $links;
	}

}

add_filter( 'plugin_row_meta', 'mc_meta_links', 10, 2 );

if ( ! function_exists ( 'mc_settings_link'  ) ) {

	function mc_settings_link( $links ) {
    $url = get_admin_url() . 'admin.php?page=wpcf7&post='.mc_get_latest_item().'&active-tab=4' ;
    $settings_link = '<a href="' . $url . '" title="ChimpMatic.com">' . __('ChimpMatic Settings', 'textdomain') . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
 }

}

if ( ! function_exists ( 'mc_after_setup_theme'  ) ) {

	function mc_after_setup_theme() {
			 add_filter('plugin_action_links_' . SPARTAN_MCE_PLUGIN_BASENAME, 'mc_settings_link');
	}
	add_action ('after_setup_theme', 'mc_after_setup_theme');

}

// register_activation_hook(__FILE__,'mce_help');


add_filter( 'cron_schedules', 'mce_cron_schedules');

if ( ! function_exists ( 'mce_cron_schedules'  ) ) {

	function mce_cron_schedules( $schedules ) {

			 $schedules['weekly'] = array(
					'interval' => 604800, // segundos en una semana
					'display' => __( 'Weekly', 'mce-textdomain' ) //nombre del intervalo
			 );

			 $schedules['monthly'] = array(
					'interval' => 2592000, // segundos en 30 dias
					'display' => __( 'Monthly', 'mce-textdomain' ) // nombre del intervalo
			 );

			$schedules['12hours'] = array(
					'interval' => 43200, // segundos en 12 horas --43200
					'display' => __( '12hours', 'mce-textdomain' ) // nombre del intervalo
			 );

			 $schedules['5min'] = array(
					'interval' => 300, // segundos en 5 minutos
					'display' => __( '5min', 'mce-textdomain' ) // nombre del intervalo
			 );

			 $schedules['4days'] = array(
					'interval' => 345600, // cada 4 dias.
					'display' => __( '4days', 'mce-textdomain' ) // nombre del intervalo
			 );

			 return $schedules;
	}

}

register_activation_hook( __FILE__, 'mce_plugin_scrool' );

if ( ! function_exists ( 'mce_plugin_scrool'  ) ) {

	function mce_plugin_scrool() {

			if( ! wp_next_scheduled( 'mce_12hours_cron_job' ) ) {
					wp_schedule_event( current_time( 'timestamp' ), '12hours', 'mce_12hours_cron_job' );
			}

			if( ! wp_next_scheduled( 'mce_4days_cron_job' ) ) {
					wp_schedule_event( current_time( 'timestamp' ), '4days', 'mce_4days_cron_job' );
			}

		 //include SPARTAN_MCE_PLUGIN_DIR . '/lib/install-wp-plugins.php' ;

	}

}

add_action( 'mce_12hours_cron_job', 'mce_do_this_job_12hours' );
//(add_action( 'mce_4days_cron_job', 'mce_do_this_job_4days' ) ;

if ( ! function_exists ( 'mce_do_this_job_12hours'  ) ) {

	function mce_do_this_job_12hours() {
			if ( get_site_option('mce_show_update_news') == null  )
					add_site_option( 'mce_show_update_news', 1 ) ;
			else  {
				 $check = 0 ;
				 $tittle = '' ;
				 $message = mce_get_postnotice ($check,$tittle) ;
				 if ( $check == 1 ) {
						update_site_option('mce_show_update_news', 1);
						update_site_option('mce_conten_panel_master', $message) ;
						update_site_option('mce_conten_tittle_master', $tittle) ;  ;
				 }

				 if ( get_site_option('mce_conten_panel_welcome') != null ) {

						$check = 0 ;
						$tittle = '' ;
						$banner = mce_get_bannerladilla ($check,$tittle) ;
						update_site_option('mce_conten_panel_welcome', $banner) ;

						$check = 0 ;
						$tittle = '' ;
						$bannerlat = mce_get_bannerlateral ($check,$tittle) ;
						update_site_option('mce_conten_panel_lateralbanner', $bannerlat) ;

				 }

			}

			$chimp_db_logdb = new chimp_db_log( 'mce_db_issues', 1,'api' );
			$res = $chimp_db_logdb->chimp_log_delete_db() ;

			//stats
			$dat = getdate () ;
			 if ( $dat["wday"] == 4 or $dat["wday"] == 7 ) {
				 mce_do_this_job_4days() ;
			 }

	}

}

if ( ! function_exists ( 'mce_do_this_job_4days'  ) ) {

	function mce_do_this_job_4days() {

		$mce_sents = ( is_null ( get_option( 'mce_sent') ) )? 0 : get_option( 'mce_sent')  ;
		$diasdifer = mce_diferdays_dateact_date() ;
		$diasdifer = ( is_null ( $diasdifer ) ) ? 0 : $diasdifer ;

		$aa =   $mce_sents ;
		//sents
		switch ( $aa ) {
			case 0  :
				$labelping = '0 sends';
				break;

			case  ( $aa > 0 and $aa < 100 ) :
				$labelping = '1 - 99';
				break;

			case ( $aa > 99 and $aa < 300 ):
				$labelping = '100 - 299';
				break;

			case ( $aa > 299 and $aa < 600 ):
				$labelping = '300-599';
				break;

			case ( $aa > 599 and $aa < 1000 ):
				$labelping = '600-999';
				break;

			case ( $aa > 999  ):
				$labelping = '> 999';
				break;

			default :
				$labelping = 'unrecognosible';
				break;

		}

		$respanalitc = vc_ga_send_event('Mailchimp Extension', 'SENDS', $labelping);

		 //days
		$aa =   $diasdifer ;
		switch ( $aa ) {
			case 0  :
				$labelping = '0 days';
				break;

			case  ( $aa > 0 and $aa < 100 ) :
				$labelping = '1 - 99 days';
				break;

			case ( $aa > 99 and $aa < 300 ):
				$labelping = '100 - 299 days';
				break;

			case ( $aa > 299 and $aa < 600 ):
				$labelping = '300-599 days';
				break;

			case ( $aa > 599 and $aa < 1000 ):
				$labelping = '600-999 days';
				break;

			case ( $aa > 999  ):
				$labelping = '> 999 days';
				break;

			default :
				$labelping = 'unrecognosite';
				break;

		}

		$respanalitc = vc_ga_send_event('Mailchimp Extension', 'DAYS ACTIVATED', $labelping);


	}

}

register_deactivation_hook( __FILE__, 'mce_plugin_deactivation' );


if ( ! function_exists ( 'mce_plugin_deactivation'  ) ) {

	function mce_plugin_deactivation() {

			wp_clear_scheduled_hook( 'mce_12hours_cron_job' );
			wp_clear_scheduled_hook( 'mce_5min_cron_job' );
			wp_clear_scheduled_hook( 'mce_4days_cron_job' );
			delete_site_option( 'mce_show_update_news' );
	}

}




// $errores = error_get_last() ;
// $cuenta = is_array ( $errores ) ? count ($errores) : 0 ;

// $chimp_db_log = new chimp_db_log( 'mce_db_issues', 6,'php' );
// $msgerr = $errores ;

// if ( $cuenta !== 0 ) {

// 		if (is_array($msgerr) || is_object($msgerr)) {
// 				$chimp_db_log->chimp_log_insert_db(1, 'Error php response :', $msgerr  ) ;
// 		} else {
// 				$chimp_db_log->chimp_log_insert_db(1, 'Error php response :' . $msgerr, ''  ) ;
// 			}

// }


if (!function_exists('write_log')) {

    function write_log($log) {
        if (true === WP_DEBUG) {
            if (is_array($log) || is_object($log)) {

            } else {

            }
        }
    }

}


