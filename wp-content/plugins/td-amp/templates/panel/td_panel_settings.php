<!-- AMP PLUGIN SETTINGS -->
<?php echo td_panel_generator::box_start('AMP Settings', true); ?>

    <div class="td-box-row">
        <div class="td-box-description td-box-full">
            <span class="td-box-title">tagDiv AMP plugin settings</span>
            <p><a href="https://ampproject.org" target="_blank">The AMP Project</a> is a Google-led initiative that dramatically improves loading speeds on phones and tablets. You can use this panel to adjust theme's amp post pages settings.
            </p>
        </div>
        <div class="td-box-row-margin-bottom"></div>
    </div>

<?php echo td_panel_generator::box_end();?>

<!-- POST TYPES -->
<?php require_once('td_panel_post_types.php'); ?>

<!-- COLORS -->
<?php require_once('td_panel_ads.php'); ?>

<!-- ADS -->
<?php require_once('td_panel_colors.php'); ?>

<!-- EXCERPT -->
<?php require_once('td_panel_excerpts.php'); ?>

<!-- ANALYTICS -->
<?php require_once('td_panel_analytics.php'); ?>

