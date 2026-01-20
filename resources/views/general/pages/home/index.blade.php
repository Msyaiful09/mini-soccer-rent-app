@extends('general.layouts.main')
@section('container')
    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel">
        <div class="header-carousel-item">
            <img src="{{ asset('assets/img/carousel/carousel-1.jpg') }}" class="img-fluid w-100" alt="Image">
            <div class="carousel-caption">
                <div class="container">
                    <div class="row gy-0 gx-5">
                        <div class="col-lg-0 col-xl-5"></div>
                        <div class="col-xl-7 animated fadeInLeft">
                            <div class="text-sm-center text-md-end">
                                <h4 class="text-primary text-uppercase fw-bold mb-4">Pesan Lapangan Kapan Saja</h4>
                                <h1 class="display-4 text-uppercase text-white mb-4">Jadwalkan Permainanmu Sekarang</h1>
                                <p class="mb-5 fs-5">
                                    Tidak perlu antre atau telepon manual. Anda bisa memilih
                                    jadwal, lihat ketersediaan lapangan, dan melakukan pembayaran dalam satu aplikasi.
                                </p>
                                <div class="d-flex justify-content-center justify-content-md-end flex-shrink-0 mb-4">
                                    <a class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2" href="{{ route('field.show', $fields->first()->slug) }}">Pesan
                                        Sekarang</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-carousel-item">
            <img src="{{ asset('assets/img/carousel/carousel-2.jpg') }}" class="img-fluid w-100" alt="Image">
            <div class="carousel-caption">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-12 animated fadeInUp">
                            <div class="text-center">
                                <h4 class="text-primary text-uppercase fw-bold mb-4">Pesan Lapangan Kapan Saja</h4>
                                <h1 class="display-4 text-uppercase text-white mb-4">Jadwalkan Permainanmu Sekarang</h1>
                                <p class="mb-5 fs-5">
                                    Tidak perlu antri atau telepon manual. Anda bisa memilih
                                    jadwal, lihat ketersediaan lapangan, dan melakukan pembayaran dalam satu aplikasi.
                                </p>
                                <div class="d-flex justify-content-center flex-shrink-0 mb-4">
                                        <a class="btn btn-primary rounded-pill py-3 px-4 px-md-5 ms-2"
                                        href="{{ route('field.show', $fields->first()->slug) }}">
                                        Pesan Sekarang
                                        </a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Abvout Start -->
    <div class="container-fluid about py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-xl-7 wow fadeInLeft" data-wow-delay="0.2s">
                    <div>
                        <h4 class="text-primary">Tentang Kami</h4>
                        <h1 class="display-5 mb-4">Solusi Mudah & Cepat untuk Sewa Lapangan Mini Soccer</h1>
                        <p class="mb-4">
                            AMC Mini Soccer adalah platform yang memudahkan Anda dalam memesan lapangan mini soccer tanpa
                            ribet. Kami hadir untuk membantu Anda menemukan jadwal yang tepat, melihat ketersediaan
                            lapangan, hingga melakukan pembayaran — semua bisa dilakukan secara online, kapan saja dan di
                            mana saja.
                        </p>
                        <div class="row g-4">
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="d-flex">
                                    <div><i class="fas fa-futbol fa-3x text-primary"></i></div>
                                    <div class="ms-4">
                                        <h4>Pemesanan Praktis</h4>
                                        <p>Pilih lapangan dan jadwal favorit Anda hanya melalui genggaman tangan, tanpa
                                            harus datang langsung.</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="d-flex">
                                    <div><i class="bi bi-clock-history fa-3x text-primary"></i></div>
                                    <div class="ms-4">
                                        <h4>Waktu Fleksibel</h4>
                                        <p>Atur jadwal permainan sesuai kebutuhan Anda, tanpa takut kehabisan jadwal.</p>
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <!-- <a href="#" class="btn btn-primary rounded-pill py-3 px-5 flex-shrink-0">Pesan
                                    Sekarang</a> -->

                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex">
                                    <i class="fas fa-phone-alt fa-2x text-primary me-4"></i>
                                    <div>
                                        <h4>Hubungi Kami</h4>
                                        <p class="mb-0 fs-5" style="letter-spacing: 1px;">+62 838-7147-0547</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 wow fadeInRight" data-wow-delay="0.2s">
                    <div class="bg-primary rounded position-relative overflow-hidden">
                        <img src="{{ asset('assets/img/about/about-img-1.jpg') }}" class="img-fluid rounded w-100"
                            alt="">


                        <div class="rounded-bottom">
                            <img src="{{ asset('assets/img/about/about-img-2.jpg') }}"
                                class="img-fluid rounded-bottom w-100" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Fields Start -->
    <div class="container-fluid service pb-5">
        <div class="container pb-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary">Lapangan Kami</h4>
                <h1 class="display-5 mb-4">Pilih Lapangan Favoritmu & Jadwalkan Permainan</h1>
                <p class="mb-0">
                    Kami menyediakan beberapa pilihan lapangan mini soccer dengan fasilitas terbaik. Pilih sesuai
                    kebutuhanmu, cek ketersediaannya, dan lakukan pemesanan secara mudah melalui aplikasi.
                </p>

            </div>
            <div class="row g-4">
                @foreach ($fields as $field)
                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service-item">
                            <div class="service-img">
                                <img src="{{ asset('assets/img/field/dummy-field.jpg') }}"
                                    class="img-fluid rounded-top w-100" alt="Image">
                            </div>
                            <div class="rounded-bottom p-4">
                                <a href="{{ route('field.show', $field->slug) }}"
                                    class="h4 d-inline-block mb-4">{{ $field->name }}</a>
                                <p class="mb-4">
                                    {{ $field->description }}
                                </p>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Fields End -->
@endsection
