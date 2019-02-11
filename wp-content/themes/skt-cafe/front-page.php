<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SKT Cafe
 */
get_header(); 

$hideslide = get_theme_mod('hide_slides', 1);
$secwithcontent = get_theme_mod('hide_home_secwith_content', 1);
$hidesecone = get_theme_mod('hide_sectionone', 1);

if (!is_home() && is_front_page()) { 
if( $hideslide == '') { ?>
<!-- Slider Section -->
<?php 
$pages = array();
for($sld=7; $sld<10; $sld++) { 
	$mod = absint( get_theme_mod('page-setting'.$sld));
    if ( 'page-none-selected' != $mod ) {
      $pages[] = $mod;
    }	
} 
if( !empty($pages) ) :
$args = array(
      'posts_per_page' => 3,
      'post_type' => 'page',
      'post__in' => $pages,
      'orderby' => 'post__in'
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) :	
	$sld = 7;
?>
<section id="home_slider">
  <div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
		<?php
        $i = 0;
        while ( $query->have_posts() ) : $query->the_post();
          $i++;
          $skt_cafe_slideno[] = $i;
          $skt_cafe_slidetitle[] = get_the_title();
		  $skt_cafe_slidedesc[] = get_the_excerpt();
          $skt_cafe_slidelink[] = esc_url(get_permalink());
          ?>
          <img src="<?php the_post_thumbnail_url('full'); ?>" title="#slidecaption<?php echo esc_attr( $i ); ?>" />
          <?php
        $sld++;
        endwhile;
          ?>
    </div>
        <?php
        $k = 0;
        foreach( $skt_cafe_slideno as $skt_cafe_sln ){ ?>
    <div id="slidecaption<?php echo esc_attr( $skt_cafe_sln ); ?>" class="nivo-html-caption">
      <div class="slide_info">
        <h2><?php echo esc_html($skt_cafe_slidetitle[$k] ); ?></h2>
        <p><?php echo esc_html($skt_cafe_slidedesc[$k] ); ?></p>
        <div class="clear"></div>
        <a class="slide_more" href="<?php echo esc_url($skt_cafe_slidelink[$k] ); ?>">
          <?php esc_html_e('Read More', 'skt-cafe');?>
          </a>
      </div>
    </div>
 	<?php $k++;
       wp_reset_postdata();
      } ?>
<?php endif; endif; ?>
  </div>
  <div class="clear"></div>
</section>
<?php } } 
?>
<?php
if (!is_home() && is_front_page()) { 
if( $hidesecone == '') { ?>
<section class="homeone_section_area">
    	<div class="center">
            <div class="homeone_section_content">
         	 <?php 
	  		if( get_theme_mod('page-column1',false)) {
			$sectiononequery = new WP_query('page_id='.get_theme_mod('page-column1',true)); 
			while( $sectiononequery->have_posts() ) : $sectiononequery->the_post(); ?>
            
            <div class="hm-leftcols">
            <h2><?php the_title(); ?></h2>
            <?php the_excerpt(); ?> 
            <a class="ReadMore" href="<?php the_permalink(); ?>"><?php echo esc_html_e('Read More', 'skt-cafe');?></a>
            </div>
            <?php if( has_post_thumbnail() ) { ?>
            <div class="hm-rightcols">
				<?php the_post_thumbnail('full'); ?>
            </div>
            <?php } ?>            
          	<?php endwhile;
       		wp_reset_postdata(); 
	   		} ?>
            <div class="clear"></div>
            </div>
        </div>
    </section>
<?php } } ?>
<?php
	if(!is_home() && is_front_page()){ 
	if( $secwithcontent == '') {
?>
 <section id="sectionone">
 	<div class="container">
      <div class="home_section1_content">
		<?php
        $section2_title = get_theme_mod('section2_title');
        if(!empty($section2_title)){
        ?>
        <div class="center-title"><h2><?php echo esc_attr($section2_title); ?></h2></div>
        <?php }
		?>      
        <div class="row_area">	
			<?php 
			for($l=1; $l<5; $l++) { 
	  		if( get_theme_mod('sec-column-left'.$l,false)) {
			$leftblock = new WP_query('page_id='.get_theme_mod('sec-column-left'.$l,true)); 
			while( $leftblock->have_posts() ) : $leftblock->the_post(); 
			?>
			<a href="<?php echo esc_url( get_permalink() ); ?>"><div class="servicebox boxpattern-1">
				<div class="serviceboxbg">
                	 <?php if( has_post_thumbnail() ) { ?>
					<div class="services-thumb"><?php the_post_thumbnail('full'); ?></div>
                    <?php } ?>
					<div class="servicebox-content">
						<h3><?php the_title(); ?></h3>					
                        <?php the_excerpt(); ?>	
					</div>
				</div>
			</div></a>
			<?php endwhile; wp_reset_postdata(); 
               }} 
            ?>             
</div>
      </div>
    </div>
 </section>
<?php }} ?>  
<div class="container">
     <div class="page_content">
      <?php 
	if ( 'posts' == get_option( 'show_on_front' ) ) {
    ?>
    <section class="site-main">
      <div class="blog-post">
        <?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
                            get_template_part( 'content', get_post_format() );
                        endwhile;
                        // Previous/next post navigation.
						the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => esc_html__( 'Back', 'skt-cafe' ),
							'next_text' => esc_html__( 'Next', 'skt-cafe' ),
						) );
                    else :
                        // If no content, include the "No posts found" template.
                         get_template_part( 'no-results', 'index' );
                    endif;
                    ?>
      </div>
      <!-- blog-post --> 
    </section>
    <?php
} else {
    ?>
	<section class="site-main">
      <div class="blog-post">
        <?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
							 ?>
                             <header class="entry-header">           
            				<h1><?php the_title(); ?></h1>
                    		</header>
                             <?php
                            the_content();
                        endwhile;
                        // Previous/next post navigation.
						the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => esc_html__( 'Back', 'skt-cafe' ),
							'next_text' => esc_html__( 'Next', 'skt-cafe' ),
						) );
                    else :
                        // If no content, include the "No posts found" template.
                         get_template_part( 'no-results', 'index' );
                    endif;
                    ?>
      </div>
      <!-- blog-post --> 
    </section>
	<?php
}
	?>
    <?php get_sidebar();?>
    <div class="clear"></div>
  </div><!-- site-aligner -->
</div><!-- content -->
<?php get_footer(); ?>