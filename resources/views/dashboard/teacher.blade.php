@extends('index')
@section('content')
    <!-- Page Heading -->
    <div class="row">

        <div class="d-sm-flex align-items-center justify-content-between ">
            <div class="col">
                <h6 id="greeting" class="text-dark font-weight-bold"></h6>
                <h2 class="text-dark font-weight-bold">{{ auth()->user()->name }}</h2>
            </div>
        </div>
    </div>


    <hr class="divider">

    <div class="row" >
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow h-100 py-2 bg-light" >
                <div class="card-body">
                    <div class="h4 d-flex justify-content-center font-weight-bold text-dark">Rekap Presensi XII RPL 2</div>
                    <div class="mt-1 text-xs d-flex justify-content-center font-weight-bold text-info mb-0">
                        Total Siswa: {{ $totalStudents }}</div>
                    <div class="row mt-4">
                        <div class="col-xl-4 mb-4">
                            <div class="card bg-success h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-0 font-weight-bold text-light">
                                                Siswa Hadir</div>
                                            <div class="text-xs font-weight-bold text-light text-uppercase mt-2">
                                                {{ $hadir->count() }} Hadir</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-dark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4  mb-4">
                            <div class="card bg-warning h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-0 font-weight-bold text-light">
                                                Siswa Izin</div>
                                            <div class="text-xs font-weight-bold text-light text-uppercase mt-2">
                                                {{ $izin->count() }} izin</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-dark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4  mb-4 ">
                            <div class="card bg-danger h-100 py-2 ">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="h5 mb-0 font-weight-bold text-light">
                                                Siswa Alpa</div>
                                            <div class="text-xs font-weight-bold text-light text-uppercase mt-2">
                                                {{ $alpa->count() }} Alpa</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-dark"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ Route('students-attendance') }}">    
                        <div class="text-xs d-flex justify-content-center font-weight-bold text-dark mt-2">
                            Lihat Selengkapnya --></div>
                    </a>
                </div>
            </div>
        </div>
    </div>



    {{-- <script>
        function updateTimeAndDate() {
            const now = new Date();

            // Format waktu
            let jam = now.getHours();
            let menit = now.getMinutes();
            let detik = now.getSeconds();
            jam = jam < 10 ? '0' + jam : jam;
            menit = menit < 10 ? '0' + menit : menit;
            detik = detik < 10 ? '0' + detik : detik;

            // Format tanggal
            const hari = now.toLocaleDateString('id-ID', {
                weekday: 'long'
            });
            const tanggal = now.getDate();
            const bulan = now.getMonth() + 1; // Bulan dimulai dari 0
            const tahun = now.getFullYear();

            const tanggalFormatted =
                `${hari}, ${tanggal < 10 ? '0' + tanggal : tanggal}-${bulan < 10 ? '0' + bulan : bulan}-${tahun}`;

            // Update konten HTML
            document.getElementById('time').textContent = `${jam}:${menit}:${detik}`;
            document.getElementById('date').textContent = tanggalFormatted;

            // Update greeting
            let greeting;
            if (jam < 12) {
                greeting = "Selamat Pagi,";
            } else if (jam < 15) {
                greeting = "Selamat Siang,";
            } else if (jam < 18) {
                greeting = "Selamat Sore,";
            } else {
                greeting = "Selamat Malam,";
            }
            document.getElementById('greeting').textContent = greeting;

            // Update form inputs
            document.getElementById('date-input').value = now.toISOString().split('T')[0]; // Format YYYY-MM-DD
            document.getElementById('check-in-time-input').value = `${jam}:${menit}:${detik}`;
        }

        // Memperbarui waktu, tanggal, dan sapaan setiap detik
        setInterval(updateTimeAndDate, 1000);
        // Panggil sekali untuk menginisialisasi
        updateTimeAndDate();
    </script> --}}
@endsection
