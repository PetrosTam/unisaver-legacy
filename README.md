# UniSaver Legacy

**Student-focused e-commerce prototype · Northumbria University Final Year Project (2023–2024)**

**Original project title:** *Developing an E-Commerce Website to Help University Students with Financial Difficulties in Newcastle*

**Author:** Petros Tamboutsiaris

UniSaver Legacy is an archived PHP/Laravel e-commerce prototype developed as a university final-year project. It demonstrates a single-store shopping experience, customer-facing pages, order management and a Filament administration interface.

## Project Status

**Archived academic portfolio snapshot — not production-ready.** This repository contains a sanitized version of the historical source code, not a deployed store or the new, independently planned UniSaver application. The project explored an academic objective; it does not establish verified student savings, current-enrolment checks or a university partnership.

The original `student_id` field is self-reported. The application does **not** implement verified student eligibility or student-pricing entitlements. Features below describe the code present in the repository, not independently verified end-to-end behaviour.

## Features Demonstrated in Source

- **Product discovery:** home, category and product pages; category/subcategory and price filters; sorting and pagination.
- **Shopping cart:** quantity updates, item removal and cookie-based cart persistence.
- **Customer accounts:** registration, sign-in, password-reset pages and authenticated routes.
- **Orders:** checkout interface, order history, order details and Eloquent models for orders, items and addresses.
- **Payment prototype:** Stripe Checkout Session creation and a cash-on-delivery route; **not** a secure or fully reconciled payment implementation.
- **Administration:** Filament resources for products, categories, subcategories, users and orders, with dashboard components.
- **Email:** Laravel Mailable and an order-confirmation Blade template.

## Technology Stack

- **Backend:** PHP (`^8.2` project constraint), Laravel 11, Eloquent ORM and Laravel migrations.
- **Frontend:** Blade, Livewire 3, HTML/CSS, Tailwind CSS 3, JavaScript, Alpine.js and Preline UI.
- **Administration:** Filament 3.
- **Database:** SQLite in the original local prototype.
- **Integrations:** Stripe PHP SDK / Checkout prototype and Laravel Mail.
- **Tooling:** Composer, npm, Vite 5, PHPUnit 11 and Laravel Pint (listed in the project dependencies).

These are historical versions recorded in the source and lockfiles. No custom REST API, PostgreSQL/MySQL deployment, production Docker setup or GitHub Actions CI is demonstrated in this snapshot.

## Code Navigation

| Area | Source |
| --- | --- |
| Storefront, authentication and checkout | [`app/Livewire/`](app/Livewire/) |
| Blade interfaces and email templates | [`resources/views/`](resources/views/) |
| Administration resources | [`app/Filament/`](app/Filament/) |
| Data models and schema | [`app/Models/`](app/Models/), [`database/migrations/`](database/migrations/) |
| Routes | [`routes/web.php`](routes/web.php) |

## Getting Started

**Local evaluation only; setup has not been verified end-to-end on this sanitized snapshot.** Use a disposable environment with synthetic identities and no live payment credentials. Historical dependencies may have compatibility or security issues; review `composer.json` scripts before installation. You need PHP with PDO SQLite and required extensions, Composer, Node.js and npm.

From Windows PowerShell:

```powershell
git clone https://github.com/PetrosTam/unisaver-legacy.git
Set-Location unisaver-legacy

composer install --no-interaction --prefer-dist
npm ci
Copy-Item .env.example .env
php artisan key:generate
if (-not (Test-Path 'database/database.sqlite')) {
    New-Item -ItemType File -Path 'database/database.sqlite' | Out-Null
}
php artisan migrate
npm run build
php artisan serve --host=127.0.0.1 --port=8000
```

Keep `DB_CONNECTION=sqlite` and `MAIL_MAILER=log` in the ignored `.env` file; set `APP_URL=http://127.0.0.1:8000`. Leave `STRIPE_SECRET` empty unless using your own **test-mode** key. Visit `http://127.0.0.1:8000/` or `/products`.

The original database, product uploads and images are deliberately excluded, so a fresh installation has no restored catalogue and may look incomplete. Filament administration at `/admin` **denies access by default**. For a disposable local demonstration only, register a synthetic account and set `UNISAVER_LEGACY_ADMIN_EMAIL` to its email in your local `.env`; then run `php artisan config:clear`. This is not role-based authorization.

## Verification and Security Limitations

**Initial snapshot checks:** PHP syntax checks passed for all 101 files; `composer validate --strict` passed; and a targeted secret-pattern scan found no matches. These checks do not confirm runtime behaviour, application security or the absence of all secrets.

**NOT-RUN on this sanitized snapshot:** clean dependency installation, Laravel boot, migrations, PHPUnit application tests, Vite build, browser flows, payment tests and production deployment. The existing PHPUnit files are example-level tests; there is no verified CI pipeline for this repository.

**Known legacy risks:** order details are not consistently restricted to the authenticated customer (potential IDOR); prices may rely on client-held cart data; Stripe success handling lacks robust order/session correlation and signature-verified, idempotent webhook settlement; stock concurrency and failure paths are not comprehensively tested. Do **not** deploy this code with real users, student data or live payments.

The sanitized source excludes local secrets, personal records, database files, logs, third-party product imagery, dependency directories and prior Git history. See [Portfolio Snapshot Scope](docs/SNAPSHOT_SCOPE.md) for details.

## License

Copyright (c) 2023–2024 Petros Tamboutsiaris. All rights reserved, subject to applicable university and third-party rights.

This repository is available for portfolio review under the [proprietary LICENSE](LICENSE); no general open-source license is granted. Northumbria University and third-party rights remain unaffected. Publication rights for individual components have not been independently verified.
