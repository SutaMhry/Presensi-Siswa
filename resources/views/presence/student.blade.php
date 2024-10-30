@extends('index')
@section('content')
    <!-- Page Heading -->
    <h2 class="text-dark font-weight-bold">Presensi Kehadiran</h2>

    <!-- Form Kehadiran dan Pulang -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-3">
            <div class="card shadow border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="no-gutters align-items-center">
                        <h4 id="time" class="mb-0 font-weight-bold text-dark d-flex justify-content-center">Jam Sekarang
                        </h4>
                        <div id="date"
                            class="h-0 h6 font-weight-bold text-dark text-uppercase mt-2 d-flex justify-content-center">
                            Tanggal Sekarang
                        </div>
                        <hr class="divider">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('checkin_error'))
                            <div class="alert alert-danger">{{ session('checkin_error') }}</div>
                        @endif
                        @if (session('checkout_error'))
                            <div class="alert alert-danger">{{ session('checkout_error') }}</div>
                        @endif
                        @if (session('location_error'))
                            <div class="alert alert-danger">{{ session('location_error') }}</div>
                        @endif
                        <div class="d-flex justify-content-center">
                            <form id="checkin-form" action="{{ route('presencestudent') }}" method="POST">
                                @csrf
                                <button id="check-in-button" type="button" class="btn text-light">Hadir</button>
                                <button id="check-out-button" type="button" class="btn text-light">Pulang</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-3">
            <div class="card shadow h-100 py-2 border-left-warning">
                <div class="card-body">
                    <div class="no-gutters align-items-center">
                        <h4 class="mb-0 font-weight-bold text-dark d-flex justify-content-center">Izin</h4>
                        <div class="h-0 h6 font-weight-bold text-dark text-uppercase mt-2 d-flex justify-content-center">
                            Izin</div>
                        <hr class="divider">
                        <div class="d-flex justify-content-center">
                            <a href="{{ route('permit') }}">
                                <button class="btn btn-warning">Izin</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="divider">

    <div class="d-flex justify-content-between align-items-center">
        <h2 class="text-dark font-weight-bold">Riwayat Presensi</h2>
        <button class="btn btn-danger" onclick="window.print()">Print</button>
    </div>
    
    <div class="card shadow mb-4">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center py-3">
            <h6 class="m-0 font-weight-bold text-primary flex-grow-1" id="date-range-header">Presensi Bulan {{ date('F Y', strtotime(request('month', date('Y-m')))) }}</h6>
            <div class="d-flex align-items-center ">
                <label for="month" class=" fw-bold ">Pilih Bulan:</label>
                <input type="month" id="month" name="month" class="form-control" value="{{ request('month', date('Y-m')) }}" onchange="filterByMonth()"/>
            </div>
        </div>
        
        <div class="card-body">
            @include('presence.partials.table', ['presences' => $presences]) <!-- Menggunakan partials -->
        </div>
    </div>




    <script>
        function filterByMonth() {
            const monthInput = document.getElementById('month').value;
            if (monthInput) {
                window.location.href = '/presences?month=' + monthInput; // Ganti dengan route yang sesuai untuk memfilter
            } else {
                window.location.href = '/presences'; // Route untuk menampilkan semua data
            }
        }



        function printPresences() {
            const printContents = document.getElementById("presences-table").outerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>


    <script>
        document.getElementById("check-in-button").addEventListener("click", function(event) {
            event.preventDefault();
            submitFormWithLocation("check_in");
        });

        document.getElementById("check-out-button").addEventListener("click", function(event) {
            event.preventDefault();
            submitFormWithLocation("check_out");
        });

        function submitFormWithLocation(actionType) {
            const form = document.getElementById("checkin-form");

            // Cek dukungan geolocation
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;

                    // Buat input tersembunyi untuk latitude dan longitude jika belum ada
                    if (!document.querySelector("input[name='latitude']") && !document.querySelector(
                            "input[name='longitude']")) {
                        form.insertAdjacentHTML("beforeend",
                            `<input type="hidden" name="latitude" value="${latitude}">`);
                        form.insertAdjacentHTML("beforeend",
                            `<input type="hidden" name="longitude" value="${longitude}">`);
                    } else {
                        // Perbarui nilai latitude dan longitude jika sudah ada
                        document.querySelector("input[name='latitude']").value = latitude;
                        document.querySelector("input[name='longitude']").value = longitude;
                    }

                    // Tentukan apakah yang dikirim "check_in" atau "check_out"
                    const checkInInput = document.createElement("input");
                    checkInInput.type = "hidden";
                    checkInInput.name = actionType;
                    checkInInput.value = "1";
                    form.appendChild(checkInInput);

                    form.submit();
                }, function(error) {
                    alert("Gagal mendapatkan lokasi. Pastikan Anda memberikan izin lokasi.");
                });
            } else {
                alert("Geolocation tidak didukung oleh browser ini.");
            }
        }
    </script>
@endsection
