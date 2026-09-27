# Decision 003: Content Types & Taxonomy Approved

**Date:** 2026-09-27  
**Decision:** Accept content-type proposal with suggested additions (FAQ, Team Member)  
**Status:** ✅ Approved and Ready for Phase 2 Build

## What Was Approved

### 4 Core Content Types
1. **Page** — Static content (Home, About, generic sections)
   - Fields: Title, Body, Summary, Featured Image, Meta Description, Related Pages
2. **Research Post** — Policy analysis, briefs, research papers
   - Fields: Title, Author, Publish Date, Body, Research Area (taxonomy), Abstract, Featured Image, Download Link, Related Posts
3. **Community Story** — Testimonials, case studies, outcome narratives
   - Fields: Title, Storyteller Name, Storyteller Title, Body, Outcome, Featured Image, Community/Location (taxonomy)
4. **Policy** — Policy description + threaded comments for registered users
   - Fields: Title, Policy Text, Category (taxonomy), Effective Date, Official Source URL, Featured Image, Related Policies
   - **Comments:** Enabled for registered users only

### 3 Taxonomies
- **Research Areas:** Economic, Social, Education, Healthcare, Immigration, Housing, Criminal Justice, Environmental, Labor, Other
- **Policy Categories:** Federal, State, Local, Proposed, Executive Order, Regulation, Legislation, Community Benefit Agreement, Other
- **Communities:** Immigrant Communities, Youth, Seniors, Working Parents, Small Business Owners, Environmental Justice, LGBTQ+, People with Disabilities, Other

### 4 User Roles with Permissions
- **Anonymous:** View published content only
- **Registered Community:** View all published content, comment on policies, manage own account
- **Editor:** Create/edit/delete all content, manage taxonomies, moderate comments
- **Admin:** Full access (content, users, settings, modules)

## Suggested Additions (Recommended at Launch)

✅ **FAQ** (Low cost: ~3–5 hours)
- Questions, answers, categories, related policies
- Improves SEO (question/answer schema)
- Reduces support burden
- **Recommendation:** Include at launch

✅ **Team Member** (Low cost: ~3 hours)
- Name, title, bio, photo, research areas, contact, social links
- Supports author bylines and credibility
- Enables author archive pages
- **Recommendation:** Include at launch

⏸️ **Event** (Medium cost: ~5–8 hours)
- Title, description, date/time, location, registration, featured image
- Useful for community engagement touchpoints
- **Recommendation:** Defer to Phase 2

⏸️ **Landing Page** (Medium cost: ~4–6 hours)
- Conversion-focused pages for service sales funnel
- Separate from generic Pages
- **Recommendation:** Defer to Phase 2 (use Pages initially)

## Implementation Approach

- **Modules Needed:** None (all core functionality)
- **Config Format:** Drupal recipes (for portability) + YAML export
- **View Modes:** Multiple per type (full, teaser, card, search_result)
- **Multilingual:** Content translation (EN/FR) enabled on all types
- **Revision Tracking:** Enabled on all types (no approval workflow)

## Phase 2 Build Plan

1. Create content-type structures in Drupal UI
2. Export config as recipes (recipes/content-types/)
3. Create view modes (full, teaser, card)
4. Create taxonomies and term defaults
5. Set up user roles and permissions
6. Test content creation and display
7. Create sample content for previews

## Next Steps

1. 🚀 Proceed to Module Installation (Phase 2)
2. 🏗️ Build theme components and templates
3. 🧪 QA & testing on live site
4. ✅ Final sign-off and launch

---

**Approved by:** Elkeno Jones  
**Approved on:** 2026-09-27
