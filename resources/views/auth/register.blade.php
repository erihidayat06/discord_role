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

                <!-- Username Field -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-floating mb-3 bg-dark">
                            <input type="text"
                                class="form-control bg-dark text-white @error('name') is-invalid @enderror"
                                id="floatingname" placeholder="name" value="{{ old('name') }}" required
                                name="name">
                            <label for="floatingname" class="text-white">Username</label>
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

                <style>
                    #countryCode.form-select {
                        width: 130px !important;
                    }

                    .input-group>.form-select {
                        flex: unset !important;
                        width: 130px !important;
                    }
                </style>


                <!-- Phone Number with Country Code -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="input-group">
                            <!-- Tombol untuk memilih kode negara -->
                            <button type="button" id="countryCodeBtn" class="btn btn-dark text-white"
                                style="width: 80px; position: relative;">
                                +62
                            </button>

                            <!-- Dropdown list (disembunyikan secara default) -->
                            <div id="countryDropdown" class="dropdown-menu"
                                style="max-height: 200px; overflow-y: auto; display: none; position: absolute; z-index: 1000;">
                                <button class="dropdown-item" data-code="+62">🇮🇩 +62 (Indonesia)</button>
                                <button class="dropdown-item" data-code="+1">🇺🇸 +1 (USA)</button>
                                <button class="dropdown-item" data-code="+44">🇬🇧 +44 (UK)</button>
                                <button class="dropdown-item" data-code="+91">🇮🇳 +91 (India)</button>
                                <button class="dropdown-item" data-code="+81">🇯🇵 +81 (Japan)</button>
                                <button class="dropdown-item" data-code="+86">🇨🇳 +86 (China)</button>
                                <button class="dropdown-item" data-code="+33">🇫🇷 +33 (France)</button>
                                <button class="dropdown-item" data-code="+49">🇩🇪 +49 (Germany)</button>
                                <button class="dropdown-item" data-code="+61">🇦🇺 +61 (Australia)</button>
                                <button class="dropdown-item" data-code="+971">🇦🇪 +971 (UAE)</button>
                                <button class="dropdown-item" data-code="+7">🇷🇺 +7 (Russia)</button>
                                <button class="dropdown-item" data-code="+55">🇧🇷 +55 (Brazil)</button>
                                <button class="dropdown-item" data-code="+34">🇪🇸 +34 (Spain)</button>
                                <button class="dropdown-item" data-code="+39">🇮🇹 +39 (Italy)</button>
                                <button class="dropdown-item" data-code="+90">🇹🇷 +90 (Turkey)</button>
                                <button class="dropdown-item" data-code="+82">🇰🇷 +82 (South Korea)</button>
                                <button class="dropdown-item" data-code="+66">🇹🇭 +66 (Thailand)</button>
                                <button class="dropdown-item" data-code="+63">🇵🇭 +63 (Philippines)</button>
                                <button class="dropdown-item" data-code="+60">🇲🇾 +60 (Malaysia)</button>
                                <button class="dropdown-item" data-code="+351">🇵🇹 +351 (Portugal)</button>
                                <button class="dropdown-item" data-code="+31">🇳🇱 +31 (Netherlands)</button>
                                <button class="dropdown-item" data-code="+47">🇳🇴 +47 (Norway)</button>
                                <button class="dropdown-item" data-code="+46">🇸🇪 +46 (Sweden)</button>
                                <button class="dropdown-item" data-code="+45">🇩🇰 +45 (Denmark)</button>
                                <button class="dropdown-item" data-code="+48">🇵🇱 +48 (Poland)</button>
                                <button class="dropdown-item" data-code="+358">🇫🇮 +358 (Finland)</button>
                                <button class="dropdown-item" data-code="+32">🇧🇪 +32 (Belgium)</button>
                                <button class="dropdown-item" data-code="+41">🇨🇭 +41 (Switzerland)</button>
                                <button class="dropdown-item" data-code="+52">🇲🇽 +52 (Mexico)</button>
                                <button class="dropdown-item" data-code="+57">🇨🇴 +57 (Colombia)</button>
                                <button class="dropdown-item" data-code="+56">🇨🇱 +56 (Chile)</button>
                                <button class="dropdown-item" data-code="+51">🇵🇪 +51 (Peru)</button>
                                <button class="dropdown-item" data-code="+27">🇿🇦 +27 (South Africa)</button>
                                <button class="dropdown-item" data-code="+234">🇳🇬 +234 (Nigeria)</button>
                                <button class="dropdown-item" data-code="+212">🇲🇦 +212 (Morocco)</button>
                                <button class="dropdown-item" data-code="+20">🇪🇬 +20 (Egypt)</button>
                                <button class="dropdown-item" data-code="+92">🇵🇰 +92 (Pakistan)</button>
                                <button class="dropdown-item" data-code="+880">🇧🇩 +880 (Bangladesh)</button>
                                <button class="dropdown-item" data-code="+98">🇮🇷 +98 (Iran)</button>
                                <button class="dropdown-item" data-code="+964">🇮🇶 +964 (Iraq)</button>
                                <button class="dropdown-item" data-code="+962">🇯🇴 +962 (Jordan)</button>
                                <button class="dropdown-item" data-code="+961">🇱🇧 +961 (Lebanon)</button>
                                <button class="dropdown-item" data-code="+965">🇰🇼 +965 (Kuwait)</button>
                                <button class="dropdown-item" data-code="+973">🇧🇭 +973 (Bahrain)</button>
                                <button class="dropdown-item" data-code="+974">🇶🇦 +974 (Qatar)</button>
                                <button class="dropdown-item" data-code="+968">🇴🇲 +968 (Oman)</button>
                                <button class="dropdown-item" data-code="+994">🇦🇿 +994 (Azerbaijan)</button>
                                <button class="dropdown-item" data-code="+995">🇬🇪 +995 (Georgia)</button>
                                <button class="dropdown-item" data-code="+998">🇺🇿 +998 (Uzbekistan)</button>
                                <button class="dropdown-item" data-code="+996">🇰🇬 +996 (Kyrgyzstan)</button>
                                <button class="dropdown-item" data-code="+993">🇹🇲 +993 (Turkmenistan)</button>
                                <button class="dropdown-item" data-code="+976">🇲🇳 +976 (Mongolia)</button>
                                <button class="dropdown-item" data-code="+380">🇺🇦 +380 (Ukraine)</button>
                                <button class="dropdown-item" data-code="+375">🇧🇾 +375 (Belarus)</button>
                                <button class="dropdown-item" data-code="+420">🇨🇿 +420 (Czech Republic)</button>
                                <button class="dropdown-item" data-code="+421">🇸🇰 +421 (Slovakia)</button>
                                <button class="dropdown-item" data-code="+36">🇭🇺 +36 (Hungary)</button>
                                <button class="dropdown-item" data-code="+43">🇦🇹 +43 (Austria)</button>
                                <button class="dropdown-item" data-code="+381">🇷🇸 +381 (Serbia)</button>
                                <button class="dropdown-item" data-code="+387">🇧🇦 +387 (Bosnia &
                                    Herzegovina)</button>
                                <button class="dropdown-item" data-code="+389">🇲🇰 +389 (North Macedonia)</button>
                                <button class="dropdown-item" data-code="+359">🇧🇬 +359 (Bulgaria)</button>
                                <button class="dropdown-item" data-code="+385">🇭🇷 +385 (Croatia)</button>
                                <button class="dropdown-item" data-code="+372">🇪🇪 +372 (Estonia)</button>
                                <button class="dropdown-item" data-code="+371">🇱🇻 +371 (Latvia)</button>
                                <button class="dropdown-item" data-code="+370">🇱🇹 +370 (Lithuania)</button>
                                <button class="dropdown-item" data-code="+357">🇨🇾 +357 (Cyprus)</button>
                                <button class="dropdown-item" data-code="+356">🇲🇹 +356 (Malta)</button>
                                <button class="dropdown-item" data-code="+355">🇦🇱 +355 (Albania)</button>
                                <button class="dropdown-item" data-code="+373">🇲🇩 +373 (Moldova)</button>
                                <button class="dropdown-item" data-code="+376">🇦🇩 +376 (Andorra)</button>
                                <button class="dropdown-item" data-code="+377">🇲🇨 +377 (Monaco)</button>
                                <button class="dropdown-item" data-code="+378">🇸🇲 +378 (San Marino)</button>
                                <button class="dropdown-item" data-code="+379">🇻🇦 +379 (Vatican City)</button>
                                <button class="dropdown-item" data-code="+290">🇸🇭 +290 (Saint Helena)</button>
                                <button class="dropdown-item" data-code="+291">🇪🇷 +291 (Eritrea)</button>
                                <button class="dropdown-item" data-code="+297">🇦🇼 +297 (Aruba)</button>
                                <button class="dropdown-item" data-code="+298">🇫🇴 +298 (Faroe Islands)</button>
                                <button class="dropdown-item" data-code="+299">🇬🇱 +299 (Greenland)</button>
                                <button class="dropdown-item" data-code="+500">🇫🇰 +500 (Falkland Islands)</button>
                                <button class="dropdown-item" data-code="+501">🇧🇿 +501 (Belize)</button>
                                <button class="dropdown-item" data-code="+502">🇬🇹 +502 (Guatemala)</button>
                                <button class="dropdown-item" data-code="+503">🇸🇻 +503 (El Salvador)</button>
                                <button class="dropdown-item" data-code="+504">🇭🇳 +504 (Honduras)</button>
                                <button class="dropdown-item" data-code="+505">🇳🇮 +505 (Nicaragua)</button>
                                <button class="dropdown-item" data-code="+506">🇨🇷 +506 (Costa Rica)</button>
                                <button class="dropdown-item" data-code="+507">🇵🇦 +507 (Panama)</button>
                                <button class="dropdown-item" data-code="+508">🇵🇲 +508 (Saint Pierre &
                                    Miquelon)</button>
                                <button class="dropdown-item" data-code="+509">🇭🇹 +509 (Haiti)</button>
                                <button class="dropdown-item" data-code="+590">🇬🇵 +590 (Guadeloupe)</button>
                                <button class="dropdown-item" data-code="+591">🇧🇴 +591 (Bolivia)</button>
                                <button class="dropdown-item" data-code="+592">🇬🇾 +592 (Guyana)</button>
                                <button class="dropdown-item" data-code="+593">🇪🇨 +593 (Ecuador)</button>
                                <button class="dropdown-item" data-code="+594">🇬🇫 +594 (French Guiana)</button>
                                <button class="dropdown-item" data-code="+595">🇵🇾 +595 (Paraguay)</button>
                                <button class="dropdown-item" data-code="+596">🇲🇶 +596 (Martinique)</button>
                                <button class="dropdown-item" data-code="+597">🇸🇷 +597 (Suriname)</button>
                                <button class="dropdown-item" data-code="+598">🇺🇾 +598 (Uruguay)</button>
                                <button class="dropdown-item" data-code="+599">🇨🇼 +599 (Curacao)</button>
                                <button class="dropdown-item" data-code="+670">🇹🇱 +670 (East Timor)</button>
                                <button class="dropdown-item" data-code="+672">🇦🇶 +672 (Australian External
                                    Territories)</button>
                                <button class="dropdown-item" data-code="+673">🇧🇳 +673 (Brunei Darussalam)</button>
                                <button class="dropdown-item" data-code="+674">🇳🇷 +674 (Nauru)</button>
                                <button class="dropdown-item" data-code="+675">🇵🇬 +675 (Papua New Guinea)</button>
                                <button class="dropdown-item" data-code="+676">🇹🇴 +676 (Tonga)</button>
                                <button class="dropdown-item" data-code="+677">🇸🇧 +677 (Solomon Islands)</button>
                                <button class="dropdown-item" data-code="+678">🇻🇺 +678 (Vanuatu)</button>
                                <button class="dropdown-item" data-code="+679">🇫🇯 +679 (Fiji)</button>
                                <button class="dropdown-item" data-code="+680">🇵🇼 +680 (Palau)</button>
                                <button class="dropdown-item" data-code="+681">🇼🇫 +681 (Wallis & Futuna)</button>
                                <button class="dropdown-item" data-code="+682">🇨🇰 +682 (Cook Islands)</button>
                                <button class="dropdown-item" data-code="+683">🇳🇺 +683 (Niue)</button>
                                <button class="dropdown-item" data-code="+685">🇼🇸 +685 (Samoa)</button>
                                <button class="dropdown-item" data-code="+686">🇰🇮 +686 (Kiribati)</button>
                                <button class="dropdown-item" data-code="+687">🇳🇨 +687 (New Caledonia)</button>
                                <button class="dropdown-item" data-code="+688">🇹🇻 +688 (Tuvalu)</button>
                                <button class="dropdown-item" data-code="+689">🇵🇫 +689 (French Polynesia)</button>
                                <button class="dropdown-item" data-code="+690">🇹🇰 +690 (Tokelau)</button>
                                <button class="dropdown-item" data-code="+691">🇫🇲 +691 (Micronesia)</button>
                                <button class="dropdown-item" data-code="+692">🇲🇭 +692 (Marshall Islands)</button>
                                <button class="dropdown-item" data-code="+850">🇰🇵 +850 (North Korea)</button>
                                <button class="dropdown-item" data-code="+852">🇭🇰 +852 (Hong Kong)</button>
                                <button class="dropdown-item" data-code="+853">🇲🇴 +853 (Macau)</button>
                                <button class="dropdown-item" data-code="+855">🇰🇭 +855 (Cambodia)</button>
                                <button class="dropdown-item" data-code="+856">🇱🇦 +856 (Laos)</button>
                                <button class="dropdown-item" data-code="+886">🇹🇼 +886 (Taiwan)</button>
                                <button class="dropdown-item" data-code="+960">🇲🇻 +960 (Maldives)</button>
                                <button class="dropdown-item" data-code="+963">🇸🇾 +963 (Syria)</button>
                                <button class="dropdown-item" data-code="+966">🇸🇦 +966 (Saudi Arabia)</button>
                                <button class="dropdown-item" data-code="+967">🇾🇪 +967 (Yemen)</button>
                                <button class="dropdown-item" data-code="+970">🇵🇸 +970 (Palestine)</button>
                                <button class="dropdown-item" data-code="+972">🇮🇱 +972 (Israel)</button>
                                <button class="dropdown-item" data-code="+975">🇧🇹 +975 (Bhutan)</button>
                                <button class="dropdown-item" data-code="+977">🇳🇵 +977 (Nepal)</button>
                                <button class="dropdown-item" data-code="+992">🇹🇯 +992 (Tajikistan)</button>
                                <button class="dropdown-item" data-code="+241">🇬🇦 +241 (Gabon)</button>
                                <button class="dropdown-item" data-code="+242">🇨🇬 +242 (Congo)</button>
                                <button class="dropdown-item" data-code="+243">🇨🇩 +243 (Congo, Democratic Republic
                                    of)</button>
                                <button class="dropdown-item" data-code="+244">🇦🇴 +244 (Angola)</button>
                                <button class="dropdown-item" data-code="+245">🇬🇼 +245 (Guinea-Bissau)</button>
                                <button class="dropdown-item" data-code="+246">🇮🇴 +246 (British Indian Ocean
                                    Territory)</button>
                                <button class="dropdown-item" data-code="+247">🇦🇨 +247 (Ascension Island)</button>
                                <button class="dropdown-item" data-code="+248">🇸🇨 +248 (Seychelles)</button>
                                <button class="dropdown-item" data-code="+249">🇸🇩 +249 (Sudan)</button>
                                <button class="dropdown-item" data-code="+250">🇷🇼 +250 (Rwanda)</button>
                                <button class="dropdown-item" data-code="+251">🇪🇹 +251 (Ethiopia)</button>
                                <button class="dropdown-item" data-code="+252">🇸🇴 +252 (Somalia)</button>
                                <button class="dropdown-item" data-code="+253">🇩🇯 +253 (Djibouti)</button>
                                <button class="dropdown-item" data-code="+254">🇰🇪 +254 (Kenya)</button>
                                <button class="dropdown-item" data-code="+255">🇹🇿 +255 (Tanzania)</button>
                                <button class="dropdown-item" data-code="+256">🇺🇬 +256 (Uganda)</button>
                                <button class="dropdown-item" data-code="+257">🇧🇮 +257 (Burundi)</button>
                                <button class="dropdown-item" data-code="+258">🇲🇿 +258 (Mozambique)</button>
                                <button class="dropdown-item" data-code="+260">🇿🇲 +260 (Zambia)</button>
                                <button class="dropdown-item" data-code="+261">🇲🇬 +261 (Madagascar)</button>
                                <button class="dropdown-item" data-code="+262">🇾🇹 +262 (Mayotte & Reunion)</button>
                                <button class="dropdown-item" data-code="+263">🇿🇼 +263 (Zimbabwe)</button>
                                <button class="dropdown-item" data-code="+264">🇳🇦 +264 (Namibia)</button>
                                <button class="dropdown-item" data-code="+265">🇲🇼 +265 (Malawi)</button>
                                <button class="dropdown-item" data-code="+266">🇱🇸 +266 (Lesotho)</button>
                                <button class="dropdown-item" data-code="+267">🇧🇼 +267 (Botswana)</button>
                                <button class="dropdown-item" data-code="+268">🇸🇿 +268 (Eswatini)</button>
                                <button class="dropdown-item" data-code="+269">🇰🇲 +269 (Comoros)</button>
                                <button class="dropdown-item" data-code="+382">🇲🇪 +382 (Montenegro)</button>
                                <button class="dropdown-item" data-code="+383">🇽🇰 +383 (Kosovo)</button>
                                <button class="dropdown-item" data-code="+386">🇸🇮 +386 (Slovenia)</button>
                                <button class="dropdown-item" data-code="+220">🇬🇲 +220 (Gambia)</button>
                                <button class="dropdown-item" data-code="+221">🇸🇳 +221 (Senegal)</button>
                                <button class="dropdown-item" data-code="+222">🇲🇷 +222 (Mauritania)</button>
                                <button class="dropdown-item" data-code="+223">🇲🇱 +223 (Mali)</button>
                                <button class="dropdown-item" data-code="+224">🇬🇳 +224 (Guinea)</button>
                                <button class="dropdown-item" data-code="+225">🇨🇮 +225 (Ivory Coast)</button>
                                <button class="dropdown-item" data-code="+226">🇧🇫 +226 (Burkina Faso)</button>
                                <button class="dropdown-item" data-code="+227">🇳🇪 +227 (Niger)</button>
                                <button class="dropdown-item" data-code="+228">🇹🇬 +228 (Togo)</button>
                                <button class="dropdown-item" data-code="+229">🇧🇯 +229 (Benin)</button>
                                <button class="dropdown-item" data-code="+230">🇲🇺 +230 (Mauritius)</button>
                                <button class="dropdown-item" data-code="+231">🇱🇷 +231 (Liberia)</button>
                                <button class="dropdown-item" data-code="+232">🇸🇱 +232 (Sierra Leone)</button>
                                <button class="dropdown-item" data-code="+233">🇬🇭 +233 (Ghana)</button>
                                <button class="dropdown-item" data-code="+235">🇹🇩 +235 (Chad)</button>
                                <button class="dropdown-item" data-code="+236">🇨🇫 +236 (Central African
                                    Republic)</button>
                                <button class="dropdown-item" data-code="+237">🇨🇲 +237 (Cameroon)</button>
                                <button class="dropdown-item" data-code="+238">🇨🇻 +238 (Cape Verde)</button>
                                <button class="dropdown-item" data-code="+239">🇸🇹 +239 (Sao Tome &
                                    Principe)</button>
                                <button class="dropdown-item" data-code="+240">🇬🇶 +240 (Equatorial Guinea)</button>
                            </div>

                            <div class="form-floating">
                                <input type="hidden" name="code" id="selectedCountryCode" value="+62">
                                <input type="tel"
                                    class="form-control bg-dark text-white @error('no_tlp') is-invalid @enderror"
                                    id="floatingno_tlp" placeholder="Your Phone Number" value="{{ old('no_tlp') }}"
                                    required name="no_tlp">
                                <label for="floatingno_tlp" class="text-white">Phone Number</label>
                            </div>
                        </div>

                        @error('no_tlp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- JavaScript -->
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let button = document.getElementById("countryCodeBtn");
                        let dropdown = document.getElementById("countryDropdown");

                        // Saat tombol diklik, tampilkan atau sembunyikan dropdown
                        button.addEventListener("click", function() {
                            dropdown.style.display = (dropdown.style.display === "block") ? "none" : "block";
                        });

                        // Saat memilih kode negara
                        dropdown.addEventListener("click", function(event) {
                            if (event.target.classList.contains("dropdown-item")) {
                                let selectedCode = event.target.getAttribute("data-code"); // Ambil hanya kode negara
                                let countryFlag = event.target.textContent.split(" ")[0];
                                countryCodeBtn.innerHTML = `${countryFlag} ${selectedCode}`;
                                button.textContent = selectedCode; // Perbarui tombol dengan kode negara saja
                                dropdown.style.display = "none"; // Sembunyikan dropdown
                            }
                        });

                        // Sembunyikan dropdown jika klik di luar
                        document.addEventListener("click", function(event) {
                            if (!button.contains(event.target) && !dropdown.contains(event.target)) {
                                dropdown.style.display = "none";
                            }
                        });
                    });
                </script>





                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        let button = document.getElementById("countryCodeBtn");
                        let select = document.getElementById("countryCode");

                        // Ketika tombol diklik, tampilkan select
                        button.addEventListener("click", function() {
                            select.classList.remove("d-none"); // Tampilkan select
                            select.focus(); // Fokus ke select
                        });

                        // Saat select berubah, perbarui tombol dan sembunyikan select kembali
                        select.addEventListener("change", function() {
                            button.innerText = select.value; // Set tombol dengan nilai baru
                            select.classList.add("d-none"); // Sembunyikan select lagi
                        });

                        // Jika select kehilangan fokus, sembunyikan kembali
                        select.addEventListener("blur", function() {
                            select.classList.add("d-none");
                        });
                    });
                </script>

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
                                id="floatingPasswordConfirm" placeholder="Confirm Password"
                                name="password_confirmation" required>
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
