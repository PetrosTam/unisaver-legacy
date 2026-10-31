# UniSaver Legacy — Northumbria University Final Year Project

**Final Year Project · Northumbria University · Academic year 2023–2024**

**Original project title:** *Developing an E-Commerce Website to Help University Students with Financial Difficulties in Newcastle*

**Author:** Petros Tamboutsiaris

**Technology stack:** Laravel 11 · Livewire 3 · Filament 3 · Blade · Tailwind CSS 3 · SQLite · Stripe Checkout (prototype)

> **Archived academic project / portfolio source snapshot — not production-ready.**
> This repository contains a sanitized snapshot of the e-commerce prototype developed for the author's 2023–2024 final year project at Northumbria University. It is **not** the new, independently planned UniSaver application. The code is shared to demonstrate historical PHP/Laravel full-stack work, not a live or secure payment platform.

## Academic project context

The final year project explored the development of a student-focused e-commerce website intended to help university students experiencing financial difficulties in Newcastle. The repository presents the implementation work available in this historical source snapshot; the original project title describes the academic objective, **not a verified financial outcome, an active university partnership, or evidence of a production deployment**.

## Overview

UniSaver Legacy explores a single-store shopping experience with a browsable product catalogue, customer accounts, a cart, a checkout interface, order records, and an administrative dashboard. The code contains both customer-facing pages and back-office resource screens.

A `student_id` field appears in registration and order details, but it is **self-reported**. The prototype does **not** verify active university enrolment or implement a verified student-pricing entitlement.

## Technology stack

The following technologies are present in the **source, manifests, or locked dependencies** supplied with this snapshot. Their presence does not imply that every integration has passed end-to-end tests.

| Layer | Technology used | Evidence in this repository |
| --- | --- | --- |
| Language and framework | **PHP 8.2+ constraint; Laravel 11** | `composer.json`, `composer.lock`, application classes and routes |
| Backend and data access | **Eloquent ORM**, model relationships, Laravel migrations, route middleware, validation | `app/Models/`, `database/migrations/`, `routes/web.php`, Livewire classes |
| Database | **SQLite** for the legacy local prototype | `config/database.php`, SQLite schema migrations; original local data file intentionally excluded |
| Server-rendered UI | **Blade templates and Livewire 3** | `resources/views/`, `app/Livewire/` |
| HTML and styling | **HTML, CSS, Tailwind CSS 3** with responsive utility classes | Blade views, `resources/css/app.css`, `tailwind.config.js` |
| Client-side interactions | **JavaScript, Alpine.js**, Preline UI, Livewire Alert; Axios included in frontend bootstrap | Alpine `x-data` / `x-bind`, Livewire alert calls, `resources/js/`, package manifests |
| Administration | **Filament 3** | `app/Filament/Resources/`, widgets and admin panel provider |
| Payment prototype | **Stripe PHP SDK** and Stripe Checkout Session creation; cash-on-delivery option | `app/Livewire/CheckoutPage.php`, `composer.json` |
| Email | **Laravel Mail / Mailable**, order confirmation template | `app/Mail/OrderPlaced.php`, `resources/views/mail/` |
| Frontend toolchain | **Vite 5**, Laravel Vite plugin, PostCSS, Autoprefixer, npm | `vite.config.js`, `postcss.config.js`, `package.json`, `package-lock.json` |
| PHP dependencies and development tools | **Composer**, PHPUnit 11, Laravel Pint; Laravel Sail listed as a development dependency | `composer.json`, `composer.lock`, `tests/` |
| Source control | **Git** | The original source was version-controlled; its `.git` history is intentionally omitted from this one-commit portfolio snapshot |

The lockfiles record **Laravel 11.5.0, Livewire 3.4.11, Filament 3.2.71, Stripe PHP SDK 14.3.0, Tailwind CSS 3.4.3 and Vite 5.2.8**. These are historical locked versions, not claims that the project runs on the latest releases.

**Scope clarification:** PostgreSQL/MySQL are present only as standard Laravel connection options; this snapshot does **not** establish that either was used or tested. No project-specific REST API, Sass/SCSS code, mobile application, configured queue workers, Docker deployment, or CI/CD pipeline is demonstrated. Laravel Sail is a declared development dependency, **not** a verified containerized setup.

## Implemented source areas

| Area | What the code demonstrates |
| --- | --- |
| Catalogue and navigation | Home/categories pages; product listings and details; filtering by category, subcategory and price; price sorting and pagination |
| Shopping UI | Add/update/remove cart items, quantity controls and cookie-based cart persistence |
| Customer accounts | Registration, sign-in, password-reset pages and authenticated routes |
| Orders and checkout | Checkout form, order/order-item/address models, order history and order-detail pages |
| Payment options | Prototype Stripe Checkout Session redirect flow and cash-on-delivery path |
| Email | Order-placed `Mailable` and Blade email template, invoked from checkout code |
| Administration | Filament resources for users, products, categories, subcategories and orders, plus order-related dashboard components |
| Data model | Eloquent relationships and schema migrations with foreign-key references for the store's core entities |
| User interface | Responsive Blade/Tailwind layouts, Livewire interactions and limited Alpine-powered product image state |

These are **code-level capabilities**, not independently verified production behaviors. In particular, the admin features and checkout require security hardening before any real use.

## Repository structure

```text
app/
  Filament/          Admin resources and widgets
  Helpers/           Cart helper
  Livewire/          Storefront, account and checkout components
  Mail/              Order confirmation mailable
  Models/            Eloquent domain models
config/              Application and local prototype settings
database/migrations/ Relational schema definitions
resources/views/     Blade storefront and email views
resources/js/        JavaScript bootstrap and Preline integration
resources/css/       Tailwind entrypoint
routes/web.php        Web routes and authentication middleware
tests/               Original example PHPUnit tests
```

## Security and functional limitations

**Do not deploy this snapshot or use it with real customers, real student records, or live payments.** Known issues retained from the original prototype include:

- Order-detail retrieval does not reliably check whether the order belongs to the current user (**potential IDOR**).
- The Stripe success redirect is treated as part of the payment flow without robust, order-correlated, signature-verified and idempotent webhook settlement.
- Checkout calculations can depend on cookie-held cart amounts instead of authoritative server-side prices and stock validation.
- Self-declared student identifiers are not proof of current enrolment.
- The example administrative access rule is not a production-grade role/permission system.
- Stock concurrency, payment failure/retry paths, authorization denials and accessibility have not received comprehensive behavioral testing.

The payment integration is a **prototype**, not a claim of secure transactions or verified production integration. The original archive contained local Stripe **test-type** settings; all credential values were excluded from this snapshot.

## Safe publication scope

The sanitized snapshot excludes original `.env` secrets, the SQLite database containing local records, mail credentials, logs, caches, uploaded or unlicensed images, `vendor/`, `node_modules/`, generated assets and prior `.git` history. A specific hardcoded administrator email was replaced with a default-deny local configuration, and a third-party hotlinked hero image was replaced with a neutral placeholder.

See [`docs/SNAPSHOT_SCOPE.md`](docs/SNAPSHOT_SCOPE.md) for the exact publication-only changes. The missing uploaded images mean the storefront is **not visually complete out of the box**.

## Local development and application URLs — not yet runtime-verified on this snapshot

These instructions describe a **local-only evaluation** of the sanitized historical prototype on Windows PowerShell. The routes and admin configuration have been reviewed in source, but a complete clean installation, database migration, front-end build and browser session have **not** been executed on this release. Use synthetic identities and test-only configuration; **do not deploy or process real users or payments**.

### Requirements

- PHP compatible with the historical `composer.lock` and the required extensions (including PDO SQLite), Composer, Node.js and npm.
- The dependencies are historical (Laravel 11, Livewire 3, Filament 3); successful installation on a newer PHP runtime such as PHP 8.5 is **not established**.
- A fresh **disposable** SQLite database. The original database was removed to protect local user and order records.

### Install and configure (PowerShell)

From the extracted sanitized portfolio directory, after reviewing `composer.json` scripts and dependency lockfiles:

```powershell
Set-Location 'C:\Dev\unisaver-legacy-portfolio'
composer install --no-interaction --prefer-dist
npm ci
if (-not (Test-Path '.env')) {
    Copy-Item '.env.example' '.env'
    php artisan key:generate
}
if (-not (Test-Path 'database\database.sqlite')) {
    New-Item -ItemType File -Path 'database\database.sqlite' | Out-Null
}
php artisan migrate
npm run build
```

In the **local, untracked** `.env` file, keep `DB_CONNECTION=sqlite`, set `APP_URL=http://127.0.0.1:8000` and keep `MAIL_MAILER=log`. Leave `STRIPE_SECRET` empty unless using your own Stripe **test-mode** credentials. Never commit `.env`, a database or logs. `php artisan storage:link` is optional for local file handling, but excluded image uploads are **not** restored by it.

### Start and open the storefront

From the same directory:

```powershell
php artisan serve --host=127.0.0.1 --port=8000
```

Open the following URLs while the server is running:

| Page | Local URL | Source evidence |
| --- | --- | --- |
| Home | http://127.0.0.1:8000/ | `routes/web.php` |
| Products | http://127.0.0.1:8000/products | `routes/web.php` |
| Categories | http://127.0.0.1:8000/categories | `routes/web.php` |
| Cart | http://127.0.0.1:8000/cart | `routes/web.php` |
| Registration | http://127.0.0.1:8000/register | `routes/web.php` |
| Customer login | http://127.0.0.1:8000/login | `routes/web.php` |
| Admin panel | http://127.0.0.1:8000/admin | Filament panel `->path('admin')` |
| Admin login | http://127.0.0.1:8000/admin/login | Filament `->login()`; expected route, not runtime-tested |

Use `Ctrl+C` to stop the Laravel server. Alternatively, you may run `npm run dev` in a second terminal for Vite development instead of using only prebuilt assets.

### Admin access (local demonstration only)

The Filament admin panel has a login route, but **the sanitized snapshot intentionally grants admin access to nobody by default**. There is no published administrator account or password. To try the admin interface in a strictly local disposable environment:

1. Register a new **synthetic** account at `http://127.0.0.1:8000/register` using a made-up `student_id` and an email address reserved for testing (for example, `admin@example.test`). Do not enter actual student information.
2. In your **local `.env` only**, set `UNISAVER_LEGACY_ADMIN_EMAIL=admin@example.test` to the exact email used for the local account.
3. Run `php artisan config:clear` in another terminal from the project directory. Then open `http://127.0.0.1:8000/admin` and log in with that local account's credentials.

This email-based allow rule exists solely to make a **local prototype demo** possible; it is **not secure role-based authorization**. No production admin deployment is supported. If login or runtime boot fails, check the local logs without publishing their contents, and treat the result as an unverified setup issue rather than assuming a working application.

For route inspection after installing dependencies, use `php artisan route:list`; tests can be attempted with `php artisan test`, but neither command nor its outcome is claimed as executed here. The original seed file does **not** provide a ready-to-use admin account. A fresh database also contains **no restored product catalogue or uploaded product imagery**, so pages may appear empty or incomplete.

## Verification status

- **EXECUTED-PASS (previous static audit):** 101/101 PHP files passed `php -l` with PHP 8.4.24 in the analysis environment.
- **STATIC-REVIEW:** Stack, file organization, implementation scope, and known security gaps described above.
- **NOT-RUN:** Composer dependency installation/validation, Laravel application boot, migrations, PHPUnit behavior, `npm ci`, Vite build, browser tests and payment tests on this sanitized snapshot.

The original `tests/` directory contains example-level tests; it does **not** establish meaningful business-flow or security test coverage. Syntax linting is not proof of runtime functionality.

## Project separation and rights

This is an archived **legacy portfolio snapshot**, separate from the new UniSaver repository and its research/engineering proposal. No source code from that new project is included.

The author's original materials are provided for portfolio inspection under the [proprietary `LICENSE`](LICENSE), **without an open-source license grant**. This notice applies only to materials for which the author holds the relevant rights; third-party licenses and any applicable university rights remain unaffected. Ownership and publication rights should be confirmed before making the repository public.
