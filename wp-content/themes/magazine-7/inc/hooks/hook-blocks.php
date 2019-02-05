<?php
if (!function_exists('magazine_7_page_layout_blocks')) :
    /**
     *
     * @since Magazine 7 1.0.0
     *
     * @param null
     * @return null
     *
     */
    function magazine_7_page_layout_blocks( $archive_layout='full' ) {

        $archive_layout = magazine_7_get_option('archive_layout');

        switch ($archive_layout) {
            case "archive-layout-grid":
                magazine_7_get_block('grid');
                break;
            case "archive-layout-full":
                magazine_7_get_block('full');;
                break;
            default:
                magazine_7_get_block('grid');;
        }
    }
endif;
