/**
 * @file
 * Workout of the Day logger.
 *
 * Upgrades the server-rendered set table into an autosaving log: weight, RPE
 * and completion per set, a live progress bar, session notes, and a submit
 * that flushes everything to the API. Offline edits stay in localStorage and
 * replay when the connection returns.
 */

import { createStore, debounce } from '../lib/store.js';
import { api } from '../lib/api.js';

export function initWodLogger(context) {
  once('swc-wod', '[data-swc-wod]', context).forEach((root) => {
    const wodId = root.dataset.swcWod;
    const store = createStore('wod:' + wodId, { sets: {}, notes: '', submitted: false });
    const rows = Array.from(root.querySelectorAll('[data-swc-set]'));
    const fill = root.querySelector('[data-swc-wod-fill]');
    const count = root.querySelector('[data-swc-wod-count]');
    const stateEl = root.querySelector('[data-swc-wod-state]');
    const notesEl = document.querySelector('[data-swc-wod-notes]');
    const submitEl = document.querySelector('[data-swc-wod-submit]');

    const save = debounce(() => flush(store, wodId, stateEl), 700);

    function patchSet(id, key, value) {
      store.set((s) => ({
        ...s,
        sets: { ...s.sets, [id]: { ...(s.sets[id] || {}), [key]: value } },
      }));
      if (stateEl) {
        stateEl.textContent = Drupal.t('Saving…');
        stateEl.classList.add('is-saving');
      }
      save();
    }

    rows.forEach((row) => {
      const id = row.dataset.swcSet;

      row.querySelectorAll('[data-swc-field="weight"], [data-swc-field="rpe"]').forEach((input) => {
        input.addEventListener('input', () => {
          input.classList.toggle('is-dirty', input.value !== '');
          patchSet(id, input.dataset.swcField, input.value);
        });
      });

      const check = row.querySelector('[data-swc-field="done"]');
      if (check) {
        check.addEventListener('click', () => {
          const done = check.getAttribute('aria-pressed') !== 'true';
          check.setAttribute('aria-pressed', String(done));
          patchSet(id, 'done', done);
          if (done && 'vibrate' in navigator) navigator.vibrate(8);
        });
      }
    });

    if (notesEl) {
      notesEl.addEventListener('input', () => {
        store.set({ notes: notesEl.value });
        save();
      });
    }

    if (submitEl) {
      submitEl.addEventListener('click', async () => {
        submitEl.classList.add('is-busy');
        try {
          await flush(store, wodId, stateEl, true);
          store.set({ submitted: true });
          submitEl.classList.add('is-done');
          submitEl.textContent = Drupal.t('Submitted to coach');
        } finally {
          submitEl.classList.remove('is-busy');
        }
      });
    }

    // Paint from stored state (restores an in-progress workout on reload).
    store.subscribe((s) => {
      let done = 0;
      rows.forEach((row) => {
        const set = s.sets[row.dataset.swcSet] || {};
        const weight = row.querySelector('[data-swc-field="weight"]');
        const rpe = row.querySelector('[data-swc-field="rpe"]');
        const check = row.querySelector('[data-swc-field="done"]');
        if (weight && set.weight !== undefined && document.activeElement !== weight) weight.value = set.weight;
        if (rpe && set.rpe !== undefined && document.activeElement !== rpe) rpe.value = set.rpe;
        if (check) check.setAttribute('aria-pressed', String(!!set.done));
        row.classList.toggle('is-complete', !!set.done);
        if (set.done) done += 1;
      });
      if (notesEl && s.notes && document.activeElement !== notesEl) notesEl.value = s.notes;
      const pct = rows.length ? Math.round((done / rows.length) * 100) : 0;
      if (fill) fill.style.width = pct + '%';
      if (count) count.textContent = done + '/' + rows.length + ' ' + Drupal.t('sets');
    });

    window.addEventListener('online', () => flush(store, wodId, stateEl));
  });
}

async function flush(store, wodId, stateEl, final = false) {
  if (!navigator.onLine) {
    if (stateEl) {
      stateEl.textContent = Drupal.t('Saved on this device — will sync when online');
      stateEl.classList.remove('is-saving');
      stateEl.classList.add('is-offline');
    }
    return;
  }
  try {
    await api.post('swc/wod/' + wodId + '/log', { ...store.get(), final });
    if (stateEl) {
      stateEl.textContent = final ? Drupal.t('Submitted') : Drupal.t('Autosaved');
      stateEl.classList.remove('is-saving', 'is-offline');
    }
  } catch (e) {
    if (stateEl) {
      stateEl.textContent = Drupal.t('Saved on this device');
      stateEl.classList.add('is-offline');
    }
  }
}
