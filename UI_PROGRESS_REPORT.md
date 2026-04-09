# APT 3065 - UI Progress Report – Project Submission

**Date:** March 30, 2026
**Project Name:** Library MVC
**Student Name / ID:** [Insert Name / ID]

## 1. Project Details
- Project: Library MVC (PHP, MYSQL, MVC pattern)
- Scope: Library management admin panel (books, categories, users, transactions, reports)
- Current file focus: `app/views/dashboard/index.php`

## 2. Completed UI Features

### Navigation
- Menu bar / sidebar in layouts: `app/views/layouts/header.php` and `footer.php`.
- Breadcrumbs: to be enhanced (not yet fully implemented).
- Responsive navigation: built with `row`, `col-lg-*`, `col-md-*` classes.

### Forms & Inputs
- Login form: `app/views/auth/login.php`.
- Registration form: `app/views/auth/register.php`.
- Search bar: present in list pages (e.g., `books/index.php`).
- Validation messages: server flash notices via controller messages.

### Layout & Structure
- Grid system: `row`, `col-lg-*`, `col-md-*` in `dashboard/index.php`.
- Consistent spacing: `g-3`, `g-4`, padding inside cards.
- Headers/footers: global layout files.

### Interactive Elements
- Buttons: `btn btn-primary`, `btn btn-success`, `btn btn-warning`, `btn btn-danger`, `btn btn-info`.
- Form controls: dropdowns, checkboxes, radio (in create/edit forms).
- Hover/click effects: CSS classes and active link highlighting.

### Visual Design
- Color/Theme: `stat-card` classes and button variants.
- Typography: `.dashboard-title`, `.section-title`, standard heading hierarchy.
- Icons: emojis used in cards and actions.

### Accessibility
- Alt text: verify in places with images; add where missing.
- Keyboard navigation: standard `<a>` and `<button>` usage.
- Contrast: adjusted via Bootstrap-like utility classes.

### Feedback & Notifications
- Success/Error alerts: flash messages from controllers.
- Loading indicators: to add (current state pending).
- Tooltips/help text: can be added with `title` or JS library.

## 3. Pending / In-progress Features
- Breadcrumb component for all subpages.
- Explicit keyboard focus indicators and ARIA roles.
- Loading spinners for long actions.
- Full WCAG compliance audit.
- Estimated completion: 3–5 days.

## 4. Challenges & Solutions
- Responsive stacking and card alignment: solved with Bootstrap grid.
- Validation UX: solved with centralized flash-style alerts.
- Mobile action navigation: improved with `quick-action-btn` styles.

## 5. Screenshots / Demo Links
- Add screenshots with system clock visible for:
  - Dashboard overview (cards + quick actions)
  - Auth forms (login/register)
  - Validation errors and success alerts
  - Responsive mobile view

- Live demo URL (local): `http://localhost/library_mvc/public/index.php`
- Repo: Add your GitHub link here.

## 6. Planned Improvements
- Add sidebar collapse/hamburger menu for mobile.
- Add breadcrumb trail in top content.
- Add modal confirmations and toast notifications.
- Add theme mode toggle (light/dark).

### % Remaining
- UX polishing + a11y/touch support: ~25% left.
