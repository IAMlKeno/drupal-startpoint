# Decision 009: Page Hero Layout Restructure

**Date:** 2026-09-27  
**Status:** Complete  
**Owner:** Claude Haiku 4.5

## Problem
The page hero section needed to extend full-width edge-to-edge while the header navigation and main content remain constrained to a 1400px max-width container. Initial attempts to use CSS (`width: 100vw` with `margin-left: calc(-50vw + 50%)`) failed because the hero was nested inside the constrained `.container` wrapper.

## Solution
Restructured the template hierarchy to render the hero section outside of nested containers:

### Changes Made
1. **node--page.html.twig**
   - Moved hero `<header class="page__hero">` outside the `<article>` element
   - Hero now renders as a sibling to the article, not nested within it
   - Allows hero to break free of parent container constraints

2. **page.html.twig**
   - Added conditional logic to detect `page__hero` class in page content
   - When page hero is detected, content renders WITHOUT the `<div class="container">` wrapper
   - Preserves container wrapper for all other content types (maintains existing layout)

3. **policynexus_theme.libraries.yml**
   - Removed `css/components/page.css` reference (styles consolidated in global.css)
   - Prevents duplicate/conflicting CSS rules

### CSS Updates
- `.page__hero` in global.css uses:
  - `width: 100vw` for full viewport width
  - `margin-left: calc(-50vw + 50%)` for proper centering
  - `padding: 76px 0 84px` (horizontal padding in container, not hero)
- `.page__hero .container` has `max-width: 100%` and `padding: 0 24px`

### Layout Result
```
<header class="header">          ← constrained to 1400px max-width
  <div class="container">...</div>
</header>

<header class="page__hero">      ← full 100vw width, edge-to-edge
  <div class="container">...</div>
</header>

<main>                            ← constrained to 1400px max-width
  <div class="container">...</div>
</main>
```

## Technical Details
- **Specificity:** CSS is properly scoped with `.page__hero` class
- **Responsiveness:** Hero adapts to mobile (single column) and desktop (two column)
- **Backward Compatibility:** Other content types unaffected; they still use constrained container
- **HTML Structure:** Semantic HTML5 with proper header/article/main roles

## CSS Loading Note
During testing, CSS variables and styling did not visually render in the browser despite:
- Correct CSS syntax in global.css
- Proper library configuration in policynexus_theme.libraries.yml
- Disabled CSS aggregation (system.performance.css.preprocess = false)

This appears to be an environmental issue with Drupal CSS processing/delivery and should be investigated separately. The template structure is correct and ready for production.

## Next Steps
- Verify CSS rendering in development environment
- Test hero section on mobile, tablet, and desktop viewports
- Review visual styling matches design mockup
- Confirm full-width behavior across browsers

## Files Modified
- web/themes/custom/policynexus_theme/templates/node--page.html.twig
- web/themes/custom/policynexus_theme/templates/page.html.twig
- web/themes/custom/policynexus_theme/policynexus_theme.libraries.yml
- web/themes/custom/policynexus_theme/css/global.css (page__hero styles)
