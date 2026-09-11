/**
 * @file
 * Minimal observable store with localStorage persistence.
 *
 * Gym wifi is unreliable, so every logged set lands in localStorage first and
 * syncs opportunistically. Keys are namespaced per workout.
 */

const PREFIX = 'swc:';

export function createStore(key, initial = {}) {
  const storageKey = PREFIX + key;
  let state = { ...initial, ...read(storageKey) };
  const listeners = new Set();

  function read(k) {
    try {
      return JSON.parse(window.localStorage.getItem(k) || '{}');
    } catch (e) {
      return {};
    }
  }

  function persist() {
    try {
      window.localStorage.setItem(storageKey, JSON.stringify(state));
    } catch (e) {
      /* Quota or private mode: in-memory only. */
    }
  }

  return {
    get() {
      return state;
    },
    set(patch) {
      state = typeof patch === 'function' ? patch(state) : { ...state, ...patch };
      persist();
      listeners.forEach((fn) => fn(state));
      return state;
    },
    subscribe(fn) {
      listeners.add(fn);
      fn(state);
      return () => listeners.delete(fn);
    },
    clear() {
      state = { ...initial };
      window.localStorage.removeItem(storageKey);
      listeners.forEach((fn) => fn(state));
    },
  };
}

/** Trailing-edge debounce, used for autosave. */
export function debounce(fn, wait = 600) {
  let t;
  return (...args) => {
    clearTimeout(t);
    t = setTimeout(() => fn(...args), wait);
  };
}
