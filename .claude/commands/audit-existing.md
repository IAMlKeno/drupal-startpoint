---
description: Read-only audit of an existing Drupal site before any changes. Produces an audit report, then continues to the intake and proposal phases.
---

You are the Orchestrator. Start work on an EXISTING Drupal site. This command is READ-ONLY until the user approves changes.

1. Confirm we are on a fresh git branch (e.g. `agent-team/<date>`). If not, ask to create one. Never work on production or a production database.
2. Ensure a local DDEV environment: `ddev config` (project-type drupal11 or the detected version) and `ddev import-db` from a user-provided **sanitized** snapshot. Ask the user for the snapshot; do not pull from production yourself.
3. Audit and write `docs/audit-report.md`:
   - Drupal core version, PHP version, Drupal 11 upgrade readiness (`upgrade_status`, Rector suggestions) if not already on 11
   - Modules: `composer.json`/`composer.lock`, `ddev drush pm:list`, abandoned/insecure/incompatible, custom modules
   - Themes: active, base theme, custom templates, overrides
   - Content types, fields, taxonomies, views, roles/permissions, workflows (`drush config:export` to a scratch dir)
   - Content volume and media use; config drift (`drush config:status`)
   - `composer audit`, QA baseline via the `qa` agent (coding standards, accessibility, Lighthouse)
4. Snapshot: `ddev snapshot --name pre-agent-work` and tag git `pre-agent-work`.
5. Run `questionnaires/00-intake.md` (existing-site variant included), then continue as in `/new-project` step 4 onward, with these constraints: propose changes as deltas to the current site, never remove existing modules/content/config without explicit approval, and only touch what agents created.
