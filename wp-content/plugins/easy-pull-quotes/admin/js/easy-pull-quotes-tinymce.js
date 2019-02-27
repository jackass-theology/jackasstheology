(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 tinymce.create('tinymce.plugins.easyPullQuotes', {
	         /**
	          * Initializes the plugin, this will be executed after the plugin has been created.
	          * This call is done before the editor instance has finished it's initialization so use the onInit event
	          * of the editor instance to intercept that event.
	          *
	          * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
	          * @param {string} url Absolute URL to where the plugin is located.
	          */
	         init : function(ed, url) {
				 ed.addButton( 'epq_tinymce_button', {
		             title: 'Easy Pull Quotes',
		             icon: 'icon dashicons-media-document',
		             cmd: 'addPullQuote'
		         });

				 ed.addCommand('addPullQuote', function() {
					   ed.windowManager.open( {
						   width: 320,
						   height: 200,
						   text: 'Insert a Pull Quote',
						   body: [{
							   type: 'textbox',
							   multiline: true,
							   style: 'height: 100px;',
							   name: 'epqQuote',
							   label: 'Quote'
						   },
						   {
							   type: 'listbox',
							   name: 'epqAlignment',
							   label: 'Alignment',
							   'values': [
								   {text: 'Left Aligned', value: 'align-left'},
								   {text: 'Center Aligned', value: 'align-center'},
								   {text: 'Right Aligned', value: 'align-right'}
							   ]
						   }],
						   onsubmit: function(e) {
							   var epqShortcode = '';
							   epqShortcode = '[epq-quote align="'+e.data.epqAlignment+'"]'+e.data.epqQuote+'[/epq-quote]';
							   ed.execCommand('mceInsertContent', 0, epqShortcode);
						   }
					   });
				 });

	         },

	         /**
	          * Creates control instances based in the incomming name. This method is normally not
	          * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
	          * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
	          * method can be used to create those.
	          *
	          * @param {String} n Name of the control to create.
	          * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
	          * @return {tinymce.ui.Control} New control instance or null if no control was created.
	          */
	         createControl : function(n, cm) {
	             return null;
	         },

	         /**
	          * Returns information about the plugin as a name/value array.
	          * The current keys are longname, author, authorurl, infourl and version.
	          *
	          * @return {Object} Name/value array containing information about the plugin.
	          */
	         getInfo : function() {
	             return {
	                 longname : 'Easy Pull Quotes',
	                 author : 'Jason Yingling',
	                 authorurl : 'http://jasonyingling.me',
	                 infourl : 'http://jasontingling.me',
	                 version : "0.1"
	             };
	         }
	     });

	     // Register plugin
	     tinymce.PluginManager.add( 'epq_tinymce_button', tinymce.plugins.easyPullQuotes );

})( jQuery );
