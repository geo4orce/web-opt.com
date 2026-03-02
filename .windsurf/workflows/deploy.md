---
description: Deploy Web-Opt.com to production (build locally, rsync, switch release)
---

Full pipeline with fail-fast — abort and report on any failure.

Cascade: Before starting, check memory for when /maintain was last run on web-opt. If >30 days or never, remind user: "Dependencies haven't been updated in over a month. Consider running /maintain first." Don't block — just inform.

// turbo
1. Tests: `npm test`

// turbo
2. Build: `npm run prod`

// turbo
3. Bump patch version: `npm version patch --no-git-tag-version`

// turbo
4. Update lockfile after version bump: `npm install --package-lock-only`

5. If there are uncommitted changes, stage all and commit with a descriptive message. If clean, skip to step 6.

6. Push: `git push origin main`

Bitbucket Pipelines auto-deploys after push (builds, rsyncs project, runs deploy-switch with composer/artisan). Monitor at: https://bitbucket.org/Geo4orce/web-opt.com/pipelines
