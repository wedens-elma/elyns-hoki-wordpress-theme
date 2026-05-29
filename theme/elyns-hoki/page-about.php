<?php
/**
 * Template Name: About Us
 * @package elyns-hoki
 */
get_header();
?>

<main id="main-content">

<!-- Page Hero -->
<section class="page-hero">
    <div class="container">
        <span class="section-label">Who We Are</span>
        <h1 class="page-hero__title">About PT. ELYNS HOLONG KOMODITI</h1>
        <p class="page-hero__desc">An Indonesian agricultural commodity company connecting local agricultural potential with global market opportunities.</p>
    </div>
</section>

<!-- Company Overview -->
<section class="section">
    <div class="container">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;" class="about-overview-grid">

            <div>
                <span class="section-label">Company Overview</span>
                <h2 style="margin-bottom:1.5rem;">Supplying Indonesian Agricultural Commodities</h2>

                <?php
                // If this page has custom content entered in the editor, show it
                if ( get_the_content() ) {
                    the_content();
                } else {
                    // Default content - editable via page editor
                ?>
                <p>PT. ELYNS HOLONG KOMODITI is an Indonesian agricultural commodity company focused on supplying selected natural products, including banana leaves, banana stems, areca nuts, lemongrass, coffee, turmeric, and ginger, to business partners and markets both locally and internationally.</p>
                <p>We aim to connect the rich agricultural potential of Indonesia with broader market opportunities through quality-focused supply, responsible sourcing, and export-oriented service. Our work is guided by a commitment to building long-term, reliable partnerships with both our farmers and our buyers.</p>
                <p>With a focused product range and a dedication to consistent product quality, we strive to make Indonesian agricultural commodities accessible and dependable for food manufacturers, importers, commodity traders, and other B2B buyers across the supply chain.</p>
                <?php } ?>
            </div>

            <div>
                <img src="https://elynshoki.infinityfreeapp.com/wp-content/uploads/2026/05/elynshoki-sprouts.jpg"
                     alt="Indonesian agricultural commodities - spices and natural products"
                     style="border-radius:var(--radius-xl);width:100%;height:460px;object-fit:cover;"
                     loading="lazy">
            </div>

        </div>
    </div>
</section>

<!-- Vision & Mission -->
<section class="section section--bg">
    <div class="container">
        <div class="section-header section-header--center">
            <span class="section-label">Our Direction</span>
            <h2>Vision &amp; Mission</h2>
        </div>

        <div class="vision-mission__grid">
            <div class="vm-card vm-card--vision">
                <span class="section-label" style="color:rgba(255,255,255,0.5);">Vision</span>
                <h3 style="margin-top:0.5rem;margin-bottom:1rem;">Our Long-Term Goal</h3>
                <p>To become a preferred global supplier of selected Indonesian agricultural commodities, with a continuous focus on quality, innovation, and sustainability.</p>
            </div>

            <div class="vm-card vm-card--mission">
                <span class="section-label">Mission</span>
                <h3 style="margin-top:0.5rem;margin-bottom:0.5rem;">How We Work Toward It</h3>
                <ul class="mission-list">
                    <li class="mission-item">To provide high-quality agricultural products by combining practical innovation with local wisdom.</li>
                    <li class="mission-item">To build strong partnerships with local farmers and support sustainable economic growth.</li>
                    <li class="mission-item">To promote responsible agricultural practices that respect biodiversity and the environment.</li>
                    <li class="mission-item">To optimize distribution and export processes so products reach customers in good condition.</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="section">
    <div class="container">
        <div class="section-header section-header--center">
            <span class="section-label">What Guides Us</span>
            <h2>Our Core Values</h2>
        </div>

        <div class="values-grid">
            <?php
            $values = [
                ['Quality',      'We prioritize product condition, freshness, and suitability to support consistent buyer satisfaction.',
                 '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>'],
                ['Reliability',  'We aim to be a dependable supply partner, consistent in communication, product availability, and service.',
                 '<polyline points="20 6 9 17 4 12"/>'],
                ['Sustainability','We support responsible agricultural practices that protect the environment and respect local farming communities.',
                 '<path d="M12 22V12M12 12C12 12 8 9 5 12s-3 10 7 10M12 12c0 0 4-3 7 0s3 10-7 10"/>'],
                ['Partnership',  'Strong, long-term relationships with farmers and buyers are at the core of how we do business.',
                 '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
                ['Customer Focus','We listen to buyer requirements and work to provide practical, business-oriented commodity solutions.',
                 '<circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/>'],
            ];
            foreach ($values as $val) :
            ?>
            <div class="value-card">
                <div class="value-card__icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <?php echo $val[2]; ?>
                    </svg>
                </div>
                <h4 class="value-card__title"><?php echo esc_html($val[0]); ?></h4>
                <p style="font-size:var(--text-xs);color:var(--color-text-muted);margin-top:0.5rem;line-height:1.6;"><?php echo esc_html($val[1]); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Local Roots -->
<section class="section section--bg">
    <div class="container">
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;" class="about-overview-grid">
            <div>
                <img src="https://elynshoki.infinityfreeapp.com/wp-content/uploads/2026/05/elynshoki-turmeric-and-ginger.jpg"
                     alt="Indonesian spice and herbal products - turmeric and ginger"
                     style="border-radius:var(--radius-xl);width:100%;height:420px;object-fit:cover;"
                     loading="lazy">
            </div>
            <div>
                <span class="section-label">Our Roots</span>
                <h2 style="margin-bottom:1.5rem;">Local Roots, Broader Market Reach</h2>
                <p style="color:var(--color-text-muted);">Based in Tebing Tinggi, North Sumatra, PT. ELYNS HOLONG KOMODITI is grounded in the agricultural richness of Indonesia. We believe in the quality and potential of Indonesian natural products, and our goal is to help those products reach the buyers and markets where they can be used and valued.</p>
                <p style="color:var(--color-text-muted);">Through careful sourcing, responsible supply practices, and customer-oriented service, we aim to create connections that benefit both local agricultural communities and international buyers looking for dependable Indonesian commodity partners.</p>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn--primary" style="margin-top:1.5rem;">
                    Get in Touch
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <div class="cta-section__content">
            <h2 class="cta-section__title">Interested in Our Products?</h2>
            <p class="cta-section__desc">Contact our team to discuss your agricultural commodity requirements.</p>
            <div class="btn-group" style="justify-content:center;">
                <a href="<?php echo esc_url(home_url('/products')); ?>" class="btn btn--white btn--lg">Browse Products</a>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn--ghost btn--lg">Contact Us</a>
            </div>
        </div>
    </div>
</section>

</main>

<style>
@media (max-width:768px) {
  .about-overview-grid { grid-template-columns: 1fr !important; }
}
</style>

<?php get_footer(); ?>
