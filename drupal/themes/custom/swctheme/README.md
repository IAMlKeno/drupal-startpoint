# Squat with Confidence — `swc` theme

A standalone Drupal 10/11 front-end theme for the athlete portal. **Not an Olivero
sub-theme.** Olivero's markup (site-header__fixable, sticky-header-toggle, social-bar,
five footer regions) is built for a marketing site and fights the app shell in the
mockup. `swc` extends `stable9` instead, so we inherit Drupal core's clean,
version-locked base templates and nothing else.

The two templates you supplied are re-implemented here:

| Supplied (Olivero) | Here |
|---|---|
| `page.html.twig` | `templates/layout/page.html.twig` — app shell: navy app bar, safe-area content, bottom tab bar |
| `views-view.html.twig` | `templates/views/views-view.html.twig` — card-list view wrapper, JS hooks for filtering/lazy pager |

## JavaScript-biased architecture

The theme ships behaviour, not just paint. All JS is native ES modules attached
through `Drupal.behaviors`, so it survives AJAX/BigPipe re-renders.

```
js/
  swc-app.js            entry: registers behaviors, boots modules found in the DOM
  lib/store.js          tiny observable store + localStorage autosave (offline gym wifi)
  lib/api.js            JSON:API / REST helpers with CSRF token handling
  components/
    app-bar.js          scroll-condensing navy header
    tab-bar.js          bottom nav, active-route sync, haptic-ish press state
    wod-logger.js       the WOD table: per-set weight/RPE/complete, progress, autosave, submit
    one-rm-chart.js     tested-vs-projected SVG chart, drawn from data-* payload
    stat-counter.js     count-up on the profile stat tiles
    view-enhance.js     progressive enhancement for views: instant filters, "load more" pager
```

Server-rendered HTML is always complete and usable; every module upgrades it in
place (no hydration blank state, no JS framework build step, no npm install).

## CSS — categorized (ITCSS-ish)

```
css/base/        variables (design tokens), reset, typography
css/layout/      page shell, grid, regions
css/components/  app-bar, tab-bar, card, button, stat, wod-table, chart, session-list, view, media
css/state/       states + utilities
```

Loaded as separate library components in `swc.libraries.yml` so the WOD and profile
CSS/JS only load on the pages that need them.

## Install

1. Copy `swc/` to `web/themes/custom/swc`.
2. `drush theme:enable swc && drush config:set system.theme default swc`
3. `drush cr`

## Regions

`app_bar`, `primary_menu`, `hero`, `highlighted`, `breadcrumb`, `content_above`,
`content`, `content_below`, `sidebar`, `tab_bar`, `footer`.
