# ASOG TBI Dataset Repository

Starter repository for the ASOG TBI Dataset Repository with Recommendation System.

This project is a CodeIgniter 4 and MySQL web application focused on the MVP described in `Database-Repo-SRS.md`. The MVP target is a functional dataset repository that supports login, basic role access, dataset upload, approval, browsing, search, filtering, detail pages, citation/BibTeX, downloads, updates, archiving, and metadata-based recommendations.

## Current Status

This repository currently contains the CodeIgniter 4 application starter plus planning documents for the first two-week MVP build.

The implementation should stay focused on the MVP. Advanced institutional features such as full ethics review workflows, multiple reviewer roles, restricted access requests, email notifications, automated backups, annual compliance reports, and AI recommendation methods are future enhancements.

## Documentation

- [Setup Guide](SETUP.md)
- [MVP Task Tracker](TASKS.md)
- [Repository Setup](docs/REPOSITORY_SETUP.md)
- [MVP Scope](docs/MVP_SCOPE.md)
- [Two-Week MVP Plan](docs/MVP_2_WEEK_PLAN.md)
- [Shared MVP Work Areas](docs/MVP_SHARED_WORK_AREAS.md)
- [GitHub Project Board and Issues](docs/GITHUB_PROJECT_BOARD.md)
- [Starting Repository Checklist](docs/STARTING_REPOSITORY_CHECKLIST.md)
- [System Skeleton](docs/SYSTEM_SKELETON.md)
- [Design Adaptation](docs/DESIGN_ADAPTATION.md)

## Tech Stack

- CodeIgniter 4
- PHP 8.2 or newer
- MySQL
- Apache, Nginx, XAMPP, Laragon, or WAMP for local development

## Local Setup

```powershell
composer install
Copy-Item .env.example .env
php spark key:generate
php spark serve
```

Update `.env` before running database-backed features:

```ini
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = asog_dataset_repo
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

## MVP Rule

Every task should answer one question: does this help the team demo the working MVP in two weeks?

If the answer is no, move it to future enhancements.
