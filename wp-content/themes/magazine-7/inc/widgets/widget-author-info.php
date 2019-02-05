<?php
if (!class_exists('Magazine_7_author_info')) :
    /**
     * Adds Magazine_7_author_info widget.
     */
    class Magazine_7_author_info extends AFthemes_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $this->text_fields = array('m7-author-info-title', 'm7-author-info-subtitle', 'm7-author-info-image', 'm7-author-info-name', 'm7-author-info-desc', 'm7-author-info-phone','m7-author-info-email');
            $this->url_fields = array('m7-author-info-facebook', 'm7-author-info-twitter', 'm7-author-info-linkedin', 'm7-author-info-instagram', 'm7-author-info-vk', 'm7-author-info-googleplus' );

            $widget_ops = array(
                'classname' => 'magazine_7_author_info_widget',
                'description' => __('Displays author info.', 'magazine-7'),
                'customize_selective_refresh' => true,
            );

            parent::__construct('magazine_7_author_info', __('M7 Author Info', 'magazine-7'), $widget_ops);
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


                echo $args['before_widget'];
                $title = apply_filters('widget_title', $instance['m7-author-info-title'], $instance, $this->id_base);
                $subtitle = isset($instance['m7-author-info-subtitle']) ? ($instance['m7-author-info-subtitle']) : '';
                $profile_image = isset($instance['m7-author-info-image']) ? ($instance['m7-author-info-image']) : '';
                $name = isset($instance['m7-author-info-name']) ? ($instance['m7-author-info-name']) : '';

                $desc = isset($instance['m7-author-info-desc']) ? ($instance['m7-author-info-desc']) : '';
                $facebook = isset($instance['m7-author-info-facebook']) ? ($instance['m7-author-info-facebook']) : '';
                $twitter = isset($instance['m7-author-info-twitter']) ? ($instance['m7-author-info-twitter']) : '';
                $linkedin = isset($instance['m7-author-info-linkedin']) ? ($instance['m7-author-info-linkedin']) : '';




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
                <div class="posts-author-wrapper">

                    <?php if (!empty($profile_image)) : ?>
                        <figure class="em-author-img bg-image">
                            <img src="<?php echo esc_attr($profile_image); ?>" alt=""/>
                        </figure>
                    <?php endif; ?>
                    <div class="em-author-details">
                    <?php if (!empty($name)) : ?>
                        <h4 class="em-author-display-name"><?php echo esc_html($name); ?></h4>
                    <?php endif; ?>
                        <?php if (!empty($phone)) : ?>
                            <a href="tel:<?php echo esc_attr($phone); ?>" class="em-author-display-phone"><?php echo esc_html($phone); ?></a>
                        <?php endif; ?>
                        <?php if (!empty($email)) : ?>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="em-author-display-email"><?php echo esc_html($email); ?></a>
                        <?php endif; ?>
                    <?php if (!empty($desc)) : ?>
                        <p class="em-author-display-name"><?php echo esc_html($desc); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($facebook) || !empty($twitter) || !empty($linkedin)) : ?>
                        <ul>
                            <?php if (!empty($facebook)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($facebook); ?>" target="_blank"><i
                                                class='fab fa-facebook-f'></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($twitter)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($twitter); ?>" target="_blank"><i
                                                class='fab fa-twitter'></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($linkedin)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($linkedin); ?>" target="_blank"><i
                                                class='fab fa-linkedin-in'></i></a>
                                </li>
                            <?php endif; ?>

                            <?php if (!empty($instagram)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($instagram); ?>" target="_blank"><i
                                                class='fab fa-instagram'></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($vk)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($vk); ?>" target="_blank"><i
                                                class='fab fa-vk'></i></a>
                                </li>
                            <?php endif; ?>
                            <?php if (!empty($googleplus)) : ?>
                                <li>
                                    <a href="<?php echo esc_url($googleplus); ?>" target="_blank"><i
                                                class='fab fa-google-plus-g'></i></a>
                                </li>
                            <?php endif; ?>
                        </ul>

                    <?php endif; ?>
                    </div>
                </div>
                <?php
                //print_pre($all_posts);
                // close the widget container
                echo $args['after_widget'];

            //$instance = parent::m7_sanitize_data( $instance, $instance );


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
                echo parent::m7_generate_text_input('m7-author-info-title', __('Title', 'magazine-7'), __('Title', 'magazine-7'));
                echo parent::m7_generate_text_input('m7-author-info-subtitle', __('Subtitle', 'magazine-7'), __('Subtitle', 'magazine-7'));
                echo parent::m7_generate_image_upload('m7-author-info-image', __('Profile image', 'magazine-7'), __('Profile image', 'magazine-7'));
                echo parent::m7_generate_text_input('m7-author-info-name', __('Name', 'magazine-7'), __('Name', 'magazine-7'));
                echo parent::m7_generate_text_input('m7-author-info-desc', __('Descriptions', 'magazine-7'), '');
                echo parent::m7_generate_text_input('m7-author-info-facebook', __('Facebook', 'magazine-7'), '');
                echo parent::m7_generate_text_input('m7-author-info-twitter', __('Twitter', 'magazine-7'), '');
                echo parent::m7_generate_text_input('m7-author-info-linkedin', __('LinkedIn', 'magazine-7'), '');


            }
        }
    }
endif;