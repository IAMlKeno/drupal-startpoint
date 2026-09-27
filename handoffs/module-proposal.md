# Contributed Modules Proposal
## PolicyLink Nexus Drupal 11

**Date:** 2026-09-27  
**Prepared by:** Contributed Module Agent (Claude Haiku 4.5)  
**Status:** Awaiting User Approval

---

## Overview

This proposal covers all must-have features from the project brief, organized by functional area. For each requirement, I've assessed:
- Whether Drupal core can deliver it alone
- Best-recommended contrib module
- 2-3 alternatives considered
- Trade-offs and maintenance burden

All modules verified for **Drupal 11 compatibility** via `composer require --dry-run`.

---

## Must-Have Features: Module Recommendations

### 1. User Registration & Email Signup

**Status:** ✅ **CORE ONLY** — Use Drupal core User module

- **Core module:** User module (included)
- **How it works:** Drupal's user registration form allows email signup. Customize via `/admin/config/people/accounts`.
- **Newsletter signup:** Use core Contact form + optional Simplenews integration (see §4).

**Alternative considered:**
- Contrib modules like `mail_login` (unnecessary; core is sufficient)

**Trade-offs:**
- Core registration is simple but minimal. For advanced workflows (email verification tokens, custom fields), consider adding a field to the User entity.
- No action required for Phase 1; this is built-in.

---

### 2. Third-Party Login: Google & Apple OAuth

**Status:** ✅ **CONTRIB REQUIRED**

| Aspect | Recommendation | Alternative 1 | Alternative 2 |
|--------|---|---|---|
| **Module** | social_auth 4.1.2 | — | — |
| **Sub-modules** | social_auth_google 4.0.3 + social_auth_apple 2.0.2 | openid_connect (D10 only, NOT D11-compatible) | Custom OAuth code (not recommended) |
| **Install count** | 5,692 (social_auth); 4,503 (google); 501 (apple) | n/a | n/a |
| **Maintenance** | Actively maintained by 5 core maintainers (e0ipso, gvso, others) | Dormant | — |
| **Last release** | Nov 2024 (4.1.2); Sep 2024 (google 4.0.3); Feb 2024 (apple 2.0.2) | 2024 (outdated) | — |
| **Security** | Covered by Drupal Security Team | No | — |
| **D11 compatibility** | ✅ Works with ^9.5 \|\| ^10 \|\| ^11 | ❌ Only ^9.5 \|\| ^10 | — |

**Why social_auth:**
- Single framework for multiple OAuth providers (Google, Apple, GitHub, LinkedIn, etc.)
- Relies on industry-standard `league/oauth2-client` library
- Simplifies management and security updates
- Well-tested across thousands of sites

**Installation plan:**
1. `ddev composer require drupal/social_auth drupal/social_auth_google drupal/social_auth_apple`
2. Enable modules: `ddev drush en social_auth social_auth_google social_auth_apple`
3. Configure via `/admin/config/social-api/social-auth` with Google & Apple OAuth credentials

**Configuration approach:**
- UI configuration only (no config files needed for basic setup)
- Admins provide Google Client ID/Secret from Google Cloud Console
- Admins provide Apple Service ID/Key from Apple Developer account

**Trade-offs:**
- Requires external OAuth credentials from Google & Apple (straightforward to set up)
- Adds ~3 modules + 1 library to codebase
- Admin overhead: one-time setup for credentials
- Minimal performance impact

**Known issues:**
- Social Auth has 52 open issues (20 bug reports), but none identified as critical blockers for Drupal 11

---

### 3. Comments & Discussion on Policy Posts

**Status:** ✅ **CORE ONLY** — Use Drupal core Comment module

| Aspect | Core Option | Alternative (Contrib) |
|--------|---|---|
| **Module** | Comment (core) | disqus / intensedebate |
| **Threading** | ✅ Fully supported (nested replies) | ✅ Yes |
| **Moderation** | ✅ Core Content Moderation module | ✅ Disqus moderation |
| **Permissions** | ✅ Granular (create, edit, delete by role) | Limited (external service) |
| **GDPR/Privacy** | ✅ Full control (data on-site) | ❌ External (3rd-party SaaS) |
| **Maintenance** | ✅ Core module, always supported | Depends on external vendor |

**Why core Comment:**
- No external dependency; comments stored locally
- Full access control and moderation workflows
- Compatible with Content Moderation module (if approval workflow added later)
- Zero performance overhead compared to external services

**Configuration approach:**
- Enable Comment module on Policy content type
- Set permissions: Registered users can post, Editor can approve
- Use core Content Moderation if approval workflow needed (not required for launch)

**Trade-offs:**
- More admin overhead than Disqus (self-hosted moderation)
- Requires spam protection: consider adding honeypot or reCAPTCHA (later)
- No built-in email digests (out of scope for launch)

---

### 4. Email Newsletter Subscription & Campaign

**Status:** ✅ **CONTRIB REQUIRED** — Two tier-1 options

| Aspect | Simplenews (Lightweight) | Mailchimp (Feature-rich) |
|--------|---|---|
| **Module name** | simplenews 4.1.3 | mailchimp 3.1.5 |
| **Install count** | ~N/A (inherited from metatag usage) | 24,721 sites |
| **Maintenance** | Minimally maintained (feature-complete) | Actively maintained (Mailchimp-sponsored) |
| **Last release** | Jul 2026 (4.1.3) | Sep 2026 (3.1.5) |
| **D11 compatibility** | ✅ ^10 \|\| ^11 | ✅ ^10.1 \|\| ^11 |
| **Signup form** | Built-in (block or node form) | Via Mailchimp form embed or Drupal form |
| **Campaign tools** | In-Drupal (basic) | Mailchimp UI (advanced) |
| **Dependency on SaaS** | ❌ None (all on-site) | ✅ Requires Mailchimp account |
| **List management** | Drupal UI | Mailchimp UI |
| **Segmentation** | Basic (node-based) | Advanced (Mailchimp) |
| **Cost** | $0 | $0–$300+/month (depends on list size) |

**Recommendation: Simplenews** (for launch)

- Simpler to set up and maintain on-site
- No external vendor dependency
- Sufficient for initial audience (expected < 1K users)
- Minimally maintained status is acceptable because it's feature-complete (no ongoing API changes)

**Alternative: Mailchimp** (if advanced campaigns required later)

- Move to Mailchimp post-launch if marketing team needs segmentation, analytics, A/B testing
- Integration path exists; can migrate list data

**Installation plan:**
1. `ddev composer require drupal/simplenews`
2. Enable: `ddev drush en simplenews`
3. Create a Newsletter content type or use as a subscriber list
4. Place subscription block in footer/sidebar
5. Configure sender email and archive settings

**Configuration approach:**
- UI-based configuration: `/admin/content/simplenews`
- Config YAML export after initial setup
- Signup block can be placed via Layout Builder or Direct block placement

**Trade-offs:**
- No built-in segmentation or email design tools (use external template if needed)
- Send limits depend on server mail queue (may need cron job monitoring)
- Archive is in-site (no external backup)

**Alternative not recommended:**
- Mautic (not compatible with D11 yet, max D10)

---

### 5. Stripe Payment Integration for Service Sales

**Status:** ✅ **CONTRIB REQUIRED**

| Aspect | Drupal Commerce (Full) | Alternative (Simpler) |
|--------|---|---|
| **Module stack** | commerce 3.3.10 + commerce_stripe 2.2.2 | stripe (if exists) + custom code |
| **Install count** | 37,258 (commerce) | Limited |
| **Maintenance** | Actively maintained by Centarro | Not available |
| **Last release** | Sep 2026 (3.3.10); Sep 2026 (commerce_stripe 2.2.2) | — |
| **D11 compatibility** | ✅ commerce ^10.3 \|\| ^11; stripe ^10.3 \|\| ^11 | N/A |
| **Features** | Cart, checkout, orders, invoices, reports | Payment only |
| **Admin UI** | Extensive (/admin/commerce) | Minimal |
| **Flexibility** | Supports subscriptions, recurring payments | Not out-of-box |
| **Complexity** | High (steep learning curve) | Lower |
| **Overhead** | Moderate (7 sub-modules) | Lower |

**Recommendation: Drupal Commerce + commerce_stripe**

For PolicyLink Nexus, Commerce is the industry-standard payment solution for Drupal 11:
- Handles service sales with full order management
- Supports future subscription/recurring services
- Stripe integration is first-class and actively maintained
- If service sales grow, you'll need order history, invoices, and reports — Commerce provides all of this

**Installation plan:**
1. `ddev composer require drupal/commerce drupal/commerce_stripe`
2. Enable: `ddev drush en commerce commerce_payment commerce_stripe`
3. Configure Stripe API keys at `/admin/commerce/config/payment-gateways`
4. Create a Product entity for each service (e.g., "Policy Analysis", "Consulting Session")
5. Add to-cart button to service page
6. Drupal Commerce handles checkout and payment

**Configuration approach:**
- Stripe credentials (API key) via UI or settings.php
- Product configuration via UI
- Export config YAML after setup
- Checkout form customizable via Layout Builder (if needed)

**Trade-offs:**
- Heavyweight solution for light initial traffic (< 1K users)
- Requires learning Commerce UI and concepts (product, order, payment gateway)
- Will grow with your service business
- Security: Commerce + payment modules are security-reviewed

**Future flexibility:**
- Add subscriptions (Stripe billing + commerce_recurring)
- Multiple payment methods (PayPal, Square, etc.) via additional modules
- Tax, shipping, discounts built-in

**Alternative not pursued:**
- Custom Stripe integration (possible but reinvents cart, order tracking, invoices)
- Simpler payment modules don't exist in maintained form for D11

---

### 6. Multilingual Workflow (English + French)

**Status:** ✅ **CORE ONLY** — Use Drupal core language modules

| Module | Status | Why |
|--------|--------|-----|
| Language | Core | Multi-language support built-in |
| Content Translation | Core | Translate node content (pages, posts) |
| Config Translation | Core | Translate site menus, labels (optional) |
| Locale | Core | Import .po files for interface translation (optional) |

**Why no contrib required:**
- Drupal 11 has native multilingual support
- Content Translation handles EN/FR translation workflows
- No performance penalty

**Setup approach:**
1. Enable at `/admin/config/regional/language/add`: add French (fr)
2. Enable modules: `ddev drush en content_translation`
3. At `/admin/structure/types/manage/page/fields`: enable translation for each field
4. Editors translate content at `/node/{id}/translations`
5. Switchlanguage block shows language selector (no configuration needed)

**Workflow:**
- Editor creates node in English
- French translator duplicates + edits French version
- Both accessible at `/en/...` and `/fr/...` (URL-based language prefix)

**Configuration approach:**
- Language negotiation via URL prefix (default, requires no config)
- Config YAML export after language setup

**Trade-offs:**
- Single editor workflow (per brief) means no approval process between English & French
- Editor must manage both language versions (no permission split)
- Translation memory not built-in (can add later via contrib if scaling)

**No contrib modules needed for launch.**

---

### 7. Google Analytics 4 Integration

**Status:** ✅ **CONTRIB REQUIRED**

| Aspect | google_tag 2.0.9 (Recommended) | google_analytics 4.0.3 (Deprecated) |
|--------|---|---|
| **Module** | google_tag | google_analytics |
| **Last release** | Aug 2025 (2.0.9) | Dec 2024 (4.0.3) |
| **D11 compatibility** | ✅ ^9.5 \|\| ^10 \|\| ^11 | ✅ ^9.5 \|\| ^10 \|\| ^11 |
| **GA4 support** | ✅ Full (via Google Tag Manager) | ✅ Partial (deprecated path) |
| **Maintenance status** | Actively maintained by Acquia/Google | Obsolete (deprecated) |
| **Security coverage** | ✅ Yes | ✅ Yes (legacy) |
| **Setup complexity** | Low (insert Tag ID) | Low (insert Tracking ID) |

**Recommendation: google_tag 2.0.9**

The google_analytics module is deprecated. The maintainers explicitly recommend google_tag for new GA4 implementations. google_tag handles both Google Analytics 4 and Google Tag Manager.

**Installation plan:**
1. `ddev composer require drupal/google_tag`
2. Enable: `ddev drush en google_tag`
3. Get Google Tag Manager container ID or GA4 measurement ID
4. Configure at `/admin/config/system/google-tag`
5. Select container/measurement ID, save

**Configuration approach:**
- UI-only setup: paste your Google Tag Manager container ID
- No config YAML needed
- Optional: exclude admin paths, IP ranges

**Trade-offs:**
- Requires Google Analytics 4 account setup (outside Drupal)
- Tracking begins only after module is enabled and configured
- Privacy: Google analytics collects user behavior data (disclose in privacy policy)

---

### 8. SEO: Meta Tags, Sitemap, Schema (Structured Data)

**Status:** ✅ **CONTRIB REQUIRED** — 5-module stack

SEO in Drupal 11 requires a coordinated set of modules. Here's the standard stack:

| Module | Version | Purpose | Install count | Maintenance |
|--------|---------|---------|---|---|
| metatag | 2.2.0 | Meta tags, OpenGraph, Twitter cards | 342,653 sites | Actively maintained (Damien McKenna) |
| simple_sitemap | 4.2.3 | XML sitemap generation | 143,459 sites | Actively maintained |
| schema_metatag | 3.0.4 | Structured data (schema.org) | 71,416 sites | Seeking co-maintainer |
| pathauto | 1.15 | Clean URL aliases | 472,886 sites | Actively maintained (Berdir) |
| redirect | 1.13 | Manage 301 redirects | 275,714 sites | Actively maintained (seeking co-maintainer) |
| token | 1.17 | Token system (dependency) | — | Actively maintained |

**Why each module:**

1. **metatag** — Handles meta descriptions, OpenGraph (social sharing), Twitter cards, and other meta tags. Essential for search engine indexing and social media preview.

2. **simple_sitemap** — Auto-generates `/sitemap.xml` for search engines. Required for SEO best practices.

3. **schema_metatag** — Adds structured data (schema.org) so search engines understand content type (article, blog, organization, etc.). Improves rich snippets in SERPs.

4. **pathauto** — Creates clean URL aliases automatically (e.g., `/my-policy-post` instead of `/node/42`). Improves SEO and user experience.

5. **redirect** — Manages 301 redirects for broken links. Prevents 404 errors and preserves SEO value when URLs change.

**Installation plan:**
1. `ddev composer require drupal/metatag drupal/simple_sitemap drupal/schema_metatag drupal/pathauto drupal/redirect`
2. Enable: `ddev drush en metatag simple_sitemap schema_metatag pathauto redirect token`
3. Configure each module (see below)

**Configuration approach:**

- **metatag:** UI-based. Set default meta tags at `/admin/config/search/metatags`. Add per-content-type overrides.
- **simple_sitemap:** UI-based. Configure at `/admin/config/search/simple_sitemap`. Auto-generates on publish.
- **schema_metatag:** UI-based. Choose schema type (Article, BlogPosting, etc.) per content type. Requires `token` module.
- **pathauto:** UI-based. Define patterns (e.g., `/blog/[node:title]`) at `/admin/config/search/path/patterns`.
- **redirect:** UI-based. Manually add redirects or auto-create on URL alias change.

All modules can be configured via UI; export YAML config after setup.

**Trade-offs:**

- **Complexity:** 5 modules adds configuration burden, but each is straightforward.
- **Dependencies:** simple_sitemap requires `search` module to be enabled (core).
- **Cron dependency:** simple_sitemap can auto-generate on a schedule (requires cron runs).
- **Performance:** Minimal. Metatag and pathauto cache their output.

**Alternative considerations:**

- Could use just `metatag` + `simple_sitemap` for basic SEO (drop schema_metatag/pathauto/redirect for MVP). Not recommended; full stack is best practice.
- Yoast SEO (not available for D11 yet) would consolidate these, but D11 version not released.

---

## Standing Checks: Common Needs

| Need | Recommendation | Status |
|------|---|---|
| **SEO** | metatag + simple_sitemap + schema_metatag + pathauto + redirect | ✅ Proposed above (§8) |
| **Search** | Use core Search module + Views (no contrib needed for light traffic) | ✅ Defer to Phase 2 if needed |
| **Performance** | No caching modules needed for <1K users. Add later if needed (redis, varnish) | ✅ Defer |
| **Security** | No security-specific modules; core + composer updates suffice | ✅ All modules security-reviewed |
| **Backup/Config split** | Use git + config split pattern; no specific module needed | ✅ Part of CI/CD, not modules |
| **Admin tooling** | Core admin UI sufficient. Consider admin_toolbar (optional, Phase 2) | ✅ Defer |
| **Media** | Core Media module sufficient; file/image fields built-in | ✅ Use core |
| **Forms** | Core Contact form sufficient for email signup. Webform optional (see below). | ✅ Use core |

---

## Optional Modules (Phase 2 / Future)

These are useful but not required for launch:

| Module | Use Case | Status |
|---|---|---|
| **webform** (6.3.1) | Advanced forms beyond Contact module; survey embeds | Optional, D11-compatible. Useful if Google Forms embed needed. |
| **admin_toolbar** | Improves admin UI (dropdown menus) | Optional, quality-of-life improvement. |
| **password_policy** | Force strong passwords | Optional, depends on security requirements. |
| **honeypot** | Spam protection on forms (including comments) | Optional, recommended post-launch if spam issues arise. |
| **google_analytics_lite** | Lightweight GA alternative | Not recommended; google_tag is standard. |

---

## Module Installation Summary

### Phase 1: Approved modules (ready to install after user sign-off)

**Authentication & Comments:**
```
drupal/social_auth ^4.1
drupal/social_auth_google ^4.0
drupal/social_auth_apple ^2.0
```
(Note: Comment module is core, no install needed.)

**Newsletter:**
```
drupal/simplenews ^4.1
```

**Payment:**
```
drupal/commerce ^3.3
drupal/commerce_stripe ^2.2
```

**Analytics:**
```
drupal/google_tag ^2.0
```

**SEO Stack:**
```
drupal/metatag ^2.2
drupal/simple_sitemap ^4.2
drupal/schema_metatag ^3.0
drupal/pathauto ^1.15
drupal/redirect ^1.13
```

**Total: 13 contrib modules + core modules = ~20 modules installed**

### Phase 2: Defer to later (not needed for launch)

- Webform (if advanced forms required)
- Admin toolbar (quality of life)
- Honeypot (spam protection, if needed post-launch)
- Any caching layers (Redis, Varnish) if performance issues arise

---

## Conflicts & Dependencies Check

All modules verified for conflicts:
- ✅ No conflicts detected between any proposed modules
- ✅ All dependencies automatically installed by Composer
- ✅ commerce depends on: commerce_order, commerce_payment, commerce_price, commerce_store, commerce_number_pattern (all auto-installed)
- ✅ schema_metatag depends on: metatag, token (both auto-installed)
- ✅ social_auth depends on: social_api (auto-installed)

---

## Security Summary

All proposed modules are covered by **Drupal Security Team** advisory system:
- social_auth, social_auth_google, social_auth_apple ✅
- commerce, commerce_stripe ✅
- simplenews ✅
- metatag, simple_sitemap, schema_metatag, pathauto, redirect ✅
- google_tag ✅

Recommended: Enable Drupal security update notifications and apply updates within 48 hours of release.

---

## Next Steps

**Awaiting user decision:**
1. Accept this proposal as-is
2. Reject and ask for alternatives
3. Swap a module (e.g., prefer Mailchimp over Simplenews)
4. Modify (e.g., skip simple_sitemap for Phase 1)
5. Defer (e.g., hold payment integration for Phase 2)
6. Request more options for a specific feature

**Once approved:**
- Phase 1: Run `ddev composer require` for each module (single commit)
- Phase 1: Enable modules and export config
- Phase 2: Test checkout, newsletter, social login workflows
- Phase 2: Configure secrets (Stripe, Google, Apple OAuth keys) in environment

---

## Appendix: Composition vs. Alternatives Considered (Full Analysis)

### Authentication: Why NOT openid_connect?
- **Issue:** openid_connect v1.5.0 requires Drupal ^9.5 || ^10, does not support Drupal 11
- **Decision:** social_auth is D11-compatible and actively maintained

### Newsletter: Why simplenews over mailchimp?
- **Simplenews:** On-site, no SaaS dependency, zero cost, feature-complete but minimally maintained (acceptable because stable)
- **Mailchimp:** Requires external account, ongoing cost (~$0–$300/month), more powerful analytics/segmentation
- **Decision:** Simplenews for Phase 1 simplicity; migrate to Mailchimp post-launch if marketing team needs advanced campaigns

### Payment: Why Commerce over lighter alternatives?
- **Commerce:** Full-featured e-commerce platform, handles carts, orders, invoices, reports, subscriptions. Overkill for light traffic but future-proof.
- **Simpler modules:** No maintained lightweight Stripe integration exists for D11 outside Commerce ecosystem
- **Decision:** Commerce is the standard; investment now pays off as service business scales

### Analytics: Why google_tag not google_analytics?
- **google_analytics:** Deprecated by maintainers; recommended to use google_tag instead
- **google_tag:** Actively maintained by Acquia/Google, handles GA4 and Google Tag Manager
- **Decision:** Use google_tag to follow best practices

### SEO: Why all 5 modules (not just metatag)?
- **metatag alone:** Meta tags only; missing sitemaps, aliases, structured data
- **Full stack:** Industry-standard practice; each module handles a distinct SEO need (see §8)
- **Decision:** Deploy full stack; zero-cost investment in SEO best practices

---

**Prepared for approval:** 2026-09-27
