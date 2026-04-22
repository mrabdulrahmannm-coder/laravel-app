<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student | Laravel</title>
    <!-- Bostrap -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>
<div class="container">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                data Siswa
                <a href="/student/add" type="button" class="btn btn-primary float-right">Tambah</a>
            </div>
            <div class="card-body">
                @if(session('notifikasi'))
                <div class="allert alert-{{ session('type') }}">
                    {{session('notifikasi')}}
                </div>
                @endif

                <div class="table-respinsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <th>No.</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Parodi</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @forelse ( $students as $index => $data)
                            <tr>
                                <td>{{ $index+1 }}</td>
                                <td>{{ $data->nim }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->parodi }}</td>
                                <td>
                                    <a href="/student/edit/{{ $data->nim }}" class="btn btn-sm btn-warning mr-1"><i class="bi bi-search"></i>Edit</a>
                                    <form action="/student/{{ $data->nim }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data untuk ditampilkan !</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
</body>

</html>