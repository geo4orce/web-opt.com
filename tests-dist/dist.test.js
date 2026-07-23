import assert from "node:assert/strict";
import { readdir, readFile } from "node:fs/promises";
import path from "node:path";
import test from "node:test";

async function filesUnder(directory) {
    const entries = await readdir(directory, { withFileTypes: true });
    const nested = await Promise.all(entries.map((entry) => {
        const target = path.join(directory, entry.name);
        return entry.isDirectory() ? filesUnder(target) : [target];
    }));
    return nested.flat();
}

test("production output contains the expected static site and no server source", async () => {
    const files = await filesUnder("dist");
    const relativeFiles = files.map((file) => path.relative("dist", file).replaceAll("\\", "/"));

    assert.ok(relativeFiles.includes("index.html"));
    assert.ok(relativeFiles.includes("robots.txt"));
    assert.ok(relativeFiles.includes("sitemap.xml"));
    assert.ok(relativeFiles.includes("404.html"));
    assert.equal(relativeFiles.some((file) => /(^|\/)(\.env|.*\.php|.*\.map)$/.test(file)), false);

    const index = await readFile("dist/index.html", "utf8");
    assert.match(index, /Home \| Web-Opt/);
    assert.match(index, /action="\/api\/contact-us"/);
    assert.match(index, /rel="canonical" href="https:\/\/web-opt\.com"/);

    const textFiles = files.filter((file) => /\.(?:css|html|js|json|txt|xml)$/.test(file));
    const combined = (await Promise.all(textFiles.map((file) => readFile(file, "utf8")))).join("\n");
    assert.doesNotMatch(combined, /MAIL_PASSWORD|smtp\.gmail\.com|@{{|<\?php/);
});
