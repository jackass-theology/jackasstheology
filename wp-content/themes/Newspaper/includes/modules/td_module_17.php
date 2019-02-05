<?php

class td_module_17 extends td_module {

    function __construct($post, $module_atts = array()) {
        //run the parrent constructor
        parent::__construct($post, $module_atts);
    }

    function render() {
        ob_start();
        $title_length = $this->get_shortcode_att('m17_tl');
        $excerpt_length = $this->get_shortcode_att('m17_el');
        ?>

        <div class="<?php echo $this->get_module_classes();?>">
            <div class="meta-info-container">
                <?php echo $this->get_title($title_length);?>

                <div class="td-module-image">
                    <?php echo $this->get_image('td_696x385');?>
                    <div class="td-module-meta-holder">
                        <div class="td-left-meta">
                            <?php echo $this->get_author();?>
                            <?php echo $this->get_date();?>
                        </div>
                        <?php echo $this->get_comments();?>
                    </div>
                    <div class="td-category-corner">
                        <?php if (td_util::get_option('tds_category_module_17') == 'yes') { echo $this->get_category(); }?>
                    </div>
                </div>

                <div class="td-excerpt">
                    <?php echo $this->get_excerpt($excerpt_length);?>
                </div>

                <div class="td-read-more">
                    <a href="<?php echo $this->href;?>"><?php echo __td('Read more', TD_THEME_NAME);?><i class="td-icon-menu-right"></i></a>
                </div>
            </div>

        </div>

        <?php return ob_get_clean();
    }
}