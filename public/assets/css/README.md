# Application CSS

`app.css` is the only stylesheet entry point used by the application layouts.
It imports the modules below in cascade order:

- `foundation.css`: design tokens, reset rules, site shell, navigation, shared buttons, notices, and feedback components.
- `public-ui.css`: shared public-page panels, cards, forms, dataset details, and submission states.
- `contributor-library.css`: contributor dataset library and contributor-facing management views.
- `upload.css`: file upload zone and upload-specific controls.
- `auth.css`: authentication, password recovery, error pages, and their responsive states.
- `portal.css`: administration, moderation, review, and governance portal layouts.
- `catalog.css`: browse-dataset refinements, filters, result rows, and pagination.
- `home.css`: homepage hero, dashboard, insights, partners, and final call to action.

## Maintenance rule

Add a rule to the narrowest relevant module. Shared tokens and reusable controls
belong in `foundation.css`. Keep the import order stable because later modules
intentionally override shared declarations for their page-specific contexts.
