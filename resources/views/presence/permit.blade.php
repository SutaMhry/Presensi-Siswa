@extends('index')

@section('content')
    <!-- Page Heading -->
    <div class="row d-sm-flex justify-content-between ">
        <div class="col">
            <h2 class="text-dark font-weight-bold">Izin</h2>
        </div>
        <a href="{{ route('presencestudent') }}">
            <button class="btn btn-info">Kembali</button>
        </a>
    </div>

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

    @if (session('success'))
        <div class="alert alert-success d-flex justify-content-between align-items-center w-75" role="alert">
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">


        <!-- Content Col -->
        <div class="col">

            <!-- DataTales Example -->
            <form action="{{ route('permit') }}" method="POST" enctype="multipart/form-data"
                class="border rounded p-3 col-md-9 mb-4">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Izin:</label>
                    <input type="date" name="date-permit" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <div class="form-group mb-1 ">
                    <label for="exampleInputEmail1" class="form-label">Jenis Izin:</label>
                    <select id="jenis-izin" name="type-permit" required>
                        <option selected>Pilih Jenis Izin:</option>
                        <option value="sakit">Sakit</option>
                        <option value="urusan-pribadi">Keperluan Pribadi</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Alasan Izin:</label>
                    <input type="text" name="reason" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Dokumentasi Bukti:</label>
                    <input class="form-control p-1" type="file" id="formFile" name="permit-file">
                    <div id="emailHelp" class="form-text">Contoh: Surat Keterangan Dokter, dsb.</div>
                </div>

                <!-- Input tersembunyi untuk latitude dan longitude -->
                <input type="hidden" id="latitude-input" name="latitude">
                <input type="hidden" id="longitude-input" name="longitude">

                <input type="hidden" id="information-input" name="information">
                <button type="submit" id="izin-bottom" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>

    <script>
        // Cek apakah geolocation diizinkan
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                // Dapatkan latitude dan longitude
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                // Isi input tersembunyi dengan data lokasi
                document.getElementById('latitude-input').value = latitude;
                document.getElementById('longitude-input').value = longitude;
            }, function() {
                alert('Gagal mendapatkan lokasi. Pastikan Anda mengizinkan akses lokasi.');
            });
        } else {
            alert('Geolocation tidak didukung oleh browser ini.');
        }

        document.getElementById('izin-bottom').addEventListener('click', function() {
            document.getElementById('information-input').value = 'izin';
        });
    </script>
@endsection
