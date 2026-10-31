# Portfolio snapshot scope

This snapshot was reconstructed from a separately supplied legacy Laravel source archive on 2026-10-31. It is *not* a clean-sheet implementation of the new UniSaver engineering proposal.

Minimal publication-only source adjustments:

- Removed hardcoded administrator email in `app/Models/User.php`; replaced with a **default-deny**, locally configured email in `config/legacy.php` (`UNISAVER_LEGACY_ADMIN_EMAIL`). It remains insufficient authorization for production.
- Omitted a remotely hotlinked third-party hero image and replaced it with a neutral placeholder in `resources/views/livewire/home-page.blade.php`.
- Replaced the default Laravel README with a factual portfolio README.
- Extended `.gitignore` to exclude local data, secrets, and generated dependency assets.
- Used a blank `.env.example` for test-only settings and corrected a scaffold MIT license declaration to `proprietary` in `composer.json`. This is a proposal only; owner must confirm code rights before publication. The existing Composer lockfile hash needs validation against this metadata change.

All other first-party app code is preserved as received, including known security vulnerabilities. Do not deploy or use with real identities or payments. No code, images, environment files, or Git history were copied from the user's *new* UniSaver repository.
