@extends('user.layouts_research.main')

@section('content')
    <style>
        /* Styling untuk tabel */
        .table-transparent tbody,
        .table-transparent tbody tr,
        .table-transparent tbody td {
            background-color: rgb(43, 43, 43) !important;
            color: white;
        }

        .table-transparent thead tr {
            background-color: rgb(43, 43, 43) !important;
        }

        .table-transparent thead th {
            color: white !important;
        }

        .table> :not(caption)>*>* {
            background-color: #ffffff0d;
        }

        /* Styling untuk cards */
        .order-card {
            background-color: rgb(43, 43, 43);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .badge {
            font-size: 14px;
            padding: 5px 10px;
        }

        body {
            background-color: #000000 !important;
            color: white;
            max-width: 100% !important;
            /* Atur maksimal lebar body */
            margin: 0 auto;
            /* Pusatkan body */
            padding: 20px;
            /* Beri sedikit padding agar tidak terlalu mepet */
        }

        @media (max-width: 768px) {
            p {
                font-size: 14px;
            }
        }
    </style>

    <h1 class="text-center">Orderan User</h1>

    @php
        $orders = optional(auth()->user())->orders ?? collect([]);
        $orders = $orders->sortByDesc('created_at'); // Mengurutkan dari yang terbaru
    @endphp

    <!-- TABEL UNTUK DESKTOP -->
    <div class="card bg-dark d-none d-md-block">
        <div class="card-body mt-3 table-responsive">
            <h4 class="text-white fw-bold">Riwayat Orderan</h4>
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
                    @forelse ($orders as $index => $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->keanggotaan->bulan }}Bulan</td>
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
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->format('d_M_Y_H:i') }}</td>
                            <td>
                                @if ($order->paid_at)
                                    {{ \Carbon\Carbon::parse($order->paid_at)->format('d_M_Y_H:i') }}
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
                    @empty
                        <tr>
                            <td colspan="12" class="text-center text-white">Belum ada riwayat orderan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- KARTU UNTUK MOBILE -->
    <div class="d-md-none">
        @forelse ($orders as $order)
            <div class="order-card">
                <h5>Kode: <span class="fw-bold">{{ $order->order_id }}</span></h5>
                <p>Paket: {{ $order->keanggotaan->bulan }} Bulan</p>
                <p>Nama: {{ $order->user->name }}</p>
                <p>Email: {{ $order->user->email }}</p>
                <p>Nomor: {{ $order->user->no_tlp }}</p>
                <p>Type Pembayaran: {{ $order->type }}</p>
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
        @empty
            <p class="text-center text-white">Belum ada riwayat orderan</p>
        @endforelse
    </div>

    {{-- Midtrans Snap --}}
    <script src="{{ env('MIDTRANS_URL') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>

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
