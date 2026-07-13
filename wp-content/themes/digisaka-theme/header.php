<?php
/**
 * Header template.
 *
 * @package DigisakaTheme
 */

$asset_uri     = get_template_directory_uri() . '/assets/images';
$brand_logo    = $asset_uri . '/logo_name.png';
$nav_items     = array(
	array( 'Home', home_url( '/' ) ),
	array( 'About Us', home_url( '/about-us/' ) ),
	array( 'Farm Journey', home_url( '/farm-journey/' ) ),
	array( 'Platform', home_url( '/platform/' ) ),
	array( 'WebGIS', home_url( '/webgis/' ) ),
	array( 'Mobile App', home_url( '/mobile-app/' ) ),
	array( 'Sustainability', home_url( '/sustainability/' ) ),
	array( 'Partners', home_url( '/partner/' ) ),
	array( 'News', home_url( '/news/' ) ),
	array( 'Contact', home_url( '/contact/' ) ),
);
$is_front       = is_front_page();
$google_play_url = 'https://play.google.com/store/apps/details?id=com.leadsagri.digisaka';
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="ds-main-nav<?php echo $is_front ? ' ds-main-nav--home' : ' ds-main-nav--inner'; ?>" data-digisaka-header>
	<div class="container ds-main-nav__row">
		<a class="ds-main-nav__brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'DigiSaka home', 'digisaka-theme' ); ?>">
			<span class="ds-main-nav__brand-inner">
				<img src="<?php echo esc_url( $brand_logo ); ?>" alt="<?php esc_attr_e( 'DigiSaka', 'digisaka-theme' ); ?>">
			</span>
		</a>
		<nav id="mobile-menu" class="ds-main-nav__links" aria-label="<?php esc_attr_e( 'Primary navigation', 'digisaka-theme' ); ?>" data-primary-nav>
			<?php foreach ( $nav_items as $item ) : ?>
				<a href="<?php echo esc_url( $item[1] ); ?>"><?php echo esc_html( $item[0] ); ?></a>
			<?php endforeach; ?>
		</nav>
		<a class="ds-main-nav__app" href="<?php echo esc_url( $google_play_url ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Get the App', 'digisaka-theme' ); ?></a>

		<button class="ds-main-nav__toggle" type="button" aria-expanded="false" aria-controls="mobile-menu" data-nav-toggle>
			<span></span>
			<span></span>
			<span></span>
			<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'digisaka-theme' ); ?></span>
		</button>
	</div>
</header>

<main id="content" class="site-main">
