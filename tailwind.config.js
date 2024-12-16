import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import preset from './vendor/filament/support/tailwind.config.preset'
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    presets: [preset],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',

        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Rubik', ...defaultTheme.fontFamily.sans],
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {

                gray: colors.neutral,
                'sksu': {
                    '50': '#edfff3',
                    '100': '#d6ffe6',
                    '200': '#afffcd',
                    '300': '#71ffa9',
                    '400': '#2dfb7c',
                    '500': '#02e55a',
                    '600': '#00bf47',
                    '700': '#00993c',
                    '800': '#067532',
                    '900': '#085f2c',
                    '950': '#003616',
                },


        }

        },
    },

    plugins: [forms, typography],
};
