@extends('admin.layouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Sewa</th>
                            <th>Penyewa</th>
                            <th>Lapangan</th>
                            <th>Total Harga</th>
                            <th>Jenis Sewa</th>
                            <th>Status</th>
                            <th>Detail Sewa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rents as $index => $rent)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $rent->rent_receipt }}</td>
                                <td>{{ $rent->user->name }}</td>
                                <td>{{ $rent->field->name }}</td>
                                <td>Rp {{ number_format($rent->total_price, 0, ',', '.') }}</td>
                                <td>
                                    @if ($rent->rent_type == 'single')
                                        <span class="badge badge-info">Sekali</span>
                                    @else
                                        <span class="badge badge-primary">Bulanan</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($rent->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif ($rent->status == 'paid')
                                        <span class="badge badge-success">Lunas</span>
                                    @else
                                        <span class="badge badge-danger">Batal</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-toggle="modal"
                                        data-target="#rentDetailModal{{ $rent->id }}">
                                        Lihat
                                    </button>
                                </td>
                            </tr>

                            <!-- Detail Modal -->
                            <div class="modal fade" id="rentDetailModal{{ $rent->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="rentDetailModalLabel{{ $rent->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rentDetailModalLabel{{ $rent->id }}">Detail Sewa
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <ul class="list-group">
                                                @foreach ($rent->rentDetails as $detail)
                                                    <li class="list-group-item">
                                                        Tanggal: {{ $detail->date }} <br>
                                                        Jam: {{ $detail->playTime->start_time }} -
                                                        {{ $detail->playTime->end_time }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
