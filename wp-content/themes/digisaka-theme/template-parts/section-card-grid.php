<?php
$eyebrow = $args['eyebrow'] ?? '';
$title   = $args['title'] ?? '';
$text    = $args['text'] ?? '';
$cards   = $args['cards'] ?? array();
$variant = $args['variant'] ?? 'default';
$media   = ! empty( $args['media'] ) ? digisaka_theme_media( $args['media'], 'wide' ) : null;
$style   = $media ? '--inner-feature-bg: url(' . esc_url( $media['url'] ) . ');' : '';
?>
<section class="inner-feature-section inner-feature-section--<?php echo esc_attr( sanitize_html_class( $variant ) ); ?>" <?php echo $style ? 'style="' . esc_attr( $style ) . '"' : ''; ?>>
	<div class="container inner-section__heading reveal">
		<p class="ds-kicker"><?php echo esc_html( $eyebrow ); ?></p>
		<h2><?php echo esc_html( $title ); ?></h2>
		<?php if ( $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?>
	</div>
	<div class="container inner-feature-grid">
		<?php foreach ( $cards as $index => $card ) : ?>
			<article class="inner-feature-card reveal"><span class="inner-feature-card__number"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span><h3><?php echo esc_html( $card[0] ); ?></h3><p><?php echo esc_html( $card[1] ); ?></p></article>
		<?php endforeach; ?>
	</div>
</section>