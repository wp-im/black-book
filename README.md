# Black Book

Version 0.1.1. A monochrome, reading-first WordPress classic theme for a small publisher. Derived from Black Theme 0.3.2; install as its own `black-book` theme, not over another theme.

## Owner Controls

- Appearance > Customize > Site Identity: name and logo.
- Customize > Black Book: introduction, header action, contact and footer text.
- Customize > Books On The Homepage: published featured book, headings and section visibility.
- Customize > Colors: 26 native color pickers for pages, controls, forms, introduction, Publisher Band and footer. Keep text and keyboard focus readable against backgrounds. Images, plugin styles and WordPress Admin are independent.
- Appearance > Menus: Primary, Footer and Social links.
- Appearance > Widgets: Publisher Statement for the black homepage band; Front Page Contact replaces fallback contact copy; Front Page After Content adds native modules; Footer Brand manages footer information. Four widget areas; no reading-page sidebar by design.
- Books: cover as Featured Image, excerpt as short description, body as introduction, contents and author biography. BookPress Catalog owns authors, series, subjects and optional publication fields.

## Catalog Dependency

Install the separately supplied BookPress Catalog 1.0.0 plugin. Content remains in the database if the theme changes. The theme does not register a post type, migrate data or import demo records on activation. Classic Editor and Classic Widgets are supported but not required. Without the catalog plugin, ordinary Pages and Posts still work and book homepage sections are omitted.

The detail page shows only populated publication fields. An optional HTTP(S) book link uses the plugin's existing Amazon/URL field and can point to any actual bookseller. No cart, payment, price or fabricated ISBN is provided.

## Homepage And Reading

Assign a static homepage and separate posts page in Settings > Reading. An empty homepage body displays featured book, newest six books, configured Publisher Statement widgets and contact. Saved Page body content replaces these modules; the introduction and Front Page After Content area remain. An empty Publisher Statement area creates no black band. Empty contact widgets restore Customizer copy without deleting it.

Book covers have a stable 5:8 frame with `object-fit: contain`: square and landscape images remain fully visible. Catalog columns are four on desktop, three on tablet and two on mobile. Single books use a compact centered mobile cover before metadata and a 700px reading column. Search book thumbnails are also uncropped. Menus, pagination, Comments and long-form content use native WordPress behavior.

System fonts, local enqueued assets, 44px touch controls, visible focus and reduced-motion support are inherited from Black Theme. No external font, tracker or frontend framework is loaded. Owner-selected colors and media still need accessibility review.

## Installation And Rollback

Requires WordPress 6.5+ and PHP 8.0+ (catalog dependency floor). Tested with WordPress 7.1.3 / PHP 8.3.32 in Studio at black-book.local. Install plugin and theme ZIPs, activate, assign menus and configure the homepage. Demo content is separately imported fictional BookPress examples; replace it before public publication.

Back up theme and database before upgrades. Restore the previous `black-book` directory to roll back presentation; no theme migration is needed. Never restore another site's database. Local Studio deployment is not public hosting.

## License

GPL v2 or later. Black Theme 0.3.2 derives from Frameword Lite 1.0.5 by Roman Fink. Original copyrights and asset notices remain applicable; see LICENSE and ASSET-LICENSES.md. Legacy media/fonts are not forced into publisher pages. See the project release report for verification and platform limitations.
