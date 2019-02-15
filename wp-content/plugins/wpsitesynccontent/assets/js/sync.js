/*
 * @copyright Copyright (C) 2014-2016 SpectrOMtech.com. - All Rights Reserved.
 * @author SpectrOMtech.com <SpectrOMtech.com>
 * @url https://wpsitesync.com/license
 * The PHP code portions are distributed under the GPL license. If not otherwise stated, all images,
 * manuals, cascading style sheets, and included JavaScript *are NOT GPL*, and are released under the
 * SpectrOMtech Proprietary Use License v1.0
 * More info at https://wpsitesync.com
 */

/**
 * Javascript handlers for SYNC running on the post editor page
 * @since 1.0
 * @author SpectrOMtech
 */
function WPSiteSyncContent()
{
	this.inited = false;
	this.$content = null;
	this.disable = false;
	this.post_id = null;
	this.original_value = '';
	this.nonce = jQuery('#_sync_nonce').val();
	this.push_xhr = null;
	this.push_callback = null;					// callback to perform push; returns true to continue processing; false to stop processing
	this.pull_callback = null;					// callback to perform pull; returns true to continue processing; false to stop processing
}


/**
 * Initializes SYNC operations on the page
 */
WPSiteSyncContent.prototype.init = function()
{
	if (0 === jQuery('#spectrom_sync').length)
		return;

	this.inited = true;

	var _self = this;

	this.$content = jQuery('#content');
	this.original_value = this.$content.val();
	this.$content.on('keypress change', function() { _self.on_content_change(); });
};

/**
 * Initialization for Gutenberg
 */
WPSiteSyncContent.prototype.init_gutenberg = function()
{
console.log('init_gutenberg()');
	// https://riad.blog/2017/10/16/one-thousand-and-one-way-to-extend-gutenberg-today/
	// check to see if Gutenberg API code exists and initialize the Gutenberg Component Metabox
	if ('undefined' !== typeof(wp.blocks) && 'undefined' !== typeof(wp.blocks.registerBlockType)) {
//alert('init gutenberg');
		var header = jQuery('#spectrom_sync h2').html();
		// copies the HTML content of the metabox from "Extended Settings" within the Component menu
		var sync_contents = jQuery('#spectrom_sync div.inside').html();
		if ('undefined' === typeof(sync_contents))
			return;						// nothing there, let's not muck with it
console.log(sync_contents);
console.log('read ' + sync_contents.length + ' bytes of popup content.')
		// remove the old metabox
		jQuery('#spectrom_sync').parent().parent().remove();

//console.log('sync_contents: ' + sync_contents);
		var content = '<div id="spectrom_sync" class="components-panel__body">' +
			'<h2 class="components-panel__body-title">' +
				'<button type="button" aria-expanded="false" class="components-button components-panel__body-toggle" onclick="wpsitesynccontent.show_component(); return false;">' +
					header +
					'<svg aria-hidden="true" role="img" focusable="false" class="dashicon dashicons-arrow-down" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">' +
//						'<path d="M8 6l6 4.03L8 14V6z"></path>' +
						'<path d="M15 8l-4.03 6L7 8h8z"></path>' +
					'</svg>' +
				'</button>' +
			'</h2>' +
			'<div class="editor-post-spectrom-sync inside invisible">' +
				sync_contents +
			'</div>' +
			'</div>';
		// TODO: move into sync-admin.css
		var style = '<style>' +
			'#spectrom-sync { background-color: transparent; } ' +
			'.edit-post-sidebar #spectrom_sync .inside { padding: 0 .5rem .5rem .5rem; background-color: white !important; } ' +
			'.edit-post-sidebar #spectrom_sync .inside.visible { display: block; }' +
			'.edit-post-sidebar #spectrom_sync .inside.invisible { display: none; }' +
			'.components-panel__body-toggle.components-button { background-color: white !important; } ' +
			'</style>';

		// inject the metabox at the top of the Component menu
//		jQuery('.edit-post-sidebar .components-panel .components-panel__body:nth-child(1)').before(style + content);
//		jQuery('.edit-post-sidebar .components-panel__header').before(style + content);
//		jQuery('.edit-post-sidebar').before(style + content);
console.log('looking up dom');
		var eps = jQuery('.edit-post-sidebar');
//console.log(eps);
//console.log(jQuery('.edit-post-sidebar .edit-post-sidebar-header'));
//		jQuery('.edit-post-sidebar .edit-post-sidebar-header:nth-child(1)').before(style + content);
		jQuery('.edit-post-sidebar .edit-post-sidebar-header').before(style + content);
		jQuery('#sync-logo').parent().css('margin-right', '70px');
	}
};

/**
 * Shows the WPSiteSync Component menu metabox
 */
WPSiteSyncContent.prototype.show_component = function()
{
	// TODO: save state in cookie
	jQuery('#spectrom_sync .inside')
		.removeClass('invisible').addClass('visible');
	jQuery('#spectrom_sync button svg')
		.removeClass('dashicons-arrow-down').addClass('dashicons-arrow-up')
		.html('<path d="M7 13l4.03-6L15 13H7z"></path>');
	jQuery('#spectrom_sync button.components-button').attr('onclick', 'wpsitesynccontent.hide_component(); return false;').blur();
};

/**
 * Hides the WPSiteSync Component menu metabox
 */
WPSiteSyncContent.prototype.hide_component = function()
{
	// TODO: save state in cookie
	jQuery('#spectrom_sync .inside')
		.removeClass('visible').addClass('invisible');
	jQuery('#spectrom_sync button svg')
		.removeClass('dashicons-arrow-up').addClass('dashicons-arrow-down')
		.html('<path d="M15 8l-4.03 6L7 8h8z"></path>');
	jQuery('#spectrom_sync button.components-button').attr('onclick', 'wpsitesynccontent.show_component(); return false;').blur();
};

/**
 * Return the value of a GET parameter from the URL
 * @param {string} name Name of parameter to get
 * @returns {String} The value of the parameter if found, otherwise null.
 */
WPSiteSyncContent.prototype.get_param = function(name)
{
	var url = window.location.href;
	name = name.replace(/[\[\]]/g, "\\$&");
	var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		results = regex.exec(url);
	if (!results)
		return null;
	if (!results[2])
		return '';
	return decodeURIComponent(results[2].replace(/\+/g, ' '));
};

/**
 * Callback function to show or hide the contents of the details panel
 */
WPSiteSyncContent.prototype.show_details = function()
{
	if (!this.inited)
		return;

	if ('none' === jQuery('#sync-details').css('display'))
		jQuery('#sync-details').show(200, 'linear');
//			{
//			duration: 200,
//			easing: 'linear' } );
	else
		jQuery('#sync-details').hide(200);
	jQuery('#sync-button-details').blur();
};

/**
 * Sets the message area within the metabox
 * @param {string} msg The HTML contents of the message to be shown.
 * @param {boolean|null} anim If set to true, display the animation image; otherwise animation will not be shown.
 * @param {boolean|null) dismiss If set to true, will include a dismiss button for the message
 * @param {string|null} CSS class to add to the message container
 */
WPSiteSyncContent.prototype.set_message = function(msg, anim, dismiss, css_class)
{
	if (!this.inited)
		return;

	jQuery('#sync-message').attr('class', '').html(msg);
	if ('string' === typeof(css_class))
		jQuery('#sync-message').addClass(css_class);

	if ('boolean' === typeof(anim) && anim)
		jQuery('#sync-content-anim').show();
	else
		jQuery('#sync-content-anim').hide();

	if ('boolean' === typeof(dismiss) && dismiss)
		jQuery('#sync-message-dismiss').show();
	else
		jQuery('#sync-message-dismiss').hide();

	jQuery('#sync-message-container').show();

	this.force_refresh();
};

/**
 * Adds some message content to the current success/failure message in the Sync metabox
 * @param {string} msg The message to append
 */
WPSiteSyncContent.prototype.add_message = function(msg)
{
//console.log('add_message() ' + msg);
	jQuery('#sync-message').append('<br/>' + msg);
};

/**
 * Hides the message area within the metabox
 * @returns {undefined}
 */
WPSiteSyncContent.prototype.clear_message = function()
{
	jQuery('#sync-message-container').hide();
	jQuery('#sync-message').empty();
	jQuery('#sync-content-anim').hide();
	jQuery('#sync-message-dismiss').hide();
};

/**
 * Disables Sync Button every time the content changes.
 */
WPSiteSyncContent.prototype.on_content_change = function()
{
	if (this.$content.val() !== this.original_value) {
		this.disable = true;
		jQuery('#sync-content').attr('disabled', true);
		this.set_message(jQuery('#sync-msg-update-changes').html(), false, false, 'sync-error');
//		jQuery('#disabled-notice-sync').show();
	} else {
		this.disable = false;
		jQuery('#sync-content').removeAttr('disabled');
//		jQuery('#disabled-notice-sync').hide();
		this.clear_message();
	}
};

/**
 * Causes the browser to refresh the page contents
 */
WPSiteSyncContent.prototype.force_refresh = function()
{
//	jQuery(window).trigger('resize');
//	jQuery('#sync-message').parent().hide().show(0);
};

/**
 * Perfrom WPSiteSync API call
 * @param {string} op The name of the API to call
 * @param {int} post_id The post ID for the API call or null if not applicable
 * @param {string} msg The message to be set
 * @param {string} msg_success The success message to be set
 * @param {object} values Optional values to add to data
 * @returns {undefined}
 */
WPSiteSyncContent.prototype.api = function(op, post_id, msg, msg_success, values)
{
//console.log('wpsitesync.api() performing "' + op + '" api request... ' + msg);
	// Do nothing when in a disabled state
	if (this.disable || !this.inited)
		return;

	// add callback checks based on 'op' parameter values ... see .push() example
	switch (op) {
	case 'push':
		// check for a callback function - used to alter the behavior of the Push operation
		if (null !== this.push_callback) {
			var res = this.push_callback(post_id);
			if (!res)							// if the callback returns a false
				return;							// do not continue processing
		}
		break;
	case 'pull':
		// check for a callback function - used to alter the behavior of the Pull operation
		if (null !== this.pull_callback) {
			var res = this.pull_callback(post_id);
			if (!res)							// if the callback returns a false
				return;							// do not continue processing
		}
		break;
	}

	// set the message while API is running
	this.set_message(msg, true);

	this.post_id = post_id;
	var data = {
		action: 'spectrom_sync',
		operation: op,
		post_id: post_id,
		_sync_nonce: this.nonce
	};

	if ('undefined' !== typeof(values)) {
        _.extend(data, values);
	}

//console.log('api() performing ajax request');
	this.push_xhr = {
		type: 'post',
		async: true, // false,
		data: data,
		url: ajaxurl,
		success: function(response) {
//console.log('api() success response:');
//console.log(response);
			wpsitesynccontent.clear_message();
			if (response.success) {
//				jQuery('#sync-message').text(jQuery('#sync-success-msg').text());
				wpsitesynccontent.set_message(msg_success, false, true);
				if ('undefined' !== typeof(response.notice_codes) && response.notice_codes.length > 0) {
					for (var idx = 0; idx < response.notice_codes.length; idx++) {
						wpsitesynccontent.add_message(response.notices[idx]);
					}
				}
			} else {
				var more = ' <a href="https://wpsitesync.com/knowledgebase/wpsitesync-error-messages/#error' + response.error_code + '" target="_blank" style="text-decoration:none"><span class="dashicons dashicons-info"></span></a>';
//console.log(response.data);
				if ('undefined' !== typeof(response.error_message) && null !== response.error_message) {
//console.log('found error message in response');
//					jQuery('#sync-message').text(response.error_message);
					wpsitesynccontent.set_message(response.error_message + more, false, true);
				} else {
//console.log('no error message in response, use default');
					wpsitesynccontent.set_message(jQuery('#sync-error-msg').text() + more, false, true);
				}
			}
		},
		error: function(response) {
//console.log('api() failure response:');
//console.log(response);
			var msg = '';
			if ('undefined' !== typeof(response.error_message)) {
				var more = ' <a href="https://wpsitesync.com/knowledgebase/wpsitesync-error-messages/#error' + response.error_code + '" target="_blank" style="text-decoration:none"><span class="dashicons dashicons-info"></span></a>';
				wpsitesynccontent.set_message('<span class="error">' + response.error_message + more + '</span>', false, true);
			} else
				wpsitesynccontent.set_message('<span class="error">' + jQuery('#sync-runtime-err-msg').html() + '</span>', false, true)
//			jQuery('#sync-content-anim').hide();
		}
	};

	// Allow other plugins to alter the ajax request
	jQuery(document).trigger('sync_api_call', [op, this.push_xhr]);
//console.log('api() calling jQuery.ajax');
	jQuery.ajax(this.push_xhr);
//console.log('api() returned from ajax call');
};

/**
 * Sync Content button handler
 * @param {int} post_id The post id to perform Push operations on
 */
WPSiteSyncContent.prototype.push = function(post_id)
{
	// TODO: refactor to use api() method
//console.log('push()');
	// Do nothing when in a disabled state
	if (this.disable || !this.inited)
		return;

	// check for a callback function - used to alter the behavior of the Push operation
	if (null !== this.push_callback) {
		var res = this.push_callback(post_id);
		if (!res)							// if the callback returns a false
			return;							// do not continue processing
	}

	// set message to "working..."
	this.set_message(jQuery('#sync-msg-working').text(), true);

	this.post_id = post_id;
	var data = { action: 'spectrom_sync', operation: 'push', post_id: post_id, _sync_nonce: jQuery('#_sync_nonce').val() };

//console.log('push() calling AJAX');
	var push_xhr = {
		type: 'post',
		async: true, // false,
		data: data,
		url: ajaxurl,
		success: function(response) {
//console.log('push() success response:');
//console.log(response);
			wpsitesynccontent.clear_message();
			if (response.success) {
//console.log('push() response.success');
//				jQuery('#sync-message').text(jQuery('#sync-success-msg').text());
				wpsitesynccontent.set_message(jQuery('#sync-success-msg').text(), false, true);
				if ('undefined' !== typeof(response.notice_codes) && response.notice_codes.length > 0) {
					for (var idx = 0; idx < response.notice_codes.length; idx++) {
						wpsitesynccontent.add_message(response.notices[idx]);
					}
				}
			} else {
//console.log('push() !response.success');
				var more = ' <a href="https://wpsitesync.com/knowledgebase/wpsitesync-error-messages/#error' + response.error_code + '" target="_blank" style="text-decoration:none"><span class="dashicons dashicons-info"></span></a>';
				if ('undefined' !== typeof(response.data.message)) {
//					jQuery('#sync-message').text(response.data.message);
					wpsitesynccontent.set_message(response.data.message + more, false, true, 'sync-error');
				} else {
					wpsitesynccontent.set_message(jQuery('#sync-error-msg').text() + more, false, true);
				}
			}
		},
		error: function(response) {
//console.log('push() failure response:');
//console.log(response);
			var msg = '';
			if ('undefined' !== typeof(response.error_message))
				wpsitesynccontent.set_message('<span class="error">' + response.error_message + '</span>', false, true);
			else
				wpsitesynccontent.set_message('<span class="error">' + jQuery('#sync-runtime-err-msg').html() + '</span>', false, true)
//			jQuery('#sync-content-anim').hide();
		}
	};

	// Allow other plugins to alter the ajax request
	jQuery(document).trigger('sync_push', [push_xhr]);
//console.log('push() calling jQuery.ajax');
	jQuery.ajax(push_xhr);
//console.log('push() returned from ajax call');
};

/**
 * Set a callback function to be used to alter behavior of .push() method
 * @param {function} fn The function to store and use as a callback in .push()
 */
WPSiteSyncContent.prototype.set_push_callback = function(fn)
{
	this.push_callback = fn;
};

/**
 * Set a callback function to be used to alter behavior of .pull() method
 * @param {function} fn The function to store and use as a callback in .pull()
 */
WPSiteSyncContent.prototype.set_pull_callback = function(fn)
{
	this.pull_callback = fn;
};

/**
 * Display message about WPSiteSync Pull feature
 */
WPSiteSyncContent.prototype.pull_feature = function()
{
	this.set_message(jQuery('#sync-pull-msg').html());
	jQuery('#sync-pull-content').blur();
};

var wpsitesynccontent = new WPSiteSyncContent();

// initialize the WPSiteSync operation on page load
jQuery(document).ready(function() {
	wpsitesynccontent.init();
	// setting timer avoids issues with Gutenberg UI taking a while to get set up
	setTimeout(function() { wpsitesynccontent.init_gutenberg(); }, 200);
	jQuery(document).trigger('sync_init');
});

// EOF
