/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        screens: {
            'xs': '480px',   // Breakpoint ekstra kecil
            'sm': '640px',   // Small devices
            'md': '768px',   // Medium devices
            'lg': '1024px',  // Large devices
            'xl': '1280px',  // Extra large devices
            '2xl': '1536px', // Extra extra large devices
          },
        extend: {
            colors: {
                'avseccolor': '#8ca3c3'
            },

            fontSize: {
                '2xs': '0.625rem',
            },

            maxWidth: {
                'screen-xs': '480px',
                'screen-2xl': '1920px'
              }
        },
    },
    plugins: [],
}

