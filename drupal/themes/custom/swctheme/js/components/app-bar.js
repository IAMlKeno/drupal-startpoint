/**
 * @file
 * Condenses the app bar once the page scrolls past the hero.
 */

export function initAppBar(context) {
  once('swc-app-bar', '[data-swc-app-bar]', context).forEach((bar) => {
    const sentinel = document.createElement('div');
    sentinel.style.cssText = 'position:absolute;top:0;height:1px;width:1px';
    bar.parentNode.insertBefore(sentinel, bar.nextSibling);

    const io = new IntersectionObserver(
      ([entry]) => bar.classList.toggle('is-condensed', !entry.isIntersecting),
      { rootMargin: '-72px 0px 0px 0px' }
    );
    io.observe(sentinel);
  });
}
