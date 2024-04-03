<?php
$align     = isset( $block['align_text'] ) ? $block['align_text'] : 'left';
$textcolor = isset( $block['textColor'] ) ? $block['textColor'] : 'inherit';

if ( substr( $textcolor, 0, 1 ) !== '#' && substr( $textcolor, 0, 4 ) !== 'rgb(' ) {
    $textcolor = 'var(--wp--preset--color--' . $textcolor . ')';
}
?>
<aside class="opening-times" style="color: <?php echo $textcolor; ?>; text-align: <?php echo $align; ?>">
    <h5 style="margin-top: 0; margin-bottom: 0.5rem;">Opening Hours</h5>
    <?php $opening_times = get_field( 'opening_times', get_the_ID() ); ?>
    <?php if ( ! empty( $opening_times ) ) { ?>
        <?php foreach ( $opening_times as $period ) { ?>
            <strong><?php echo $period['time_period']; ?></strong>:
            <?php echo $period['opening_time']; ?>
            <?php if ( ! empty( $period['closing_time'] ) ) { ?>
                - <?php echo $period['closing_time']; ?>
            <?php } ?>
            <br />
        <?php } ?>
    <?php } ?>
</aside>