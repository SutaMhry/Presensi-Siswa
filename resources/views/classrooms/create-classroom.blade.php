@extends('index')
@section('content')
    <!-- Begin Page Content -->

    <!-- Page Heading -->
    <div class="row d-sm-flex align-items-center justify-content-between mb-1 mt-4">
        <div class="col">
            <h4 class=" mb-0 text-info font-weight-bold mb-2">Tambah Data Kelas</h4>
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


    <!-- Field Umum -->
    <form action="{{ route('create-classroom-process') }}" method="POST" class="col-md-9 border rounded p-3"
        enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama Kelas</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="hmteacher" class="form-label">Wali Kelas</label>
            <select name="hmteacher" id="hmteacher" class="custom-select" required>
                <option value="">Pilih Wali Kelas</option>
                @foreach ($teachers as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
