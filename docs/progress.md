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

## 2026-07-14 - Marc task pass

- Branch/commit: `rapid-mvp`, local uncommitted implementation.
- Completed behavior: Implemented Marc's refactored tracker items by polishing dataset preview metadata, access context, focus return, keyboard trapping, and mobile-safe preview layout; expanded demo seed data across published access labels and moderation lifecycle states; added a conditional deployment readiness checklist.
- Schema changes: None.
- Important files: `app/Views/datasets/index.php`, `public/assets/css/app.css`, `app/Database/Seeds/MvpSeeder.php`, `SETUP.md`, `docs/DEPLOYMENT_READINESS.md`, and `docs/refactored-audit-task-tracker.csv`.
- Verification: `C:\xampp\php\php.exe -l` passes for touched PHP files; `git diff --check` passes with only Windows line-ending warnings; local WinGet PHP 8.5.7 runs `php spark routes`; PHPUnit passes with 10 tests and 22 assertions.
- Blockers: Database write verification for `php spark db:seed MvpSeeder` was not run in this pass to avoid mutating the local database without a dedicated seed check.
- Next step: Run `php spark migrate:status` and `php spark db:seed MvpSeeder` against the intended local/staging database, then browser-check the dataset preview modal on desktop and mobile.

## 2026-07-14 - Portal flow separation

- Branch/commit: `rapid-mvp`, local work after `71c04e3`.
- Completed behavior: Separated the governance portal from the public website by replacing ambiguous contributor/public catalog links with portal-native contributor records, portal dataset inspection, administrator metadata inspection, and explicit `Return to website` exits.
- Schema changes: None.
- Important files: `app/Config/Routes.php`, `app/Controllers/Dashboard.php`, `app/Controllers/Admin.php`, `app/Views/layouts/portal.php`, `app/Views/dashboard/portal.php`, `app/Views/dashboard/portal_dataset.php`, `app/Views/admin/dataset.php`, `app/Views/admin/datasets.php`, and `public/assets/css/app.css`.
- Verification: PHP 8.5 syntax checks passed for updated routes, controllers, portal layout, and new portal/admin views; `php spark routes` shows the new portal/dashboard, portal/datasets, portal notifications, and admin dataset inspection routes; PHPUnit passes with 10 tests and 22 assertions.
- Blockers: Browser-level confirmation of the portal navigation distinction is still needed.
- Next step: Start the app under PHP 8.5+ and click through admin, ethics, technical, and portal contributor records to confirm only explicit website-exit actions leave the portal shell.

## 2026-07-14 - Sleeker shared UI scale

- Branch/commit: `rapid-mvp`, local work after `71c04e3`.
- Completed behavior: Tightened the shared visual scale across public and portal shells: smaller base type, slimmer buttons, reduced hero/card/form/modal spacing, denser portal sidebar/table layouts, Material Symbols icon font loading, icon-led public account menu, portal account tab, and clearer icon treatment for review/admin navigation and website exits.
- Schema changes: None.
- Important files: `app/Views/layouts/main.php`, `app/Views/layouts/portal.php`, and `public/assets/css/app.css`.
- Verification: PHP 8.5 syntax checks passed for updated public and portal layouts; `php spark routes` passes; PHPUnit passes with 10 tests and 22 assertions; `git diff --check` passes with only Windows line-ending warnings; local PHP server returns `200` at `http://127.0.0.1:8082/`.
- Blockers: Manual visual QA is still needed across public home/catalog and portal/admin screens to approve the final density.
- Next step: Inspect `http://127.0.0.1:8082/`, login with seeded accounts, and confirm the account icon menu, portal account tab, and smaller shared scale feel right before staging.

## 2026-07-14 - Dashboard links under profile

- Branch/commit: `rapid-mvp`, local work after `71c04e3`.
- Completed behavior: Moved contributor, reviewer, and administrator dashboard entry points out of the public main navigation and into the profile/account tab so normal users and reviewers share the same general website header. Added matching role shortcuts to the portal account tab and compact mobile account panel.
- Schema changes: None.
- Important files: `app/Views/layouts/main.php`, `app/Views/layouts/portal.php`, and `public/assets/css/app.css`.
- Verification: PHP 8.5 syntax checks passed for updated public and portal layouts; `php spark routes` passes; PHPUnit passes with 10 tests and 22 assertions; `git diff --check` passes with only Windows line-ending warnings.
- Blockers: Manual visual QA should confirm the account dropdown remains readable for multi-role users.
- Next step: Login as contributor, reviewer, and administrator, then confirm all dashboard/workspace links are reachable from the profile tab without cluttering the main nav.
