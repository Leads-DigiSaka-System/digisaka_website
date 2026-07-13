<?php
/**
 * Front page template.
 *
 * @package DigisakaTheme
 */

$content         = digisaka_theme_site_content();
$hero_media      = digisaka_theme_media( 'hero', 'wide' );
$about_media     = digisaka_theme_media( 'about' );
$webgis_media    = digisaka_theme_media( 'webgis' );
$mobile_media    = digisaka_theme_media( 'mobile' );
$platform_media  = digisaka_theme_media( 'platform' );
$sustain_media   = digisaka_theme_media( 'sustainability' );
$google_play_url = 'https://play.google.com/store/apps/details?id=com.leadsagri.digisaka';
$asset_uri       = get_template_directory_uri() . '/assets/images';
$asset_version   = 'nb-20260711-001';
$webgis_screen   = $asset_uri . '/webgis.png';
$ai_scan_screen  = $asset_uri . '/ai_based_plant_analysis.jpg';
$ai_result_screen = $asset_uri . '/ai_based_plant_analysis_result.jpg';
$alerts_screen   = $asset_uri . '/farm_alerts.jpg';
$weather_screen  = $asset_uri . '/realtime_weather_updates.jpg';
// Nano Banana generated mobile mockups and What is Digisaka assets.
$generated_asset_uri = $asset_uri . '/generated';
$iphone17_alerts = $generated_asset_uri . '/mobile-iphone17-farm-alerts.jpg?v=' . $asset_version;
$iphone17_weather = $generated_asset_uri . '/mobile-iphone17-weather-updates.jpg?v=' . $asset_version;
$iphone17_ai_result = $generated_asset_uri . '/mobile-iphone17-ai-plant-analysis.jpg?v=' . $asset_version;
$what_phone = $generated_asset_uri . '/what-digisaka-phone.png?v=' . $asset_version;
$what_icon_mobile = $generated_asset_uri . '/what-icon-mobile-platform.png?v=' . $asset_version;
$what_icon_low_carbon = $generated_asset_uri . '/what-icon-low-carbon-rice.png?v=' . $asset_version;
$what_icon_satellite = $generated_asset_uri . '/what-icon-satellite-data.png?v=' . $asset_version;
$what_icon_gis = $generated_asset_uri . '/what-icon-gis.png?v=' . $asset_version;
$what_icon_awd = $generated_asset_uri . '/what-icon-awd.png?v=' . $asset_version;
// Nano Banana generated platform assets.
$platform_icon_smart = $generated_asset_uri . '/platform-icon-smart-farm-monitoring.png?v=' . $asset_version;
$platform_icon_precision = $generated_asset_uri . '/platform-icon-precision-agriculture.png?v=' . $asset_version;
$platform_icon_pest = $generated_asset_uri . '/platform-icon-pest-disease-monitoring.png?v=' . $asset_version;
$platform_icon_climate = $generated_asset_uri . '/platform-icon-climate-smart-farming.png?v=' . $asset_version;
$platform_pandoy = $generated_asset_uri . '/platform-pandoy-ai-assistant-tablet.png?v=' . $asset_version;
// Nano Banana generated audience assets.
$users_background = $generated_asset_uri . '/users-parallax-background.jpg?v=' . $asset_version;
$users_image_farmers = $generated_asset_uri . '/users-filipino-farmers.png?v=' . $asset_version;
$users_image_technicians = $generated_asset_uri . '/users-agricultural-technicians.png?v=' . $asset_version;
$users_image_government = $generated_asset_uri . '/users-government-agencies.png?v=' . $asset_version;
$users_image_researchers = $generated_asset_uri . '/users-researchers-partners.png?v=' . $asset_version;
$brand_logo      = $asset_uri . '/logo_name.png';
$pandoy_image    = $asset_uri . '/pandoy.png';
$leads_logo      = $asset_uri . '/leads.png';
$leads_agri_logo = $asset_uri . '/leads-agri-logo.png';
$generated_hero  = $asset_uri . '/generated-homepage-hero.png';
$generated_hero_reference = $asset_uri . '/generated-homepage-hero-reference.png?v=' . $asset_version;
$generated_about = $asset_uri . '/generated-homepage-about.png';
$generated_sustainability_field = $asset_uri . '/generated-homepage-sustainability-field.png';
$generated_sustainability_drone = $asset_uri . '/generated-homepage-sustainability-drone.png';
$generated_news_farmer = $asset_uri . '/generated-news-farmer-digital.png';
$generated_news_partnership = $asset_uri . '/generated-news-partnership.png';
$generated_news_resilience = $asset_uri . '/generated-news-resilience-drone.png';
$generated_news_webgis = $asset_uri . '/generated-news-webgis-features.png';
$news_cards      = array(
	array( $generated_news_farmer, 'Yenchaie: Philippine Agriculture Through DigiSaka', 'How Filipino growers are using digital tools for stronger farm decisions.', 'Field Story', 'May 20, 2024' ),
	array( $generated_news_partnership, 'Agri Partnership for Sustainable Future', 'Building climate-smart programs with communities and institutions.', 'Partnership', 'May 15, 2024' ),
	array( $generated_news_resilience, 'Towards a Resilient Agriculture', 'Satellite insights, GIS, and AI help field teams respond faster.', 'Innovation', 'May 10, 2024' ),
	array( $generated_news_webgis, 'New Features Now Available', 'Expanded WebGIS layers and mobile farm monitoring tools are rolling out.', 'Product Update', 'May 5, 2024' ),
);

get_header();
?>

<div class="ds-home">
	<section class="ds-hero ds-hero--reference">
		<img class="ds-hero__image" src="<?php echo esc_url( $generated_hero_reference ); ?>" alt="<?php esc_attr_e( 'Bright Philippine rice field and mountain landscape for digital agriculture', 'digisaka-theme' ); ?>">
		<div class="ds-hero__overlay"></div>
		<div class="container ds-hero__inner ds-hero-ref__inner">
			<div class="ds-hero-ref__copy reveal">
				<h1>
					<span><?php esc_html_e( 'Transforming', 'digisaka-theme' ); ?></span>
					<span class="ds-text-green"><?php esc_html_e( 'Philippine Agriculture', 'digisaka-theme' ); ?></span>
					<span><?php esc_html_e( 'Through', 'digisaka-theme' ); ?></span>
					<span class="ds-text-green"><?php esc_html_e( 'Digital Innovation', 'digisaka-theme' ); ?></span>
				</h1>
				<p><?php esc_html_e( 'Digisaka empowers farmers, organizations, and decision-makers with data, technology, and insights for a smarter, more sustainable agriculture.', 'digisaka-theme' ); ?></p>
				<a class="ds-button ds-hero-ref__cta" href="<?php echo esc_url( home_url( '/webgis/' ) ); ?>">
					<?php esc_html_e( 'Explore WebGIS', 'digisaka-theme' ); ?>
					<span aria-hidden="true">&#8594;</span>
				</a>
			</div>
			<div class="ds-hero-ref__visual reveal reveal--delay" aria-hidden="true">
				<img class="ds-hero-overlay ds-hero-overlay--satellite ds-hero-overlay--satellite-1" src="<?php echo esc_url( $asset_uri . '/hero-satellite-overlay.png?v=' . $asset_version ); ?>" alt="">
				<img class="ds-hero-overlay ds-hero-overlay--satellite ds-hero-overlay--satellite-2" src="<?php echo esc_url( $asset_uri . '/hero-satellite-overlay.png?v=' . $asset_version ); ?>" alt="">
				<img class="ds-hero-overlay ds-hero-overlay--satellite ds-hero-overlay--satellite-3" src="<?php echo esc_url( $asset_uri . '/hero-satellite-overlay.png?v=' . $asset_version ); ?>" alt="">
				<img class="ds-hero-overlay ds-hero-overlay--crop" src="<?php echo esc_url( $asset_uri . '/hero-card-crop-health.png?v=' . $asset_version ); ?>" alt="">
				<img class="ds-hero-overlay ds-hero-overlay--yield" src="<?php echo esc_url( $asset_uri . '/hero-card-yield-forecast.png?v=' . $asset_version ); ?>" alt="">
			</div>
		</div>
	</section>

	<section class="ds-about ds-section" id="about-us">
		<div class="container ds-about-ref">
			<div class="ds-about-ref__body">
				<div class="ds-about-ref__media reveal">
					<h2 class="ds-about-ref__title"><span><?php esc_html_e( 'About Us', 'digisaka-theme' ); ?></span><i aria-hidden="true"></i></h2>
					<figure class="ds-about-ref__photo">
						<img src="<?php echo esc_url( $generated_about ); ?>" alt="<?php esc_attr_e( 'Filipino farmers reviewing farm data on a tablet', 'digisaka-theme' ); ?>">
					</figure>
				</div>
				<div class="ds-about-ref__points reveal reveal--delay">
					<div class="ds-about-ref__point">
						<span class="ds-about-ref__icon"><img src="<?php echo esc_url( $asset_uri . '/about-icon-mission.png?v=' . $asset_version ); ?>" alt="" loading="lazy"></span>
						<div><h3><?php esc_html_e( 'Mission', 'digisaka-theme' ); ?></h3><p><?php esc_html_e( 'Empower Filipino farmers with technology and data for better decisions and outcomes.', 'digisaka-theme' ); ?></p></div>
					</div>
					<div class="ds-about-ref__point">
						<span class="ds-about-ref__icon"><img src="<?php echo esc_url( $asset_uri . '/about-icon-vision.png?v=' . $asset_version ); ?>" alt="" loading="lazy"></span>
						<div><h3><?php esc_html_e( 'Vision', 'digisaka-theme' ); ?></h3><p><?php esc_html_e( 'A future where every farmer thrives through innovation and strong partnerships.', 'digisaka-theme' ); ?></p></div>
					</div>
					<div class="ds-about-ref__point">
						<span class="ds-about-ref__icon"><img src="<?php echo esc_url( $asset_uri . '/about-icon-commitment.png?v=' . $asset_version ); ?>" alt="" loading="lazy"></span>
						<div><h3><?php esc_html_e( 'Our Commitment', 'digisaka-theme' ); ?></h3><p><?php esc_html_e( 'Building solutions that promote productivity, sustainability, and inclusive growth.', 'digisaka-theme' ); ?></p></div>
					</div>
					<ul class="ds-about-ref__pills reveal" aria-label="<?php esc_attr_e( 'DigiSaka commitments', 'digisaka-theme' ); ?>">
						<li><span><img src="<?php echo esc_url( $asset_uri . '/about-icon-better-farmers.png?v=' . $asset_version ); ?>" alt="" loading="lazy"></span><strong><?php esc_html_e( 'Better Farmers', 'digisaka-theme' ); ?></strong></li>
						<li><span><img src="<?php echo esc_url( $asset_uri . '/about-icon-data-insights.png?v=' . $asset_version ); ?>" alt="" loading="lazy"></span><strong><?php esc_html_e( 'Data-driven Insights', 'digisaka-theme' ); ?></strong></li>
						<li><span><img src="<?php echo esc_url( $asset_uri . '/about-icon-farm-empowerment.png?v=' . $asset_version ); ?>" alt="" loading="lazy"></span><strong><?php esc_html_e( 'Farm Empowerment', 'digisaka-theme' ); ?></strong></li>
						<li><span><img src="<?php echo esc_url( $asset_uri . '/about-icon-close-outlet-market.png?v=' . $asset_version ); ?>" alt="" loading="lazy"></span><strong><?php esc_html_e( 'Close-outlet Market', 'digisaka-theme' ); ?></strong></li>
						<li><span><img src="<?php echo esc_url( $asset_uri . '/about-icon-sustainable-future.png?v=' . $asset_version ); ?>" alt="" loading="lazy"></span><strong><?php esc_html_e( 'Sustainable Future', 'digisaka-theme' ); ?></strong></li>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<section class="ds-web-mobile ds-web-mobile--reference" id="webgis-mobile">
		<div class="container ds-web-mobile-ref">
			<div class="ds-web-mobile-ref__panel ds-web-mobile-ref__panel--webgis reveal">
				<div class="ds-web-mobile-ref__heading">
					<h2><?php esc_html_e( 'Digisaka WebGIS', 'digisaka-theme' ); ?></h2>
					<p><?php esc_html_e( 'Interactive maps and analytics for smarter farm management.', 'digisaka-theme' ); ?></p>
				</div>
				<div class="ds-laptop" aria-label="<?php esc_attr_e( 'DigiSaka WebGIS shown on a laptop', 'digisaka-theme' ); ?>">
					<div class="ds-laptop__screen">
						<img src="<?php echo esc_url( $webgis_screen ); ?>" alt="<?php esc_attr_e( 'DigiSaka WebGIS interactive farm map', 'digisaka-theme' ); ?>">
						<div class="ds-laptop__layers" aria-hidden="true">
							<span><i></i><?php esc_html_e( 'NDVI Layer', 'digisaka-theme' ); ?></span>
							<span><i></i><?php esc_html_e( 'Yield Forecast', 'digisaka-theme' ); ?></span>
							<span><i></i><?php esc_html_e( 'Drought Risk', 'digisaka-theme' ); ?></span>
							<span><i></i><?php esc_html_e( 'Pest Risk', 'digisaka-theme' ); ?></span>
							<em><?php esc_html_e( 'High', 'digisaka-theme' ); ?></em>
							<em><?php esc_html_e( 'Medium', 'digisaka-theme' ); ?></em>
							<em><?php esc_html_e( 'Low', 'digisaka-theme' ); ?></em>
						</div>
					</div>
					<div class="ds-laptop__hinge"></div>
					<div class="ds-laptop__base"></div>
				</div>
			</div>
			<div class="ds-web-mobile-ref__divider" aria-hidden="true"></div>
			<div class="ds-web-mobile-ref__panel ds-web-mobile-ref__panel--mobile reveal reveal--delay">
				<div class="ds-web-mobile-ref__heading">
					<h2><?php esc_html_e( 'Digisaka Mobile Application', 'digisaka-theme' ); ?></h2>
					<p><?php esc_html_e( 'Your farm. Your data. In your hands.', 'digisaka-theme' ); ?></p>
				</div>
			<div class="ds-iphone17-row ds-iphone17-row--mockup">
				<div class="ds-iphone17-mockup">
					<img src="<?php echo esc_url( $iphone17_alerts ); ?>" alt="<?php esc_attr_e( 'DigiSaka farm alerts on iPhone 17', 'digisaka-theme' ); ?>">
				</div>
				<div class="ds-iphone17-mockup">
					<img src="<?php echo esc_url( $iphone17_weather ); ?>" alt="<?php esc_attr_e( 'DigiSaka realtime weather on iPhone 17', 'digisaka-theme' ); ?>">
				</div>
				<div class="ds-iphone17-mockup">
					<img src="<?php echo esc_url( $iphone17_ai_result ); ?>" alt="<?php esc_attr_e( 'DigiSaka AI plant analysis on iPhone 17', 'digisaka-theme' ); ?>">
				</div>
			</div>
				<div class="store-badges ds-store-badges ds-store-badges--reference">
					<a href="<?php echo esc_url( $google_play_url ); ?>" target="_blank" rel="noopener noreferrer">
						<img src="<?php echo esc_url( $asset_uri . '/google_play_store.png' ); ?>" alt="<?php esc_attr_e( 'Get it on Google Play', 'digisaka-theme' ); ?>">
					</a>
					<span class="store-badge--disabled">
						<img src="<?php echo esc_url( $asset_uri . '/apple_app_store.png' ); ?>" alt="<?php esc_attr_e( 'Download on the App Store', 'digisaka-theme' ); ?>">
						<small><?php esc_html_e( 'Coming soon', 'digisaka-theme' ); ?></small>
					</span>
				</div>
			</div>
		</div>
	</section>

	<section class="ds-what ds-what--reference ds-section" id="what-is-digisaka">
		<div class="container ds-what-ref">
			<div class="ds-what-ref__header reveal">
				<h2><?php esc_html_e( 'What is Digisaka?', 'digisaka-theme' ); ?></h2>
				<p><?php esc_html_e( 'Digisaka is a modern digital agriculture platform that combines data, satellite technology, AI, and community to help build a resilient and sustainable agri ecosystem.', 'digisaka-theme' ); ?></p>
			</div>
			<div class="ds-what-ref__body">
				<div class="ds-what-ref__features ds-what-ref__features--left reveal">
					<article class="ds-what-ref__feature">
						<span class="ds-what-ref__icon"><img src="<?php echo esc_url( $what_icon_mobile ); ?>" alt="" loading="lazy"></span>
						<div>
							<h3><?php esc_html_e( 'Mobile Platform', 'digisaka-theme' ); ?></h3>
							<p><?php esc_html_e( 'Access your farms anytime, anywhere', 'digisaka-theme' ); ?></p>
						</div>
					</article>
					<article class="ds-what-ref__feature">
						<span class="ds-what-ref__icon"><img src="<?php echo esc_url( $what_icon_low_carbon ); ?>" alt="" loading="lazy"></span>
						<div>
							<h3><?php esc_html_e( 'Low-carbon Rice Farming', 'digisaka-theme' ); ?></h3>
							<p><?php esc_html_e( 'Promoting sustainable and climate-smart rice farming', 'digisaka-theme' ); ?></p>
						</div>
					</article>
				</div>
				<div class="ds-what-ref__phone reveal reveal--delay" aria-label="<?php esc_attr_e( 'Digisaka mobile agriculture platform dashboard', 'digisaka-theme' ); ?>">
					<img src="<?php echo esc_url( $what_phone ); ?>" alt="<?php esc_attr_e( 'Digisaka mobile platform with farm map and analytics dashboard', 'digisaka-theme' ); ?>">
				</div>
				<div class="ds-what-ref__features ds-what-ref__features--right reveal">
					<article class="ds-what-ref__feature">
						<span class="ds-what-ref__icon"><img src="<?php echo esc_url( $what_icon_satellite ); ?>" alt="" loading="lazy"></span>
						<div>
							<h3><?php esc_html_e( 'Satellite Data', 'digisaka-theme' ); ?></h3>
							<p><?php esc_html_e( 'Real-time satellite images and climate monitoring', 'digisaka-theme' ); ?></p>
						</div>
					</article>
					<article class="ds-what-ref__feature">
						<span class="ds-what-ref__icon"><img src="<?php echo esc_url( $what_icon_gis ); ?>" alt="" loading="lazy"></span>
						<div>
							<h3><?php esc_html_e( 'GIS', 'digisaka-theme' ); ?></h3>
							<p><?php esc_html_e( 'Map-based analysis and farm validation', 'digisaka-theme' ); ?></p>
						</div>
					</article>
					<article class="ds-what-ref__feature">
						<span class="ds-what-ref__icon"><img src="<?php echo esc_url( $what_icon_awd ); ?>" alt="" loading="lazy"></span>
						<div>
							<h3><?php esc_html_e( 'AWD', 'digisaka-theme' ); ?></h3>
							<p><?php esc_html_e( 'Low-carbon water management with AWD', 'digisaka-theme' ); ?></p>
						</div>
					</article>
				</div>
			</div>
		</div>
	</section>

	<section class="ds-platform ds-platform--reference ds-section">
		<div class="container ds-platform-ref">
			<div class="ds-platform-ref__header reveal">
				<h2><?php esc_html_e( 'Our Platform', 'digisaka-theme' ); ?></h2>
			</div>
			<div class="ds-platform-ref__cards" aria-label="<?php esc_attr_e( 'DigiSaka platform capabilities', 'digisaka-theme' ); ?>">
				<article class="ds-platform-ref__card reveal">
					<span class="ds-platform-ref__icon"><img src="<?php echo esc_url( $platform_icon_smart ); ?>" alt="" loading="lazy"></span>
					<h3><?php esc_html_e( 'Smart Farm Monitoring', 'digisaka-theme' ); ?></h3>
				</article>
				<article class="ds-platform-ref__card reveal">
					<span class="ds-platform-ref__icon"><img src="<?php echo esc_url( $platform_icon_precision ); ?>" alt="" loading="lazy"></span>
					<h3><?php esc_html_e( 'Precision Agriculture', 'digisaka-theme' ); ?></h3>
				</article>
				<article class="ds-platform-ref__card ds-platform-ref__card--featured reveal reveal--delay">
					<div class="ds-platform-ref__pandoy">
						<img src="<?php echo esc_url( $platform_pandoy ); ?>" alt="<?php esc_attr_e( 'Pandoy AI Assistant holding a tablet', 'digisaka-theme' ); ?>" loading="lazy">
					</div>
					<h3><?php esc_html_e( 'Pandoy AI Assistant', 'digisaka-theme' ); ?></h3>
					<p><?php esc_html_e( 'Your AI buddy for smarter decisions and pest advice', 'digisaka-theme' ); ?></p>
				</article>
				<article class="ds-platform-ref__card reveal">
					<span class="ds-platform-ref__icon"><img src="<?php echo esc_url( $platform_icon_pest ); ?>" alt="" loading="lazy"></span>
					<h3><?php esc_html_e( 'Pest & Disease Monitoring', 'digisaka-theme' ); ?></h3>
				</article>
				<article class="ds-platform-ref__card reveal">
					<span class="ds-platform-ref__icon"><img src="<?php echo esc_url( $platform_icon_climate ); ?>" alt="" loading="lazy"></span>
					<h3><?php esc_html_e( 'Climate-Smart Farming', 'digisaka-theme' ); ?></h3>
				</article>
			</div>
		</div>
	</section>

	<section class="ds-users ds-users--reference ds-section" style="--ds-users-bg: url('<?php echo esc_url( $users_background ); ?>');">
		<div class="container ds-users-ref">
			<div class="ds-users-ref__header reveal">
				<h2><?php esc_html_e( 'Who Uses Digisaka?', 'digisaka-theme' ); ?></h2>
			</div>
			<div class="ds-users-ref__grid">
				<article class="ds-users-ref__person reveal">
					<div class="ds-users-ref__portrait"><img src="<?php echo esc_url( $users_image_farmers ); ?>" alt="<?php esc_attr_e( 'Filipino farmers using Digisaka', 'digisaka-theme' ); ?>" loading="lazy"></div>
					<h3><?php esc_html_e( 'Filipino Farmers', 'digisaka-theme' ); ?></h3>
					<p><?php esc_html_e( 'Empowering farmers with tools and insights for better productivity', 'digisaka-theme' ); ?></p>
				</article>
				<article class="ds-users-ref__person reveal">
					<div class="ds-users-ref__portrait"><img src="<?php echo esc_url( $users_image_technicians ); ?>" alt="<?php esc_attr_e( 'Agricultural technician using Digisaka data tools', 'digisaka-theme' ); ?>" loading="lazy"></div>
					<h3><?php esc_html_e( 'Agricultural Technicians', 'digisaka-theme' ); ?></h3>
					<p><?php esc_html_e( 'Supporting field operations and providing data-driven recommendations', 'digisaka-theme' ); ?></p>
				</article>
				<article class="ds-users-ref__person reveal">
					<div class="ds-users-ref__portrait"><img src="<?php echo esc_url( $users_image_government ); ?>" alt="<?php esc_attr_e( 'Government agriculture officer using Digisaka', 'digisaka-theme' ); ?>" loading="lazy"></div>
					<h3><?php esc_html_e( 'Government Agencies', 'digisaka-theme' ); ?></h3>
					<p><?php esc_html_e( 'Strengthening agri programs and policy decisions', 'digisaka-theme' ); ?></p>
				</article>
				<article class="ds-users-ref__person reveal">
					<div class="ds-users-ref__portrait"><img src="<?php echo esc_url( $users_image_researchers ); ?>" alt="<?php esc_attr_e( 'Researcher and partner using Digisaka collaboration tools', 'digisaka-theme' ); ?>" loading="lazy"></div>
					<h3><?php esc_html_e( 'Researchers & Partners', 'digisaka-theme' ); ?></h3>
					<p><?php esc_html_e( 'Driving innovation and collaborative solutions', 'digisaka-theme' ); ?></p>
				</article>
			</div>
		</div>
	</section>

	<section class="ds-sustain ds-section">
		<div class="container ds-sustain__grid">
			<div class="reveal">
				<p class="ds-kicker"><?php esc_html_e( 'Supporting Sustainable Agriculture', 'digisaka-theme' ); ?></p>
				<h2><?php esc_html_e( 'Climate-smart farming and carbon market readiness.', 'digisaka-theme' ); ?></h2>
				<p><?php esc_html_e( 'DigiSaka supports monitoring, reporting, and verification for sustainable practices like AWD and low-carbon rice programs.', 'digisaka-theme' ); ?></p>
				<div class="ds-sustain-icons">
					<span>SAT</span><span>AI</span><span>NDVI</span><span>AWD</span><span>CO2</span>
				</div>
			</div>
			<div class="ds-sustain-photos reveal reveal--delay">
				<figure>
					<img src="<?php echo esc_url( $generated_sustainability_field ); ?>" alt="<?php esc_attr_e( 'Sustainable rice field with irrigation and mountains', 'digisaka-theme' ); ?>">
				</figure>
				<figure>
					<img src="<?php echo esc_url( $generated_sustainability_drone ); ?>" alt="<?php esc_attr_e( 'Agricultural drone monitoring a rice field', 'digisaka-theme' ); ?>">
				</figure>
			</div>
		</div>
	</section>

	<section class="ds-partner-news ds-partner-news--refined">
		<div class="ds-partner">
			<div class="container ds-partner__inner reveal">
				<div class="ds-partner__copy">
					<p class="ds-kicker"><?php esc_html_e( 'Partner With DigiSaka', 'digisaka-theme' ); ?></p>
					<h2><?php esc_html_e( 'Work with us to transform Philippine agriculture.', 'digisaka-theme' ); ?></h2>
					<p><?php esc_html_e( 'Collaborate with Leads Agri to scale digital tools, climate-smart programs, and field-ready insights for farming communities.', 'digisaka-theme' ); ?></p>
				</div>
				<div class="ds-partner__actions">
					<div class="ds-partner-logos" aria-label="<?php esc_attr_e( 'Partner logos', 'digisaka-theme' ); ?>">
						<span><img src="<?php echo esc_url( $leads_logo ); ?>" alt="<?php esc_attr_e( 'Leads Agri', 'digisaka-theme' ); ?>"></span>
						<span><img src="<?php echo esc_url( $leads_agri_logo ); ?>" alt="<?php esc_attr_e( 'Leads Agricultural Products Corporation', 'digisaka-theme' ); ?>"></span>
					</div>
					<a class="ds-button ds-button--green ds-partner__cta" href="<?php echo esc_url( home_url( '/partner/' ) ); ?>"><?php esc_html_e( 'Partner With DigiSaka', 'digisaka-theme' ); ?></a>
				</div>
			</div>
		</div>
		<div class="container ds-news">
			<div class="ds-news__header reveal">
				<div>
					<p class="ds-kicker"><?php esc_html_e( 'Latest News & Updates', 'digisaka-theme' ); ?></p>
					<h2><?php esc_html_e( 'Fresh stories from the field', 'digisaka-theme' ); ?></h2>
				</div>
				<a class="ds-news__view" href="<?php echo esc_url( home_url( '/news/' ) ); ?>"><?php esc_html_e( 'View all', 'digisaka-theme' ); ?></a>
			</div>
			<div class="ds-news-grid">
				<?php
				foreach ( $news_cards as $card ) :
					$card_tag  = isset( $card[3] ) ? $card[3] : __( 'News', 'digisaka-theme' );
					$card_date = isset( $card[4] ) ? $card[4] : '';
					?>
					<article class="reveal">
						<a class="ds-news-card__media" href="<?php echo esc_url( home_url( '/news/' ) ); ?>">
							<img src="<?php echo esc_url( $card[0] ); ?>" alt="">
							<span><?php echo esc_html( $card_tag ); ?></span>
						</a>
						<div class="ds-news-card__body">
							<?php if ( $card_date ) : ?>
								<time datetime=""><?php echo esc_html( $card_date ); ?></time>
							<?php endif; ?>
							<h3><?php echo esc_html( $card[1] ); ?></h3>
							<p><?php echo esc_html( $card[2] ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="ds-journey ds-journey--refined">
		<div class="container ds-journey__inner reveal">
			<div class="ds-journey__copy">
				<p class="ds-kicker ds-kicker--light"><?php esc_html_e( 'Start Your Digital Agriculture Journey', 'digisaka-theme' ); ?></p>
				<h2><?php esc_html_e( 'Bring smarter farm decisions to every field.', 'digisaka-theme' ); ?></h2>
				<p><?php esc_html_e( 'Use DigiSaka to connect mobile field teams, satellite-backed WebGIS insights, and sustainability programs in one agriculture workflow.', 'digisaka-theme' ); ?></p>
				<div class="ds-journey__actions" aria-label="<?php esc_attr_e( 'DigiSaka journey actions', 'digisaka-theme' ); ?>">
					<a class="ds-store-pill ds-store-pill--play" href="<?php echo esc_url( $google_play_url ); ?>" target="_blank" rel="noopener noreferrer">
						<img src="<?php echo esc_url( $asset_uri . '/google_play_store.png' ); ?>" alt="<?php esc_attr_e( 'Get it on Google Play', 'digisaka-theme' ); ?>">
					</a>
					<a class="ds-button ds-button--outline" href="<?php echo esc_url( home_url( '/webgis/' ) ); ?>"><?php esc_html_e( 'Explore WebGIS', 'digisaka-theme' ); ?></a>
					<a class="ds-button ds-button--outline" href="<?php echo esc_url( home_url( '/partner/' ) ); ?>"><?php esc_html_e( 'Become a Partner', 'digisaka-theme' ); ?></a>
				</div>
			</div>
			<div class="ds-journey__visual reveal reveal--delay" aria-hidden="true">
				<div class="ds-journey-card ds-journey-card--map">
					<span class="ds-journey-card__icon" aria-hidden="true">🗺️</span>
					<strong><?php esc_html_e( 'WebGIS Layer', 'digisaka-theme' ); ?></strong>
					<p><?php esc_html_e( 'Live satellite insights for every field. Monitor crop health, track boundaries, and make data-driven decisions.', 'digisaka-theme' ); ?></p>
				</div>
				<div class="ds-journey-card ds-journey-card--app">
					<span class="ds-journey-card__icon" aria-hidden="true">📱</span>
					<strong><?php esc_html_e( 'Mobile Alerts', 'digisaka-theme' ); ?></strong>
					<p><?php esc_html_e( 'Timely farm updates straight to your phone. Weather warnings, pest alerts, and field recommendations.', 'digisaka-theme' ); ?></p>
				</div>
				<div class="ds-journey-card ds-journey-card--partner">
					<span class="ds-journey-card__icon" aria-hidden="true">🤝</span>
					<strong><?php esc_html_e( 'Partnerships', 'digisaka-theme' ); ?></strong>
					<p><?php esc_html_e( 'Scale climate-smart programs with institutions. MRV-ready tracking for sustainable agriculture.', 'digisaka-theme' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<section class="ds-contact ds-contact--refined ds-section">
		<div class="container ds-contact__grid">
			<div class="ds-contact__copy reveal">
				<p class="ds-kicker"><?php esc_html_e( 'Contact Us', 'digisaka-theme' ); ?></p>
				<h2><?php esc_html_e( 'Let us build the next agriculture workflow together.', 'digisaka-theme' ); ?></h2>
				<p><?php esc_html_e( 'Reach out for partnership discussions, field implementation support, and sustainability program collaboration with the DigiSaka team.', 'digisaka-theme' ); ?></p>
				<div class="ds-contact-channels" aria-label="<?php esc_attr_e( 'DigiSaka contact options', 'digisaka-theme' ); ?>">
					<a href="<?php echo esc_url( home_url( '/partner/' ) ); ?>">
						<span><?php esc_html_e( '01', 'digisaka-theme' ); ?></span>
						<strong><?php esc_html_e( 'Partner With DigiSaka', 'digisaka-theme' ); ?></strong>
						<em><?php esc_html_e( 'For institutions, programs, and agri collaborators', 'digisaka-theme' ); ?></em>
					</a>
					<a href="<?php echo esc_url( home_url( '/webgis/' ) ); ?>">
						<span><?php esc_html_e( '02', 'digisaka-theme' ); ?></span>
						<strong><?php esc_html_e( 'Explore WebGIS', 'digisaka-theme' ); ?></strong>
						<em><?php esc_html_e( 'For map-based farm monitoring and analytics', 'digisaka-theme' ); ?></em>
					</a>
					<a href="<?php echo esc_url( $google_play_url ); ?>" target="_blank" rel="noopener noreferrer">
						<span><?php esc_html_e( '03', 'digisaka-theme' ); ?></span>
						<strong><?php esc_html_e( 'Download the App', 'digisaka-theme' ); ?></strong>
						<em><?php esc_html_e( 'For mobile farm alerts, updates, and field tools', 'digisaka-theme' ); ?></em>
					</a>
				</div>
			</div>
			<div class="ds-contact-panel ds-contact-panel--refined reveal reveal--delay">
				<div class="ds-contact-map" aria-hidden="true">
					<span></span>
					<div class="ds-contact-map__card">
						<strong><?php esc_html_e( 'DigiSaka Field Hub', 'digisaka-theme' ); ?></strong>
						<small><?php esc_html_e( 'Batangas, Philippines', 'digisaka-theme' ); ?></small>
					</div>
				</div>
				<div class="ds-contact-summary">
					<img src="<?php echo esc_url( $brand_logo ); ?>" alt="<?php esc_attr_e( 'DigiSaka', 'digisaka-theme' ); ?>">
					<ul>
						<li><?php esc_html_e( 'Leads Agricultural Products Corporation', 'digisaka-theme' ); ?></li>
						<li><?php esc_html_e( 'Partnerships, field operations, and digital agriculture support', 'digisaka-theme' ); ?></li>
					</ul>
					<a class="ds-button ds-button--green" href="<?php echo esc_url( home_url( '/partner/' ) ); ?>"><?php esc_html_e( 'Start a Partnership', 'digisaka-theme' ); ?></a>
				</div>
			</div>
		</div>
	</section>
</div>

<?php
get_footer();
