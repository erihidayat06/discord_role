@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create Guild</div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ '/guild' }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Guild Name</label>
                                <input type="text" name="name_guild"
                                    class="form-control @error('name_guild') is-invalid @enderror"
                                    value="{{ old('name_guild') }}">
                                @error('name_guild')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Guild ID</label>
                                <input type="number" name="id_guild"
                                    class="form-control @error('id_guild') is-invalid @enderror"
                                    value="{{ old('id_guild') }}">
                                @error('id_guild')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Expires</label><br>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="expires" id="expires1" autocomplete="off"
                                        value="1" {{ old('expires', '1') == '1' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary" for="expires1">True</label>

                                    <input type="radio" class="btn-check" name="expires" id="expires2" value="0"
                                        autocomplete="off" {{ old('expires') == '0' ? 'checked' : '' }}>
                                    <label class="btn btn-outline-primary" for="expires2">False</label>
                                </div>

                                @error('expires')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create Guild</button>
                            <a href="{{ url('/guild') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
