<?php

class td_block_homepage_full_1 extends td_block {


    function render($atts, $content = null) {
        parent::render($atts); // sets the live atts, $this->atts, $this->block_uid, $this->td_query (it runs the query)
        $buffy = $this->get_block_js(); //output buffer



	    // @todo 17 aug 2016 - the el_class will be added here and also in the template from self::inner
        $buffy .= '<div class="' . $this->get_block_classes() . '">';
        $buffy .= '<div id=' . $this->block_uid . ' class="td_block_inner">';
        $buffy .= $this->inner($this->td_query->posts);//inner content of the block
        $buffy .= '</div>';
        $buffy .= '</div> <!-- ./block -->';
        return $buffy;
    }

    function inner($posts, $td_column_number = '') {
        ob_start();

        if (!empty($posts[0])) {

            $post = $posts[0]; //we get only one post

	        // add class to body, no jQuery and inline
	        ob_start(); ?>
	        <script>
		        document.body.className+=' td-boxed-layout single_template_8 homepage-post ';
	        </script>
	        <?php echo(ob_get_clean());


			//make the js template
	        $td_mod_single = new td_module_single($post);

	        $el_class = $this->get_att('el_class');


	        ?>
	        <script type="text/template" id="<?php echo $this->block_uid . '_tmpl' ?>">

		        <div id="post-<?php echo $td_mod_single->post->ID;?>" class="post td-post-template-8 <?php echo $el_class ?>">
			        <div class="td-post-header td-image-gradient-style8">
				        <div class="td-crumb-container"><?php echo td_page_generator::get_single_breadcrumbs($td_mod_single->title); ?></div>

				        <div class="td-post-header-holder">

					        <header class="td-post-title">

						        <?php echo $td_mod_single->get_category(); ?>
						        <?php echo $td_mod_single->get_title();?>


						        <?php if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { ?>
							        <p class="td-post-sub-title"><?php echo $td_mod_single->td_post_theme_settings['td_subtitle']; ?></p>
						        <?php } ?>

						        <div class="td-module-meta-info">
							        <?php echo $td_mod_single->get_author();?>
							        <?php echo $td_mod_single->get_date(false);?>
							        <?php echo $td_mod_single->get_views();?>
							        <?php echo $td_mod_single->get_comments();?>
						        </div>

					        </header>
				        </div>
			        </div>
		        </div>

	        </script>
	        <?php

            $js = $this->getTmplJsScript( $post );
            td_js_buffer::add_to_footer($js);
        }
        return ob_get_clean();

    }


	private function getTmplJsScript( $post ) {
		$td_post_featured_image = td_util::get_featured_image_src($post->ID, 'full');

		ob_start();
		?>
		<script>

			(function() {

				var tdHomepageFullItem = new tdHomepageFull.item();

				tdHomepageFullItem.theme_name = '<?php echo TD_THEME_NAME ?>';

				tdHomepageFullItem.postId = '<?php echo $post->ID ?>';
				tdHomepageFullItem.blockUid = '<?php echo $this->block_uid ?>';
				tdHomepageFullItem.postFeaturedImage = '<?php echo $td_post_featured_image ?>';

				tdHomepageFull.addItem( tdHomepageFullItem );
				document.body.className+=' td-boxed-layout single_template_8 homepage-post ';


			})();

		</script>
		<?php
		$buffer = ob_get_clean();
		$js = "\n". td_util::remove_script_tag($buffer);

		return $js;
	}



	function js_tdc_callback_ajax() {
		$buffy = '';

		// add a new composer block - that one has the delete callback
		$buffy .= $this->js_tdc_get_composer_block();

		$posts = $this->td_query->posts;

		if (!empty($posts[0])) {

			return $buffy . $this->getTmplJsScript( $posts[0] );
		}
		return $buffy;
	}
}