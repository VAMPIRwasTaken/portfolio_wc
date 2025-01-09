<?php

add_filter( 'auto_update_plugin', '__return_true' );

function remove_header_title() {
    remove_action( 'storefront_header', 'storefront_site_branding', 20 );
}
add_action( 'init', 'remove_header_title');  

function logo_header() {
    ?>
    <img class="logo_header" src="<?php echo home_url(); ?>/wp-content/themes/portfolio_wc/wc-template/choinka.png" alt="">
    <?
}
 add_action( 'storefront_header', 'logo_header',0);

function stare_menu() {
    remove_action( 'storefront_header', 'storefront_primary_navigation', 50);
}
add_action( 'storefront_header', 'stare_menu');

function remove_lupa() {
    remove_action( 'storefront_header', 'storefront_product_search', 40 );
}
add_action( 'init', 'remove_lupa');

function menu_sklepu() {
    wp_nav_menu( array('menu'=> 'menu', 'container'=> '', 'menu_class'=> '' ));
}
add_action( 'storefront_header', 'menu_sklepu', 50);

if ( ! function_exists( 'storefront_cart_link' ) ) {
	/**
	 * Cart Link
	 * Displayed a link to the cart including the number of items present and the cart total
	 *
	 * @return void
	 * @since  1.0.0
	 */
	function storefront_cart_link() {
		if ( ! storefront_woo_cart_available() ) {
			return;
		}
		?>
			<a class="cart_contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'storefront' ); ?>">
				<?php /* translators: %d: number of items in cart */ ?>
				<span class="count"><?php echo wp_kses_data( sprintf( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'storefront' ), WC()->cart->get_cart_contents_count() ) ); ?></span>
			</a>
		<?php
	}
}

add_action( 'wp', 'remove_strona_glowna' );
 
function remove_strona_glowna() {
   remove_action( 'storefront_homepage', 'storefront_homepage_header', 10 );
}

add_action( 'wp', 'remove_wg_kategori' );

function remove_wg_kategori() {
	remove_action( 'homepage', 'storefront_product_categories', 20 );
}

add_action( 'wp', 'remove_bestsellers_section' );

function remove_bestsellers_section() {
	remove_action( 'homepage', 'storefront_best_selling_products', 70 );
}
add_action( 'wp', 'reorder_homepage_sections' );

function reorder_homepage_sections() {
    // Usuń istniejące sekcje
    remove_action( 'homepage', 'storefront_popular_products', 50 );
    remove_action( 'homepage', 'storefront_on_sale_products', 60 );
    remove_action( 'homepage', 'storefront_recent_products', 30 );

    // Dodaj sekcje w nowej kolejności
    add_action( 'homepage', 'storefront_popular_products', 10 ); // Popularne
    add_action( 'homepage', 'storefront_on_sale_products', 20 ); // W promocji
    add_action( 'homepage', 'storefront_recent_products', 30 ); // Nowości
}
function add_custom_footer() {
	remove_action( 'storefront_footer', 'storefront_footer_widgets', 10);
	remove_action( 'storefront_footer', 'storefront_credit', 20);

	add_action( 'storefront_footer', 'custom_footer_widget', 10);
	add_action( 'storefront_footer', 'custom_credit', 20 );
}

function custom_footer_widget() {
	?>
		<p>Moj projekt sklepu.</p>
	<?php
}
function custom_credit() {
	if ( is_shop() || is_product() || is_product_category() || is_cart() || is_checkout() || is_account_page() || is_page(73)) {
		echo 'To jest strona sklepu.';
	} else {
		echo 'To jest inna strona.';
	}
}
add_action('init', 'add_custom_footer');

function reorder_product_section() {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 5 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 10 );
}
add_action( 'init', 'reorder_product_section' );

add_action( 'after_setup_theme', 'remove_woocommerce_zoom_support', 99 );

function remove_woocommerce_zoom_support() {
    // Wyłącz funkcję zoom
    remove_theme_support( 'wc-product-gallery-zoom' );
}