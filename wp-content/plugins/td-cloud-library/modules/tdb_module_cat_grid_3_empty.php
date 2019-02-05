<?php

class tdb_module_cat_grid_3_empty extends tdb_module {

    function __construct( $post_data_array, $module_atts = array() ) {
        //run the parrent constructor
        parent::__construct( $post_data_array, $module_atts );
    }

    function render($order_no, $class) {
        ob_start();


        ?>

        <div class="<?php echo $this->get_module_classes(array($class, "tdb-cat-grid-post", "tdb-cat-grid-post-empty", "tdb-cat-grid-post-$order_no"));?>">
            <div class="td-module-container">
                <div class="td-image-wrap"></div>
            </div>
        </div>

        <?php return ob_get_clean();
    }
}