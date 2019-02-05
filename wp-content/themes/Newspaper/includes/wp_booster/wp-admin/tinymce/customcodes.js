// JavaScript Document

/* global tinymce:{} */
/* global tinyMCE:{} */

( function() {

    'use strict';

    var tdTinyMce = [

        {text: 'Video Playlists', value: 1, classes: 'td_tinymce_dropdown_title'},
        {
            text: 'Youtube playlist', value: 2, onclick: function () {
            tinymce.activeEditor.execCommand('mceInsertContent', false, '[td_block_video_youtube playlist_title="" playlist_yt="" playlist_auto_play="0"]' + tinyMCE.activeEditor.selection.getContent());
        }
        },
        {
            text: 'Vimeo playlist', value: 3, onclick: function () {
            tinymce.activeEditor.execCommand('mceInsertContent', false, '[td_block_video_vimeo playlist_title="" playlist_v="" playlist_auto_play="0"]' + tinyMCE.activeEditor.selection.getContent());
        }
        },


        {text: 'Smart lists', value: 4, classes: 'td_tinymce_dropdown_title'},
        {
            text: 'Smart list end', value: 5, onclick: function () {
            tinymce.activeEditor.execCommand('mceInsertContent', false, '[td_smart_list_end]' + tinyMCE.activeEditor.selection.getContent());
        }
        }
    ];

    if (typeof tds_video_playlists !== 'undefined' && tds_video_playlists === false) {
        tdTinyMce.splice(0, 3);
    }

    tinymce.PluginManager.add( 'td_shortcode_plugin', function( editor, url ) {

        editor.addButton('td_button_key', {
            type: 'listbox',
            text: 'Shortcodes',
            classes: 'td_tinymce_shortcode_dropdown widget btn td-tinymce-dropdown',
            icon: false,
            values: tdTinyMce

        });

    });

} )();


