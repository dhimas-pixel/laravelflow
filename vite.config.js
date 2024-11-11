import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";
import path from "path";
import { defineConfig } from "vite";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/scss/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
            "~bootstrap": path.resolve(__dirname, "node_modules/bootstrap"),
            "ziggy-js": path.resolve("vendor/tightenco/ziggy"),
        },
    },
});
