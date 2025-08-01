@extends('ngaji.layouts.app')

@section('title', $surat['nama_latin'] . ' - Al-Quran dan Terjemahan')
@section('meta_description', 'Baca surat ' . $surat['nama_latin'] . ' lengkap dengan teks Arab, latin, dan terjemah bahasa Indonesia.')
@section('meta_keywords', 'surat ' . $surat['nama_latin'] . ', arti ' . $surat['nama_latin'] . ', ngaji, alquran, tafsir')

@section('content')
    <div class="mb-4">
        <div class="flex justify-between items-stretch gap-2 text-center">
            {{-- Tombol Sebelumnya --}}
            @if ($prevSurat)
                <a href="{{ url('/ngaji/surat/' . $prevSurat['slug']) }}"
                class="flex-1 h-16 px-3 py-2 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-gray-600 rounded hover:bg-gray-50 dark:hover:bg-neutral-700 text-sm flex flex-col items-center justify-center text-center gap-1 whitespace-normal leading-tight">
                    <svg class="w-4 h-4 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z" clip-rule="evenodd" />
                    </svg>
                    {{ $prevSurat['nama_latin'] }}
                </a>
            @else
                <div class="flex-1 h-16"></div>
            @endif

            {{-- Tombol Daftar Surat --}}
            <a href="{{ url('/ngaji/surat') }}"
            class="flex-1 h-16 px-3 py-2 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-gray-600 rounded hover:bg-gray-50 dark:hover:bg-neutral-700 text-sm flex flex-col items-center justify-center text-center gap-1 whitespace-normal leading-tight">
                <svg class="w-4 h-4 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m-6-6h12" />
                </svg>
                Daftar Surat
            </a>

            {{-- Tombol Berikutnya --}}
            @if ($nextSurat)
                <a href="{{ url('/ngaji/surat/' . $nextSurat['slug']) }}"
                class="flex-1 h-16 px-3 py-2 bg-white dark:bg-neutral-800 border border-gray-300 dark:border-gray-600 rounded hover:bg-gray-50 dark:hover:bg-neutral-700 text-sm flex flex-col items-center justify-center text-center gap-1 whitespace-normal leading-tight">
                    {{ $nextSurat['nama_latin'] }}
                    <svg class="w-4 h-4 text-primary-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                    </svg>
                </a>
            @else
                <div class="flex-1 h-16"></div>
            @endif
        </div>
    </div>

    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold">
            {{ $surat['nomor'] }}. {{ $surat['nama_latin'] }}
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $surat['arti'] }} · {{ $surat['jumlah_ayat'] }} ayat
        </p>
    </div>


    <div class="space-y-8">


        @foreach ($surat['ayat'] as $ayat)
            <div class="border-b border-gray-300 dark:border-gray-700 pb-4 group">
                <a href="{{ url('/ngaji/surat/' . $surat['slug'] . '/' . $ayat['ayat']) }}"
                class="block">
                    <div class="text-3xl text-right leading-loose font-arabic hover:text-primary-500 transition duration-200">
                        {{ $ayat['arab'] }}
                    </div>
                    <div class="text-primary-500 mt-2 italic">{{ $ayat['latin'] }}</div>
                    <div class="text-sm text-gray-700 dark:text-gray-300">{{ $ayat['terjemah'] }}</div>
                </a>
            </div>

        @endforeach
    </div>
@endsection