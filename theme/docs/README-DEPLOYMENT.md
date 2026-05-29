# Elyns Hoki WordPress Theme

Custom WordPress theme for PT. ELYNS HOLONG KOMODITI.

## What this package includes

- Editable WordPress custom theme
- Products custom post type
- Product category taxonomy
- Product fields for short description, full description, applications, key qualities, specification note, gallery images, CTA text, CTA link, and display order
- Product archive and product detail page
- Gallery page with WordPress Media Library selector
- Contact page with AJAX form and WhatsApp CTA
- Customizer settings for hero, CTA, contact information, map embed, and footer text
- Mobile navigation JavaScript
- Contact form JavaScript
- First-time seed of editable pages and default products

## Recommended hosting requirements

Use hosting that supports:

- WordPress 6.x or newer
- PHP 8.3 or newer recommended
- MySQL 8.0 or MariaDB 10.6 or newer recommended
- HTTPS SSL certificate
- Apache or Nginx

## Installation on an existing WordPress site

1. Log in to WordPress Admin.
2. Go to Appearance > Themes > Add New > Upload Theme.
3. Upload `elyns-hoki-complete.zip`.
4. Click Install Now.
5. Click Activate.
6. Go to Settings > Permalinks and click Save Changes once.
7. Go to Appearance > Menus and create or review the primary menu.
8. Go to Appearance > Customize and update:
   - Homepage Hero
   - Contact Information
   - Final CTA Section
   - Footer Settings
   - Site Identity or logo
9. Go to Products and review the seeded default products.
10. Replace placeholder images with real product images.

## Local development instructions

Recommended with LocalWP:

1. Install LocalWP.
2. Create a new WordPress site.
3. Open the site folder.
4. Copy the `elyns-hoki` folder into `wp-content/themes/`.
5. Log in to WordPress Admin.
6. Activate the Elyns Hoki theme.
7. Go to Settings > Permalinks and click Save Changes.

Alternative with existing local WordPress:

1. Put the `elyns-hoki` folder inside `wp-content/themes/`.
2. Activate it from Appearance > Themes.
3. Run a PHP syntax check before deployment if possible.

## Deployment instructions

### Option A: Deploy through WordPress Admin

1. Prepare hosting and install WordPress.
2. Point the domain to the hosting account.
3. Enable SSL or HTTPS.
4. Upload the theme zip from Appearance > Themes > Add New > Upload Theme.
5. Activate the theme.
6. Go to Settings > Permalinks and save.
7. Update content in Products, Pages, Media Library, and Customize.
8. Install recommended plugins only if needed.
9. Test desktop and mobile pages before launch.

### Option B: Deploy through cPanel File Manager

1. Open cPanel > File Manager.
2. Go to `public_html/wp-content/themes/`.
3. Upload `elyns-hoki-complete.zip`.
4. Extract it so the final path is `wp-content/themes/elyns-hoki/`.
5. Go to WordPress Admin > Appearance > Themes.
6. Activate the Elyns Hoki theme.
7. Save permalinks.

### Option C: Deploy through SFTP

1. Connect to hosting through SFTP.
2. Upload the `elyns-hoki` folder to `wp-content/themes/`.
3. Activate it from WordPress Admin.
4. Save permalinks.

## Required plugins

The theme is designed to work with no required plugins.

Recommended optional plugins:

- Rank Math or Yoast SEO for SEO title and meta description management
- WP Mail SMTP if contact form email delivery fails
- LiteSpeed Cache if the host uses LiteSpeed server
- UpdraftPlus for backups

## Owner admin guide

### Edit homepage hero

Go to Appearance > Customize > Homepage Hero. Edit the headline, supporting text, CTA text, CTA links, and hero image.

### Add a new product

1. Go to Products > Add New Product.
2. Add the product name as the title.
3. Add the main body content if needed.
4. Fill Product Details fields.
5. Add Product Image as the featured image.
6. Add gallery images from Product Gallery Images.
7. Set Display Order.
8. Publish.

### Edit an existing product

Go to Products > All Products, open the product, edit fields, then click Update.

### Replace product photos

Open the product, replace the Featured Image, then manage Product Gallery Images.

### Update gallery images

1. Go to Pages > Gallery.
2. Use the Page Gallery Images box.
3. Add or remove images through the Media Library picker.
4. Use image captions to control filter labels.

### Update WhatsApp, email, address, and map

Go to Appearance > Customize > Contact Information.

### Edit menu items

Go to Appearance > Menus. Assign the menu to Primary Navigation.

### Update SEO title and meta description

Install Rank Math or Yoast SEO, then edit each page or product and fill the SEO title and meta description fields.

### Publish changes safely

Use Preview before publishing when possible. For major edits, update during low-traffic hours and keep a backup.

## Placeholders that still need company confirmation

- Real product photos
- Real gallery photos
- Exact Google Maps embed URL
- Logo file
- Exact product specifications, grades, packaging, shelf life, HS codes, or delivery timelines
- Confirmed export countries
- Confirmed operational claims such as years of experience, shipped orders, customer counts, organic certification, or 24-hour support

## Notes

Default products are created as editable WordPress Product posts during theme activation. Product cards and product pages pull content from the Products admin, not hardcoded template arrays.
