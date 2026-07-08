# System Skeleton

This skeleton gives the team real files and routes to implement before the first GitHub push.

## Skeleton Coverage

| Area | Files |
|---|---|
| Routes | `app/Config/Routes.php` |
| Filters | `app/Filters/AuthFilter.php`, `app/Filters/RoleFilter.php` |
| Controllers | `Auth`, `Dashboard`, `Datasets`, `DatasetUpload`, `Admin` |
| Models | `UserModel`, `RoleModel`, `UserRoleModel`, `DatasetModel`, `DatasetFileModel`, `DatasetVersionModel`, `DatasetDownloadModel`, `DatasetViewModel`, `AuditLogModel` |
| Helpers | `citation_helper.php`, `recommendation_helper.php` |
| Migrations | users, roles, user roles, datasets, files, versions, downloads, views, audit logs |
| Seeders | `MvpSeeder` |
| Views | layout, auth, dashboard, dataset, upload, and admin placeholders |

## Route Map

| Method | URI | Controller | Owner |
|---|---|---|---|
| GET | `/` | `Home::index` | Member 6 |
| GET | `/login` | `Auth::login` | Member 1 |
| POST | `/login` | `Auth::attemptLogin` | Member 1 |
| GET | `/register` | `Auth::register` | Member 1 |
| POST | `/register` | `Auth::attemptRegister` | Member 1 |
| POST | `/logout` | `Auth::logout` | Member 1 |
| GET | `/dashboard` | `Dashboard::index` | Member 6 |
| GET | `/datasets` | `Datasets::index` | Member 4 |
| GET | `/datasets/{id}` | `Datasets::show` | Member 4 |
| GET | `/datasets/{id}/download` | `Datasets::download` | Member 4 |
| GET | `/datasets/{id}/edit` | `Datasets::edit` | Member 3 |
| POST | `/datasets/{id}/update` | `Datasets::update` | Member 3 |
| POST | `/datasets/{id}/archive` | `Datasets::archive` | Member 3 |
| GET | `/upload` | `DatasetUpload::create` | Member 3 |
| POST | `/upload` | `DatasetUpload::store` | Member 3 |
| GET | `/admin` | `Admin::index` | Member 6 |
| GET | `/admin/users` | `Admin::users` | Member 1 |
| POST | `/admin/users/{id}/activate` | `Admin::activateUser` | Member 1 |
| POST | `/admin/users/{id}/deactivate` | `Admin::deactivateUser` | Member 1 |
| GET | `/admin/datasets` | `Admin::datasets` | Member 3 |
| POST | `/admin/datasets/{id}/approve` | `Admin::approveDataset` | Member 3 |
| POST | `/admin/datasets/{id}/reject` | `Admin::rejectDataset` | Member 3 |
| GET | `/admin/audit-logs` | `Admin::auditLogs` | Member 6 |

## Implementation Notes

- Current controller methods are placeholders.
- Auth and role filters exist, but routes are intentionally open during early MVP development so the team can build pages before Google school-email authentication is wired.
- Admin routes are not currently locked behind `role:admin`; re-enable route filters when authentication becomes part of the implementation sprint.
- File upload pages accept ZIP files in the UI, but server-side validation still needs implementation.
- Uploaded files should stay under `writable/uploads`, not `public/`.
- Migrations give the MVP schema foundation, but teammates can revise fields as implementation details become clearer.
- `MvpSeeder` creates demo accounts and datasets after migrations are available.

## Suggested First Technical Tasks

1. Member 2 runs and adjusts migrations locally.
2. Member 1 plans Google school-email authentication and then re-enables `AuthFilter` and `RoleFilter`.
3. Member 3 connects upload form to `DatasetModel` and `DatasetFileModel`.
4. Member 4 replaces placeholder catalog pages with database queries.
5. Member 5 integrates citation and recommendation helpers into the detail page.
6. Member 6 keeps layout, docs, and demo flow updated as each feature lands.
