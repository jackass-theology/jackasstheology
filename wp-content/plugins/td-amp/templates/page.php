<?php
/**
 * Page view template.
 *
 */
?>

<?php require_once( 'html-start.php' ); ?>

<!-- header -->
<?php require_once( 'header.php' ); ?>

    <div class="td-container">
            <div class="td-crumb-container"><?php echo td_page_generator::get_page_breadcrumbs( $this->get( 'post_title' ) ); ?></div>
            <div class="td-main-content">

                <header class="td-page-header">
                    <h1 class="entry-title td-page-title">
                        <span><?php echo esc_html( $this->get( 'post_title' ) ); ?></span>
                    </h1>
                </header>
                <div class="td-page-content">
                    <?php echo $this->get( 'post_amp_content' ); ?>
                </div>

            </div>
        </div>

<!-- comments -->
<?php require_once( 'comments.php' ); ?>

<!-- footer -->
<?php require_once( 'footer.php' ); ?>

<?php require_once( 'html-end.php' ); ?>

