@extends('general.layouts.main')
@section('container')
    <div class="container my-5">
        <h2 class="mb-4">{{ $title }}</h2>
        <div class="alert alert-primary">
            {{ $message }}
        </div>
        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>
@endsection
