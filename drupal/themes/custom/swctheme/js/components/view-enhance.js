/**
 * @file
 * Progressive enhancement for views rendered through views-view.html.twig.
 *
 * - exposed filters submit on change, no reload
 * - the pager becomes an append-in-place "load more"
 * Falls back to standard full-page Views behaviour with JS off.
 */

import { fetchFragment } from '../lib/api.js';

export function initViewEnhance(context) {
  once('swc-view', '[data-swc-view]', context).forEach((view) => {
    const rows = view.querySelector('[data-swc-view-rows]');
    const filters = view.querySelector('[data-swc-view-filters] form');
    const pager = view.querySelector('[data-swc-view-pager]');
    if (!rows) return;

    view.classList.add('is-enhanced');

    async function load(url, { append = false } = {}) {
      rows.setAttribute('aria-busy', 'true');
      try {
        const doc = await fetchFragment(url);
        const fresh = doc.querySelector('[data-swc-view-dom-id="' + view.dataset.swcViewDomId + '"]');
        if (!fresh) {
          window.location.href = url;
          return;
        }
        const freshRows = fresh.querySelector('[data-swc-view-rows]');
        if (append && freshRows) {
          rows.append(...freshRows.childNodes);
        } else if (freshRows) {
          rows.replaceChildren(...freshRows.childNodes);
        }
        const freshPager = fresh.querySelector('[data-swc-view-pager]');
        if (pager) pager.replaceChildren(...(freshPager ? freshPager.childNodes : []));
        window.history.replaceState({}, '', url);
        Drupal.attachBehaviors(rows);
      } catch (e) {
        window.location.href = url;
      } finally {
        rows.setAttribute('aria-busy', 'false');
      }
    }

    if (filters) {
      filters.addEventListener('change', () => {
        const params = new URLSearchParams(new FormData(filters));
        load(window.location.pathname + '?' + params.toString());
      });
    }

    if (pager) {
      pager.addEventListener('click', (event) => {
        const next = event.target.closest('a');
        if (!next) return;
        event.preventDefault();
        load(next.href, { append: true });
      });
    }
  });
}
