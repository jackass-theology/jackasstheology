<?php
/**
 * Header bar template part.
 *
 */
?>
<header id="#top" itemscope itemtype="<?php echo td_global::$http_or_https?>://schema.org/WPHeader" class="td-header-wrap">
	<div id="td-header-menu">
        <!-- Logo -->
        <div class="td-main-menu-logo">
            <?php $td_customLogo = td_util::get_option('tds_logo_menu_upload'); ?>
            <a class="td-logo" href="<?php echo esc_url( $this->get( 'home_url' ) ); ?>">
                <?php if ( $td_customLogo ) : ?>
                    <amp-img src="<?php echo esc_url( $td_customLogo ); ?>" width="320" height="96" class="td-amp-site-logo"></amp-img>
                <?php endif; ?>
            </a>
        </div>
	</div>

    <!-- Search -->
    <div class="td-search-icon">
        <a href="<?php echo esc_url( add_query_arg( 's', '', site_url( '/' ) ) ) ?>" role="button" target="_blank"><i class="td-icon-search"></i></a>
    </div>
</header>