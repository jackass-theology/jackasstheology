<?php
/**
 * Grid block part for displaying product content in page.php
 *
 * @package Magazine 7
 */
?>



        <div class="aft-product-list-thumb">

            <?php
            /**
             * woocommerce_before_shop_loop_item hook.
             *
             * @hooked woocommerce_template_loop_product_link_open - 10
             */
            do_action('magazine_7_woocommerce_template_loop_product_link_open');


            /**
             * woocommerce_before_shop_loop_item_title hook
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */

            do_action('magazine_7_woocommerce_show_product_loop_sale_flash');
            do_action('magazine_7_woocommerce_template_loop_product_thumbnail');

            /**
             * magazine_7_woocommerce_template_loop_product_link_close hook.
             *
             * @hooked woocommerce_template_loop_product_link_close - 10
             */
            do_action('magazine_7_woocommerce_template_loop_product_link_close');


            ?>
        </div>


    <div class="aft-product-list-desc">
        <?php

        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action('magazine_7_woocommerce_template_loop_product_link_open');

        ?>
        <div class="aft-product-list-title">
            <?php

            /**
             * woocommerce_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_product_title - 10
             */
            do_action('magazine_7_woocommerce_shop_loop_item_title');
            ?>

        </div>
        <div class="aft-product-list-rating">
            <?php
            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action('magazine_7_woocommerce_after_shop_loop_item_title');
            ?>

        </div>

        <?php

        /**
         * woocommerce_before_shop_loop_item hook.
         *
         * @hooked woocommerce_template_loop_product_link_open - 10
         */
        do_action('magazine_7_woocommerce_template_loop_product_link_close'); ?>
        <div class="aft-product-list-add-to-cart">
            <?php
            /**
             * woocommerce_after_shop_loop_item hook.
             *
             * @hooked woocommerce_template_loop_add_to_cart - 10
             */
            do_action('magazine_7_woocommerce_template_loop_add_to_cart');
            ?>
         </div>

        </div>

