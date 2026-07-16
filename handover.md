# Agent Handover

Updated: 2026-07-16  
Branch: `rapid-mvp`  
Current commit: `f8a9aea`  
Remote status at handover: synchronized with `origin/rapid-mvp`

## Start Here

1. Run `git status --short --branch`.
2. Read this file, then read `docs/CONTEXT.md`.
3. Use `docs/progress.md` only when milestone history or prior verification details are needed.
4. Use `docs/DESIGN.md` for established visual rules, but inspect the current implementation before applying older layout descriptions literally.
5. Do not rewrite old entries in `docs/progress.md`; append a new dated entry after material work.

## Working Tree Warning

The root `logo/` folder is intentionally untracked and was excluded from all commits:

```text
logo/asogtbi-logo.webp
logo/ccslogo.png
```

Do not delete, stage, move, or commit it unless the user explicitly asks. The organized production logo assets already live under `public/assets/img/brand/`.

## What Is Implemented

The application is one CodeIgniter 4 repository containing:

- Public landing page, dataset catalog, search, preview, detail, citation, recommendations, and authenticated downloads.
- Contributor registration, upload, protected ZIP storage, optional cover images, dataset versions, revisions, self-archive, profile settings, and the paginated My Datasets library.
- Technical-first moderation with administrator assignment, protected ZIP inspection, structured checklist findings, drafts, revision, rejection, and approval.
- Ethics moderation after technical approval, with retained technical context and its own structured checklist.
- Administrator stage queues, workload-aware assignment, accountable reassignment, publication gating, archive/restore, users and roles, and audit logs.
- Unified header notifications with unread counts, links, polling, transient toast, and browser-unlocked beep.

## Workflow Invariants

```text
pending_technical_review
  -> technical_revision_requested
  -> rejected
  -> pending_ethics_review
       -> ethics_revision_requested
       -> rejected
       -> awaiting_publication
            -> published
```

- Technical review always happens before ethics review.
- Reviewers may act only on administrator-assigned reviews.
- Reassignment closes the old assignment and preserves its history.
- Approval requires every required checklist item to be `confirmed`.
- Checklist items marked `issue` require an item-level note.
- Revision and rejection require contributor-facing comments.
- Contributor editing is blocked during active review and publication approval.
- Published updates create a new version, leave the catalog, and restart technical review.
- Only administrators publish and set final access classification.
- Only non-archived `published` datasets appear in public catalog results.
- Protected ZIPs and uploaded covers are streamed through authorized controllers.
- Workflow transitions must remain transactional and server-validated.

Primary implementation:

- `app/Services/ModerationWorkflow.php`
- `app/Controllers/Admin.php`
- `app/Controllers/Reviews.php`
- `app/Controllers/Dashboard.php`
- `app/Models/DatasetModel.php`
- `app/Models/ReviewModel.php`

## Recent Commit Structure

```text
f8a9aea chore: clean merged landing page styles
2bf31c0 Merge remote-tracking branch 'origin/rapid-mvp' into rapid-mvp
62d4283 feat: rebuild contributor workspace and unify notifications
a6f597d feat: add protected dataset cover images
c13a5ed feat: overhaul admin and reviewer governance workflows
514ffc2 Merge pull request #25 from jazz-lnz/develop-jess
```

The merge preserved the incoming landing-page redesign and the local governance, cover, contributor-library, and notification work.

## Database State

The local MySQL database is `asog_dataset_repo`. Migrations were confirmed applied through:

```text
2026-07-16-000015 AddDatasetCoverImage
2026-07-16-000016 EnhanceReviewWorkflow
```

Important additions:

- `datasets.cover_image`
- `reviews.draft_saved_at`
- `reviews.reassignment_reason`

Fresh setup:

```powershell
php spark migrate
php spark db:seed DemoAccountsSeeder
php spark db:seed MvpSeeder
```

Optional large catalog:

```powershell
php spark db:seed DummyPublishedUploadsSeeder
```

## Demo Accounts

All seeded demo accounts use password `change-me`.

| Role | Email |
|---|---|
| Contributor | `user@example.test` |
| Repository Administrator | `admin@example.test` |
| Ethics Reviewer | `ethics@example.test` |
| Technical Reviewer | `technical@example.test` |

## Runtime Notes

XAMPP CLI PHP is `8.0.30`:

```text
C:\xampp\php\php.exe
```

Use it only for syntax checks. The application requires PHP 8.2 or newer.

The installed supported runtime is PHP `8.5.7`:

```text
C:\Users\johnm\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.5_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe
```

Example:

```powershell
$php = 'C:\Users\johnm\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.5_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe'
& $php spark routes
& $php spark migrate:status
& $php vendor/bin/phpunit tests/unit
```

The local application was verified at `http://127.0.0.1:8080`.

## Verification Baseline

Last verified after merging the live branch:

- Branch and remote synchronized at `f8a9aea`.
- No merge conflict markers.
- All 31 changed PHP files passed syntax checks.
- Migrations were applied through `000016`.
- Required draft, reassignment, notification, cover, and moderation routes were registered.
- PHP 8.5.7 unit suite passed: `15 tests, 44 assertions`.
- Landing page returned HTTP 200 with the merged live redesign.
- Contributor, ethics reviewer, technical reviewer, and administrator primary pages returned HTTP 200.
- My Datasets handled the seeded 123-record account with 12 records per page.
- Empty contributor and filtered no-results states were verified.
- Protected cover access returned 404 for guests and 200 for assigned reviewers and administrators.

Run before pushing:

```powershell
git diff --check
git status --short --branch

$php = 'C:\Users\johnm\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.5_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe'
& $php spark migrate:status
& $php spark routes
& $php vendor/bin/phpunit tests/unit
```

## Known Blocker

The complete PHPUnit suite reaches the database feature tests but PHP 8.5 currently lacks the SQLite3 extension:

```text
Main connection [SQLite3]: Class "SQLite3" not found
```

Do not report the full feature suite as passing until SQLite3 is enabled and `vendor/bin/phpunit` completes successfully.

## Highest-Value Next Steps

1. Enable SQLite3 for PHP 8.5 and run the complete PHPUnit suite.
2. Perform desktop and mobile visual QA for the merged landing page, My Datasets, notification popovers, reviewer workspace, admin moderation board, and Users and Roles.
3. Walk through a real two-reviewer reassignment and confirm the previous reviewer loses access immediately.
4. Upload and replace a real cover image, then verify cropping and protected delivery.
5. Reconcile any stale visual descriptions in `docs/DESIGN.md` with the implemented contributor library and unified header notifications.

## Deferred Scope

Do not implement these without a new scope decision:

- Automated ZIP diagnostics
- Malware scanning
- Email delivery
- Backup and restore automation
- Advanced reports
- Restricted-access request approval
- Notification preferences

## Git Guidance

- Preserve unrelated user changes.
- Stage only files belonging to the requested task.
- Keep commits behavior-focused and meaningful.
- Never use destructive reset or checkout commands unless explicitly approved.
- Fetch before packaging if the live branch may have changed.
- After merging, inspect shared CSS and layouts semantically even when Git reports no textual conflicts.

## Documentation Map

- `README.md`: product summary and quick start
- `SETUP.md`: environment, seeders, accounts, and walkthrough
- `docs/CONTEXT.md`: roles, workflow, data ownership, deferred scope
- `docs/DESIGN.md`: visual language and component guidance
- `docs/SKILL.md`: agent-facing implementation guardrails
- `docs/progress.md`: append-only milestone and verification ledger
- `docs/ADMIN_REVIEW_DASHBOARD_PLAN.md`: governance UX design and implementation record
- `docs/DEPLOYMENT_READINESS.md`: deployment checklist
- `Database-Repo-SRS.md`: requirements source
