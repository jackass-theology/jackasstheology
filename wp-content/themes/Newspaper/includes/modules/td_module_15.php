<?php

/**
 * this module is similar to single
 * Class td_module_15
 */

class td_module_15 extends td_module_single {

    function __construct($post, $module_atts = array()) {
        //run the parrent constructor
        parent::__construct($post, $module_atts);
    }

    function render() {
        ob_start();
        $title_length = $this->get_shortcode_att('m15_tl');
        ?>

        <div class="<?php echo $this->get_module_classes(array_merge(get_post_class())); ?> clearfix">
            <div class="item-details">
                <?php echo $this->get_title($title_length);?>

                <div class="td-module-meta-info">
	                <?php if (td_util::get_option('tds_category_module_15') == 'yes') { echo $this->get_category(); }?>
                    <?php echo $this->get_author();?>
                    <?php echo $this->get_date();?>
                    <?php echo $this->get_comments();?>
                </div>

                <?php echo $this->get_image('td_696x0');?>

	            <div class="td-post-text-content td-post-content">
		            <?php echo $this->get_content();?>
	            </div>
            </div>

        </div>

        <?php return ob_get_clean();
    }
}

?>