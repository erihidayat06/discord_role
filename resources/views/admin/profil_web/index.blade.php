@extends('admin.layouts.main')

@section('content')
    <div class="container mt-4">
        <form action="{{ route('admin.profil-web.save') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Pengaturan Profil Website
                </div>
                <div class="card-body">

                    {{-- Nama Website --}}
                    <div class="mb-3">
                        <label for="nama_website" class="form-label">Nama Website</label>
                        <input type="text" name="nama_website"
                            class="form-control @error('nama_website') is-invalid @enderror" id="nama_website"
                            value="{{ old('nama_website', $profil->nama_website) }}" required>
                        @error('nama_website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Logo --}}
                    <div class="mb-3">
                        <label for="logo" class="form-label">Logo Website</label>
                        <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo"
                            name="logo" accept="image/*" onchange="previewLogo()">
                        @error('logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="old_logo" value="{{ $profil->logo }}">
                        <div class="mt-3">
                            <img id="logoPreview" src="{{ asset($profil->logo) }}" alt="Preview Logo"
                                style="max-height: 150px;">
                        </div>
                    </div>

                    {{-- Logo Title --}}
                    <div class="mb-3">
                        <label for="logo_title" class="form-label">Logo Title</label>
                        <input class="form-control @error('logo_title') is-invalid @enderror" type="file" id="logo_title"
                            name="logo_title" accept="image/*" onchange="previewLogoTitle()">
                        @error('logo_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <input type="hidden" name="old_logo_title" value="{{ $profil->logo_title }}">
                        <div class="mt-3">
                            <img id="logoTitlePreview" src="{{ asset($profil->logo_title) }}" alt="Logo Title"
                                style="max-height: 150px;">
                        </div>
                    </div>

                    <hr>
                    <h5>Bunny Stream</h5>
                    <div class="mb-3">
                        <label class="form-label">Library ID</label>
                        <input type="text" name="bunny_stream_library_id"
                            class="form-control @error('bunny_stream_library_id') is-invalid @enderror"
                            value="{{ old('bunny_stream_library_id', $profil->bunny_stream_library_id) }}">
                        @error('bunny_stream_library_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">API Key</label>
                        <input type="text" name="bunny_stream_api_key"
                            class="form-control @error('bunny_stream_api_key') is-invalid @enderror"
                            value="{{ old('bunny_stream_api_key', $profil->bunny_stream_api_key) }}">
                        @error('bunny_stream_api_key')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>
                    <h5>Midtrans</h5>
                    <div class="mb-3">
                        <label class="form-label">Merchant ID</label>
                        <input type="text" name="midtrans_merchant_id"
                            class="form-control @error('midtrans_merchant_id') is-invalid @enderror"
                            value="{{ old('midtrans_merchant_id', $profil->midtrans_merchant_id) }}">
                        @error('midtrans_merchant_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Client Key</label>
                        <input type="text" name="midtrans_client_key"
                            class="form-control @error('midtrans_client_key') is-invalid @enderror"
                            value="{{ old('midtrans_client_key', $profil->midtrans_client_key) }}">
                        @error('midtrans_client_key')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Server Key</label>
                        <input type="text" name="midtrans_server_key"
                            class="form-control @error('midtrans_server_key') is-invalid @enderror"
                            value="{{ old('midtrans_server_key', $profil->midtrans_server_key) }}">
                        @error('midtrans_server_key')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="mb-3">
                        <label class="form-label">Snap URL</label>
                        <input type="text" name="midtrans_url"
                            class="form-control @error('midtrans_url') is-invalid @enderror"
                            value="{{ old('midtrans_url', $profil->midtrans_url) }}">
                        @error('midtrans_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="midtrans_is_production"
                            id="midtrans_is_production"
                            {{ old('midtrans_is_production', $profil->midtrans_is_production) ? 'checked' : '' }}>
                        <label class="form-check-label" for="midtrans_is_production">
                            Production Mode
                        </label>
                    </div>

                    <hr>
                    <h5>Discord</h5>
                    <div class="mb-3">
                        <label class="form-label">Discord Client ID</label>
                        <input type="text" name="discord_client_id"
                            class="form-control @error('discord_client_id') is-invalid @enderror"
                            value="{{ old('discord_client_id', $profil->discord_client_id) }}">
                        @error('discord_client_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Discord Client Secret</label>
                        <input type="text" name="discord_client_secret"
                            class="form-control @error('discord_client_secret') is-invalid @enderror"
                            value="{{ old('discord_client_secret', $profil->discord_client_secret) }}">
                        @error('discord_client_secret')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Discord Bot Token</label>
                        <input type="text" name="discord_bot_token"
                            class="form-control @error('discord_bot_token') is-invalid @enderror"
                            value="{{ old('discord_bot_token', $profil->discord_bot_token) }}">
                        @error('discord_bot_token')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </div>
        </form>
    </div>

    {{-- Preview Scripts --}}
    <script>
        function previewLogo() {
            const input = document.getElementById('logo');
            const preview = document.getElementById('logoPreview');
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }

        function previewLogoTitle() {
            const input = document.getElementById('logo_title');
            const preview = document.getElementById('logoTitlePreview');
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
