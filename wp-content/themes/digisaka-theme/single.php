<?php
/**
 * Single post template.
 *
 * @package DigisakaTheme
 */

get_header();
?>
<?php
while ( have_posts() ) :
	the_post();
	$reading_minutes = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 220 ) );
	$categories      = get_the_category();
	$primary_cat     = ! empty( $categories ) ? $categories[0]->name : __( 'Digisaka Story', 'digisaka-theme' );
	$fallback_media  = digisaka_theme_media( 'hero', 'wide' );
	$hero_image      = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_ID(), 'large' ) : $fallback_media['url'];
	$style           = '--inner-hero-bg: url(' . esc_url( $hero_image ) . ');';
	?>
	<article <?php post_class( 'single-post single-post--refined' ); ?>>
		<section class="inner-hero inner-hero--single" style="<?php echo esc_attr( $style ); ?>">
			<div class="container inner-hero__grid">
				<div class="inner-hero__copy reveal">
					<p class="eyebrow"><?php echo esc_html( $primary_cat ); ?></p>
					<h1><?php the_title(); ?></h1>
					<div class="inner-hero__meta" aria-label="<?php esc_attr_e( 'Post details', 'digisaka-theme' ); ?>">
						<span><?php echo esc_html( get_the_date() ); ?></span>
						<span><?php the_author(); ?></span>
						<span><?php echo esc_html( sprintf( _n( '%d min read', '%d min read', $reading_minutes, 'digisaka-theme' ), $reading_minutes ) ); ?></span>
					</div>
				</div>
				<div class="inner-hero__visual inner-hero__visual--image reveal reveal--delay" aria-hidden="true">
					<figure class="inner-hero__image-card">
						<img src="<?php echo esc_url( $hero_image ); ?>" alt="">
						<figcaption><span><?php echo esc_html( $primary_cat ); ?></span><strong><?php esc_html_e( 'Digisaka field note', 'digisaka-theme' ); ?></strong></figcaption>
					</figure>
					<div class="inner-float-card inner-float-card--top"><strong><?php esc_html_e( 'Farm Data', 'digisaka-theme' ); ?></strong><span><?php esc_html_e( 'Insights for action', 'digisaka-theme' ); ?></span></div>
					<div class="inner-float-card inner-float-card--bottom"><strong><?php esc_html_e( 'Read Time', 'digisaka-theme' ); ?></strong><span><?php echo esc_html( sprintf( _n( '%d minute', '%d minutes', $reading_minutes, 'digisaka-theme' ), $reading_minutes ) ); ?></span></div>
				</div>
			</div>
		</section>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="container single-post__media single-post__media--refined reveal"><?php the_post_thumbnail( 'large' ); ?></div>
		<?php endif; ?>

		<section class="inner-section inner-section--single">
			<div class="container inner-content-layout inner-content-layout--single">
				<div class="content-wrap inner-content-card reveal">
					<?php the_content(); wp_link_pages(); ?>
				</div>
				<aside class="inner-side-card inner-side-card--single reveal reveal--delay">
					<p class="ds-kicker"><?php esc_html_e( 'Article Details', 'digisaka-theme' ); ?></p>
					<h2><?php esc_html_e( 'Digisaka field note', 'digisaka-theme' ); ?></h2>
					<ul>
						<li><span><?php esc_html_e( 'Published', 'digisaka-theme' ); ?></span><strong><?php echo esc_html( get_the_date() ); ?></strong></li>
						<li><span><?php esc_html_e( 'Author', 'digisaka-theme' ); ?></span><strong><?php the_author(); ?></strong></li>
						<li><span><?php esc_html_e( 'Reading Time', 'digisaka-theme' ); ?></span><strong><?php echo esc_html( sprintf( _n( '%d minute', '%d minutes', $reading_minutes, 'digisaka-theme' ), $reading_minutes ) ); ?></strong></li>
					</ul>
					<a class="inner-side-card__cta" href="<?php echo esc_url( home_url( '/news/' ) ); ?>"><?php esc_html_e( 'Back to News', 'digisaka-theme' ); ?></a>
				</aside>
			</div>
			<div class="container inner-post-nav reveal">
				<?php
				the_post_navigation( array(
					'prev_text' => '<span>' . esc_html__( 'Previous', 'digisaka-theme' ) . '</span><strong>%title</strong>',
					'next_text' => '<span>' . esc_html__( 'Next', 'digisaka-theme' ) . '</span><strong>%title</strong>',
				) );
				?>
			</div>
		</section>
	</article>
<?php endwhile; ?>
<?php
get_footer();