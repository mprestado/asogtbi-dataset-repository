# MVP Task Tracker

This tracker follows the sample workbook structure from `ASOG TBI WebDev Tasks Tracker [DOST-SEI PTP 2026].xlsx`, but the workflow is intentionally UI-first.

The team will first build every view, panel, and state from the mockup while routes remain open. Backend work starts after the visible windows are agreed, which keeps members unblocked, reduces file collisions, and lets everyone work with similar expertise.

## Status Reference

```text
Not Started
In Progress
For Review
Done
Blocked
```

Rules:

- Keep the `T-nnn` task ID in every issue title, branch name, pull request title, and tracker update.
- UI tasks do not wait for backend tasks unless the dependency says so.
- Backend tasks should wire into existing UI surfaces instead of redesigning the screen.
- Move a task to `For Review` only when the code/docs are ready for review.
- Move a task to `Done` only when the `EXPECTED OUTPUT / EVIDENCE` exists.
- If a task is blocked, set `STATUS` to `Blocked` and explain the blocker in `REMARKS`.
- Pull requests should target `develop`, not `main`.

## Suggested Issue Title Format

```text
T-021 Build catalog window from mockup
T-055 Create dataset migrations
T-074 Wire catalog search and filters
```

## Suggested Branch Format

```text
feature/T-021-catalog-window
feature/T-055-dataset-migrations
fix/T-087-upload-validation
docs/T-095-demo-script
```

## Phase Plan

| Phase | Focus | Goal |
|---|---|---|
| 1 | Repository and setup | Everyone can work from forks and open routes. |
| 2 | Mockup and UI system | Agree on shared layout, components, and states. |
| 3 | Windows and panels | Build every visible page/panel before backend wiring. |
| 4 | Backend foundation | Add migrations, models, seeders, and shared services. |
| 5 | Backend wiring | Connect the existing UI to real data and actions. |
| 6 | Integration and demo | Test the full MVP and document remaining gaps. |

## Task Tracker

| TASK ID | CATEGORY | PRIORITY | TASK DESCRIPTION | RESPONSIBILITY | START DATE | TARGET DATE | DEADLINE | DAYS LEFT | STATUS | DATE DONE | DEPENDENCY / PREREQUISITE | FILE / FOLDER LINK | EXPECTED OUTPUT / EVIDENCE | REMARKS | LAST UPDATED |
|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|---|
| `T-001` | Repository Setup | High | Confirm every member can access the GitHub repository. | Shared / unassigned | 2026-07-08 | 2026-07-08 | 2026-07-09 | Update manually | Not Started |  | None | GitHub repository | All 6 members can view the repository. |  | 2026-07-08 |
| `T-002` | Repository Setup | High | Protect the `main` branch on GitHub. | Shared / unassigned | 2026-07-08 | 2026-07-08 | 2026-07-09 | Update manually | Not Started |  | `T-001` | GitHub branch settings | Direct pushes to `main` are blocked. | Require pull requests. | 2026-07-08 |
| `T-003` | Repository Setup | High | Create the `develop` branch from `main`. | Shared / unassigned | 2026-07-08 | 2026-07-08 | 2026-07-09 | Update manually | Not Started |  | `T-001` | GitHub branches | `develop` exists and is the integration branch. |  | 2026-07-08 |
| `T-004` | Repository Setup | High | Create GitHub labels, milestones, and project board columns. | Shared / unassigned | 2026-07-08 | 2026-07-09 | 2026-07-09 | Update manually | Not Started |  | `T-003` | `docs/GITHUB_PROJECT_BOARD.md` | Board has Backlog, Ready, In Progress, In Review, Testing, Done, and Blocked. |  | 2026-07-08 |
| `T-005` | Repository Setup | High | Convert this `TASKS.md` tracker into GitHub Issues or Project cards. | Shared / unassigned | 2026-07-08 | 2026-07-09 | 2026-07-09 | Update manually | Not Started |  | `T-004` | `TASKS.md`, GitHub Issues | Each task has a matching card or issue. | Keep `T-nnn` in titles. | 2026-07-08 |
| `T-006` | Repository Setup | High | Each member forks, clones, adds `upstream`, and creates their first feature branch. | Shared / all | 2026-07-08 | 2026-07-09 | 2026-07-10 | Update manually | Not Started |  | `T-003` | Local Git remotes | Everyone can push to their own fork and open PRs to `develop`. |  | 2026-07-08 |
| `T-007` | Environment Setup | High | Verify PHP 8.2+, Composer, and MySQL setup. | Shared / all | 2026-07-08 | 2026-07-09 | 2026-07-10 | Update manually | Not Started |  | `T-006` | Local terminal | Each member can run `php -v`, `composer install`, and access MySQL. |  | 2026-07-08 |
| `T-008` | Environment Setup | High | Create local `.env`, configure database credentials, and start the app. | Shared / all | 2026-07-08 | 2026-07-09 | 2026-07-10 | Update manually | Not Started |  | `T-007` | `.env.example`, local browser | App opens locally with routes reachable without login. | Do not commit `.env`. | 2026-07-08 |
| `T-009` | Environment Setup | Medium | Confirm open development routing works for dashboard, datasets, upload, and admin pages. | Shared / unassigned | 2026-07-09 | 2026-07-09 | 2026-07-10 | Update manually | Not Started |  | `T-008` | `app/Config/Routes.php` | Builders can open all skeleton views without login. | Auth comes later. | 2026-07-08 |
| `T-010` | Mockup Alignment | High | Collect or link the approved mockup source. | Shared / all | 2026-07-09 | 2026-07-09 | 2026-07-10 | Update manually | Not Started |  | `T-006` | Mockup file/link | Team has one source of truth for UI screens. | Mockup can be Figma, image, PDF, or local file. | 2026-07-08 |
| `T-011` | Mockup Alignment | High | List every required MVP window from the mockup. | Shared / all | 2026-07-09 | 2026-07-09 | 2026-07-10 | Update manually | Not Started |  | `T-010` | `TASKS.md` or UI notes | Team agrees on the page/window inventory. | Avoid inventing extra screens. | 2026-07-08 |
| `T-012` | Mockup Alignment | High | List every reusable panel/component from the mockup. | Shared / all | 2026-07-09 | 2026-07-09 | 2026-07-10 | Update manually | Not Started |  | `T-010` | UI notes | Shared components are identified before building. | Cards, tables, forms, alerts, buttons, states. | 2026-07-08 |
| `T-013` | Mockup Alignment | High | List required UI states for each window. | Shared / all | 2026-07-09 | 2026-07-10 | 2026-07-10 | Update manually | Not Started |  | `T-011`, `T-012` | UI notes | Empty, loading, error, success, validation, disabled, and populated states are listed. | Keep state names consistent. | 2026-07-08 |
| `T-014` | UI Foundation | High | Adapt CSS tokens to match the mockup while preserving the ASOG design direction. | Shared / unassigned | 2026-07-09 | 2026-07-10 | 2026-07-10 | Update manually | Not Started |  | `T-010` | `public/assets/css/app.css` | Colors, spacing, type, radius, and basic states match mockup direction closely enough for MVP. | Do not over-polish before screens exist. | 2026-07-08 |
| `T-015` | UI Foundation | High | Build or refine the shared app shell: header, nav, main container, footer. | Shared / unassigned | 2026-07-09 | 2026-07-10 | 2026-07-10 | Update manually | Not Started |  | `T-014` | `app/Views/layouts/main.php` | All pages use one consistent layout shell. | Keep nav open during UI sprint. | 2026-07-08 |
| `T-016` | UI Foundation | High | Define shared button, link, badge, tag, and status styles. | Shared / unassigned | 2026-07-10 | 2026-07-10 | 2026-07-13 | Update manually | Not Started |  | `T-014` | `public/assets/css/app.css` | Action controls and small labels are visually consistent. |  | 2026-07-08 |
| `T-017` | UI Foundation | High | Define shared form field, validation, helper text, and file input styles. | Shared / unassigned | 2026-07-10 | 2026-07-10 | 2026-07-13 | Update manually | Not Started |  | `T-014` | `public/assets/css/app.css` | Forms can show normal, focus, error, disabled, and success states. |  | 2026-07-08 |
| `T-018` | UI Foundation | High | Define shared card, panel, table, toolbar, and modal/drawer styles. | Shared / unassigned | 2026-07-10 | 2026-07-10 | 2026-07-13 | Update manually | Not Started |  | `T-014` | `public/assets/css/app.css` | Reusable display surfaces are ready for page builders. |  | 2026-07-08 |
| `T-019` | UI Foundation | Medium | Add placeholder partials or conventions for repeated UI pieces if needed. | Shared / unassigned | 2026-07-10 | 2026-07-10 | 2026-07-13 | Update manually | Not Started |  | `T-018` | `app/Views/` | Repeated components are easy to reuse without copy-paste chaos. | Only add partials if helpful. | 2026-07-08 |
| `T-020` | UI Foundation | Medium | Document UI implementation rules for mockup-following work. | Shared / unassigned | 2026-07-10 | 2026-07-10 | 2026-07-13 | Update manually | Not Started |  | `T-014` | `docs/DESIGN_ADAPTATION.md`, `SETUP.md` | Team knows which classes/components to reuse. |  | 2026-07-08 |
| `T-021` | UI Window | High | Build dashboard/home window from the mockup. | Shared / unassigned | 2026-07-10 | 2026-07-13 | 2026-07-13 | Update manually | Not Started |  | `T-015`, `T-016`, `T-018` | `app/Views/dashboard/index.php` | Dashboard has final-ish layout with placeholder data. | No backend dependency. | 2026-07-08 |
| `T-022` | UI Window | High | Build dataset catalog window from the mockup. | Shared / unassigned | 2026-07-10 | 2026-07-13 | 2026-07-13 | Update manually | Not Started |  | `T-015`, `T-016`, `T-018` | `app/Views/datasets/index.php` | Catalog page shows search, filters, list/cards/table, pagination placeholder, and sample items. | No backend dependency. | 2026-07-08 |
| `T-023` | UI Window | High | Build dataset detail window from the mockup. | Shared / unassigned | 2026-07-10 | 2026-07-13 | 2026-07-13 | Update manually | Not Started |  | `T-015`, `T-016`, `T-018` | `app/Views/datasets/show.php` | Detail page shows metadata, file info, citation area, download action, and recommendation area with placeholder data. | No backend dependency. | 2026-07-08 |
| `T-024` | UI Window | High | Build dataset upload/submission window from the mockup. | Shared / unassigned | 2026-07-10 | 2026-07-13 | 2026-07-13 | Update manually | Not Started |  | `T-015`, `T-017`, `T-018` | `app/Views/upload/create.php` | Upload form has all required metadata fields and ZIP file area. | No backend dependency. | 2026-07-08 |
| `T-025` | UI Window | High | Build dataset edit/update window from the mockup. | Shared / unassigned | 2026-07-10 | 2026-07-13 | 2026-07-13 | Update manually | Not Started |  | `T-015`, `T-017`, `T-018` | `app/Views/datasets/edit.php` | Edit form supports metadata update, optional file version area, and archive action placeholder. | No backend dependency. | 2026-07-08 |
| `T-026` | UI Window | High | Build admin dashboard window from the mockup. | Shared / unassigned | 2026-07-10 | 2026-07-13 | 2026-07-13 | Update manually | Not Started |  | `T-015`, `T-016`, `T-018` | `app/Views/admin/index.php` | Admin landing page links to approval, users, and audit sections with placeholder metrics. | No backend dependency. | 2026-07-08 |
| `T-027` | UI Window | High | Build admin dataset approval window from the mockup. | Shared / unassigned | 2026-07-13 | 2026-07-14 | 2026-07-14 | Update manually | Not Started |  | `T-018`, `T-026` | `app/Views/admin/datasets.php` | Pending dataset list, status chips, review details, approve/reject actions, and empty state are visible. | No backend dependency. | 2026-07-08 |
| `T-028` | UI Window | Medium | Build admin user management window from the mockup. | Shared / unassigned | 2026-07-13 | 2026-07-14 | 2026-07-14 | Update manually | Not Started |  | `T-018`, `T-026` | `app/Views/admin/users.php` | User list, status controls, role labels, and empty state are visible. | No backend dependency. | 2026-07-08 |
| `T-029` | UI Window | Medium | Build admin audit logs window from the mockup. | Shared / unassigned | 2026-07-13 | 2026-07-14 | 2026-07-14 | Update manually | Not Started |  | `T-018`, `T-026` | `app/Views/admin/audit_logs.php` | Audit table, filters placeholder, and empty state are visible. | No backend dependency. | 2026-07-08 |
| `T-030` | UI Window | Low | Build login/sign-in placeholder window for future Google school-email auth. | Shared / unassigned | 2026-07-13 | 2026-07-14 | 2026-07-14 | Update manually | Not Started |  | `T-015`, `T-017` | `app/Views/auth/login.php` | Login page communicates future Google school-email sign-in. | Not required to block other views. | 2026-07-08 |
| `T-031` | UI Window | Low | Remove or soften password registration UI if Google auth is expected. | Shared / unassigned | 2026-07-13 | 2026-07-14 | 2026-07-14 | Update manually | Not Started |  | `T-030` | `app/Views/auth/register.php` | Registration page does not imply a final password auth flow if the team will use Google emails. |  | 2026-07-08 |
| `T-032` | UI State | High | Add empty states for catalog, recommendations, admin approval, users, and audit logs. | Shared / unassigned | 2026-07-13 | 2026-07-14 | 2026-07-15 | Update manually | Not Started |  | `T-022`, `T-023`, `T-027`, `T-028`, `T-029` | `app/Views/` | Every list-like surface has an empty state. |  | 2026-07-08 |
| `T-033` | UI State | High | Add validation/error states for upload and edit forms. | Shared / unassigned | 2026-07-13 | 2026-07-14 | 2026-07-15 | Update manually | Not Started |  | `T-024`, `T-025`, `T-017` | `app/Views/upload/create.php`, `app/Views/datasets/edit.php` | Required field errors and file type errors are visible as mock states. | Backend wires later. | 2026-07-08 |
| `T-034` | UI State | Medium | Add loading/skeleton states for data-heavy windows. | Shared / unassigned | 2026-07-14 | 2026-07-15 | 2026-07-15 | Update manually | Not Started |  | `T-022`, `T-023`, `T-027`, `T-029` | `app/Views/`, `public/assets/css/app.css` | Catalog, detail, approval, and audit windows have a loading pattern. | Static mock state is enough. | 2026-07-08 |
| `T-035` | UI State | High | Add success/confirmation states for upload, approval, update, archive, and download actions. | Shared / unassigned | 2026-07-14 | 2026-07-15 | 2026-07-15 | Update manually | Not Started |  | `T-024`, `T-025`, `T-027` | `app/Views/`, `public/assets/css/app.css` | Users can see what success looks like before backend actions exist. |  | 2026-07-08 |
| `T-036` | UI State | High | Add blocked/disabled states for unavailable actions. | Shared / unassigned | 2026-07-14 | 2026-07-15 | 2026-07-15 | Update manually | Not Started |  | `T-016`, `T-017`, `T-018` | `app/Views/`, `public/assets/css/app.css` | Disabled buttons, unavailable downloads, and restricted action labels are styled. | Auth is later, but states can be shown. | 2026-07-08 |
| `T-037` | UI Integration | High | Review all UI windows together and align names, routes, labels, and actions. | Shared / all | 2026-07-15 | 2026-07-15 | 2026-07-16 | Update manually | Not Started |  | `T-021` to `T-036` | Browser screenshots, `app/Views/` | No duplicate labels, broken nav links, or obviously inconsistent panels. | Team review task. | 2026-07-08 |
| `T-038` | UI Integration | Medium | Check responsive layout for all MVP windows. | Shared / all | 2026-07-15 | 2026-07-16 | 2026-07-16 | Update manually | Not Started |  | `T-037` | Browser screenshots | Desktop and mobile views are usable. |  | 2026-07-08 |
| `T-039` | UI Integration | Medium | Create screenshot evidence for every final UI window/state. | Shared / all | 2026-07-15 | 2026-07-16 | 2026-07-16 | Update manually | Not Started |  | `T-038` | PR screenshots or shared folder | Mockup implementation can be reviewed before backend starts. |  | 2026-07-08 |
| `T-040` | UI Integration | High | Freeze UI route and view names for backend wiring. | Shared / all | 2026-07-16 | 2026-07-16 | 2026-07-16 | Update manually | Not Started |  | `T-039` | `app/Config/Routes.php`, `app/Views/` | Backend members know exactly which view files and route names to wire. | Avoid late UI renames after this. | 2026-07-08 |
| `T-041` | Backend Foundation | High | Review MVP schema against completed UI fields. | Shared / unassigned | 2026-07-16 | 2026-07-16 | 2026-07-17 | Update manually | Not Started |  | `T-040` | `Database-Repo-SRS.md`, `app/Database/Migrations/`, UI screenshots | Schema supports the visible UI fields. | Backend starts here. | 2026-07-08 |
| `T-042` | Backend Foundation | High | Finalize users, roles, and user-role migrations. | Shared / unassigned | 2026-07-16 | 2026-07-17 | 2026-07-17 | Update manually | Not Started |  | `T-041` | `app/Database/Migrations/` | User and role tables support future Google email identity and admin/user role assignment. |  | 2026-07-08 |
| `T-043` | Backend Foundation | High | Finalize dataset, file, and version migrations. | Shared / unassigned | 2026-07-16 | 2026-07-17 | 2026-07-17 | Update manually | Not Started |  | `T-041` | `app/Database/Migrations/` | Dataset tables support upload, catalog, detail, update, and archive UI fields. |  | 2026-07-08 |
| `T-044` | Backend Foundation | Medium | Finalize view, download, and audit-log migrations. | Shared / unassigned | 2026-07-16 | 2026-07-17 | 2026-07-17 | Update manually | Not Started |  | `T-041` | `app/Database/Migrations/` | Tracking tables support MVP accountability and metrics. |  | 2026-07-08 |
| `T-045` | Backend Foundation | High | Add model validation rules for users, datasets, files, versions, downloads, views, and audit logs. | Shared / unassigned | 2026-07-17 | 2026-07-17 | 2026-07-18 | Update manually | Not Started |  | `T-042`, `T-043`, `T-044` | `app/Models/` | Models reject invalid MVP data. |  | 2026-07-08 |
| `T-046` | Backend Foundation | High | Update `MvpSeeder` to match finalized UI and schema. | Shared / unassigned | 2026-07-17 | 2026-07-18 | 2026-07-18 | Update manually | Not Started |  | `T-045` | `app/Database/Seeds/MvpSeeder.php` | Seed data makes every UI window look populated. |  | 2026-07-08 |
| `T-047` | Backend Foundation | High | Run migrations and seeders from a clean local database. | Shared / unassigned | 2026-07-18 | 2026-07-18 | 2026-07-18 | Update manually | Not Started |  | `T-046` | Local database | Fresh database setup works. |  | 2026-07-08 |
| `T-048` | Backend Foundation | Medium | Document seed data and local demo assumptions. | Shared / unassigned | 2026-07-18 | 2026-07-18 | 2026-07-18 | Update manually | Not Started |  | `T-047` | `SETUP.md` or demo notes | Team knows what sample data exists and why. | Do not commit real credentials. | 2026-07-08 |
| `T-049` | Backend Wiring | High | Wire dashboard window to seed/demo metrics. | Shared / unassigned | 2026-07-18 | 2026-07-20 | 2026-07-20 | Update manually | Not Started |  | `T-021`, `T-047` | `app/Controllers/Dashboard.php`, `app/Views/dashboard/index.php` | Dashboard displays real or seeded counts. |  | 2026-07-08 |
| `T-050` | Backend Wiring | High | Wire catalog window to approved dataset records. | Shared / unassigned | 2026-07-18 | 2026-07-20 | 2026-07-20 | Update manually | Not Started |  | `T-022`, `T-047` | `app/Controllers/Datasets.php`, `app/Views/datasets/index.php` | Catalog shows approved, non-archived datasets from database. |  | 2026-07-08 |
| `T-051` | Backend Wiring | High | Wire catalog search, filters, and pagination. | Shared / unassigned | 2026-07-20 | 2026-07-20 | 2026-07-21 | Update manually | Not Started |  | `T-050` | `app/Controllers/Datasets.php`, `app/Views/datasets/index.php` | Search, data type filter, and pagination work together. |  | 2026-07-08 |
| `T-052` | Backend Wiring | High | Wire dataset detail window to real dataset metadata. | Shared / unassigned | 2026-07-18 | 2026-07-20 | 2026-07-20 | Update manually | Not Started |  | `T-023`, `T-047` | `app/Controllers/Datasets.php`, `app/Views/datasets/show.php` | Detail page displays real metadata, research info, and file info. |  | 2026-07-08 |
| `T-053` | Backend Wiring | Medium | Record dataset detail views. | Shared / unassigned | 2026-07-20 | 2026-07-20 | 2026-07-21 | Update manually | Not Started |  | `T-052` | `app/Models/DatasetViewModel.php` | Opening detail page records a view. |  | 2026-07-08 |
| `T-054` | Backend Wiring | High | Wire upload form to server-side validation. | Shared / unassigned | 2026-07-18 | 2026-07-20 | 2026-07-20 | Update manually | Not Started |  | `T-024`, `T-045` | `app/Controllers/DatasetUpload.php` | Required metadata and ZIP validation run on submit. |  | 2026-07-08 |
| `T-055` | Backend Wiring | High | Store uploaded ZIP files outside `public/`. | Shared / unassigned | 2026-07-20 | 2026-07-20 | 2026-07-21 | Update manually | Not Started |  | `T-054` | `writable/uploads/`, `app/Controllers/DatasetUpload.php` | ZIP files save under `writable/uploads/datasets`. | Uploaded files remain ignored by Git. | 2026-07-08 |
| `T-056` | Backend Wiring | High | Create pending dataset, file, and initial version records after upload. | Shared / unassigned | 2026-07-20 | 2026-07-21 | 2026-07-21 | Update manually | Not Started |  | `T-055` | `app/Models/DatasetModel.php`, `app/Models/DatasetFileModel.php`, `app/Models/DatasetVersionModel.php` | Upload creates database records with `pending` status. |  | 2026-07-08 |
| `T-057` | Backend Wiring | High | Wire admin approval list to pending datasets. | Shared / unassigned | 2026-07-18 | 2026-07-20 | 2026-07-20 | Update manually | Not Started |  | `T-027`, `T-047` | `app/Controllers/Admin.php`, `app/Views/admin/datasets.php` | Admin approval window lists pending submissions. | Auth is still optional during dev. | 2026-07-08 |
| `T-058` | Backend Wiring | High | Implement approve and reject actions. | Shared / unassigned | 2026-07-20 | 2026-07-21 | 2026-07-21 | Update manually | Not Started |  | `T-057` | `app/Controllers/Admin.php` | Admin can change dataset status to approved or rejected. |  | 2026-07-08 |
| `T-059` | Backend Wiring | Medium | Store approval metadata and action feedback. | Shared / unassigned | 2026-07-20 | 2026-07-21 | 2026-07-21 | Update manually | Not Started |  | `T-058` | `app/Models/DatasetModel.php`, `app/Views/admin/datasets.php` | Approved datasets track approver/time and show feedback. |  | 2026-07-08 |
| `T-060` | Backend Wiring | High | Implement approved ZIP download response. | Shared / unassigned | 2026-07-20 | 2026-07-21 | 2026-07-21 | Update manually | Not Started |  | `T-052`, `T-055` | `app/Controllers/Datasets.php` | Approved dataset ZIP downloads correctly. |  | 2026-07-08 |
| `T-061` | Backend Wiring | Medium | Block download for unavailable dataset states. | Shared / unassigned | 2026-07-20 | 2026-07-21 | 2026-07-21 | Update manually | Not Started |  | `T-060` | `app/Controllers/Datasets.php` | Pending, rejected, archived, or missing-file downloads fail cleanly. | Auth-based restrictions come later. | 2026-07-08 |
| `T-062` | Backend Wiring | Medium | Record downloads in `dataset_downloads` and audit logs. | Shared / unassigned | 2026-07-20 | 2026-07-21 | 2026-07-21 | Update manually | Not Started |  | `T-060` | `app/Models/DatasetDownloadModel.php`, `app/Models/AuditLogModel.php` | Download action creates tracking rows. |  | 2026-07-08 |
| `T-063` | Backend Wiring | High | Finalize citation and BibTeX helper output. | Shared / unassigned | 2026-07-21 | 2026-07-21 | 2026-07-22 | Update manually | Not Started |  | `T-052` | `app/Helpers/citation_helper.php` | Detail page can generate useful citation and BibTeX text. |  | 2026-07-08 |
| `T-064` | Backend Wiring | Medium | Wire copy citation and copy BibTeX UI feedback. | Shared / unassigned | 2026-07-21 | 2026-07-22 | 2026-07-22 | Update manually | Not Started |  | `T-063`, `T-035` | `app/Views/datasets/show.php`, `public/assets/` | Copy actions work and show feedback. |  | 2026-07-08 |
| `T-065` | Backend Wiring | High | Finalize recommendation scoring helper. | Shared / unassigned | 2026-07-21 | 2026-07-21 | 2026-07-22 | Update manually | Not Started |  | `T-052` | `app/Helpers/recommendation_helper.php` | Score uses category, tags, data type, file format, and description keywords. |  | 2026-07-08 |
| `T-066` | Backend Wiring | High | Query and display recommended datasets on detail page. | Shared / unassigned | 2026-07-21 | 2026-07-22 | 2026-07-22 | Update manually | Not Started |  | `T-065` | `app/Controllers/Datasets.php`, `app/Views/datasets/show.php` | Similar approved datasets appear and are clickable. | Exclude current and archived datasets. | 2026-07-08 |
| `T-067` | Backend Wiring | High | Wire edit window to existing dataset values. | Shared / unassigned | 2026-07-21 | 2026-07-22 | 2026-07-22 | Update manually | Not Started |  | `T-025`, `T-052` | `app/Controllers/Datasets.php`, `app/Views/datasets/edit.php` | Edit form is prefilled from database. |  | 2026-07-08 |
| `T-068` | Backend Wiring | High | Save metadata updates from edit window. | Shared / unassigned | 2026-07-21 | 2026-07-22 | 2026-07-22 | Update manually | Not Started |  | `T-067` | `app/Controllers/Datasets.php`, `app/Models/DatasetModel.php` | Valid metadata updates persist. |  | 2026-07-08 |
| `T-069` | Backend Wiring | Medium | Support optional new ZIP version during update. | Shared / unassigned | 2026-07-21 | 2026-07-22 | 2026-07-22 | Update manually | Not Started |  | `T-068` | `app/Models/DatasetFileModel.php`, `app/Models/DatasetVersionModel.php` | New file version and version history are recorded. |  | 2026-07-08 |
| `T-070` | Backend Wiring | High | Implement archive action. | Shared / unassigned | 2026-07-21 | 2026-07-22 | 2026-07-22 | Update manually | Not Started |  | `T-025`, `T-052` | `app/Controllers/Datasets.php` | Dataset can be archived and hidden from catalog/recommendations. | Auth access rules come later. | 2026-07-08 |
| `T-071` | Backend Wiring | Medium | Record upload, approval, update, archive, view, and download audit entries. | Shared / unassigned | 2026-07-21 | 2026-07-22 | 2026-07-22 | Update manually | Not Started |  | `T-056`, `T-059`, `T-062`, `T-068`, `T-070` | `app/Models/AuditLogModel.php` | Main actions create audit rows. |  | 2026-07-08 |
| `T-072` | Backend Wiring | Medium | Wire audit-log admin window to real audit records. | Shared / unassigned | 2026-07-22 | 2026-07-22 | 2026-07-23 | Update manually | Not Started |  | `T-071`, `T-029` | `app/Controllers/Admin.php`, `app/Views/admin/audit_logs.php` | Admin audit window shows real actions. |  | 2026-07-08 |
| `T-073` | Backend Wiring | Medium | Wire user-management admin window to real user records. | Shared / unassigned | 2026-07-22 | 2026-07-22 | 2026-07-23 | Update manually | Not Started |  | `T-028`, `T-042` | `app/Controllers/Admin.php`, `app/Views/admin/users.php` | User window shows seeded or real users. | Activate/deactivate may wait for auth. | 2026-07-08 |
| `T-074` | Authentication | Low | Decide final Google school-email authentication approach. | Shared / unassigned | 2026-07-22 | 2026-07-22 | 2026-07-24 | Update manually | Not Started |  | `T-040` | Private notes, `SETUP.md` | Team knows if auth uses Google OAuth, domain allowlist, or school-provided account flow. | Keep low priority unless required for demo. | 2026-07-08 |
| `T-075` | Authentication | Low | Document required Google credentials, redirect URI, and allowed email domain rules. | Shared / unassigned | 2026-07-22 | 2026-07-23 | 2026-07-24 | Update manually | Not Started |  | `T-074` | Private notes, `.env.example` if placeholders are safe | Auth setup requirements are clear without committing secrets. | Do not commit client secrets. | 2026-07-08 |
| `T-076` | Authentication | Low | Implement Google sign-in entry point if credentials are available. | Shared / unassigned | 2026-07-23 | 2026-07-24 | 2026-07-24 | Update manually | Not Started |  | `T-075` | `app/Controllers/Auth.php`, `app/Views/auth/login.php` | User can start the school-email login flow. | Can move to future if credentials are not ready. | 2026-07-08 |
| `T-077` | Authentication | Low | Re-enable `AuthFilter` and `RoleFilter` after authentication works. | Shared / unassigned | 2026-07-23 | 2026-07-24 | 2026-07-24 | Update manually | Not Started |  | `T-076` | `app/Config/Routes.php`, `app/Filters/` | Protected routes and admin routes are locked only after auth is functional. | Do not block UI/backend demo if auth is not ready. | 2026-07-08 |
| `T-078` | Integration QA | High | Run full UI navigation pass with backend connected. | Shared / all | 2026-07-22 | 2026-07-23 | 2026-07-23 | Update manually | Not Started |  | `T-049` to `T-073` | Browser screenshots | All windows open, navigate, and display connected data. |  | 2026-07-08 |
| `T-079` | Integration QA | High | Run full dataset happy path from fresh seed. | Shared / all | 2026-07-22 | 2026-07-23 | 2026-07-23 | Update manually | Not Started |  | `T-078` | QA notes | Upload, approve, browse, detail, cite, download, update, archive flow works. | Critical final demo test. | 2026-07-08 |
| `T-080` | Integration QA | High | Test invalid and edge states. | Shared / all | 2026-07-23 | 2026-07-23 | 2026-07-24 | Update manually | Not Started |  | `T-079` | QA notes | Missing fields, non-ZIP upload, no catalog results, missing file, and no recommendations are handled. |  | 2026-07-08 |
| `T-081` | Integration QA | Medium | Test responsive layout after backend data is connected. | Shared / all | 2026-07-23 | 2026-07-23 | 2026-07-24 | Update manually | Not Started |  | `T-079` | Screenshots | Real data does not break mobile or desktop layout. |  | 2026-07-08 |
| `T-082` | Integration QA | Medium | Fix route, label, and copy mismatches found during demo rehearsal. | Shared / all | 2026-07-23 | 2026-07-24 | 2026-07-24 | Update manually | Not Started |  | `T-078`, `T-079`, `T-080` | `app/Views/`, `app/Controllers/` | Demo path feels coherent and no obvious placeholder copy remains. |  | 2026-07-08 |
| `T-083` | Documentation | Medium | Update `README.md`, `SETUP.md`, and tracker notes to match final MVP behavior. | Shared / unassigned | 2026-07-24 | 2026-07-24 | 2026-07-24 | Update manually | Not Started |  | `T-082` | `README.md`, `SETUP.md`, `TASKS.md` | Documentation matches the actual app behavior. |  | 2026-07-08 |
| `T-084` | Documentation | Medium | Write final demo script. | Shared / unassigned | 2026-07-24 | 2026-07-24 | 2026-07-24 | Update manually | Not Started |  | `T-083` | Demo notes | Team has a step-by-step final demo flow. |  | 2026-07-08 |
| `T-085` | Documentation | Medium | List known limitations and future enhancements. | Shared / unassigned | 2026-07-24 | 2026-07-24 | 2026-07-24 | Update manually | Not Started |  | `T-084` | README or demo notes | MVP gaps are honest and documented. |  | 2026-07-08 |
| `T-086` | Release | Medium | Tag the final demo-ready commit. | Shared / unassigned | 2026-07-24 | 2026-07-24 | 2026-07-24 | Update manually | Not Started |  | `T-085` | Git tag | Git tag marks the demo version. | Tag only after team approval. | 2026-07-08 |

## Dashboard Summary Template

Use this if the team wants tracker totals in GitHub or a spreadsheet dashboard.

| Metric | Value |
|---|---|
| Total Tasks | 86 |
| UI-first Tasks | 31 |
| Backend Foundation Tasks | 8 |
| Backend Wiring Tasks | 25 |
| Auth Tasks | 4 |
| Integration / Docs / Release Tasks | 18 |
| Tasks Done | 0 |
| Tasks In Progress | 0 |
| Tasks For Review | 0 |
| Tasks Not Started | 86 |
| Tasks Blocked | 0 |
