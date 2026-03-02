---
description: Monthly dependency maintenance for Web-Opt.com
---

Update all dependencies (npm + composer), audit, test, and push. Run monthly or when Cascade reminds you.

// turbo
1. Update npm dependencies: `npm update`

2. Audit npm for vulnerabilities (report only — review output, don't auto-fix): `npm audit`

3. Update composer dependencies: `composer update --no-dev`

// turbo
4. Tests: `npm test`

// turbo
5. Build: `npm run prod`

6. Stage all and commit with message: "chore: monthly dependency update"

7. Push: `git push origin main`

8. Cascade: update memory with today's date as last-maintained for web-opt.
