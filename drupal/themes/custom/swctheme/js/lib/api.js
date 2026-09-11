/**
 * @file
 * Thin fetch wrapper for the portal's REST/JSON:API endpoints.
 */

let csrfToken = null;

async function token() {
  if (csrfToken) return csrfToken;
  const res = await fetch(Drupal.url('session/token'), { credentials: 'same-origin' });
  csrfToken = await res.text();
  return csrfToken;
}

async function request(method, path, body) {
  const headers = { 'Content-Type': 'application/json' };
  if (method !== 'GET') {
    headers['X-CSRF-Token'] = await token();
  }
  const res = await fetch(Drupal.url(path), {
    method,
    headers,
    credentials: 'same-origin',
    body: body ? JSON.stringify(body) : undefined,
  });
  if (!res.ok) {
    throw new Error('SWC API ' + method + ' ' + path + ' failed: ' + res.status);
  }
  return res.status === 204 ? null : res.json();
}

export const api = {
  get: (path) => request('GET', path),
  post: (path, body) => request('POST', path, body),
  patch: (path, body) => request('PATCH', path, body),
};

/** Fetch a fragment of rendered HTML (used by the views enhancer). */
export async function fetchFragment(url) {
  const res = await fetch(url, {
    credentials: 'same-origin',
    headers: { 'X-Requested-With': 'XMLHttpRequest' },
  });
  const html = await res.text();
  return new DOMParser().parseFromString(html, 'text/html');
}
