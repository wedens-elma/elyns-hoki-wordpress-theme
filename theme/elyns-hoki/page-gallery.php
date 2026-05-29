<?php
/**
 * Template Name: Gallery
 *
 * @package elyns-hoki
 */
get_header();

$gallery_ids_str = get_post_meta( get_the_ID(), '_page_gallery_ids', true );
$gallery_ids     = $gallery_ids_str ? array_filter( explode( ',', elyns_sanitize_id_csv( $gallery_ids_str ) ) ) : [];
$default_filters = [ 'All', 'Banana Leaf', 'Banana Stem', 'Areca Nuts', 'Lemongrass', 'Coffee', 'Turmeric', 'Ginger', 'Farming and Sourcing', 'Packaging and Preparation' ];
?>

<main id="main-content">
    <section class="page-hero">
        <div class="container">
            <span class="section-label">Gallery</span>
            <h1 class="page-hero__title">Product Gallery</h1>
            <p class="page-hero__desc">A clean gallery for product photos, farming and sourcing activities, and packaging or preparation images.</p>
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
            <div class="gallery-filter" aria-label="Gallery filters">
                <?php foreach ( $default_filters as $filter ) : ?>
                    <button type="button" class="filter-btn<?php echo 'All' === $filter ? ' active' : ''; ?>" data-filter="<?php echo esc_attr( sanitize_title( $filter ) ); ?>"><?php echo esc_html( $filter ); ?></button>
                <?php endforeach; ?>
            </div>

            <div class="gallery-grid" data-gallery-grid>
                <?php if ( ! empty( $gallery_ids ) ) : ?>
                    <?php foreach ( $gallery_ids as $img_id ) :
                        $img_id = absint( $img_id );
                        $img_url = wp_get_attachment_image_url( $img_id, 'gallery-thumb' );
                        if ( ! $img_url ) continue;
                        $alt = get_post_meta( $img_id, '_wp_attachment_image_alt', true ) ?: get_the_title( $img_id );
                        $caption = wp_get_attachment_caption( $img_id );
                        $label = $caption ?: get_the_title( $img_id );
                        $category = sanitize_title( $caption ?: 'All' );
                    ?>
                        <figure class="gallery-item" data-category="<?php echo esc_attr( $category ); ?>">
                            <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $alt ); ?>" loading="lazy">
                            <figcaption class="gallery-item__overlay"><span class="gallery-item__label"><?php echo esc_html( $label ); ?></span></figcaption>
                        </figure>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php
                    $placeholders = [
                        [ 'Banana Leaf', 'banana-leaf', 'https://images.unsplash.com/photo-1596040033229-a9821ebd058d?w=700&q=80' ],
                        [ 'Turmeric', 'turmeric', 'https://images.unsplash.com/photo-1615485500704-8e990f9900f7?w=700&q=80' ],
                        [ 'Ginger', 'ginger', 'https://images.unsplash.com/photo-1597118271068-2af00d16b7c4?w=700&q=80' ],
                        [ 'Coffee', 'coffee', 'https://images.unsplash.com/photo-1447933601403-0c6688de566e?w=700&q=80' ],
                        [ 'Lemongrass', 'lemongrass', 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?w=700&q=80' ],
                        [ 'Farming and Sourcing', 'farming-and-sourcing', 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=700&q=80' ],
                    ];
                    foreach ( $placeholders as $item ) : ?>
                        <figure class="gallery-item" data-category="<?php echo esc_attr( $item[1] ); ?>">
                            <img src="<?php echo esc_url( $item[2] ); ?>" alt="<?php echo esc_attr( $item[0] ); ?> placeholder image" loading="lazy">
                            <figcaption class="gallery-item__overlay"><span class="gallery-item__label"><?php echo esc_html( $item[0] ); ?> Placeholder</span></figcaption>
                        </figure>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div style="max-width:800px;margin:2.5rem auto 0;background:var(--color-secondary);border-radius:var(--radius-lg);padding:1.25rem 1.5rem;color:var(--color-text-muted);font-size:var(--text-sm);">
                <strong style="color:var(--color-text);">Admin note:</strong> Gallery images are managed from this page editor. Use the Page Gallery Images box to add or replace images. For filter labels, use image captions such as Banana Leaf, Coffee, Farming and Sourcing, or Packaging and Preparation.
            </div>
        </div>
    </section>
</main>

<script>
(function(){
  var buttons = document.querySelectorAll('.filter-btn');
  var items = document.querySelectorAll('[data-gallery-grid] .gallery-item');
  buttons.forEach(function(button){
    button.addEventListener('click', function(){
      var filter = button.getAttribute('data-filter');
      buttons.forEach(function(btn){ btn.classList.remove('active'); });
      button.classList.add('active');
      items.forEach(function(item){
        var cat = item.getAttribute('data-category');
        item.style.display = (filter === 'all' || filter === cat) ? '' : 'none';
      });
    });
  });
})();
</script>

<?php get_footer(); ?>
