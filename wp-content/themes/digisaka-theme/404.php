<?php
/**
 * 404 template.
 *
 * @package DigisakaTheme
 */

$hero_media = digisaka_theme_media( 'hero', 'wide' );
$style      = '--inner-hero-bg: url(' . esc_url( $hero_media['url'] ) . ');';

get_header();
?>
<section class="inner-hero inner-hero--error" style="<?php echo esc_attr( $style ); ?>">
	<div class="container inner-hero__grid">
		<div class="inner-hero__copy reveal">
			<p class="eyebrow"><?php esc_html_e( '404', 'digisaka-theme' ); ?></p>
			<h1><?php esc_html_e( 'This field is not mapped yet.', 'digisaka-theme' ); ?></h1>
			<p><?php esc_html_e( 'The page you are looking for is unavailable or has moved. Let us bring you back to the Digisaka map.', 'digisaka-theme' ); ?></p>
			<div class="hero__actions inner-hero__actions">
				<a class="ds-button ds-button--green" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Return Home', 'digisaka-theme' ); ?><span aria-hidden="true">&#8594;</span></a>
				<a class="ds-button ds-button--outline" href="<?php echo esc_url( home_url( '/platform/' ) ); ?>"><?php esc_html_e( 'Explore Platform', 'digisaka-theme' ); ?><span aria-hidden="true">&#8594;</span></a>
			</div>
		</div>
		<div class="inner-hero__visual inner-hero__visual--image reveal reveal--delay" aria-hidden="true">
			<figure class="inner-hero__image-card">
				<img src="<?php echo esc_url( $hero_media['url'] ); ?>" alt="<?php echo esc_attr( $hero_media['alt'] ); ?>">
				<figcaption><span><?php esc_html_e( 'Field Boundary', 'digisaka-theme' ); ?></span><strong><?php esc_html_e( 'Route not found', 'digisaka-theme' ); ?></strong></figcaption>
			</figure>
			<div class="inner-float-card inner-float-card--top"><strong><?php esc_html_e( 'Map Status', 'digisaka-theme' ); ?></strong><span><?php esc_html_e( 'Needs a new route', 'digisaka-theme' ); ?></span></div>
			<div class="inner-float-card inner-float-card--bottom"><strong><?php esc_html_e( 'Next Step', 'digisaka-theme' ); ?></strong><span><?php esc_html_e( 'Return to the platform', 'digisaka-theme' ); ?></span></div>
		</div>
	</div>
</section>
<?php
get_footer();