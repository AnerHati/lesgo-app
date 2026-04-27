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
                sans: ['Inter', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                'fade-in': {
                    '0%': { opacity: '0', transform: 'translateY(12px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'slide-up': {
                    '0%': { opacity: '0', transform: 'translateY(24px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'float': {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-6px)' },
                },
                'pulse-glow': {
                    '0%, 100%': { boxShadow: '0 0 0 0 rgba(59,130,246,0.15)' },
                    '50%': { boxShadow: '0 0 24px 4px rgba(59,130,246,0.15)' },
                },
                'shimmer': {
                    '0%': { backgroundPosition: '-200% 0' },
                    '100%': { backgroundPosition: '200% 0' },
                },
                'scale-in': {
                    '0%': { opacity: '0', transform: 'scale(0.95)' },
                    '100%': { opacity: '1', transform: 'scale(1)' },
                },
            },
            animation: {
                'fade-in': 'fade-in 0.5s ease-out both',
                'fade-in-delay-1': 'fade-in 0.5s ease-out 0.1s both',
                'fade-in-delay-2': 'fade-in 0.5s ease-out 0.2s both',
                'fade-in-delay-3': 'fade-in 0.5s ease-out 0.3s both',
                'slide-up': 'slide-up 0.6s ease-out both',
                'slide-up-delay-1': 'slide-up 0.6s ease-out 0.15s both',
                'slide-up-delay-2': 'slide-up 0.6s ease-out 0.3s both',
                'float': 'float 3s ease-in-out infinite',
                'pulse-glow': 'pulse-glow 2s ease-in-out infinite',
                'shimmer': 'shimmer 2s linear infinite',
                'scale-in': 'scale-in 0.3s ease-out both',
            },
        },
    },

    plugins: [forms],
};
