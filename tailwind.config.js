/** @type {import('tailwindcss').Config} */
const colors = require('tailwindcss/colors');
const plugin = require('tailwindcss/plugin')

module.exports = {
content: [
             "./assets/**/*.js",
         "./templates/**/*.html.twig",
],
theme: {
extend: {
colors: {
transparent: 'transparent',
             current: 'currentColor',
             black: colors.black,
             white: colors.white,
             rose: colors.rose,
             pink: colors.pink,
             fuchsia: colors.fuchsia,
             purple: colors.purple,
             violet: colors.violet,
             indigo: colors.indigo,
             blue: colors.blue,
             lightBlue: colors.sky, // Only in Tailwind CSS <=v2.1
             sky: colors.sky, // As of Tailwind CSS v2.2, `lightBlue` has been renamed to `sky`
             cyan: colors.cyan,
             teal: colors.teal,
             emerald: colors.emerald,
             green: colors.green,
             lime: colors.lime,
             yellow: colors.yellow,
             amber: colors.amber,
             orange: colors.orange,
             red: colors.red,
             slate: colors.slate,
             zinc: colors.zinc,
             gray: colors.gray,
             neutral: colors.slate,
             stone: colors.stone,
        },
        },
},
plugins: [
    plugin(function({ addUtilities }) {
            addUtilities({
                    '.content-auto': {
                    'content-visibility': 'auto',
                    },
                    '.content-hidden': {
                    'content-visibility': 'hidden',
                    },
                    '.content-visible': {
                    'content-visibility': 'visible',
                    },
                    })
            }),
    require('@tailwindcss/forms'),
],
    }
