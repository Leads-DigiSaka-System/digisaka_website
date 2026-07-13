<?php
/**
 * Digisaka Theme functions.
 *
 * @package DigisakaTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DIGISAKA_THEME_VERSION', '1.0.30' );

require_once get_template_directory() . '/inc/template-tags.php';
require_once get_template_directory() . '/inc/site-content.php';

function digisaka_theme_setup() {
	load_theme_textdomain( 'digisaka-theme', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-logo', array(
		'height'      => 96,
		'width'       => 280,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'digisaka-theme' ),
		'footer'  => __( 'Footer Menu', 'digisaka-theme' ),
	) );
}
add_action( 'after_setup_theme', 'digisaka_theme_setup' );

function digisaka_theme_assets() {
	wp_enqueue_style(
		'digisaka-theme-fonts',
		'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'digisaka-theme-style',
		get_template_directory_uri() . '/assets/css/theme.css',
		array( 'digisaka-theme-fonts' ),
		DIGISAKA_THEME_VERSION
	);

	wp_enqueue_script(
		'digisaka-theme-script',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		DIGISAKA_THEME_VERSION,
		true
	);

	if ( is_page_template( 'template-farm-journey.php' ) ) {
		wp_enqueue_script(
			'digisaka-scroll-world',
			get_template_directory_uri() . '/assets/js/scroll-world.js',
			array(),
			DIGISAKA_THEME_VERSION,
			true
		);

		wp_enqueue_script(
			'digisaka-about-world',
			get_template_directory_uri() . '/assets/js/about-world.js',
			array( 'digisaka-scroll-world' ),
			DIGISAKA_THEME_VERSION,
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'digisaka_theme_assets' );

function digisaka_theme_excerpt_length() {
	return 24;
}
add_filter( 'excerpt_length', 'digisaka_theme_excerpt_length' );

function digisaka_theme_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'digisaka_theme_excerpt_more' );

function digisaka_theme_customize_register( $wp_customize ) {
	$wp_customize->add_section( 'digisaka_home', array(
		'title'       => __( 'Digisaka Homepage', 'digisaka-theme' ),
		'description' => __( 'Starter content for the custom homepage. Replace this later with final copy.', 'digisaka-theme' ),
		'priority'    => 30,
	) );

	$fields = array(
		'hero_eyebrow'     => array( 'DigiSaka Platform', 'Hero eyebrow' ),
		'hero_title'       => array( 'Smart agriculture, connected from field to market.', 'Hero title' ),
		'hero_description' => array( 'A modern operating layer for farm data, market prices, buyback workflows, traceability, advisories, and field teams.', 'Hero description' ),
		'primary_cta'      => array( 'Explore the Platform', 'Primary CTA label' ),
		'primary_cta_url'  => array( '#features', 'Primary CTA URL' ),
		'secondary_cta'    => array( 'View Insights', 'Secondary CTA label' ),
		'secondary_cta_url'=> array( '#insights', 'Secondary CTA URL' ),
	);

	foreach ( $fields as $id => $data ) {
		$wp_customize->add_setting( "digisaka_{$id}", array(
			'default'           => $data[0],
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( "digisaka_{$id}", array(
			'label'   => $data[1],
			'section' => 'digisaka_home',
			'type'    => 'text',
		) );
	}
}
add_action( 'customize_register', 'digisaka_theme_customize_register' );

function digisaka_theme_option( $name, $fallback = '' ) {
	return get_theme_mod( "digisaka_{$name}", $fallback );
}

function digisaka_theme_logo_url() {
	$logo = get_theme_mod( 'custom_logo' );

	if ( $logo ) {
		return wp_get_attachment_image_url( $logo, 'full' );
	}

	return get_template_directory_uri() . '/assets/images/logo_name.png';
}
