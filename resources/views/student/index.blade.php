@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('content')

<div class="container-fluid">

    {{-- Judul halaman --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Siswa</h1>

        <a href="{{ url('/student/add') }}"
           class="btn btn-primary btn-sm shadow-sm">
            <i class="fas fa-user-plus fa-sm text-white-50"></i>
            Tambah Siswa
        </a>
    </div>

    {{-- Notifikasi --}}
    @if (session('notifikasi'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i>

            {{ session('notifikasi') }}

            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- Card Data Siswa --}}
    <div class="card shadow mb-4">

        {{-- Header card --}}
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-users mr-1"></i>
                Daftar Siswa
            </h6>

            <span class="badge badge-primary">
                {{ $students->count() }} Data
            </span>
        </div>

        {{-- Isi card --}}
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered table-hover"
                       width="100%"
                       cellspacing="0">

                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" width="60">No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Prodi</th>
                            <th class="text-center" width="120">Foto</th>
                            <th class="text-center" width="190">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($students as $data)
                            <tr>
                                <td class="text-center align-middle">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="align-middle">
                                    {{ $data->nim }}
                                </td>

                                <td class="align-middle font-weight-bold text-gray-900">
                                    {{ $data->nama }}
                                </td>

                                <td class="align-middle">
                                    {{ $data->prodi }}
                                </td>

                                <td class="text-center align-middle">
                                    @if ($data->foto)
                                        <img
                                            src="{{ asset('storage/' . $data->foto) }}"
                                            alt="Foto {{ $data->nama }}"
                                            class="img-thumbnail rounded"
                                            style="width: 70px; height: 70px; object-fit: cover;"
                                        >
                                    @else
                                        <div class="text-gray-500">
                                            <i class="fas fa-user-circle fa-3x"></i>

                                            <small class="d-block mt-1">
                                                Tidak ada foto
                                            </small>
                                        </div>
                                    @endif
                                </td>

                                <td class="text-center align-middle">
                                    <a
                                        href="{{ url('/student/edit/' . $data->nim) }}"
                                        class="btn btn-warning btn-sm mr-1"
                                        title="Edit data"
                                    >
                                        <i class="fas fa-user-edit"></i>
                                        Edit
                                    </a>

                                    <form
                                        action="{{ url('/student/' . $data->nim) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data {{ $data->nama }}?')"
                                    >
                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-danger btn-sm"
                                            title="Hapus data"
                                        >
                                            <i class="fas fa-trash-alt"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"
                                    class="text-center text-gray-500 py-5">

                                    <i class="fas fa-folder-open fa-3x mb-3"></i>

                                    <h6 class="font-weight-bold">
                                        Data siswa masih kosong
                                    </h6>

                                    <p class="mb-3">
                                        Belum ada data untuk ditampilkan.
                                    </p>

                                    <a href="{{ url('/student/add') }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-user-plus mr-1"></i>
                                        Tambah Siswa
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

@endsection
