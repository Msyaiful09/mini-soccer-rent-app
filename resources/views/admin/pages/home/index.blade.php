@extends('admin.layouts.main')
@section('container')
    <div class="row">
        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Total Pengguna</h5>
                    <h3 class="text-primary">{{ $totalUsers }}</h3>
                    <small>{{ $totalCustomers }} Customer, {{ $totalAdmins }} Admin</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Total Lapangan</h5>
                    <h3 class="text-success">{{ $totalFields }}</h3>
                    <small>{{ $totalPlayTimes }} Jam Main</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Total Sewa</h5>
                    <h3 class="text-warning">{{ $totalRents }}</h3>
                    <small>{{ $pendingRents }} Menunggu</small>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-4">
            <div class="card shadow h-100 text-center">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title">Total Pendapatan</h5>
                    <h3 class="text-success">Rp{{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    <small>Dari transaksi yang sudah dibayar</small>
                </div>
            </div>
        </div>
    </div>
@endsection
