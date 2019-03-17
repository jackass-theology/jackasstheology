<?php

namespace DeliciousBrains\WPMDBCli;

use DeliciousBrains\WPMDB\Common\BackupExport;
use DeliciousBrains\WPMDB\Common\Cli\CliManager;
use DeliciousBrains\WPMDB\Common\Error\ErrorLog;
use DeliciousBrains\WPMDB\Common\FormData\FormData;
use DeliciousBrains\WPMDB\Common\Http\Helper;
use DeliciousBrains\WPMDB\Common\Migration\FinalizeMigration;
use DeliciousBrains\WPMDB\Common\Migration\InitiateMigration;
use DeliciousBrains\WPMDB\Common\Migration\MigrationManager;
use DeliciousBrains\WPMDB\Common\MigrationState\MigrationStateManager;
use DeliciousBrains\WPMDB\Common\Multisite;
use DeliciousBrains\WPMDB\Common\Properties\DynamicProperties;
use DeliciousBrains\WPMDB\Common\Properties\Properties;
use DeliciousBrains\WPMDB\Common\Sql\Table;
use DeliciousBrains\WPMDB\Common\Util\Util;
use DeliciousBrains\WPMDB\Pro\Cli\Export;
use DeliciousBrains\WPMDB\Pro\Import;
use DeliciousBrains\WPMDB\Pro\Migration\Connection;

class Cli extends Export {

	/**
	 * Instance of WPMDBPro.
	 *
	 * @var WPMDBPro
	 */
	protected $wpmdbpro;

	/**
	 * Delay Between Requests
	 *
	 * @var delay_between_requests
	 */
	protected $delay_between_requests = 0;

	/* remote connection info */
	protected $remote;
	protected $migration;
	/**
	 * @var Connection
	 */
	private $connection;
	/**
	 * @var BackupExport
	 */
	private $backup_export;
	/**
	 * @var Properties
	 */
	private $properties;
	/**
	 * @var Multisite
	 */
	private $multisite;
	/**
	 * @var Import
	 */
	private $import;
	/**
	 * @var DynamicProperties
	 */
	private $dynamic_properties;

	function __construct(
		FormData $form_data,
		Util $util,
		CliManager $cli_manager,
		Table $table,
		ErrorLog $error_log,
		InitiateMigration $initiate_migration,
		FinalizeMigration $finalize_migration,
		Helper $http_helper,
		MigrationManager $migration_manager,
		MigrationStateManager $migration_state_manager,
		Connection $connection,
		BackupExport $backup_export,
		Properties $properties,
		Multisite\Multisite $multisite,
		Import $import
	) {
		parent::__construct(
			$form_data,
			$util,
			$cli_manager,
			$table,
			$error_log,
			$initiate_migration,
			$finalize_migration,
			$http_helper,
			$migration_manager,
			$migration_state_manager
		);
		$this->connection         = $connection;
		$this->backup_export      = $backup_export;
		$this->properties         = $properties;
		$this->multisite          = $multisite;
		$this->import             = $import;
		$this->dynamic_properties = DynamicProperties::getInstance();
	}

	public function register() {
		parent::register();

		// extra profile fields
		add_filter( 'wpmdb_accepted_profile_fields', array( $this, 'accepted_profile_fields' ) );

		// announce extra args
		add_filter( 'wpmdb_cli_filter_get_extra_args', array( $this, 'filter_extra_args' ), 10, 1 );

		// process push/pull profile args
		add_filter( 'wpmdb_cli_filter_get_profile_data_from_args', array( $this, 'add_extra_args_for_addon_migrations' ), 10, 3 );

		// add backup tables
		add_filter( 'wpmdb_cli_filter_before_migrate_tables', array( $this, 'backup_before_migrate_tables' ), 10, 1 );

		// extend cli_migration with push/pull functionality
		add_filter( 'wpmdb_cli_filter_before_cli_initiate_migration', array( $this, 'extend_cli_migration' ), 10, 2 );

		// extend get_tables to migrate with push/pull functionality
		add_filter( 'wpmdb_cli_tables_to_migrate', array( $this, 'extend_tables_to_migrate' ), 10, 1 );

		//extend get_row_counts_from_table_list with remote tables if necessary
		add_filter( 'wpmdb_cli_get_row_counts_from_table_list', array( $this, 'get_push_pull_row_counts' ), 10, 2 );

		// check for wpmdbpro version
		add_filter( 'wpmdb_cli_profile_before_migration', array( $this, 'check_wpmdbpro_version_before_migration' ), 10, 1 );

		// enable profile migrations
		add_filter( 'wpmdb_cli_profile_before_migration', array( $this, 'get_wpmdbpro_profile_before_migration' ), 10, 1 );

		// check for MF plugin locally
		add_filter( 'wpmdb_cli_profile_before_migration', array( $this, 'check_local_wpmdbpro_media_files_before_migration' ), 20, 1 );

		// check remote for MF plugin after remote connection has been made
		add_filter( 'wpmdb_cli_filter_before_cli_initiate_migration', array( $this, 'check_remote_wpmdbpro_media_files_before_migration' ), 20, 2 );

		// check remote for MST plugin after remote connection has been made
		add_filter( 'wpmdb_cli_filter_before_cli_initiate_migration', array( $this, 'check_remote_wpmdbpro_mst_before_migration' ), 20, 2 );

		// flush rewrite rules
		add_filter( 'wpmdb_cli_finalize_migration_response', array( $this, 'finalize_flush' ), 20, 2 );

		// add backup stage
		add_filter( 'wpmdb_cli_initiate_migration_args', array( $this, 'initate_migration_enable_backup' ), 10, 2 );

		// use remote tables for pull migration
		add_filter( 'wpmdb_cli_filter_source_tables', array( $this, 'set_remote_source_tables_for_pull' ), 10, 2 );

		// filter progress label for backup/migration
		add_filter( 'wpmdb_cli_progress_label', array( $this, 'modify_progress_label' ), 10, 2 );

		// pass through pro filter including remote
		add_filter( 'wpmdb_cli_finalize_migration', array( $this, 'apply_pro_cli_finalize_migration_filter' ), 10, 0 );

		// add delay between requests
		add_action( 'wpmdb_before_remote_post', array( $this, 'do_delay_between_requests' ), 10, 0 );
		add_action( 'wpmdb_media_files_cli_before_migrate_media', array( $this, 'do_delay_between_requests' ), 10, 0 );

		// Compare table prefixes and display error if mismatch
		add_action( 'wpmdb_cli_before_migration', array( $this, 'handle_prefix_mismatch' ), 10, 2 );

		// add import stage
		add_action( 'wpmdb_cli_during_cli_migration', array( $this, 'cli_import' ), 10, 2 );
	}

	/**
	 * Adds extra supported fields to the profile.
	 *
	 * @param $fields
	 *
	 * @return array
	 */
	public function accepted_profile_fields( $fields ) {
		$fields[] = 'import_file';

		return $fields;
	}

	/**
	 * Get profile by key.
	 *
	 * @since 1.1
	 *
	 * @param  int $key Profile key
	 *
	 * @return array|WP_Error If profile exists return array, otherwise WP_Error.
	 */
	public function get_profile_by_key( $key ) {
		$wpmdb_settings = get_site_option( 'wpmdb_settings' );
		-- $key;

		if ( ! isset( $wpmdb_settings['profiles'][ $key ] ) ) {
			return $this->cli_error( __( 'Profile ID not found.', 'wp-migrate-db-pro-cli' ) );
		}

		return $wpmdb_settings['profiles'][ $key ];
	}

	/**
	 * Retrieve information from the remote machine, e.g. tables, prefix, bottleneck, gzip, etc
	 *
	 * @return array
	 */
	function verify_remote_connection( $profile ) {
		do_action( 'wpmdb_cli_before_verify_connection_to_remote_site', $profile );

		\WP_CLI::log( __( 'Verifying connection...', 'wp-migrate-db-pro-cli' ) );

		$connection_info            = preg_split( '/\s+/', $profile['connection_info'] );
		$remote_site_args           = $this->post_data;
		$remote_site_args['intent'] = $profile['action'];
		$remote_site_args['url']    = trim( $connection_info[0] );
		$remote_site_args['key']    = trim( $connection_info[1] );
		$this->post_data            = apply_filters( 'wpmdb_cli_verify_connection_to_remote_site_args', $remote_site_args, $profile );

		$response = $this->verify_connection_to_remote_site( $this->post_data );

		$verified_response = $this->verify_cli_response( $response, 'ajax_verify_connection_to_remote_site()' );
		if ( ! is_wp_error( $verified_response ) ) {
			$verified_response = apply_filters( 'wpmdbpro_cli_verify_connection_response', $verified_response );
		}

		return $verified_response;
	}

	/**
	 * Stub for ajax_verify_connection_to_remote_site()
	 *
	 * @param array|bool $args
	 *
	 * @return array
	 */
	function verify_connection_to_remote_site( $args = false ) {
		$_POST    = $args;
		$response = $this->connection->ajax_verify_connection_to_remote_site();

		return $response;
	}

	/**
	 * Stub for ajax_flush()
	 *
	 * @param array|bool $args
	 *
	 * @return bool|null
	 */
	function flush( $args = false ) {
		$_POST    = $args;
		$response = $this->migration_manager->ajax_flush();

		return $response;
	}

	/**
	 * Add extra CLI args used by this plugin.
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	public function filter_extra_args( $args = array() ) {
		$args[] = 'preserve-active-plugins';
		$args[] = 'include-transients';
		$args[] = 'backup';
		$args[] = 'import-file';

		// TODO: Move following to WPMDBPro_Media_Files_CLI along with Media Files args parsing.
		$args[] = 'media';
		$args[] = 'media-subsites';

		return $args;
	}

	/**
	 * Extend get_profile_data_from_args with options for push/pull
	 * hooks on: wpmdb_cli_filter_get_profile_data_from_args
	 *
	 * @param array $profile
	 * @param array $args
	 * @param array $assoc_args
	 *
	 * @return array|WP_Error
	 */
	function add_extra_args_for_addon_migrations( $profile, $args, $assoc_args ) {
		if ( ! is_array( $profile ) ) {
			return $profile;
		}

		if ( in_array( $assoc_args['action'], array( 'push', 'pull' ) ) ) {
			if ( empty( $args[0] ) || empty( $args[1] ) ) {
				return $this->cli_error( __( 'URL and secret-key are required', 'wp-migrate-db-pro-cli' ) );
			}
			$connection_info = sprintf( '%s %s', $args[0], $args[1] );
		}

		if ( 'import' === $assoc_args['action'] ) {
			$import_file = $assoc_args['import-file'];
		}

		// --preserve-active-plugins
		$keep_active_plugins = intval( isset( $assoc_args['preserve-active-plugins'] ) );

		// --include-transients.
		$exclude_transients = intval( ! isset( $assoc_args['include-transients'] ) );

		// --backup.
		$create_backup = 0;
		$backup_option = 'backup_only_with_prefix';
		$select_backup = array( '' );
		if ( ! empty( $assoc_args['backup'] ) ) {
			$create_backup = 1;
			if ( ! in_array( $assoc_args['backup'], array( 'prefix', 'selected' ) ) ) {
				$backup_option = 'backup_manual_select';
				$select_backup = explode( ',', $assoc_args['backup'] );
			} elseif ( 'selected' === $assoc_args['backup'] ) {
				$backup_option = 'backup_selected';
			}
		}

		// TODO: move this to the media files cli codebase
		// --media
		$media_vars = array();
		if ( ! empty( $assoc_args['media'] ) ) {
			if ( ! class_exists( '\DeliciousBrains\WPMDBMF\MediaFilesAddon' ) ) {
				return $this->cli_error( __( 'The Media Files addon needs to be installed and activated to make use of this option', 'wp-migrate-db-pro-cli' ) );
			} else {
				if ( ! in_array( $assoc_args['media'], array( 'remove-and-copy', 'compare-and-remove', 'compare' ) ) ) {
					return $this->cli_error( __( '--media must be set to an acceptable value, see: wp help migratedb ' . $assoc_args['action'], 'wp-migrate-db-pro-cli' ) );
				}
				$media_files            = 1;
				$remove_local_media     = 0;
				$media_migration_option = ( 'remove-and-copy' == $assoc_args['media'] ) ? 'entire' : 'compare';

				if ( 'compare-and-remove' == $assoc_args['media'] ) {
					$remove_local_media = 1;
				}

				$media_vars = array( 'media_files', 'media_migration_option', 'remove_local_media' );
			}
		}

		// --media-subsites
		if ( isset( $assoc_args['media-subsites'] ) ) {
			if ( ! is_multisite() ) {
				return $this->cli_error( __( 'The --media-subsites option can only be used on a multisite install', 'wp-migrate-db-pro-cli' ) );
			}
			if ( empty( $assoc_args['media'] ) ) {
				return $this->cli_error( __( 'The --media-subsites option can only be used in conjunction with the --media option', 'wp-migrate-db-pro-cli' ) );
			}
			if ( empty( $assoc_args['media-subsites'] ) ) {
				return $this->cli_error( __( 'One or more valid Blog IDs or Subsite URLs must be supplied to make use of the --media-subsites option', 'wp-migrate-db-pro-cli' ) );
			}

			$mf_select_subsites   = 1;
			$mf_selected_subsites = str_getcsv( $assoc_args['media-subsites'] );

			$media_vars[] = 'mf_select_subsites';
			$media_vars[] = 'mf_selected_subsites';
		}

		$filtered_profile = compact(
			'connection_info',
			'exclude_transients',
			'keep_active_plugins',
			'create_backup',
			'backup_option',
			'select_backup',
			'import_file',
			$media_vars
		);

		return array_merge( $profile, $filtered_profile );
	}

	/**
	 * Add backup stage when selected
	 * hooks on: wpmdb_cli_filter_before_migrate_tables
	 *
	 * @param array $filter_vars
	 *
	 * @return array|WP_Error
	 */
	function backup_before_migrate_tables( $filter_vars ) {
		$this->post_data = $this->dynamic_properties->post_data;

		// No good reason this should happen, but lets not risk an undefined index warning
		if ( ! array_key_exists( 'tables', $filter_vars ) ) {
			return $filter_vars;
		}

		$tables = $filter_vars['tables'];

		if ( 'push' === $this->profile['action'] ) {
			$all_tables      = $this->remote['tables'];
			$prefixed_tables = $this->remote['prefixed_tables'];
		} else {
			$all_tables      = $this->table->get_tables();
			$prefixed_tables = $this->table->get_tables( 'prefix' );
		}

		$tables_to_backup = $this->backup_export->get_tables_to_backup( $this->profile, $prefixed_tables, $all_tables );
		if ( 'backup' == $this->post_data['stage'] &&
		     'backup_manual_select' == $this->profile['backup_option'] &&
		     array_diff( $this->profile['select_backup'], $tables_to_backup )
		) {
			return $this->cli_error( __( 'Invalid backup option or non-existent table selected for backup.', 'wp-migrate-db-pro-cli' ) );
		}

		$tables         = ( 'backup' == $this->post_data['stage'] ) ? $tables_to_backup : $tables;
		$stage_iterator = ( 'backup' == $this->post_data['stage'] ) ? 1 : 2;

		return compact( 'tables', 'stage_iterator' );
	}

	/**
	 * Extend cli_migration with push/pull
	 * hooks on: wpmdb_cli_filter_before_cli_initiate_migration
	 *
	 * @param array $profile
	 *
	 * @return array
	 */
	function extend_cli_migration( $profile, $post_data = [] ) {
		if ( ! in_array( $profile['action'], array( 'find_replace', 'savefile', 'import' ) ) ) {
			$this->remote = $this->verify_remote_connection( $profile );
			if ( is_wp_error( $this->remote ) ) {
				return $this->remote;
			}

			if ( ! empty( $post_data ) ) {
				$this->post_data = array_merge( $this->post_data, $post_data );
			}

			$this->post_data['gzip']       = ( '1' == $this->remote['gzip'] ) ? 1 : 0;
			$this->post_data['bottleneck'] = $this->remote['bottleneck'];
			$this->post_data['prefix']     = $this->remote['prefix'];

			$this->post_data['site_details']['remote'] = $this->remote['site_details'];

			// set delay between requests if remote has a delay
			if ( isset( $this->remote['delay_between_requests'] ) ) {
				$this->delay_between_requests = $this->remote['delay_between_requests'];
			}

			if ( ! empty( $this->remote['temp_prefix'] ) ) {
				$this->post_data['temp_prefix'] = $this->remote['temp_prefix'];
			}

			// Default the find/replace pairs if nothing specified so that we don't break the target.
			if ( empty( $profile['replace_old'] ) && empty( $profile['replace_new'] ) ) {
				$local  = array(
					'',
					preg_replace( '#^https?:#', '', home_url() ),
					$this->util->get_absolute_root_file_path(),
				);
				$remote = array(
					'',
					preg_replace( '#^https?:#', '', $this->remote['url'] ),
					$this->remote['path'],
				);

				if ( 'push' == $profile['action'] ) {
					$profile['replace_old'] = $local;
					$profile['replace_new'] = $remote;
				} else {
					$profile['replace_old'] = $remote;
					$profile['replace_new'] = $local;
				}
				unset( $local, $remote );

				$profile = apply_filters( 'wpmdb_cli_default_find_and_replace', $profile, $this->post_data );
			}
		}

		$this->dynamic_properties->post_data = $this->post_data;

		return $profile;
	}

	/**
	 * Return correct set of tables to migrate on push/pull migrations
	 * hooks on: wpmdb_cli_tables_to_migrate
	 *
	 * @param array $tables_to_migrate
	 *
	 * @return array
	 */
	function extend_tables_to_migrate( $tables_to_migrate ) {
		if ( null === $this->profile && ! empty( $this->dynamic_properties->profile ) ) {
			$this->profile = $this->dynamic_properties->profile;
		}

		if ( empty( $this->post_data ) && ! empty( $this->dynamic_properties->post_data ) ) {
			$this->post_data = $this->dynamic_properties->post_data;
		}

		if ( 'push' == $this->profile['action'] ) {
			if ( 'migrate_only_with_prefix' == $this->profile['table_migrate_option'] ) {
				$tables_to_migrate = $this->table->get_tables( 'prefix' );
			} elseif ( 'migrate_select' == $this->profile['table_migrate_option'] ) {
				$tables_to_migrate = array_intersect( $this->profile['select_tables'], $this->table->get_tables() );
			}
		} elseif ( 'pull' == $this->profile['action'] ) {
			if ( 'migrate_only_with_prefix' == $this->profile['table_migrate_option'] ) {
				$tables_to_migrate = $this->remote['prefixed_tables'];
			} elseif ( 'migrate_select' == $this->profile['table_migrate_option'] ) {
				$tables_to_migrate = array_intersect( $this->profile['select_tables'], $this->remote['tables'] );
			}
		} elseif ( 'import' === $this->profile['action'] && 'find_replace' === $this->post_data['stage'] ) {
			$temp_tables       = $this->table->get_tables( 'temp' );
			$tables_to_migrate = array();

			if ( isset( $this->profile['select_tables'] ) ) {
				$selected_tables = $this->profile['select_tables'];

				foreach ( $selected_tables as $table ) {
					if ( in_array( $this->properties->temp_prefix . $table, $temp_tables ) ) {
						$tables_to_migrate[] = $this->properties->temp_prefix . $table;
					}
				}
			} else {
				$tables_to_migrate = $temp_tables;
			}
		}

		return $tables_to_migrate;
	}

	/**
	 * Return correct row counts for stage/migration type
	 * hooks on: wpmdb_cli_get_row_counts_from_table_list
	 *
	 * @param array $cached_stage_results
	 * @param int   $stage
	 *
	 * @return array
	 */
	function get_push_pull_row_counts( $cached_stage_results, $stage ) {
		$migration_type    = $this->profile['action'];
		$local_table_rows  = $cached_stage_results;
		$remote_table_rows = $this->remote['table_rows'];

		if ( 1 === $stage ) { // 1 = backup stage, 2 = migration stage
			$cached_stage_results = ( 'push' === $migration_type ) ? $remote_table_rows : $local_table_rows;
		} else {
			$cached_stage_results = ( 'pull' === $migration_type ) ? $remote_table_rows : $local_table_rows;
		}

		return $cached_stage_results;
	}

	/**
	 * Error if WPMDBPro version is not compatible
	 * hooks on: wpmdb_cli_profile_before_migration
	 *
	 * @param array $profile
	 *
	 * @return array|WP_Error
	 */
	function check_wpmdbpro_version_before_migration( $profile ) {
		// TODO: maybe instantiate WPMDBPro_CLI_Addon to make WPMDBPro_Addon::meets_version_requirements() available here
		$wpmdb_pro_version = $GLOBALS['wpmdb_meta']['wp-migrate-db-pro']['version'];
		if ( ! version_compare( $wpmdb_pro_version, '1.8.3', '>=' ) ) {
			return $this->cli_error( __( 'Please update WP Migrate DB Pro.', 'wp-migrate-db-pro-cli' ) );
		}

		return $profile;
	}

	/**
	 * Get profile by key
	 * hooks on: wpmdb_cli_profile_before_migration
	 *
	 * @param array $profile
	 *
	 * @return array|WP_Error
	 */
	function get_wpmdbpro_profile_before_migration( $profile ) {
		if ( is_wp_error( $profile ) ) {
			return $profile;
		}

		if ( empty( $profile ) ) {
			return $this->cli_error( __( 'Profile ID missing.', 'wp-migrate-db-pro-cli' ) );
		} elseif ( ! is_array( $profile ) ) {
			$profile = $this->get_profile_by_key( absint( $profile ) );

			// don't exclude post types if the option isn't checked
			if ( ! is_wp_error( $profile ) && ! $profile['exclude_post_types'] ) {
				$profile['select_post_types'] = array();
			}
		}

		return $profile;
	}

	/**
	 * Check if MF option enabled in profile but plugin not active locally.
	 * hooks on: wpmdb_cli_profile_before_migration
	 *
	 * @param array $profile
	 *
	 * @return array|WP_Error
	 */
	function check_local_wpmdbpro_media_files_before_migration( $profile ) {
		if ( is_wp_error( $profile ) ) {
			return $profile;
		}

		if ( isset( $profile['media_files'] ) && true == $profile['media_files'] ) {
			if ( false === class_exists( '\DeliciousBrains\WPMDBMF\MediaFilesAddon' ) ) {
				return $this->cli_error( __( 'The profile is set to migrate media files, however WP Migrate DB Pro Media Files does not seem to be installed/active on the local website.', 'wp-migrate-db-pro-cli' ) );
			}
		}

		return $profile;
	}

	/**
	 * Check if MF option enabled in profile but plugin not active on remote and that selected subsites make sense if being used.
	 * hooks on: wpmdb_cli_filter_before_cli_initiate_migration
	 *
	 * @param array $profile
	 *
	 * @return array|WP_Error
	 */
	function check_remote_wpmdbpro_media_files_before_migration( $profile ) {
		if ( is_wp_error( $profile ) ) {
			return $profile;
		}

		if ( isset( $profile['media_files'] ) && true == $profile['media_files'] ) {
			if ( ! isset( $this->remote['media_files_max_file_uploads'] ) ) {
				return $this->cli_error( __( 'The profile is set to migrate media files, however WP Migrate DB Pro Media Files does not seem to be installed/active on the remote website.', 'wp-migrate-db-pro-cli' ) );
			}
		}

		if ( is_multisite() && ! empty( $profile['mf_select_subsites'] ) && 'savefile' !== $profile['action'] ) {
			if ( 'pull' === $profile['action'] ) {
				if ( empty( $this->remote['subsites'] ) || ! is_array( $this->remote['subsites'] ) ) {
					return $this->cli_error( __( 'One or more subsites should exist on the remote to make use of the --media-subsites option', 'wp-migrate-db-pro-cli' ) );
				}
				$subsites_list = $this->remote['subsites'];
			} else {
				$subsites_list = $this->util->subsites_list();
			}

			$mf_selected_subsites = $this->multisite->get_subsite_ids( $profile['mf_selected_subsites'], $subsites_list );

			if ( empty( $mf_selected_subsites ) || in_array( false, $mf_selected_subsites ) ) {
				return $this->cli_error( __( 'One or more valid Blog IDs or Subsite URLs must be supplied to make use of the --media-subsites option', 'wp-migrate-db-pro-cli' ) );
			}

			// We now have a validated and clean set of blog ids to use.
			$profile['mf_selected_subsites'] = $mf_selected_subsites;
		}

		return $profile;
	}

	/**
	 * Check if --subsite param is passed in the profile but the MST plugin is not installed/active on remote
	 * hooks on: wpmdb_cli_filter_before_cli_initiate_migration
	 *
	 * @param $profile
	 *
	 * @return array|WP_Error
	 */
	function check_remote_wpmdbpro_mst_before_migration( $profile ) {
		if ( is_wp_error( $profile ) || in_array( $profile['action'], array(
				'savefile',
				'find_replace',
				'import',
			) ) ) {
			return $profile;
		}

		if ( isset( $profile['mst_select_subsite'] ) && '1' === $profile['mst_select_subsite'] && isset( $profile['mst_selected_subsite'] ) ) {
			if ( ! isset( $this->remote['mst_available'] ) ) {
				return $this->cli_error( __( 'The profile is set to migrate a subsite, however WP Migrate DB Pro Multisite tools does not seem to be installed/active on the remote website.', 'wp-migrate-db-pro-cli' ) );
			}
		} else {
			return $profile;
		}

		if ( is_multisite() && 'true' === $this->remote['site_details']['is_multisite'] ) {
			return $this->cli_error( __( 'The profile is set to migrate a subsite, however WP Migrate DB Pro Multisite Tools does not currently support migrating a subsite between multisite installs.', 'wp-migrate-db-pro-cli' ) );
		}

		if ( ! is_multisite() && 'true' === $this->remote['site_details']['is_multisite'] ) {
			$profile['mst_selected_subsite'] = $this->multisite->get_subsite_id( $profile['mst_selected_subsite'], $this->remote['site_details']['subsites'] );
		}

		if ( false === $profile['mst_selected_subsite'] ) {
			return $this->cli_error( __( 'A valid Blog ID or Subsite URL must be supplied to make use of the subsite option', 'wp-migrate-db-pro-cli' ) );
		}

		if ( 1 < $profile['mst_selected_subsite']
		     && ! preg_match( '/\w+_\d_/', $profile['new_prefix'] ) // Prefix already set in saved profiles
		     && (
			     ( 'pull' === $profile['action'] && is_multisite() ) ||
			     ( 'push' === $profile['action'] && 'true' === $this->remote['site_details']['is_multisite'] )
		     )
		) {
			// @TODO this changes a correct prefix when a pull profile is run
			$profile['new_prefix'] .= $profile['mst_selected_subsite'] . '_';
		}

		return $profile;
	}

	/**
	 * Flush rewrite rules
	 * hooks on: wpmdb_cli_finalize_migration_response
	 *
	 * @param string $response
	 *
	 * @return string
	 */
	function finalize_flush( $response, $post_data ) {
		\WP_CLI::log( _x( 'Flushing caches and rewrite rules...', 'The caches and rewrite rules for the target are being flushed', 'wp-migrate-db-pro-cli' ) );

		$args     = $this->http_helper->filter_post_elements( $post_data, array( 'action', 'migration_state_id' ) );
		$response = $this->flush( $args );

		return trim( $response );
	}

	/**
	 * Check profile for backup option and set stage appropriately
	 * hooks on: wpmdb_cli_initiate_migration_args
	 *
	 * @param array $migration_args
	 * @param array $profile
	 *
	 * @return array
	 */
	function initate_migration_enable_backup( $migration_args, $profile ) {
		if ( '0' != $profile['create_backup'] ) {
			$migration_args['stage'] = 'backup';
		}

		return $migration_args;
	}

	/**
	 * Use remote tables for pull migration
	 * hooks on: wpmdb_cli_filter_source_tables
	 *
	 * @param $source_tables
	 *
	 * @return array
	 */
	function set_remote_source_tables_for_pull( $source_tables, $profile ) {
		if ( 'pull' == $profile['action'] ) {
			$source_tables = $this->remote['tables'];
		}

		return $source_tables;
	}

	/**
	 * Update progress label for migrations / backups
	 * hooks on: 'wpmdb_cli_progress_label
	 *
	 * @param string $progress_label
	 * @param int    $stage
	 *
	 * @return string
	 */
	function modify_progress_label( $progress_label, $stage ) {
		if ( 'savefile' !== $this->profile['action'] && 'find_replace' !== $this->profile['action'] ) {
			if ( 1 === $stage ) { // 1 = backup stage, 2 = migration stage
				$progress_label = __( 'Performing backup', 'wp-migrate-db-pro-cli' );
			} else {
				$progress_label = __( 'Migrating tables', 'wp-migrate-db-pro-cli' );

				if ( 'import' === $this->profile['action'] ) {
					$progress_label = __( 'Running find & replace', 'wp-migrate-db-pro-cli' );
				}
			}
		}

		return $progress_label;
	}

	/**
	 * Apply pro only finalize migration filter
	 * hooks on: wpmdb_cli_finalize_migration
	 *
	 * @return mixed
	 */
	function apply_pro_cli_finalize_migration_filter() {
		return apply_filters( 'wpmdb_pro_cli_finalize_migration', true, $this->profile, $this->remote, $this->migration, $this->post_data );
	}

	function do_delay_between_requests() {
		if ( 0 < $this->delay_between_requests ) {
			sleep( $this->delay_between_requests / 1000 );
		}
	}

	/**
	 *
	 * Detects a database prefix mismatch and displays a CLI message about it. Does not interrupt the migration.
	 *
	 * @param $post_data
	 *
	 * @return bool
	 */
	public function handle_prefix_mismatch( $post_data, $profile ) {
		global $wpdb;

		$local_prefix  = $wpdb->base_prefix;
		$remote_prefix = $this->get_remote_prefix( $post_data );
		$mismatch      = null;
		$message       = '';

		if ( ! empty( $local_prefix ) && ! empty( $remote_prefix ) ) {
			$mismatch = false;

			if ( $local_prefix !== $remote_prefix ) {
				$mismatch = true;
			}
		}

		$subsite_prefix_mismatch = $this->is_multisite_prefix_mismatch( $post_data, $profile, $mismatch );

		if ( true === $mismatch ) {
			if ( isset( $post_data['intent'] ) ) {
				$message = "%Y" . __( "Database table prefix differs between installations.", 'wp-migrate-db-cli' );
				$message .= "%n \n%R";

				if ( true === $subsite_prefix_mismatch ) {
					$message .= sprintf( __( "We have detected you have table prefix \"%s\" at %s but have \"%s\" here. Multisite Tools currently only supports migrating subsites between sites with the same base table prefix.", 'wp-migrate-db-cli' ), $remote_prefix, $post_data['site_details']['remote']['site_url'], $wpdb->base_prefix );
				} else {
					if ( 'push' == $post_data['intent'] ) {
						$message .= sprintf( __( "The remote database uses a prefix of \"%s\". This migration will create new tables in the remote database with a prefix of \"%s\".  \nTo use these new tables, AFTER the migration is complete, you will need to edit the wp-config.php file on the remote server and change the \$table_prefix variable to \"%s\"", 'wp-migrate-db-cli' ), $remote_prefix, $wpdb->base_prefix, $wpdb->base_prefix );
					} else if ( 'pull' == $post_data['intent'] ) {
						$message .= sprintf( __( "The local database uses a prefix of \"%s\". This migration will create new tables in the local database with a prefix of \"%s\".  \nTo use these new tables, AFTER the migration is complete, you will need to edit your wp-config.php file in your local environment and change the \$table_prefix variable to \"%s\"", 'wp-migrate-db-cli' ), $wpdb->base_prefix, $remote_prefix, $remote_prefix );
					}
				}

				$message .= "%n";
			}

			// Only display the CLI warning if invoked manually.
			if ( ! defined( 'DOING_WPMDB_TESTS' ) ) {
				if ( false === $subsite_prefix_mismatch ) {
					\WP_CLI::warning( \WP_CLI::colorize( $message ) );
				} else {
					\WP_CLI::error( \WP_CLI::colorize( $message ) );
				}
			}
		}

		return $mismatch;
	}

	/**
	 *
	 * Returns the remote database prefix, based on global $_POST data
	 *
	 * @param $post_data
	 *
	 * @return string
	 */
	public function get_remote_prefix( $post_data ) {
		$remote_prefix = '';

		if ( isset( $post_data['site_details']['remote']['prefix'] ) ) {
			$remote_prefix = $post_data['site_details']['remote']['prefix'];
		}

		return $remote_prefix;
	}

	/**
	 *
	 * Detects if a CLI migration is attempted from a multisite, with the --subsite option, and where the table prefixes do no match
	 *
	 * @param $post_data
	 * @param $profile
	 * @param $is_mismatch
	 *
	 * @return bool
	 */
	public function is_multisite_prefix_mismatch( $post_data, $profile, $is_mismatch ) {
		$subsite_prefix_mismatch = false;
		$migration_details       = $post_data['site_details'];

		if ( true === $is_mismatch ) {
			if ( isset( $migration_details['local']['is_multisite'] ) && 'true' === $migration_details['local']['is_multisite'] ) {
				$mst_select_subsite = isset( $profile['mst_select_subsite'] ) ? $profile['mst_select_subsite'] : 0;

				if ( '1' == $mst_select_subsite ) {
					$subsite_prefix_mismatch = true; //If there is a selected subsite, and it's multisite, and there's a prefix mistmatch
				}
			}
		}

		return $subsite_prefix_mismatch;
	}

	/**
	 * Imports a file to the database.
	 *
	 * @param $post_data
	 * @param $profile
	 */
	public function cli_import( $post_data, $profile ) {
		if ( 'import' !== $profile['action'] ) {
			return;
		}

		$file     = $profile['import_file'];
		$importer = $this->import;

		if ( $importer->file_is_gzipped( $file ) ) {
			$file = $importer->decompress_file( $profile['import_file'] );
		}

		$chunk      = 0;
		$num_chunks = $importer->get_num_chunks_in_file( $file );

		if ( is_wp_error( $num_chunks ) ) {
			$error = $num_chunks->get_error_message();
			$this->error_log->log_error( $error );
			\WP_CLI::error( $error );
		}

		$file_object                    = $importer->get_file_object( $file );
		$file_header                    = $file_object->fread( 2000 );
		$this->post_data['import_info'] = $importer->parse_file_header( $file_header );

		$current_query = '';
		$progress      = \WP_CLI\Utils\make_progress_bar( __( 'Importing file', 'wp-migrate-db-pro-cli' ), $num_chunks );

		while ( $num_chunks > $chunk ) {
			$import = $importer->import_chunk( $file, $chunk, $current_query );

			if ( is_wp_error( $import ) ) {
				$error = $import->get_error_message();
				$this->error_log->log_error( $error );
				\WP_CLI::error( $error );
			}

			$current_query = $import['current_query'];

			$chunk ++;

			$progress->tick();
		}

		$progress->finish();

		$import_find_replace = isset( $profile['import_find_replace'] ) ? $profile['import_find_replace'] : true;

		if ( ! empty( $profile['replace_old'] ) && ! empty( $profile['replace_new'] ) && $import_find_replace ) {
			$this->post_data['stage'] = 'find_replace';
			$this->migrate_tables();
		}
	}
}
