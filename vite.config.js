import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import path from 'path';

const APP_URL = process.env.APP_URL || 'http://localhost:8002'
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
            env:{
                APP_URL:APP_URL
            }
        }),
    ],
    resolve: {
        alias: {
            '~bootstrap': path.resolve(__dirname, 'node_modules/bootstrap'),
        }
    },
});
