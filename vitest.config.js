import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import path from 'path'; // ← à ajouter

export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'resources/js'), 
    },
  },
  test: {
    globals: true,
    environment: 'jsdom',
    setupFiles: './vitest.setup.js',
  },
});
