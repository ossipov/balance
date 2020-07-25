module.exports = {
    purge: [
    './resources/vue/**/*.vue',
    './resources/views/**/*.blade.php'
    ],
    important: true,
    theme: {
        fontFamily: {
            sans: [
                'SFRounded',
                'system-ui',
                '-apple-system',
                'BlinkMacSystemFont',
                '"Segoe UI"',
                'Roboto',
                '"Helvetica Neue"',
                'Arial',
                '"Noto Sans"',
                'sans-serif',
                '"Apple Color Emoji"',
                '"Segoe UI Emoji"',
                '"Segoe UI Symbol"',
                '"Noto Color Emoji"',
            ],
            display: ['SFRounded', 'sans-serif'],
            body: ['SFRounded', 'sans-serif'],
        },
        extend: {
            colors: {
                cyan: '#9cdbff',
                gray: {
                    '100': '#f5f6fa', // modded
                    '200': '#eeeeee',
                    '300': '#e0e0e0',
                    '400': '#9a9a9a', // modded
                    '500': '#8a8d9a', // modded
                    '600': '#74798c', // modded
                    '700': '#616161',
                    '800': '#192b4e', // modded
                    '900': '#212121',
                },
                blue: {
                    100: '#EBF8FF',
                    200: '#BEE3F8',
                    300: '#90CDF4',
                    400: '#63B3ED',
                    500: '#0054fe', // modded
                    600: '#3182CE',
                    700: '#2B6CB0',
                    800: '#2C5282',
                    900: '#2A4365'
                },
                green: {
                    500: '#00b357'
                }


            },
            screens: {
                sm: '640px',
                md: '823px',
                lg: '1024px',
                xl: '1280px',
            },
        }
    },
    variants: {},
    plugins: [],
}
