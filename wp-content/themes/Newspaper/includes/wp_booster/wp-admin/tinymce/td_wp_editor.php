<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 19.10.2015
 * Time: 15:10
 */

/**
 * Class td_wp_editor
 * Helper class for multiple wordpress editors (tinymce editor). It just must be instantiated.
 */
class td_wp_editor {

	/**
	 * This ensures a unique nonce action for each instance (useful when there are multiple instances for the same post id)
	 * @var int $contor_editor
	 */
	static $counter_editor = 0;

	/**
	 * The $content of wp_editor (@see wp_editor).
	 * @var string $content
	 */
	private $content;

	/**
	 * The $editor_id of the wp_editor (@see wp_editor).
	 * @var string $editor_id
	 */
	private	$editor_id;

	/**
	 * The $settings of the wp_editor (@see wp_editor).
	 * @var string $settings
	 */
	private $settings;

	/**
	 * The meta key where will be saved the editor content.
	 * @var string $meta_key
	 */
	private $meta_key;

	/**
	 * The editor title.
	 * @var string $editor_title
	 */
	private $editor_title;

	/**
	 * Nonce action name that should be used for getting the unique nonce of the editor instance.
	 * @var string $nonce_action
	 */
	private static $nonce_action = 'td_tinymce_editor-';

	/**
	 * The post types the mobile editor will be available for.
	 * @var array
	 */
	private	$post_types;


	/**
	 * @param string $content - the wp editor content (@see wp_editor)
	 * @param string $editor_id - the DOM wp editor ID (@see wp_editor)
	 * @param array $settings - the wp editor settings (@see wp_editor)
	 * @param string $meta_key - the meta key that keeps the new editor content
	 * @param string $editor_title - the title of the new editor
	 * @param array $post_types - the post types the editor is used for
	 */
	function __construct( $content, $editor_id, $settings, $meta_key, $editor_title, $post_types ) {
		if ( empty( $meta_key ) ||
		     empty( $editor_title ) ||
		     empty( $post_types ) ||
		     ! is_array( $post_types ) ) {
			return;
		}

		$this->content = $content;
		$this->editor_id = $editor_id;
		$this->settings = $settings;

		$this->meta_key = $meta_key;
		$this->editor_title = $editor_title;
		$this->post_types = $post_types;

		// The nonce action of an instance is composed from td_wp_editor::$nonce_action . td_wp_editor::$counter_editor . '-' . $post->ID. So it's unique.
		td_wp_editor::$counter_editor++;

        /* Define the custom box */
        add_action( 'add_meta_boxes',

            /* Adds the mobile theme  box to the main column on the Post and Page edit screens */
            function () {
                add_meta_box(
                    'td_mobile_wp_editor_content_meta_box',
                    $this->editor_title,
                    array( $this, 'td_mobile_wp_editor' ),
                    'page'
                );
            }
        );

		add_action( 'save_post', array( $this, 'on_save_post' ) );
	}

	function td_mobile_wp_editor( $post ) {

        if ( ! in_array( $post->post_type, $this->post_types ) ) {
            return;
        }

        // nonce field
        $nonce_field_name = self::get_nonce_field( $post->ID );

        // nonce value
        //$nonce = wp_create_nonce( $nonce_field_name );

        // The action of the created nonce will be 'post.php' (used at editing post types)
        wp_nonce_field( 'post.php', $nonce_field_name );

        // the content of the tinymce editor will be the meta value
        $meta_value = get_post_meta( $post->ID, $this->meta_key, true );
        $content = $meta_value;

        if ( empty( $meta_value ) ) {
            $content = $this->content;
        }

        wp_editor( $content, $this->editor_id, $this->settings );
    }

	/**
	 * Helper function gets the nonce field name, which must be unique for each instance.
	 *
	 * @param int $post_id - the current post id.
	 *
	 * @return string
	 */
	private static function get_nonce_field( $post_id ) {
		return $nonce_field_name = self::$nonce_action . td_wp_editor::$counter_editor . '-' . $post_id;
	}

    /**
     * Function hook used for 'save_post' wp hook
     * @param $post_id
     */
	function on_save_post( $post_id ) {

        // verify if this is an auto save routine.
        // If it is our form has not been submitted, so we don't want to do anything
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // verify this came from the our screen and with proper authorization,
        // because save_post can be triggered at other times
        if ( ( isset ( $_POST[self::get_nonce_field( $post_id )] ) ) && ( ! wp_verify_nonce( $_POST[self::get_nonce_field( $post_id )], 'post.php' ) ) ) {
            return;
        }

		$post_type = get_post_type( $post_id );
		if ( ! in_array( $post_type, $this->post_types ) ) {
			return;
		}

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

		$td_demo_action = td_util::get_http_post_val('td_demo_action');

		if (
		    empty( $td_demo_action ) and
            ! empty ( $_POST ) and
            check_admin_referer( 'post.php', self::get_nonce_field( $post_id ) ) and
            isset( $_POST[$this->editor_id] )
        ) {
			update_post_meta( $post_id, $this->meta_key, $_POST[$this->editor_id] );
		}
	}
}
















