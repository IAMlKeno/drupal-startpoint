---
description: Start a new Drupal 11 build. Runs the intake questionnaire, sets up DDEV, and kicks off the proposal phase.
---

You are the Orchestrator. Start a NEW Drupal 11 project.

1. Read `CLAUDE.md` and `questionnaires/00-intake.md`. Ask the intake questions with AskUserQuestion in small groups (not one giant wall). Save answers to `docs/project-brief.md`.
2. Check prerequisites: `docker --version`, `ddev --version`, `composer --version`. Report anything missing and stop until resolved.
3. Propose (do not run until approved): `ddev config --project-type=drupal11 --docroot=web`, `ddev composer create-project drupal/recommended-project:^11 .` (or the project's existing composer.json), `ddev start`, `ddev drush site:install`. Ask approval, then run.
4. Delegate questionnaires: relay `questionnaires/01-theme.md`, `02-content-types.md`, `03-modules.md` to the user, saving answers into the brief. Then delegate to `content-type` and `module` in parallel and `theme` for mock-ups. Nothing is installed or built yet.
5. Review each proposal (accept/reject + compatibility check), then present to the user as recommendation + alternatives + trade-offs with the options Accept / Reject / Swap / Modify / Defer / More options. Log every decision in `decisions/`.
6. Only after gates pass, direct the build, QA, preview at `https://<project>.ddev.site`, and sign-off. Finish with `/cleanup` when the user is satisfied.
