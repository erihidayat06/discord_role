@extends('admin.layouts.main')

@section('content')


    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Orderan</h3>
        </div>
        <div class="card-body table-responsive">
            <h2 class="text-white fw-bold">Riwayat Orderan</h2>
            <table class="table datatable ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Paket</th>
                        <th>Nama_________</th>
                        <th>Email</th>
                        <th>Nomor</th>
                        <th>Type_Pembayaran</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Dibuat_Pada</th>
                        <th>Dibayar_Pada</th>
                    </tr>
                </thead>
                <tbody>

                    @if ($orders->isNotEmpty())
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
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
                                        $badgeClass = $statusLabels[$status] ?? 'badge bg-secondary';
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

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11" class="text-center text-white">Belum ada riwayat orderan</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>










@endsection
