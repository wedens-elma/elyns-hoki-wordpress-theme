<?php
/**
 * Template Name: Contact
 *
 * @package elyns-hoki
 */
get_header();

$company      = 'PT. ELYNS HOLONG KOMODITI';
$whatsapp     = elyns_get( 'elyns_phone', '6287845195050' );
$phone_disp   = elyns_get( 'elyns_phone_display', '0878 4519 5050' );
$email        = elyns_get( 'elyns_email', 'sales@elynshoki.com' );
$address      = elyns_get( 'elyns_address', 'GRIYA AIRA TANDEAN BLOK E 11, JL. K F TANDEAN BANDAR UTAMA, TEBING TINGGI, SUMUT 20613' );
$map_embed    = elyns_get( 'elyns_map_embed', '' );
$intro        = elyns_get( 'elyns_inquiry_intro', 'Tell us your product needs and our team will get back to you with suitable information.' );
?>

<main id="main-content">
    <section class="page-hero">
        <div class="container">
            <span class="section-label">Contact</span>
            <h1 class="page-hero__title">Contact PT. ELYNS HOLONG KOMODITI</h1>
            <p class="page-hero__desc"><?php echo esc_html( $intro ); ?></p>
        </div>
    </section>

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php if ( trim( get_the_content() ) ) : ?>
            <section class="section--sm" style="padding:3rem 0 0;">
                <div class="container" style="max-width:820px;color:var(--color-text-muted);">
                    <?php the_content(); ?>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; endif; ?>

    <section class="section">
        <div class="container">
            <div class="contact-grid">
                <aside class="contact-info" aria-label="Contact information">
                    <div class="contact-info-item">
                        <div class="contact-info-icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/></svg>
                        </div>
                        <div>
                            <p class="contact-info-label">Company</p>
                            <p class="contact-info-value"><?php echo esc_html( $company ); ?></p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-info-icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <p class="contact-info-label">Address</p>
                            <p class="contact-info-value"><?php echo esc_html( $address ); ?></p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-info-icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.1h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9a16 16 0 0 0 6.29 6.29l.82-.82a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div>
                            <p class="contact-info-label">WhatsApp</p>
                            <p class="contact-info-value"><a href="https://wa.me/<?php echo esc_attr( preg_replace( '/\D/', '', $whatsapp ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $phone_disp ); ?></a></p>
                        </div>
                    </div>

                    <div class="contact-info-item">
                        <div class="contact-info-icon" aria-hidden="true">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div>
                            <p class="contact-info-label">Email</p>
                            <p class="contact-info-value"><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
                        </div>
                    </div>
                </aside>

                <section class="contact-form" aria-labelledby="inquiry-heading">
                    <h2 class="contact-form__title" id="inquiry-heading">Send a Product Inquiry</h2>
                    <p class="contact-form__desc"><?php echo esc_html( $intro ); ?></p>

                    <form data-elyns-contact-form>
                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="name">Name *</label>
                                <input class="form-input" type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="company">Company Name</label>
                                <input class="form-input" type="text" id="company" name="company">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="email">Email *</label>
                                <input class="form-input" type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="phone">Phone or WhatsApp</label>
                                <input class="form-input" type="text" id="phone" name="phone">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="product">Product Interest</label>
                                <select class="form-select" id="product" name="product">
                                    <option value="">Select a product</option>
                                    <?php
                                    $product_query = elyns_get_products( -1 );
                                    if ( $product_query->have_posts() ) :
                                        while ( $product_query->have_posts() ) : $product_query->the_post();
                                            echo '<option value="' . esc_attr( get_the_title() ) . '">' . esc_html( get_the_title() ) . '</option>';
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="quantity">Estimated Quantity</label>
                                <input class="form-input" type="text" id="quantity" name="quantity" placeholder="Example: 500 kg, 1 container, monthly supply">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="destination">Destination Country or City</label>
                            <input class="form-input" type="text" id="destination" name="destination">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="message">Message</label>
                            <textarea class="form-textarea" id="message" name="message" placeholder="Tell us about your product requirements, preferred specification, timeline, or other details."></textarea>
                        </div>

                        <div data-form-status class="form-status" role="status" aria-live="polite"></div>

                        <div class="btn-group">
                            <button type="submit" class="btn btn--primary btn--lg">Send Inquiry</button>
                            <a href="<?php echo esc_url( elyns_get_whatsapp_url() ); ?>" class="btn btn--secondary btn--lg" target="_blank" rel="noopener">Chat via WhatsApp</a>
                        </div>
                    </form>
                </section>
            </div>

            <div class="map-embed" aria-label="Map location">
                <?php if ( $map_embed ) : ?>
                    <iframe src="<?php echo esc_url( $map_embed ); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="PT. ELYNS HOLONG KOMODITI location"></iframe>
                <?php else : ?>
                    <div style="text-align:center;padding:2rem;color:var(--color-text-muted);">
                        <strong style="display:block;color:var(--color-primary);margin-bottom:0.5rem;">Google Maps Placeholder</strong>
                        Add the Google Maps embed URL from Appearance → Customize → Contact Information.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
