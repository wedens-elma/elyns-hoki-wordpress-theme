<?php
/**
 * Template Part: Product Card
 * Usage: get_template_part( 'template-parts/product/card' );
 * Called within a WP_Query loop for 'product' post type
 *
 * @package elyns-hoki
 */

$short_desc = get_post_meta( get_the_ID(), '_product_short_desc', true );
$cta_text   = get_post_meta( get_the_ID(), '_product_cta_text', true ) ?: __( 'View Details', 'elyns-hoki' );
?>

<article class="product-card" itemscope itemtype="https://schema.org/Product">

    <a href="<?php the_permalink(); ?>" class="product-card__image-link" tabindex="-1" aria-hidden="true">
        <div class="product-card__image">
            <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'product-card', [
                    'alt'   => get_the_title(),
                    'itemprop' => 'image',
                    'loading'  => 'lazy',
                ]); ?>
            <?php else : ?>
                <div class="product-card__placeholder" aria-hidden="true">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                        <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21,15 16,10 5,21"/>
                    </svg>
                    <span>Product Image</span>
                </div>
            <?php endif; ?>
        </div>
    </a>

    <div class="product-card__body">
        <h3 class="product-card__name" itemprop="name">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <?php if ( $short_desc ) : ?>
            <p class="product-card__desc" itemprop="description"><?php echo esc_html( $short_desc ); ?></p>
        <?php elseif ( get_the_excerpt() ) : ?>
            <p class="product-card__desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
        <?php endif; ?>

        <div class="product-card__footer">
            <a href="<?php the_permalink(); ?>" class="product-card__link" aria-label="<?php echo esc_attr( sprintf( __('View %s details', 'elyns-hoki'), get_the_title() ) ); ?>">
                <?php echo esc_html( $cta_text ); ?>
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12,5 19,12 12,19"/></svg>
            </a>
        </div>
    </div>

</article>
