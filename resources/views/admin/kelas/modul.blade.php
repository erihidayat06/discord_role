@extends('admin.layouts.main')

@section('content')
    <div class="pagetitle">
        <h1>Data Tables modul</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data modul</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card table-responsive">
                    <div class="card-body">
                        <h5 class="card-title">Datatables modul</h5>

                        <a href="/kelas/modul/create?kelas={{ $kelas->id }}" class="btn btn-sm btn-primary mt-3">Tambah
                            modul</a>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-danger mt-3" data-bs-toggle="modal"
                            data-bs-target="#subKelasModal">
                            Tambah sub kelas
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="subKelasModal" tabindex="-1" aria-labelledby="subKelasModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="subKelasModalLabel">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="/kelas/subkelas/{{ $kelas->id }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div id="subKelasContainer">
                                                <div class="input-group mb-2">
                                                    @php
                                                        $subKelas = $kelas->sub_kelas
                                                            ? json_decode($kelas->sub_kelas, true)
                                                            : [];
                                                    @endphp
                                                    @if (empty($subKelas))
                                                        <div class="input-group mb-2">
                                                            <input type="text" class="form-control" name="sub_kelas[]"
                                                                placeholder="Nama Sub Kelas" required>
                                                            <button type="button"
                                                                class="btn btn-danger remove-sub-kelas">Hapus</button>
                                                        </div>
                                                    @else
                                                        @foreach ($subKelas as $sub)
                                                            <div class="input-group mb-2">
                                                                <input type="text" class="form-control"
                                                                    name="sub_kelas[]" value="{{ $sub }}"
                                                                    placeholder="Nama Sub Kelas" required>
                                                                <button type="button"
                                                                    class="btn btn-danger remove-sub-kelas">Hapus</button>
                                                            </div>
                                                        @endforeach
                                                    @endif



                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-success add-sub-kelas">Tambah Sub
                                                Kelas</button>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Keluar</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama modul</th>
                                    <th scope="col">Video</th>
                                    <th scope="col" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;

                                @endphp
                                @foreach ($moduls as $modul)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td>{{ $modul->judul }} </td>
                                        <td>
                                            <a
                                                href="{{ route('lihat.video', ['kelas_id' => $kelas->id, 'id' => $modul->id]) }}">Lihat
                                                video</a>
                                        </td>


                                        <td class="text-center">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ url('/kelas/modul/' . $modul->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm ms-2">Edit</a>
                                                <form action="{{ url('/kelas/modul/' . $modul->id) }}" method="POST"
                                                    class="ms-2">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus modul ini?')">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.add-sub-kelas').addEventListener('click', function() {
                let container = document.getElementById('subKelasContainer');
                let newInput = document.createElement('div');
                newInput.classList.add('input-group', 'mb-2');
                newInput.innerHTML = `
            <input type="text" class="form-control" name="sub_kelas[]" placeholder="Nama Sub Kelas" required>
            <button type="button" class="btn btn-danger remove-sub-kelas">Hapus</button>
        `;
                container.appendChild(newInput);
            });

            document.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-sub-kelas')) {
                    event.target.closest('.input-group').remove();
                }
            });
        });
    </script>
@endsection
