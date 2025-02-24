@extends('admin.layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Create kategori</div>
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

                        <form action="{{ '/kategori' }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" name="nm_kategori"
                                    class="form-control @error('nm_kategori') is-invalid @enderror"
                                    value="{{ old('nm_kategori') }}">
                                @error('nm_kategori')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>



                            <button type="submit" class="btn btn-primary">Create kategori</button>
                            <a href="{{ url('/kategori') }}" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
