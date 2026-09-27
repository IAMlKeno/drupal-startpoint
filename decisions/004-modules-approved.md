# Decision 004: Contributed Modules Approved

**Date:** 2026-09-27  
**Decision:** Accept module proposal — 13 contrib modules + core  
**Status:** ✅ Approved and Ready for Phase 2 Installation

## What Was Approved

### Module Installation List (Phase 1)

**Authentication & Social Login:**
```
drupal/social_auth ^4.1
drupal/social_auth_google ^4.0
drupal/social_auth_apple ^2.0
```
- Why: Third-party OAuth (Google & Apple) as requested in brief

**Comments:**
- Core Comment module (no contrib needed)
- Threaded comments on Policy posts only
- Registered users can comment, Editor can moderate

**Newsletter:**
```
drupal/simplenews ^4.1
```
- Why: On-site newsletter (no SaaS dependency)
- Sufficient for Phase 1 light traffic
- Migration path to Mailchimp exists if needed later

**Payment:**
```
drupal/commerce ^3.3
drupal/commerce_stripe ^2.2
```
- Why: Industry-standard e-commerce solution
- Handles carts, orders, invoices, future subscriptions
- Stripe integration first-class and actively maintained

**Multilingual:**
- Core Language module
- Core Content Translation module
- No contrib needed; native Drupal 11 support

**Analytics:**
```
drupal/google_tag ^2.0
```
- Why: GA4 integration (google_analytics is deprecated)
- Actively maintained by Acquia/Google
- Handles both Google Analytics 4 and Google Tag Manager

**SEO Stack:**
```
drupal/metatag ^2.2
drupal/simple_sitemap ^4.2
drupal/schema_metatag ^3.0
drupal/pathauto ^1.15
drupal/redirect ^1.13
```
- Why: Industry-standard SEO best practices
- Covers meta tags, sitemaps, structured data, clean URLs, redirects

**Total: 13 contrib modules + 5 core modules = ~18 modules active**

## Verification & Security

✅ **All Drupal 11 Compatible**
- Verified via `composer require --dry-run`
- No version conflicts detected
- Dependencies auto-resolved by Composer

✅ **Security Coverage**
- All modules covered by Drupal Security Team advisory system
- Recommended: Apply security updates within 48 hours of release

✅ **No Conflicts**
- Tested pairwise compatibility
- Commerce dependencies (commerce_order, commerce_payment, etc.) auto-installed

## Alternatives Considered & Rationale

| Feature | Recommendation | Alternative | Rationale |
|---------|---|---|---|
| OAuth | social_auth + google + apple | openid_connect | social_auth D11-compatible; openid_connect only D10 |
| Newsletter | simplenews | mailchimp | simplenews on-site, no SaaS; mailchimp more powerful but Phase 2 upgrade available |
| Payment | commerce + stripe | lightweight modules | no maintained lightweight D11 option; commerce industry-standard |
| Analytics | google_tag | google_analytics | google_tag actively maintained; google_analytics deprecated |
| SEO | 5-module stack | metatag only | full stack = best practice; each module handles distinct SEO need |

## Phase 2 Installation Plan

**Single composer command:**
```bash
ddev composer require \
  drupal/social_auth:^4.1 \
  drupal/social_auth_google:^4.0 \
  drupal/social_auth_apple:^2.0 \
  drupal/simplenews:^4.1 \
  drupal/commerce:^3.3 \
  drupal/commerce_stripe:^2.2 \
  drupal/google_tag:^2.0 \
  drupal/metatag:^2.2 \
  drupal/simple_sitemap:^4.2 \
  drupal/schema_metatag:^3.0 \
  drupal/pathauto:^1.15 \
  drupal/redirect:^1.13
```

**Then enable modules:**
```bash
ddev drush en social_auth social_auth_google social_auth_apple \
  simplenews commerce commerce_payment commerce_stripe \
  google_tag metatag simple_sitemap schema_metatag pathauto redirect -y
```

**Then configure:**
- OAuth credentials (Google Cloud Console, Apple Developer account)
- Stripe API keys
- GA4 measurement ID / GTM container ID
- SEO meta tags (per content type)
- Newsletter defaults

## Optional (Phase 2/Future)

⏸️ **admin_toolbar** — Quality-of-life improvement for admin UI  
⏸️ **honeypot** — Spam protection (if needed post-launch)  
⏸️ **webform** — Advanced forms (if Google Forms embed needed)  
⏸️ **password_policy** — Security enhancement (if required)

## Configuration Approach

- **UI-based:** Most modules configurable via Drupal admin interface
- **Config YAML:** Export after UI setup for version control
- **Recipes:** Bundle module configs into Drupal recipes for reusability
- **Secrets:** Store API keys in environment variables (not in codebase)

## Next Steps

1. 🚀 Phase 2: Run composer require for all modules
2. 🔧 Enable modules via drush
3. ⚙️ Configure each module (OAuth, Stripe, GA4, SEO)
4. 🧪 Test workflows (login, payment, newsletter, analytics)
5. ✅ QA & sign-off before launch

---

**Approved by:** Elkeno Jones  
**Approved on:** 2026-09-27
