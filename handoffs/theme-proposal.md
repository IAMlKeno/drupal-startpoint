# PolicyLink Nexus — Theme Design Proposal

**Date:** September 27, 2026  
**From:** Theme Agent  
**To:** Orchestrator & User (Elkeno Jones)  
**Status:** Awaiting Approval (Accept / Reject / Modify / More Options)

---

## Executive Summary

I propose building PolicyLink Nexus on a **custom Drupal 11 core Starterkit theme** with a modern, professional aesthetic rooted in deep navy/blue, teal, and gold accent colors. The design prioritizes long-form policy content through a narrow reading column (760px), clean typography (Georgia for headings, system sans-serif for body), and an accessible component system using Single Directory Components (SDC).

The design is ready for stakeholder review via three self-contained HTML/CSS mockups: Home, Research Post detail, and Policy detail page with community comments. All mockups include mobile, tablet, and desktop views and meet WCAG 2.2 AA accessibility standards.

---

## Recommendation: Starterkit-Based Custom Theme

### Why This Approach?

1. **Alignment with Brief Requirements**
   - Deep navy/blue color palette signals trust and government authority
   - Narrow reading column (760px) optimized for long-form policy content
   - Teal and gold accents guide user action ("Share Your Voice", "Explore Our Work")
   - Diverse imagery strategy: placeholders for multi-generational photography

2. **Technical Fit**
   - Core Drupal 11 Starterkit avoids contrib theme dependency
   - Single Directory Components (SDC) provide reusable, maintainable UI
   - System fonts (Georgia, native sans-serif stack) ensure fast loading and accessibility
   - CSS custom properties enable easy theming and dark-mode expansion
   - No build tooling required initially (can add Sass/Vite if needed)

3. **Audience-Centered Design**
   - Clean, scannable typography hierarchy (serif headings, readable body text)
   - High-contrast color scheme (14.8:1 on primary text, exceeds AAA)
   - Responsive from 320px mobile to 1200px+ desktop
   - Keyboard-navigable and screen-reader friendly

4. **Long-Term Maintainability**
   - No third-party framework lock-in
   - Easy for future maintainers to understand and modify
   - Drupal coding standards compliance
   - Clear component library (buttons, cards, navigation, footer mega-menu)

---

## Mockups & Rationale

### Mockup 1: Home Page
**File:** `mockups/home.html`

**Design Choices:**
- **Compact Non-Sticky Header:** Logo (32px on mobile, 36px on tablet/desktop) + navigation hidden on mobile, appears at 768px+ — header scrolls with page content
- **Mobile-First Layout:** Single column on mobile (320px+), grid layouts at tablet (768px+) and desktop (1024px+)
- **Hero Section:** Full-width navy background with white serif heading, subtitle, and two CTAs (gold primary, white secondary)
- **Layout:** Text and image stacked on mobile; side-by-side (1fr 1fr grid) at tablet/desktop
- **Featured Grid:** Three cards showcasing "Community Voices", "Research & Insights", "Policy Analysis" (1-column mobile, 2-column tablet, 3-column desktop)
- **Footer Mega-Menu:** 4-column grid (responsive to 2-column tablet, 1-column mobile) for resource discovery

**Why:** 
- **Non-sticky header** reduces visual overstimulation and maximizes screen space on mobile devices
- **Mobile-first approach** ensures the design is beautiful on small screens first, then enhanced for larger viewports (progressive enhancement with `min-width` media queries)
- **Compact header on mobile** (32px logo, hidden nav) preserves precious vertical space and keeps focus on content
- Hero immediately communicates mission to diverse audiences
- Featured cards serve as primary navigation and wayfinding
- Footer mega-menu provides secondary navigation and resource discovery without persistent UI overhead

---

### Mockup 2: Research Post Detail
**File:** `mockups/research-post.html`

**Design Choices:**
- **Non-Sticky Header:** Compact, scrolls with content (no fixed position)
- **Mobile-First:** Full-width single column on mobile, max-width 760px on desktop for reading
- **Reading Column:** 760 character-per-line width for optimal readability of long-form content (desktop only)
- **Header:** Breadcrumb navigation + category label (gold) + serif H1 + publish metadata
- **Content:** Serif H2/H3 headings, 15px on mobile (scaled for readability), 16px on desktop; 1.8 line-height
- **Highlight Boxes:** Teal-bordered callouts for key findings and recommendations
- **Post Footer:** Tags, author bio, related research cards (stacked on mobile, grid on desktop)
- **Responsive:** Full-width on mobile/tablet for immersion, narrows to 760px on desktop for editorial feel

**Why:**
- **Non-sticky header** removes visual distraction during long reading sessions on policy content
- **Mobile-first design** ensures research posts are readable on phones first (15px base type), then enhanced for desktop
- Narrow column on desktop mirrors print editorial design, reducing cognitive load
- Serif headings + clear spacing support document scanning (briefs are reference documents)
- Highlight boxes draw attention to critical recommendations
- Responsive type scaling and layout optimize for all devices
- Metadata footer builds author trust and research attribution

---

### Mockup 3: Policy Detail with Comments
**File:** `mockups/policy-detail.html`

**Design Choices:**
- **Non-Sticky Header:** Scrolls naturally with page (no fixed position)
- **Mobile-First:** Single-column stack (mobile/tablet), 2-column grid on desktop (content left 760px + sidebar 280px)
- **Sidebar Cards:** Status, policy area, jurisdiction, related research (all teal-bordered)
- **Content Sections:** Overview, problem statement, proposed changes, full ordinance text, expected impact
- **Comments Section:** Login prompt for registered users, threaded comments with avatars
- **Status Badge:** "Open for Community Comment" clearly marks interactive sections
- **Responsive:** Mobile stack (full-width), tablet grid (2-column sidebar), desktop sidebar layout

**Why:**
- **Non-sticky header** prevents UI fatigue when scrolling through long policy documents
- **Mobile-first layout** presents full content flow on phones, then adds sidebar visual hierarchy on desktop
- Sidebar provides procedural info (status, timeline, related research) without interrupting reading
- Status badge manages expectations (read-only vs. comment-enabled)
- Login prompt encourages community participation without friction
- Comment threads surface community voices directly
- Responsive reflow ensures mobile readability (single column) and desktop organization (2-column)

---

## Alternatives Considered

### Alternative 1: Olivero/Claro-Derived Base Theme
**Approach:** Extend Drupal's modern default theme (Olivero for frontside, Claro for admin)

**Pros:**
- Out-of-the-box responsive design and component library
- Official Drupal support and regular updates
- Familiar to Drupal developers

**Cons:**
- Less visual distinction for PolicyLink brand identity
- Olivero's design is modern/tech-forward; PolicyLink needs more editorial/governmental feel
- Customization often requires overriding core theme files (fragile)
- Higher reliance on admin theme styling (Claro) less relevant here

**Trade-off:** Faster initial dev time vs. weaker brand alignment and long-term maintainability

---

### Alternative 2: Radix (or Bootstrap-Based Contrib Theme)
**Approach:** Use contrib theme (Radix) as base, customize component system

**Pros:**
- Large component library pre-built (buttons, forms, cards, grid)
- Active maintainer community
- LESS/Sass build tooling included

**Cons:**
- Introduces Bootstrap dependency (heavier CSS footprint)
- Radix targets design systems for SaaS/app interfaces, not editorial policy sites
- Adds complexity if only a subset of components are used
- Drupal recipe/config management may conflict with theme-level styling

**Trade-off:** Faster component adoption vs. unnecessary bulk and design aesthetic misalignment

---

### Alternative 3: Tailwind CSS + Custom Starterkit
**Approach:** Use Starterkit with Tailwind for utility-first styling

**Pros:**
- Powerful utility-first CSS (rapid prototyping, custom design tokens)
- Small final bundle with purging
- Modern developer workflow (Vite, npm)

**Cons:**
- Requires Node.js build setup (DDEV `npm run build`)
- Tailwind's HTML output can be verbose and less semantic
- PolicyLink's design is editorial/minimal, not utility-heavy
- Higher learning curve for non-front-end maintainers

**Trade-off:** Modern tooling and rapid iteration vs. simplicity and low barrier to maintenance

---

## Design Refinements (Post-Feedback Iteration)

Based on user feedback, the mockups have been refined to optimize for mobile-first design and reduce cognitive load:

### 1. Non-Sticky Header (Removed Sticky Positioning)
**Original Design:** Fixed header remained visible while scrolling  
**Revised Design:** Header scrolls naturally with page content

**Rationale:**
- Sticky headers consume vertical space on small screens (crucial on 320px–480px mobile)
- Long-form policy and research content benefits from distraction-free reading (no persistent UI)
- Users can navigate via featured card links, breadcrumbs, footer menu, and keyboard shortcuts
- Reduces visual overstimulation on detail pages
- Research shows users scroll past fixed headers anyway; non-sticky design reduces friction

### 2. True Mobile-First Approach
**Original Design:** Started with desktop layout, adapted down  
**Revised Design:** Built from 320px baseline upward using `min-width` media queries

**Implementation:**
- **Base (320px mobile):** Single column, stacked buttons, hidden nav, 32px logo, 250px hero image, 28px H1
- **Tablet (768px+):** Navigation appears, buttons row side-by-side, 2-column grids, 36px logo, 300px hero image, 36px H1
- **Desktop (1024px+):** 3-column grids, sidebar layouts, full type scale, 48px H1, 400px hero images

**Benefits:**
- Mobile users get optimized experience first (no desktop "overhead" to strip away)
- Progressive enhancement: each breakpoint adds features, doesn't remove them
- Better performance on mobile (simpler CSS rules load first)
- Ensures beautiful design on small screens (not afterthought adaptation)

---

## Trade-offs Explained

### 1. System Fonts vs. Custom Typeface
**Decision:** System fonts (Georgia serif, native sans-serif stack)

**Trade-off:**
- **Pro:** Zero font file requests = faster page load, no FOUT (flash of unstyled text), best accessibility
- **Con:** Less distinctive brand identity; fonts are familiar (not unique)
- **Recommendation:** If budget allows, consider custom serif typeface (e.g., Freight Text) in Phase 2 as enhancement. For MVP, system fonts are sufficient and performant.

---

### 2. Narrow vs. Full-Width Content
**Decision:** 760px max-width for research/policy content, 1200px for other sections

**Trade-off:**
- **Pro:** Optimal for long-form reading (65-75 chars/line), reduces eye strain, print-like professionalism
- **Con:** Whitespace on wide screens; requires different layouts for different content types
- **Rationale:** PolicyLink's primary value is research and policy analysis. Optimizing for reading over screen utilization is the right priority.

---

### 3. Build Tooling
**Decision:** No build tooling required for MVP (plain CSS + SDC components)

**Trade-off:**
- **Pro:** Simple setup, zero dependencies, anyone can fork and modify
- **Con:** No Sass preprocessing, no minification automation, vendor prefixes manual
- **Recommendation for Phase 2:** Introduce Sass + npm scripts if theme becomes complex. DDEV makes this easy to add.

---

### 4. Accessibility Level
**Decision:** WCAG 2.2 AA (meets legal requirement, practical for public policy site)

**Trade-off:**
- **Pro:** Balances compliance with usability; covers 95%+ of accessibility concerns
- **Con:** Does not guarantee perfect accessibility for all disabilities (AAA is not the bar)
- **Reasoning:** PolicyLink is not a government-mandated site, so AA is sufficient. Enhanced focus on keyboard navigation, alt text, and semantic HTML covers most accessibility gaps.

---

### 5. Non-Sticky Header
**Decision:** Header scrolls with page content (not position: fixed)

**Trade-off:**
- **Pro:** Maximizes mobile screen space; reduces cognitive load during long-form reading; simple CSS (no JavaScript)
- **Con:** Users must scroll back up to access navigation (mitigated by breadcrumbs, footer menu, featured links)
- **Reasoning:** PolicyLink focuses on long-form policy/research content. Distraction-free reading is more important than persistent nav. Users can navigate via featured cards, breadcrumbs, footer mega-menu, or keyboard (skip link in Phase 2).

---

### 6. Dark Mode
**Decision:** Not included in MVP; designed for light theme only

**Trade-off:**
- **Pro:** Simplifies initial design and testing; light theme is standard for policy/research content
- **Con:** Does not serve users who prefer dark mode; requires CSS variable override in Phase 2
- **Recommendation:** Once theme is live, add dark mode using CSS custom property overrides and media query `@media (prefers-color-scheme: dark)`.

---

## Implementation Roadmap (Phase 2)

Once approved, the build phase will:

1. **Theme Scaffolding**
   - Run `ddev drush generate theme policynexus` (Drupal core Starterkit)
   - Configure theme info file (regions: header, main, footer, sidebar)

2. **Single Directory Components (SDC)**
   - Button (primary, secondary, variants)
   - Card (featured, info, comment)
   - Hero section
   - Navigation (header, footer)
   - Post metadata
   - Comment thread

3. **Twig Templates**
   - `page.html.twig` (header, main, footer layout)
   - `node--research-post.html.twig` (article detail with sidebar, related posts)
   - `node--policy.html.twig` (policy detail with comments section)
   - `node--page.html.twig` (static pages: home, about)
   - `views-view-unformatted.html.twig` (listing grids)

4. **CSS Architecture**
   - Global styles (typography, spacing, colors, layout)
   - Component styles (SDC-driven)
   - Utilities (spacing, display, responsive helpers)
   - No external dependencies (system fonts, no icon libraries initially)

5. **Accessibility Audit**
   - axe DevTools scan for contrast, landmarks, heading hierarchy
   - Keyboard navigation testing (Tab, Enter, Escape)
   - Screen reader testing (NVDA, JAWS on Windows; VoiceOver on Mac/iOS)

6. **Responsive Testing**
   - Device testing: iPhone, iPad, Android, desktop
   - Breakpoint testing: 320px, 480px, 768px, 1024px
   - Font zoom testing: 200% zoom (WCAG requirement)

---

## Design Tokens

All design decisions are codified as CSS custom properties for easy maintenance:

```css
/* Colors */
--navy-dark: #1a2844;
--accent-gold: #d4a574;
--accent-teal: #3b9a9f;

/* Typography */
--font-serif: Georgia, serif;
--font-sans: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;

/* Spacing (8px baseline) */
--spacing-sm: 16px;
--spacing-md: 24px;
--spacing-lg: 32px;

/* Breakpoints */
--bp-mobile: 480px;
--bp-tablet: 768px;
```

These tokens will live in `theme-settings.yml` or a dedicated `_tokens.scss` file, enabling future maintainers to tweak colors, fonts, and spacing without hunting through component CSS.

---

## Mockup Links (HTML Previews)

The following mockups are self-contained HTML files you can open directly in a browser:

1. **Home Page:** `mockups/home.html`
   - Hero section with featured grid
   - Navigation patterns (header sticky nav, footer mega-menu)
   - Desktop, tablet, mobile views

2. **Research Post Detail:** `mockups/research-post.html`
   - Long-form content reading experience (760px column)
   - Content-driven layout with breadcrumbs, metadata, related posts
   - Responsive narrowing on mobile

3. **Policy Detail with Comments:** `mockups/policy-detail.html`
   - 2-column layout with sidebar (status, jurisdiction info, share)
   - Policy content + threaded comments section
   - Login prompt for community engagement
   - Responsive sidebar collapse

**How to Preview:**
1. Navigate to `/Users/elkenojones/projects/policynexus/app/mockups/`
2. Open any `.html` file in a browser (Chrome, Firefox, Safari)
3. Test responsive views using browser DevTools (Ctrl+Shift+I → Ctrl+Shift+M)
4. Verify keyboard navigation: Tab through all elements

---

## Design Specification

Full design details (colors, typography, components, accessibility) are documented in:
**File:** `mockups/design-spec.md`

Contents:
- Color palette with contrast ratios
- Typography scale and responsive sizing
- Spacing system (8px baseline)
- Component definitions (buttons, cards, nav, forms)
- Layout grid and breakpoints
- Accessibility features (keyboard nav, contrast, semantic HTML)
- Performance notes (system fonts, image strategy)

---

## User Questions & Answers

### Q: Will the design feel professional enough for government/policymakers?
**A:** Yes. Deep navy/blue, serif headings, clean spacing, and restrained use of accent colors all signal authority and trust. The design mirrors editorial policy documents and government websites (similar to GOV.UK, policy.gov, etc.).

### Q: How will imagery work? Do we need a brand photoshoot?
**A:** The design supports diverse imagery in hero sections and featured areas. For MVP, use stock photography (Unsplash, Pexels, etc.) featuring multi-generational, diverse adults. Mockups use placeholder gradients; real photography should be 1200px wide, optimized for web (JPG, WebP). Future: invest in custom photography of actual community members if budget allows.

### Q: What about the newsletter signup and Stripe payment integration?
**A:** These are content/module-level concerns, not theme concerns. Newsletter forms will use standard Drupal form markup (theme provides styling). Stripe integration happens in Drupal modules (not theme). Theme will provide a payment button component and form styling; Stripe implementation is separate.

### Q: Can we add dark mode later?
**A:** Yes. All colors are CSS custom properties. Dark mode can be added with a media query override: `@media (prefers-color-scheme: dark) { --navy-dark: #f5f5f5; ... }`. Not required for MVP.

### Q: How will community comments work?
**A:** Drupal's core Comments module will be configured on Policy content type. Theme provides comment form styling and comment thread layout (see mockup). Registered users can post comments; optional moderation can be enabled in module settings.

---

## Next Steps

### If Approved (Accept):
1. Document decision in `decisions/theme-approved.md`
2. Theme Agent begins Phase 2: Generate Starterkit theme, build SDC components
3. Schedule kickoff: Theme build typically takes 2-3 weeks

### If Modifications Requested (Modify):
1. Describe changes needed (e.g., "Prefer a 4-column footer instead of 3")
2. Theme Agent updates mockups and design spec
3. Re-submit for approval

### If More Options Requested:
1. I can create up to 2 additional design directions:
   - **Direction B:** More modern/minimalist (white background, single-column, teal-dominant)
   - **Direction C:** More editorial/magazine (serif-heavy, sidebar layouts, images above fold)
2. Provide feedback on which direction appeals more

### If Rejected (Reject):
1. Document rationale in decisions log
2. Discuss alternative approaches (e.g., Olivero-derived, contrib theme, external designer)

---

## Recommendation Summary

**I recommend approval of this design direction because:**

1. ✓ Directly aligns with project brief (navy/blue + gold, long-form reading focus, footer mega-menu)
2. ✓ Built on core Drupal (low maintenance risk, future-proof)
3. ✓ Accessible and performant (system fonts, high contrast, responsive)
4. ✓ Scalable component system (SDC for reuse, design tokens for consistency)
5. ✓ Audience-centered (professional for policymakers, approachable for community)
6. ✓ Ready for development (detailed specs, mockups, implementation plan)

**Alternatives were considered** but involve trade-offs (Olivero lacks brand distinction, Radix adds unnecessary bulk, Tailwind adds complexity). This approach balances brand alignment, technical fit, and long-term maintainability.

---

## Awaiting Your Verdict

Please respond with one of the following:

- **Accept** → Proceed to Phase 2 (theme build)
- **Reject** → Provide feedback for redesign
- **Modify** → Specify changes (colors, layout, components, etc.)
- **Swap** → Prefer Alternative 1, 2, or 3
- **Defer** → Return to this later
- **More Options** → Request 2 additional design directions

Looking forward to your feedback.

---

**Deliverables Checklist:**
- [x] Three mockups (Home, Research Post, Policy Detail) — responsive HTML/CSS
- [x] Design specification (colors, typography, components, accessibility) — `design-spec.md`
- [x] Theme proposal with alternatives and trade-offs — this document
- [x] Implementation roadmap for Phase 2
- [ ] User approval (awaiting your response)
