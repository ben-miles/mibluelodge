<?php
/**
 * @see https://github.com/WordPress/gutenberg/blob/trunk/docs/reference-guides/block-api/block-metadata.md#render
 */
?>

<?php
$headingNormal = !empty( $attributes['headingNormal']) ? $attributes['headingNormal'] : '';
$headingAccented = !empty( $attributes['headingAccented']) ? $attributes['headingAccented'] : '';
?>

<h3 <?php echo get_block_wrapper_attributes(); ?>><?php echo esc_html( $headingNormal ); ?><em><?php echo esc_html( $headingAccented ); ?></em></h3>
