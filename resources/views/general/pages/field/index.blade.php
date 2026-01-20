@extends('general.layouts.main')
@section('container')
    <!-- Fields Start -->
    <div class="container-fluid service pb-5 mt-5">
        <div class="container pb-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Lapangan Kami</h4>
                <h1 class="display-5 mb-4">Pilih Lapangan Favoritmu & Jadwalkan Permainan</h1>
                <p class="mb-0">
                    Kami menyediakan beberapa pilihan lapangan mini soccer dengan fasilitas terbaik. Pilih sesuai
                    kebutuhanmu, cek ketersediaannya, dan lakukan pemesanan secara mudah melalui aplikasi.
                </p>

            </div>
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-12 col-md-10 col-lg-8">
                        <form class="" method="GET" action="{{ route('field') }}">
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fa fa-search text-primary fs-4"></i>
                                </div>
                                <div class="col">
                                    <input class="form-control form-control-lg form-control-borderless" type="search"
                                        name="search" placeholder="Cari Lapangan" value="{{ request('search') }}">
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-lg btn-primary" type="submit">Cari</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!--end of col-->
                </div>
            </div>
            <div class="row g-4">
                @foreach ($fields as $field)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item h-100 d-flex flex-column">
                            <div class="service-img" style="height: 200px; overflow: hidden;">
                                @if ($field->image && file_exists(public_path('uploads/fields/' . $field->image)))
                                    <img src="{{ asset('uploads/fields/' . $field->image) }}"
                                        class="img-fluid w-100 h-100 object-fit-cover" alt="Image">
                                @else
                                    <img src="{{ asset('assets/img/field/dummy-field.jpg') }}"
                                        class="img-fluid w-100 h-100 object-fit-cover" alt="Image">
                                @endif
                            </div>

                            <div class="rounded-bottom p-4 flex-grow-1 d-flex flex-column">
                                <a href="{{ route('field.show', $field->slug) }}"
                                    class="h4 d-inline-block mb-3">{{ $field->name }}</a>
                                <p class="mb-4 flex-grow-1">
                                    {{ $field->description }}
                                </p>
                                <a href="{{ route('field.show', $field->slug) }}" class="btn btn-primary mt-auto">Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="mt-4">
                    {{ $fields->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>

        </div>
    </div>
    <!-- Fields End -->
@endsection
