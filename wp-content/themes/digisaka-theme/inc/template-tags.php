<?php
/**
 * Small template helpers.
 *
 * @package DigisakaTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function digisaka_theme_fallback_menu() {
	$items = array(
		'#features' => __( 'Features', 'digisaka-theme' ),
		'#insights' => __( 'Insights', 'digisaka-theme' ),
		'#traceability' => __( 'Traceability', 'digisaka-theme' ),
		'#contact' => __( 'Contact', 'digisaka-theme' ),
	);

	echo '<ul class="primary-nav__list">';
	foreach ( $items as $url => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}
