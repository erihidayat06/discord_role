<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pembayaran</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Midtrans -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
</head>

<body class="container py-5">
    <h3 class="mb-3">Pilih Metode Pembayaran</h3>

    <select id="payment_type" class="form-select mb-3">
        <option value="bank_transfer">Bank Transfer</option>
        <option value="gopay">GoPay</option>
        <option value="qris">QRIS</option>
        <option value="credit_card">Kartu Kredit</option>
    </select>

    <button id="pay-button" class="btn btn-primary">Bayar Sekarang</button>

    <!-- Modal Pembayaran -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda memilih metode pembayaran: <strong id="selected-method"></strong></p>
                    <p>Silakan klik "Lanjutkan" untuk menyelesaikan pembayaran.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="cancel-payment"
                        data-bs-dismiss="modal">Batal</button>
                    <button id="continue-payment" class="btn btn-success">Lanjutkan Pembayaran</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let selectedPaymentType = '';
        let orderId = ''; // Untuk menyimpan order ID

        document.getElementById('pay-button').onclick = function() {
            selectedPaymentType = document.getElementById('payment_type').value;
            document.getElementById('selected-method').textContent = selectedPaymentType;

            let paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
            paymentModal.show();
        };

        document.getElementById('continue-payment').onclick = function() {
            fetch('/payment/process', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        payment_type: selectedPaymentType
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Response dari server:", data);

                    if (data.token) {
                        orderId = data.order_id; // Simpan order ID untuk pembatalan
                        let paymentModalEl = document.getElementById('paymentModal');
                        let paymentModal = bootstrap.Modal.getInstance(paymentModalEl);
                        paymentModal.hide(); // Tutup modal sebelum menampilkan Snap

                        snap.pay(data.token, {
                            onClose: function() {
                                console.log("Snap closed");
                                alert('Pembayaran dibatalkan.');
                                cancelPayment(orderId);
                            }
                        });
                    } else {
                        alert('Gagal mendapatkan token pembayaran.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan, coba lagi.');
                });
        };

        // Fungsi untuk membatalkan transaksi jika modal ditutup
        function cancelPayment(orderId) {
            if (!orderId) return;

            fetch('/midtrans/cancel', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        order_id: orderId
                    })
                })
                .then(response => response.json())
                .then(result => {
                    console.log("Cancel response:", result);
                    alert(result.success ? "Transaksi dibatalkan!" : "Gagal membatalkan transaksi.");
                })
                .catch(error => console.error('Error:', error));
        }

        // Event ketika tombol "Batal" ditekan di modal
        document.getElementById('cancel-payment').onclick = function() {
            alert("Pembayaran dibatalkan.");
        };
    </script>

</body>

</html>
