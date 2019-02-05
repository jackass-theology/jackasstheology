<?php

class td_module_amp_1 extends td_module {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="td_module_amp_1">
            <?php
                if( 'Newspaper' == TD_THEME_NAME ) {
                    echo $this->get_image('td_218x150');
                } else if( 'Newsmag' == TD_THEME_NAME ) {
                    echo $this->get_image('td_300x194');
                } ?>

            <div class="item-details">
                <?php echo $this->get_title( td_util::get_option('td_module_amp_1_title_excerpt', 22) ); ?>

                <div class="td-module-meta-info">
                    <?php echo $this->get_category(); ?>
                    <?php echo $this->get_date(); ?>
                </div>
            </div>

        </div>

        <?php return ob_get_clean();
    }
}