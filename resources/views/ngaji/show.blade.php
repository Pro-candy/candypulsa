@extends('ngaji.layouts.app')

@php
    $ayatNumber = $ayatData['ayat'] ?? ($ayat ?? '');
@endphp

@section('title', 'Surat ' . ($surat['nama_latin'] ?? $surat['slug']) . ' Ayat ' . $ayatNumber . ' - Teks Arab & Terjemahan')
@section('meta_description', 'Pelajari surat ' . ($surat['nama_latin'] ?? $surat['slug']) . ' ayat ' . $ayatNumber . ' lengkap dengan teks Arab, latin dan terjemahan.')
@section('meta_keywords', 'surat ' . ($surat['slug'] ?? '') . ' ayat ' . $ayatNumber . ', ngaji, quran online, terjemah alquran')

@section('content')
<div class="mb-8">
    <div class="flex justify-between items-stretch gap-2 text-center">

        {{-- Tombol Prev --}}
        @if ($prevAyat)
            @php
                $prevSuratJson = @file_get_contents(storage_path('quran/' . $prevAyat['slug'] . '.json'));
                $prevSurat = $prevSuratJson ? json_decode($prevSuratJson, true) : null;
                $prevNama = $prevSurat['nama_latin'] ?? $prevAyat['slug'];
                $prevNomor = $prevAyat['ayat'];
            @endphp
            <a href="{{ url('/ngaji/surat/' . $prevAyat['slug'] . '/' . $prevAyat['ayat']) }}"
               class="flex-1 h-16 px-3 py-2 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-gray-600 rounded hover:bg-gray-50 dark:hover:bg-neutral-700 text-sm flex flex-col items-center justify-center text-center gap-1 whitespace-normal leading-tight">
                <svg class="w-4 h-4 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z" clip-rule="evenodd"/>
                </svg>
                {{ $prevNama }} {{ $prevNomor }}
            </a>
        @endif

        {{-- Tombol Daftar Surat --}}
        <a href="{{ url('/ngaji/surat') }}"
           class="flex-1 h-16 px-3 py-2 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-gray-600 rounded hover:bg-gray-50 dark:hover:bg-neutral-700 text-sm flex flex-col items-center justify-center text-center gap-1 whitespace-normal leading-tight">
            <svg class="w-4 h-4 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m-6-6h12"/>
            </svg>
            Daftar Surat
        </a>

        {{-- Tombol Next --}}
        @if ($nextAyat)
            @php
                $nextSuratJson = @file_get_contents(storage_path('quran/' . $nextAyat['slug'] . '.json'));
                $nextSurat = $nextSuratJson ? json_decode($nextSuratJson, true) : null;
                $nextNama = $nextSurat['nama_latin'] ?? $nextAyat['slug'];
                $nextNomor = $nextAyat['ayat'];
            @endphp
            <a href="{{ url('/ngaji/surat/' . $nextAyat['slug'] . '/' . $nextAyat['ayat']) }}"
               class="flex-1 h-16 px-3 py-2 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-gray-600 rounded hover:bg-gray-50 dark:hover:bg-neutral-700 text-sm flex flex-col items-center justify-center text-center gap-1 whitespace-normal leading-tight">
                {{ $nextNama }} {{ $nextNomor }}
                <svg class="w-4 h-4 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd"/>
                </svg>
            </a>
        @endif

    </div>
</div>


<header class="mb-6 text-center">
    <h1 class="text-4xl font-bold font-arabic leading-relaxed">{{ $ayatData['teks'] ?? '' }}</h1>
    <p class="text-sm mt-2 text-gray-600 dark:text-gray-400 italic">
        {{ $surat['nama_latin'] ?? ucwords(str_replace('-', ' ', $surat['slug'])) }} - Ayat {{ $ayatNumber }}
    </p>
</header>

<section class="mb-4">
    <h2 class="text-xl font-semibold mb-2">Latin</h2>
    <p class="italic text-primary-600 dark:text-primary-400">{{ $ayatData['latin'] ?? '' }}</p>
</section>

<section>
    <h2 class="text-xl font-semibold mb-2">Terjemahan</h2>
    <p class="text-gray-800 dark:text-gray-300">{{ $ayatData['terjemah'] ?? '' }}</p>
</section>

@if (!empty($ayatData['tafsir']))
    <section class="mt-6">
        <h2 class="text-xl font-semibold mb-2">Tafsir</h2>
        <p class="text-gray-800 dark:text-gray-300">{{ $ayatData['tafsir'] }}</p>
    </section>
@endif
@endsection
