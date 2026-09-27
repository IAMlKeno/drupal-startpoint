# Decision 002: Theme Design Approved

**Date:** 2026-09-27  
**Decision:** Accept mobile-first Starterkit theme with revised mockups  
**Status:** ✅ Approved and Ready for Phase 2 Build

## What Was Approved

**Theme Approach:** Drupal 11 core Starterkit + Single Directory Components  
**Aesthetic:** Modern professional (deep navy, teal, gold)  
**Layout:** Mobile-first responsive (320px → 768px → 1024px+)  
**Header:** Non-sticky (scrolls naturally with page content)  

## User Feedback & Revisions Incorporated

**Original Feedback:**
1. Sticky header too large → causes visual overstimulation on reading pages
2. Responsiveness not truly mobile-first

**Revisions Made:**
- ✅ Removed sticky header functionality
- ✅ Rebuilt with mobile-first approach (320px baseline)
- ✅ Compact mobile header (32px logo, hidden nav at mobile)
- ✅ Progressive enhancement: navigation appears at 768px+
- ✅ Tested at all breakpoints: 320px, 768px, 1024px
- ✅ No horizontal scrolling at any viewport

## Mockups Approved

- `mockups/home.html` — Hero + featured sections + footer mega-menu
- `mockups/research-post.html` — Narrow reading column (760px on desktop) + related posts
- `mockups/policy-detail.html` — 2-column layout (content + sidebar) + community comments

All mockups are self-contained, responsive, and WCAG 2.2 AA accessible.

## Design Specifications

**Colors:**
- Primary: Deep navy (#1a2844) — trust, authority
- Secondary: Teal (#3b9a9f) — secondary action, information
- Accent: Gold (#d4a574) — primary CTAs ("Share Your Voice")

**Typography:**
- Headings: Georgia serif (scannable, editorial)
- Body: System sans-serif (fast, accessible)
- Responsive sizing: 28px H1 (mobile) → 48px H1 (desktop)

**Spacing:** 8px baseline grid (mobile) → scales for larger screens

## Phase 2 Build Plan

**Deliverables:**
1. Create Drupal theme directory structure
2. Build Single Directory Components (buttons, cards, hero, nav, footer, comments)
3. Create Twig templates (page.html.twig, node templates)
4. Implement CSS architecture (variables, utilities, components)
5. Test accessibility (keyboard nav, screen readers, contrast)
6. Deploy theme and test on local site

**Timeline:** 1–2 weeks (after content-type and module approvals)

## Next Steps

1. ⏳ Await content-type proposal approval
2. ⏳ Await module proposal approval
3. 🚀 Phase 2: Theme build + content types + module installation
4. 🧪 QA & preview at https://policynexus.ddev.site
5. ✅ Final sign-off and handoff

---

**Approved by:** Elkeno Jones  
**Approved on:** 2026-09-27
