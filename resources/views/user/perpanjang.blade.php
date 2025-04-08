@extends('user.layouts_research.main')

@section('content')
    <link rel="stylesheet" href="/assets/css/main.css">
    <div class="text-center mb-4" data-aos="fade-up">
        <p class="text-spacing text-grad fw-bold">PRICING</p>

    </div>
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-3 g-4 justify-content-center">
            @foreach ($keanggotaans as $index => $keanggotaan)
                <div class="col d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="{{ $index * 200 }}">
                    <div class="card text-white position-relative w-100 text-start mt-3">
                        <!-- Badge di atas -->
                        <div
                            class="top-badge {{ $keanggotaan->title && $keanggotaan->text_title != null ? 'd-block' : 'd-none' }}">
                            {{ $keanggotaan->text_title }}</div>
                        <div class="card-body d-flex flex-column">
                            <p class="text-spacing fs-6">Keanggotaan {{ $keanggotaan->bulan }} Bulan</p>
                            <h1 class="fw-bold">
                                Rp{{ number_format($keanggotaan->harga_setahun, 0, ',', '.') }}</h1>
                            <span>/bulan</span>
                            <hr>
                            <p class="fw-bold text-danger text-decoration-line-through m-0" style="font-size: 14px">
                                Rp{{ number_format($keanggotaan->harga * $keanggotaan->bulan, 0, ',', '.') }}
                            </p>
                            <h2 class="fw-bold">
                                Rp{{ number_format($keanggotaan->harga_setahun * $keanggotaan->bulan, 0, ',', '.') }}</h2>
                            <p>*Pembayaran {{ $keanggotaan->bulan }} Bulan Penuh</p>
                            <div class="text-center mt-auto">
                                <div class="button-wrapper">
                                    <a {!! auth()->check()
                                        ? 'data-bs-toggle="modal" data-bs-target="#paymentModal' . $keanggotaan->id . '"'
                                        : 'href="/register"' !!} class="text-decoration-none">
                                        <button class="custom-bergabung-border2"></button>
                                        <button class="custom-bergabung-border"></button>
                                        <button class="custom-bergabung text-spacing fs-6"
                                            style="font-size: 14px !important">Bergabung
                                            Sekarang</button>
                                    </a>
                                </div>
                            </div>
                            <div class="img-card">
                                <img src="{{ asset(profil_web()->logo) }}" alt="" width="40%">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                @auth


                    <div class="modal fade text-dark" id="paymentModal{{ $keanggotaan->id }}" tabindex="-1"
                        aria-labelledby="paymentModal{{ $keanggotaan->id }}Label" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="paymentModalLabel">Konfirmasi Pembayaran</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Tabel Harga -->
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Paket</th>
                                                <th>Harga Per Bulan</th>
                                                <th>Harga {{ $keanggotaan->bulan }} Bulan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $keanggotaan->bulan }} Bulan</td>
                                                <td>Rp{{ number_format($keanggotaan->harga_setahun, 0, ',', '.') }}
                                                </td>
                                                <td>Rp{{ number_format($keanggotaan->harga_setahun * $keanggotaan->bulan, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <!-- Pilihan Metode Pembayaran dengan Kotak -->
                                    <h6 class="mt-3 text-center fw-bold">Pilih Metode Pembayaran</h6>
                                    <div class="d-flex justify-content-center flex-wrap gap-3 ">
                                        <label class="payment-option">
                                            <input type="radio" name="payment_type_{{ $keanggotaan->id }}"
                                                value="bank_transfer" checked>
                                            <div class="option-content"><img
                                                    src="https://cdn-icons-png.flaticon.com/512/6404/6404655.png" width="70%"
                                                    alt="">
                                            </div>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_type_{{ $keanggotaan->id }}" value="gopay">
                                            <div class="option-content"><img
                                                    src="https://antinomi.org/wp-content/uploads/2022/03/logo-gopay-vector.png"
                                                    width="100%" alt=""></div>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_type_{{ $keanggotaan->id }}" value="qris">
                                            <div class="option-content"><img
                                                    src="https://images.seeklogo.com/logo-png/39/2/quick-response-code-indonesia-standard-qris-logo-png_seeklogo-391791.png"
                                                    width="100%" alt="">
                                            </div>
                                        </label>
                                        <label class="payment-option">
                                            <input type="radio" name="payment_type_{{ $keanggotaan->id }}"
                                                value="credit_card">
                                            <div class="option-content"><img
                                                    src="https://st2.depositphotos.com/2485091/45350/v/450/depositphotos_453506614-stock-illustration-popular-credit-card-companies-logos.jpg"
                                                    width="100%" alt=""></div>
                                        </label>
                                    </div>

                                    <!-- Info User -->
                                    <hr>
                                    <h6 class="mt-3 fw-bold">Informasi Pengguna</h6>
                                    <p><strong>Nama:</strong> {{ auth()->user()->name }}</p>
                                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                                    <p><strong>No Telepon:</strong> {{ auth()->user()->no_tlp }}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="button" class="btn btn-primary pay-button"
                                        data-id="{{ $keanggotaan->id }}">Lanjutkan Pembayaran</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endauth

                <!-- Tambahkan CSS -->
                <style>
                    .payment-option {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        flex-direction: column;
                        width: 120px;
                        height: 80px;
                        border: 2px solid #ddd;
                        border-radius: 10px;
                        cursor: pointer;
                        text-align: center;
                        font-weight: bold;
                        transition: all 0.3s;
                        position: relative;
                    }

                    .payment-option input {
                        position: absolute;
                        opacity: 0;
                        cursor: pointer;
                    }

                    .payment-option input:checked+.option-content {
                        background-color: #0d6efd;
                        color: white;
                        border-color: #0d6efd;
                    }

                    .option-content {
                        width: 100%;
                        height: 100%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 10px;
                        padding: 10px;
                    }
                </style>
            @endforeach
        </div>
    </div>





    <script>
        document.querySelectorAll('.pay-button').forEach(button => {
            button.addEventListener('click', async function() {
                let keanggotaanId = this.getAttribute('data-id');
                let paymentTypeInput = document.querySelector(
                    `input[name="payment_type_${keanggotaanId}"]:checked`);

                if (!paymentTypeInput) {
                    alert('Silakan pilih metode pembayaran!');
                    return;
                }

                let paymentType = paymentTypeInput.value;
                console.log('Payment Type:', paymentType);

                // Ubah tombol saat loading
                this.disabled = true;
                this.textContent = 'Memproses...';

                try {
                    let response = await fetch('/payment/process', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            keanggotaan_id: keanggotaanId,
                            payment_type: paymentType
                        })
                    });

                    let data = await response.json();
                    console.log('Midtrans Token:', data.token);

                    if (!data.token) {
                        alert('Gagal mendapatkan token pembayaran!');
                        return;
                    }

                    snap.pay(data.token, {
                        onSuccess: async function(result) {
                            console.log('Pembayaran sukses:', result);

                            if (!result.order_id) {
                                alert('Order ID tidak ditemukan!');
                                return;
                            }

                            // Kirim notifikasi sukses ke backend
                            try {
                                let notifyResponse = await fetch('/payment/notification', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        order_id: result.order_id,
                                        transaction_status: 'settlement' // Status sukses
                                    })
                                });

                                let notifyData = await notifyResponse.json();
                                console.log('Status pembayaran diperbarui:', notifyData);

                                // Redirect setelah status sukses diupdate
                                window.location.href = '/kursus';

                            } catch (error) {
                                console.error('Gagal mengupdate status pembayaran:', error);
                                alert(
                                    'Terjadi kesalahan saat memperbarui status pembayaran.'
                                );
                            }
                        },
                        onPending: async function(result) {
                            console.log('Pembayaran pending:', result);
                            alert('Menunggu pembayaran...');

                            if (!result.order_id) {
                                alert('Order ID tidak ditemukan!');
                                return;
                            }

                            // Update status ke pending sebelum redirect
                            await updatePaymentStatus(result.order_id, 'pending');
                            window.location.href = '/orderan/user';
                        },
                        onError: async function(result) {
                            console.log('Pembayaran gagal:', result);
                            alert('Pembayaran gagal!');

                            if (!result.order_id) {
                                alert('Order ID tidak ditemukan!');
                                return;
                            }

                            // Kirim status gagal ke backend sebelum redirect
                            await updatePaymentStatus(result.order_id, 'failure');
                            window.location.href = '/orderan/user';
                        }
                    });

                } catch (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan, silakan coba lagi.');
                } finally {
                    // Kembalikan tombol ke keadaan semula
                    this.disabled = false;
                    this.textContent = 'Bayar Sekarang';
                }
            });
        });

        async function updatePaymentStatus(orderId, status) {
            try {
                let response = await fetch('/payment/notification', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        transaction_status: status
                    })
                });

                let data = await response.json();
                console.log(`Status pembayaran (${status}) diperbarui:`, data);
            } catch (error) {
                console.error(`Error update status (${status}):`, error);
            }
        }
    </script>

    <!-- Tambahkan Midtrans Script -->
    <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ profil_web()->midtrans_client_key }}"></script>
@endsection
