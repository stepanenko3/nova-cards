import vue from "@vitejs/plugin-vue";
import { resolve } from "path";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [vue()],

    define: {
        "process.env": process.env, // Vite ditched process.env, so we need to pass it in
    },

    build: {
        outDir: resolve(__dirname, "dist"),
        emptyOutDir: true,
        target: "ES2022",
        minify: true,
        manifest: true,
        lib: {
            entry: resolve(__dirname, "resources/js/entry.js"),
            name: "cards",
            formats: ["umd"],
            fileName: () => "js/entry.js",
        },
        rollupOptions: {
            input: resolve(__dirname, "resources/js/entry.js"),
            external: ["vue", "Nova", "LaravelNova"],
            output: {
                globals: {
                    vue: "Vue",
                    nova: "Nova",
                    "laravel-nova": "LaravelNova",
                },
                assetFileNames: "css/card.css",
            },
        },
    },

    optimizeDeps: {
        include: ["vue", "@inertiajs/inertia", "@inertiajs/inertia-vue3", "axios"],
    },
});
