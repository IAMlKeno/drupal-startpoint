# Handoff file templates

Agents cannot message each other. They exchange work through these files, brokered by the Orchestrator.

## `<agent>-assignment.md` (Orchestrator -> agent)
- Scope
- Relevant brief sections / questionnaire answers
- Constraints and accepted decisions so far
- Expected output files

## `<agent>-proposal.md` (agent -> Orchestrator)
For each item: recommendation, alternatives considered, trade-offs, reasoning, dependencies on other agents.

## `<agent>-delivery.md` (agent -> Orchestrator)
What was built, files changed, how to apply/preview, known gaps, test results.

## `needs-<target>.md` (agent -> Orchestrator, to forward)
- From:
- Needed by:
- What is needed and why:
- Blocking? yes/no

## Standard files
- `content-types-accepted.md` (content-type -> theme): accepted types, view modes, fields to render
- `templates-delivered.md` (theme -> content-type): template coverage per type
- `module-proposal.md` / `module-delivery.md`
- `qa-report.md`, `qa-cleanup-verification.md`
