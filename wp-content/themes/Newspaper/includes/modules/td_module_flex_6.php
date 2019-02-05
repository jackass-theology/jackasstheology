<?php

class td_module_flex_6 extends td_module {

    function __construct($post, $module_atts = array()) {
        //run the parrent constructor
        parent::__construct($post, $module_atts);
    }

    function render($order_no) {
        ob_start();

        $image_size = $this->get_shortcode_att('image_size');
        $category_position = $this->get_shortcode_att('modules_category');
        $title_length = $this->get_shortcode_att('mf6_tl');

        if (empty($image_size)) {
            $image_size = 'td_696x0';
        }

        ?>

        <div class="<?php echo $this->get_module_classes(array("td-big-grid-flex-post", "td-big-grid-flex-post-$order_no"));?>">
            <div class="td-module-container td-category-pos-<?php echo $category_position; ?>">
                <div class="td-image-container">
                    <?php if ($category_position == 'image') { echo $this->get_category(); }?>
                    <?php echo $this->get_image($image_size, true);?>
                </div>

                <div class="td-module-meta-info">
                    <?php if ($category_position == 'above') { echo $this->get_category(); }?>

                    <div class="tdb-module-title-wrap">
                        <?php echo $this->get_title($title_length);?>
                    </div>

                    <?php if ($category_position == '') { echo $this->get_category(); }?>

                    <div class="td-editor-date">
                        <?php echo $this->get_author();?>
                        <?php echo $this->get_date();?>
                    </div>
                </div>
            </div>
        </div>

        <?php return ob_get_clean();
    }
}