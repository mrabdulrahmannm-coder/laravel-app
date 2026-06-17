
@extends('layouts.admin')

@section('title', 'Edit Data Siswa')

@section('content')

<div class="container-fluid">

    {{-- Judul halaman --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            Edit Data Siswa
        </h1>

        <a href="{{ url('/student') }}"
           class="btn btn-danger btn-sm shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i>
            Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">

            <div class="card shadow mb-4">

                {{-- Header card --}}
                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-user-edit mr-1"></i>
                        Form Edit Siswa
                    </h6>

                    <span class="badge badge-primary">
                        NIM: {{ $student->nim }}
                    </span>
                </div>

                <form
                    action="{{ url('/student/' . $student->nim) }}"
                    method="POST"
                    enctype="multipart/form-data"
                >
                    @csrf
                    @method('PUT')

                    <input
                        type="hidden"
                        name="old_nim"
                        value="{{ $student->nim }}"
                    >

                    <div class="card-body">

                        {{-- Notifikasi --}}
                        @if (session('notifikasi'))
                            <div class="alert alert-success alert-dismissible fade show"
                                 role="alert">

                                <i class="fas fa-check-circle mr-1"></i>

                                {{ session('notifikasi') }}

                                <button
                                    type="button"
                                    class="close"
                                    data-dismiss="alert"
                                    aria-label="Tutup"
                                >
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        {{-- Semua error validasi --}}
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <div class="font-weight-bold mb-2">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    Data belum dapat disimpan.
                                </div>

                                <ul class="mb-0 pl-4">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- NIM --}}
                        <div class="form-group">
                            <label for="nim" class="font-weight-bold">
                                <i class="fas fa-id-card mr-1 text-gray-500"></i>
                                NIM
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                id="nim"
                                name="nim"
                                value="{{ old('nim', $student->nim) }}"
                                placeholder="Masukkan NIM"
                                required
                                class="form-control @error('nim') is-invalid @enderror"
                            >

                            @error('nim')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Nama --}}
                        <div class="form-group">
                            <label for="nama" class="font-weight-bold">
                                <i class="fas fa-user mr-1 text-gray-500"></i>
                                Nama
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                value="{{ old('nama', $student->nama) }}"
                                placeholder="Masukkan nama siswa"
                                required
                                class="form-control @error('nama') is-invalid @enderror"
                            >

                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label for="email" class="font-weight-bold">
                                <i class="fas fa-envelope mr-1 text-gray-500"></i>
                                E-mail
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email', $student->email) }}"
                                placeholder="Masukkan alamat e-mail"
                                required
                                class="form-control @error('email') is-invalid @enderror"
                            >

                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Prodi --}}
                        <div class="form-group">
                            <label for="prodi" class="font-weight-bold">
                                <i class="fas fa-graduation-cap mr-1 text-gray-500"></i>
                                Program Studi
                                <span class="text-danger">*</span>
                            </label>

                            <select
                                id="prodi"
                                name="prodi"
                                required
                                class="form-control @error('prodi') is-invalid @enderror"
                            >
                                <option value="">-- Pilih Program Studi --</option>

                                <option
                                    value="Teknik Informatika"
                                    {{ old('prodi', $student->prodi) === 'Teknik Informatika' ? 'selected' : '' }}
                                >
                                    Teknik Informatika
                                </option>

                                <option
                                    value="Teknik Rekayasa Keamanan Siber"
                                    {{ old('prodi', $student->prodi) === 'Teknik Rekayasa Keamanan Siber' ? 'selected' : '' }}
                                >
                                    Teknik Rekayasa Keamanan Siber
                                </option>

                                <option
                                    value="Teknik Rekayasa Perangkat Lunak"
                                    {{ old('prodi', $student->prodi) === 'Teknik Rekayasa Perangkat Lunak' ? 'selected' : '' }}
                                >
                                    Teknik Rekayasa Perangkat Lunak
                                </option>
                            </select>

                            @error('prodi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Foto --}}
                        <div class="form-group mb-0">
                            <label for="foto" class="font-weight-bold">
                                <i class="fas fa-image mr-1 text-gray-500"></i>
                                Foto
                            </label>

                            @if (!empty($student->foto))
                                <div class="mb-3">
                                    <p class="small text-gray-600 mb-2">
                                        Foto saat ini:
                                    </p>

                                    <img
                                        src="{{ asset('storage/' . $student->foto) }}"
                                        alt="Foto {{ $student->nama }}"
                                        class="img-thumbnail"
                                        style="width: 120px; height: 120px; object-fit: cover;"
                                    >
                                </div>
                            @else
                                <div class="alert alert-secondary py-2">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Siswa belum memiliki foto.
                                </div>
                            @endif

                            <div class="custom-file">
                                <input
                                    type="file"
                                    id="foto"
                                    name="foto"
                                    accept=".png,.jpg,.jpeg,image/png,image/jpeg"
                                    class="custom-file-input @error('foto') is-invalid @enderror"
                                >

                                <label class="custom-file-label" for="foto">
                                    Pilih foto baru
                                </label>

                                @error('foto')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <small class="form-text text-muted">
                                Kosongkan apabila tidak ingin mengganti foto.
                                Format yang diperbolehkan: JPG, JPEG, atau PNG.
                            </small>
                        </div>

                    </div>

                    {{-- Footer card --}}
                    <div class="card-footer bg-light">

                        <a href="{{ url('/student') }}"
                           class="btn btn-danger mr-2">
                            <i class="fas fa-times mr-1"></i>
                            Batal
                        </a>

                        <button type="reset"
                                class="btn btn-warning mr-2">
                            <i class="fas fa-undo mr-1"></i>
                            Reset
                        </button>

                        <button type="submit"
                                class="btn btn-success">
                            <i class="fas fa-save mr-1"></i>
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>

</div>

@endsection

@push('addon-script-footer')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const fotoInput = document.getElementById('foto');

        if (fotoInput) {
            fotoInput.addEventListener('change', function () {
                const label = this.nextElementSibling;
                const fileName = this.files.length > 0
                    ? this.files[0].name
                    : 'Pilih foto baru';

                if (label) {
                    label.textContent = fileName;
                }
            });
        }
    });
</script>
@endpush

