/// <reference types="vitest" />  // ← これを追加
import { wayfinder } from "@laravel/vite-plugin-wayfinder";
import tailwindcss from "@tailwindcss/vite";
import vue from "@vitejs/plugin-vue";
import laravel from "laravel-vite-plugin";
import { defineConfig } from "vitest/config";

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/js/app.ts"],
      ssr: "resources/js/ssr.ts",
      refresh: true,
    }),
    tailwindcss(),
    vue({
      template: {
        transformAssetUrls: {
          base: null,
          includeAbsolute: false,
        },
      },
    }),
    wayfinder({
      formVariants: true,
    }),
  ],
  test: {
    globals: true,
    environment: "jsdom",
    include: ["resources/js/tests/**/*.{test,spec}.js"],
  },
  server: {
    host: "0.0.0.0", // すべてのネットワークインターフェースを許可
    hmr: {
      host: "localhost", // ブラウザがHMR接続しに行く先
    },
    proxy: {
      "/get_expense_purpose": {
        // 💡 同一コンテナ内、あるいはDockerネットワーク内からNginxの窓口へ転送します
        target: "http://nginx",
        changeOrigin: true,
      },
    },
  },
});
