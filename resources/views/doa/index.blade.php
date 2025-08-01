@extends('ngaji.layouts.app')

@section('title', 'Kumpulan Doa')
@section('meta_description', 'Kumpulan doa-doa pilihan untuk kehidupan sehari-hari. Doa rezeki, perjalanan, kesehatan, dan lainnya.')
@section('meta_keywords', 'doa, kumpulan doa, doa islam, doa harian, doa quran')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-4">
        <h2 class="text-xl font-bold">📚 Kumpulan Doa</h2>

        <div class="flex items-center gap-2 w-full sm:w-auto">
            <input
                type="text"
                id="searchBox"
                placeholder="Cari doa..."
                class="w-full sm:w-64 px-3 py-2 rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-neutral-800 text-sm"
                oninput="filterDoa(this.value)"
            />
        </div>
    </div>

    <div id="doaList" class="grid grid-cols-2 sm:grid-cols-3 gap-4">
        @foreach ($doaList as $doa)
            <a href="{{ url($doa['slug']) }}" class="block p-4 bg-white dark:bg-neutral-800 rounded shadow hover:bg-blue-50 dark:hover:bg-neutral-700 transition">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center text-sm font-bold">
                        {{ $doa['nomor'] }}
                    </div>
                    <div>
                        <div class="font-semibold">{{ $doa['judul'] }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-300">{{ $doa['jumlah'] }}</div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <script>
        function filterDoa(keyword) {
            keyword = keyword.toLowerCase();
            document.querySelectorAll('#doaList a').forEach(el => {
                const text = el.textContent.toLowerCase();
                el.style.display = text.includes(keyword) ? '' : 'none';
            });
        }
    </script>
@endsection
