import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // == 1. Backgrounds & Text ==
                'p-bg': 'var(--bg-primary)',
                's-bg': 'var(--bg-secondary)',
                't-bg': 'var(--bg-tertiary)',

                'p-text': 'var(--text-primary)',
                's-text': 'var(--text-secondary)',

                // == 2. Functional & Accent ==
                'brand': 'var(--color-brand)',
                'success': 'var(--color-success)',
                'warning': 'var(--color-warning)',
                'danger': 'var(--color-danger)',
                'info': 'var(--color-info)',

                // == 3. Borders (можно добавить в colors или использовать стандартные) ==
                'border-default': 'var(--border-color)',
            },

            // Добавляем тени, которые используют переменную
            boxShadow: {
                'default': 'var(--shadow-color)',
            },

            // Опционально: можно добавить кастомные границы
            borderColor: {
                'default': 'var(--border-color)',
            }
        },
    },

    plugins: [forms],
};
