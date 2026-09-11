/**
 * @file
 * Tested-vs-projected 1RM chart.
 *
 * Markup contract:
 *   <figure class="chart" data-swc-chart
 *           data-tested='[{"week":1,"value":245}, …]'
 *           data-projected='[{"week":6,"value":275}, …]'></figure>
 */

const W = 304;
const H = 165;
const PAD = { top: 20, right: 20, bottom: 20, left: 20 };

export function initOneRmChart(context) {
  once('swc-chart', '[data-swc-chart]', context).forEach((root) => {
    const tested = JSON.parse(root.dataset.tested || '[]');
    const projected = JSON.parse(root.dataset.projected || '[]');
    if (!tested.length) return;

    const all = tested.concat(projected);
    const weeks = all.map((d) => d.week);
    const values = all.map((d) => d.value);
    const minW = Math.min(...weeks);
    const maxW = Math.max(...weeks);
    const minV = Math.floor((Math.min(...values) - 15) / 5) * 5;
    const maxV = Math.ceil((Math.max(...values) + 15) / 5) * 5;

    const x = (w) => PAD.left + ((w - minW) / (maxW - minW || 1)) * (W - PAD.left - PAD.right);
    const y = (v) => H - PAD.bottom - ((v - minV) / (maxV - minV || 1)) * (H - PAD.top - PAD.bottom);
    const pts = (arr) => arr.map((d) => x(d.week).toFixed(1) + ',' + y(d.value).toFixed(1)).join(' ');

    const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
    svg.setAttribute('viewBox', '0 0 ' + W + ' ' + H);
    svg.setAttribute('class', 'chart__canvas');
    svg.setAttribute('role', 'img');
    const last = tested[tested.length - 1];
    const goal = projected.length ? projected[projected.length - 1] : last;
    svg.setAttribute(
      'aria-label',
      Drupal.t('Squat one-rep max: currently @now pounds, projected @goal pounds by week @week', {
        '@now': last.value,
        '@goal': goal.value,
        '@week': goal.week,
      })
    );

    let markup = '';
    for (let i = 0; i <= 3; i += 1) {
      const gy = PAD.top + (i * (H - PAD.top - PAD.bottom)) / 3;
      markup += '<line class="chart__gridline" x1="' + PAD.left / 2 + '" y1="' + gy + '" x2="' + (W - 6) + '" y2="' + gy + '"/>';
    }
    markup += '<text class="chart__axis-label" x="0" y="' + (PAD.top + 4) + '">' + maxV + '</text>';
    markup += '<text class="chart__axis-label" x="0" y="' + (H - PAD.bottom) + '">' + minV + '</text>';

    if (projected.length) {
      markup += '<polyline class="chart__line--projected" points="' + pts(projected) + '"/>';
    }
    markup += '<polyline class="chart__line--tested" points="' + pts(tested) + '"/>';
    tested.forEach((d, i) => {
      const isLast = i === tested.length - 1;
      markup += '<circle class="chart__dot' + (isLast ? ' chart__dot--current' : '') + '" cx="' + x(d.week) + '" cy="' + y(d.value) + '" r="' + (isLast ? 5 : 3.5) + '"/>';
    });
    if (projected.length) {
      markup += '<circle class="chart__dot--target" cx="' + x(goal.week) + '" cy="' + y(goal.value) + '" r="4.5"/>';
      markup += '<text class="chart__callout" x="' + (x(goal.week) - 30) + '" y="' + (y(goal.value) - 9) + '">' + goal.value + ' lb</text>';
    }
    markup += '<text class="chart__axis-label" x="' + (PAD.left - 6) + '" y="' + (H - 4) + '">W' + minW + '</text>';
    markup += '<text class="chart__axis-label" x="' + (W - 28) + '" y="' + (H - 4) + '">W' + maxW + '</text>';

    svg.innerHTML = markup;
    root.appendChild(svg);

    const line = svg.querySelector('.chart__line--tested');
    if (line && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
      const len = line.getTotalLength();
      line.style.setProperty('--len', len);
      line.classList.add('is-animating');
    }
  });
}
