@extends('admin.layouts.main')

@section('container')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor HP</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role === 'admin')
                                        <span class="badge bg-primary text-white">Admin</span>
                                    @else
                                        <span class="badge bg-success text-white">Customer</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-toggle="modal"
                                        data-target="#editUserModal{{ $user->id }}">
                                        Edit
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1"
                                aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit
                                                    Pengguna
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="name{{ $user->id }}" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="name{{ $user->id }}"
                                                        name="name" value="{{ $user->name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone_number{{ $user->id }}" class="form-label">Nomor
                                                        HP</label>
                                                    <input type="text" class="form-control"
                                                        id="phone_number{{ $user->id }}" name="phone_number"
                                                        value="{{ $user->phone_number }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email{{ $user->id }}" class="form-label">Email</label>
                                                    <input type="email" class="form-control"
                                                        id="email{{ $user->id }}" name="email"
                                                        value="{{ $user->email }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="role{{ $user->id }}" class="form-label">Role</label>
                                                    <select name="role" id="role{{ $user->id }}" class="form-select"
                                                        required>
                                                        <option value="customer"
                                                            {{ $user->role == 'customer' ? 'selected' : '' }}>
                                                            Customer</option>
                                                        <option value="admin"
                                                            {{ $user->role == 'admin' ? 'selected' : '' }}>Admin
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>

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
    </div>
@endsection
