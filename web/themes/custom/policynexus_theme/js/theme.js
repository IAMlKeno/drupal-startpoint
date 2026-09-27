/**
 * PolicyLink Nexus Theme JavaScript
 * Mobile menu toggle and basic interactions
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    // Mobile Menu Toggle
    const menuToggle = document.querySelector('.header__menu-toggle');
    const nav = document.querySelector('.header__nav');

    if (menuToggle && nav) {
      menuToggle.addEventListener('click', function () {
        nav.classList.toggle('is-open');
        const expanded = nav.classList.contains('is-open');
        menuToggle.setAttribute('aria-expanded', expanded);
      });

      // Close menu on link click
      const navLinks = nav.querySelectorAll('a');
      navLinks.forEach(link => {
        link.addEventListener('click', function () {
          nav.classList.remove('is-open');
          menuToggle.setAttribute('aria-expanded', 'false');
        });
      });

      // Close menu on Escape key
      document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && nav.classList.contains('is-open')) {
          nav.classList.remove('is-open');
          menuToggle.setAttribute('aria-expanded', 'false');
        }
      });
    }
  });
})();
