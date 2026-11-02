# UniSaver Legacy — Portfolio Snapshot Scope

This repository contains a sanitized snapshot of UniSaver Legacy, a 2023–2024 Northumbria University final-year e-commerce project. The snapshot was prepared from a separate legacy source archive on 31 October 2026. It is independent of the new UniSaver application and its engineering proposal.

## Publication-only Changes

- Replaced a hardcoded administrator email in `app/Models/User.php` with a default-deny local setting (`UNISAVER_LEGACY_ADMIN_EMAIL` via `config/legacy.php`). This is not production-grade authorization.
- Replaced a remotely hotlinked third-party hero image with a neutral placeholder in `resources/views/livewire/home-page.blade.php`.
- Added a portfolio-focused `README.md`, a project-specific proprietary `LICENSE`, and Git exclusion rules for local secrets, data and generated files.
- Supplied a sanitized `.env.example` without credential values and changed the Laravel scaffold license declaration in `composer.json` to `proprietary`. The historical `composer.lock` was not regenerated.
- Corrected trailing whitespace in 20 source files before the initial commit; these were formatting-only changes.

The snapshot excludes original `.env` credentials, the local SQLite database and private records, logs, uploads and third-party product imagery, caches, `vendor/`, `node_modules/`, generated frontend assets and the source archive's previous Git history. The fresh repository's initial commit contains 133 files.

## Verification Evidence and Boundaries

- **EXECUTED-PASS (local, pre-publication):** 101/101 PHP syntax checks, `composer validate --strict`, and `git diff --cached --check`.
- **EXECUTED-PASS (limited scan):** No matches in the targeted staged-file token-pattern check; not a comprehensive secret or privacy audit.
- **STATIC-REVIEW:** Source structure, declared dependencies, original feature areas, known access-control/payment/pricing gaps and excluded files.
- **NOT-RUN:** Clean dependency install, app boot, migrations, PHPUnit behavioural tests, frontend build, browser verification, Stripe payment flow and production deployment.

The historical application logic retains known security limitations. It must not be deployed with real users, student records or live payments. A fresh local database contains no restored catalogue or uploaded product images.

## Provenance and Rights

Initial public snapshot: [`7d1f392`](https://github.com/PetrosTam/unisaver-legacy/commit/7d1f392313f4f31f11f3fdadfd3dcd5392278ade). The public repository is intended for portfolio review, not as evidence of current production readiness or successful student-financial outcomes.

The [proprietary LICENSE](../LICENSE) applies to original materials only where Petros Tamboutsiaris holds the relevant rights. University terms and third-party rights remain applicable. Publication permissions for individual components have not been independently verified.
