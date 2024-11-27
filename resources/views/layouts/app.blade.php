<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $theme === 'dark' ? 'dark' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config(
        'app.name',
        'Oentoeng Space
        
        ',
    ) }}</title>
    <!-- Fonts & Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <!-- Flex Wrapper -->
    <div class="flex flex-col min-h-screen">
        <!-- Navigation Bar -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Main Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-4">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <!-- Informasi Situs -->
                        <h3 class="text-lg font-semibold mb-2">Oentoeng Space</h3>
                        <p class="text-gray-400 text-sm mb-4">Sistem booking lapangan terbaik untuk memenuhi kebutuhan
                            olahraga Anda. Pesan lapangan kapan saja dan di mana saja dengan mudah.</p>

                        <!-- Kontak -->
                        <h4 class="text-lg font-semibold mb-2">Hubungi Kami</h4>
                        <ul>
                            <li class="flex items-center text-sm mb-2">
                                <svg class="w-5 h-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 12H8m8 0V8m0 4V8m0 0l-6 6m6-6H8m6 0H8"></path>
                                </svg>
                                <a href="mailto:oentoengspace@gmail.com">oentoengspace@gmail.com</a>
                            </li>
                            <li class="flex items-center text-sm mb-2">
                                <!-- Ikon Telepon -->
                                <svg class="w-5 h-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10l1 2m3 7l1 2m4-9l1-2m6-4l1 2m-3 7l1 2"></path>
                                </svg>
                                <span>+6285 133 825 663</span>
                                <a href="https://wa.me/6285133825663" class="ml-2 text-blue-500" target="_blank">Chat
                                    via WhatsApp</a>
                            </li>
                            <li class="flex items-center text-sm">
                                <!-- Ikon Alamat -->
                                <svg class="w-5 h-5 mr-2 text-blue-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h18v18H3z"></path>
                                </svg>
                                <span>Jl. Titan, Ela-Ela, Bulukumba</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Kolom Kanan (Google Maps) -->
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Lokasi Kami</h3>
                        <div class="overflow-hidden rounded-lg shadow-md">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15936.869457160334!2d120.04236393955075!3d-5.5478766999999965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbf7fd6bb8ecb9f%3A0xaaa7392222d51dd2!2sC6X3%2B2VR%2C%20Ela-Ela%2C%20Kec.%20Ujung%20Bulu%2C%20Kabupaten%20Bulukumba%2C%20Sulawesi%20Selatan!5e0!3m2!1sen!2sid!4v1697815896031!5m2!1sen!2sid"
                                width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>

                <div class="mt-4 border-t border-gray-700 pt-2 text-center">
                    <p class="text-gray-400 text-xs">&copy; 2024 Oentoeng Space. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
