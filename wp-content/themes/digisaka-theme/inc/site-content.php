<?php
/**
 * Reusable Digisaka content.
 *
 * @package DigisakaTheme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function digisaka_theme_site_content() {
	return array(
		'home'           => array(
			'label'       => __( 'Home', 'digisaka-theme' ),
			'eyebrow'     => __( 'Digital Agriculture Platform', 'digisaka-theme' ),
			'title'       => __( 'Transforming Philippine Agriculture Through Digital Innovation', 'digisaka-theme' ),
			'description' => __( 'Digisaka is a digital agriculture platform that empowers farmers, agricultural organizations, and decision-makers through Geographic Information Systems (GIS), satellite technology, artificial intelligence, and data-driven insights.', 'digisaka-theme' ),
			'body'        => __( 'Through Digisaka, users can monitor farms, analyze crop conditions, manage agricultural data, and support sustainable farming practices using modern digital tools. Explore smarter, more sustainable agriculture with Digisaka.', 'digisaka-theme' ),
		),
		'about'          => array(
			'label'       => __( 'About Us', 'digisaka-theme' ),
			'eyebrow'     => __( 'About Digisaka', 'digisaka-theme' ),
			'title'       => __( 'Empowering Agriculture Through Technology', 'digisaka-theme' ),
			'description' => __( 'Digisaka is developed by Leads Agricultural Products Corporation (Leads Agri) as a digital agriculture solution designed to support the modernization and sustainability of Philippine agriculture.', 'digisaka-theme' ),
			'body'        => __( 'By combining GIS technology, satellite imagery, remote sensing, and artificial intelligence, Digisaka provides farmers and agricultural stakeholders with tools to better understand, monitor, and manage agricultural resources. The platform bridges traditional farming practices and digital innovation with accessible technologies that improve productivity, strengthen climate resilience, and promote sustainable farming.', 'digisaka-theme' ),
		),
		'what'           => array(
			'label'       => __( 'What is Digisaka?', 'digisaka-theme' ),
			'eyebrow'     => __( 'What Is Digisaka?', 'digisaka-theme' ),
			'title'       => __( 'A mobile digital backbone for climate-smart agriculture.', 'digisaka-theme' ),
			'description' => __( 'Digisaka combines real-time satellite imagery, remote sensing, GIS technology, and AI-powered insights to help monitor, map, and manage crop production.', 'digisaka-theme' ),
			'body'        => __( 'A major focus of Digisaka is supporting low-carbon rice farming by tracking climate-resilient practices such as Alternate Wetting and Drying (AWD), reducing methane emissions, and enabling opportunities for verified carbon credit programs.', 'digisaka-theme' ),
		),
		'platform'       => array(
			'label'       => __( 'Our Platform', 'digisaka-theme' ),
			'eyebrow'     => __( 'Our Platform', 'digisaka-theme' ),
			'title'       => __( 'Smart digital tools for farm monitoring, analytics, and climate-smart agriculture.', 'digisaka-theme' ),
			'description' => __( 'Digisaka brings together farm mapping, crop analytics, AI-assisted agriculture, and MRV-ready workflows for agricultural teams and stakeholders.', 'digisaka-theme' ),
			'body'        => __( 'The platform supports smarter agricultural operations by combining remote sensing, geospatial information, digital records, and decision-support tools in one connected ecosystem.', 'digisaka-theme' ),
		),
		'webgis'         => array(
			'label'       => __( 'Digisaka WebGIS', 'digisaka-theme' ),
			'eyebrow'     => __( 'WebGIS', 'digisaka-theme' ),
			'title'       => __( 'Explore agricultural data through an interactive mapping platform.', 'digisaka-theme' ),
			'description' => __( 'Digisaka WebGIS enables users to visualize farms, analyze crop conditions, monitor agricultural activities, and access satellite-based insights through an easy-to-use digital map interface.', 'digisaka-theme' ),
			'body'        => __( 'Access Digisaka WebGIS and discover smarter ways to manage agricultural data.', 'digisaka-theme' ),
		),
		'mobile'         => array(
			'label'       => __( 'Digisaka Mobile Application', 'digisaka-theme' ),
			'eyebrow'     => __( 'Mobile App', 'digisaka-theme' ),
			'title'       => __( 'Bring digital agriculture tools directly to the field.', 'digisaka-theme' ),
			'description' => __( 'The Digisaka mobile application allows farmers and agricultural stakeholders to digitally register farms, collect field information, monitor crop conditions, and access AI-powered agricultural insights.', 'digisaka-theme' ),
			'body'        => __( 'Offline-ready field collection, farm geotagging, crop monitoring, and agricultural records management help teams keep data moving even outside the office.', 'digisaka-theme' ),
		),
		'sustainability' => array(
			'label'       => __( 'Supporting Sustainable Agriculture', 'digisaka-theme' ),
			'eyebrow'     => __( 'Climate-Smart Agriculture', 'digisaka-theme' ),
			'title'       => __( 'Supporting Sustainable Agriculture', 'digisaka-theme' ),
			'description' => __( 'Digisaka promotes climate-smart agriculture by providing digital tools that support sustainable farming practices.', 'digisaka-theme' ),
			'body'        => __( 'Through farm monitoring, data collection, and MRV capabilities, Digisaka helps farmers and organizations track climate-resilient practices, including Alternate Wetting and Drying (AWD), and participate in emerging carbon market opportunities.', 'digisaka-theme' ),
		),
		'partner'        => array(
			'label'       => __( 'Partner With Digisaka', 'digisaka-theme' ),
			'eyebrow'     => __( 'Partnerships', 'digisaka-theme' ),
			'title'       => __( 'Build a more connected, sustainable, and resilient agricultural ecosystem.', 'digisaka-theme' ),
			'description' => __( 'Join organizations, institutions, and stakeholders working together to transform Philippine agriculture through technology and innovation.', 'digisaka-theme' ),
			'body'        => __( 'Together, we can build a more connected, sustainable, and resilient agricultural ecosystem.', 'digisaka-theme' ),
		),
		'contact'        => array(
			'label'       => __( 'Contact Us', 'digisaka-theme' ),
			'eyebrow'     => __( 'Contact Us', 'digisaka-theme' ),
			'title'       => __( 'Get in Touch With Digisaka', 'digisaka-theme' ),
			'description' => __( 'Have questions, partnership opportunities, or inquiries about Digisaka? Connect with our team and discover how we can help support digital transformation in agriculture.', 'digisaka-theme' ),
			'body'        => __( 'Leads Agricultural Products Corporation (Leads Agri), developer of the Digisaka Digital Agriculture Platform.', 'digisaka-theme' ),
		),
	);
}

function digisaka_theme_platform_features() {
	return array(
		array( 'Smart Farm Monitoring', 'Monitor farm conditions remotely through digital mapping, satellite imagery, and real-time agricultural data.' ),
		array( 'Precision Agriculture', 'Use crop analytics, vegetation monitoring, and geospatial information to support better farming decisions.' ),
		array( 'AI-Powered Agriculture', 'Identify crop pests and diseases using AI-assisted image analysis and digital farming tools.' ),
		array( 'Climate-Smart Farming', 'Support sustainable farming practices through monitoring, reporting, and verification (MRV) solutions.' ),
	);
}

function digisaka_theme_audiences() {
	return array(
		array( 'Filipino Farmers', 'Digisaka helps farmers transition into precision farming by providing tools to monitor crop health, manage farm information, reduce risks from climate conditions, and access opportunities from sustainable agriculture programs.' ),
		array( 'Agricultural Technicians & Cooperatives', 'Field teams can use Digisaka for farm surveys, digital geotagging, monitoring activities, and providing data-driven recommendations.' ),
		array( 'Government & Research Organizations', 'Digisaka supports agricultural programs, research initiatives, validation activities, and the development of monitoring, reporting, and verification (MRV) frameworks.' ),
	);
}

function digisaka_theme_benefits() {
	return array(
		array( 'Remote Farm Monitoring', 'Monitor land plots anytime using satellite-based information and digital farm tools.' ),
		array( 'AI Pest and Disease Detection', 'Identify possible crop issues through AI-powered image analysis using the Pandoy AI Assistant.' ),
		array( 'Crop Health Analytics', 'Access NDVI vegetation monitoring, crop health maps, and geospatial insights to detect crop stress early.' ),
		array( 'Yield Forecasting', 'Improve farm planning through digital crop calendars and agricultural forecasting tools.' ),
		array( 'Carbon Farming Support', 'Collect and manage data needed for sustainable farming programs and carbon credit initiatives.' ),
	);
}

function digisaka_theme_webgis_features() {
	return array(
		'Interactive farm mapping',
		'Satellite imagery visualization',
		'Crop health monitoring',
		'NDVI analysis',
		'Farm boundary management',
		'Agricultural data visualization',
		'Spatial analytics',
		'Climate information integration',
	);
}

function digisaka_theme_mobile_features() {
	return array(
		'Digital farm registration',
		'Farm geotagging',
		'Field data collection',
		'Crop monitoring',
		'AI pest and disease detection',
		'Agricultural records management',
		'Offline field data collection',
	);
}

function digisaka_theme_media_assets() {
	$asset_uri = get_template_directory_uri() . '/assets/images';
	$generated = $asset_uri . '/generated';
	$version   = defined( 'DIGISAKA_THEME_VERSION' ) ? DIGISAKA_THEME_VERSION : '1.0.0';
	$suffix    = '?v=' . rawurlencode( $version );

	return array(
		'hero' => array(
			'alt' => 'Philippine rice field and mountain landscape with digital agriculture overlays',
			'url' => $asset_uri . '/generated-homepage-hero-reference.png' . $suffix,
		),
		'about' => array(
			'alt' => 'Filipino farmers reviewing farm data on a tablet',
			'url' => $asset_uri . '/generated-homepage-about.png' . $suffix,
		),
		'platform' => array(
			'alt' => 'DigiSaka platform smart monitoring visual',
			'url' => $generated . '/platform-card-smart-monitoring.png' . $suffix,
		),
		'webgis' => array(
			'alt' => 'DigiSaka WebGIS farm mapping dashboard',
			'url' => $asset_uri . '/webgis.png' . $suffix,
		),
		'mobile' => array(
			'alt' => 'DigiSaka mobile farm alerts on iPhone',
			'url' => $generated . '/mobile-iphone17-farm-alerts.jpg' . $suffix,
		),
		'sustainability' => array(
			'alt' => 'Climate-smart rice fields and sustainable agriculture landscape',
			'url' => $asset_uri . '/generated-homepage-sustainability-field.png' . $suffix,
		),
		'partner' => array(
			'alt' => 'Agriculture partnership team working with farmers in a rice field',
			'url' => $asset_uri . '/generated-news-partnership.png' . $suffix,
		),
		'contact' => array(
			'alt' => 'Agriculture field team using digital tools in the farm',
			'url' => $asset_uri . '/generated-news-resilience-drone.png' . $suffix,
		),
	);
}

function digisaka_theme_media( $key, $size = 'default' ) {
	$assets = digisaka_theme_media_assets();
	$asset  = $assets[ $key ] ?? $assets['hero'];

	if ( 'wide' === $size ) {
		$asset['url'] = preg_replace( '/w=\d+/', 'w=1800', $asset['url'] );
	}

	return $asset;
}
function digisaka_theme_page_highlights( $key ) {
	$cards = array(
		'about' => array(
			array( 'Better Farmers', 'Farmer-first tools that turn field observations into practical decisions.' ),
			array( 'Data-driven Insights', 'Satellite, GIS, and field records organized for clearer program action.' ),
			array( 'Farm Empowerment', 'Accessible digital workflows for growers, technicians, and partners.' ),
			array( 'Sustainable Future', 'Climate-smart practices supported by monitoring and reporting tools.' ),
		),
		'webgis' => array(
			array( 'Farm Boundary Mapping', 'Digitize plots, validate field areas, and keep farm records map-ready.' ),
			array( 'Satellite Layers', 'Read crop health, field signals, and environmental context from map layers.' ),
			array( 'NDVI Monitoring', 'Spot crop stress patterns earlier with vegetation and time-series analysis.' ),
			array( 'Program Reports', 'Support teams with visual evidence for faster field recommendations.' ),
		),
		'mobile' => array(
			array( 'Farm Alerts', 'Send important field notifications and advisories directly to users.' ),
			array( 'Weather Updates', 'Help growers prepare through localized weather and farm condition updates.' ),
			array( 'AI Plant Analysis', 'Use image-based crop support for pest, disease, and plant-health signals.' ),
			array( 'Field Collection', 'Collect farm records, photos, and geotagged data from the field.' ),
		),
		'sustainability' => array(
			array( 'AWD Tracking', 'Monitor low-carbon rice practices and water-management activities.' ),
			array( 'MRV Workflows', 'Prepare evidence for monitoring, reporting, and verification programs.' ),
			array( 'Carbon Readiness', 'Organize field data for emerging climate and carbon-market opportunities.' ),
			array( 'Resilient Programs', 'Connect climate-smart practices with practical digital farm monitoring.' ),
		),
		'partner' => array(
			array( 'Program Design', 'Shape digital agriculture programs around real community needs.' ),
			array( 'Farmer Onboarding', 'Support smoother registration, mapping, and field data collection.' ),
			array( 'Shared Dashboards', 'Give teams a common view of farms, progress, and insights.' ),
			array( 'Sustainable Outcomes', 'Build climate-smart initiatives with measurable agriculture impact.' ),
		),
	);

	return $cards[ $key ] ?? array(
		array( 'Connected Platform', 'Bring farm data, digital maps, and decision support into one workflow.' ),
		array( 'Farmer-first Tools', 'Make modern agriculture tools easier for field teams and growers to use.' ),
		array( 'Climate-smart Support', 'Track sustainable practices and program-ready agriculture insights.' ),
	);
}

function digisaka_theme_page_highlight_title( $key ) {
	$titles = array(
		'about'          => __( 'Built around farmers, data, and sustainable growth.', 'digisaka-theme' ),
		'webgis'         => __( 'Map-based tools for smarter farm management.', 'digisaka-theme' ),
		'mobile'         => __( 'Mobile workflows that keep field teams connected.', 'digisaka-theme' ),
		'sustainability' => __( 'Climate-smart systems for resilient agriculture.', 'digisaka-theme' ),
		'partner'        => __( 'Partnership tools for wider agriculture impact.', 'digisaka-theme' ),
	);

	return $titles[ $key ] ?? __( 'Digital agriculture tools for practical field work.', 'digisaka-theme' );
}

function digisaka_theme_sustainability_features() {
	return array(
		'Alternate Wetting and Drying support',
		'Low-carbon rice farming data capture',
		'Monitoring, reporting, and verification workflows',
		'Climate-resilient farm activity tracking',
		'Carbon program documentation support',
		'Sustainability dashboards for partners',
	);
}
