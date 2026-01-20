@extends('general.layouts.main')

@section('container')
    <div class="container my-5">
        <div class="card shadow rounded-4 p-4 mx-auto" style="max-width: 700px;">
            <h3 class="mb-4 text-center text-primary fw-bold">Invoice Sewa Lapangan</h3>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Kode Invoice</span>
                    <span class="fw-semibold">{{ $rent->rent_receipt }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Nama Lapangan</span>
                    <span class="fw-semibold">{{ $rent->field->name }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Jenis Sewa</span>
                    <span class="fw-semibold text-capitalize">{{ $rent->rent_type }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Status</span>
                    <span
                        class="badge 
                        @if ($rent->status == 'paid') bg-success 
                        @elseif($rent->status == 'pending') bg-warning text-dark 
                        @elseif($rent->status == 'canceled') bg-danger @endif">
                        {{ ucfirst($rent->status) }}
                    </span>
                </div>
            </div>

            <hr>

            <h5 class="fw-bold mb-3">Detail Waktu Sewa:</h5>

            @php
                $detailsByDate = $rent->rentDetails->groupBy('date');
            @endphp

            @foreach ($detailsByDate as $date => $details)
                <div class="mb-3">
                    <h6 class="fw-bold mb-2">Tanggal: {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</h6>
                    <ul class="list-group">
                        @foreach ($details as $detail)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $detail->playTime->start_time }} - {{ $detail->playTime->end_time }}</span>
                                <span>Rp{{ number_format($detail->playTime->price, 0, ',', '.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach

            <div class="d-flex justify-content-between fs-5 fw-bold mt-4">
                <span>Total Harga</span>
                <span class="text-primary">Rp{{ number_format($rent->total_price, 0, ',', '.') }}</span>
            </div>

            <div class="d-grid gap-2 mt-4">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
@endsection
