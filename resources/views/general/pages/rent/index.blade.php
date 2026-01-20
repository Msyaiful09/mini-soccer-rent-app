@extends('general.layouts.main')
@section('container')
    <div class="container py-5">
        <h2 class="mb-4">{{ $title }}</h2>

        @if ($rents->count())
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>No. Nota</th>
                            <th>Lapangan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rents as $rent)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $rent->rent_receipt }}</td>
                                <td>{{ $rent->field->name ?? '-' }}</td>
                                <td>Rp{{ number_format($rent->total_price, 0, ',', '.') }}</td>
                                <td>
                                    @if ($rent->status == 'paid')
                                        <span class="badge bg-success">Dibayar</span>
                                    @elseif ($rent->status == 'pending')
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @else
                                        <span class="badge bg-danger">Dibatalkan</span>
                                    @endif
                                </td>
                                <td>{{ $rent->created_at->format('d M Y H:i') }}</td>
                                <td>
                                    <div class="d-flex gap-1 flex-wrap">
                                        <a href="{{ route('rent.show', $rent->rent_receipt) }}"
                                            class="btn btn-sm btn-primary flex-grow-1">
                                            Detail
                                        </a>

                                        @if ($rent->status === 'pending')
                                            <form action="{{ route('rent.cancel', $rent->rent_receipt) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin membatalkan pesanan ini?');"
                                                class="flex-grow-1">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-sm btn-danger w-100">Batalkan</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $rents->links('vendor.pagination.bootstrap-5') }}
            </div>
        @else
            <div class="alert alert-info">
                Anda belum memiliki riwayat sewa.
            </div>
        @endif
    </div>
@endsection
