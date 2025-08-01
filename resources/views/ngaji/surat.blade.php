@extends('ngaji.layouts.app')

@section('title', 'Daftar Surat Al-Quran')
@section('meta_description', 'Daftar surat lengkap dalam Al-Quran. Pelajari dan baca terjemahan serta tafsirnya secara online.')
@section('meta_keywords', 'daftar surat alquran, 114 surat, quran digital, ngaji')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
        <h2 class="text-xl font-bold">📚 Daftar Surat</h2>

        <div class="flex items-center gap-2 w-full sm:w-auto">
            <input
                type="text"
                id="searchBox"
                placeholder="Cari surat..."
                class="w-full sm:w-64 px-3 py-2 rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-neutral-800 text-sm"
                oninput="filterSurat(this.value)"
            />
        </div>
    </div>

    <div id="suratList" class="grid grid-cols-2 sm:grid-cols-3 gap-4">
        @foreach ($surat as $s)
            <a href="{{ url('/ngaji/surat/' . $s['slug']) }}" class="block p-4 bg-white dark:bg-neutral-800 rounded shadow hover:bg-blue-50 dark:hover:bg-neutral-700 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm font-bold">
                        {{ $s['nomor'] }}
                    </div>
                    <div>
                        <div class="font-semibold">{{ $s['nama_latin'] }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">{{ $s['arti'] }} - {{ $s['jumlah_ayat'] }} ayat</div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <script>
        function filterSurat(keyword) {
            keyword = keyword.toLowerCase();
            document.querySelectorAll('#suratList a').forEach(el => {
                const text = el.textContent.toLowerCase();
                el.style.display = text.includes(keyword) ? '' : 'none';
            });
        }
    </script>
@endsection
