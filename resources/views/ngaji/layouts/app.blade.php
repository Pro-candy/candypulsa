<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Ngaji Online - Al-Quran Digital')</title>

    <meta name="description" content="@yield('meta_description', 'Baca Al-Quran digital lengkap dengan terjemahan, latin, dan tafsir. Pelajari surat dan ayat Al-Quran secara mudah.')">
    <meta name="keywords" content="@yield('meta_keywords', 'alquran digital, ngaji online, tafsir alquran, surat quran, ayat quran, terjemahan alquran, quran latin')">
    <meta name="author" content="Candy Pulsa / Ngaji Platform">

    <script src="https://cdn.tailwindcss.com?plugins=typography"></script>
    <link href="https://fonts.googleapis.com/css2?family=Amiri&display=swap" rel="stylesheet" />

    <style>
        .font-arabic {
            font-family: 'Amiri', serif;
        }
        /* Dark mode class */
        .dark body {
            background-color: #111827; /* netral-900 */
            color: #ffffff;
        }

        .dark .bg-white {
            background-corgb(41, 49, 59)2937 !important; /* dark neutral background */
        }

        .dark .text-gray-900 {
            color: #ffffff !important;
        }

        .dark .text-gray-800 {
            color: #d1d5db !important;
        }

        .dark .text-primary-500 {
            color: #93c5fd !important;
        }

        .dark .border-gray-300 {
            border-color: #4b5563 !important;
        }

        .dark .hover\:bg-gray-50:hover {
            background-color: #374151 !important;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 dark:bg-neutral-900 dark:text-white transition-colors duration-300">
    <div class="max-w-4xl mx-auto p-6">
        {{-- Global header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-semibold">📖 Ngaji</h1>
            <button id="toggleMode" class="text-sm px-3 py-1 border rounded">
                <span id="toggleIcon">🌙</span> Mode
            </button>
        </div>

        {{-- Content --}}
        @yield('content')
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const html = document.documentElement;
        const toggleButton = document.getElementById('toggleMode');
        const icon = document.getElementById('toggleIcon');

        function applyTheme(theme) {
            if (theme === 'dark') {
                html.classList.add('dark');
                icon.textContent = '☀️';
            } else {
                html.classList.remove('dark');
                icon.textContent = '🌙';
            }
        }

        if (toggleButton) {
            toggleButton.addEventListener('click', function () {
                const current = localStorage.getItem('theme') === 'dark' ? 'light' : 'dark';
                localStorage.setItem('theme', current);
                applyTheme(current);
            });
        }

        // Set theme on load
        applyTheme(localStorage.getItem('theme') || 'light');
    });
</script>

</body>
</html>
