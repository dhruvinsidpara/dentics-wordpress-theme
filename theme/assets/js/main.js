/* Dentics Clinic: small progressive enhancements (no dependencies). */
(function () {
	'use strict';

	// Mobile menu toggle
	var toggle = document.querySelector('.nav-toggle');
	var nav = document.getElementById('primary-nav');
	if (toggle && nav) {
		toggle.addEventListener('click', function () {
			var open = nav.classList.toggle('is-open');
			toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
		});
		nav.addEventListener('click', function (e) {
			if (e.target.closest('a')) {
				nav.classList.remove('is-open');
				toggle.setAttribute('aria-expanded', 'false');
			}
		});
	}

	// Doctors slider: arrow buttons scroll one card at a time
	var track = document.querySelector('.doctor-track');
	if (track) {
		var step = function () {
			var card = track.querySelector('.doctor');
			return card ? card.getBoundingClientRect().width + 40 : track.clientWidth;
		};
		document.querySelectorAll('.slider-btn').forEach(function (btn) {
			btn.addEventListener('click', function () {
				var dir = btn.classList.contains('next') ? 1 : -1;
				track.scrollBy({ left: dir * step(), behavior: 'smooth' });
			});
		});
	}

	// Doctor "Appointment" buttons pre-select that doctor in the form
	var select = document.getElementById('f-doctor');
	document.querySelectorAll('[data-doctor]').forEach(function (link) {
		link.addEventListener('click', function () {
			if (select) {
				select.value = link.getAttribute('data-doctor');
			}
		});
	});
})();
