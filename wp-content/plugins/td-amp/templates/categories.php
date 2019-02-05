<?php
/**
 * Post categories template part.
 *
 */
?>

<?php $categories = get_the_category_list( '', '', $this->ID ); ?>
<?php if ( $categories ) : ?>
		<?php echo $categories; ?>
<?php endif; ?>