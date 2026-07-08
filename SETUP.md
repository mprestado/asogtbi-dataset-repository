# ASOG TBI Dataset Repository Setup Guide

This is the working guide for everyone who will make changes in this repository. Read this before writing code, creating branches, opening pull requests, or pushing anything to GitHub.

## Project Goal

Build the two-week MVP for the ASOG TBI Dataset Repository with Recommendation System.

The MVP focuses on:

- User login and logout.
- Basic roles and protected pages.
- Dataset upload with required metadata and ZIP file.
- Admin approval before publication.
- Dataset catalog with pagination, search, and filtering.
- Dataset detail pages with metadata, citation, BibTeX, download, and recommendations.
- Dataset update and archive.
- Basic audit logs for important actions.

Do not spend MVP time on future features unless the team lead approves it.

Future features include full ethics review workflows, multiple reviewer roles, restricted access requests, email notifications, automated backups, advanced audit dashboards, AI recommendations, and institutional single sign-on.

## Required Tools

Install these before working:

- Git
- PHP 8.2 or newer
- Composer
- MySQL
- XAMPP, Laragon, WAMP, Apache, Nginx, or another PHP/MySQL local stack
- A code editor such as VS Code or PhpStorm

Check PHP:

```powershell
php -v
```

The app requires PHP 8.2 or newer. PHP 8.0 is not enough for this CodeIgniter version.

## First Local Setup

Clone your fork, not the main organization repository:

```powershell
git clone https://github.com/YOUR_USERNAME/asog-tbi-dataset-repository.git
cd asog-tbi-dataset-repository
```

Add the main repository as `upstream`:

```powershell
git remote add upstream https://github.com/ORG_OR_OWNER/asog-tbi-dataset-repository.git
git remote -v
```

Install dependencies:

```powershell
composer install
Copy-Item .env.example .env
php spark key:generate
```

Update `.env`:

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = asog_dataset_repo
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

Create the database:

```sql
CREATE DATABASE asog_dataset_repo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Run migrations and seeders when available:

```powershell
php spark migrate
php spark db:seed MvpSeeder
```

Run the app:

```powershell
php spark serve
```

Open:

```text
http://localhost:8080
```

## Branch Rules

Never commit directly to `main`.

Never push directly to `main`.

Never force-push `main` or `develop`.

All members work from their own forks and submit pull requests to the shared repository.

Recommended shared branches:

```text
main       stable branch for demo-ready code
develop    integration branch for accepted MVP work
```

Normal work branches:

```text
feature/auth-rbac
feature/database-foundation
feature/dataset-lifecycle
feature/catalog-detail-download
feature/citation-recommendations
feature/ui-qa-docs
fix/login-validation
fix/upload-errors
docs/setup-guide
```

Use short, descriptive branch names:

```text
feature/member-area-specific-task
fix/problem-being-fixed
docs/document-being-updated
```

## Daily Workflow

Before starting work:

```powershell
git checkout develop
git pull upstream develop
git checkout -b feature/your-task-name
```

If your fork is behind:

```powershell
git fetch upstream
git checkout develop
git merge upstream/develop
git push origin develop
```

Work on your feature branch:

```powershell
git checkout feature/your-task-name
git status --short
```

Commit only related files:

```powershell
git add path/to/file.php path/to/view.php
git commit -m "feat: add dataset catalog search"
git push origin feature/your-task-name
```

Then open a pull request from your fork branch into the shared repository `develop` branch.

## Commit Message Rules

Use clear commit messages:

```text
feat: add login form validation
feat: create dataset migrations
fix: block inactive users from login
fix: hide archived datasets from catalog
docs: add setup workflow
style: align dataset cards with design system
test: add dataset model tests
```

Keep commits focused. One commit should explain one meaningful change.

Avoid vague messages:

```text
update
changes
final
fix stuff
my part
```

## Pull Request Rules

Every pull request must target `develop`, not `main`.

Every pull request should include:

- Summary of what changed.
- SRS or MVP requirement reference.
- Screenshots for UI changes.
- Migration or seeder notes for database changes.
- Manual test steps.
- Known limitations or unfinished items.

Pull request template:

```md
## Summary

## SRS / MVP References

## Screenshots

## Database Changes

## Manual Test Steps

## Known Limitations
```

Do not merge your own pull request unless the team has explicitly agreed to that rule.

At least one teammate should review each pull request.

## Merge Rules

Only merge when:

- The branch is up to date with `develop`.
- The app still runs locally.
- Migrations are included for database changes.
- The feature does not break another member's route or model.
- The pull request has manual test steps.
- The work matches the assigned MVP task.

Use squash merge if the pull request has messy work-in-progress commits.

## What Should Be Committed

Commit project source files and team-facing setup files:

- `app/Controllers/`
- `app/Models/`
- `app/Views/`
- `app/Filters/`
- `app/Helpers/`
- `app/Database/Migrations/`
- `app/Database/Seeds/`
- `app/Config/` changes that are required by the app
- `public/assets/` CSS, JS, and committed static assets
- `tests/`
- `composer.json`
- `composer.lock`
- `.env.example`
- `.gitignore`
- `README.md`
- `SETUP.md`
- required planning or design Markdown files
- `Database-Repo-SRS.md` if the team wants the SRS available inside the repo

Use this before the first commit:

```powershell
git status --short
git add .
git status --short
```

Review the staged list before committing. If you see secrets, local cache, uploaded files, or generated dependencies, stop and fix `.gitignore` first.

## What Must Not Be Committed

Never commit:

- `.env`
- real passwords, API keys, SMTP credentials, or database credentials
- `vendor/`
- `writable/cache/`
- `writable/logs/`
- `writable/session/`
- `writable/uploads/`
- `writable/debugbar/`
- `public/null/`
- local dataset ZIP uploads
- database dumps containing private data
- IDE folders such as `.vscode/`, `.idea/`, or `nbproject/`
- OS files such as `Thumbs.db`, `.DS_Store`, or `Desktop.ini`
- test coverage output

If you accidentally staged something private:

```powershell
git restore --staged path/to/file
```

If you accidentally committed a secret, tell the team immediately. Do not just delete it in a later commit and assume it is gone.

## Database Rules

All database structure changes must use migrations.

Do not manually tell teammates to create columns without a migration.

Every table used by a feature should have:

- A migration.
- A model.
- Seeder data if the feature is needed for the demo.

Seeders must use fake/demo-safe data only.

Do not commit private or real institutional datasets.

## Upload and File Rules

MVP dataset uploads must be ZIP files.

Uploaded files should be stored under:

```text
writable/uploads/
```

Do not store uploaded dataset files in:

```text
public/
```

The database should store file references, not raw file contents.

## Coding Rules

Use the existing CodeIgniter 4 MVC structure:

- Controllers handle requests and redirects.
- Models handle database access.
- Views display UI.
- Filters protect routes.
- Helpers provide reusable formatting or scoring logic.
- Migrations define schema.
- Seeders create demo data.

Keep MVP code simple and readable. Do not add heavy abstractions unless they clearly reduce repeated code.

## UI Rules

Use the existing starter design system:

- `hero-panel` for page introductions.
- `panel` for forms and content blocks.
- `grid` for responsive card layouts.
- `table-shell` for tables.
- `button`, `button secondary`, and `button warning` for actions.
- `eyebrow`, `tag`, and `status-pill` for labels.

Follow the dark navy, gold, sky-blue, and warm off-white direction from the design file.

## Six-Member Ownership

Recommended ownership:

| Member | Area | Branch |
|---|---|---|
| Member 1 | Auth, roles, access guards | `feature/auth-rbac` |
| Member 2 | Database, models, migrations, seeders | `feature/database-foundation` |
| Member 3 | Upload, approval, update, archive | `feature/dataset-lifecycle` |
| Member 4 | Catalog, search, filtering, detail, download | `feature/catalog-detail-download` |
| Member 5 | Citation, BibTeX, recommendations | `feature/citation-recommendations` |
| Member 6 | UI integration, QA, docs, demo readiness | `feature/ui-qa-docs` |

Members can help each other, but every pull request should have a clear owner.

## Before Opening a Pull Request

Run:

```powershell
git status --short
php spark routes
php spark migrate:status
```

If PHP 8.2 is unavailable locally, state that in the pull request and list what you were able to verify.

For PHP syntax checks:

```powershell
php -l app/Controllers/YourController.php
```

For UI work, manually check:

- Desktop layout.
- Mobile layout.
- Navigation links.
- Form validation states.
- Empty states.
- Button text and actions.

## First Repository Commit

The first commit should include the starter app, MVP skeleton, setup docs, and planning files.

Suggested command:

```powershell
git branch -M main
git add .
git status --short
git commit -m "chore: initialize ASOG TBI dataset repository"
```

After creating an empty GitHub repo:

```powershell
git remote add origin https://github.com/YOUR_USERNAME/asog-tbi-dataset-repository.git
git push -u origin main
```

Then create `develop`:

```powershell
git checkout -b develop
git push -u origin develop
```

After this, protect `main` on GitHub and require pull requests for changes.

## Main Branch Protection

Recommended GitHub settings:

- Require pull request before merging.
- Require at least one approval.
- Require conversation resolution before merge.
- Block force pushes.
- Block branch deletion.
- Keep `main` as the stable demo branch.
- Use `develop` for MVP integration work.

## Emergency Rule

If something breaks `develop`, do not rush a direct fix onto `main`.

Create a fix branch:

```text
fix/short-problem-name
```

Open a pull request into `develop`, review it, and merge it normally.

## Team Reminder

The MVP is the priority. A small working feature is better than a large unfinished feature.

When in doubt, build the simplest version that helps the final demo.
