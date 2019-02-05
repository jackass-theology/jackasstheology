<?php

class td_module_10 extends td_module {

    function __construct($post, $module_atts = array()) {
        //run the parrent constructor
        parent::__construct($post, $module_atts);
    }

    function render() {
        ob_start();
        $title_length = $this->get_shortcode_att('m10_tl');
        $excerpt_length = $this->get_shortcode_att('m10_el');
        ?>

        <div class="<?php echo $this->get_module_classes();?>">
            <?php echo $this->get_image('td_218x150');?>

            <div class="item-details">
            <?php echo $this->get_title($title_length);?>

                <div class="td-module-meta-info">
                    <?php if (td_util::get_option('tds_category_module_10') == 'yes') { echo $this->get_category(); }?>
                        <?php echo $this->get_author();?>
                        <?php echo $this->get_date();?>
                        <?php echo $this->get_comments();?>
                </div>

                <div class="td-excerpt">
                    <?php echo $this->get_excerpt($excerpt_length);?>
                </div>
            </div>

        </div>

        <?php return ob_get_clean();
    }

}