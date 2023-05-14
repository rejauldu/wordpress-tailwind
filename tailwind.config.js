/** @type {import('tailwindcss').Config} */

module.exports = {
    content: ['./**/*.php', './**/*.ts', './**/*.tsx'],
    autoprefixer: {},
    theme: {
        extend: {
            colors: {
                color1: 'var(--color1)',
                color2: 'var(--color2)',
                color3: 'var(--color3)',
                color4: 'var(--color4)',
                color5: 'var(--color5)',
                color6: 'var(--color6)',
                color7: 'var(--color7)',
                color8: 'var(--color8)',
                color9: 'var(--color9)',
                color10: 'var(--color10)',
                color11: 'var(--color11)',
                color12: 'var(--color12)',
                color13: 'var(--color13)',
                color14: 'var(--color14)',
                color15: 'var(--color15)',
                color16: 'var(--color16)',
            },
            fontFamily: {
                ralewayLight: 'var(--raleway-light)',
                ralewayRegular: 'var(--raleway-regular)',
                ralewayMedium: 'var(--raleway-medium)',
                ralewaySemiBold: 'var(--raleway-semibold)',
                ralewayBold: 'var(--raleway-bold)',
                ralewayExtraBold: 'var(--raleway-extrabold)',
                cabinRegular: 'var(--cabin-regular)',
                cabinMedium: 'var(--cabin-medium)',
                cabinSemiBold: 'var(--cabin-semibold)',
                cabinBold: 'var(--cabin-bold)',
            },
            screens: {
                'xs': '350px'
            },
            borderRadius: {
                radius1: 'var(--border-radius1)',
                radius2: 'var(--border-radius2)'
            },
        }
    }
};
