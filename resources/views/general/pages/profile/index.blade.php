@extends('general.layouts.main')
@section('container')
    <div class="container my-5">
        <h2 class="mb-4">Profil Saya</h2>

        <form action="{{ route('profile.update') }}" method="POST" class="p-4 border rounded shadow-sm bg-white">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', auth()->user()->name) }}" placeholder="Masukkan Nama Lengkap" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email (Read-only) -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" value="{{ auth()->user()->email }}" required>
                <div class="form-text">Email tidak dapat diubah.</div>
            </div>

            <!-- Phone Number -->
            <div class="mb-3">
                <label for="phone_number" class="form-label">Nomor Telepon</label>
                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number"
                    name="phone_number" value="{{ old('phone_number', auth()->user()->phone_number) }}"
                    placeholder="Masukkan Nomor Telepon" required>
                @error('phone_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- New Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password Baru <small class="text-muted">(Kosongkan jika tidak ingin
                        mengubah)</small></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Password Baru">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                    placeholder="Ulangi Password Baru">
            </div>

            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>
@endsection
