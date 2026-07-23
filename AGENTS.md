# Web-Opt.com

## Application

- Static HTML, SCSS, and vanilla JavaScript built with Vite.
- No framework, PHP runtime, database, session, worker, or queue.
- `POST /api/contact-us` is handled by the DigitalOcean Function project in
  `functions/`.
- Preserve the existing visual design and content until a separate facelift is
  explicitly requested.

## Local workflow

```powershell
npm ci
npm run verify
npm run dev
```

Node 24 or newer is required. `npm run verify` is the release gate.

## Contact Function

The Function uses Google Workspace SMTP through Nodemailer. Required encrypted
runtime environment variables:

- `MAIL_HOST`
- `MAIL_PORT`
- `MAIL_USER`
- `MAIL_PASSWORD`
- `MAIL_ENCRYPTION`
- `MAIL_TO`

Never commit values or log visitor addresses, names, message bodies, provider
payloads, or credentials. The hidden `name` field is a honeypot. Human requests
require a valid email and non-empty message; the visitor address is `Reply-To`.

## Deployment state

Target deployment is DigitalOcean App Platform:

- GitHub `geo4orce/web-opt.com`, branch `main`, autodeploy enabled.
- Static component build: `npm ci && npm run verify`; output: `dist`.
- Functions component source directory: `functions`.
- Ingress routes `/api/contact-us` to package/function `api/contact-us` and `/`
  to the static component.
- `/qr1` remains a permanent redirect to `https://blinq.me/f5TLMRTbpG0j`.
- `web-opt.com` is canonical; `www` redirects permanently to the apex.

Until the App Platform cutover is verified, production remains the legacy
Laravel deployment on the shared droplet. Do not delete its files, nginx config,
certificate, environment, or Bitbucket repository as part of application work.
Refer to the separate `infra` repository for the current migration record.
