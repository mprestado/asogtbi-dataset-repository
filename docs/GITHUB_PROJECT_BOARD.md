# GitHub Project Board and Issues

Use this document to create the starting GitHub project board and issues.

## Project Board Columns

Create these columns:

```text
Backlog
Ready
In Progress
In Review
Testing
Done
Blocked
```

## Labels

Create these labels:

```text
mvp
auth
database
dataset
admin
catalog
recommendation
citation
ui
qa
docs
bug
blocked
future
```

## Milestones

Create these milestones:

| Milestone | Due | Goal |
|---|---|---|
| MVP Week 1 Foundation | End of Week 1 | database, auth, upload, approval, basic catalog |
| MVP Final Demo | End of Week 2 | complete demo flow and QA |
| Future Enhancements | After MVP | ethics workflow, access requests, email, backups, advanced reports |

## Starting Issues

### Issue 1: Set up GitHub repository and branch workflow

Labels:

```text
mvp, docs
```

Owner:

```text
Member 6
```

Acceptance criteria:

- Repository is pushed to GitHub.
- `main` branch exists.
- Optional `develop` branch exists.
- Project board, milestones, and labels are created.
- README points to MVP docs.

### Issue 2: Create MVP database migrations and seeders

Labels:

```text
mvp, database
```

Owner:

```text
Member 2
```

Acceptance criteria:

- Migrations exist for MVP tables.
- Seeder creates admin, user roles, sample users, and sample datasets.
- `php spark migrate` runs successfully.
- `php spark db:seed` creates demo data.

### Issue 3: Implement authentication and role guards

Labels:

```text
mvp, auth
```

Owner:

```text
Member 1
```

Acceptance criteria:

- Users can log in and log out.
- Passwords are hashed.
- Protected routes block guests.
- Admin routes block non-admin users.
- Inactive users cannot log in.

### Issue 4: Implement dataset upload and pending submission

Labels:

```text
mvp, dataset
```

Owner:

```text
Member 3
```

Acceptance criteria:

- Authorized users can submit required metadata.
- ZIP file upload is required.
- Invalid submissions show validation errors.
- Uploaded files are stored outside `public/`.
- New submissions are saved as pending.

### Issue 5: Implement admin dataset approval

Labels:

```text
mvp, admin, dataset
```

Owner:

```text
Member 3
```

Acceptance criteria:

- Admin can view pending datasets.
- Admin can approve a dataset.
- Admin can reject a dataset.
- Approved datasets appear in catalog.
- Rejected datasets do not appear in catalog.

### Issue 6: Implement catalog listing, pagination, search, and filtering

Labels:

```text
mvp, catalog
```

Owner:

```text
Member 4
```

Acceptance criteria:

- Approved datasets appear in a listing.
- Archived, pending, and rejected datasets are hidden.
- Pagination works.
- Search works by title, description, tags, and category.
- Data type filtering works.

### Issue 7: Implement dataset detail page and download

Labels:

```text
mvp, catalog, dataset
```

Owner:

```text
Member 4
```

Acceptance criteria:

- Detail page opens from catalog.
- Detail page shows complete metadata and research information.
- Download button serves approved ZIP files.
- Unauthorized users cannot download protected files.
- Download action is logged.

### Issue 8: Implement citation and BibTeX generation

Labels:

```text
mvp, citation
```

Owner:

```text
Member 5
```

Acceptance criteria:

- Detail page displays citation text.
- Detail page displays BibTeX.
- Citation can be copied.
- BibTeX can be copied.

### Issue 9: Implement metadata-based recommendations

Labels:

```text
mvp, recommendation
```

Owner:

```text
Member 5
```

Acceptance criteria:

- Detail page shows similar datasets.
- Recommendation score uses metadata.
- Current dataset is excluded.
- Pending, rejected, archived, and unauthorized datasets are excluded.
- Recommended datasets are clickable.

### Issue 10: Implement update and archive flow

Labels:

```text
mvp, dataset
```

Owner:

```text
Member 3
```

Acceptance criteria:

- Authorized users can update dataset metadata.
- Authorized users can upload a new ZIP version.
- Authorized users can archive a dataset.
- Archived datasets disappear from normal browsing.
- Update and archive actions are logged.

### Issue 11: Implement shared UI layout and role navigation

Labels:

```text
mvp, ui
```

Owner:

```text
Member 6
```

Acceptance criteria:

- Layout is consistent across pages.
- Navigation changes by role.
- Forms and tables are readable on desktop and mobile.
- Empty states are handled.
- Validation messages are consistent.

### Issue 12: Run final MVP QA and prepare demo script

Labels:

```text
mvp, qa, docs
```

Owner:

```text
Member 6
```

Acceptance criteria:

- Fresh setup instructions are tested.
- Demo data is available.
- Final demo script is documented.
- Known limitations are listed.
- All MVP acceptance checklist items are verified or marked as incomplete.

## Pull Request Template

Use this text for pull requests:

```md
## Summary

## SRS / MVP References

## Screenshots

## Database Changes

## Manual Test Steps

## Known Limitations
```
