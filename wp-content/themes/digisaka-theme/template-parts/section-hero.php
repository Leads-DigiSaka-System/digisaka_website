<?php
$section   = $args['section'] ?? array();
$actions   = $args['actions'] ?? array();
$media_key = $args['media'] ?? 'hero';
$media     = digisaka_theme_media( $media_key, 'wide' );
$label     = $section['label'] ?? ( $section['eyebrow'] ?? __( 'DigiSaka', 'digisaka-theme' ) );
$style     = '--inner-hero-bg: url(' . esc_url( $media['url'] ) . ');';
?>
<section class="inner-hero inner-hero--digisaka inner-hero--<?php echo esc_attr( sanitize_html_class( $media_key ) ); ?>" style="<?php echo esc_attr( $style ); ?>">
	<div class="container inner-hero__grid">
		<div class="inner-hero__copy reveal">
			<p class="eyebrow"><?php echo esc_html( $section['eyebrow'] ?? '' ); ?></p>
			<h1><?php echo esc_html( $section['title'] ?? '' ); ?></h1>
			<p><?php echo esc_html( $section['description'] ?? '' ); ?></p>
			<?php if ( ! empty( $actions ) ) : ?>
				<div class="hero__actions inner-hero__actions">
					<?php foreach ( $actions as $action ) : ?>
						<a class="<?php echo esc_attr( $action['class'] ?? 'ds-button ds-button--green' ); ?>" href="<?php echo esc_url( $action['url'] ?? '#' ); ?>" <?php echo ! empty( $action['external'] ) ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>>
							<?php echo esc_html( $action['label'] ?? '' ); ?>
							<span aria-hidden="true">&#8594;</span>
						</a>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="inner-hero__visual inner-hero__visual--image reveal reveal--delay" aria-hidden="true">
			<figure class="inner-hero__image-card">
				<img src="<?php echo esc_url( $media['url'] ); ?>" alt="<?php echo esc_attr( $media['alt'] ); ?>">
				<figcaption><span><?php echo esc_html( $label ); ?></span><strong><?php esc_html_e( 'Digital agriculture in motion', 'digisaka-theme' ); ?></strong></figcaption>
			</figure>
			<div class="inner-float-card inner-float-card--top"><strong><?php esc_html_e( 'Field Intelligence', 'digisaka-theme' ); ?></strong><span><?php esc_html_e( 'GIS, satellite, and AI signals', 'digisaka-theme' ); ?></span></div>
			<div class="inner-float-card inner-float-card--bottom"><strong><?php esc_html_e( 'Action Ready', 'digisaka-theme' ); ?></strong><span><?php esc_html_e( 'Insights for farmers and teams', 'digisaka-theme' ); ?></span></div>
			<div class="inner-signal-card"><span></span><span></span><span></span><span></span></div>
		</div>
	</div>
</section>