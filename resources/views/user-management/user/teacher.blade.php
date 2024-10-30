@extends('index')
@section('content')
    <div class="row d-sm-flex align-items-center justify-content-between mb-1 mt-4">
        <div class="col">
            <h4 class="mb-0 text-info font-weight-bold mb-2">Data Guru</h4>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <form action="{{ route('teacher-management') }}" method="get"
                class="d-none d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control bg-grey border-0 small"
                        placeholder="Cari Data Guru" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" value="Search">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            <div>
                <a href="{{ route('create-teacher') }}">
                    <button class="btn btn-primary">Tambah Data</button>
                </a>
            </div>
        </div>
        <div class="card-body">
            @if ($classrooms->isEmpty())
                <div class="alert alert-warning text-center">
                    {{ $noDataMessage }}
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Walikelas Dari</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Walikelas Dari</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($classrooms as $classroom)
                                <tr>
                                    <td class="align-middle">
                                        @if ($classroom->hmteacher && $classroom->hmteacher->image)
                                            <img src="{{ asset('storage/image/' . $classroom->hmteacher->image) }}"
                                                alt="Foto" width="30px" class="rounded">
                                        @else
                                            <span>Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        {{ $classroom->hmteacher ? $classroom->hmteacher->name : 'Belum ada guru' }}</td>
                                    <td class="align-middle">
                                        {{ $classroom->hmteacher ? $classroom->hmteacher->nip : 'Belum ada NIP' }}</td>
                                    <td class="align-middle">{{ $classroom->name }}</td>
                                    <td class="align-middle">
                                        <a
                                            href="{{ route('edit-user', $classroom->hmteacher ? $classroom->hmteacher->id : '#') }}">
                                            <button class="btn btn-info me-2"
                                                {{ !$classroom->hmteacher ? 'disabled' : '' }}>
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                        </a>
                                        <form
                                            action="{{ route('hapus-data', $classroom->hmteacher ? $classroom->hmteacher->id : '#') }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger ms-2" type="submit"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus guru ini?')"
                                                {{ !$classroom->hmteacher ? 'disabled' : '' }}>
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>


                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
