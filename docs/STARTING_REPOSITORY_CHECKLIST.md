# Starting Repository Checklist

Use this checklist before the first major implementation sprint.

## Repository Files

Expected starting files:

- `README.md`
- `.gitignore`
- `.env.example`
- `composer.json`
- `composer.lock`
- `spark`
- `app/`
- `public/`
- `tests/`
- `writable/`
- `Database-Repo-SRS.md`
- `docs/`

Do not commit:

- `.env`
- `vendor/`
- uploaded dataset files
- cache files
- logs
- session files
- debugbar output

## First Commit Checklist

- README describes the ASOG TBI Dataset Repository instead of the stock framework starter.
- MVP docs are committed.
- `.env` is ignored.
- `.env.example` is committed.
- `vendor/` is ignored.
- No real passwords or secrets are committed.
- `Database-Repo-SRS.md` is committed if the team wants the SRS in the repo.

## Initial Git Commands

```powershell
git status --short
git branch -M main
git add README.md docs Database-Repo-SRS.md .gitignore .env.example composer.json composer.lock app public tests writable spark phpunit.dist.xml preload.php builds LICENSE
git commit -m "Initial CodeIgniter MVP repository setup"
git remote add origin https://github.com/YOUR_USERNAME/asog-tbi-dataset-repository.git
git push -u origin main
```

If `git add` warns about ignored files, leave them ignored unless the team has a specific reason to track them.

## Environment Checklist

- PHP version is 8.2 or newer.
- Composer is installed.
- MySQL is running.
- Database `asog_dataset_repo` exists.
- `.env` has local database credentials.
- `php spark serve` starts the app.

## Starter Implementation Order

Follow this order so team members can work independently:

1. Database migrations and seeders.
2. Auth and role filters.
3. Dataset upload and protected file storage.
4. Admin approval.
5. Catalog, search, filters, and pagination.
6. Detail page and download route.
7. Citation and BibTeX helper.
8. Recommendation helper.
9. Update and archive flow.
10. UI, QA, and demo script.

## Minimum Demo Seed Data

Create seed data for:

- One admin user.
- Two normal users.
- Three approved datasets.
- One pending dataset.
- One archived dataset.
- Dataset tags and categories that make recommendations visible.

## Demo Credentials Format

Document demo credentials like this in a private team note or local-only file:

```text
Admin
Email: admin@example.test
Password: change-me

User
Email: user@example.test
Password: change-me
```

Do not use production passwords in committed files.
