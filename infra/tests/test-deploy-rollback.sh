#!/usr/bin/env bash
set -euo pipefail

PASS=0
FAIL=0

assert_fails() {
  local desc="$1"; shift
  if "$@" >/dev/null 2>&1; then
    echo "FAIL: $desc (expected failure, got success)"; ((FAIL++))
  else
    echo "PASS: $desc"; ((PASS++))
  fi
}

# ── Validation tests ────────────────────────────────────
assert_fails "no args"    deploy-rollback
assert_fails "bad site"   deploy-rollback badsite

# ── Summary ─────────────────────────────────────────────
echo "---"
echo "$PASS passed, $FAIL failed"
[[ $FAIL -eq 0 ]]
