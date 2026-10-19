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

/* Ceník: sloupce „nadpis | položky | ceny“ (dva seznamy se stejným počtem řádků) se srovnají
   řádek po řádku – na mobilu se tak nevypíšou nejdřív všechny položky a pak všechny ceny. */
(() => {
	const rows = [];
	document.querySelectorAll('[data-ekt-content] .wp-block-columns').forEach((block) => {
		const cols = [...block.children].filter((c) => c.classList.contains('wp-block-column'));
		if (cols.length !== 3) return;
		// Položky ze všech seznamů ve sloupci (ceny bývají rozdělené do víc seznamů).
		const [a, b] = cols.slice(1).map((c) => [...c.querySelectorAll(':scope > ul > li')]);
		if (!a.length || a.length !== b.length || !cols[2].querySelector('code')) return;
		block.classList.add('lc-pricelist');
		if (!cols[0].textContent.trim()) cols[0].classList.add('lc-pricelist__empty');
		a.forEach((li, i) => rows.push([li, b[i]]));
	});
	if (!rows.length) return;
	const sync = () => {
		rows.forEach(([x, y]) => { x.style.minHeight = y.style.minHeight = ''; });
		rows.forEach(([x, y]) => {
			const h = Math.max(x.offsetHeight, y.offsetHeight);
			x.style.minHeight = y.style.minHeight = h + 'px';
		});
	};
	sync();
	let t;
	window.addEventListener('resize', () => { clearTimeout(t); t = setTimeout(sync, 100); });
	if (document.fonts) document.fonts.ready.then(sync);
})();
