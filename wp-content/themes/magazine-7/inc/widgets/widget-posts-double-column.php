<?php
if (!class_exists('Magazine_7_Double_Col_Categorised_Posts')) :
    /**
     * Adds Magazine_7_Double_Col_Categorised_Posts widget.
     */
    class Magazine_7_Double_Col_Categorised_Posts extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('m7-categorised-posts-title', 'm7-categorised-posts-subtitle', 'm7-excerpt-length', 'm7-posts-number');
            $this->select_fields = array('m7-select-category');

            $widget_ops = array(
                'classname' => 'magazine_7_double_col_categorised_posts',
                'description' => __('Displays posts from selected category in double column.', 'magazine-7'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('magazine_7_double_col_categorised_posts', __('M7 Posts - Double Column ', 'magazine-7'), $widget_ops);
        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args Widget arguments.
         * @param array $instance Saved values from database.
         */

        public function widget($args, $instance)
        {

            $instance = parent::m7_sanitize_data($instance, $instance);


            /** This filter is documented in wp-includes/default-widgets.php */

            $title = apply_filters('widget_title', $instance['m7-categorised-posts-title'], $instance, $this->id_base);
            $subtitle = isset($instance['m7-categorised-posts-subtitle']) ? $instance['m7-categorised-posts-subtitle'] : '';
            $category = isset($instance['m7-select-category']) ? $instance['m7-select-category'] : '0';
            $number_of_posts = 4;
            $show_excerpt = isset($instance['m7-show-excerpt']) ? $instance['m7-show-excerpt'] : 'true';
            $excerpt_length = 30;

            // open the widget container
            echo $args['before_widget'];
            ?>
            <?php if (!empty($title) || !empty($subtitle)): ?>
            <div class="em-title-subtitle-wrap">
                <?php if (!empty($title)): ?>
                    <h2 class="widget-title">
                        <span><?php echo esc_html($title); ?></span>
                    </h2>
                <?php endif; ?>
                <?php if (!empty($subtitle)): ?>
                    <p class="em-widget-subtitle"><?php echo esc_html($subtitle); ?></p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
            <?php
                  $all_posts = magazine_7_get_posts($number_of_posts, $category);
            ?>
            <div class="widget-wrapper">
                <div class="row">
                    <?php
                    if ($all_posts->have_posts()) :
                        while ($all_posts->have_posts()) : $all_posts->the_post();
                            if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'magazine-7-medium-square');
                                $url = $thumb['0'];
                            } else {
                                $url = '';
                            }
                            global $post;
                                ?>
                                <div class="col col-five" data-mh="em-double-column" >
                                    <div class="spotlight-post">
                                        <figure class="categorised-article">
                                            <div class="categorised-article-wrapper">
                                                <div class="data-bg data-bg-hover data-bg-categorised" data-background="<?php echo esc_url($url); ?>"><a href="<?php the_permalink(); ?>"></a>

                                                </div>
                                            </div>
                                        </figure>
                                        <div class="figure-categories figure-categories-bg">
                                            <?php echo magazine_7_post_format($post->ID); ?>
                                            <?php magazine_7_post_categories(); ?>
                                        </div>
                                        <figcaption>

                                            <h3 class="article-title article-title-2">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>
                                            <div class="grid-item-metadata">
                                                <?php magazine_7_post_item_meta(); ?>
                                            </div>
                                            <?php if ($show_excerpt != 'false'): ?>
                                                <div class="full-item-discription">
                                                    <div class="post-description">
                                                        <?php if (absint($excerpt_length) > 0) : ?>
                                                            <?php
                                                            $excerpt = magazine_7_get_excerpt($excerpt_length, get_the_content());
                                                            echo wp_kses_post(wpautop($excerpt));
                                                            ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </figcaption>
                                    </div>
                                </div>

                      <?php  endwhile;
                    endif;
                    wp_reset_postdata();
                    ?>

                </div>
            </div>

            <?php
            // close the widget container
            echo $args['after_widget'];
        }

        /**
         * Back-end widget form.
         *
         * @see WP_Widget::form()
         *
         * @param array $instance Previously saved values from database.
         */
        public function form($instance)
        {
            $this->form_instance = $instance;

            $categories = magazine_7_get_terms();

            if (isset($categories) && !empty($categories)) {
                // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                echo parent::m7_generate_text_input('m7-categorised-posts-title', __('Title', 'magazine-7'), __('Double Column Posts', 'magazine-7'));
                echo parent::m7_generate_text_input('m7-categorised-posts-subtitle', __('Subtitle', 'magazine-7'), __('Double Column Posts Subtitle', 'magazine-7' ));
                echo parent::m7_generate_select_options('m7-select-category', __('Select category', 'magazine-7'), $categories);


            }

            //print_pre($terms);


        }

    }
endif;