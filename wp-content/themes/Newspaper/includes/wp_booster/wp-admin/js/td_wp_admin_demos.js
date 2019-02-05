/**
 * Created by ra on 5/14/2015.
 */


/* global jQuery:{} */
/* global console:{} */
/* global alert:{} */
/* global confirm:{} */
/* global td_ajax_url:{} */
/* global tdDemoProgressBar:{} */
/* global tdDemoFullInstaller:{} */





var td_wp_admin_demos = {};



(function () {
    'use strict';


    td_wp_admin_demos = {




        init: function init() {

            jQuery().ready(function() {

                //add custom body class for disabled demos tooltip popup style
                var body = jQuery(document.body);

                if ( jQuery('.td-demo-req-plugins-disabled').length !== 0 ) {
                    body.addClass('td-demo-req-plug-tooltip');
                }


                // disable the demo install button for demos that require additional plugins installation/activation
                jQuery('.td-req-demo-disabled').click( function(event) {
                    event.preventDefault();
                });


                // quick install - right menu
                jQuery('.td-button-install-demo-quick').click(function(event) {
                    event.preventDefault();

                    if (jQuery(this).hasClass('td-demo-installing') || jQuery(this).hasClass('td-demo-disabled') || jQuery(this).hasClass('td-demo-installed') || jQuery(this).hasClass('td-req-demo-disabled')) {
                        return;
                    }

                    // install from the small sidebar list of demos
                    tdConfirm.showModal( 'Install the full demo',
                        td_wp_admin_demos,
                        function(demoId) {

                            td_wp_admin_demos._install_full(demoId);

                            tb_remove();
                        },
                        [jQuery(this).data('demo-id')],
                        'Are you sure you want to install the full demo? This will import homepages, sample content with images, backgrounds, template layouts, fonts, colors.<br><br>' +
                        '<strong>Notice</strong>: The demo can be fully uninstalled and the system will attempt to rollback to your previous state. Any content, menus and attachment created by the demo are removable via the uninstall button.<br><br>' +
                        '<strong>Please backup your settings</strong> to be sure that you don\'t lose them by accident.'
                    );
                });




                // install (via normal button)
                jQuery('.td-wp-admin-demo .td-button-install-demo').click(function(event) {
                    event.preventDefault();
                    var include_demo_content_check = jQuery(this).parent().parent().find('input[type=hidden]');
                    var demo_id = jQuery(this).data('demo-id');
                    var td_confirm = '';



                    if (include_demo_content_check.val() === 'no') {

                        // install no content
                        tdConfirm.showModal( 'Install demo without content',
                            td_wp_admin_demos,
                            function(demoId) {
                                //testtestest
                                td_wp_admin_demos._install_no_content(demoId);
                                tb_remove();
                            },
                            [demo_id],
                            'Are you sure you want to install the demo without the sample content? This will import our predefined settings for the demo (background, template layouts, fonts, colors etc...) but no sample content will be added to the site.<br>'

                        );

                    } else {

                        // install with content
                        tdConfirm.showModal( 'Install the full demo',
                            td_wp_admin_demos,
                            function(demoId) {

                                td_wp_admin_demos._install_full(demoId);
                                tb_remove();
                            },
                            [demo_id],
                            'Are you sure you want to install the full demo? This will import homepages, sample content with images, backgrounds, template layouts, fonts, colors.<br><br>' +
                            '<strong>Notice</strong>: The demo can be fully uninstalled and the system will attempt to rollback to your previous state. Any content, menus and attachment created by the demo are removable via the uninstall button.<br><br>' +
                            '<strong>Please backup your settings</strong> to be sure that you don\'t lose them by accident.'
                        );
                    }

                });

                // uninstall
                jQuery('.td-wp-admin-demo .td-button-uninstall-demo').click(function(event) {
                    event.preventDefault();

                    // install with content
                    tdConfirm.showModal( 'Uninstall demo',
                        td_wp_admin_demos,
                        function(demoId) {

                            td_wp_admin_demos._uninstall(demoId);
                            tb_remove();
                        },
                        [jQuery(this).data('demo-id')],
                        'Are you sure? The theme will remove all the installed content and settings and it will try to revert your site to the previous state.'
                    );
                });


                //toggle between only settings and full demo
                jQuery('.td-wp-admin-demo .td-checkbox').click(function(event){
                    event.preventDefault();

                    if (jQuery(this).hasClass('td-checkbox-active')) {
                        // we are deactivating
                        jQuery(this).parent().find('p').text('Only settings');

                    } else {
                        // we are activating
                        jQuery(this).parent().find('p').text('Include content');
                    }

                });
            });
        },


        _uninstall: function(demo_id) {
            td_wp_admin_demos._block_navigation();


            // disable the rest of the demos + remove the installed class form the other demo
            jQuery('.td-wp-admin-demo:not(.td-demo-' + demo_id + ')')
                .addClass('td-demo-disabled')
            ;

            //add the installing class
            jQuery('.td-demo-' + demo_id)
                .addClass('td-demo-uninstalling')
                .removeClass('td-demo-installed')
            ;

            // show the progressbar
            tdDemoProgressBar.progress_bar_wrapper_element = jQuery('.td-demo-' + demo_id + ' .td-progress-bar-wrap');
            tdDemoProgressBar.progress_bar_element = jQuery('.td-demo-' + demo_id + ' .td-progress-bar');
            tdDemoProgressBar.show();
            tdDemoProgressBar.change(2);

            tdDemoProgressBar.timer_change(98);

            var request_data = {
                action: 'td_ajax_demo_install',
                td_demo_action:'uninstall_demo',
                td_demo_id: demo_id,
                td_magic_token: tdWpAdminImportNonce
            };
            jQuery.ajax({
                type: 'POST',
                url: td_wp_admin_demos._getAdminAjax('uninstall_demo'),
                cache:false,
                data: request_data,
                dataType: 'json',
                success: function(data, textStatus, XMLHttpRequest){
                    //tdAjaxBlockProcessResponse(data, td_user_action);

                    tdDemoProgressBar.change(100);


                    setTimeout(function() {
                        // hide and reset the progress bar
                        tdDemoProgressBar.hide();
                        tdDemoProgressBar.reset();

                        //remove the installing class and add the installed class
                        jQuery('.td-demo-' + demo_id)
                            .removeClass('td-demo-uninstalling');

                        // remove the disable class from the other demos
                        jQuery('.td-demo-disabled').removeClass('td-demo-disabled');

                        td_wp_admin_demos._unblock_navigation();

                    }, 500);
                },
                error: function(MLHttpRequest, textStatus, errorThrown){
                    td_wp_admin_demos._show_network_error('uninstall', MLHttpRequest, textStatus, errorThrown);
                }
            });


        },

        _install_no_content: function (demo_id) {
            td_wp_admin_demos._block_navigation();
            td_wp_admin_demos._ui_install_start(demo_id);

            tdDemoProgressBar.timer_change(70);


            /* ---------------------------------------------------------------------------------------
             Remove content before install
             */
            var request_data = {
                action: 'td_ajax_demo_install',
                td_demo_action:'remove_content_before_install',
                td_demo_id: demo_id,
                td_magic_token: tdWpAdminImportNonce
            };
            jQuery.ajax({
                type: 'POST',
                url: td_wp_admin_demos._getAdminAjax('remove_content_before_install'),
                cache:false,
                data: request_data,
                dataType: 'json',
                success: function(data, textStatus, XMLHttpRequest){


                    /* ---------------------------------------------------------------------------------------
                     install_no_content_demo
                     */
                    tdDemoProgressBar.timer_change(98);
                    //tdAjaxBlockProcessResponse(data, td_user_action);
                    var request_data = {
                        action: 'td_ajax_demo_install',
                        td_demo_action:'install_no_content_demo',
                        td_demo_id: demo_id,
                        td_magic_token: tdWpAdminImportNonce
                    };
                    jQuery.ajax({
                        type: 'POST',
                        url: td_wp_admin_demos._getAdminAjax('install_no_content_demo'),
                        cache:false,
                        data: request_data,
                        dataType: 'json',
                        success: function(data, textStatus, XMLHttpRequest){
                            //tdAjaxBlockProcessResponse(data, td_user_action);
                            td_wp_admin_demos._unblock_navigation();
                            td_wp_admin_demos._ui_install_end(demo_id);
                        },
                        error: function(MLHttpRequest, textStatus, errorThrown){
                            td_wp_admin_demos._show_network_error('no_content_install_demo', MLHttpRequest, textStatus, errorThrown);
                        }
                    });



                },
                error: function(MLHttpRequest, textStatus, errorThrown){
                    td_wp_admin_demos._show_network_error('no_content_remove_content_before_install', MLHttpRequest, textStatus, errorThrown);
                }
            });




        },




        _install_full: function (demoId) {
            td_wp_admin_demos._block_navigation();
            td_wp_admin_demos._ui_install_start(demoId);
            tdDemoProgressBar.timer_change(10);

            tdDemoFullInstaller.installNextStep(demoId, 0, function () {
                // on finish!
                td_wp_admin_demos._unblock_navigation();
                td_wp_admin_demos._ui_install_end(demoId);
            });
        },





        _show_network_error:function (td_ajax_request_name, MLHttpRequest, textStatus, errorThrown) {

            var responseText = MLHttpRequest.responseText.replace(/<br>/g, '\n');

            alert(
                'Ajax error. Cannot connect to server, it may be due to a misconfiguration on the server.\n' +
                'textStatus: ' + textStatus + '\n' +
                'td_ajax_request_name: ' + td_ajax_request_name + '\n' +
                'errorThrown: ' + errorThrown + '\n' + '\n' +
                'responseText: ' + responseText
            );



            console.log(responseText);
        },



        _ui_install_start:function (demo_id) {
            // disable the rest of the demos + remove the installed class form the other demo
            jQuery('.td-wp-admin-demo:not(.td-demo-' + demo_id + ')')
                .addClass('td-demo-disabled')
                .removeClass('td-demo-installed')
            ;

            //add the installing class
            jQuery('.td-demo-' + demo_id).addClass('td-demo-installing');

            // show the progressbar
            tdDemoProgressBar.progress_bar_wrapper_element = jQuery('.td-demo-' + demo_id + ' .td-progress-bar-wrap');
            tdDemoProgressBar.progress_bar_element = jQuery('.td-demo-' + demo_id + ' .td-progress-bar');
            tdDemoProgressBar.show();
            tdDemoProgressBar.change(2);
        },

        _ui_install_end: function (demo_id) {
            tdDemoProgressBar.change(100);
            setTimeout(function() {
                // hide and reset the progress bar
                tdDemoProgressBar.hide();
                tdDemoProgressBar.reset();

                //remove the installing class and add the installed class
                jQuery('.td-demo-' + demo_id)
                    .removeClass('td-demo-installing')
                    .addClass('td-demo-installed');


                // remove the disable class from the other demos
                jQuery('.td-demo-disabled').removeClass('td-demo-disabled');

            }, 500);

        },



        _block_navigation: function () {
            window.onbeforeunload = function() {
                return "Are you sure you want to navigate away? The demo is still installing. If it's stuck, refresh this page and Uninstall the demo, it should bring your site to the previous state";
            };
        },

        _unblock_navigation: function() {
            window.onbeforeunload = '';
        },


        /**
         * generates an unique ID. Used for cache busting
         * @returns {string}
         * @private
         */
        _getAdminAjax: function(stepName) {
            if (typeof stepName === 'undefined') {
                stepName = 'not_set';
            }

            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000)
                    .toString(16)
                    .substring(1);
            }
            return td_ajax_url + '&step=' + stepName + '&uid=' + s4() + s4() + s4() + s4();
        }


    };

})();


td_wp_admin_demos.init();







