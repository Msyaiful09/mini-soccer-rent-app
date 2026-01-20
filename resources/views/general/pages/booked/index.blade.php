@extends('general.layouts.main')
@section('container')
    <div class="container-fluid service pb-5 mt-5">
        <div class="container pb-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Riwayat Penyewaan</h4>
                <h1 class="display-5 mb-4">Lapangan Yang Sudah Disewa</h1>
                <p>Berikut adalah daftar lapangan yang telah kamu sewa. Klik tombol detail untuk melihat rincian.</p>
            </div>

            <div class="row wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-12">
                    @if ($rents->isEmpty())
                        <div class="alert alert-warning text-center">Belum ada data penyewaan.</div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Penyewa</th>
                                        <th>Lapangan</th>
                                        <th>Total Harga</th>
                                        <th>Tipe Sewa</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rents as $index => $rent)
                                        <tr>
                                            <td>{{ $rents->firstItem() + $index }}</td>
                                            <td><span class="text-success font-weight-bold">{{ $rent->user->name }}</span>
                                            </td>
                                            <td>{{ $rent->field->name }}</td>
                                            <td>Rp {{ number_format($rent->total_price, 0, ',', '.') }}</td>
                                            <td>{{ ucfirst($rent->rent_type) }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#detailModal{{ $rent->id }}">
                                                    Detail
                                                </button>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $rents->links('vendor.pagination.bootstrap-4') }}
                        </div>

                        <!-- All Modals (OUTSIDE TABLE) -->
                        @foreach ($rents as $rent)
                            <div class="modal fade" id="detailModal{{ $rent->id }}" tabindex="-1"
                                aria-labelledby="modalLabel{{ $rent->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Detail Sewa - #{{ $rent->rent_receipt }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($rent->rentDetails->isNotEmpty())
                                                <table class="table table-sm table-bordered text-center">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Tanggal</th>
                                                            <th>Jam Main</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($rent->rentDetails as $i => $detail)
                                                            <tr>
                                                                <td>{{ $i + 1 }}</td>
                                                                <td>{{ \Carbon\Carbon::parse($detail->date)->format('d M Y') }}
                                                                </td>
                                                                <td>{{ $detail->playTime->start_time ?? '-' }} -
                                                                    {{ $detail->playTime->end_time ?? '-' }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <p class="text-muted">Tidak ada detail penyewaan.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
