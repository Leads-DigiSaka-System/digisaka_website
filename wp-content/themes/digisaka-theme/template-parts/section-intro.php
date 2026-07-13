<?php
$section   = $args['section'] ?? array();
$cards     = $args['cards'] ?? array();
$media     = ! empty( $args['media'] ) ? digisaka_theme_media( $args['media'], 'wide' ) : null;
$has_cards = ! $media && ! empty( $cards );
?>
<section class="inner-showcase <?php echo $has_cards ? 'inner-showcase--cards' : ''; ?>">
	<div class="container inner-showcase__grid">
		<div class="inner-showcase__copy reveal">
			<p class="ds-kicker"><?php echo esc_html( $section['label'] ?? '' ); ?></p>
			<h2><?php echo esc_html( $section['title'] ?? '' ); ?></h2>
			<p><?php echo esc_html( $section['description'] ?? '' ); ?></p>
			<?php if ( ! empty( $section['body'] ) ) : ?><p><?php echo esc_html( $section['body'] ); ?></p><?php endif; ?>
		</div>
		<?php if ( $media ) : ?>
			<figure class="inner-showcase__media reveal reveal--delay">
				<img src="<?php echo esc_url( $media['url'] ); ?>" alt="<?php echo esc_attr( $media['alt'] ); ?>">
				<figcaption><span><?php esc_html_e( 'Digisaka Workflow', 'digisaka-theme' ); ?></span><strong><?php esc_html_e( 'Connected field intelligence', 'digisaka-theme' ); ?></strong></figcaption>
			</figure>
		<?php elseif ( ! empty( $cards ) ) : ?>
			<div class="inner-mini-grid reveal reveal--delay">
				<?php foreach ( $cards as $index => $card ) : ?>
					<?php
					$card_title = $card['title'] ?? ( $card[0] ?? '' );
					$card_text  = $card['text'] ?? ( $card[1] ?? '' );
					$card_icon  = $card['icon'] ?? ( $card[2] ?? '' );
					$card_alt   = $card['alt'] ?? $card_title;
					?>
					<article class="inner-mini-card <?php echo $card_icon ? 'inner-mini-card--with-icon' : ''; ?>">
						<?php if ( $card_icon ) : ?>
							<figure class="inner-mini-card__media">
								<img src="<?php echo esc_url( $card_icon ); ?>" alt="<?php echo esc_attr( $card_alt ); ?>" loading="lazy">
							</figure>
						<?php endif; ?>
						<div class="inner-mini-card__body">
							<span class="inner-mini-card__number"><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
							<h3><?php echo esc_html( $card_title ); ?></h3>
							<p><?php echo esc_html( $card_text ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>