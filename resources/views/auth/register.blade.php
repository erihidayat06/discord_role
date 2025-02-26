<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Index - Belajar satu persen</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="/assets/img/logo.png" rel="icon">
    <link href="/assets/img/logo.png" rel="apple-touch-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .bg-dark-main {
            background-color: #000000 !important;
        }

        .form-floating>.form-control-plaintext~label::after,
        .form-floating>.form-control:focus~label::after,
        .form-floating>.form-control:not(:placeholder-shown)~label::after,
        .form-floating>.form-select~label::after {
            position: absolute;
            inset: 1rem 0.375rem;
            z-index: -1;
            height: 1.5em;
            content: "";
            background-color: #252525;
            border-radius: var(--bs-border-radius);
        }

        *,
        ::after,
        ::before {
            box-sizing: border-box;
        }

        .form-floating>.form-control-plaintext~label,
        .form-floating>.form-control:focus~label,
        .form-floating>.form-control:not(:placeholder-shown)~label,
        .form-floating>.form-select~label {
            color: white;
        }

        .form-floating>label {
            text-align: start;
            white-space: nowrap;
            pointer-events: none;
        }

        .text-white {
            --bs-text-opacity: 1;
            color: white !important;
        }

        /* Additional styles to center the form */
        .form-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .register-form {
            width: 100%;
            max-width: 700px;
            padding: 2rem;

            border-radius: .200rem;
        }

        .btn-main {
            color: white;
            background-color: #004aad;
            border: none;
            transition: background-color 0.3s, transform 0.1s;
            /* Menambahkan transisi untuk smooth effect */
        }

        .btn-main:hover {
            color: white;
            background-color: #004aad;
        }

        .btn-main:active {
            color: white;
            background-color: #1251a5;
            /* Warna lebih gelap saat diklik */
            transform: scale(0.98);
            /* Efek sedikit mengecil saat diklik */
            box-shadow: none;
            /* Pastikan tidak ada shadow atau perubahan lain yang menyebabkan perubahan warna */

        }

        .form-control {
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
        }

        .form-control:focus {
            border: none !important;
            box-shadow: none !important;
            outline: none !important;
        }
    </style>

</head>

<body class="bg-dark-main">
    <div class="form-container">
        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf
            <div class="container">
                <a href="/">

                    <img src="/assets/img/logo-main.png" alt="" width="150">
                </a>
                <h3 class="mt-3 text-white fw-bold">DAFTAR AKUN</h3>

                <!-- Name Field -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-floating mb-3 bg-dark">
                            <input type="text"
                                class="form-control bg-dark text-white @error('name') is-invalid @enderror"
                                id="floatingName" placeholder="Your Name" value="{{ old('name') }}" required
                                name="name">
                            <label for="floatingName" class="text-white">Full Name</label>
                        </div>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Email Field -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-floating mb-3 bg-dark">
                            <input type="email"
                                class="form-control bg-dark text-white @error('email') is-invalid @enderror"
                                id="floatingEmail" placeholder="name@example.com" value="{{ old('email') }}" required
                                name="email">
                            <label for="floatingEmail" class="text-white">Email address</label>
                        </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- no_tlp Number Field -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-floating mb-3 bg-dark">
                            <input type="tel"
                                class="form-control bg-dark text-white @error('no_tlp') is-invalid @enderror"
                                id="floatingno_tlp" placeholder="Your no_tlp Number" value="{{ old('no_tlp') }}"
                                required name="no_tlp">
                            <label for="floatingno_tlp" class="text-white">No Whatsapp</label>
                        </div>

                        @error('no_tlp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Password Field -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="password"
                                class="form-control bg-dark text-white @error('password') is-invalid @enderror"
                                id="floatingPassword" placeholder="Password" name="password" required>
                            <label for="floatingPassword" class="text-white">Password</label>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Confirm Password Field -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-floating">
                            <input type="password"
                                class="form-control bg-dark text-white @error('password_confirmation') is-invalid @enderror"
                                id="floatingPasswordConfirm" placeholder="Confirm Password" name="password_confirmation"
                                required>
                            <label for="floatingPasswordConfirm" class="text-white">Confirm Password</label>
                        </div>

                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row mb-0">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-main">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <p class="text-white">Already have an account? <a href="{{ route('login') }}"
                                class="text-white">Login here</a></p>
                    </div>
                </div>

            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
