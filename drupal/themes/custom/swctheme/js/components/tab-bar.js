/**
 * @file
 * Bottom tab bar: marks the active route and prefetches the next screen.
 */

export function initTabBar(context) {
  once('swc-tab-bar', '[data-swc-tab-bar]', context).forEach((bar) => {
    const here = window.location.pathname.replace(/\/$/, '');

    bar.querySelectorAll('a').forEach((link) => {
      const target = new URL(link.href, window.location.origin).pathname.replace(/\/$/, '');
      if (target === here || (target !== '' && here.startsWith(target))) {
        link.classList.add('is-active');
        link.setAttribute('aria-current', 'page');
      }

      // Warm the cache on intent so tab switches feel instant.
      link.addEventListener(
        'pointerenter',
        () => {
          if (link.dataset.prefetched) return;
          const hint = document.createElement('link');
          hint.rel = 'prefetch';
          hint.href = link.href;
          document.head.appendChild(hint);
          link.dataset.prefetched = 'true';
        },
        { once: true }
      );
    });
  });
}
