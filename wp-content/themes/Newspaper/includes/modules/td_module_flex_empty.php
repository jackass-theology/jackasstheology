<?php

class td_module_flex_empty extends td_module {

    function __construct($post, $module_atts = array()) {
        //run the parrent constructor
        parent::__construct($post, $module_atts);
    }

    function render($order_no, $class) {
        ob_start();

        ?>

        <div class="<?php echo $this->get_module_classes(array($class, "td-big-grid-flex-post", "td-big-grid-flex-post-empty", "td-big-grid-flex-post-$order_no"));?>">
            <div class="td-module-container">
                <div class="td-image-wrap"></div>
            </div>
        </div>

        <?php return ob_get_clean();
    }
}