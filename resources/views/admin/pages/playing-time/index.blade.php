@extends('admin.layouts.main')

@section('container')
    <h5 class="mb-3">Kelola Jam Main untuk: <strong>{{ $field->name }}</strong></h5>

    <a href="{{ route('admin.fields.index') }}" class="btn btn-secondary mb-3">Kembali ke Daftar Lapangan</a>
    <div class="mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addPlayTimeModal">
            Tambah Jam Main
        </button>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($playingTimes as $index => $time)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $time->start_time }}</td>
                            <td>{{ $time->end_time }}</td>
                            <td>Rp {{ number_format($time->price, 0, ',', '.') }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#editPlayTimeModal{{ $time->id }}">Edit</button>
                                <form action="{{ route('admin.playing-times.destroy', $time->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menghapus jam main ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal per Jam Main -->
                        <div class="modal fade" id="editPlayTimeModal{{ $time->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="editPlayTimeModalLabel{{ $time->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('admin.playing-times.update', $time->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editPlayTimeModalLabel{{ $time->id }}">Edit Jam
                                                Main</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Jam Mulai</label>
                                                <input type="time" name="start_time" class="form-control"
                                                    value="{{ $time->start_time }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Jam Selesai</label>
                                                <input type="time" name="end_time" class="form-control"
                                                    value="{{ $time->end_time }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Harga</label>
                                                <input type="number" name="price" step="0.01" class="form-control"
                                                    value="{{ $time->price }}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Modal -->
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Tambah Jam Main -->
    <div class="modal fade" id="addPlayTimeModal" tabindex="-1" role="dialog" aria-labelledby="addPlayTimeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.fields.playing-times.store', $field->id) }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPlayTimeModalLabel">Tambah Jam Main - {{ $field->name }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Jam Mulai</label>
                            <input type="time" name="start_time" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam Selesai</label>
                            <input type="time" name="end_time" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="price" step="0.01" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah Jam Main</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
