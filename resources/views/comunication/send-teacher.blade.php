@extends('index')
@section('content')
    <!-- Page Heading -->
    <div class="row d-flex align-items-center justify-content-between mb-1 mt-4 ">
        <div class="col">
            <h4 class=" mb-0 text-info font-weight-bold mb-2">Kirim Pesan</h4>
        </div>
    </div>

    <hr class="divider">

    <form class="col-md-9 border p-3 rounded">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Kepada:</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="penerima@example.com">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Judul:</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Judul pesan">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Isi:</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Kirim</button>
    </form>
@endsection
