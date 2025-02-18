<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
            <img src="/assets/img/logo-admin.png" alt="">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <!-- Pilihan Guild -->
    <div class="ms-3">
        <select id="select-guild" class="form-select">
            @foreach (guild() as $guild)
                <option value="{{ $guild->id_guild }}" {{ pilih_guild() == $guild->id_guild ? 'selected' : '' }}>
                    {{ $guild->name_guild }}
                </option>
            @endforeach
        </select>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li>
                <a href="/logout/admin" type="submit" class="dropdown-item p-5">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
            </li>
        </ul>
    </nav><!-- End Icons Navigation -->
</header><!-- End Header -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#select-guild').change(function() {
            var selectedGuild = $(this).val();

            // Tampilkan loading spinner
            $('#loading-overlay').removeClass('d-none');

            $.ajax({
                url: '/update-guild/ubah',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Laravel CSRF Protection
                    id_guild: selectedGuild
                },
                success: function(response) {
                    console.log(response.message);
                    location.reload(); // Refresh halaman setelah sukses
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

{{-- <script>
    $(document).ready(function() {
        // Tampilkan loading saat halaman mulai dimuat
        $('#loading-overlay').removeClass('d-none');

        // Hilangkan loading setelah halaman selesai dimuat
        $(window).on("load", function() {
            $('#loading-overlay').addClass('d-none');
        });
    });
</script> --}}
