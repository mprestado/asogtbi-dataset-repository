# ASOG TBI Dataset Repository Setup Guide - rapid-mvp

This guide is for the `rapid-mvp` branch.

This branch is the public and user-facing CodeIgniter 4 website for the ASOG TBI Dataset Repository. It includes guest browsing, user login/registration, dataset upload, My Datasets, dataset detail pages, citation/BibTeX, downloads, self-service archive, and simple metadata-based recommendations.

Do not build or expect Admin Portal screens in this branch. Dataset approval, rejection, reviewer queues, user management, audit-log viewers, backups, and reports belong to a separate Admin Portal application that shares the database.

## Required Tools

Install these before running the project:

- Git
- PHP 8.2 or newer
- Composer
- MySQL or MariaDB
- XAMPP, Laragon, WAMP, or another PHP/MySQL local stack

Check PHP from PowerShell:

```powershell
php -v
```

If this fails with `php is not recognized`, add your PHP folder to Windows `PATH`. Common local paths are:

```text
C:\xampp\php
C:\laragon\bin\php\php-8.x.x
```

Then open a new terminal and run `php -v` again.

## Get This Branch

From the repository folder:

```powershell
git fetch origin
git switch rapid-mvp
```

If you do not have the branch locally yet:

```powershell
git switch -c rapid-mvp origin/rapid-mvp
```

## Install Dependencies

```powershell
composer install
```

If `composer install` fails because PHP is missing, fix PHP on `PATH` first.

## Create `.env`

Copy the example file:

```powershell
Copy-Item .env.example .env
```

Generate the app key:

```powershell
php spark key:generate
```

Update `.env` with local development values:

```ini
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = asog_dataset_repo
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
database.default.charset = utf8mb4
database.default.DBCollat = utf8mb4_unicode_ci
```

Use your real local MySQL username and password if they are not `root` with a blank password.

## Create The Database

Yes, create the database with `CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci`.

It is not a `.env` setting by itself. It belongs in the SQL command that creates the database. The matching `.env` charset and collation values above keep the app connection consistent with the database.

Run this in MySQL:

```sql
CREATE DATABASE asog_dataset_repo
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
```

Why this matters:

- `utf8mb4` stores the full Unicode range, including symbols and non-English text that may appear in dataset metadata.
- Setting it explicitly avoids relying on whatever default charset your local MySQL install happens to use.
- The branch stores searchable titles, descriptions, tags, contributor names, citation text, and research metadata, so consistent text storage matters.

If the database already exists, check it with:

```sql
SELECT DEFAULT_CHARACTER_SET_NAME, DEFAULT_COLLATION_NAME
FROM information_schema.SCHEMATA
WHERE SCHEMA_NAME = 'asog_dataset_repo';
```

If it is not `utf8mb4` / `utf8mb4_unicode_ci`, either recreate the local database or run:

```sql
ALTER DATABASE asog_dataset_repo
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
```

For an empty local database, recreating it is usually simpler.

## Run Migrations And Demo Seed Data

```powershell
php spark migrate
php spark db:seed MvpSeeder
```

The demo seeder creates:

- one User account
- two Published sample datasets
- one Pending Review sample dataset
- placeholder ZIP files under `writable/uploads/datasets/`

Demo login:

```text
Email: user@example.test
Password: change-me
```

There is no demo admin account in this branch because admin/reviewer functionality is out of scope here.

## Run The App

```powershell
php spark serve
```

Open:

```text
http://localhost:8080
```

## Expected User-Facing Flows

Guests can:

- open the Home page
- browse Published public datasets
- search and filter the catalog
- view public dataset detail pages
- generate citation/BibTeX text
- download public Published ZIP files
- request a password reset link for an active account

Logged-in users can:

- browse Published public, institutional, and restricted datasets
- upload a dataset, which starts as Pending Review
- view My Datasets
- view their own Pending Review, Revision Requested, Published, Rejected, or Archived datasets
- edit their own dataset metadata
- upload a new ZIP version
- archive their own dataset

This branch does not approve, reject, restore, or review datasets. Those actions happen in the separate Admin Portal.

Password reset is implemented as a token-based MVP flow. It stores a hashed reset token that expires after 30 minutes and can only be used once. Email delivery is not configured in this branch; when `CI_ENVIRONMENT = development`, the reset request page displays the prepared reset link so the local flow can be audited.

## Useful Commands

Show routes:

```powershell
php spark routes
```

Check migration status:

```powershell
php spark migrate:status
```

Reset a local development database:

```powershell
php spark migrate:rollback
php spark migrate
php spark db:seed MvpSeeder
```

Run PHP syntax checks on a changed file:

```powershell
php -l app/Controllers/Datasets.php
```

Run tests:

```powershell
composer test
```

## Project Scope Rules

Build only public/user-facing screens in this branch:

- Home
- Login
- Register
- Browse/Search
- Dataset Detail
- Upload Dataset
- Update Dataset
- My Datasets

Do not add these here:

- Admin dashboard
- Review or approval queue
- Approve/reject controls
- User management
- Audit-log viewer
- Backup controls
- Reports
- Restricted access request workflow

The shared database may still contain fields such as `status`, `approved_by`, and `approved_at` because the separate Admin Portal uses them. This website should read those values and display the correct user-facing state, not provide admin controls for them.

## Upload Rules

Dataset uploads must be ZIP files.

Uploaded files are stored under:

```text
writable/uploads/
```

Do not store uploaded dataset files in:

```text
public/
```

The database stores file references, not raw file contents.

## What Not To Commit

Never commit:

- `.env`
- real passwords, API keys, SMTP credentials, or database credentials
- `vendor/`
- `writable/cache/`
- `writable/logs/`
- `writable/session/`
- `writable/uploads/`
- `writable/debugbar/`
- local dataset ZIP files
- database dumps containing private data
- IDE folders such as `.vscode/` or `.idea/`

If you accidentally stage a private file:

```powershell
git restore --staged path/to/file
```

## Before Committing

Run:

```powershell
git status --short
php spark routes
php spark migrate:status
```

For UI changes, manually check:

- Home page
- Browse page
- Dataset detail page
- Login and Register
- Upload form
- My Datasets
- desktop layout
- mobile layout

If PHP or MySQL is not available locally, say exactly what could not be verified in the commit or pull request notes.
