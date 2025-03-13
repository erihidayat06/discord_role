<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $order->order_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
        }

        h2 {
            text-align: center;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-top: 10px;
        }

        .info-table td {
            padding: 8px;
            vertical-align: top;
            text-align: left;
            font-size: 11px;
        }

        .info-table td:first-child,
        .info-table td:nth-child(3) {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="assets/img/logo-admin.png" alt="Logo">
            <h2>Invoice Order</h2>
        </div>

        <table class="info-table">
            <tr>
                <td>Kode Order</td>
                <td>: {{ $order->order_id }}</td>
                <td>Nama</td>
                <td>: {{ $order->user->name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td>: {{ $order->user->email }}</td>
                <td>Nomor</td>
                <td>: {{ $order->user->no_tlp }}</td>
            </tr>
            <tr>
                <td>Type Pembayaran</td>
                <td>: {{ $order->type }}</td>
                <td>Total</td>
                <td>: Rp{{ number_format($order->amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: {{ ucfirst($order->status) }}</td>
                <td>Dibuat Pada</td>
                <td>: {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y H:i') }}</td>
            </tr>
            <tr>
                <td>Dibayar Pada</td>
                <td>:
                    {{ $order->paid_at ? \Carbon\Carbon::parse($order->paid_at)->format('d M Y H:i') : '-' }}
                </td>
                <td>Paket</td>
                <td>: {{ $order->keanggotaan->bulan }}Bulan</td>
            </tr>
        </table>
    </div>
</body>

</html>
