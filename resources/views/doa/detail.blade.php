@extends('ngaji.layouts.app')

@section('title', $judul)
@section('meta_description', "$judul berisi $jumlah bacaan doa untuk kebutuhan sehari-hari.")
@section('meta_keywords', "kumpulan doa, $judul, doa harian, doa islami")

@section('content')
    <h2 class="text-xl font-bold mb-4 text-center">{{ $judul }}</h2>
    <p class="text-sm text-center text-gray-500 mb-6">{{ $jumlah }}</p>

    @foreach ($doaList as $index => $doa)
        <div class="mb-6">
            <h3 class="text-lg font-semibold text-center mb-2">{{ $doa['judul'] }}</h3>
            <p class="text-right font-arabic text-2xl leading-loose mb-2" dir="rtl">{{ $doa['arab'] }}</p>
            <p class="text-primary-600 italic mb-2">{{ $doa['latin'] }}</p>
            <p class="text-gray-700 dark:text-gray-300">{{ $doa['terjemahan'] }}</p>
        </div>
    @endforeach
@endsection
