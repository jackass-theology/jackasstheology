<?php

class td_module_flex_2 extends td_module {

    function __construct($post, $module_atts = array()) {
        //run the parrent constructor
        parent::__construct($post, $module_atts);
    }

    function render() {
        ob_start();

        $image_size = $this->get_shortcode_att('image_size');
        $category_position = $this->get_shortcode_att('modules_category');
        $title_length = $this->get_shortcode_att('mc2_tl');
        $excerpt_length = $this->get_shortcode_att('mc2_el');
        $excerpt_position = $this->get_shortcode_att('excerpt_middle');

        if (empty($image_size)) {
            $image_size = 'td_1920x0';
        }

        $excerpt = '<div class="td-excerpt">';
            $excerpt .= $this->get_excerpt($excerpt_length);
        $excerpt .= '</div>';

        ?>

        <div class="<?php echo $this->get_module_classes();?>">
            <div class="td-module-container">
                <?php echo $this->get_image($image_size, true);?>

                <div class="td-module-meta-info">
                    <?php if ($category_position == 'above') { echo $this->get_category(); }?>

                    <?php echo $this->get_title($title_length);?>

                    <?php if ($excerpt_position == 'yes') { echo $excerpt; } ?>

                    <div class="td-editor-date">
                        <?php if ($category_position == '') { echo $this->get_category(); }?>

                        <span class="td-author-date">
                            <?php echo $this->get_author();?>
                            <?php echo $this->get_date();?>
                            <?php echo $this->get_comments();?>
                        </span>
                    </div>

                    <?php if ($excerpt_position == '') { echo $excerpt; } ?>
                </div>
            </div>
        </div>

        <?php return ob_get_clean();
    }
}