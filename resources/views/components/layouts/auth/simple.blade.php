<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased bg-gray-50 text-gray-900 dark:bg-gray-950 dark:text-gray-100 selection:bg-indigo-500 selection:text-white">
        <!-- Background decorative elements -->
        <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-1/2 -right-1/4 w-[1000px] h-[1000px] rounded-full bg-indigo-500/20 dark:bg-indigo-500/10 blur-[100px]"></div>
            <div class="absolute -bottom-1/2 -left-1/4 w-[800px] h-[800px] rounded-full bg-blue-500/20 dark:bg-blue-500/10 blur-[100px]"></div>
        </div>

        <div class="relative z-10 flex min-h-svh flex-col items-center justify-center p-6 md:p-10">
            <div class="w-full max-w-md">
                <!-- Card Container -->
                <div class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl shadow-2xl ring-1 ring-gray-900/5 dark:ring-white/10 rounded-3xl p-8 sm:p-10 transition-all duration-300">
                    <div class="flex flex-col items-center gap-4 mb-2">
                        <a href="{{ route('login') }}" class="flex flex-col items-center gap-3 font-medium transition-transform hover:scale-105 duration-300">
                            <!-- GudangBuku Logo SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 160 60" width="160" height="60" aria-label="GudangBuku">
                                <!-- G icon shape -->
                                <g>
                                    <!-- Book bottom (open pages) -->
                                    <path d="M10 30 Q20 42 30 30" fill="#F9B300" />
                                    <path d="M30 30 Q40 42 50 30" fill="#F9B300" />
                                    <!-- G letter body -->
                                    <path d="M18 8 A14 14 0 1 0 44 22 L34 22 L34 28 L44 28 A14 14 0 0 0 18 8 Z"
                                          fill="none" stroke="#6366F1" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <line x1="35" y1="22" x2="44" y2="22" stroke="#6366F1" stroke-width="5" stroke-linecap="round"/>
                                </g>
                                <!-- Text: Gudang -->
                                <text x="62" y="28" font-family="DM Sans, system-ui, sans-serif" font-weight="700" font-size="20" fill="#6366F1">Gudang</text>
                                <!-- Text: Buku -->
                                <text x="62" y="50" font-family="DM Sans, system-ui, sans-serif" font-weight="700" font-size="20" fill="#F9B300">Buku</text>
                            </svg>
                        </a>
                    </div>
                    
                    <div class="space-y-6">
                        {{ $slot }}
                    </div>
                </div>
                
                <!-- Footer -->
                <p class="text-center text-sm text-gray-500 dark:text-gray-400 mt-8">
                    &copy; {{ date('Y') }} GudangBuku. All rights reserved.
                </p>
            </div>
        </div>
    </body>
</html>
