# Repository Setup

This document explains how to publish and manage the starting repository for the ASOG TBI Dataset Repository MVP.

## Recommended GitHub Repository

Recommended name:

```text
asog-tbi-dataset-repository
```

Recommended visibility:

```text
Private during development, public only when the team is ready to share it.
```

Recommended description:

```text
CodeIgniter 4 and MySQL MVP for the ASOG TBI Dataset Repository with metadata-based recommendations.
```

## First Publish

Create an empty GitHub repository first. Do not add a GitHub README, license, or `.gitignore` during creation because this local project already has those files.

From this folder:

```powershell
git branch -M main
git add .
git commit -m "Initial CodeIgniter MVP repository setup"
git remote add origin https://github.com/YOUR_USERNAME/asog-tbi-dataset-repository.git
git push -u origin main
```

If the team wants a shared integration branch:

```powershell
git checkout -b develop
git push -u origin develop
```

## Branching Workflow

Use a small workflow because only two weeks remain.

```text
main        stable demo-ready branch
develop     integration branch for accepted MVP work
feature/*   individual task branches
fix/*       bug-fix branches
docs/*      documentation-only branches
```

Branch examples:

```text
feature/auth-rbac
feature/dataset-schema
feature/upload-approval
feature/catalog-search
feature/citation-recommendations
feature/ui-qa
```

## Pull Request Rules

Every pull request should include:

- What MVP feature was implemented.
- Which SRS requirement IDs it supports.
- Screenshots for UI changes.
- Migration or seed notes for database changes.
- Manual test steps.
- Known limitations.

Use one reviewer minimum. Merge only after the feature runs locally.

## Local Development Setup

Required:

- PHP 8.2 or newer
- Composer
- MySQL
- XAMPP, Laragon, WAMP, Apache, Nginx, or `php spark serve`

Setup:

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

Run the app:

```powershell
php spark serve
```

## Git Ignore Policy

Keep these out of Git:

- `.env`
- `vendor/`
- writable cache, logs, sessions, uploads, and debug files
- IDE folders
- local test coverage output

Commit these:

- `.env.example`
- migrations
- seeders
- controllers
- models
- views
- helpers
- filters
- docs
- tests

## Definition of Ready

A task is ready to start when it has:

- A clear accountable author or reviewer.
- SRS requirement IDs.
- Expected routes or files.
- Acceptance criteria.
- Known dependencies.

## Definition of Done

A task is done when:

- The feature works locally.
- Data validation is handled.
- Unauthorized access is blocked where needed.
- Database changes are committed as migrations.
- Manual test steps are documented in the pull request.
- The task does not add future-scope features unless needed by the MVP.
