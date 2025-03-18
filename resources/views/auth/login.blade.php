<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login - Belajar satu persen</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="/assets/img/logo.png" rel="icon">
    <link href="/assets/img/logo.png" rel="apple-touch-icon">

    {{-- Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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

        .login-form {
            width: 100%;
            max-width: 700px;
            padding: 2rem;

            border-radius: .200rem;
        }

        .btn-main {
            color: white;
            background-color: #ac43e4;
            border: none;
            transition: background-color 0.3s, transform 0.1s;
            /* Menambahkan transisi untuk smooth effect */
        }

        .btn-main:hover {
            color: white;
            background-color: #ac43e4;
        }

        .btn-main:active {
            color: white;
            background-color: #9b33d1;
            /* Warna sedikit lebih gelap saat tombol diklik */
            transform: scale(0.98);
            /* Efek sedikit mengecil saat diklik */
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
        <form method="POST" action="{{ route('login') }}" class="login-form">
            @csrf
            <div class="container">
                <a href="/">

                    <img src="/assets/img/logo-main.png" alt="" width="150">
                </a>
                <h3 class="mt-3 text-white fw-bold">LOGIN</h3>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-floating mb-3 bg-dark">
                            <input type="email"
                                class="form-control bg-dark text-white @error('email') is-invalid @enderror"
                                id="floatingInput" placeholder="name@example.com" value="{{ old('email') }}" required
                                autocomplete="email" name="email">
                            <label for="floatingInput" class="text-white">Email address</label>
                        </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-floating position-relative">
                            <input type="password"
                                class="form-control bg-dark text-white pe-5 @error('password') is-invalid @enderror"
                                id="floatingPassword" placeholder="Password" name="password">
                            <label for="floatingPassword" class="text-white">Password</label>
                            <button type="button"
                                class="btn btn-outline-secondary position-absolute end-0 top-50 translate-middle-y me-2"
                                onclick="togglePassword()">
                                <i id="eyeIcon" class="bi bi-eye-slash"></i>
                            </button>
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <script>
                    function togglePassword() {
                        var passwordInput = document.getElementById("floatingPassword");
                        var eyeIcon = document.getElementById("eyeIcon");

                        if (passwordInput.type === "password") {
                            passwordInput.type = "text";
                            eyeIcon.classList.remove("bi-eye-slash");
                            eyeIcon.classList.add("bi-eye");
                        } else {
                            passwordInput.type = "password";
                            eyeIcon.classList.remove("bi-eye");
                            eyeIcon.classList.add("bi-eye-slash");
                        }
                    }
                </script>


                <div class="row mb-3">
                    <div class="">
                        <div class="form-check text-white ">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="cf-turnstile" data-sitekey="{{ env('CLOUDFLARE_SITE_KEY') }}"></div>
                    </div>
                </div>

                <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>


                <div class="row mb-0">
                    <div class="">
                        <button type="submit" class="btn btn-main">
                            {{ __('Login') }}
                        </button>

                        {{-- @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif --}}
                    </div>
                </div>
                <!-- Register Link -->
                <div class="row mt-3">
                    <div class="col-md-12 text-center">
                        <p class="text-white">Don't have an account? <a href="{{ route('register') }}"
                                class="text-white">Register here</a></p>
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
