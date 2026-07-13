(function () {
	const header = document.querySelector('[data-digisaka-header]');
	const navToggle = document.querySelector('[data-nav-toggle]');
	const nav = document.querySelector('[data-primary-nav]');
	const revealItems = document.querySelectorAll('.reveal');

	function setHeaderState() {
		if (!header) {
			return;
		}

		header.classList.toggle('is-scrolled', window.scrollY > 12);
	}

	setHeaderState();
	window.addEventListener('scroll', setHeaderState, { passive: true });

	if (navToggle && nav) {
		navToggle.addEventListener('click', function () {
			const isOpen = document.body.classList.toggle('nav-open');
			navToggle.setAttribute('aria-expanded', String(isOpen));
		});

		nav.addEventListener('click', function (event) {
			if (event.target && event.target.tagName === 'A') {
				document.body.classList.remove('nav-open');
				navToggle.setAttribute('aria-expanded', 'false');
			}
		});
	}

	if ('IntersectionObserver' in window) {
		const observer = new IntersectionObserver(function (entries) {
			entries.forEach(function (entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('is-visible');
					observer.unobserve(entry.target);
				}
			});
		}, { threshold: 0.14 });

		revealItems.forEach(function (item) {
			observer.observe(item);
		});
	} else {
		revealItems.forEach(function (item) {
			item.classList.add('is-visible');
		});
	}

	document.querySelectorAll('.magnetic').forEach(function (button) {
		button.addEventListener('mousemove', function (event) {
			const rect = button.getBoundingClientRect();
			const x = event.clientX - rect.left - rect.width / 2;
			const y = event.clientY - rect.top - rect.height / 2;
			button.style.transform = 'translate(' + x * 0.08 + 'px, ' + y * 0.08 + 'px)';
		});

		button.addEventListener('mouseleave', function () {
			button.style.transform = '';
		});
	});
})();
