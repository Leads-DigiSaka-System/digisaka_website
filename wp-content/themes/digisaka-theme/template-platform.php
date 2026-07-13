<?php
/**
 * Template Name: Digisaka Platform
 *
 * @package DigisakaTheme
 */

$content     = digisaka_theme_site_content();
$section     = $content['platform'];
$asset_uri   = get_template_directory_uri() . '/assets/images';
$generated   = $asset_uri . '/generated';
$asset_ver   = DIGISAKA_THEME_VERSION;
$google_play = 'https://play.google.com/store/apps/details?id=com.leadsagri.digisaka';

$platform_cards = array(
	array(
		'title' => __( 'Smart Farm Monitoring', 'digisaka-theme' ),
		'text'  => __( 'Track crop condition, farm boundaries, and field activity through satellite-backed geospatial monitoring.', 'digisaka-theme' ),
		'image' => $generated . '/platform-card-smart-monitoring.png?v=' . $asset_ver,
		'alt'   => __( 'Aerial rice fields with digital farm monitoring overlays', 'digisaka-theme' ),
		'tag'   => __( 'WebGIS Layer', 'digisaka-theme' ),
		'meta'  => __( 'Live field visibility', 'digisaka-theme' ),
	),
	array(
		'title' => __( 'Precision Agriculture', 'digisaka-theme' ),
		'text'  => __( 'Use drone, vegetation, and crop analytics to guide better recommendations and smarter interventions.', 'digisaka-theme' ),
		'image' => $generated . '/platform-card-precision-agriculture.png?v=' . $asset_ver,
		'alt'   => __( 'Drone scanning a rice field with precision agriculture overlays', 'digisaka-theme' ),
		'tag'   => __( 'NDVI + Drone', 'digisaka-theme' ),
		'meta'  => __( 'Crop analytics', 'digisaka-theme' ),
	),
	array(
		'title' => __( 'AI Crop Diagnostics', 'digisaka-theme' ),
		'text'  => __( 'Support field teams with AI-assisted crop image analysis for pest, disease, and plant-health signals.', 'digisaka-theme' ),
		'image' => $generated . '/platform-card-ai-diagnostics.png?v=' . $asset_ver,
		'alt'   => __( 'Mobile phone scanning a rice leaf for AI plant diagnosis', 'digisaka-theme' ),
		'tag'   => __( 'AI Assistant', 'digisaka-theme' ),
		'meta'  => __( 'Faster diagnosis', 'digisaka-theme' ),
	),
	array(
		'title' => __( 'Climate-Smart Farming', 'digisaka-theme' ),
		'text'  => __( 'Enable AWD, low-carbon rice programs, sustainability monitoring, and MRV-ready reporting workflows.', 'digisaka-theme' ),
		'image' => $generated . '/platform-card-climate-smart.png?v=' . $asset_ver,
		'alt'   => __( 'Climate-smart rice field irrigation with sustainability monitoring overlays', 'digisaka-theme' ),
		'tag'   => __( 'MRV Ready', 'digisaka-theme' ),
		'meta'  => __( 'Low-carbon programs', 'digisaka-theme' ),
	),
	array(
		'title' => __( 'WebGIS Analytics', 'digisaka-theme' ),
		'text'  => __( 'Centralize interactive maps, saved fields, field layers, and analytics in a command center for agriculture teams.', 'digisaka-theme' ),
		'image' => $asset_uri . '/webgis.png?v=' . $asset_ver,
		'alt'   => __( 'DigiSaka WebGIS interface with farm boundary layers', 'digisaka-theme' ),
		'tag'   => __( 'Command Center', 'digisaka-theme' ),
		'meta'  => __( 'Map-based decisions', 'digisaka-theme' ),
	),
	array(
		'title' => __( 'Pandoy AI Assistant', 'digisaka-theme' ),
		'text'  => __( 'Give farmers and technicians a friendly AI support layer for smarter field decisions and practical next steps.', 'digisaka-theme' ),
		'image' => $generated . '/platform-pandoy-ai-assistant-tablet.png?v=' . $asset_ver,
		'alt'   => __( 'Pandoy AI Assistant holding a tablet', 'digisaka-theme' ),
		'tag'   => __( 'AI Buddy', 'digisaka-theme' ),
		'meta'  => __( 'Guided support', 'digisaka-theme' ),
	),
);

$workflow_steps = array(
	array(
		'title' => __( 'Map', 'digisaka-theme' ),
		'text'  => __( 'Digitize farms, field boundaries, and geotagged records.', 'digisaka-theme' ),
		'icon'  => $generated . '/platform-workflow-map.png?v=' . $asset_ver,
		'alt'   => __( 'Map icon showing digitized rice farm boundaries and location pin', 'digisaka-theme' ),
	),
	array(
		'title' => __( 'Monitor', 'digisaka-theme' ),
		'text'  => __( 'Read crop health, weather, and satellite signals over time.', 'digisaka-theme' ),
		'icon'  => $generated . '/platform-workflow-monitor.png?v=' . $asset_ver,
		'alt'   => __( 'Monitor icon showing crop health, weather, and satellite signals', 'digisaka-theme' ),
	),
	array(
		'title' => __( 'Diagnose', 'digisaka-theme' ),
		'text'  => __( 'Use AI and field evidence to spot pest, disease, and climate risk.', 'digisaka-theme' ),
		'icon'  => $generated . '/platform-workflow-diagnose.png?v=' . $asset_ver,
		'alt'   => __( 'Diagnose icon showing AI crop diagnosis and pest detection', 'digisaka-theme' ),
	),
	array(
		'title' => __( 'Act', 'digisaka-theme' ),
		'text'  => __( 'Send recommendations, alerts, and program-ready reports faster.', 'digisaka-theme' ),
		'icon'  => $generated . '/platform-workflow-act.png?v=' . $asset_ver,
		'alt'   => __( 'Act icon showing farm report alerts and recommendations being sent', 'digisaka-theme' ),
	),
);
get_header();
?>
<div class="platform-page">
	<section class="platform-hero">
		<div class="container platform-hero__grid">
			<div class="platform-hero__copy reveal">
				<p class="eyebrow"><?php echo esc_html( $section['eyebrow'] ); ?></p>
				<h1><?php echo esc_html( $section['title'] ); ?></h1>
				<p><?php echo esc_html( $section['description'] ); ?></p>
				<div class="platform-hero__actions">
					<a class="ds-button ds-button--green" href="<?php echo esc_url( home_url( '/webgis/' ) ); ?>"><?php esc_html_e( 'Explore WebGIS', 'digisaka-theme' ); ?></a>
					<a class="ds-button ds-button--outline" href="<?php echo esc_url( $google_play ); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Download App', 'digisaka-theme' ); ?></a>
				</div>
				<div class="platform-hero__stats" aria-label="<?php esc_attr_e( 'Platform highlights', 'digisaka-theme' ); ?>">
					<span><strong><?php esc_html_e( 'GIS', 'digisaka-theme' ); ?></strong><?php esc_html_e( 'Farm mapping', 'digisaka-theme' ); ?></span>
					<span><strong><?php esc_html_e( 'AI', 'digisaka-theme' ); ?></strong><?php esc_html_e( 'Crop support', 'digisaka-theme' ); ?></span>
					<span><strong><?php esc_html_e( 'MRV', 'digisaka-theme' ); ?></strong><?php esc_html_e( 'Sustainability workflows', 'digisaka-theme' ); ?></span>
				</div>
			</div>
			<div class="platform-hero__visual reveal reveal--delay" aria-hidden="true">
				<img src="<?php echo esc_url( $generated . '/platform-card-smart-monitoring.png?v=' . $asset_ver ); ?>" alt="">
				<div class="platform-orbit platform-orbit--one"></div>
				<div class="platform-orbit platform-orbit--two"></div>
				<div class="platform-glass-card platform-glass-card--top"><strong><?php esc_html_e( 'Crop Health', 'digisaka-theme' ); ?></strong><span><?php esc_html_e( 'Good', 'digisaka-theme' ); ?></span></div>
				<div class="platform-glass-card platform-glass-card--bottom"><strong><?php esc_html_e( 'Risk Alerts', 'digisaka-theme' ); ?></strong><span><?php esc_html_e( 'Field-ready', 'digisaka-theme' ); ?></span></div>
			</div>
		</div>
	</section>

	<section class="platform-overview">
		<div class="container platform-overview__grid">
			<div class="platform-overview__copy reveal">
				<p class="ds-kicker"><?php esc_html_e( 'Connected Platform', 'digisaka-theme' ); ?></p>
				<h2><?php esc_html_e( 'One ecosystem for field intelligence, farmer support, and climate-smart programs.', 'digisaka-theme' ); ?></h2>
				<p><?php echo esc_html( $section['body'] ); ?></p>
			</div>
			<div class="platform-overview__panel reveal reveal--delay">
				<?php foreach ( $workflow_steps as $index => $step ) : ?>
					<article class="platform-workflow-card">
						<div class="platform-workflow-card__top">
							<figure class="platform-workflow-card__icon">
								<img src="<?php echo esc_url( $step['icon'] ); ?>" alt="<?php echo esc_attr( $step['alt'] ); ?>" loading="lazy">
							</figure>
							<span class="platform-workflow-card__number"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
						</div>
						<h3><?php echo esc_html( $step['title'] ); ?></h3>
						<p><?php echo esc_html( $step['text'] ); ?></p>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="platform-feature-showcase">
		<div class="container platform-section-heading reveal">
			<p class="ds-kicker"><?php esc_html_e( 'Platform Capabilities', 'digisaka-theme' ); ?></p>
			<h2><?php esc_html_e( 'Awesome tools, built for real agricultural work.', 'digisaka-theme' ); ?></h2>
			<p><?php esc_html_e( 'Each capability connects field teams, farm records, satellite data, and decision support into a practical workflow.', 'digisaka-theme' ); ?></p>
		</div>
		<div class="container platform-card-grid">
			<?php foreach ( $platform_cards as $index => $card ) : ?>
				<article class="platform-feature-card reveal <?php echo 0 === $index ? 'platform-feature-card--large' : ''; ?>">
					<a href="<?php echo esc_url( home_url( '/platform/' ) ); ?>" aria-label="<?php echo esc_attr( $card['title'] ); ?>">
						<div class="platform-feature-card__media">
							<img src="<?php echo esc_url( $card['image'] ); ?>" alt="<?php echo esc_attr( $card['alt'] ); ?>" loading="lazy">
							<span><?php echo esc_html( $card['tag'] ); ?></span>
						</div>
						<div class="platform-feature-card__body">
							<small><?php echo esc_html( $card['meta'] ); ?></small>
							<h3><?php echo esc_html( $card['title'] ); ?></h3>
							<p><?php echo esc_html( $card['text'] ); ?></p>
						</div>
					</a>
				</article>
			<?php endforeach; ?>
		</div>
	</section>

	<section class="platform-cta-band">
		<div class="container platform-cta-band__inner reveal">
			<div>
				<p class="ds-kicker ds-kicker--light"><?php esc_html_e( 'Ready for smarter agriculture?', 'digisaka-theme' ); ?></p>
				<h2><?php esc_html_e( 'Bring DigiSaka to your farms, field teams, and programs.', 'digisaka-theme' ); ?></h2>
			</div>
			<a class="ds-button ds-button--orange" href="<?php echo esc_url( home_url( '/partner/' ) ); ?>"><?php esc_html_e( 'Partner With DigiSaka', 'digisaka-theme' ); ?></a>
		</div>
	</section>
</div>
<?php
get_footer();