# Implementation Progress

This file is append-only. Every material implementation milestone must add a dated entry so a new agent can recover the branch state without relying on chat history.

## Entry Template

```markdown
## YYYY-MM-DD - Milestone
- Branch/commit:
- Completed behavior:
- Schema changes:
- Important files:
- Verification:
- Blockers:
- Next step:
```

## 2026-07-13 - Baseline and workflow foundation

- Branch/commit: `rapid-mvp` at `9989246` before local implementation changes.
- Completed behavior: Confirmed the existing branch contained contributor/public flows only; added the integrated moderation state model, multiple role support, role filter, review assignments, stage decisions, notifications, publication gating, and archive restoration services.
- Schema changes: Added `archived_from_status`, migrated legacy pending/revision values, added a unique user-role pair, and created `reviews` and `notifications` tables.
- Important files: `app/Services/ModerationWorkflow.php`, workflow migrations, models, filters, routes, and authentication session handling.
- Verification: Static repository inspection and PHP 8.0 syntax checks on the workflow and new controllers; PHP 8.2 runtime verification remains required.
- Blockers: Local XAMPP PHP is 8.0.30 while the application requires PHP 8.2 or newer.
- Next step: Complete role-specific portal interfaces and contributor workflow feedback.

## 2026-07-13 - Portal and moderation interfaces

- Branch/commit: `rapid-mvp`, local uncommitted implementation.
- Completed behavior: Added the administrator overview, dataset assignment/publication/lifecycle controls, user-role administration, audit-log viewer, ethics and technical queues, protected review download, manual checklists, review history, contributor status notifications, and active-review edit locking.
- Schema changes: No additional schema beyond the workflow foundation.
- Important files: `app/Controllers/Admin.php`, `app/Controllers/Reviews.php`, `app/Views/layouts/portal.php`, admin/review views, contributor dashboard, and portal CSS.
- Verification: New PHP controllers and service passed available syntax checks; route, migration, test, and browser verification are pending.
- Blockers: Full CodeIgniter execution cannot be claimed under PHP 8.0.30.
- Next step: Update tests, remove obsolete scope language, run complete static verification, and document residual runtime gaps.

## 2026-07-13 - Static verification and handoff

- Branch/commit: `rapid-mvp`, local uncommitted implementation.
- Completed behavior: Reconciled public and portal navigation, added seeded walkthrough accounts, updated contributor upload/status language, tightened invalid-stage and archive guards, restricted reassigned review access, and replaced obsolete split-portal documentation.
- Schema changes: Confirmed the additive migration order and updated fresh-install dataset defaults to `pending_ethics_review`.
- Important files: `README.md`, `SETUP.md`, `docs/CONTEXT.md`, `docs/DESIGN.md`, `docs/SKILL.md`, workflow tests, and the complete moderation implementation listed above.
- Verification: All 31 changed or new PHP files pass `php -l`; `git diff --check` passes; active docs and views contain no separate-Admin-Portal prohibition. Spark routes and PHPUnit were attempted but cannot run under PHP 8.0.30.
- Blockers: A PHP 8.2+ runtime and migrated MySQL test database are required for route, migration, feature, and browser walkthrough verification.
- Next step: Run `php spark migrate`, `php spark db:seed MvpSeeder`, `php spark routes`, and `composer test` under PHP 8.2+, then execute the role-by-role walkthrough in `SETUP.md`.
