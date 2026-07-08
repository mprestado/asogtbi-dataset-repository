# MVP Scope

This scope is based on `Database-Repo-SRS.md` and intentionally focuses on what can be built and demonstrated in two weeks.

## MVP Goal

Deliver a working dataset repository where users can authenticate, submit datasets, browse approved datasets, view metadata, cite and download approved ZIP files, update or archive authorized datasets, approve submissions as an administrator, and see basic metadata-based dataset recommendations.

## Included MVP Features

| Area | MVP Feature | SRS Reference |
|---|---|---|
| Authentication | Login, logout, secure password hashing | MVP-FR-01, MVP-FR-02, MVP-FR-05 |
| Accounts | Registration or administrator-created accounts | MVP-FR-03 |
| Access Control | Prevent unauthorized access to protected pages | MVP-FR-06 |
| Audit Basics | Record login, logout, upload, approval, download, update, and archive actions | MVP-FR-07 |
| User Admin | Activate or deactivate accounts | MVP-FR-08 |
| Dataset Upload | Submit dataset metadata and ZIP file | MVP scope, FR-046 to FR-057 |
| Approval | Admin approval before publishing | MVP scope, acceptance criteria |
| Catalog | Approved dataset listing with pagination | MVP scope, acceptance criteria |
| Search | Search by title, description, tags, or category | MVP scope, FR-023 to FR-026 |
| Filtering | Filter by data type and simple metadata | MVP scope |
| Detail Page | Display dataset metadata and research information | MVP scope, acceptance criteria |
| Download | Download approved dataset ZIP files | MVP-FR-09 |
| Citation | Generate copyable citation and BibTeX | MVP-FR-10 |
| Recommendation | Recommend similar datasets using metadata | MVP-FR-11 |
| Update and Archive | Authorized users can update and archive datasets | MVP-FR-12 |

## Out of Scope for the Two-Week MVP

These are important, but they should not block the first working version:

- Full ethics review workflow.
- Multiple reviewer roles.
- Restricted dataset access request management.
- Annual compliance reporting.
- Advanced audit dashboards.
- Email notifications.
- Automated backup management.
- AI or machine learning recommendation models.
- External single sign-on.
- Advanced analytics dashboards.
- Preview support for every file type.

## MVP Roles

Keep roles simple for the first release:

| Role | MVP Permissions |
|---|---|
| Guest | View public approved dataset listing and details if allowed |
| User | Upload datasets, view approved datasets, cite, download, update own datasets |
| Admin | Manage users, approve or reject datasets, archive datasets, view audit basics |

Reviewer-specific roles can be added after the MVP.

## MVP Database Tables

Start with the tables needed for the demo:

| Table | Purpose |
|---|---|
| users | Account records |
| roles | Role names |
| user_roles | User-role links |
| datasets | Main dataset metadata and workflow status |
| dataset_files | ZIP file path, size, type, and upload date |
| dataset_versions | Update history |
| audit_logs | Important actions |
| dataset_downloads | Download records |
| dataset_views | Detail-page view records |

Optional if time allows:

| Table | Purpose |
|---|---|
| citations | Store generated citation formats |
| recommendations | Cache recommendation results |

## MVP Status Flow

```text
draft or submitted -> pending -> approved -> archived
                       pending -> rejected
                       approved -> revision
```

For two weeks, keep approval as an admin action. The full ethics and technical review chain can be represented later.

## Recommendation Rule

Use a content-based score:

```text
score = category match + tag overlap + data type match + file format match + description keyword overlap
```

Only recommend approved, non-archived datasets that the current user is allowed to view.

## Demo Acceptance Checklist

- A user can register or be created by an admin.
- A user can log in and log out.
- Protected pages redirect unauthenticated users.
- A user can upload a ZIP file with required metadata.
- An admin can approve a submitted dataset.
- Approved datasets appear in the catalog.
- Catalog supports pagination, search, and filtering.
- Detail pages show metadata, citation, BibTeX, download, and recommendations.
- Authorized users can download ZIP files.
- Authorized users can update or archive datasets.
- Archived datasets are hidden from normal browsing.
- Important actions appear in basic audit logs.
