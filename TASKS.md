# Rapid MVP Community Task Board

This tracker is designed for the Google Sheets Apps Script used by the team. The importable source is [docs/RAPID_MVP_TASKS.csv](docs/RAPID_MVP_TASKS.csv).

The CSV intentionally keeps the Apps Script layout:

- Row 1: tracker title
- Row 2: branch/context note
- Row 3: header row
- Row 4 onward: task data

## Apps Script Columns

The sheet must keep these columns in this exact order because the Apps Script reads them by column number:

| Column | Header |
| --- | --- |
| A | `TASK ID` |
| B | `CATEGORY` |
| C | `PRIORITY` |
| D | `TASK DESCRIPTION` |
| E | `ASSIGNEE/S` |
| F | `START DATE` |
| G | `TARGET DATE` |
| H | `DEADLINE` |
| I | `DAYS LEFT` |
| J | `STATUS` |
| K | `DATE DONE` |
| L | `DEPENDENCY / PREREQUISITE` |
| M | `FILE / FOLDER LINK` |
| N | `EXPECTED OUTPUT / EVIDENCE` |
| O | `REMARKS` |
| P | `LAST UPDATED` |

## Status Values

Use the exact status values expected by the script filters:

- `Not Started`
- `In Progress`
- `For Review`
- `Done`
- `Blocked`

The script sets `DATE DONE` automatically when `STATUS` becomes `Done`, and clears it when the status changes back.

## Category Values

The tracker uses category names already present in the Apps Script color maps, so row colors and category chips work without script edits:

- `Accessibility`
- `Application Form`
- `Application Workflow`
- `Authentication`
- `Backend Foundation`
- `Backend Wiring`
- `Deployment`
- `Documentation`
- `Frontend Fix`
- `Navigation`
- `Testing & QA`
- `UI State`
- `UI Window`
- `UI/UX Enhancement`

## Working Rules

- Teammates claim a task by filling `ASSIGNEE/S`.
- Teammates update `STATUS`, `START DATE`, `TARGET DATE`, `DEADLINE`, and `REMARKS` in the sheet.
- `TASK DESCRIPTION` should stay outcome-focused and readable in one pass.
- `EXPECTED OUTPUT / EVIDENCE` is the done condition.
- Do not add Admin Portal tasks here. Approval/rejection, reviewer queues, user management, audit-log viewers, backups, reports, and access-request approvals belong to the separate Admin Portal.

## Task Summary

| Task ID | Category | Priority | Outcome |
| --- | --- | --- | --- |
| RMVP-001 | UI/UX Enhancement | High | Browse results feel clear and usable. |
| RMVP-002 | UI State | High | Dataset Preview behaves like a real preview. |
| RMVP-003 | UI Window | High | Detail page encourages citation before download. |
| RMVP-004 | Frontend Fix | Medium | Citation text is easy to reuse. |
| RMVP-005 | Application Form | High | Upload form is contributor-friendly. |
| RMVP-006 | Application Workflow | High | My Datasets clearly shows ownership and status. |
| RMVP-007 | Application Workflow | Medium | Edit/update flow explains review impact. |
| RMVP-008 | Authentication | High | Password reset is locally auditable. |
| RMVP-009 | Authentication | Medium | Login and registration feel polished. |
| RMVP-010 | Testing & QA | High | Dataset access rules are protected by tests. |
| RMVP-011 | Testing & QA | High | Contributor lifecycle is protected by tests. |
| RMVP-012 | Backend Foundation | Medium | Demo data supports UI review. |
| RMVP-013 | Backend Foundation | Medium | Validation rules are consistent. |
| RMVP-014 | Backend Wiring | Medium | Recommendations are understandable. |
| RMVP-015 | UI Window | Medium | Public homepage communicates the product. |
| RMVP-016 | Navigation | Medium | App shell is consistent. |
| RMVP-017 | Accessibility | Low | Accessibility basics are covered. |
| RMVP-018 | Documentation | Low | Handoff docs are teammate-ready. |
| RMVP-019 | Deployment | Low | Deployment checklist exists. |
| RMVP-020 | Documentation | Low | Branch audit is repeatable. |

## Descoped From This Board

These should not be assigned in this `rapid-mvp` sheet:

- Admin dashboard.
- Dataset approval/rejection/revision controls.
- Reviewer queues.
- User management.
- Audit-log viewer.
- Backup controls.
- Reports.
- Restricted dataset access request approval workflow.
- Google school-email authentication.
- Email delivery for password reset.
- AI/ML recommendations beyond the current metadata scoring.
