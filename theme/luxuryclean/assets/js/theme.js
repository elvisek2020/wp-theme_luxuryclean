/* Šablona Luxury Clean: mobilní menu a podmenu na dotyk. Režim a ostatní řeší kanonické moduly. */
(() => {
	const toggle = document.querySelector('[data-lc-nav-toggle]');
	const nav = document.getElementById('site-nav');
	if (!toggle || !nav) return;
	const close = () => {
		toggle.setAttribute('aria-expanded', 'false');
		document.documentElement.classList.remove('lc-nav-open');
	};
	toggle.addEventListener('click', () => {
		const open = toggle.getAttribute('aria-expanded') !== 'true';
		toggle.setAttribute('aria-expanded', String(open));
		document.documentElement.classList.toggle('lc-nav-open', open);
	});
	document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });
	// Položka s podmenu a odkazem „#“: klik rozbalí podmenu (dotyk i mobil).
	nav.querySelectorAll('.menu-item-has-children > a').forEach((a) => {
		a.setAttribute('aria-expanded', 'false');
		a.addEventListener('click', (e) => {
			const li = a.parentElement;
			if (a.getAttribute('href') === '#' || window.matchMedia('(max-width: 960px)').matches) {
				e.preventDefault();
				const open = !li.classList.contains('is-open');
				nav.querySelectorAll('.menu-item-has-children.is-open').forEach((x) => { if (x !== li) { x.classList.remove('is-open'); x.firstElementChild.setAttribute('aria-expanded', 'false'); } });
				li.classList.toggle('is-open', open);
				a.setAttribute('aria-expanded', String(open));
			}
		});
	});
	document.addEventListener('click', (e) => {
		if (!nav.contains(e.target)) nav.querySelectorAll('.menu-item-has-children.is-open').forEach((x) => { x.classList.remove('is-open'); x.firstElementChild.setAttribute('aria-expanded', 'false'); });
	});
})();
