<?php
/**
 * Page template.
 *
 * @package DigisakaTheme
 */

get_header();
?>
<?php
while ( have_posts() ) :
	the_post();
	$page_intro = get_the_excerpt();
	if ( ! $page_intro ) {
		$page_intro = __( 'Explore DigiSaka programs, tools, and stories designed for smarter Philippine agriculture.', 'digisaka-theme' );
	}
	$hero_media = digisaka_theme_media( 'hero', 'wide' );
	$style      = '--inner-hero-bg: url(' . esc_url( $hero_media['url'] ) . ');';
	?>
	<section class="inner-hero inner-hero--page" style="<?php echo esc_attr( $style ); ?>">
		<div class="container inner-hero__grid">
			<div class="inner-hero__copy reveal">
				<p class="eyebrow"><?php esc_html_e( 'DigiSaka', 'digisaka-theme' ); ?></p>
				<h1><?php the_title(); ?></h1>
				<p><?php echo esc_html( wp_strip_all_tags( $page_intro ) ); ?></p>
			</div>
			<div class="inner-hero__visual inner-hero__visual--image reveal reveal--delay" aria-hidden="true">
				<figure class="inner-hero__image-card">
					<img src="<?php echo esc_url( $hero_media['url'] ); ?>" alt="<?php echo esc_attr( $hero_media['alt'] ); ?>">
					<figcaption><span><?php esc_html_e( 'DigiSaka Page', 'digisaka-theme' ); ?></span><strong><?php esc_html_e( 'Smarter agriculture content', 'digisaka-theme' ); ?></strong></figcaption>
				</figure>
				<div class="inner-float-card inner-float-card--top"><strong><?php esc_html_e( 'GIS + AI', 'digisaka-theme' ); ?></strong><span><?php esc_html_e( 'Connected tools', 'digisaka-theme' ); ?></span></div>
				<div class="inner-float-card inner-float-card--bottom"><strong><?php esc_html_e( 'Farm Data', 'digisaka-theme' ); ?></strong><span><?php esc_html_e( 'Ready for action', 'digisaka-theme' ); ?></span></div>
			</div>
		</div>
	</section>

	<section class="inner-section inner-section--content">
		<div class="container inner-content-layout">
			<article class="content-wrap inner-content-card reveal">
				<?php
				the_content();
				wp_link_pages();
				?>
			</article>
			<aside class="inner-side-card reveal reveal--delay" aria-label="<?php esc_attr_e( 'DigiSaka quick links', 'digisaka-theme' ); ?>">
				<p class="ds-kicker"><?php esc_html_e( 'Explore More', 'digisaka-theme' ); ?></p>
				<h2><?php esc_html_e( 'Move through the platform', 'digisaka-theme' ); ?></h2>
				<a href="<?php echo esc_url( home_url( '/platform/' ) ); ?>"><?php esc_html_e( 'Our Platform', 'digisaka-theme' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/webgis/' ) ); ?>"><?php esc_html_e( 'WebGIS', 'digisaka-theme' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/mobile-app/' ) ); ?>"><?php esc_html_e( 'Mobile App', 'digisaka-theme' ); ?></a>
				<a href="<?php echo esc_url( home_url( '/partner/' ) ); ?>"><?php esc_html_e( 'Partner With DigiSaka', 'digisaka-theme' ); ?></a>
			</aside>
		</div>
	</section>
<?php endwhile; ?>
<?php
get_footer();