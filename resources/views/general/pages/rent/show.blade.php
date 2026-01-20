@extends('general.layouts.main')

@section('container')
    <div class="container my-5">

        <div class="card shadow rounded-4 p-4 mx-auto" style="max-width: 600px;">
            <h4 class="mb-3 text-primary fw-bold">Detail Pembayaran Sewa</h4>

            <div class="mb-3">
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Kode Sewa</span>
                    <span class="fw-semibold">{{ $rent->rent_receipt }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Lapangan</span>
                    <span class="fw-semibold">{{ $rent->field->name }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Tanggal Sewa</span>
                    <span class="fw-semibold">
                        {{ $rent->rentDetails->first()->date ?? '-' }}
                    </span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Total Harga</span>
                    <span class="fw-bold text-primary fs-5">Rp{{ number_format($rent->total_price, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="text-muted">Status</span>
                    <span
                        class="badge 
                        @if ($rent->status == 'pending') bg-warning text-dark 
                        @elseif($rent->status == 'paid') bg-success 
                        @elseif($rent->status == 'canceled') bg-danger @endif">
                        {{ ucfirst($rent->status) }}
                    </span>
                </div>
            </div>

            <hr>

            @if ($rent->status === 'pending')
                <button id="pay-button" class="btn btn-primary w-100 mt-3">Bayar Sekarang</button>
            @elseif ($rent->status === 'paid')
                <div class="alert alert-success mt-3">
                    Pembayaran telah selesai.
                </div>
                <div class="d-grid gap-2 mt-3">
                    <a href="{{ route('rent.invoice.view', $rent->rent_receipt) }}" class="btn btn-outline-primary">
                        Lihat Invoice
                    </a>
                </div>
            @elseif ($rent->status === 'canceled')
                <div class="alert alert-danger mt-3">
                    Pesanan dibatalkan.
                </div>
            @endif

            <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 mt-4">Kembali ke Beranda</a>
        </div>

    </div>

    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script>
        document.getElementById('pay-button')?.addEventListener('click', function() {
            window.snap.pay('{{ $rent->snap_token }}', {
                onSuccess: function(result) {
                    window.location.href = '{{ route('rent.payment-status', $rent->rent_receipt) }}';
                },
                onPending: function(result) {
                    alert('Menunggu pembayaran...');
                },
                onError: function(result) {
                    alert('Pembayaran gagal!');
                }
            });
        });
    </script>
@endsection
