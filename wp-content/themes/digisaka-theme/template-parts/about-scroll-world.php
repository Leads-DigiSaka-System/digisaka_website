<?php
/**
 * Cinematic About page journey.
 *
 * @package DigisakaTheme
 */

$asset_uri     = get_template_directory_uri() . '/assets/images';
$generated_uri = $asset_uri . '/generated';
$version       = defined( 'DIGISAKA_THEME_VERSION' ) ? DIGISAKA_THEME_VERSION : '1.0.0';
$principles    = array(
	array(
		'icon'  => $generated_uri . '/about-goal-mission.png?v=' . $version,
		'label' => __( 'Our Mission', 'digisaka-theme' ),
		'title' => __( 'Make better farm decisions accessible.', 'digisaka-theme' ),
		'text'  => __( 'Empower Filipino farmers with practical technology, trustworthy data, and stronger links to the people and services that support each season.', 'digisaka-theme' ),
	),
	array(
		'icon'  => $generated_uri . '/about-goal-vision.png?v=' . $version,
		'label' => __( 'Our Vision', 'digisaka-theme' ),
		'title' => __( 'Help every farm thrive.', 'digisaka-theme' ),
		'text'  => __( 'Build a resilient agricultural future shaped by innovation, strong partnerships, and opportunities that reach rural communities.', 'digisaka-theme' ),
	),
	array(
		'icon'  => $generated_uri . '/about-goal-commitment.png?v=' . $version,
		'label' => __( 'Our Commitment', 'digisaka-theme' ),
		'title' => __( 'Keep innovation grounded in the field.', 'digisaka-theme' ),
		'text'  => __( 'Design connected tools and programs that improve productivity, promote sustainability, and respect how farmers actually work.', 'digisaka-theme' ),
	),
);
?>
<section class="about-world" aria-label="<?php esc_attr_e( 'The Digisaka journey from seed to sustainable growth', 'digisaka-theme' ); ?>">
	<div
		id="digisaka-about-world"
		data-digisaka-about-world
		data-assets="<?php echo esc_url( $generated_uri ); ?>"
		data-home-url="<?php echo esc_url( trailingslashit( home_url( '/' ) ) ); ?>"
	>
		<noscript>
			<div class="about-world__noscript container">
				<p class="ds-kicker"><?php esc_html_e( 'About Digisaka', 'digisaka-theme' ); ?></p>
				<h1><?php esc_html_e( 'From seed to a stronger harvest.', 'digisaka-theme' ); ?></h1>
				<p><?php esc_html_e( 'Digisaka connects farm records, satellite intelligence, agronomic guidance, shared services, and farmer communities throughout the rice-growing season.', 'digisaka-theme' ); ?></p>
			</div>
		</noscript>
	</div>
</section>

<section class="about-principles" aria-labelledby="about-principles-title">
	<div class="container about-principles__inner">
		<header class="about-principles__heading reveal">
			<p class="ds-kicker"><?php esc_html_e( 'What Guides Every Season', 'digisaka-theme' ); ?></p>
			<h2 id="about-principles-title"><?php esc_html_e( 'Technology is only useful when it creates progress people can feel.', 'digisaka-theme' ); ?></h2>
			<p><?php esc_html_e( 'These principles connect every Digisaka workflow, field activity, partnership, and long-term goal.', 'digisaka-theme' ); ?></p>
		</header>

		<div class="about-principles__grid">
			<?php foreach ( $principles as $index => $principle ) : ?>
				<article class="about-principle-card reveal<?php echo 0 < $index ? ' reveal--delay' : ''; ?>">
					<figure><img src="<?php echo esc_url( $principle['icon'] ); ?>" alt="" loading="lazy"></figure>
					<span><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?> / <?php echo esc_html( $principle['label'] ); ?></span>
					<h3><?php echo esc_html( $principle['title'] ); ?></h3>
					<p><?php echo esc_html( $principle['text'] ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>

		<div class="about-principles__cta reveal">
			<div>
				<span><?php esc_html_e( 'Built for Philippine Agriculture', 'digisaka-theme' ); ?></span>
				<h2><?php esc_html_e( 'One connected season. Better decisions at every stage.', 'digisaka-theme' ); ?></h2>
			</div>
			<a class="ds-button ds-button--green" href="<?php echo esc_url( home_url( '/platform/' ) ); ?>"><?php esc_html_e( 'Explore the Platform', 'digisaka-theme' ); ?><span aria-hidden="true">&#8594;</span></a>
		</div>
	</div>
</section>
