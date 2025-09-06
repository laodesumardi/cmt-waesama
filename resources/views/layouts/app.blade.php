<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @auth
            <meta name="user-id" content="{{ Auth::id() }}">
        @endauth

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS CDN (Alternative method) -->
        <script src="https://cdn.tailwindcss.com"></script>

        <!-- Tailwind CSS Configuration -->
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: {
                                50: '#f0f4f8',
                                100: '#d9e6f2',
                                200: '#b3cde5',
                                300: '#8db4d8',
                                400: '#679bcb',
                                500: '#4182be',
                                600: '#14213d', // Main brand color
                                700: '#0f1a2e',
                                800: '#0a1423',
                                900: '#050d18',
                            },
                            secondary: {
                                50: '#f8fafc',
                                100: '#f1f5f9',
                                200: '#e2e8f0',
                                300: '#cbd5e1',
                                400: '#94a3b8',
                                500: '#64748b',
                                600: '#475569',
                                700: '#334155',
                                800: '#1e293b',
                                900: '#0f172a',
                            }
                        },
                        fontFamily: {
                            'sans': ['Figtree', 'ui-sans-serif', 'system-ui'],
                        },
                        animation: {
                            'fade-in': 'fadeIn 0.5s ease-in-out',
                            'fade-in-up': 'fadeInUp 0.6s ease-out',
                            'slide-in-right': 'slideInRight 0.4s ease-out',
                            'bounce-slow': 'bounce 3s infinite',
                            'pulse-slow': 'pulse 4s infinite',
                        },
                        keyframes: {
                            fadeIn: {
                                '0%': { opacity: '0' },
                                '100%': { opacity: '1' },
                            },
                            fadeInUp: {
                                '0%': { opacity: '0', transform: 'translateY(30px)' },
                                '100%': { opacity: '1', transform: 'translateY(0)' },
                            },
                            slideInRight: {
                                '0%': { opacity: '0', transform: 'translateX(100px)' },
                                '100%': { opacity: '1', transform: 'translateX(0)' },
                            }
                        },
                        backdropBlur: {
                            xs: '2px',
                        },
                        boxShadow: {
                            'glow': '0 0 20px rgba(20, 33, 61, 0.3)',
                            'glow-lg': '0 0 40px rgba(20, 33, 61, 0.4)',
                        }
                    }
                }
            }
        </script>

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Custom Styles for Enhanced Components -->
        <style>
            /* Glassmorphism utilities */
            .glass {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .glass-dark {
                background: rgba(20, 33, 61, 0.1);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                border: 1px solid rgba(20, 33, 61, 0.2);
            }

            /* Smooth scrolling */
            html {
                scroll-behavior: smooth;
            }

            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            ::-webkit-scrollbar-thumb {
                background: #14213d;
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #0f1a2e;
            }

            /* Focus outline customization */
            .focus-primary:focus {
                outline: 2px solid #14213d;
                outline-offset: 2px;
            }

            /* Gradient text utility */
            .gradient-text {
                background: linear-gradient(135deg, #14213d, #4182be);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            /* Loading animation */
            .loading-dots::after {
                content: '';
                animation: dots 1.5s steps(5, end) infinite;
            }

            @keyframes dots {
                0%, 20% {
                    color: rgba(0,0,0,0);
                    text-shadow:
                        .25em 0 0 rgba(0,0,0,0),
                        .5em 0 0 rgba(0,0,0,0);
                }
                40% {
                    color: #14213d;
                    text-shadow:
                        .25em 0 0 rgba(0,0,0,0),
                        .5em 0 0 rgba(0,0,0,0);
                }
                60% {
                    text-shadow:
                        .25em 0 0 #14213d,
                        .5em 0 0 rgba(0,0,0,0);
                }
                80%, 100% {
                    text-shadow:
                        .25em 0 0 #14213d,
                        .5em 0 0 #14213d;
                }
            }

            /* Hover effects */
            .hover-lift {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .hover-lift:hover {
                transform: translateY(-4px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            /* Button enhancements */
            .btn-primary {
                @apply bg-primary-600 hover:bg-primary-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 shadow-lg hover:shadow-glow;
            }

            .btn-secondary {
                @apply bg-secondary-500 hover:bg-secondary-600 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300;
            }

            .btn-outline {
                @apply border-2 border-primary-600 text-primary-600 hover:bg-primary-600 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300;
            }
        </style>

        @stack('styles')
    </head>
    <body class="font-sans antialiased bg-gray-50">
        @include('layouts.sidebar')

        @stack('scripts')
    </body>
</html>
