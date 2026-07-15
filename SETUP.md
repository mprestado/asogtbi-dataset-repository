# ASOG TBI Dataset Repository Setup - rapid-mvp

## Requirements

- PHP 8.2 or newer
- Composer
- MySQL or MariaDB
- Git

Verify the PHP binary used by Composer and Spark:

```powershell
php -v
```

## Install

```powershell
git switch rapid-mvp
composer install
Copy-Item .env.example .env
php spark key:generate
```

Create the database:

```sql
CREATE DATABASE asog_dataset_repo
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;
```

Configure `.env`:

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'
database.default.hostname = localhost
database.default.database = asog_dataset_repo
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.charset = utf8mb4
database.default.DBCollat = utf8mb4_unicode_ci
database.default.port = 3306
```

Run the schema and demo data:

```powershell
php spark migrate
php spark db:seed DemoAccountsSeeder
php spark db:seed MvpSeeder
php spark serve
```

If you only need the login accounts, run `DemoAccountsSeeder`. `MvpSeeder` also normalizes these same demo accounts and then loads the walkthrough datasets.

Optional large dummy catalog seed:

```powershell
php spark db:seed DummyPublishedUploadsSeeder
```

This imports `dummydata/dataset1.csv` as published public uploads owned by user `1`. Run `MvpSeeder` first so the demo contributor and administrator accounts exist.

## Demo Accounts

All seeded accounts use password `change-me`.

| Role | Email |
|---|---|
| Contributor | `user@example.test` |
| Repository Administrator | `admin@example.test` |
| Research Ethics Reviewer | `ethics@example.test` |
| Technical Reviewer | `technical@example.test` |

Change demo passwords before any shared or production deployment.

## Verification Walkthrough

1. Sign in as the contributor and upload a ZIP dataset. Confirm `Pending Technical Review`.
2. Sign in as the administrator, open Dataset Moderation, and assign the technical reviewer.
3. Sign in as the technical reviewer, download and manually inspect the protected ZIP, complete the checklist, and approve.
4. Sign in as the administrator and assign the ethics reviewer.
5. Sign in as the ethics reviewer, open the assigned record, complete every checklist item, and approve.
6. Sign in as the administrator, choose the final access type, and publish.
7. Confirm the dataset appears in the allowed public or authenticated catalog scope and that every action appears in Audit Logs.

For revision testing, request revision at either stage, update the dataset as the contributor, and confirm it returns to that same stage with a new review round.

## Commands

```powershell
php spark routes
php spark migrate:status
composer test
```

## Deployment Readiness

Deployment remains conditional on server availability and successful PHP 8.2+ verification. Use [docs/DEPLOYMENT_READINESS.md](docs/DEPLOYMENT_READINESS.md) for the go/no-go checklist, production setup steps, and evidence to record after deployment.

Uploaded files belong under `writable/uploads/datasets/`. Do not commit `.env`, credentials, database dumps, `vendor/`, writable runtime data, or uploaded ZIP files.

Automated ZIP inspection, antivirus, backup/restore, reports, restricted-access requests, and email notifications are deferred.
