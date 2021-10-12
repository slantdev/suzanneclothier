const plugin = require('tailwindcss/plugin');
const _ = require("lodash");
const colors = require('tailwindcss/colors');
const twp = require('./twp.json');

module.exports = {
  twp,
  purge: {
    content: [
      './*.php',
      './*/*.php',
    ],
    options: {
      safelist: {
        standard: [/^has-/, /^align/, /^wp-/]
      }
    }
  },
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.trueGray,
      blue: colors.blue,
      indigo: colors.indigo,
      red: colors.rose,
      orange: colors.orange,
      yellow: colors.amber,
      green: colors.green,
      teal: colors.teal,
      lime: colors.lime
    },
    container: {
      center: true,
      padding: {
        DEFAULT: '1rem',
        md: '2rem',
        lg: '2rem'
      },
    },
    boxShadow: {
      // Modified Tailwind Default
      sm: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
      DEFAULT: '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
      md: '0 4px 6px 0px rgba(0, 0, 0, 0.1), 0 2px 4px 0px rgba(0, 0, 0, 0.06)',
      lg: '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
      xl: '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
      '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
      '3xl': '0 35px 60px -15px rgba(0, 0, 0, 0.3)',
      inner: 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
      none: 'none',
      // Tailwind Default
      // sm: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
      // DEFAULT: '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
      // md: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
      // lg: '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
      // xl: '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
      // '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
      // '3xl': '0 35px 60px -15px rgba(0, 0, 0, 0.3)',
      // inner: 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
      // none: 'none',
      // https://box-shadows.co/
      // sm: '0px 1px 0px rgba(17,17,26,0.1);',
      // DEFAULT: '0px 1px 0px rgba(17,17,26,0.05), 0px 0px 8px rgba(17,17,26,0.1);',
      // md: '0px 0px 16px rgba(17,17,26,0.1);',
      // lg: '0px 4px 16px rgba(17,17,26,0.05), 0px 8px 32px rgba(17,17,26,0.05);',
      // xl: '0px 4px 16px rgba(17,17,26,0.1), 0px 8px 32px rgba(17,17,26,0.05);',
      // '2xl': '0px 1px 0px rgba(17,17,26,0.1), 0px 8px 24px rgba(17,17,26,0.1), 0px 16px 48px rgba(17,17,26,0.1);',
      // '3xl': '0px 4px 16px rgba(17,17,26,0.1), 0px 8px 24px rgba(17,17,26,0.1), 0px 16px 56px rgba(17,17,26,0.1);',
      // inner: 'inset 0 2px 4px 0 rgba(17,17,26, 0.06)',
      // none: 'none',
    },
    fontSize: {
      'xs': ['.75rem', '1rem'],
      'sm': ['.875rem', '1.25rem'],
      'tiny': ['.875rem', '1.25rem'],
      'base': ['1rem', '1.5rem'],
      'lg': ['1.125rem', '1.75rem'],
      'xl': ['1.25rem', '1.75rem'],
      '2xl': ['1.5rem', '2rem'],
      '3xl': ['1.875rem', '2.25rem'],
      '4xl': ['2.25rem', '2.5rem'],
      '4_25xl': ['2.5rem', '1'],
      '5xl': ['3rem', '1'],
      '6xl': ['4rem', '1'],
      '7xl': ['5rem', '1'],
    },
    extend: {
      colors: twp.colors,
      fontFamily: twp.fontFamily,
      maxWidth: twp.maxWidth,
      typography: (theme) => ({
        DEFAULT: {
          css: {
            color: theme('colors.gray.700'),
            a: {
              color: twp.colors.link.DEFAULT,
              '&:hover': {
                color: twp.colors.link.hover,
              },
            }
          },
        },
      }),
    },
  },
  plugins: [
    plugin(function ({ addUtilities, addComponents, e, prefix, config, theme }) {
      const colors = theme('colors');
      const margin = theme('margin');
      const screens = theme('screens');
      const fontSize = theme('fontSize');

      const editorColorText = _.map(config("twp.colors", {}), (value, key) => {
        return {
          [`.has-${key}-text-color`]: {
            color: value,
          },
        };
      });

      const editorColorBackground = _.map(config("twp.colors", {}), (value, key) => {
        return {
          [`.has-${key}-background-color`]: {
            backgroundColor: value,
          },
        };
      });

      const editorFontSizes = _.map(config("twp.fontSizes", {}), (value, key) => {
        return {
          [`.has-${key}-font-size`]: {
            fontSize: value[0],
            fontWeight: `${value[1] || 'normal'}`
          },
        };
      });

      const alignmentUtilities = {
        '.alignfull': {
          margin: `${margin[2] || '0.5rem'} calc(50% - 50vw)`,
          maxWidth: '100vw',
          "@apply w-screen": {}
        },
        '.alignwide': {
          "@apply -mx-16 my-2 max-w-screen-xl": {}
        },
        '.alignnone': {
          "@apply h-auto max-w-full mx-0": {}
        },
        ".aligncenter": {
          margin: `${margin[2] || '0.5rem'} auto`,
          "@apply block": {}
        },
        [`@media (min-width: ${screens.sm || '640px'})`]: {
          '.alignleft:not(.wp-block-button)': {
            marginRight: margin[2] || '0.5rem',
            "@apply float-left": {}
          },
          '.alignright:not(.wp-block-button)': {
            marginLeft: margin[2] || '0.5rem',
            "@apply float-right": {}
          },
          ".wp-block-button.alignleft a": {
            "@apply float-left mr-4": {},
          },
          ".wp-block-button.alignright a": {
            "@apply float-right ml-4": {},
          },
        },
      };

      const imageCaptions = {
        '.wp-caption': {
          "@apply inline-block": {},
          '& img': {
            marginBottom: margin[2] || '0.5rem',
            "@apply leading-none": {}
          },
        },
        '.wp-caption-text': {
          fontSize: (fontSize.sm && fontSize.sm[0]) || '0.9rem',
          color: (colors.gray && colors.gray[600]) || '#718096',
        },
      };

      addUtilities([editorColorText, editorColorBackground, alignmentUtilities, editorFontSizes, imageCaptions], {
        respectPrefix: false,
        respectImportant: false,
      });
    }),
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/line-clamp'),
  ]
};
