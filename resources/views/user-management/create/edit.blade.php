@extends('index')
@section('content')
    <!-- Begin Page Content -->

    <!-- Page Heading -->
    <div class="row d-sm-flex align-items-center justify-content-between mb-1 mt-4">
        <div class="col">
            <h4 class="mb-0 text-info font-weight-bold mb-2">Edit Data {{ ucfirst($role) }}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if (session('successcreateuser'))
                <div class="alert alert-success d-flex justify-content-between align-items-center" role="alert">
                    <span>{{ session('successcreate') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger position-relative" role="alert">
                    <div class="d-inline-flex align-items-center">
                        @foreach ($errors->all() as $error)
                            <div class="me-2"><i class="bi bi-dot"></i> {{ $error }}</div>
                        @endforeach
                    </div>
                    <button type="button" class="btn-close position-absolute top-50 end-0 translate-middle-y me-3"
                        data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
    </div>

    <form action="{{ route('edit-user-process', $user->id) }}" method="POST" class="col-md-9 border rounded p-3"
        enctype="multipart/form-data">
        @csrf

        <!-- Field Umum -->
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" id="name">
        </div>

        <!-- Field Khusus Guru -->
        @if ($role == 'teacher')
            <div class="mb-3">
                <label for="nip" class="form-label">NIP</label>
                <input type="number" name="nip" value="{{ old('nip', $user->nip) }}" class="form-control"
                    id="nip">

            </div>
        @endif

        <!-- Field Khusus Murid -->
        @if ($role == 'student')
            <div class="mb-3">
                <label for="nisn" class="form-label">NISN</label>
                <input type="number" name="nisn" value="{{ old('nisn', $user->nisn) }}" class="form-control"
                    id="nisn">

            </div>
            <div class="mb-3">
                <label for="classroom_id" class="form-label">Kelas</label>
                <select name="classroom_id" class="custom-select" id="classroom_id">
                    <option value="">Pilih Kelas</option>
                    @foreach ($classrooms as $classroom)
                        <option value="{{ $classroom->id }}"
                            {{ old('classroom_id', $user->classroom_id) == $classroom->id ? 'selected' : '' }}>
                            {{ $classroom->name }}
                        </option>
                    @endforeach
                </select>

            </div>
        @endif

        <!-- Field Tanggal Lahir, Email, dan Telepon (Umum) -->
        <div class="mb-3">
            <label for="birth" class="form-label">Tanggal Lahir</label>
            <input type="date" name="birth" value="{{ old('birth', $user->birth) }}" class="form-control"
                id="birth">

        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control"
                id="email">

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" value="" class="form-control" id="exampleInputPassword1">
        </div>
        <input type="hidden" name="role" value="{{ $role }}">
        <div class="mb-3">
            <label for="telp" class="form-label">No Telp</label>
            <input type="number" name="telp" value="{{ old('telp', $user->telp) }}" class="form-control"
                id="telp">

        </div>

        <!-- Field Alamat dan Foto -->
        <div class="mb-3">
            <label for="address" class="form-label">Alamat</label>
            <input type="text" name="address" value="{{ old('address', $user->address) }}" class="form-control"
                id="address">

        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Foto</label>
            <input class="form-control p-1" name="image" type="file" id="formFile">

        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
