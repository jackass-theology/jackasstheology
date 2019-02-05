<?php

class td_module_mx22 extends td_module {

    function __construct($post, $module_atts = array()) {
        //run the parrent constructor
        parent::__construct($post, $module_atts);
    }

    function render($order_no) {
        ob_start();
        $title_length = $this->get_shortcode_att('mx22_tl');
        ?>

        <div class="<?php echo $this->get_module_classes(array("td-big-grid-post-$order_no", "td-big-grid-post td-mx-15"));?>">
            <div class="td-module-image">
                <?php echo $this->get_image('td_696x0', true);?>
            </div>

            <div class="td-meta-info-container">
                <div class="td-meta-align">
                    <div class="td-big-grid-meta">
                        <?php if (td_util::get_option('tds_category_module_mx22') == 'yes') { echo $this->get_category(); }?>
                        <?php echo $this->get_title($title_length);?>
                    </div>

                    <div class="td-module-meta-info">
                        <?php echo $this->get_date();?>
                    </div>
                </div>
            </div>
        </div>

        <?php return ob_get_clean();
    }
}