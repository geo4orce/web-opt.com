import { defineConfig } from "vite";

export default defineConfig({
    publicDir: "static",
    build: {
        emptyOutDir: true,
        outDir: "dist",
        sourcemap: false,
    },
});
