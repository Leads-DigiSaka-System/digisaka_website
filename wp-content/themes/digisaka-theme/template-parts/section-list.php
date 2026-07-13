<?php
$section = $args['section'] ?? array();
$items   = $args['items'] ?? array();
$media   = digisaka_theme_media( $args['media'] ?? 'webgis', 'wide' );
$style   = '--inner-list-bg: url(' . esc_url( $media['url'] ) . ');';
?>
<section class="inner-list-section" style="<?php echo esc_attr( $style ); ?>">
	<div class="container inner-list-grid">
		<div class="inner-list-copy reveal">
			<p class="ds-kicker ds-kicker--light"><?php echo esc_html( $section['eyebrow'] ?? '' ); ?></p>
			<h2><?php echo esc_html( $section['title'] ?? '' ); ?></h2>
			<p><?php echo esc_html( $section['description'] ?? '' ); ?></p>
			<?php if ( ! empty( $section['body'] ) ) : ?><p><?php echo esc_html( $section['body'] ); ?></p><?php endif; ?>
		</div>
		<div class="inner-list-panel reveal reveal--delay">
			<figure class="inner-list-visual"><img src="<?php echo esc_url( $media['url'] ); ?>" alt="<?php echo esc_attr( $media['alt'] ); ?>"></figure>
			<ul class="inner-list">
				<?php foreach ( $items as $item ) : ?><li><?php echo esc_html( $item ); ?></li><?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>