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

7. Read version from package.json and store in a variable, e.g. `$VERSION = node -e "console.log(require('./package.json').version)"`

8. Rsync project to server (excludes .git, node_modules, vendor, storage, .env): `rsync -azP --delete --exclude='.git' --exclude='node_modules' --exclude='vendor' --exclude='storage' --exclude='.env' ./ deploy@web-opt.com:/var/www/web-opt.com/releases/$VERSION/`

9. Switch release (runs composer install, artisan caches, symlinks shared files): `ssh deploy@web-opt.com "deploy-switch web-opt.com $VERSION"`

// turbo
10. Verify: `ssh geo@web-opt.com "curl -s -o /dev/null -w '%{http_code}' https://web-opt.com/"`
