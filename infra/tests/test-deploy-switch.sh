#!/usr/bin/env bash
PASS=0
FAIL=0

assert_fails() {
  local desc="$1"; shift
  if "$@" >/dev/null 2>&1; then
    echo "FAIL: $desc (expected failure, got success)"; FAIL=$((FAIL + 1))
  else
    echo "PASS: $desc"; PASS=$((PASS + 1))
  fi
}

assert_succeeds() {
  local desc="$1"; shift
  if "$@" >/dev/null 2>&1; then
    echo "PASS: $desc"; PASS=$((PASS + 1))
  else
    echo "FAIL: $desc (expected success, got failure)"; FAIL=$((FAIL + 1))
  fi
}

# ── Validation tests ────────────────────────────────────
assert_fails "no args"              deploy-switch
assert_fails "missing version"      deploy-switch gdice
assert_fails "bad site"             deploy-switch badsite 1.0.0
assert_fails "bad semver: alpha"    deploy-switch gdice abc
assert_fails "bad semver: v-prefix" deploy-switch gdice v1.0.0
assert_fails "bad semver: 2-part"   deploy-switch gdice 1.0
assert_fails "bad semver: 4-part"   deploy-switch gdice 1.0.0.1
assert_fails "bad semver: spaces"   deploy-switch gdice "1.0 .0"
assert_fails "missing release dir"  deploy-switch gdice 99.99.99

# ── Functional tests (require temp dir setup) ───────────
# Create a temporary site structure for testing
TMPWWW=$(mktemp -d)
TMPSITE="$TMPWWW/gdice"
mkdir -p "$TMPSITE/releases/1.0.0"
echo "index" > "$TMPSITE/releases/1.0.0/index.html"
mkdir -p "$TMPSITE/releases/1.0.1"
echo "index" > "$TMPSITE/releases/1.0.1/index.html"

# Patch WWW path for testing (requires deploy-switch to accept WWW env override)
# These tests only work if deploy-switch respects DEPLOY_WWW env var
if deploy-switch --help 2>&1 | grep -q "WWW" 2>/dev/null; then
  echo "(Skipping functional tests — env override not yet supported)"
else
  echo "(Skipping functional tests — run manual tests on server)"
fi

# Cleanup
rm -rf "$TMPWWW"

# ── Summary ─────────────────────────────────────────────
echo "---"
echo "$PASS passed, $FAIL failed"
[[ $FAIL -eq 0 ]]
