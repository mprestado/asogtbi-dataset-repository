# Shared MVP Work Areas

Responsibilities are shared across the team. These work areas exist to keep tasks organized, reduce merge conflicts, and make pull requests easier to review without locking any area to one person.

## Authentication, Roles, and Access Guards

Primary goal: make sure users can securely access the app and only see what their role allows.

SRS coverage:

- MVP-FR-01: login
- MVP-FR-02: logout
- MVP-FR-03: registration or admin-created accounts
- MVP-FR-05: secure password hashing
- MVP-FR-06: unauthorized access prevention
- MVP-FR-08: activate or deactivate accounts

Main deliverables:

- `Auth` controller for login, logout, and registration or account creation.
- `AuthFilter` for protected routes.
- `RoleFilter` for admin-only and authorized-user routes.
- `UserModel`, `RoleModel`, and `UserRoleModel`.
- Basic account status support: active and inactive.
- Seeded admin account for local demo.

Suggested branch:

```text
feature/auth-rbac
```

Acceptance checklist:

- User can log in with email and password.
- User can log out.
- Passwords are hashed.
- Inactive users cannot log in.
- Guest users are redirected away from protected pages.
- Admin-only pages reject non-admin users.

Dependencies:

- Needs database migrations.
- Coordinate route changes with contributors touching the same flow.

## Database, Models, Migrations, and Seed Data

Primary goal: create the data foundation so the rest of the team can build without inventing table structures separately.

SRS coverage:

- MVP dataset metadata requirements
- MVP-FR-07: audit basics
- MVP-FR-09: approved dataset download support
- MVP-FR-12: update/archive storage support

Main deliverables:

- Migrations for `users`, `roles`, `user_roles`, `datasets`, `dataset_files`, `dataset_versions`, `dataset_downloads`, `dataset_views`, and `audit_logs`.
- Models for each MVP table.
- Seeders for roles, admin user, sample users, and sample approved datasets.
- Shared constants for dataset statuses and access types if useful.

Suggested branch:

```text
feature/database-foundation
```

Acceptance checklist:

- `php spark migrate` creates all MVP tables.
- `php spark db:seed` creates demo-ready users and sample datasets.
- Models define allowed fields and validation rules where appropriate.
- Dataset status supports pending, approved, rejected, revision, and archived.
- Seed data is enough for catalog, detail, and recommendation demos.

Dependencies:

- This is the first feature branch to merge.
- Coordinate field names with upload, catalog, detail, citation, and recommendation work.

## Dataset Upload, Approval, Update, and Archive

Primary goal: implement the dataset lifecycle from user submission to admin approval and later update/archive.

SRS coverage:

- Dataset upload and submission
- MVP-FR-12: update and archive
- Admin approval requirement from MVP scope

Main deliverables:

- Dataset upload form and controller.
- Required metadata validation: title, description, tags, category, data type, file format, research title, project head/adviser, source type, and ZIP file.
- ZIP upload validation and protected server-side storage under `writable/uploads`.
- Pending status after submission.
- Admin approve/reject actions.
- Update dataset metadata and optional new ZIP version.
- Archive action that hides datasets from normal browsing.

Suggested branch:

```text
feature/dataset-lifecycle
```

Acceptance checklist:

- Authorized user can submit a dataset.
- Invalid forms show validation errors.
- Non-ZIP uploads are rejected.
- Uploaded files are not stored in `public/`.
- Submitted datasets start as pending.
- Admin can approve or reject submissions.
- Authorized user can update metadata.
- Authorized user can archive a dataset.
- Archived datasets are hidden from the normal catalog.

Dependencies:

- Needs auth/role decisions.
- Needs database tables.
- Coordinate detail-page routes with catalog/detail work.

## Catalog, Search, Filtering, Detail Page, and Download

Primary goal: make approved datasets discoverable and usable.

SRS coverage:

- Dataset browsing
- Dataset search
- Dataset filtering
- Dataset detail page
- MVP-FR-09: download approved datasets

Main deliverables:

- Approved dataset listing page.
- Pagination.
- Search by title, description, tags, and category.
- Filter by data type and category.
- Dataset detail page with complete metadata and research information.
- Download route for approved dataset ZIP files.
- Download authorization checks.
- Dataset view and download logging hooks.

Suggested branch:

```text
feature/catalog-detail-download
```

Acceptance checklist:

- Only approved, non-archived datasets appear in normal browsing.
- Search returns matching approved datasets.
- Filtering works by data type.
- Pagination works.
- Detail page opens from the listing.
- Detail page shows complete metadata.
- Download button serves the ZIP file for authorized users.
- Unauthorized users cannot download protected files.

Dependencies:

- Needs seed data.
- Needs upload/file records.
- Coordinate recommendation placement with detail-page work.

## Citation, BibTeX, and Metadata-Based Recommendations

Primary goal: deliver the SRS-specific repository value: proper citation and similar dataset discovery.

SRS coverage:

- MVP-FR-10: citation and BibTeX
- MVP-FR-11: similar dataset recommendations

Main deliverables:

- `citation_helper.php` for plain citation text and BibTeX.
- Copyable citation and BibTeX UI on the detail page.
- `recommendation_helper.php` or recommendation service for metadata scoring.
- Similar dataset query using category, tags, data type, file format, and description keywords.
- Exclusion of archived, rejected, pending, current, and unauthorized datasets.

Suggested branch:

```text
feature/citation-recommendations
```

Acceptance checklist:

- Every approved dataset detail page can generate citation text.
- Every approved dataset detail page can generate BibTeX.
- Users can copy citation and BibTeX.
- Recommendations show similar approved datasets.
- Recommended datasets are clickable.
- Current dataset is never recommended to itself.
- Archived and pending datasets are not recommended.

Dependencies:

- Needs finalized field names.
- Needs detail page integration.

## UI Integration, QA, Documentation, and Demo Readiness

Primary goal: make the MVP coherent, testable, and presentable.

SRS coverage:

- UI requirements
- Acceptance criteria
- Maintainability requirements

Main deliverables:

- Shared layout views.
- Navigation that changes by role.
- Consistent forms, tables, alerts, and validation messages.
- Manual QA checklist.
- Updated README and setup docs as the implementation changes.
- Demo script and sample credentials.
- Final pass for route names, broken links, empty states, and mobile responsiveness.

Suggested branch:

```text
feature/ui-qa-docs
```

Acceptance checklist:

- Users can move through the demo without knowing route URLs.
- Forms have clear validation messages.
- Empty states are handled.
- Role-specific navigation is visible.
- Documentation matches the actual setup.
- Final demo script is tested from a fresh database seed.

Dependencies:

- Needs integration with all active work areas.
- Should start early with layout and keep updating as features merge.

## Cross-Team Rules

- Do not build future enhancements before the MVP is demoable.
- Use migrations for schema changes.
- Use seeders for demo data.
- Keep uploads out of `public/`.
- Add route names consistently.
- Add basic audit log calls to important actions.
- Write manual test steps in each pull request.
- Merge small pieces instead of waiting for one large pull request.

## Suggested Pairing

| Pairing Area | Reason |
|---|---|
| Auth + Database | Auth depends on user and role tables |
| Upload + Catalog/Detail | Upload records must appear correctly in catalog/detail |
| Detail + Citation/Recommendations | Recommendations and citations live on detail pages |
| UI/QA/Docs + All Work Areas | UI, QA, and docs need current behavior |

## Final Integration

Final integration should be coordinated as a team. Each pull request author remains responsible for fixing bugs introduced by their change.
