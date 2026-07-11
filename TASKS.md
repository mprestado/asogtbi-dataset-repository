# Rapid MVP Independent Task Tracker

This tracker replaces the older 90-task plan for the `rapid-mvp` branch. The old tracker was useful for planning, but it included Admin Portal screens, approval workflows, Google auth decisions, and broad UI/backend work that no longer fit the time constraint.

Use this file as the handoff board for teammates and agents. Each task is designed for one person to complete with minimal coordination.

## Working Rules

- Read `README.md`, `SETUP.md`, `docs/CONTEXT.md`, and `docs/DESIGN.md` before starting.
- Pick one task, create one feature branch, and keep the change scoped to the listed files.
- Ask for help only when blocked by missing credentials, unclear product scope, broken local setup, or a cross-task conflict.
- Do not add Admin Portal screens, approval controls, reviewer queues, user management, audit-log viewers, backups, reports, or restricted-access approval workflows in this branch.
- Leave evidence in the PR: screenshots for UI changes, command output for tests/migrations, and a short manual test note.
- If a task grows past one day, split it and finish the smallest useful version first.

## Current MVP Baseline

Already present in `rapid-mvp`:

- Public/user website scope with Admin Portal boundary documented.
- ASOG TBI styled layout, home, browse, detail, upload, edit, login, register, password reset, and My Datasets pages.
- Browse Preview modal and detail-page download flow.
- Dataset upload starts as Pending Review.
- Metadata citation, BibTeX, view logging, download logging, audit logging, and basic recommendations.
- CSRF enabled globally.
- Idempotent `MvpSeeder`.
- PHP 8.2+ compatible setup; local verification passed on PHP 8.5.7.
- Basic contract tests.

## Task Status Legend

- `Ready` means one person can start without a meeting.
- `Blocked` means the task needs external credentials, policy, or Admin Portal work.
- `Future` means do not build it in this branch.

## Independent Goals

| ID | Status | Priority | Goal | Primary Owner | Touch Area | Dependencies | Evidence Required |
| --- | --- | --- | --- | --- | --- | --- | --- |
| RMVP-01 | Ready | High | Run local setup and smoke test from a fresh clone. | One tester | `README.md`, `SETUP.md`, local `.env` | PHP 8.2+, MySQL | Notes confirming `composer install`, `php spark migrate`, `php spark db:seed MvpSeeder`, `composer test`, and key pages load. |
| RMVP-02 | Ready | High | Add feature tests for auth and password reset. | One backend dev | `tests/`, `app/Controllers/Auth.php` only if needed | Existing password reset flow | Passing tests for login, invalid login, forgot-password request, invalid reset token, valid reset token, and password update. |
| RMVP-03 | Ready | High | Add feature tests for browse, detail, and download access rules. | One backend dev | `tests/`, `app/Controllers/Datasets.php` only if needed | Seeded datasets | Passing tests showing guests see public Published datasets, logged-in users see allowed datasets, browse has no direct download, detail download works, unauthorized private access fails. |
| RMVP-04 | Ready | High | Add feature tests for upload, update, and archive owner flows. | One backend dev | `tests/`, `app/Controllers/DatasetUpload.php`, `app/Controllers/Datasets.php` only if needed | Auth test helpers | Passing tests for ZIP upload, Pending Review status, owner edit, version increment, and archive removal from browse. |
| RMVP-05 | Ready | Medium | Improve empty, error, and success states across public/user pages. | One UI dev | `app/Views/`, `public/assets/css/app.css` | Current design docs | Screenshots for empty browse, empty My Datasets, upload validation error, successful upload/update/archive, and missing file download error. |
| RMVP-06 | Ready | Medium | Polish mobile responsiveness for browse, preview modal, upload, and detail. | One UI dev | `app/Views/datasets/`, `app/Views/upload/`, `public/assets/css/app.css` | Current UI baseline | Mobile screenshots at 375px and desktop screenshots at 1440px; no overlap, clipped text, or unusable controls. |
| RMVP-07 | Ready | Medium | Add copy-to-clipboard buttons for plain citation and BibTeX. | One UI dev | `app/Views/datasets/show.php`, `public/assets/css/app.css` | Existing citation helpers | Detail page screenshot and manual note confirming both copy buttons work. |
| RMVP-08 | Ready | Medium | Strengthen model validation and constants. | One backend dev | `app/Models/`, `app/Controllers/` validation blocks | Current schema | Tests or lint output confirming access/status values remain closed sets and validation messages are user-safe. |
| RMVP-09 | Ready | Medium | Add structured seed data for all access/status display cases. | One backend dev | `app/Database/Seeds/MvpSeeder.php`, maybe tests | Current migrations | Rerunnable seeder; demo records for Public, Institutional, Restricted, Private, Pending Review, Revision Requested, Published, Rejected, and Archived owner views. |
| RMVP-10 | Ready | Low | Improve README handoff with screenshots or a short walkthrough section. | One docs owner | `README.md`, `docs/` | App running locally | README has a concise walkthrough, known limits, and screenshot links or paths. |
| RMVP-11 | Ready | Low | Add a deployment checklist for shared hosting or school server use. | One ops/docs owner | `docs/DEPLOYMENT.md`, `SETUP.md` | Target hosting info if available | Checklist covers PHP version, web root, writable folders, `.env`, database, migrations, seed policy, and HTTPS. |
| RMVP-12 | Ready | Low | Review accessibility basics. | One UI/tester | Views and CSS only | App running locally | Notes for keyboard navigation, visible focus, modal close behavior, labels, contrast, and form errors. |

## Manual Audit Script

Use this sequence before a handoff PR is accepted:

```powershell
php -v
composer install
php spark migrate
php spark db:seed MvpSeeder
php spark routes
composer test
php spark serve
```

Then manually verify:

- Home loads.
- Browse loads as guest.
- Preview opens and closes by button, backdrop, and Escape.
- Dataset title opens the detail page.
- `Details & Download` opens the detail page.
- Detail page shows description, metadata, citation, BibTeX, recommendations, and Download ZIP.
- Download ZIP works only from the detail page flow.
- Registration works.
- Login works with `user@example.test` / `change-me`.
- Forgot password shows a development reset link when `CI_ENVIRONMENT = development`.
- My Datasets shows owner submissions.
- Upload creates a Pending Review dataset.
- Edit updates metadata and increments version.
- Archive removes the dataset from public browse.

## Descoped From This Branch

Move these to the separate Admin Portal or a later project. Do not build them in `rapid-mvp`:

- Admin dashboard.
- Dataset approval/rejection/revision controls.
- Reviewer queues.
- User management.
- Audit-log viewer.
- Backup controls.
- Reports.
- Restricted dataset access request approval workflow.
- Google school-email authentication.
- Email delivery for password reset.
- AI/ML recommendations beyond the current metadata scoring.

## Quick Assignment Model

For least interaction, assign by lane:

- Backend tester: RMVP-02, RMVP-03, RMVP-04.
- UI finisher: RMVP-05, RMVP-06, RMVP-07, RMVP-12.
- Data/schema owner: RMVP-08, RMVP-09.
- Docs/ops owner: RMVP-01, RMVP-10, RMVP-11.

Each lane can work independently. Coordination is only needed if two people touch the same controller/view at the same time.
