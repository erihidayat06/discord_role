@extends('layouts.main')

@section('content')
    <style>
        /* Transparan untuk tbody */
        .table-transparent tbody,
        .table-transparent tbody tr,
        .table-transparent tbody td {
            background-color: transparent !important;
            color: white;
        }

        /* Hapus background default Bootstrap */
        .table-transparent thead {
            background-color: transparent !important;
        }

        /* Pastikan header tetap terlihat */
        .table-transparent thead tr {
            background-color: rgba(0, 0, 0, 0.5) !important;
        }

        .table-transparent thead th {
            color: white !important;
        }

        .table> :not(caption)>*>* {
            background-color: #ffffff0d;
        }

        .order-card {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
        }
    </style>

    <h2 class="text-white fw-bold text-center">Riwayat Orderan</h2>
    @php
        $orders = optional(auth()->user())->orders ?? collect([]);
        $orders = $orders->sortByDesc('created_at'); // Mengurutkan dari yang terbaru
    @endphp



    <!-- TABEL UNTUK DESKTOP -->
    <div class="card d-none d-md-block">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-transparent">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Paket</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor</th>
                        <th>Type Pembayaran</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Dibuat Pada</th>
                        <th>Dibayar Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index => $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->keanggotaan->bulan }} Bulan</td>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ $order->user->no_tlp }}</td>
                            <td>{{ $order->type }}</td>
                            <td>Rp{{ number_format($order->amount, 0, ',', '.') }}</td>
                            <td>
                                @php
                                    $statusLabels = [
                                        'pending' => 'badge bg-warning text-dark',
                                        'settlement' => 'badge bg-success',
                                        'capture' => 'badge bg-success',
                                        'success' => 'badge bg-success',
                                        'cancel' => 'badge bg-danger',
                                    ];
                                    $status = $order->status ?? 'unknown';
                                    $badgeClass = $statusLabels[$status] ?? 'badge bg-success';
                                @endphp
                                <span class="{{ $badgeClass }}">{{ ucfirst($status) }}</span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</td>
                            <td>
                                @if ($order->paid_at)
                                    {{ \Carbon\Carbon::parse($order->paid_at)->format('d M Y H:i') }}
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if ($order->status == 'pending')
                                    <button class="btn btn-primary btn-bayar" data-id="{{ $order->id }}">Bayar</button>
                                @else
                                    <a href="{{ url('/order/cetak/' . $order->id) }}" class="btn btn-info" target="_blank">
                                        <i class="bi bi-printer"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="container">


        <!-- KARTU UNTUK MOBILE -->
        <div class="d-md-none">
            @foreach ($orders as $order)
                <div class="order-card">
                    <h5>Kode: <span class="fw-bold">{{ $order->order_id }}</span></h5>
                    <p>Paket: {{ $order->keanggotaan->bulan }} Bulan</p>
                    <p>Nama: {{ $order->user->name }}</p>
                    <p>Total: Rp{{ number_format($order->amount, 0, ',', '.') }}</p>
                    <p>
                        Status:
                        <span class="{{ $statusLabels[$order->status] ?? 'badge bg-success' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </p>
                    <p>Dibuat Pada: {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</p>
                    <p>Dibayar Pada:
                        @if ($order->paid_at)
                            {{ \Carbon\Carbon::parse($order->paid_at)->format('d M Y H:i') }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </p>
                    <div>
                        @if ($order->status == 'pending')
                            <button class="btn btn-primary btn-sm btn-bayar" data-id="{{ $order->id }}">Bayar</button>
                        @else
                            <a href="{{ url('/order/cetak/' . $order->id) }}" class="btn btn-info btn-sm" target="_blank">
                                <i class="bi bi-printer"></i>
                            </a>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- Midtrans Snap --}}
    <script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>


    <script>
        document.querySelectorAll('.btn-bayar').forEach(button => {
            button.addEventListener('click', async function() {
                let orderId = this.getAttribute('data-id');

                try {
                    let response = await fetch(`/payment/token/${orderId}`);
                    let data = await response.json();

                    if (!data.token) {
                        alert('Token pembayaran tidak ditemukan!');
                        return;
                    }

                    snap.pay(data.token, {
                        onSuccess: async function(result) {
                            alert('Pembayaran berhasil!');
                            window.location.href = '/kursus';
                        },
                        onPending: async function(result) {
                            alert('Menunggu pembayaran...');
                            window.location.href = '/orderan/user';
                        },
                        onError: async function(result) {
                            alert('Pembayaran gagal!');
                            window.location.href = '/orderan/user';
                        }
                    });

                } catch (error) {
                    alert('Terjadi kesalahan saat mengambil token pembayaran!');
                }
            });
        });
    </script>
@endsection
