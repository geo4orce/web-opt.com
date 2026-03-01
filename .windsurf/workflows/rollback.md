---
description: Rollback a site to its previous release
---

The user will specify a site name, e.g. `/rollback gdice.cc`. Valid sites: `gdice.cc`, `ezspell.com`, `web-opt.com`.

1. Rollback: `ssh geo@web-opt.com "sudo -u deploy deploy-rollback <site>"`

// turbo
2. Verify the site is responding: `ssh geo@web-opt.com "curl -s -o /dev/null -w '%{http_code}' https://<site>/"`

// turbo
3. Show the new active version: `ssh geo@web-opt.com "sudo -u deploy readlink /var/www/<site>/current | sed 's|releases/||'"`

// turbo
4. Check version.txt: `ssh geo@web-opt.com "curl -s https://<site>/version.txt"`
