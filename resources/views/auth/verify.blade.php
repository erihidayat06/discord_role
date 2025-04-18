@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white">{{ __('Verifikasi Alamat Email Anda') }}</div>

                    <div class="card-body text-white">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                            </div>
                        @endif

                        {{ __('Sebelum melanjutkan, silakan periksa email Anda untuk tautan verifikasi.') }}
                        {{ __('Jika Anda tidak menerima email tersebut') }},
                        <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                            @csrf
                            <button type="submit"
                                class="btn btn-link p-0 m-0 align-baseline">{{ __('klik di sini untuk meminta yang baru') }}</button>.
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
