<?php

return [
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
    'snap_url' => env('MIDTRANS_URL'),
];
