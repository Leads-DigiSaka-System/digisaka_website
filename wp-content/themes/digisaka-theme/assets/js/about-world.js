(function () {
	const world = document.querySelector('[data-digisaka-about-world]');

	if (!world || typeof window.mountScrollWorld !== 'function') {
		return;
	}

	const assets = (world.dataset.assets || '').replace(/\/$/, '');
	const homeUrl = world.dataset.homeUrl || '/';

	window.mountScrollWorld(world, {
		nav: false,
		atmosphere: true,
		hint: 'Scroll through a season',
		diveScroll: 1.18,
		crossfade: 0.34,
		sections: [
			{
				id: 'access',
				label: 'Seed Access',
				still: assets + '/about-world-seed-distribution.png',
				alt: 'Filipino farmers receiving rice seed and registering with a field technician',
				accent: '#f6c453',
				scroll: 1.5,
				linger: 0.32,
				eyebrow: 'The Digisaka Story',
				title: 'From seed to stronger seasons.',
				body: 'Our mission begins with access: connecting Filipino farmers to quality inputs, practical guidance, and a trusted digital record from day one.',
				tags: ['Seed distribution', 'Farmer registration', 'Inclusive access']
			},
			{
				id: 'planting',
				label: 'Planting',
				still: assets + '/about-world-planting.png',
				alt: 'Rice farmers transplanting seedlings while a technician records field activity',
				accent: '#9bc53d',
				scroll: 1.22,
				linger: 0.26,
				eyebrow: 'Plan With Purpose',
				title: 'Every field becomes part of a living farm record.',
				body: 'Planting dates, field boundaries, varieties, and activities become useful information that farmers and field teams can carry through the season.',
				tags: ['Field mapping', 'Crop calendar', 'Ground validation']
			},
			{
				id: 'signals',
				label: 'Farm Signals',
				still: assets + '/about-world-satellite-alerts.png',
				alt: 'A farmer and technician reviewing a mobile alert beside satellite-monitored rice fields',
				accent: '#4dd6a1',
				scroll: 1.3,
				linger: 0.34,
				eyebrow: 'See Risk Earlier',
				title: 'Satellite signals become timely farm action.',
				body: 'Digisaka turns remote sensing, weather, crop health, and field observations into alerts that help teams respond before a small concern becomes a larger loss.',
				tags: ['Satellite monitoring', 'Real-time alerts', 'Crop health']
			},
			{
				id: 'precision',
				label: 'Field Action',
				still: assets + '/about-world-field-application.png',
				alt: 'A trained farmer applying measured crop nutrition with guidance from an agronomist',
				accent: '#f4b73d',
				scroll: 1.25,
				linger: 0.28,
				eyebrow: 'Act With Precision',
				title: 'The right farm decision, at the right moment.',
				body: 'Field guidance helps farmers use Leads Agri solutions responsibly, match recommendations to crop conditions, and document the work that supports better outcomes.',
				tags: ['Agronomic guidance', 'Responsible use', 'Leads Agri']
			},
			{
				id: 'harvest',
				label: 'Shared Harvest',
				still: assets + '/about-world-mechanized-harvest.png',
				alt: 'A cooperative using rented machinery to harvest a mature Philippine rice field',
				accent: '#ffc857',
				scroll: 1.25,
				linger: 0.3,
				eyebrow: 'Opportunity In Motion',
				title: 'Shared machinery brings a better harvest within reach.',
				body: 'Coordinated rental services and clearer farm schedules can reduce delays, improve access to equipment, and help communities harvest at the right time.',
				tags: ['Equipment access', 'Cooperative services', 'Harvest planning']
			},
			{
				id: 'community',
				label: 'Farmer Community',
				still: assets + '/about-world-farmer-education.png',
				alt: 'Filipino farmers joining a seasonal field learning and promotional activity',
				accent: '#79c267',
				scroll: 1.2,
				linger: 0.26,
				eyebrow: 'Knowledge Travels',
				title: 'Innovation works when people learn together.',
				body: 'Leads Marketing activities, field demonstrations, and partner programs keep practical knowledge moving between farmers, technicians, researchers, and communities.',
				tags: ['Farmer education', 'Field demonstrations', 'Partnerships']
			},
			{
				id: 'vision',
				label: 'Our Vision',
				still: assets + '/about-world-resilient-future.png',
				alt: 'Farmers and agricultural partners overlooking a resilient Philippine rice-growing community',
				accent: '#f6c453',
				scroll: 1.6,
				linger: 0.38,
				eyebrow: 'Our Vision',
				title: 'Every farm can thrive through innovation and partnership.',
				body: 'We are building a future where better data strengthens farmer decisions, sustainable practices protect the land, and opportunity reaches more rural communities.',
				tags: ['Resilient farms', 'Inclusive growth', 'Sustainable future'],
				cta: {
					primary: { label: 'Explore the Platform', href: homeUrl + 'platform/' },
					secondary: { label: 'Partner With Digisaka', href: homeUrl + 'partner/' }
				}
			}
		],
		connectors: []
	});
})();
