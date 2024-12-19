import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import preset from './vendor/filament/support/tailwind.config.preset'
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
    presets: [
        preset,
        require("./vendor/wireui/wireui/tailwind.config.js"),
       
    
    ],
    content: [
        
        "./vendor/wireui/wireui/src/*.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/WireUi/**/*.php",
        "./vendor/wireui/wireui/src/Components/**/*.php",

        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',


        // filament
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',

        //wire ui

    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Rubik', ...defaultTheme.fontFamily.sans],
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {

                gray: colors.neutral,
                primary: {
                    '50': '#eefbf2',
        '100': '#d5f6dd',
        '200': '#afebc0',
        '300': '#7bda9c',
        '400': '#45c274',
        '500': '#22a759',
        '600': '#148746',
        '700': '#106c3b',
        '800': '#0f5630',
        '900': '#0d4327',
        '950': '#062817',
                },
                secondary: colors.gray,
                positive: colors.emerald,
                negative: colors.red,
                warning: colors.amber,
                info: colors.blue,
               'sksu': {
                '50': '#eefbf2',
                '100': '#d5f6dd',
                '200': '#afebc0',
                '300': '#7bda9c',
                '400': '#45c274',
                '500': '#22a759',
                '600': '#148746',
                '700': '#106c3b',
                '800': '#0f5630',
                '900': '#0d4327',
                '950': '#062817',
                },



        }

        },
    },

    plugins: [forms, typography],
};
