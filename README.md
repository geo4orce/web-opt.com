# Web-Opt.com

Company website: [web-opt.com](https://web-opt.com/).

The site is a static HTML/SCSS/JavaScript build using Vite. A DigitalOcean
Function handles the same-origin contact endpoint and delivers mail through the
existing Google Workspace SMTP account.

## Local development

```powershell
npm ci
npm run dev
```

Run the complete local verification:

```powershell
npm run verify
```

This runs the browser-facing unit tests, contact Function tests, Vite production
build, and checks the `dist/` output for server source, source maps, and secrets.

The Function source and runtime configuration are under `functions/`. Its SMTP
values are supplied as encrypted runtime variables in App Platform and must not
be committed.

Infrastructure and migration status are documented in the separate `infra`
repository. The local `infra/` directory is retained temporarily as legacy
droplet rollback reference and is not used by the Vite or App Platform builds.
