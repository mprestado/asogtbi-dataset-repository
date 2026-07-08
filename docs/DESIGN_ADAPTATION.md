# Design Adaptation

This project adapts the `asog-technology-business-incubator-(asog-tbi)-DESIGN.md` direction into the starter skeleton.

## Applied Direction

| Design Source | Skeleton Adaptation |
|---|---|
| Dark navy dominant hero | Shared `hero-panel` styling for key page introductions |
| Warm off-white body | Global page background uses `#f8f6f2` |
| Gold accent system | Eyebrows, section rules, brand mark, tags, and status highlights use `#f8af21` |
| Sky-blue CTA | Primary `.button` uses `#43a7db` |
| DM Serif Display headings | Headings use DM Serif Display with Georgia fallback |
| DM Sans UI/body text | Body, labels, nav, forms, and tables use DM Sans with Segoe UI fallback |
| Rounded geometry | Buttons use pill radius; panels use 16px radius; inputs use 8px radius |
| Restrained elevation | Panels use the extracted `card-lift` shadow token |

## Team Rule

New MVP pages should reuse:

- `hero-panel` for page introductions.
- `panel` for form and content blocks.
- `grid` for responsive cards.
- `table-shell` for admin or dataset tables.
- `button`, `button secondary`, and `button warning` for actions.
- `eyebrow`, `tag`, and `status-pill` for small labels.
