<?php
/**
 * Single Product Template
 *
 * @package elyns-hoki
 */
get_header();

while ( have_posts() ) : the_post();
    $product_id   = get_the_ID();
    $short_desc   = get_post_meta( $product_id, '_product_short_desc', true );
    $full_desc    = get_post_meta( $product_id, '_product_full_desc', true );
    $applications = elyns_lines_to_array( get_post_meta( $product_id, '_product_applications', true ) );
    $qualities    = elyns_lines_to_array( get_post_meta( $product_id, '_product_qualities', true ) );
    $spec_note    = get_post_meta( $product_id, '_product_spec_note', true ) ?: 'Detailed specifications, packaging, and availability can be discussed based on buyer requirements.';
    $cta_text     = get_post_meta( $product_id, '_product_cta_text', true ) ?: 'Inquire About This Product';
    $cta_link     = get_post_meta( $product_id, '_product_cta_link', true ) ?: home_url( '/contact' );
    $gallery_ids  = elyns_sanitize_id_csv( get_post_meta( $product_id, '_product_gallery', true ) );
    $gallery_ids  = $gallery_ids ? explode( ',', $gallery_ids ) : [];
    $terms        = get_the_terms( $product_id, 'product_category' );
    $category     = ( $terms && ! is_wp_error( $terms ) ) ? $terms[0]->name : 'Agricultural Commodity';
?>

<main id="main-content">
    <section class="page-hero">
        <div class="container">
            <nav class="breadcrumb" aria-label="Breadcrumb" style="justify-content:center;color:rgba(255,255,255,0.7);margin-bottom:1rem;">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="color:rgba(255,255,255,0.7);">Home</a>
                <span class="breadcrumb__sep">/</span>
                <a href="<?php echo esc_url( home_url( '/products' ) ); ?>" style="color:rgba(255,255,255,0.7);">Products</a>
                <span class="breadcrumb__sep">/</span>
                <span class="breadcrumb__current" style="color:white;"><?php the_title(); ?></span>
            </nav>
            <span class="section-label"><?php echo esc_html( $category ); ?></span>
            <h1 class="page-hero__title"><?php the_title(); ?></h1>
            <?php if ( $short_desc ) : ?>
                <p class="page-hero__desc"><?php echo esc_html( $short_desc ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="single-product">
        <div class="container">
            <div class="single-product__grid">
                <div class="product-media">
                    <div class="product-image-main" id="product-main-image">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <?php the_post_thumbnail( 'product-hero', [ 'alt' => get_the_title(), 'loading' => 'eager' ] ); ?>
                        <?php else : ?>
                            <div class="product-card__placeholder" aria-hidden="true">
                                <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21,15 16,10 5,21"/></svg>
                                <span>Add product image from WordPress admin</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if ( ! empty( $gallery_ids ) ) : ?>
                        <div class="product-gallery-thumbs" aria-label="Product gallery thumbnails">
                            <?php foreach ( $gallery_ids as $img_id ) :
                                $thumb_url = wp_get_attachment_image_url( absint( $img_id ), 'gallery-thumb' );
                                $full_url  = wp_get_attachment_image_url( absint( $img_id ), 'product-hero' );
                                $alt       = get_post_meta( absint( $img_id ), '_wp_attachment_image_alt', true ) ?: get_the_title();
                                if ( ! $thumb_url || ! $full_url ) continue;
                            ?>
                                <button type="button" class="product-thumb" data-full="<?php echo esc_url( $full_url ); ?>" data-alt="<?php echo esc_attr( $alt ); ?>" aria-label="View gallery image">
                                    <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy">
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <article class="product-content">
                    <span class="product-content__category"><?php echo esc_html( $category ); ?></span>
                    <h2 class="product-content__title">Product Overview</h2>

                    <div class="product-content__desc">
                        <?php if ( $full_desc ) : ?>
                            <p><?php echo esc_html( $full_desc ); ?></p>
                        <?php else : ?>
                            <?php the_content(); ?>
                        <?php endif; ?>
                    </div>

                    <?php if ( ! empty( $applications ) ) : ?>
                        <div class="product-qualities">
                            <p class="product-qualities__title">Applications / Common Uses</p>
                            <div class="quality-tags">
                                <?php foreach ( $applications as $item ) : ?>
                                    <span class="quality-tag"><?php echo esc_html( $item ); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ( ! empty( $qualities ) ) : ?>
                        <div class="product-qualities">
                            <p class="product-qualities__title">Key Qualities</p>
                            <div class="quality-tags">
                                <?php foreach ( $qualities as $quality ) : ?>
                                    <span class="quality-tag"><?php echo esc_html( $quality ); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="product-spec-note">
                        <?php echo esc_html( $spec_note ); ?>
                    </div>

                    <div class="btn-group">
                        <a href="<?php echo esc_url( $cta_link ); ?>" class="btn btn--primary btn--lg"><?php echo esc_html( $cta_text ); ?></a>
                        <a href="<?php echo esc_url( elyns_get_whatsapp_url( 'Hello, I would like to inquire about ' . get_the_title() . '.' ) ); ?>" class="btn btn--secondary btn--lg" target="_blank" rel="noopener">WhatsApp Us</a>
                    </div>
                </article>
            </div>
        </div>
    </section>

    <section class="related-products">
        <div class="container">
            <div class="section-header section-header--center">
                <span class="section-label">Other Products</span>
                <h2>Related Agricultural Commodities</h2>
            </div>
            <?php
            $related = elyns_get_products( 3, 'meta_value_num', '_product_display_order', [ $product_id ] );
            if ( $related->have_posts() ) : ?>
                <div class="product-grid">
                    <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                        <?php get_template_part( 'template-parts/product/card' ); ?>
                    <?php endwhile; wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<script>
(function(){
  var main = document.getElementById('product-main-image');
  if(!main) return;
  document.querySelectorAll('.product-thumb').forEach(function(btn){
    btn.addEventListener('click', function(){
      var src = btn.getAttribute('data-full');
      var alt = btn.getAttribute('data-alt') || '';
      if(src) main.innerHTML = '<img src="' + src + '" alt="' + alt.replace(/"/g, '&quot;') + '">';
      document.querySelectorAll('.product-thumb').forEach(function(item){ item.classList.remove('active'); });
      btn.classList.add('active');
    });
  });
})();
</script>

<?php endwhile; get_footer(); ?>
