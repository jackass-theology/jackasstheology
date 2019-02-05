<?php

class td_module_12 extends td_module {

    function __construct($post, $module_atts = array()) {
        //run the parrent constructor
        parent::__construct($post, $module_atts);
    }

    function render() {
        ob_start();
        $title_length = $this->get_shortcode_att('m12_tl');
        $excerpt_length = $this->get_shortcode_att('m12_el');
        ?>

        <div class="<?php echo $this->get_module_classes();?>">
            <div class="item-details">
                <?php echo $this->get_title($title_length);?>

                <div class="td-module-meta-info">
                    <?php if (td_util::get_option('tds_category_module_12') == 'yes') { echo $this->get_category(); }?>
                    <?php echo $this->get_author();?>
                    <?php echo $this->get_date();?>
                    <?php echo $this->get_comments();?>
                </div>

                <?php echo $this->get_image('td_696x0');?>

                <div class="td-excerpt">
                    <?php echo $this->get_excerpt($excerpt_length);?>
                </div>

                <div class="td-read-more">
                    <a href="<?php echo $this->href;?>"><?php echo __td('Read more', TD_THEME_NAME);?></a>
                </div>
            </div>

        </div>

        <?php return ob_get_clean();
    }
}

?>