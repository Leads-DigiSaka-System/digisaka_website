<?php
$content          = digisaka_theme_site_content();
$key              = $args['key'] ?? 'about';
$section          = $content[ $key ] ?? $content['about'];
$google_play      = 'https://play.google.com/store/apps/details?id=com.leadsagri.digisaka';
$generated_assets = get_template_directory_uri() . '/assets/images/generated';
$asset_version    = defined( 'DIGISAKA_THEME_VERSION' ) ? DIGISAKA_THEME_VERSION : '1.0.0';

$actions = array(
	array( 'label' => __( 'Explore Platform', 'digisaka-theme' ), 'url' => home_url( '/platform/' ), 'class' => 'ds-button ds-button--green' ),
	array( 'label' => __( 'Partner With Us', 'digisaka-theme' ), 'url' => home_url( '/partner/' ), 'class' => 'ds-button ds-button--outline' ),
);

if ( 'webgis' === $key ) {
	$actions[0] = array( 'label' => __( 'Explore WebGIS', 'digisaka-theme' ), 'url' => home_url( '/webgis/' ), 'class' => 'ds-button ds-button--green' );
}

if ( 'mobile' === $key ) {
	$actions[0] = array( 'label' => __( 'Download App', 'digisaka-theme' ), 'url' => $google_play, 'class' => 'ds-button ds-button--green', 'external' => true );
}

if ( 'contact' === $key ) {
	$actions = array(
		array( 'label' => __( 'Start a Partnership', 'digisaka-theme' ), 'url' => home_url( '/partner/' ), 'class' => 'ds-button ds-button--green' ),
		array( 'label' => __( 'Back to Home', 'digisaka-theme' ), 'url' => home_url( '/' ), 'class' => 'ds-button ds-button--outline' ),
	);
}

$about_goal_cards = array(
	array(
		'title' => __( 'Our Mission', 'digisaka-theme' ),
		'text'  => __( 'Empower Filipino farmers with technology and data for better decisions and stronger outcomes.', 'digisaka-theme' ),
		'icon'  => $generated_assets . '/about-goal-mission.png?v=' . $asset_version,
		'alt'   => __( 'Mission icon showing technology and rice growth', 'digisaka-theme' ),
	),
	array(
		'title' => __( 'Our Vision', 'digisaka-theme' ),
		'text'  => __( 'A future where every farm thrives through innovation, resilience, and strong partnerships.', 'digisaka-theme' ),
		'icon'  => $generated_assets . '/about-goal-vision.png?v=' . $asset_version,
		'alt'   => __( 'Vision icon showing thriving farms and a growth path', 'digisaka-theme' ),
	),
	array(
		'title' => __( 'Our Commitment', 'digisaka-theme' ),
		'text'  => __( 'Build practical digital tools that promote productivity, sustainability, and inclusive growth.', 'digisaka-theme' ),
		'icon'  => $generated_assets . '/about-goal-commitment.png?v=' . $asset_version,
		'alt'   => __( 'Commitment icon showing sustainable agriculture and verified progress', 'digisaka-theme' ),
	),
);

get_template_part( 'template-parts/section', 'hero', array(
	'section' => $section,
	'media'   => $key,
	'actions' => $actions,
) );

get_template_part( 'template-parts/section', 'intro', array(
	'section' => $section,
	'media'   => 'about' === $key ? '' : $key,
	'cards'   => 'about' === $key ? $about_goal_cards : array(),
) );

$highlights = digisaka_theme_page_highlights( $key );
if ( ! empty( $highlights ) && 'contact' !== $key ) {
	get_template_part( 'template-parts/section', 'card-grid', array(
		'eyebrow' => __( 'Page Highlights', 'digisaka-theme' ),
		'title'   => digisaka_theme_page_highlight_title( $key ),
		'text'    => __( 'Each capability is designed around real farm operations, field teams, and sustainable agriculture programs.', 'digisaka-theme' ),
		'cards'   => $highlights,
		'variant' => $key,
		'media'   => $key,
	) );
}

if ( 'webgis' === $key ) {
	get_template_part( 'template-parts/section', 'list', array( 'section' => $section, 'items' => digisaka_theme_webgis_features(), 'media' => 'webgis' ) );
}

if ( 'mobile' === $key ) {
	get_template_part( 'template-parts/section', 'list', array( 'section' => $section, 'items' => digisaka_theme_mobile_features(), 'media' => 'mobile' ) );
}

if ( 'sustainability' === $key ) {
	get_template_part( 'template-parts/section', 'list', array( 'section' => $section, 'items' => digisaka_theme_sustainability_features(), 'media' => 'sustainability' ) );
}

if ( 'contact' === $key ) {
	get_template_part( 'template-parts/section', 'contact' );
}