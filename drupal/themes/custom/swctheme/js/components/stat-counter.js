/**
 * @file
 * Counts stat tiles up when they scroll into view.
 */

export function initStatCounters(context) {
  const reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  once('swc-stat', '[data-swc-count-to]', context).forEach((el) => {
    const target = Number(el.dataset.swcCountTo);
    if (Number.isNaN(target)) return;
    if (reduce) {
      el.textContent = String(target);
      return;
    }

    const io = new IntersectionObserver(([entry]) => {
      if (!entry.isIntersecting) return;
      io.disconnect();
      const start = performance.now();
      const dur = 700;
      const tick = (now) => {
        const p = Math.min((now - start) / dur, 1);
        const eased = 1 - Math.pow(1 - p, 3);
        el.textContent = String(Math.round(target * eased));
        if (p < 1) requestAnimationFrame(tick);
      };
      requestAnimationFrame(tick);
    }, { threshold: 0.4 });

    io.observe(el);
  });
}
