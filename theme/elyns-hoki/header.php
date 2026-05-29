<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
    <div class="header-inner">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url('/') ); ?>" class="site-logo" rel="home">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <div class="site-logo__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C7.4 2 3 5.7 3 10.5c0 3.6 2.2 6.7 5.4 8.1L12 22l3.6-3.4C18.8 17.2 21 14.1 21 10.5 21 5.7 16.6 2 12 2zm0 2c3.3 0 7 2.8 7 6.5 0 2.9-1.8 5.4-4.5 6.6L12 19l-2.5-1.9C6.8 15.9 5 13.4 5 10.5 5 6.8 8.7 4 12 4z" opacity=".9"/>
                        <path d="M12 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-4 6c0 2.2 1.8 4 4 4s4-1.8 4-4"/>
                    </svg>
                </div>
                <div class="site-logo__text">
                    <span class="site-logo__name">PT. ELYNS HOLONG</span>
                    <span class="site-logo__tagline">Agricultural Commodities</span>
                </div>
            <?php endif; ?>
        </a>

        <!-- Primary Navigation -->
        <nav class="main-nav" id="main-navigation" aria-label="Primary navigation">
            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class'     => '',
                'container'      => false,
                'fallback_cb'    => 'elyns_default_nav',
            ]);
            ?>
        </nav>

        <!-- Header CTA -->
        <div class="header-cta">
            <a href="https://wa.me/<?php echo esc_attr( preg_replace('/\D/', '', elyns_get('elyns_phone', '6287845195050') ) ); ?>"
               class="btn btn--primary btn--sm"
               target="_blank" rel="noopener noreferrer">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M5.337 5.337c-3.333 3.333-3.333 8.748 0 12.08L12 24l6.663-6.583c3.333-3.333 3.333-8.747 0-12.08-3.332-3.333-8.747-3.333-12.08 0z" opacity=".15"/></svg>
                WhatsApp
            </a>

            <!-- Mobile Toggle -->
            <button class="menu-toggle" id="menu-toggle" aria-expanded="false" aria-controls="mobile-nav" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </div>

    </div>
</header>

<!-- Mobile Navigation -->
<nav class="mobile-nav" id="mobile-nav" aria-label="Mobile navigation" aria-hidden="true">
    <?php
    wp_nav_menu([
        'theme_location' => 'primary',
        'menu_class'     => '',
        'container'      => false,
        'fallback_cb'    => 'elyns_default_nav',
    ]);
    ?>
    <a href="https://wa.me/<?php echo esc_attr( preg_replace('/\D/', '', elyns_get('elyns_phone', '6287845195050') ) ); ?>"
       class="btn btn--primary"
       target="_blank" rel="noopener noreferrer">
        WhatsApp Us
    </a>
</nav>

<?php

function elyns_default_nav() {
    $pages = [
        home_url('/')                          => 'Home',
        home_url('/about')                     => 'About Us',
        home_url('/products')                  => 'Products',
        home_url('/quality-sustainability')    => 'Quality & Sustainability',
        home_url('/gallery')                   => 'Gallery',
        home_url('/contact')                   => 'Contact',
    ];
    echo '<ul>';
    foreach ( $pages as $url => $label ) {
        $active = ( $_SERVER['REQUEST_URI'] === parse_url($url, PHP_URL_PATH) ) ? ' class="current-menu-item"' : '';
        echo '<li' . $active . '><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
    }
    echo '</ul>';
}
