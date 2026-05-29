<?php
/**
 * Main fallback template
 *
 * @package elyns-hoki
 */
get_header();
?>

<main id="main-content">
    <section class="page-hero">
        <div class="container">
            <span class="section-label"><?php bloginfo( 'name' ); ?></span>
            <h1 class="page-hero__title"><?php echo esc_html( is_home() ? 'Company Updates' : get_the_archive_title() ); ?></h1>
            <?php if ( get_the_archive_description() ) : ?>
                <p class="page-hero__desc"><?php echo wp_kses_post( get_the_archive_description() ); ?></p>
            <?php endif; ?>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <?php if ( have_posts() ) : ?>
                <div class="grid grid-3">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article class="product-card">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <a href="<?php the_permalink(); ?>" class="product-card__image-link">
                                    <div class="product-card__image"><?php the_post_thumbnail( 'product-card', [ 'loading' => 'lazy' ] ); ?></div>
                                </a>
                            <?php endif; ?>
                            <div class="product-card__body">
                                <h2 class="product-card__name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                <p class="product-card__desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
                                <div class="product-card__footer">
                                    <a href="<?php the_permalink(); ?>" class="product-card__link">Read More</a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                <div style="margin-top:3rem;">
                    <?php the_posts_pagination(); ?>
                </div>
            <?php else : ?>
                <p><?php esc_html_e( 'No content found.', 'elyns-hoki' ); ?></p>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
