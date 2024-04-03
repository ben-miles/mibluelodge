<?php
/**
 * Office Block template.
 *
 * @param array $block The block settings and attributes.
 */

// Load values and assign defaults.
// $office = !empty(get_field( 'office' )) ? get_field( 'office' ) : '[Office Placeholder]';
// $email = !empty(get_field( 'email' )) ? get_field( 'email' ) : '[Email Placeholder]';

// Create class attribute allowing for custom "className" and "align" values.
// $class_name = 'office';
// if ( ! empty( $block['className'] ) ) {
//     $class_name .= ' ' . $block['className'];
// }
// if ( ! empty( $block['align'] ) ) {
//     $class_name .= ' align' . $block['align'];
// }

?>

<div class="<?php //echo esc_attr( $class_name ); ?>">
    <div class="office__col">
        <blockquote class="office__blockquote">
            <?php //echo esc_html( $quote ); ?>
        </blockquote>
    </div>

    <?php //if ( $image ) : ?>
        <!--div class="office__col">
            <figure class="office__image">
                <?php //echo wp_get_attachment_image( $image['ID'], 'full', '', array( 'class' => 'office__img' ) ); ?>
            </figure>
        </div-->
    <?php //endif; ?>
</div>