@extends('index')

@section('content')
    <!-- Begin Page Content -->
    <div class="row d-sm-flex align-items-center justify-content-between mb-1 mt-4">
        <div class="col">
            <h4 class="mb-0 text-info font-weight-bold mb-2">Edit Data Kelas</h4>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if (session('successcreateuser'))
                <div class="alert alert-success d-flex justify-content-between align-items-center" role="alert">
                    <span>{{ session('successcreateuser') }}</span>
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

    <!-- Form Edit Kelas -->
    <form action="{{ route('edit-classroom-process', $classroom->id) }}" method="POST" class="col-md-9 border rounded p-3">
        @csrf
        
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nama Kelas</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{ old('name', $classroom->name) }}" required>
        </div>
        
        <div class="mb-3">
            <label for="hmteacher" class="form-label">Wali Kelas</label>
            <select name="hmteacher" id="hmteacher" class="custom-select" required>
                <option value="">Pilih Wali Kelas</option>
                @foreach ($teachers as $teacherId => $teacherName)
                    <option value="{{ $teacherId }}" {{ $classroom->hmteacher->id == $teacherId ? 'selected' : '' }}>{{ $teacherName }}</option>
                @endforeach
            </select>
        </div>
        
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
