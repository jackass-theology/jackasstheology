<?php
class td_module_4 extends td_module {
    function __construct($post, $module_atts = array()) {
        //run the parrent constructor
        parent::__construct($post, $module_atts);
    }

    function render() {
        ob_start();
        $title_length = $this->get_shortcode_att('m4_tl');
        $excerpt_length = $this->get_shortcode_att('m4_el');
        ?>

        <div class="<?php echo $this->get_module_classes();?>">
            <div class="td-module-image">
                <?php echo $this->get_image('td_324x235'); ?>
                <?php if (td_util::get_option('tds_category_module_4') == 'yes') { echo $this->get_category(); }?>
            </div>

            <?php echo $this->get_title($title_length); ?>

            <div class="td-module-meta-info">
                <?php echo $this->get_author();?>
                <?php echo $this->get_date();?>
                <?php echo $this->get_comments();?>
            </div>

            <div class="td-excerpt">
                <?php echo $this->get_excerpt($excerpt_length); ?>
            </div>

            <?php echo $this->get_quotes_on_blocks();?>

        </div>

        <?php
        return ob_get_clean();
    }
}