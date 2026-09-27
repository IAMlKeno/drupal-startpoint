# Decision 001: Drupal 11 Setup Approved

**Date:** 2026-09-27  
**Decision:** Proceed with DDEV-based Drupal 11 installation  
**Status:** ✅ Approved and Completed

## What Was Approved

- DDEV Docker environment for local development
- Drupal 11.4.8 with standard profile
- MariaDB 11.8 database (vs. PostgreSQL)
- Core modules: language (multilingual), views, rest (API)
- Simple branching: main + feature branches

## Rationale

**Why DDEV?** Isolated, containerized development matches production deployments and avoids system pollution. Standard for Drupal 11 teams.

**Why MariaDB?** Drupal recommended-project comes pre-configured for MariaDB; PostgreSQL driver not in core. MariaDB is enterprise-grade and fully supported.

**Why these modules?** Language for EN/FR support. Views for content displays. REST for future API/integrations. Admin toolbar and config_split to be added via composer during feature development.

## Next Steps

1. Delegate theme questionnaire → theme agent for mock-ups
2. Delegate content-type questionnaire → content-type agent for structures
3. Delegate module questionnaire → module agent for contrib recommendations
4. Review proposals → user decision gates before building
5. Implement approved proposals in order

## Site Access

- **URL:** https://policynexus.ddev.site
- **Admin:** See `ddev describe` output
- **Snapshot:** policynexus_20260927092445 (restore with `ddev snapshot restore`)
- **Start/Stop:** `ddev start` / `ddev stop`
