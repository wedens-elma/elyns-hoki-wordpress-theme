<?php
/**
 * Template Name: Quality & Sustainability
 *
 * @package elyns-hoki
 */
get_header();
?>

<main id="main-content">
    <section class="page-hero">
        <div class="container">
            <span class="section-label">Quality &amp; Sustainability</span>
            <h1 class="page-hero__title">Quality-Focused and Responsible Agricultural Supply</h1>
            <p class="page-hero__desc">A grounded approach to product selection, local partnerships, responsible sourcing, and export-oriented handling.</p>
        </div>
    </section>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php if ( trim( get_the_content() ) ) : ?>
            <section class="section">
                <div class="container" style="max-width:820px;">
                    <?php the_content(); ?>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; endif; ?>

    <section class="section">
        <div class="container">
            <div class="section-header section-header--center">
                <span class="section-label">Our Approach</span>
                <h2>How We Support Better Commodity Supply</h2>
                <p class="section-header__desc">These sections use careful wording to avoid unsupported claims while still communicating credibility to business buyers.</p>
            </div>

            <div class="quality-features">
                <article class="quality-feature">
                    <div class="quality-feature__icon" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="quality-feature__title">Quality-Focused Selection</h3>
                    <p class="quality-feature__desc">We prioritize product condition, freshness, texture, and suitability for buyer needs. Our sourcing and preparation process is designed to help customers receive products that match their intended business use.</p>
                </article>

                <article class="quality-feature">
                    <div class="quality-feature__icon" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <h3 class="quality-feature__title">Farmer and Local Partnership</h3>
                    <p class="quality-feature__desc">We build relationships with local farmers and sourcing partners to support Indonesian agricultural potential. This partnership-based approach helps create broader market opportunities for local commodities.</p>
                </article>

                <article class="quality-feature">
                    <div class="quality-feature__icon" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22V12"/><path d="M12 12C12 12 8 9 5 12s-3 10 7 10"/><path d="M12 12c0 0 4-3 7 0s3 10-7 10"/></svg>
                    </div>
                    <h3 class="quality-feature__title">Responsible Sourcing</h3>
                    <p class="quality-feature__desc">We are committed to supporting agricultural practices that respect biodiversity and environmental care. Our supply approach encourages responsible use of natural agricultural resources.</p>
                </article>

                <article class="quality-feature">
                    <div class="quality-feature__icon" aria-hidden="true">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </div>
                    <h3 class="quality-feature__title">Export-Oriented Handling</h3>
                    <p class="quality-feature__desc">We aim to coordinate distribution, preparation, and export handling so products reach customers in good condition. Requirements can be discussed based on product type, quantity, season, and buyer destination.</p>
                </article>
            </div>
        </div>
    </section>

    <section class="section--sm" style="background-color:var(--color-secondary);padding:3rem 0;">
        <div class="container">
            <div style="max-width:850px;margin:0 auto;background:white;border-left:4px solid var(--color-accent);border-radius:var(--radius-lg);padding:1.75rem 2rem;">
                <span class="section-label">Practical Quality Note</span>
                <p style="font-size:var(--text-lg);color:var(--color-text-muted);margin:0;">Product availability, specifications, and preparation may vary by season and buyer requirement. Please contact our team for updated product information.</p>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <div class="cta-section__content">
                <h2 class="cta-section__title">Need Product Information for Your Business?</h2>
                <p class="cta-section__desc">Share your requirements and we will help you explore suitable supply options.</p>
                <div class="btn-group" style="justify-content:center;">
                    <a href="<?php echo esc_url( home_url( '/products' ) ); ?>" class="btn btn--white btn--lg">Browse Products</a>
                    <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--ghost btn--lg">Contact Us</a>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
