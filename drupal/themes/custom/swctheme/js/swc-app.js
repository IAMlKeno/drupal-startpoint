/**
 * @file
 * Theme entry point. Registers every component as a Drupal behavior so the
 * portal keeps working through AJAX, BigPipe and Views replacements.
 */

import { initAppBar } from './components/app-bar.js';
import { initTabBar } from './components/tab-bar.js';
import { initWodLogger } from './components/wod-logger.js';
import { initOneRmChart } from './components/one-rm-chart.js';
import { initStatCounters } from './components/stat-counter.js';
import { initViewEnhance } from './components/view-enhance.js';

const components = [
  ['swcAppBar', initAppBar],
  ['swcTabBar', initTabBar],
  ['swcWodLogger', initWodLogger],
  ['swcOneRmChart', initOneRmChart],
  ['swcStatCounter', initStatCounters],
  ['swcViewEnhance', initViewEnhance],
];

for (const [id, init] of components) {
  Drupal.behaviors[id] = {
    attach(context, settings) {
      init(context, settings);
    },
  };
}

// Menu + scrim are small enough to live here.
Drupal.behaviors.swcNav = {
  attach(context) {
    once('swc-nav', '[data-swc-menu-toggle]', context).forEach((toggle) => {
      const nav = document.getElementById(toggle.getAttribute('aria-controls'));
      const scrim = document.querySelector('[data-swc-scrim]');
      toggle.addEventListener('click', () => {
        const open = toggle.getAttribute('aria-expanded') !== 'true';
        toggle.setAttribute('aria-expanded', String(open));
        nav.classList.toggle('is-open', open);
        document.documentElement.classList.toggle('has-open-nav', open);
        if (scrim) scrim.hidden = !open;
      });
      if (scrim) {
        scrim.addEventListener('click', () => toggle.click());
      }
    });
  },
};
