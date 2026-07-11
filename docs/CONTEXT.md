---
name: "ASOG TBI Dataset Repository — Context"
project: "ASOG TBI Dataset Repository — public + user-facing website"
stack: "CodeIgniter 4 (PHP) + MySQL, MVC architecture"
source: "Distilled from Database-Repo-SRS.md — that document is the full spec; this file is the build-ready summary an agent should check first."
---

## What this is

A centralized, web-based institutional dataset repository for **Camarines Sur Polytechnic Colleges (CSPC)** and the **ASOG Technology Business Incubator (ASOG TBI)**. It lets students, faculty researchers, advisers, and incubatees discover, cite, download, and contribute datasets used for thesis, capstone, research, AI/ML, analytics, and startup development.

It's a ground-up rebuild (CodeIgniter 4 + MySQL) of an existing Django prototype. The prototype is the **functional and visual reference**, not code to port — it already demonstrates dataset browsing with pagination, data-type filtering, dataset detail pages, citation/BibTeX generation, download, upload, update, archive, and similar-dataset recommendations.

**This repository is the public + user-facing website only.** Dataset moderation, user/role management, audit logs, and backups are handled by a **separate Admin Portal application** — a different codebase, different screens, out of scope here. See the callout below before building anything that touches approval or administration.

> ### Out of scope — Admin Portal (do not build here)
> The SRS describes Ethics Reviewer, Technical Reviewer, ASOG TBI Staff, and Repository Administrator roles, plus review dashboards, approval queues, user management, audit-log viewers, backup controls, and compliance reports. **All of that belongs to a separate Admin Portal, not this website.** This repo has no admin login, no admin dashboard, no approve/reject controls, and no user-management UI. If a task description implies any of these, stop and flag it rather than building it here.
>
> This site and the Admin Portal share the same MySQL database — a dataset's `status` changes when someone approves/rejects it in the Admin Portal, and this website simply reads and displays that status. It never writes to it directly (beyond a contributor creating a new submission, which always starts at **Pending Review**).

**Golden rule for any agent working on this repo:** build the MVP list below completely and correctly, keep everything Admin-Portal-shaped out, and don't drift into future-enhancement territory either.

## Screens in scope for this website

| Screen | Notes |
|---|---|
| **Home** | Marketing/landing page — hero, "what you can find here," domains, footer |
| **Login** | Email/password login, "Forgot password?", link to Register |
| **Register** | Self-registration or invite-based, per FR-003 |
| **Browse / Search Results** | Catalog of Published datasets, search bar, filter sidebar, pagination |
| **Dataset Detail** | Full metadata, citation/BibTeX, download, recommendations |
| **Upload Dataset** | Guided multi-section form, ends in Pending Review |
| **Update Dataset** | Same form, pre-filled, for the contributor's own dataset |
| **My Datasets** | A logged-in user's own submissions with status chips |

**Not in scope here** (Admin Portal): Review/Approval Dashboard, Admin Dashboard, User Management, Audit Logs, Backups, Reports, Access-Request Approval.

## MVP scope — build this

| Area | What's included |
|---|---|
| **Auth** | Email/password login & logout, registration or admin-created accounts, password reset, hashed passwords, protected-page access control |
| **Roles** | Guest and User only — see [User roles](#user-roles-mvp) below |
| **Browsing** | Homepage/catalog of Published datasets with pagination |
| **Search** | Keyword search across title, description, tags, category |
| **Filtering** | By data type, file format, category, date uploaded — modern sidebar UI (see `DESIGN.md`) |
| **Detail page** | Full metadata, research info, source/reference, status (owner view only), recommendations, and action buttons (cite, download — role-dependent) |
| **Upload** | Guided form: dataset info, research info, source info, ZIP file upload; saves as **Pending Review** |
| **Dataset status** | Read-only in this app — statuses are set by the Admin Portal; this site displays the current state via status chips |
| **Citation** | Plain-text citation + BibTeX generation, with copy buttons |
| **Download** | ZIP download for Published datasets, download logged |
| **Update** | Contributors can edit their own dataset's metadata and upload a new file version |
| **Archive (self-service)** | A contributor can archive their own dataset from My Datasets; full admin-side archive/restore tooling lives in the Admin Portal |
| **Recommendations** | Content-based, metadata-similarity recommendations (see [Recommendation system](#recommendation-system)) |

## Explicitly future — do not build yet (anywhere)

These are named in the SRS as **Future Enhancement Requirements (FE-FR-01–07)** — features nobody has built yet, in this repo or the Admin Portal:

- **Full ethics & privacy review workflow** — a dedicated Ethics Reviewer stage separate from a single approval step
- **Multiple reviewer roles** — separate Ethics Reviewer and Technical Reviewer roles/queues (FR-069–088 in the full SRS describe this two-stage flow; treat it as the *long-term* design, not the current build)
- **Restricted-dataset access requests** — a request/approve flow for Restricted/Private datasets (the `access_type` field and badge exist now; the *request workflow* doesn't yet)
- **Email notifications** — SMTP-based email; in-system notifications only, if any, for now
- **Automated backup & recovery management**
- **Advanced audit & compliance reporting** — annual reports, usage analytics dashboards
- **AI-based recommendation methods** — TF-IDF, cosine similarity, collaborative filtering, semantic search, personalization. Current recommendation is a simple weighted metadata match (below), done in PHP + SQL, not ML.

## User roles (MVP)

This website has **two** roles. Everything else in the SRS's eight-role list (Ethics Reviewer, Technical Reviewer, ASOG TBI Staff, Repository Administrator) belongs to the Admin Portal, not here.

| MVP role | Maps to (SRS user classes) | Can do |
|---|---|---|
| **Guest** | Unauthenticated visitor | View public dataset listings and limited metadata only |
| **User** | Student, Faculty Researcher, Adviser, Incubatee, Authorized User | Log in, browse, search, filter, view detail pages, cite, download Published datasets, upload new datasets, update/archive their own datasets |

## Dataset lifecycle (as seen from this website)

```
[Upload form submitted]
        ↓
   Pending Review   ← this site can only ever CREATE this state
        ↓ (Admin Portal approves)         ↓ (Admin Portal rejects/requests revision)
    Published                        Revision Requested → (resubmit) → Pending Review
        ↓ (contributor archives their own, from My Datasets)
     Archived
```

- A dataset is **never permanently deleted** through normal use.
- Only **Published** datasets appear in public browse/search results and in recommendations.
- Pending/Revision-Requested/Rejected datasets are visible only to their contributor.
- Approving, rejecting, requesting revision, and restoring an archived dataset are all **Admin Portal actions** — this website has no UI for any of them.

## Core data model (MVP fields)

The full SRS proposes 16 tables shared across both this website and the Admin Portal. This app only needs to read/write a subset of them:

**`users`** — id, name, email, password_hash, is_active, created_at
**`roles`** / **`user_roles`** — this app only ever assigns/checks Guest or User
**`datasets`** — the core record:

| Field | Notes |
|---|---|
| `dataset_id` | PK |
| `title`, `description` | required |
| `data_type` | one of: Text, Image, Audio, Video, Tabular |
| `file_format` | e.g. CSV, TXT, DOCX, ZIP, JPG, PNG |
| `category`, `tags` | used for search + recommendation |
| `source_type`, `source_link` | Primary/Secondary + optional URL |
| `form` | Raw, processed, cleaned, etc. |
| `research_title`, `project_head`, `members` | research context |
| `contributor_id` | FK → users |
| `status` | Pending Review / Revision Requested / Published / Archived / Rejected — **written by the Admin Portal**, read here |
| `access_type` | Public / Institutional / Restricted / Private (field exists now; request-flow is future) |
| `version` | increments on new file upload |
| `date_uploaded`, `date_updated` | timestamps |

**`dataset_files`** — file path, size, type, upload date, linked dataset (files live in a protected, non-publicly-addressable directory; never expose a direct file URL)
**`dataset_downloads`** — who downloaded what, when (basic log, no analytics dashboard needed here)

Owned by the Admin Portal, not this app: `reviews`, `access_requests` (workflow), `audit_logs` (viewer), `backups`. This app may still *write* a download or login event if the shared schema calls for it, but never renders a log viewer.

## Recommendation system

**Content-based, metadata-weighted similarity**, computed in PHP against MySQL — no ML library needed.

```
Recommendation Score =
   Category match        × 30%
 + Tag/keyword match      × 30%
 + Data type match        × 15%
 + File format match      × 10%
 + Description similarity × 15%
```

- Compare the current dataset against all other **Published**, access-authorized datasets.
- Exclude archived, rejected, and unauthorized datasets from candidates.
- Show a fixed number of results — five, per the SRS example.
- Recommended datasets render on the dataset detail page using the same **dataset card** component as the browse grid.
- Future: TF-IDF, cosine similarity, collaborative filtering, personalization, semantic search.

## Citation & BibTeX

- Triggered from a "Cite" action on the detail page, opens the citation/BibTeX modal (see `DESIGN.md`).
- Generates **plain-text citation** and **BibTeX**, each independently copyable.
- Citation output includes: dataset title, owner/contributor, year, repository name (ASOG TBI Dataset Repository).

## Non-functional guardrails (MVP-relevant)

- **Security:** hashed passwords, RBAC on every protected route, no direct/public access to uploaded files, CodeIgniter 4's built-in validation/CSRF/XSS protections, HTTPS in deployment.
- **Privacy:** datasets with personal/sensitive data require anonymization before they can be approved — that check happens in the Admin Portal, but the upload form should still prompt contributors to confirm anonymization before submitting.
- **Performance:** common pages load in ≤3s; use pagination everywhere lists could grow long.
- **Usability:** responsive down to mobile, clear form labels, dataset status always visible on the owner's own datasets, one-click citation copy, a filter sidebar that doesn't require a page reload per toggle.
- **Maintainability:** stick to CI4's MVC structure — Controllers, Models, Views, Filters, Helpers.

## Proposed CI4 structure (this app only)

Trimmed to exclude anything Admin-Portal-shaped:

```
app/
├── Controllers/
│   ├── Auth.php              (login, logout, register, password reset)
│   ├── Dashboard.php         (My Datasets)
│   ├── Datasets.php          (browse, search, filter, detail)
│   ├── DatasetUpload.php     (upload + update)
│   └── Recommendations.php
├── Models/
│   ├── UserModel.php
│   ├── DatasetModel.php
│   ├── DatasetFileModel.php
│   └── DownloadLogModel.php
├── Views/
│   ├── auth/  dashboard/  datasets/  upload/  layouts/  partials/
├── Filters/
│   └── AuthFilter.php        (logged-in vs guest only — no admin role filter needed here)
└── Helpers/
    ├── citation_helper.php
    ├── recommendation_helper.php
    └── upload_helper.php
```

No `Admin.php`, no `Reviews.php`, no `AccessRequests.php`, no `Backups.php`, no `Reports.php` — those live in the Admin Portal's own codebase.

## MVP acceptance criteria (condensed)

A build is MVP-complete when: users can register/log in; guests and users can browse, search, filter, and paginate Published datasets; detail pages show full metadata plus recommendations; citation and BibTeX generate and copy correctly; Published datasets download as ZIP with the action logged; contributors can upload (→ Pending Review), update, and self-archive their own datasets; a contributor's My Datasets view correctly reflects status changes made in the Admin Portal; and no admin/reviewer/user-management UI exists anywhere in this codebase.

## How this relates to the other docs

- **`CONTEXT.md`** (this file) — what to build, in what order, and the hard line around the Admin Portal. Product/functional source of truth.
- **`DESIGN.md`** — exact visual tokens (color, type, spacing, shadows, texture), the navbar's scroll behavior, and component specs.
- **`SKILL.md`** — the applied workflow for turning a screen request into on-brand, in-scope UI using the other two docs.
- **`Database-Repo-SRS.md`** — the full, unabridged spec, written before the Admin Portal was split out as a separate application. Read its role/workflow sections as the long-term vision, filtered through the scope boundary above.
