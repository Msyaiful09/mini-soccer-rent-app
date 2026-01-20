<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{ $title }} - Mini Soccer Rent</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link rel="stylesheet" href="lib/animate/animate.min.css" />
    <link href="{{ asset('templates/general-template/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('templates/general-template/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('templates/general-template/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('templates/general-template/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>

<body>


    <!-- Login 9 - Bootstrap Brain Component -->
    <section class="bg-primary py-3 py-md-5 py-xl-8">
        <div class="container d-flex align-items-center min-vh-100">
            <div class="row gy-4 align-items-center">
                <div class="col-12 col-md-6 col-xl-7">
                    <div class="d-flex justify-content-center text-bg-primary">
                        <div class="col-12 col-xl-9">
                            <h2 class="h1 mb-4 text-white">Sewa Lapangan Mini Soccer Lebih Mudah & Cepat.</h2>
                            <p class="lead mb-5 text-white">
                                Mini Soccer Rent adalah solusi praktis untuk booking lapangan Mini Soccer kapan saja, di
                                mana
                                saja. Cukup lewat aplikasi, pilih jadwal, dan langsung main tanpa ribet!
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-5">
                    <div class="card border-0 rounded-4">
                        <div class="card-body p-3 p-md-4 p-xl-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-4">
                                        <h3>Daftar</h3>
                                        <p>Punya akun? <a href="{{ route('login') }}">Masuk</a></p>
                                    </div>
                                </div>
                            </div>
                            <form action="{{ route('register.store') }}" method="POST">
                                @csrf
                                <div class="row gy-3 overflow-hidden">

                                    <!-- Name Field -->
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                id="name" value="{{ old('name') }}" placeholder="Nama Lengkap"
                                                required>
                                            <label for="name">Nama Lengkap</label>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Phone Number Field -->
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="text"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                name="phone_number" id="phone_number" value="{{ old('phone_number') }}"
                                                placeholder="Nomor Telpon" required>
                                            <label for="phone_number">Nomor Telpon</label>
                                            @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Email Field -->
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="email"
                                                class="form-control @error('email') is-invalid @enderror" name="email"
                                                id="email" value="{{ old('email') }}"
                                                placeholder="name@example.com" required>
                                            <label for="email">Email</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Password Field -->
                                    <div class="col-12">
                                        <div class="form-floating mb-3">
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" id="password" placeholder="Password" required>
                                            <label for="password">Password</label>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-primary btn-lg" type="submit">Daftar
                                                Sekarang</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('templates/general-template/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('templates/general-template/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('templates/general-template/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('templates/general-template/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('templates/general-template/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('templates/general-template/lib/owlcarousel/owl.carousel.min.js') }}"></script>


    <!-- Template Javascript -->
    <script src="{{ asset('templates/general-template/js/main.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
