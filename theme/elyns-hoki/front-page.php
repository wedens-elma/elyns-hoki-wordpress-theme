<?php
/**
 * Front Page Template
 * @package elyns-hoki
 */

get_header();

// Customizer values
$hero_badge    = elyns_get( 'elyns_hero_badge',    'Indonesian Agricultural Commodity Exporter' );
$hero_headline = elyns_get( 'elyns_hero_headline', 'Supplying Indonesian Agricultural Commodities to <em>Global Markets</em>' );
$hero_desc     = elyns_get( 'elyns_hero_desc',     'PT. ELYNS HOLONG KOMODITI supplies selected agricultural commodities including banana leaves, banana stems, areca nuts, lemongrass, coffee, turmeric, and ginger for business partners across the global market.' );
$cta1_text     = elyns_get( 'elyns_hero_cta1_text', 'View Our Products' );
$cta1_link     = elyns_get( 'elyns_hero_cta1_link', home_url('/products') );
$cta2_text     = elyns_get( 'elyns_hero_cta2_text', 'Contact Us' );
$cta2_link     = elyns_get( 'elyns_hero_cta2_link', home_url('/contact') );
$hero_img_id   = get_theme_mod( 'elyns_hero_image' );
$hero_img_url  = $hero_img_id ? wp_get_attachment_image_url( $hero_img_id, 'hero-bg' ) : '';

$cta_title    = elyns_get( 'elyns_cta_title', 'Looking for Reliable Indonesian Agricultural Commodities?' );
$cta_desc     = elyns_get( 'elyns_cta_desc',  'Tell us your product requirements and our team will help you explore suitable supply options.' );
$cta_btn_text = elyns_get( 'elyns_cta_btn_text', 'Contact Us Today' );
$cta_btn_link = elyns_get( 'elyns_cta_btn_link', home_url('/contact') );
?>

<main id="main-content">

<!-- ============================================================
     SECTION 1: HERO
     ============================================================ -->
<section class="hero" aria-label="Hero">
    <div class="hero__bg"></div>
    <div class="hero__overlay">
        <?php if ( $hero_img_url ) : ?>
            <img src="<?php echo esc_url( $hero_img_url ); ?>" alt="Indonesian agricultural commodities" loading="eager">
        <?php else : ?>
            <!-- Placeholder: replace via Customize → Homepage Hero → Hero Background Image -->
            <img src="https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=1400&q=80" alt="Indonesian agricultural commodities - rice fields and farmland" loading="eager">
        <?php endif; ?>
    </div>

    <div class="hero__content">
        <div class="hero__inner">
            <div class="hero__badge">
                <span></span>
                <?php echo esc_html( $hero_badge ); ?>
            </div>

            <h1 class="hero__headline">
                <?php echo wp_kses( $hero_headline, [ 'em' => [], 'strong' => [], 'br' => [] ] ); ?>
            </h1>

            <p class="hero__desc">
                <?php echo esc_html( $hero_desc ); ?>
            </p>

            <div class="btn-group">
                <a href="<?php echo esc_url( $cta1_link ); ?>" class="btn btn--white btn--lg">
                    <?php echo esc_html( $cta1_text ); ?>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12,5 19,12 12,19"/></svg>
                </a>
                <a href="<?php echo esc_url( $cta2_link ); ?>" class="btn btn--ghost btn--lg">
                    <?php echo esc_html( $cta2_text ); ?>
                </a>
            </div>

            <div class="hero__products" aria-label="Products we supply">
                <?php
                $hero_products = elyns_get_products( 7 );
                if ( $hero_products->have_posts() ) :
                    while ( $hero_products->have_posts() ) : $hero_products->the_post();
                ?>
                    <a class="hero__product-tag" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                ?>
                    <span class="hero__product-tag"><?php esc_html_e( 'Products managed from WordPress admin', 'elyns-hoki' ); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     SECTION 2: TRUST INDICATORS
     ============================================================ -->
<section class="trust-section" aria-label="Why choose us highlights">
    <div class="container">
        <div class="trust-grid">

            <div class="trust-card">
                <div class="trust-card__icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div>
                    <p class="trust-card__title">Selected Agricultural Products</p>
                    <p class="trust-card__desc">We source and supply carefully chosen natural commodities to support consistent product quality.</p>
                </div>
            </div>

            <div class="trust-card">
                <div class="trust-card__icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div>
                    <p class="trust-card__title">Farmer Partnership</p>
                    <p class="trust-card__desc">We work closely with local farmers to build a sustainable agricultural supply network.</p>
                </div>
            </div>

            <div class="trust-card">
                <div class="trust-card__icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8 14s1.5 2 4 2 4-2 4-2"/><line x1="9" y1="9" x2="9.01" y2="9"/><line x1="15" y1="9" x2="15.01" y2="9"/></svg>
                </div>
                <div>
                    <p class="trust-card__title">Quality-Focused Supply</p>
                    <p class="trust-card__desc">Our focus on product freshness, condition, and suitability helps support buyer satisfaction.</p>
                </div>
            </div>

            <div class="trust-card">
                <div class="trust-card__icon" aria-hidden="true">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                </div>
                <div>
                    <p class="trust-card__title">Export-Oriented Service</p>
                    <p class="trust-card__desc">We aim to help Indonesian agricultural products reach broader markets and business opportunities.</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============================================================
     SECTION 3: ABOUT PREVIEW
     ============================================================ -->
<section class="about-preview section" aria-labelledby="about-heading">
    <div class="container">
        <div class="about-preview__grid">

            <div class="about-preview__image">
                <img src="https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=900&q=80"
                     alt="Indonesian agricultural farming - local farmers at work"
                     loading="lazy"
                     width="900" height="600">
                <div class="about-preview__image-badge">
                    <div class="about-preview__badge-icon" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="white"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <div>
                        <p class="about-preview__badge-title">7</p>
                        <p class="about-preview__badge-label">Commodity Products Available</p>
                    </div>
                </div>
            </div>

            <div class="about-preview__content">
                <span class="section-label">About the Company</span>
                <h2 class="about-preview__title" id="about-heading">Indonesian Agricultural Products, Supplied for Global Needs</h2>
                <div class="about-preview__desc">
                    <p>PT. ELYNS HOLONG KOMODITI is an Indonesian agricultural commodity company focused on supplying selected natural products, including banana leaves, banana stems, areca nuts, lemongrass, coffee, turmeric, and ginger.</p>
                    <p>We aim to connect local agricultural potential with broader market opportunities through quality-focused supply, responsible sourcing, and export-oriented service. Our partnerships with local farmers help ensure a dependable and sustainable supply for our business customers.</p>
                </div>
                <a href="<?php echo esc_url( home_url('/about') ); ?>" class="btn btn--primary">
                    Learn More About Us
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12,5 19,12 12,19"/></svg>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     SECTION 4: PRODUCT OVERVIEW
     ============================================================ -->
<section class="products-section section" aria-labelledby="products-heading">
    <div class="container">
        <div class="section-header section-header--center">
            <span class="section-label">What We Supply</span>
            <h2 id="products-heading">Our Agricultural Commodity Products</h2>
            <p class="section-header__desc">From banana leaves to Indonesian coffee and aromatic spices, we supply a range of natural agricultural products for business and export needs.</p>
        </div>

        <?php
        $products = elyns_get_products( 7 );
        if ( $products->have_posts() ) : ?>
            <div class="product-grid">
                <?php while ( $products->have_posts() ) : $products->the_post(); ?>
                    <?php get_template_part( 'template-parts/product/card' ); ?>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        <?php else : ?>
            <div style="text-align:center;padding:4rem 2rem;background:white;border-radius:var(--radius-xl);border:1px solid var(--color-border);">
                <h3 style="color:var(--color-primary);margin-bottom:0.5rem;"><?php esc_html_e( 'Products will appear here once added from WordPress admin.', 'elyns-hoki' ); ?></h3>
                <p style="color:var(--color-text-muted);"><?php esc_html_e( 'Go to Products → Add New Product to manage the catalog without editing code.', 'elyns-hoki' ); ?></p>
                <?php if ( current_user_can( 'edit_posts' ) ) : ?>
                    <a href="<?php echo esc_url( admin_url('post-new.php?post_type=product') ); ?>" class="btn btn--primary" style="margin-top:1.5rem;"><?php esc_html_e( 'Add Product', 'elyns-hoki' ); ?></a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div style="text-align:center;margin-top:3rem;">
            <a href="<?php echo esc_url( home_url('/products') ); ?>" class="btn btn--secondary btn--lg">
                View All Products
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12,5 19,12 12,19"/></svg>
            </a>
        </div>
    </div>
</section>

<!-- ============================================================
     SECTION 5: WHY CHOOSE US
     ============================================================ -->
<section class="section" aria-labelledby="why-heading">
    <div class="container">
        <div class="section-header section-header--center">
            <span class="section-label">Why Choose Us</span>
            <h2 id="why-heading">Quality, Selection, and Long-Term Value</h2>
            <p class="section-header__desc">Here are the reasons we believe PT. ELYNS HOLONG KOMODITI is a reliable choice for agricultural commodity sourcing.</p>
        </div>

        <div class="why-us__grid">
            <div class="why-card">
                <div class="why-card__number">01</div>
                <h3 class="why-card__title">Quality</h3>
                <p class="why-card__desc">We focus on supplying carefully selected agricultural products to help maintain product consistency and customer satisfaction. Freshness, condition, and suitability for buyer needs guide our sourcing approach.</p>
            </div>
            <div class="why-card">
                <div class="why-card__number">02</div>
                <h3 class="why-card__title">Selection</h3>
                <p class="why-card__desc">Our product range includes natural Indonesian commodities used across culinary, food ingredient, herbal, and agricultural supply needs, from banana leaves and areca nuts to coffee, turmeric, ginger, and lemongrass.</p>
            </div>
            <div class="why-card">
                <div class="why-card__number">03</div>
                <h3 class="why-card__title">Value</h3>
                <p class="why-card__desc">We aim to create long-term value through reliable sourcing, responsible partnerships, and customer-oriented export support, helping buyers access Indonesian agricultural commodities with confidence.</p>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     SECTION 6: SUPPLY CHAIN PROCESS
     ============================================================ -->
<section class="process-section section" aria-labelledby="process-heading">
    <div class="container">
        <div class="section-header section-header--center">
            <span class="section-label" style="color:rgba(255,255,255,0.5);">How It Works</span>
            <h2 id="process-heading" style="color:white;">Our Supply Process</h2>
            <p class="section-header__desc" style="color:rgba(255,255,255,0.65);">A straightforward process from sourcing to delivery to help your business get the products it needs.</p>
        </div>

        <div class="process-grid">
            <div class="process-step">
                <div class="process-step__number">1</div>
                <h3 class="process-step__title">Sourcing</h3>
                <p class="process-step__desc">We source agricultural commodities from local farming partners across key growing regions in Indonesia.</p>
            </div>
            <div class="process-step">
                <div class="process-step__number">2</div>
                <h3 class="process-step__title">Selection</h3>
                <p class="process-step__desc">Products are evaluated for condition, freshness, and suitability before being prepared for the next stage.</p>
            </div>
            <div class="process-step">
                <div class="process-step__number">3</div>
                <h3 class="process-step__title">Preparation</h3>
                <p class="process-step__desc">We coordinate product preparation and packaging based on buyer specifications and requirements.</p>
            </div>
            <div class="process-step">
                <div class="process-step__number">4</div>
                <h3 class="process-step__title">Delivery</h3>
                <p class="process-step__desc">We coordinate logistics and export handling to help products reach buyers in good condition and on schedule.</p>
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     SECTION 7: SUSTAINABILITY
     ============================================================ -->
<section class="section section--bg" aria-labelledby="sustain-heading">
    <div class="container">
        <div class="sustainability__grid">
            <div class="sustainability__content">
                <span class="section-label">Our Commitment</span>
                <h2 id="sustain-heading">Supporting Responsible Agricultural Practices</h2>
                <p style="color:var(--color-text-muted);margin:1.5rem 0 2rem;">We are committed to supporting responsible agricultural practices, building strong relationships with local farmers, and helping Indonesian agricultural products reach broader market opportunities.</p>

                <div class="sustainability__points">
                    <div class="sustainability__point">
                        <div class="sustainability__point-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><path d="M12 22V12M12 12C12 12 8 9 5 12s-3 10 7 10M12 12c0 0 4-3 7 0s3 10-7 10"/></svg>
                        </div>
                        <div>
                            <p class="sustainability__point-title">Local Farmer Partnerships</p>
                            <p class="sustainability__point-desc">We build strong working relationships with local farmers to support sustainable economic growth and maintain consistent supply.</p>
                        </div>
                    </div>
                    <div class="sustainability__point">
                        <div class="sustainability__point-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M8.56 2.75c4.37 6.03 6.02 9.42 8.03 17.72m2.54-15.38c-3.72 4.35-8.94 5.66-16.88 5.85m19.5 1.9c-3.5-.93-6.63-.82-8.94 0-2.58.92-5.01 2.86-7.44 6.32"/></svg>
                        </div>
                        <div>
                            <p class="sustainability__point-title">Sustainable Sourcing</p>
                            <p class="sustainability__point-desc">We aim to pioneer agricultural practices that maintain biodiversity and protect the natural environment for future generations.</p>
                        </div>
                    </div>
                    <div class="sustainability__point">
                        <div class="sustainability__point-icon" aria-hidden="true">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"><polyline points="22,12 18,12 15,21 9,3 6,12 2,12"/></svg>
                        </div>
                        <div>
                            <p class="sustainability__point-title">Export-Oriented Growth</p>
                            <p class="sustainability__point-desc">We help Indonesian agricultural products reach broader market opportunities while maintaining responsible sourcing standards.</p>
                        </div>
                    </div>
                </div>

                <a href="<?php echo esc_url( home_url('/quality-sustainability') ); ?>" class="btn btn--primary" style="margin-top:2rem;">
                    Our Quality Approach
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12,5 19,12 12,19"/></svg>
                </a>
            </div>

            <div class="sustainability__image">
                <img src="https://images.unsplash.com/photo-1500651230702-0e2d8a49d4ad?w=900&q=80"
                     alt="Sustainable farming - Indonesian agricultural landscape"
                     loading="lazy"
                     width="900" height="600">
            </div>
        </div>
    </div>
</section>

<!-- ============================================================
     SECTION 8: GALLERY PREVIEW
     ============================================================ -->


<!-- ============================================================
     SECTION 9: FINAL CTA
     ============================================================ -->
<section class="cta-section" aria-labelledby="cta-heading">
    <div class="container">
        <div class="cta-section__content">
            <span class="section-label" style="color:rgba(255,255,255,0.5);">Get in Touch</span>
            <h2 class="cta-section__title" id="cta-heading">
                <?php echo wp_kses( $cta_title, [ 'br' => [], 'em' => [] ] ); ?>
            </h2>
            <p class="cta-section__desc"><?php echo esc_html( $cta_desc ); ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="<?php echo esc_url( $cta_btn_link ); ?>" class="btn btn--white btn--lg">
                    <?php echo esc_html( $cta_btn_text ); ?>
                </a>
                <a href="https://wa.me/<?php echo esc_attr( preg_replace('/\D/', '', elyns_get('elyns_phone', '6287845195050')) ); ?>?text=<?php echo urlencode('Hello, I would like to inquire about your agricultural products.'); ?>"
                   class="btn btn--ghost btn--lg" target="_blank" rel="noopener">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413z"/><path d="M5.337 5.337c-3.333 3.333-3.333 8.748 0 12.08L12 24l6.663-6.583c3.333-3.333 3.333-8.747 0-12.08-3.332-3.333-8.747-3.333-12.08 0z" opacity=".2"/></svg>
                    WhatsApp Us
                </a>
            </div>
        </div>
    </div>
</section>

</main>

<?php get_footer(); ?>
