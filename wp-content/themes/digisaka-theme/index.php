<?php
/**
 * Main archive template.
 *
 * @package DigisakaTheme
 */

if ( is_home() && ! is_front_page() ) {
	$archive_title = get_the_title( (int) get_option( 'page_for_posts' ) );
} elseif ( is_archive() ) {
	$archive_title = get_the_archive_title();
} elseif ( is_search() ) {
	$archive_title = sprintf( __( 'Search results for %s', 'digisaka-theme' ), get_search_query() );
} else {
	$archive_title = get_bloginfo( 'name' );
}

$archive_description = is_archive() ? get_the_archive_description() : get_bloginfo( 'description' );
if ( ! $archive_description ) {
	$archive_description = __( 'Stories, product updates, and field notes from the DigiSaka digital agriculture ecosystem.', 'digisaka-theme' );
}

$hero_media = digisaka_theme_media( 'partner', 'wide' );
$style      = '--inner-hero-bg: url(' . esc_url( $hero_media['url'] ) . ');';

get_header();
?>
<section class="inner-hero inner-hero--archive" style="<?php echo esc_attr( $style ); ?>">
	<div class="container inner-hero__grid">
		<div class="inner-hero__copy reveal">
			<p class="eyebrow"><?php esc_html_e( 'DigiSaka Updates', 'digisaka-theme' ); ?></p>
			<h1><?php echo esc_html( $archive_title ); ?></h1>
			<p><?php echo esc_html( wp_strip_all_tags( $archive_description ) ); ?></p>
		</div>
		<div class="inner-hero__visual inner-hero__visual--image reveal reveal--delay" aria-hidden="true">
			<figure class="inner-hero__image-card">
				<img src="<?php echo esc_url( $hero_media['url'] ); ?>" alt="<?php echo esc_attr( $hero_media['alt'] ); ?>">
				<figcaption><span><?php esc_html_e( 'Latest Updates', 'digisaka-theme' ); ?></span><strong><?php esc_html_e( 'Field stories and platform news', 'digisaka-theme' ); ?></strong></figcaption>
			</figure>
			<div class="inner-float-card inner-float-card--top"><strong><?php esc_html_e( 'WebGIS', 'digisaka-theme' ); ?></strong><span><?php esc_html_e( 'Satellite insights', 'digisaka-theme' ); ?></span></div>
			<div class="inner-float-card inner-float-card--bottom"><strong><?php esc_html_e( 'Field Notes', 'digisaka-theme' ); ?></strong><span><?php esc_html_e( 'Stories from agriculture teams', 'digisaka-theme' ); ?></span></div>
		</div>
	</div>
</section>

<section class="inner-section inner-section--posts">
	<div class="container inner-section__heading reveal">
		<p class="ds-kicker"><?php esc_html_e( 'Latest Reads', 'digisaka-theme' ); ?></p>
		<h2><?php esc_html_e( 'Explore the newest agriculture updates', 'digisaka-theme' ); ?></h2>
		<p><?php esc_html_e( 'Browse insights on farm monitoring, digital tools, climate-smart agriculture, and DigiSaka platform progress.', 'digisaka-theme' ); ?></p>
	</div>
	<div class="container post-grid post-grid--inner">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'card' );
			endwhile;
		else :
			get_template_part( 'template-parts/content', 'none' );
		endif;
		?>
	</div>
	<div class="container pagination-wrap pagination-wrap--inner"><?php the_posts_pagination(); ?></div>
</section>
<?php
get_footer();