<?php
/**
 * Template Name: Products
 * Also used by: archive-product.php
 * @package elyns-hoki
 */
get_header();
?>

<main id="main-content">

<section class="page-hero">
    <div class="container">
        <span class="section-label">What We Supply</span>
        <h1 class="page-hero__title">Agricultural Commodity Products from Indonesia</h1>
        <p class="page-hero__desc">Browse our range of selected Indonesian agricultural commodities — available for business inquiry, export, and distribution supply.</p>
    </div>
</section>

<section class="section products-archive">
    <div class="container">

        <?php
        // Editor content (intro text)
        if ( is_page() && get_the_content() ) {
            echo '<div class="page-intro" style="max-width:700px;margin-bottom:3rem;color:var(--color-text-muted);">';
            the_content();
            echo '</div>';
        }
        ?>

        <?php
        $products = elyns_get_products( -1 );

        if ( $products->have_posts() ) :
        ?>
            <div class="product-grid">
                <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    <?php get_template_part( 'template-parts/product/card' ); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <div style="text-align:center;padding:4rem 2rem;background:var(--color-secondary);border-radius:var(--radius-xl);">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="1" style="margin:0 auto 1rem;" aria-hidden="true"><path d="M12 2a10 10 0 0 1 10 10c0 5.52-4.48 10-10 10S2 17.52 2 12 6.48 2 12 2z" opacity=".3"/><path d="M12 8v4M12 16h.01"/></svg>
                <h3 style="color:var(--color-primary);margin-bottom:0.5rem;">Products Coming Soon</h3>
                <p style="color:var(--color-text-muted);">Products will appear here once added from the WordPress admin.</p>
                <?php if ( is_user_logged_in() ) : ?>
                    <a href="<?php echo admin_url('post-new.php?post_type=product'); ?>" class="btn btn--primary" style="margin-top:1.5rem;">
                        Add Your First Product
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Spec Note -->
<section class="section--sm" style="background-color:var(--color-secondary);padding:2.5rem 0;">
    <div class="container">
        <div style="display:flex;align-items:flex-start;gap:1rem;max-width:800px;margin:0 auto;background:white;border-radius:var(--radius-lg);padding:1.5rem 2rem;border-left:4px solid var(--color-accent);">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--color-accent)" stroke-width="2" style="flex-shrink:0;margin-top:2px;" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <p style="font-size:var(--text-sm);color:var(--color-text-muted);margin:0;"><strong style="color:var(--color-text);">Product Availability Note:</strong> Detailed specifications, packaging, and availability can be discussed based on buyer requirements. Product availability may vary by season and order quantity. Please contact our team for current product information.</p>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <div class="cta-section__content">
            <span class="section-label" style="color:rgba(255,255,255,0.5);">Let's Talk</span>
            <h2 class="cta-section__title">Ready to Discuss Your Commodity Requirements?</h2>
            <p class="cta-section__desc">Send us your inquiry and our team will get back to you with suitable supply information.</p>
            <div class="btn-group" style="justify-content:center;">
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn--white btn--lg">Send an Inquiry</a>
                <a href="https://wa.me/<?php echo esc_attr(preg_replace('/\D/', '', elyns_get('elyns_phone', '6287845195050'))); ?>"
                   class="btn btn--ghost btn--lg" target="_blank" rel="noopener">WhatsApp Us</a>
            </div>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>
