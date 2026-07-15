# ASOG TBI Dataset Repository

The `rapid-mvp` branch is a unified CodeIgniter 4 and MySQL repository for public dataset discovery, contributor submissions, two-stage institutional verification, and administrator-controlled publication.

## Included Workspaces

- Public catalog, search, filters, dataset details, citation, recommendations, and protected downloads
- Contributor registration, upload, version updates, revision responses, status notifications, and self-archive
- Technical review with protected ZIP access and a required manual verification checklist
- Research Ethics review with administrator assignment and a required compliance checklist
- Repository administration for reviewer assignment, final publication, access classification, users, roles, archive/restore, review history, and audit logs

Only non-archived `published` datasets appear publicly. New and updated submissions move through:

```text
Pending Technical -> Pending Ethics -> Awaiting Publication -> Published
       |                  |
       +-> Revision       +-> Revision
       +-> Rejected       +-> Rejected
```

Revision resubmissions return to the same stage. Updates to published datasets restart technical verification so package changes are checked before ethics review.

## Documentation

- [SETUP.md](SETUP.md) contains installation, migrations, demo accounts, and the review walkthrough.
- [docs/CONTEXT.md](docs/CONTEXT.md) defines roles, workflow rules, and deferred scope.
- [docs/DESIGN.md](docs/DESIGN.md) defines the shared public and governance visual language.
- [docs/SKILL.md](docs/SKILL.md) gives agents implementation guardrails.
- [docs/progress.md](docs/progress.md) is the append-only implementation and verification ledger.
- [Database-Repo-SRS.md](Database-Repo-SRS.md) remains the full requirements source.

## Quick Start

```powershell
composer install
Copy-Item .env.example .env
php spark key:generate
php spark migrate
php spark db:seed MvpSeeder
php spark serve
```

The application requires PHP 8.2 or newer. Uploaded ZIP files stay under `writable/uploads/` and must never be served directly from `public/`.

## Deferred

Automated ZIP diagnostics, malware scanning, email delivery, browser-driven backup/restore, advanced reports, restricted-access request approval, and generalized notifications remain outside this release.
