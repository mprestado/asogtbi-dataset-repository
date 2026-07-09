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

| Method | URI | Controller | Responsibility |
|---|---|---|---|
| GET | `/` | `Home::index` | Shared / any contributor |
| GET | `/login` | `Auth::login` | Shared / any contributor |
| POST | `/login` | `Auth::attemptLogin` | Shared / any contributor |
| GET | `/register` | `Auth::register` | Shared / any contributor |
| POST | `/register` | `Auth::attemptRegister` | Shared / any contributor |
| POST | `/logout` | `Auth::logout` | Shared / any contributor |
| GET | `/dashboard` | `Dashboard::index` | Shared / any contributor |
| GET | `/datasets` | `Datasets::index` | Shared / any contributor |
| GET | `/datasets/{id}` | `Datasets::show` | Shared / any contributor |
| GET | `/datasets/{id}/download` | `Datasets::download` | Shared / any contributor |
| GET | `/datasets/{id}/edit` | `Datasets::edit` | Shared / any contributor |
| POST | `/datasets/{id}/update` | `Datasets::update` | Shared / any contributor |
| POST | `/datasets/{id}/archive` | `Datasets::archive` | Shared / any contributor |
| GET | `/upload` | `DatasetUpload::create` | Shared / any contributor |
| POST | `/upload` | `DatasetUpload::store` | Shared / any contributor |
| GET | `/admin` | `Admin::index` | Shared / any contributor |
| GET | `/admin/users` | `Admin::users` | Shared / any contributor |
| POST | `/admin/users/{id}/activate` | `Admin::activateUser` | Shared / any contributor |
| POST | `/admin/users/{id}/deactivate` | `Admin::deactivateUser` | Shared / any contributor |
| GET | `/admin/datasets` | `Admin::datasets` | Shared / any contributor |
| POST | `/admin/datasets/{id}/approve` | `Admin::approveDataset` | Shared / any contributor |
| POST | `/admin/datasets/{id}/reject` | `Admin::rejectDataset` | Shared / any contributor |
| GET | `/admin/audit-logs` | `Admin::auditLogs` | Shared / any contributor |

## Implementation Notes

- Current controller methods are placeholders.
- Auth and role filters exist, but routes are intentionally open during early MVP development so the team can build pages before Google school-email authentication is wired.
- Admin routes are not currently locked behind `role:admin`; re-enable route filters when authentication becomes part of the implementation sprint.
- File upload pages accept ZIP files in the UI, but server-side validation still needs implementation.
- Uploaded files should stay under `writable/uploads`, not `public/`.
- Migrations give the MVP schema foundation, but teammates can revise fields as implementation details become clearer.
- `MvpSeeder` creates demo accounts and datasets after migrations are available.

## Suggested First Technical Tasks

1. Run and adjust migrations locally.
2. Plan Google school-email authentication, then re-enable `AuthFilter` and `RoleFilter`.
3. Connect the upload form to `DatasetModel` and `DatasetFileModel`.
4. Replace placeholder catalog pages with database queries.
5. Integrate citation and recommendation helpers into the detail page.
6. Keep layout, docs, and demo flow updated as each feature lands.
