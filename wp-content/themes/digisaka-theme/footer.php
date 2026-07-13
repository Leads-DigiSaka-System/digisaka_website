<?php
/**
 * Footer template.
 *
 * @package DigisakaTheme
 */

$asset_uri       = get_template_directory_uri() . '/assets/images';
$google_play_url = 'https://play.google.com/store/apps/details?id=com.leadsagri.digisaka';
?>
</main>

<footer class="site-footer site-footer--digisaka">
	<div class="site-footer__inner">
		<div class="site-footer__brand">
			<a class="site-footer__logo-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'DigiSaka home', 'digisaka-theme' ); ?>">
				<img src="<?php echo esc_url( digisaka_theme_logo_url() ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" class="site-footer__logo">
				<span class="site-footer__wordmark"><?php esc_html_e( 'Digisaka', 'digisaka-theme' ); ?></span>
			</a>
			<p><?php esc_html_e( 'Digitizing Philippine agriculture with connected field data, WebGIS intelligence, mobile alerts, and farmer-first workflows.', 'digisaka-theme' ); ?></p>
			<div class="site-footer__actions">
				<a class="site-footer__store-btn" href="<?php echo esc_url( $google_play_url ); ?>" target="_blank" rel="noopener noreferrer">
					<img src="<?php echo esc_url( $asset_uri . '/google_play_store.png' ); ?>" alt="<?php esc_attr_e( 'Get it on Google Play', 'digisaka-theme' ); ?>">
				</a>
			</div>
		</div>

		<div class="site-footer__panel">
			<div class="site-footer__column">
				<h2><?php esc_html_e( 'Links', 'digisaka-theme' ); ?></h2>
				<nav aria-label="<?php esc_attr_e( 'Footer navigation', 'digisaka-theme' ); ?>">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer',
						'menu_class'     => 'footer-nav',
						'container'      => false,
						'fallback_cb'    => false,
					) );
					?>
				</nav>
			</div>

			<div class="site-footer__column site-footer__column--platform">
				<h2><?php esc_html_e( 'Platform', 'digisaka-theme' ); ?></h2>
				<a href="<?php echo esc_url( home_url( '/webgis/' ) ); ?>"><?php esc_html_e( 'WebGIS Mapping', 'digisaka-theme' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/mobile-app/' ) ); ?>"><?php esc_html_e( 'Mobile Farm Tools', 'digisaka-theme' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/sustainability/' ) ); ?>"><?php esc_html_e( 'Sustainability Programs', 'digisaka-theme' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/partner/' ) ); ?>"><?php esc_html_e( 'Partnerships', 'digisaka-theme' ); ?></a>
			</div>

			<div class="site-footer__column site-footer__column--cta">
				<span class="site-footer__cta-badge"><?php esc_html_e( 'Grow With DigiSaka', 'digisaka-theme' ); ?></span>
				<p><?php esc_html_e( 'Bring satellite insights, AI support, and field-ready agriculture tools into your next program.', 'digisaka-theme' ); ?></p>
				<a class="site-footer__cta" href="<?php echo esc_url( home_url( '/partner/' ) ); ?>">
					<?php esc_html_e( 'Partner With Us', 'digisaka-theme' ); ?>
					<span aria-hidden="true">→</span>
				</a>
			</div>
		</div>

		<div class="site-footer__meta">
			<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'digisaka-theme' ); ?></span>
			<span><?php esc_html_e( 'Built for smarter Philippine agriculture.', 'digisaka-theme' ); ?></span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>