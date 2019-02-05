<?php

class td_module_mx17 extends td_module {

    function __construct($post, $module_atts = array()) {
        //run the parrent constructor
        parent::__construct($post, $module_atts);
    }

    function render() {
        ob_start();
        $title_length = $this->get_shortcode_att('mx17_tl');
        ?>

        <div class="<?php echo $this->get_module_classes();?>">
            <div class="meta-info-container">
                <div class="td-module-image">
                    <?php echo $this->get_image('td_534x462');?>
                    <?php if (td_util::get_option('tds_category_module_mx17') == 'yes') { echo $this->get_category(); }?>
                </div>
                <div class="td-module-meta-info">
                    <?php echo $this->get_title($title_length);?>
                    <?php echo $this->get_author();?>
                    <?php echo $this->get_date();?>
                    <?php echo $this->get_comments();?>
                </div>
            </div>
        </div>

        <?php return ob_get_clean();
    }
}