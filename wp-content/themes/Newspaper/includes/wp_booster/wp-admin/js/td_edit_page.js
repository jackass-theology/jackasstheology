/**
 * used in wp-admin -> edit page, not on posts
 * this class hides and shows the metaboxes acording to the selected template
 * @type {{init: Function, show_template_settings: Function, change_content: Function}}
 */

/* global jQuery:{} */

var td_edit_page = {

    page_template_select: '',
    td_page_metabox: '',

    init: function () {
        jQuery(window).on( 'load', function () {

            td_edit_page.td_page_metabox = jQuery('#td_page_metabox');
            td_edit_page.td_homepage_loop_metabox = jQuery( '#td_homepage_loop_metabox' );

            if( td_edit_page._wp_version() > 4 ){
                var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

                // wp 5.0+ post editor sidebar open/close(attributes) change observer
                var edit_post_layout_observer = new MutationObserver( function( mutations ) {
                    mutations.forEach( function( mutation ) {
                        if ( mutation.type === "attributes" ) {
                            if ( mutation.target.className.indexOf('is-sidebar-opened') !== -1 ) {
                                // console.log(mutation);
                                // console.log('post editor sidebar open');
                                td_edit_page.add_page_metabox_actions();

                                var components_panel = document.querySelector( ".components-panel" );
                                if( typeof( components_panel ) !== 'undefined' && components_panel !== null ) {
                                    components_panel_observer.observe( components_panel, {
                                        childList: true
                                    } );
                                }

                                var components_panel_body = document.querySelectorAll( ".components-panel .components-panel__body" );
                                if( typeof( components_panel_body ) !== 'undefined' && components_panel_body !== null ) {
                                    for ( var i = 0; i < components_panel_body.length; i++ ) {
                                        for ( var j = 0; j < components_panel_body[i].childNodes.length; j++ ){
                                            if ( components_panel_body[i].childNodes[j].classList.contains('editor-page-attributes__template') ) {
                                                components_panel_body_observer.observe( components_panel_body[i], {
                                                    attributes: true
                                                } );
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    });
                });

                // wp 5.0+ sidebar components panel content(childLists) change observer
                var components_panel_observer = new MutationObserver( function( mutations ) {
                    mutations.forEach( function( mutation ) {
                        if (
                            mutation.type === "childList" &&
                            mutation.addedNodes.length > 0 &&
                            mutation.addedNodes[0].childNodes !== undefined &&
                            mutation.addedNodes[0].childNodes[1] !== undefined &&
                            mutation.addedNodes[0].childNodes[1].className.indexOf('editor-page-attributes__template') !== -1
                        ) {
                            // console.log(mutation);
                            // console.log('components panel change');
                            td_edit_page.add_page_metabox_actions();

                            var components_panel_body = document.querySelectorAll( ".components-panel .components-panel__body" );
                            if( typeof( components_panel_body ) !== 'undefined' && components_panel_body !== null ) {
                                for ( var i = 0; i < components_panel_body.length; i++ ) {
                                    for ( var j = 0; j < components_panel_body[i].childNodes.length; j++ ){
                                        if ( components_panel_body[i].childNodes[j].classList.contains('editor-page-attributes__template') ) {
                                            components_panel_body_observer.observe( components_panel_body[i], {
                                                attributes: true
                                            } );
                                        }
                                    }
                                }
                            }
                        }
                    });
                });

                // wp 5.0+ sidebar 'page attributes' drop-down open/close change observer
                var components_panel_body_observer = new MutationObserver( function( mutations ) {
                    mutations.forEach( function( mutation ) {
                        if (
                            mutation.type === "attributes" &&
                            mutation.target.className.indexOf('is-opened') !== -1
                        ) {
                            // console.log(mutation);
                            // console.log('components panel open');
                            td_edit_page.add_page_metabox_actions();
                        }
                    });
                });

                var edit_post_layout = document.querySelector( ".edit-post-layout" );
                if( typeof( edit_post_layout ) !== 'undefined' && edit_post_layout !== null ) {
                    edit_post_layout_observer.observe( edit_post_layout, {
                        attributes: true
                    } );
                }

                var components_panel = document.querySelector( ".components-panel" );
                if( typeof( components_panel ) !== 'undefined' && components_panel !== null ) {
                    components_panel_observer.observe( components_panel, {
                        childList: true
                    } );
                }

                var components_panel_body = document.querySelectorAll( ".components-panel .components-panel__body" );
                //console.log(components_panel_body);
                if( typeof( components_panel_body ) !== 'undefined' && components_panel_body !== null ) {
                    for ( var i = 0; i < components_panel_body.length; i++ ) {
                        for ( var j = 0; j < components_panel_body[i].childNodes.length; j++ ){
                            //console.log(components_panel_body[i].childNodes[j]);
                            if ( components_panel_body[i].childNodes[j].classList.contains('editor-page-attributes__template') ) {
                                //console.log(components_panel_body[i]);
                                components_panel_body_observer.observe( components_panel_body[i], {
                                    attributes: true
                                } );
                            }
                        }
                    }
                }
            }

            td_edit_page.add_page_metabox_actions();

        });
    },

    add_page_metabox_actions:function () {
        var td_page_metabox = td_edit_page.td_page_metabox;
        var td_homepage_loop_metabox = td_edit_page.td_homepage_loop_metabox;

        // #td_page_metabox is removed when td composer is loaded. But it's not removed from those iframes of td composer which usually load backend settings (ex iframes with page settings)
        if ( td_page_metabox.length ) {

            //hide boxes - avoid displaying both at the same time, a class is used to avoid interference with "Screen Options" settings
            td_page_metabox.addClass('td-hide-metabox');
            td_homepage_loop_metabox.addClass('td-hide-metabox');

            if ( td_edit_page._wp_version() !== false ) {
                // if we have found a wp version among body classes check if its older than 5 and set the pate template selector accordingly
                if( td_edit_page._wp_version() < 5 ){
                    // version 4 or older
                    td_edit_page.page_template_select = jQuery('#page_template');
                } else {
                    // version 5 or greater
                    td_edit_page.page_template_select = jQuery('.editor-page-attributes__template select');
                }

            } else {
                // if wp version is not found on body classes assume it's an older version and look for the '#page_template' select
                td_edit_page.page_template_select = jQuery('#page_template');
            }

            td_edit_page.show_template_settings();

            td_edit_page.page_template_select.change(function () {
                td_edit_page.show_template_settings();
            });

            //disable sidebar settings - if any vc_row is present in the page content
            setInterval(function () {

                // Disable meta box section when composer is active
                if ('undefined' !== typeof window.parent.tdcPostSettings && 'undefined' !== typeof window.parent.tdcPostSettings.postContent ) {
                    td_page_metabox.addClass('td-disable-settings');
                    return;
                }

                var ver4EditorContent = jQuery('#content').text().match(/\[.*vc_row.*\]/m);
                var ver5EditorContent = jQuery('.editor-block-list__layout').find('.mce-content-body p').text().match(/\[.*vc_row.*\]/m);

                if ( ver4EditorContent !== null || ver5EditorContent !== null ) {
                    td_page_metabox.addClass('td-disable-settings');
                } else {
                    td_page_metabox.removeClass('td-disable-settings');
                }

            }, 500);
        }
    },

    show_template_settings: function () {

        if (jQuery('#post_type').val() === 'post') {
            return;
        }

        //text and image after template drop down
        td_edit_page.change_content();

        var cur_template = td_edit_page.page_template_select.find('option:selected').text(),
            td_page_metabox = td_edit_page.td_page_metabox,
            td_homepage_loop_metabox = td_edit_page.td_homepage_loop_metabox;

        // the "show only unique articles" box is always visible
        // "postbox" class is removed for hidden elements to reduce the flickering occurred while dragging a metabox to change it's position
        switch (cur_template) {
            case 'Pagebuilder + latest articles + pagination':
                //hide default page settings
                td_page_metabox.removeClass('postbox');
                td_page_metabox.addClass('td-hide-metabox');
                //display homepage loop settings
                td_homepage_loop_metabox.addClass('postbox');
                td_homepage_loop_metabox.removeClass('td-hide-metabox');
                td_edit_page.change_content('<span class="td-wpa-info"><strong>Tip:</strong> Homepage made from a pagebuilder section and a loop below. <ul><li>The loop supports an optional sidebar and advanced filtering options. </li> <li>You can find all the options of this template if you scroll down.</li></ul></span>');
                break;

            case 'Pagebuilder + page title':
                //hide homepage loop settings
                td_homepage_loop_metabox.addClass('td-hide-metabox');
                td_homepage_loop_metabox.removeClass('postbox');
                //display default page settings
                td_page_metabox.addClass('postbox');
                td_page_metabox.removeClass('td-hide-metabox');
                td_edit_page.change_content('<span class="td-wpa-info"><strong>Tip:</strong> Useful when you want to create a page that has a standard title using the page builder. <ul><li>This template will remove the sidebar when a Visual Composer or other composers are used.</li> <li>Use the Widgetised Sidebar block to add a sidebar.</li></ul>');
                break;

            default: //default template
                //hide homepage loop settings
                td_homepage_loop_metabox.addClass('td-hide-metabox');
                td_homepage_loop_metabox.removeClass('postbox');
                //display default page settings
                td_page_metabox.addClass('postbox');
                td_page_metabox.removeClass('td-hide-metabox');
                td_edit_page.change_content('<span class="td-wpa-info"><strong>Tip:</strong> Default template, perfect for <em>page builder</em> or content pages. <ul><li>If the page builder is used, the page will be without a title.</li> <li>If it\'s a content page the template will generate a title</li></ul></span>');
                break;
        }
    },

    change_content: function (the_text) {

        var page_template_select_id = td_edit_page.page_template_select.attr('id');
        var after_element = '';

        if( document.getElementById("td_after_template_container_id") ) {
            after_element = document.getElementById("td_after_template_container_id");
            after_element.innerHTML = "";
            if( typeof the_text !== 'undefined' ) {
                after_element.innerHTML = the_text;
            }
        } else {
            if( document.getElementById(page_template_select_id) ) {
                //create the container
                after_element = document.createElement("div");
                after_element.setAttribute("id", "td_after_template_container_id");
                //insert the element in DOM, after template pull down
                document.getElementById(page_template_select_id).parentNode.insertBefore(after_element, document.getElementById(page_template_select_id).nextSibling);
            }
        }
    },

    _wp_version: function () {

        if ( document.body.className.indexOf('version-') !== -1 ) {
            var matches = document.body.className.match(/\sversion-(\d+)-/);
            if ( matches ) {
               return matches[1];
            }
        } else {
            return false;
        }
    }

};

td_edit_page.init();
