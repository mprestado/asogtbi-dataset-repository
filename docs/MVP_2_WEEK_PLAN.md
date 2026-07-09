# Two-Week MVP Plan

The team has two weeks left, so the plan prioritizes a demoable vertical slice over completeness.

## Working Assumptions

- Team size: 6 members.
- Duration: 10 working days.
- Framework: CodeIgniter 4.
- Database: MySQL.
- File uploads: ZIP files only for MVP.
- Review flow: simplified admin approval for MVP.
- Recommendation: metadata-based scoring only.

## Week 1 Goal

By the end of Week 1, the app should have the core database, auth, dataset submission, admin approval, and catalog flow connected.

| Day | Main Target | Expected Output |
|---|---|---|
| Day 1 | Repository setup and task selection | GitHub repo, project board, branches, shared work areas |
| Day 2 | Database foundation | migrations for users, roles, datasets, files, logs |
| Day 3 | Auth and role guards | login, logout, registration/admin-created user path, filters |
| Day 4 | Dataset upload | metadata form, ZIP validation, protected file storage |
| Day 5 | Admin approval and catalog start | approve/reject action, approved dataset listing |

## Week 2 Goal

By the end of Week 2, the app should be demo-ready with search, filtering, detail pages, citation, downloads, recommendations, update/archive, and basic QA.

| Day | Main Target | Expected Output |
|---|---|---|
| Day 6 | Search, filtering, pagination | usable catalog |
| Day 7 | Detail page, citation, download | full dataset detail experience |
| Day 8 | Recommendations and update/archive | related dataset list, edit/archive flow |
| Day 9 | Integration and bug fixing | merged features, seed data, role testing |
| Day 10 | Demo hardening | final QA, README checks, deployment notes |

## MVP Milestones

| Milestone | Target Date | Required Features |
|---|---|---|
| M1: Repo Ready | Day 1 | GitHub repo, docs, branches, project board |
| M2: Data Foundation | Day 2 | migrations, models, seeders |
| M3: Auth Ready | Day 3 | login, logout, roles, protected pages |
| M4: Submission Flow | Day 5 | upload, pending status, admin approval |
| M5: Discovery Flow | Day 7 | listing, search, filter, detail, download, citation |
| M6: MVP Demo | Day 10 | recommendations, update/archive, audit basics, QA |

## Daily Team Rhythm

Keep check-ins short and practical:

- Yesterday: what was merged or finished?
- Today: what will be opened as a pull request?
- Blocker: what prevents merge today?
- Demo risk: what might break the final presentation?

## Merge Order

Recommended merge order:

1. Database migrations and seeders.
2. Auth, roles, and filters.
3. Dataset upload and file storage.
4. Admin approval.
5. Catalog listing, search, filter, and pagination.
6. Detail page, citation, BibTeX, and download.
7. Recommendations.
8. Update/archive.
9. UI cleanup and QA fixes.

## End-of-Week 1 Demo

The Week 1 demo should show:

- Login as admin.
- Create or activate a user.
- Login as user.
- Upload a dataset ZIP with metadata.
- Login as admin.
- Approve the dataset.
- View the approved dataset in the catalog.

## Final Demo

The final MVP demo should show:

- Login/logout.
- Role-based navigation.
- Dataset upload.
- Admin approval.
- Catalog with pagination, search, and filtering.
- Dataset detail page.
- Citation and BibTeX copy.
- ZIP download.
- Similar dataset recommendations.
- Update dataset metadata.
- Archive dataset and confirm it disappears from normal browsing.
- Basic audit log records for major actions.
