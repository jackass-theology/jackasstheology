/**
 * Created by tagdiv on 03.03.2017.
 */

/* global jQuery:{} */
/* global _:{} */

var tdConfirm;

(function( jQuery, undefined ) {

    'use strict';

    tdConfirm = {

        _isInitialized: false,

        mediaUploadLoaded: false, //set in td_wp_booster_functions.php

        _$content: undefined,
        _$confirmYes: undefined,
        _$confirmNo: undefined,

        _$infoContent: undefined,

        _$body: undefined,

        init: function() {

            tdConfirm._$body = jQuery( 'body' );

            tdConfirm._$content = jQuery( '<div id="td-confirm" style="display: none;">' +
                '<div class="td-confirm-info"></div>' +
                '<div class="td-confirm-buttons">' +
                    '<button type="button" class="td-confirm-yes">Yes</button>' +
                    '<button type="button" class="td-confirm-no">No</button>' +
                '</div>' +
            '</div>' );

            tdConfirm._$infoContent = tdConfirm._$content.find( '.td-confirm-info' );
            tdConfirm._$confirmYes = tdConfirm._$content.find( 'button.td-confirm-yes' );
            tdConfirm._$confirmNo = tdConfirm._$content.find( 'button.td-confirm-no' );

            tdConfirm._$body.append( tdConfirm._$content );
        },

        /**
         * OK modal
         * @param args
         */
        modal: function( args ) {

            // caption, htmlInfoContent, callbackYes, objectContext, url, textYes, hideNo, textNo

            tdConfirm.init();

            if ( 'undefined' === typeof args.url ) {
                args.url = '#TB_inline?inlineId=td-confirm&width=480';
            }

            if ( 'undefined' === typeof args.objectContext || null === args.objectContext) {
                args.objectContext = window;
            }

            if ( 'undefined' === typeof args.htmlInfoContent) {
                args.htmlInfoContent = '';
            }

            // Change OK text
            if ( 'undefined' === typeof args.textYes ) {
                tdConfirm._$confirmYes.html('Ok');
            } else {
                tdConfirm._$confirmYes.html( args.textYes );
            }

            if ( 'undefined' !== typeof args.switchButtons && true === args.switchButtons ) {
                tdConfirm._$confirmNo.insertBefore( tdConfirm._$confirmYes );
            }

            tdConfirm._$infoContent.html( args.htmlInfoContent );

            // Remove confirm No
            if ( 'undefined' !== typeof args.hideNoButton && true === args.hideNoButton ) {
                tdConfirm._$confirmNo.hide();
            } else {
                tdConfirm._$confirmNo.show();
                tdConfirm._$confirmNo.unbind();
                tdConfirm._$confirmNo.click( function() {
                    if ( 'undefined' !== typeof args.callbackNo) {
                        args.callbackNo.apply(args.objectContext, args.argsNo);
                    }
                    tb_remove();
                    return false;
                });

                // Change Yes to OK
                if ( 'undefined' === typeof args.textNo ) {
                    tdConfirm._$confirmNo.html('No');
                } else {
                    tdConfirm._$confirmNo.html( args.textNo );
                }
            }

            //Yes callback
            if ( 'undefined' === typeof args.callbackYes) {
                tdConfirm._$confirmYes.click( function() {
                    tb_remove();
                    return true;
                });
            } else {
                tdConfirm._$confirmYes.off('click');
                tdConfirm._$confirmYes.click( function() {
                    args.callbackYes.apply(args.objectContext, args.argsYes);
                    return true;
                });
            }

            tdConfirm._$body.addClass( 'td-thickbox-loading' );

            tb_show( args.caption, args.url );

            // Remove close on overlay container click
            if ( 'undefined' !== typeof args.offOverlayClick && true === args.offOverlayClick ) {
                jQuery("#TB_overlay").off('click');
            }

            var $TBWindow = jQuery( '#TB_window' );

            // Remove close button
            if ( 'undefined' !== typeof args.hideCloseButton && true === args.hideCloseButton ) {
                $TBWindow.find('#TB_closeWindowButton').hide();
            }

            $TBWindow.addClass( 'td-thickbox' );

            if (tdConfirm._$infoContent.height() > 400) {
                $TBWindow.addClass( 'td-thickbox-fixed' );
            }

            tdConfirm._$body.removeClass( 'td-thickbox-loading' );

            tdConfirm._$content.remove();
        },

        /**
         * OK modal
         * @param caption
         * @param htmlInfoContent
         * @param callbackYes
         * @param objectContext
         * @param url
         */
        showModalOk: function(caption, htmlInfoContent, callbackYes, objectContext, url) {

            tdConfirm.init();

            if ('undefined' === typeof url) {
                url = '#TB_inline?inlineId=td-confirm&width=480';
            }

            if ( 'undefined' === typeof objectContext || null === objectContext) {
                objectContext = window;
            }

            if ( 'undefined' === typeof htmlInfoContent) {
                htmlInfoContent = '';
            }

            tdConfirm._$infoContent.html( htmlInfoContent );

            // Remove confirm No
            tdConfirm._$confirmNo.hide();

            // Change Yes to OK
            tdConfirm._$confirmYes.html('Ok');

            //Yes callback
            if ( 'undefined' === typeof callbackYes) {
                tdConfirm._$confirmYes.click( function() {
                    tb_remove();
                    return true;
                });
            } else {
                tdConfirm._$confirmYes.click( function() {
                    tdConfirm._$confirmYes.off('click');
                    callbackYes.apply(objectContext);
                    return true;
                });
            }

            tdConfirm._$body.addClass( 'td-thickbox-loading' );

            tb_show( caption, url );

            // Remove close on overlay container click
            jQuery("#TB_overlay").off('click');

            var $TBWindow = jQuery( '#TB_window' );

            // Remove close button
            $TBWindow.find('#TB_closeWindowButton').remove();

            //fix for post/page edit areas
            if (tdConfirm.mediaUploadLoaded === true) {
                tdConfirm.fixPosition();
                jQuery(window).resize(function(){ tdConfirm.fixPosition(); });
            }

            $TBWindow.addClass( 'td-thickbox' );

            if (tdConfirm._$infoContent.height() > 400) {
                $TBWindow.addClass( 'td-thickbox-fixed' );
            }

            tdConfirm._$body.removeClass( 'td-thickbox-loading' );

            tdConfirm._$content.remove();
        },


        /**
         * fix window position
         * used when media-upload.js is loaded
         */
        fixPosition: function() {
            var $TBWindow = jQuery( '#TB_window' ),
                isIE6 = typeof document.body.style.maxHeight === "undefined";

            $TBWindow.css({marginLeft: '-' + parseInt((TB_WIDTH / 2),10) + 'px', width: TB_WIDTH + 'px'});
            if ( ! isIE6 ) { // take away IE6
                $TBWindow.css({marginTop: + parseInt((TB_HEIGHT / 2),10) + 'px'});
            }

            //display on top of other modals
            $TBWindow.css('z-index', '170001');
            jQuery("#TB_overlay").css('z-index', '170000');
        },


        /**
         * Yes / No modal
         * @param caption
         * @param objectContext
         * @param callbackYes
         * @param argsYes
         * @param htmlInfoContent
         * @param url
         */
        showModal: function( caption, objectContext, callbackYes, argsYes, htmlInfoContent, url) {

            tdConfirm.init();

            if ( 'undefined' === typeof url ) {
                url = '#TB_inline?inlineId=td-confirm&width=480';
            }

            if ( 'undefined' === typeof objectContext ) {
                objectContext = window;
            }

            if ( 'undefined' === typeof htmlInfoContent ) {
                htmlInfoContent = '';
            }
            tdConfirm._$infoContent.html( htmlInfoContent );


            // Remove any bound callback
            tdConfirm._$confirmYes.unbind();

            if ( 'undefined' === typeof callbackYes ) {
                tdConfirm._$confirmYes.click( function() {
                    tb_remove();
                    return true;
                });
            } else {
                if ( 'undefined' === typeof argsYes ) {
                    argsYes = [];
                }
                tdConfirm._$confirmYes.click( function() {
                    callbackYes.apply( objectContext, argsYes );
                });
            }

            // Remove any bound callback
            tdConfirm._$confirmNo.show();
            tdConfirm._$confirmNo.unbind();
            tdConfirm._$confirmNo.click( function() {
                tb_remove();
                return false;
            });


            tdConfirm._$body.addClass( 'td-thickbox-loading' );

            tb_show( caption, url );

            var $TBWindow = jQuery( '#TB_window' );

            $TBWindow.addClass( 'td-thickbox' );

            if (tdConfirm._$infoContent.height() > 400) {
                $TBWindow.addClass( 'td-thickbox-fixed' );
            }

            tdConfirm._$body.removeClass( 'td-thickbox-loading' );

            tdConfirm._$content.remove();
        }
    };

    // Important! 'init' can't be called here because it ads content in DOM (eventually onReady or onLoad, but it's enough if it's called on showModal)
    // tdConfirm.init();


})( jQuery );

