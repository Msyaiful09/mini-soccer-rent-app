@extends('admin.layouts.main')

@section('container')
    <div class="mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addFieldModal">Tambah Lapangan</button>

    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Deskripsi</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fields as $index => $field)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $field->name }}</td>
                                <td>{{ $field->address }}</td>
                                <td>{{ $field->description ?? '-' }}</td>
                                <td>
                                    @if ($field->image)
                                        <img src="{{ asset('uploads/fields/' . $field->image) }}" width="80">
                                    @else
                                        Tidak ada gambar
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.fields.playing-times.index', $field->id) }}"
                                        class="btn btn-sm btn-info" title="Kelola Jam Main">
                                        <i class="fas fa-clock"></i>
                                    </a>

                                    <button class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#editFieldModal{{ $field->id }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <form action="{{ route('admin.fields.destroy', $field->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Yakin ingin menghapus lapangan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" type="submit" title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editFieldModal{{ $field->id }}" tabindex="-1"
                                aria-labelledby="editFieldModalLabel{{ $field->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('admin.fields.update', $field->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Lapangan</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ $field->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Alamat</label>
                                                    <input type="text" name="address" class="form-control"
                                                        value="{{ $field->address }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Deskripsi</label>
                                                    <textarea name="description" class="form-control">{{ $field->description }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Gambar (opsional)</label>
                                                    <input type="file" name="image" class="form-control">
                                                    @if ($field->image)
                                                        <small class="d-block mt-2">Gambar saat ini:
                                                            {{ $field->image }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="modal-footer">

                                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- End Edit Modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Lapangan -->
    <div class="modal fade" id="addFieldModal" tabindex="-1" aria-labelledby="addFieldModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('admin.fields.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Lapangan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <input type="text" name="address" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar (opsional)</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
