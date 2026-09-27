# Drupal Agent Team: shared rules

Applies to every agent in this repo. Drupal 11, DDEV, Composer.

## Conventions
- Drupal 11 only. PHP 8.3+. Verify module compatibility with `composer require --dry-run` and the module's project page before recommending.
- Prefer core over contrib. Prefer Drupal recipes and config over one-off code. Follow Drupal coding standards.
- All work happens inside the DDEV project: `ddev composer`, `ddev drush`, `ddev exec`.
- Theme: core Starterkit + Single Directory Components unless the brief says otherwise.
- Content types delivered as Drupal recipes under `recipes/` when practical; otherwise config YAML.
- Never commit secrets, DB dumps with real user data, or `settings.local.php`.

## Communication
- Subagents cannot talk to each other. Cross-agent needs go through files in `handoffs/`, brokered by the Orchestrator.
- Every proposal: **recommendation + alternatives considered + trade-offs**.
- The user can Accept, Reject, Swap, Modify, Defer, or ask for More options. Never treat a decision as yes/no only.
- Log every decision in `decisions/` (use `decisions/_template.md`).

## Safety
- Never touch production. No destructive action, `composer require`, or config import without user approval.
- Snapshot (`ddev snapshot`) and git tag before risky changes.
- Existing sites: only change what you created or the user approved.
