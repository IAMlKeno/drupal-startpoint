# Content Type Proposal: PolicyLink Nexus

**Date:** 2026-09-27  
**Agent:** Content Type Agent  
**Status:** Proposal (awaiting user approval)

---

## Executive Summary

This proposal designs four core content types (Page, Research Post, Community Story, Policy) supported by two taxonomies (Research Areas, Policy Categories) and four user roles (Anonymous, Registered Community, Editor, Admin).

**Design principles:**
- Simplicity over flexibility: fixed fields rather than Layout Builder, reducing editor training
- Multilinguality first: content translation (EN/FR) built into all types
- Comments only on Policy: threaded discussion enables community voice on specific topics
- Single-editor workflow: no moderation needed, but revision tracking enabled
- Reusable media: images centralized in media entities for consistent resizing and alt-text

---

## Proposed Content Types

### 1. Page

**Machine name:** `page`  
**Label:** Page  
**Purpose:** Static, long-form content (Home, About Us, Contact, How It Works, etc.)

#### Fields

| Field | Type | Cardinality | Required | Widget | Notes |
|-------|------|-------------|----------|--------|-------|
| Title | text | 1 | Yes | textfield | Full page title |
| Body | text_long | 1 | Yes | text_editor (CKEditor 5) | Main content, rich formatting |
| Summary | text_long | 1 | No | text_editor | For teaser display (meta description fallback) |
| Featured Image | media (image) | 1 | No | media_library | Hero image at top of page |
| Meta Description | text | 1 | No | textfield | SEO meta description (max 160 chars, auto-truncated) |
| Related Pages | entity_reference (Page) | ∞ | No | entity_autocomplete | Link to related static pages |

#### Taxonomy & Relationships
- None (standalone)
- May link to related Pages via Related Pages field

#### View Modes
- **full:** Hero image, title, body, related pages sidebar
- **teaser:** Featured image, title, summary excerpt (150 chars), read-more link

#### Workflow & Moderation
- **Revision:** Enabled (track editor changes, no approval step)
- **Moderation:** None (no states; single editor, published immediately on save)
- **Scheduling:** Not needed (brief: no approval workflow)
- **Multilingual:** Content translation (EN/FR)

#### Rationale
- **Why separate from default "Basic Page"?** Drupal's default Basic page is minimal; we customize with featured images, meta descriptions, and related content linking.
- **Why not use Layout Builder?** Single editor model; fixed fields reduce complexity. Can add Layout Builder later if editor requests flexible layouts.
- **Why text_long for Summary?** Editors often need to craft a distinct teaser summary; separate field gives them control.

---

### 2. Research Post

**Machine name:** `research_post`  
**Label:** Research Post  
**Purpose:** Policy analysis, briefs, research papers with author attribution and categorization

#### Fields

| Field | Type | Cardinality | Required | Widget | Notes |
|-------|------|-------------|----------|--------|-------|
| Title | text | 1 | Yes | textfield | Article headline |
| Author | entity_reference (User) | 1 | Yes | entity_autocomplete | Link to user profile for byline |
| Publish Date | datetime | 1 | Yes | datetime | When posted (not revision date) |
| Body | text_long | 1 | Yes | text_editor (CKEditor 5) | Main research content, rich formatting |
| Research Area | entity_reference (Taxonomy: Research Areas) | ∞ | Yes | entity_autocomplete | One or more categories (Economic, Social, Education, etc.) |
| Abstract | text_long | 1 | No | text_editor | Summary for teaser and search results |
| Featured Image | media (image) | 1 | No | media_library | Hero image, appears in teaser |
| Download Link | link | 1 | No | link | External link to PDF brief or full report |
| Related Posts | entity_reference (Research Post) | ∞ | No | entity_autocomplete | Link to related research articles |

#### Taxonomy & Relationships
- **Taxonomy:** Research Areas (Economic Policy, Social Policy, Education Policy, Healthcare Policy, Immigration Policy, Housing Policy, Criminal Justice, Other)
- **Entity Reference:** Author (User), Related Posts (Research Post)

#### View Modes
- **full:** Featured image, title, byline (author name + date), research area tags, body, related posts, download link
- **teaser:** Featured image, title, byline, abstract excerpt (100 chars), read-more link
- **card:** Minimal card: title, featured image, research area tag(s), date
- **search_result:** Title, abstract (truncated to 150 chars), date, author name

#### Workflow & Moderation
- **Revision:** Enabled
- **Moderation:** None (published on save)
- **Scheduling:** Not needed
- **Multilingual:** Content translation (EN/FR)

#### Rationale
- **Why separate from Page?** Research posts need author attribution, date, categorization by research area. Page is static; Research Post is dated, authored content.
- **Why datetime for Publish Date, not entity_reference to author?** Author name can change; storing user UID ensures stable reference and enables author archive pages later.
- **Why Research Area as taxonomy, not tags?** Controlled vocabulary (tagging can become messy). Easier to filter, facet, and maintain.
- **Why Download Link separate from body?** Many briefs are PDFs; link to external report separates the rich-text body from external assets.
- **Why multiple Research Areas per post?** A policy brief might touch on both economic and social impacts; allows editors to tag multiple.

---

### 3. Community Story

**Machine name:** `community_story`  
**Label:** Community Story  
**Purpose:** Testimonials, case studies, outcome narratives from community members

#### Fields

| Field | Type | Cardinality | Required | Widget | Notes |
|-------|------|-------------|----------|--------|-------|
| Title | text | 1 | Yes | textfield | Story headline (often "Name's Story" or scenario) |
| Storyteller Name | text | 1 | Yes | textfield | Full name of person sharing story |
| Storyteller Title | text | 1 | No | textfield | Optional: role/occupation (e.g., "Community Organizer") |
| Body | text_long | 1 | Yes | text_editor (CKEditor 5) | Narrative, rich formatting |
| Outcome | text_long | 1 | No | text_editor | What changed / impact achieved |
| Featured Image | media (image) | 1 | No | media_library | Photo of storyteller or community (diverse imagery) |
| Community/Location | entity_reference (Taxonomy: Communities) | ∞ | No | entity_autocomplete | Geographic or demographic community (San Francisco Bay Area, Immigrant Communities, Youth, Seniors, etc.) |

#### Taxonomy & Relationships
- **Taxonomy:** Communities (Immigrant Communities, Youth, Seniors, Working Parents, Small Business Owners, Environmental Justice, Other)
- **Entity Reference:** Community/Location tags

#### View Modes
- **full:** Featured image, title, storyteller name + title, body, outcome, community tags
- **teaser:** Featured image, title, storyteller name, body excerpt (100 chars), read-more
- **card:** Featured image, title, storyteller name, body excerpt (50 chars)

#### Workflow & Moderation
- **Revision:** Enabled
- **Moderation:** None
- **Multilingual:** Content translation (EN/FR); storynamespan>
- **Note:** Consider privacy: community stories may contain sensitive information. Editors should anonymize or obtain consent before publishing.

#### Rationale
- **Why separate content type from Page?** Community stories are curated, dated, community-tagged content tied to editorial voice. Pages are static utilities.
- **Why Storyteller Name as separate field from Title?** Titles often read like "How Policy X Changed My Life." Separate name field lets editors use a good title while capturing the storyteller for byline.
- **Why Outcome as separate field?** Impact is key to editorial voice. Separate field encourages editors to highlight the change/benefit.
- **Why Communities taxonomy?** Supports filtering by audience segment (e.g., "Stories from Immigrant Communities"). Taxonomy is better than free-form tags for consistency.

---

### 4. Policy

**Machine name:** `policy`  
**Label:** Policy  
**Purpose:** Description of specific policies with threaded comments enabled for registered users to submit feedback

#### Fields

| Field | Type | Cardinality | Required | Widget | Notes |
|-------|------|-------------|----------|--------|-------|
| Title | text | 1 | Yes | textfield | Policy name (e.g., "Healthcare Reform Act 2025") |
| Policy Text | text_long | 1 | Yes | text_editor (CKEditor 5) | Summary/description of policy, rich formatting |
| Category | entity_reference (Taxonomy: Policy Categories) | ∞ | Yes | entity_autocomplete | Federal, State, Local, Proposed, etc. |
| Effective Date | date | 1 | No | date | When policy took/takes effect |
| Official Source URL | link | 1 | No | link | Link to official policy document or government page |
| Featured Image | media (image) | 1 | No | media_library | Hero/icon image for policy |
| Related Policies | entity_reference (Policy) | ∞ | No | entity_autocomplete | Links to related policies |

#### Taxonomy & Relationships
- **Taxonomy:** Policy Categories (Federal, State, Local, Proposed, Executive Order, Regulation, Legislation, Community Benefit Agreement, Other)
- **Entity Reference:** Related Policies
- **Comments:** Enabled, threaded, registered users only (see Permissions section)

#### View Modes
- **full:** Featured image, title, category tags, effective date, policy text, official source link, related policies, comments thread
- **teaser:** Category tag, title, policy text excerpt (150 chars), link to comment
- **card:** Title, category tag, date

#### Workflow & Moderation
- **Revision:** Enabled
- **Moderation:** None
- **Comments:** Enabled (module: core Comment)
  - Comment form visibility: Registered users only
  - Threading: Enabled
  - Default state: Closed (editor opens per post if desired)
- **Multilingual:** Content translation (EN/FR)

#### Rationale
- **Why separate from Research Post?** Policies are objects for community feedback and dialogue; Research Posts are analytical. Policy enables comments; Research Post does not.
- **Why Category as taxonomy, not free tags?** Governs the policy landscape (Federal vs. State vs. Proposed). Taxonomy ensures consistency and enables filtering.
- **Why comments on Policy but not other types?** Brief explicitly states "Policy — Policy description + threaded comments for registered users." Community voice is centered on policy response, not editorial content.
- **Why not use a module like "Disqus" or advanced comment threading?** Core Comments with threading enabled is sufficient and reduces dependencies. Can upgrade later.
- **Why Official Source URL separate from body?** Policies often link to external official documents; separate field improves UX and SEO.

---

## Taxonomies

### Research Areas
**Machine name:** `research_areas`  
**Vocabulary:** research_areas  
**Used by:** Research Post (field: Research Area)

**Suggested Terms:**
- Economic Policy
- Social Policy
- Education Policy
- Healthcare Policy
- Immigration Policy
- Housing Policy
- Criminal Justice
- Environmental Policy
- Labor & Workforce Policy
- Other

**Rationale:** Covers the policy landscape for the site. Enough specificity for editors to categorize; broad enough to accommodate future topics without constant expansion.

### Policy Categories
**Machine name:** `policy_categories`  
**Vocabulary:** policy_categories  
**Used by:** Policy (field: Category)

**Suggested Terms:**
- Federal
- State
- Local
- Proposed
- Executive Order
- Regulation
- Legislation
- Community Benefit Agreement
- Other

**Rationale:** Distinguishes the scope and type of policy. Helps community understand whether a policy is already law or under consideration.

### Communities
**Machine name:** `communities`  
**Vocabulary:** communities  
**Used by:** Community Story (field: Community/Location)

**Suggested Terms:**
- Immigrant Communities
- Youth
- Seniors
- Working Parents
- Small Business Owners
- Environmental Justice Communities
- LGBTQ+ Communities
- People with Disabilities
- Other

**Rationale:** Segments the stories by affected community. Enables editors and visitors to find stories relevant to their own experience or area of interest.

---

## View Modes Summary

| Content Type | full | teaser | card | search_result |
|---|---|---|---|---|
| Page | ✓ | ✓ | — | — |
| Research Post | ✓ | ✓ | ✓ | ✓ |
| Community Story | ✓ | ✓ | ✓ | — |
| Policy | ✓ | ✓ | ✓ | — |

**View Mode Recommendations:**
- **full:** Used in node/[id] pages and dedicated article layouts
- **teaser:** Used in node listings, homepage teasers, sidebar related content
- **card:** Used in grid/card layouts (homepage featured content, archive grids)
- **search_result:** Used only by search modules; highly truncated, optimized for result pages

---

## User Roles & Permissions Matrix

### Roles Overview

| Role | Description | Primary Use |
|---|---|---|
| Anonymous | Unauthenticated visitors | View published content, comment on policies (no, read-only for now) |
| Registered Community | Signed-up members | View all published content, comment on policies, manage own account |
| Editor | Editorial staff | Create, edit, delete, publish content; manage taxonomies |
| Admin | Site administrator | Full access (content, users, settings, modules) |

### Permissions Matrix

| Permission | Anonymous | Registered | Editor | Admin |
|---|:---:|:---:|:---:|:---:|
| **Content:** | | | | |
| View published Page | ✓ | ✓ | ✓ | ✓ |
| View published Research Post | ✓ | ✓ | ✓ | ✓ |
| View published Community Story | ✓ | ✓ | ✓ | ✓ |
| View published Policy | ✓ | ✓ | ✓ | ✓ |
| Create Page | — | — | ✓ | ✓ |
| Edit own Page | — | — | ✓ | ✓ |
| Edit any Page | — | — | ✓ | ✓ |
| Delete any Page | — | — | ✓ | ✓ |
| Create Research Post | — | — | ✓ | ✓ |
| Edit any Research Post | — | — | ✓ | ✓ |
| Delete any Research Post | — | — | ✓ | ✓ |
| Create Community Story | — | — | ✓ | ✓ |
| Edit any Community Story | — | — | ✓ | ✓ |
| Delete any Community Story | — | — | ✓ | ✓ |
| Create Policy | — | — | ✓ | ✓ |
| Edit any Policy | — | — | ✓ | ✓ |
| Delete any Policy | — | — | ✓ | ✓ |
| **Comments:** | | | | |
| View comments | ✓ | ✓ | ✓ | ✓ |
| Post comment on Policy (requires email verification) | — | ✓ | ✓ | ✓ |
| Edit own comment | — | ✓ | ✓ | ✓ |
| Delete own comment | — | ✓ | ✓ | ✓ |
| Moderate comments (hide, delete) | — | — | ✓ | ✓ |
| **Taxonomy:** | | | | |
| View taxonomy | ✓ | ✓ | ✓ | ✓ |
| Create/edit terms (Research Areas, Policy Categories, Communities) | — | — | ✓ | ✓ |
| **User Management:** | | | | |
| View user profiles (limited, public info only) | — | ✓ | ✓ | ✓ |
| Edit own user profile | — | ✓ | ✓ | ✓ |
| Edit/delete any user | — | — | — | ✓ |
| Manage roles | — | — | — | ✓ |
| **Site Configuration:** | | | | |
| Access admin interface | — | — | — | ✓ |
| Manage modules | — | — | — | ✓ |
| Manage settings | — | — | — | ✓ |

### Notes on Permissions
- **Anonymous users:** Can view all published content; cannot create or comment (registration required for comments).
- **Registered Community:** Can comment on policies only (one per policy unless threaded). Can view all content. Cannot create editorial content.
- **Editor:** Full editorial control over all content types, taxonomies, and comments. No access to user management or site settings.
- **Admin:** Unrestricted access.

**Comment Moderation Strategy:**
- Registered users' first comment on a Policy requires email verification (anti-spam).
- Editors can hide or delete comments (spam, off-topic, abuse).
- Comments are visible immediately after posting (no moderation workflow required, per brief).

---

## Suggested Additions (Not in Brief)

The brief specifies four content types. These additions are recommended for editorial completeness and community engagement:

### 1. FAQ (Frequently Asked Questions)

**Machine name:** `faq`

**Purpose:** Address common questions about policies, resources, and how to engage. Complements Policy type by preemptively answering user questions.

**Fields:**
- Question (text)
- Answer (text_long with rich editor)
- Category (taxonomy: same as Policy Categories or simpler)
- Related Policy (entity_reference to Policy)

**View Modes:** full, card (Q collapsed, expandable)

**Rationale:**
- Community engagement hub needs a FAQ to reduce support burden.
- Easy for editors to maintain; improves SEO (question/answer schema).
- Light lift: ~3–5 hours implementation.

**Cost:** Low (simple fields, optional)

**Recommendation:** **Include at launch** (addresses community support questions).

---

### 2. Event

**Machine name:** `event`

**Purpose:** Promote community forums, webinars, town halls, research launches.

**Fields:**
- Title (text)
- Description (text_long)
- Date/Time (daterange)
- Location (text or geolocation)
- Registration URL (link)
- Featured Image (media)

**View Modes:** full, teaser, calendar (future: Google Calendar embed)

**Rationale:**
- Brief mentions "community engagement: surveys, perspectives, community voices" — events drive this.
- Light traffic initially, but events are key touchpoints for immigrant and community audiences.

**Cost:** Medium (daterange handling, calendar views, ~5–8 hours).

**Recommendation:** **Defer to Phase 2** (not in brief, can test demand first).

---

### 3. Team Member / Staff

**Machine name:** `team_member`

**Purpose:** Publish bios of researchers, analysts, and community leaders. Builds credibility; enables linking from Research Posts and Community Stories.

**Fields:**
- Name (text)
- Title/Role (text)
- Bio (text_long)
- Photo (media)
- Research Areas (taxonomy_reference: Research Areas)
- Email/Contact (email)
- Social Links (link field, multiple)

**View Modes:** full, card (sidebar profile)

**Rationale:**
- Research Posts and Community Stories benefit from author bios (credibility, expert voice).
- Can be referenced from Research Post author field.

**Cost:** Low (~3 hours).

**Recommendation:** **Include at launch** (supports author bylines; improves trust).

---

### 4. Landing Page

**Machine name:** `landing_page`

**Purpose:** Conversion-focused pages for service sales funnel (separate from general Pages).

**Fields:**
- Title (text)
- Headline (text)
- Subheading (text)
- Body (text_long)
- Call-to-Action Button (link + text)
- Featured Image (media)
- Conversion Meta (URL slug for tracking, email list ID if using newsletter service)

**View Modes:** full (no teaser needed)

**Rationale:**
- Brief lists "Service sales funnel: direct clients to research, consulting, policy analysis services."
- Separate from Page to allow custom layouts and CTA buttons without cluttering editorial pages.

**Cost:** Medium (~4–6 hours, possibly Custom CTA button styling).

**Recommendation:** **Defer to Phase 2** (can launch with Pages; upgrade when sales funnel strategy is clearer).

---

## Trade-offs & Alternatives Considered

### Alternative 1: Combine Research Post and Community Story

**Considered:** Single "Article" type with role-based fields (author vs. storyteller).

**Why rejected:** Conflates two distinct editorial voices. Research Posts are analytical (author attribution, peer review mindset); Community Stories are narrative (storyteller, outcome focus). Editors benefit from distinct types.

**Trade-off:** More content types = more training; less data reuse. But editorial clarity is worth it.

---

### Alternative 2: Use Paragraphs for Flexible Layouts

**Considered:** Add Paragraphs module; allow editors to compose pages from reusable components (hero, text + image, two-column, etc.).

**Why rejected:** Single editor; fixed fields reduce complexity. Can add Paragraphs later if editor requests flexible layouts.

**Trade-off:** Simpler initial builds vs. layout flexibility. Recommendation: Start fixed; upgrade when demand warrants.

---

### Alternative 3: Comments on All Types

**Considered:** Enable comments on Page, Research Post, and Community Story (not just Policy).

**Why rejected:** Brief explicitly states "Policy — Policy description + threaded comments for registered users." Concentrating feedback on Policy allows focused dialogue. Other types are editorial monologues.

**Trade-off:** Less community dialogue on research/stories vs. focused feedback on policy. Keep to brief intent.

---

### Alternative 4: Use Tags (Free Taxonomy) Instead of Controlled Vocabularies

**Considered:** Allow editors to create Research Areas and Policy Categories on the fly (free tagging).

**Why rejected:** Tags become inconsistent quickly (e.g., "healthcare" vs. "health" vs. "healthcare-policy"). Controlled vocabularies (site-managed terms) ensure consistency and enable reliable faceting/filtering.

**Trade-off:** Slightly more editorial overhead (must choose from list, not type freely) vs. clean data and better UX. Recommendation: Controlled vocabulary.

---

### Alternative 5: Single "News/Content" Type with Multiple Subtypes

**Considered:** One content type with a "type" field (Page, Research, Story, Policy) to avoid type proliferation.

**Why rejected:** Drupal's content type system is built for discrete types. Using a single type with a field creates complexity in display logic, permissions (can't restrict "edit any Research Post"), and workflow. Better to use Drupal's type system.

**Trade-off:** Four types are more maintainable than one type with a type field.

---

## Implementation Notes

### Modules Needed (Beyond Core)

- **core:** Page, Node, Comment, Taxonomy, User, Views, Field (included)
- **contrib (if not already installed):**
  - `link` (core field type; may need contrib `link` module for validation)
  - `media` (core; required for Featured Image fields)
  - `entity_reference_revisions` (likely already in Drupal 11; for author links)
  - `ckeditor5` (core WYSIWYG; included in Drupal 11)

**No additional modules needed for initial launch** (Comments, Taxonomies, and basic fields are core).

**Future modules (Phase 2):**
- `calendar` (for Event view modes)
- `geofield` (if location-based queries needed)
- `diff` (revision comparison UI; helpful for editors)

---

### Multilingual Strategy

- **Translation module:** core `content_translation`
- **Approach:** Content translation (editors translate in Drupal UI) + interface translation (menus, labels via `.po` files)
- **Workflow:** Editor creates EN content; translates to FR manually in Drupal. For large volumes, can use contrib `tmgmt` (Translation Management) to queue translations.

---

### SEO & Schema Markup

- **Module:** core `seo` features + contrib `simple_sitemap` (optional; core Sitemap works)
- **Fields:** Meta Description (on Page, Research Post) and Schema.org markup (handled by theme)
- **Breadcrumbs:** core; theme renders per view mode

---

### Search Indexing

- **Module:** core `search` or contrib `search_api` + `facets` (for advanced filtering)
- **Recommendation:** Start with core Search; upgrade to Search API + Facets if faceted navigation is needed (not in brief, but likely later).

---

## Roles & Permissions: Implementation Notes

- **Drupal role system:** Roles are coarse-grained (Editor, Admin, Registered). Can create custom roles as needed.
- **Content access control:** Use core Node Access or contrib `node_access_by_role` (simple).
- **Recommendation:** Start with core roles + node access via Drupal's built-in permission UI. No special module needed for this launch.

---

## Revision & History

All content types have Revision tracking enabled by default. This allows:
- Editors to revert changes if needed (no moderation step).
- Audit trail for compliance.

**Workflow states:** None initially (no approval). If client requests approval workflow later, migrate to `workflows` + `content_moderation` (core modules in Drupal 11).

---

## Next Steps

1. **User Review:** Does this proposal align with your vision? Any additions, removals, or modifications?
2. **Approval:** Once approved, a Drupal recipe will be created in `recipes/content-types/` to deploy the structure.
3. **Theme Coordination:** Theme agent will be notified of content types and view modes (handoff: `handoffs/content-types-accepted.md`).
4. **Sample Content:** Test content will be created to preview pages and validate view modes.

---

## Appendix: Field Reference

### Field Type Decisions

| Field Type | Use Case | Example |
|---|---|---|
| **text** | Single-line input | Title, Author name, Storyteller Name |
| **text_long** | Rich text (multi-line) | Body, Summary, Outcome |
| **datetime** | Date + time | Publish Date, Event start/end |
| **date** | Date only | Effective Date |
| **link** | URL + link text | Download Link, Official Source URL, CTA Button |
| **media** | Image, document, video | Featured Image (reusable, alt-text managed centrally) |
| **entity_reference** | Link to node or user | Author (User), Related Posts (Research Post), Community (Taxonomy) |
| **taxonomy_term_reference** | Link to vocabulary | Research Area, Policy Category, Community |

### Widget Decisions

| Widget | Use Case |
|---|---|
| **textfield** | Plain text input (title, name, link label) |
| **text_editor (CKEditor 5)** | Rich text (body, summary, outcome) |
| **entity_autocomplete** | Link to user or content (author, related posts) |
| **media_library** | Image/document selection with alt-text |
| **date** / **datetime** | Date/time picker |
| **link** | URL + link text input |

---

## Summary of Decisions

| Decision | Rationale | Impact |
|---|---|---|
| Four content types (Page, Research Post, Community Story, Policy) | Align with brief; distinct editorial voices | Requires editor training; clear permissions per type |
| Comments only on Policy | Brief specifies; concentrates community feedback | Research and Stories are editorial monologue |
| Controlled vocabularies (no free tags) | Ensure data quality; enable reliable filtering | Slight editor friction vs. clean faceted navigation |
| Entity_reference for Author (not text) | Enables author archive pages; links to user profile | Requires user creation; author name changes break links (acceptable risk) |
| Featured Image as media entity (not file field) | Centralized alt-text management; reusable across content | Slight overhead in media library management |
| No custom modules for launch | Reduce dependencies; use core + standard contrib | Some features deferred (advanced calendar, advanced search) |

---

**Status:** Ready for user review and approval.

**Approval Path:** 
- [ ] User accepts proposal
- [ ] Orchestrator confirms
- [ ] Content Type Agent proceeds to Phase 2 (recipes/config creation)
