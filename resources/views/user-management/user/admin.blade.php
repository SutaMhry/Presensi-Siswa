@extends('index')
@section('content')
    <!-- Begin Page Content -->

    <!-- Page Heading -->
    <div class="row d-sm-flex align-items-center justify-content-between mb-1 mt-4">
        <div class="col">
            <h4 class=" mb-0 text-info font-weight-bold mb-2">Data Admin</h4>
        </div>
    </div>

    <!-- Date Range Picker -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center  py-3">
            <!-- Topbar Search -->
            <form action="{{ route('admin-management') }}" method="get" class="d-none d-sm-inline-block form-inline mr-auto my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control bg-grey border-0 small" placeholder="Cari Data Admin"
                            aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" value="Search">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            
            <div>
                <a href="{{ route('create-admin') }}">
                    <button class="btn btn-primary">Tambah Data Admin</button>
                </a>
            </div>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                @if ($users->isEmpty())
                    <div class="alert alert-warning text-center">
                        {{ $noDataMessage }}
                    </div>
                @else
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telp</th>
                                <th>Aksi</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="align-middle">
                                        <img src="{{ asset('storage/image/' . $user->image) }}" alt="Foto" width="30px" class="rounded">
                                    </td>
                                    <td class="align-middle">{{ $user->name }}</td>
                                    <td class="align-middle">{{ $user->email }}</td>
                                    <td class="align-middle">{{ $user->telp }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('edit-user', $user->id) }}">
                                            <button class="btn btn-info me-2"><i class="fas fa-pencil-alt"></i></button>
                                        </a>
                                        <form action="{{ route('hapus-data', $user->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger ms-2" type="submit"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')"><i class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
@endsection
