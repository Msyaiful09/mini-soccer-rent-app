@extends('general.layouts.main')

@section('container')
    <!-- Field Detail Start -->
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">

                <!-- Image Section -->
                <div class="col-xl-5 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="position-relative overflow-hidden rounded shadow">
                        @if ($field->image && file_exists(public_path('uploads/fields/' . $field->image)))
                            <img src="{{ asset('uploads/fields/' . $field->image) }}" class="img-fluid w-100 rounded"
                                alt="{{ $field->name }}">
                        @else
                            <img src="{{ asset('assets/img/field/dummy-field.jpg') }}" class="img-fluid w-100 rounded"
                                alt="{{ $field->name }}">
                        @endif
                    </div>
                </div>


                <!-- Details Section -->
                <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.2s">
                    <h4 class="text-primary mb-3">Detail Lapangan</h4>
                    <h1 class="display-5 mb-4">{{ $field->name }}</h1>

                    <p class="mb-4"><i class="fas fa-map-marker-alt text-primary me-2"></i> {{ $field->address }}</p>

                    <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-futbol fa-3x text-primary flex-shrink-0"></i>
                        <div class="ms-3">
                            <h4 class="mb-2">Informasi Lapangan</h4>
                            <p class="mb-0">{{ $field->description }}</p>
                        </div>
                    </div>

                    <a href="#" class="btn btn-primary rounded-pill py-3 px-5 mt-3">Pesan Sekarang</a>
                </div>

            </div>
            <div class="my-5">
                <h4 class="text-primary mb-3">Pilih Waktu Bermain</h4>

                <form method="GET" class="mb-4">
                    <div class="row g-2 align-items-center">
                        <div class="col-auto">
                            <input type="date" id="date" name="date" class="form-control"
                                value="{{ request('date', now()->addDay()->format('Y-m-d')) }}"
                                min="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Lihat</button>
                        </div>
                    </div>
                </form>


                @if ($selectedDate)
                    <p class="text-muted mb-3">
                        Jadwal untuk hari
                        {{ \Carbon\Carbon::parse($selectedDate)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                    </p>

                    <form action="{{ route('rent.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="date" value="{{ $selectedDate }}">
                        <input type="hidden" name="field_id" value="{{ $field->id }}">

                        <div class="mb-3">
                            <label for="rent_type" class="form-label fw-bold">Jenis Sewa</label>
                            <select name="rent_type" id="rent_type" class="form-select" required>
                                <option value="single">Sekali Sewa</option>
                                <option value="monthly">Bulanan (Jadwal sama selama sebulan)</option>
                            </select>
                        </div>

                        <div class="row g-3">
                            @foreach ($field->playTimes as $time)
                                @php
                                    $isBooked = $time->rentDetails->isNotEmpty();
                                    $selected = \Carbon\Carbon::parse($selectedDate);
                                    $now = \Carbon\Carbon::now();

                                    if ($selected->isSameDay($now)) {
                                        // tanggal hari ini → cek jam
                                        $isLewat = \Carbon\Carbon::parse($time->end_time)->isPast();
                                    } elseif ($selected->lessThan($now->startOfDay())) {
                                        // tanggal kemarin atau sebelumnya
                                        $isLewat = true;
                                    } else {
                                        // tanggal besok ke depan
                                        $isLewat = false;
                                    }
                                @endphp

                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <label
                                        class="playtime-card border rounded p-3 text-center h-100 d-flex flex-column justify-content-between @if ($isBooked || $isLewat) disabled @endif">
                                        <input type="checkbox" name="play_time_ids[]" value="{{ $time->id }}"
                                            @if ($isBooked) disabled @endif>

                                        <div>
                                            <div class="fw-bold mb-1">{{ $time->start_time }} - {{ $time->end_time }}
                                            </div>
                                            @if ($isBooked)
                                                <div class="text-primary fw-semibold">Telah Disewa</div>
                                            @else
                                                <div class="fw-bold mb-2 text-primary">
                                                    Rp{{ number_format($time->price, 0, ',', '.') }}
                                                </div>
                                            @endif
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary col-12" disabled id="rentButton">Sewa
                                Sekarang</button>
                        </div>
                    </form>
                @else
                    <p class="text-muted">Pilih tanggal terlebih dahulu.</p>
                @endif
            </div>






        </div>
    </div>
    <!-- Field Detail End -->
@endsection
