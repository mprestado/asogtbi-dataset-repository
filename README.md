# ASOG TBI Dataset Repository

This repository is the `rapid-mvp` branch of the ASOG TBI Dataset Repository: a public and user-facing CodeIgniter 4 + MySQL website for browsing, citing, downloading, and contributing institutional datasets.

The goal of this branch is a working rapid MVP that teammates can audit and build on. Keep the implementation pragmatic, runnable, and clear. Avoid speculative architecture and do not add Admin Portal screens here.

## Branch Scope

Build and maintain only these public/user-facing flows:

- Home
- Login, registration, logout, and password reset
- Browse/search/filter Published datasets
- Dataset preview modal from browse results
- Dataset detail pages with citation and BibTeX
- Detail-page download flow with download logging
- Upload Dataset
- My Datasets
- Update own datasets
- Self-archive own datasets
- Metadata-based similar dataset recommendations

Do not build these in this repository:

- Admin dashboard
- Reviewer dashboard
- Approval or rejection controls
- User management
- Audit-log viewer
- Backup controls
- Reports
- Restricted access request approval workflow

Those belong to a separate Admin Portal application that shares the database. This website may read shared fields such as `status`, `approved_by`, and `approved_at`, but it should not provide admin/reviewer controls.

## Documentation For Humans And Agents

Read these first:

- [SETUP.md](SETUP.md) - local setup, database charset/collation, migrations, seed data, and run commands.
- [docs/CONTEXT.md](docs/CONTEXT.md) - product scope and Admin Portal boundary.
- [docs/DESIGN.md](docs/DESIGN.md) - ASOG TBI visual system.
- [docs/SKILL.md](docs/SKILL.md) - concise agent instructions for applying the scope and design.

Task assignment and progress tracking live in the team's Google Sheets task tracker, not in this repository.

The older planning documents were removed from this branch because they conflicted with the Admin Portal split.

## Tech Stack

- CodeIgniter 4
- PHP 8.2 or newer
- MySQL or MariaDB
- Composer
- XAMPP, Laragon, WAMP, or another local PHP/MySQL stack

## Quick Start

```powershell
composer install
Copy-Item .env.example .env
php spark key:generate
```

Create the database with the expected character set and collation:

```sql
CREATE DATABASE asog_dataset_repo
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
```

Set the local database values in `.env`:

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = asog_dataset_repo
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.charset = utf8mb4
database.default.DBCollat = utf8mb4_unicode_ci
database.default.port = 3306
```

Then run:

```powershell
php spark migrate
php spark db:seed MvpSeeder
php spark serve
```

Open:

```text
http://localhost:8080
```

Demo account after seeding:

```text
Email: user@example.test
Password: change-me
```

## Rapid MVP Notes

- Uploaded dataset ZIP files are stored under `writable/uploads/`, not `public/`.
- Browse results use a Preview modal. Downloads are intentionally available from the dataset detail page so citation and metadata are seen first.
- Password reset stores a hashed, expiring token. Email delivery is not configured in this branch; in `development`, the reset link is shown after a valid reset request.
- CSRF protection is enabled globally, and forms should include `csrf_field()`.
- Tests are still light. Treat manual smoke testing as required until feature tests are added.

## Useful Commands

```powershell
php -v
composer install
php spark routes
php spark migrate:status
composer test
```

Run syntax checks on touched PHP files:

```powershell
php -l app/Controllers/Auth.php
php -l app/Controllers/Datasets.php
```

## MVP Rule

Every change should answer one question: does this help the team demo and audit the working public/user-facing MVP?

If the answer is no, record it in the team's Google Sheets task tracker as a later follow-up instead of adding it now.
