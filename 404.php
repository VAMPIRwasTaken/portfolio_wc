<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">

		<main id="main" class="site-main" role="main">

			<div class="error-404 not-found">

				<div class="page-content">

					<header class="page-header">
						<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'storefront' ); ?></h1>
					</header><!-- .page-header -->

					<p><?php esc_html_e( 'Nothing was found at this location. Try searching, or check out the links below.', 'storefront' ); ?></p>

					<?php
					if ( storefront_is_woocommerce_activated() ) {

						echo '<div class="fourohfour-columns-2">';

							echo '<section class="col-1" aria-label="' . esc_html__( 'Promoted Products', 'storefront' ) . '">';

								storefront_promoted_products();

							echo '</section>';

							echo '<section class="col-2" aria-label="' . esc_html__( 'Popular Products', 'storefront' ) . '">';

								echo '<h2>' . esc_html__( 'Popular Products', 'storefront' ) . '</h2>';

								$shortcode_content = storefront_do_shortcode(
									'best_selling_products',
									array(
										'per_page' => 2,
										'columns'  => 2,
									)
								);

								echo $shortcode_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

							echo '</section>';

						echo '</div>';
						}
					?>

				</div><!-- .page-content -->
			</div><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
