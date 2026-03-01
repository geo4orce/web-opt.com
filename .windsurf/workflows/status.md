---
description: Show server status — releases, active versions, and site health for all 3 sites
---

// turbo
1. List all releases and active versions for each site:
   ```
   ssh geo@web-opt.com "for site in gdice.cc ezspell.com web-opt.com; do echo \"== $site ==\"; echo \"  releases: $(sudo -u deploy ls /var/www/$site/releases/ | tr '\n' ' ')\"; echo \"  active:   $(sudo -u deploy readlink /var/www/$site/current | sed 's|releases/||')\"; echo ''; done"
   ```

// turbo
2. Verify all 3 sites are responding and show version.txt:
   ```
   ssh geo@web-opt.com "for site in gdice.cc ezspell.com web-opt.com; do code=$(curl -s -o /dev/null -w '%{http_code}' https://$site/); ver=$(curl -s https://$site/version.txt); echo \"$site  HTTP $code  version $ver\"; done"
   ```
