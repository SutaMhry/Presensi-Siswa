@extends('index')
@section('content')
    <!-- Page Heading -->
    <div class="row">

        <div class="d-sm-flex align-items-center justify-content-between ">
            <div class="col">
                <h6 id="greeting" class="text-dark font-weight-bold"></h6>
                <h2 class="text-dark font-weight-bold">Admin</h2>
            </div>
        </div>
    </div>

    <hr class="divider">

    {{-- <!-- Page Heading -->
    <div class="row">
        <div class="d-sm-flex align-items-center justify-content-between mb-1">
            <div class="col">
                <h2 class=" mb-0 text-dark font-weight-bold mb-2">
                    Data Presensi Siswa
                </h2>
            </div>
        </div>
    </div> --}}

    <!-- Begin Page Content -->

    {{-- <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div> --}}

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Kelas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Guru</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="#">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Siswa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">72</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Requests</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
    </div>

    <hr class="divider">


    <!-- /.container-fluid -->



    <script>
        function updateGreeting() {
            const now = new Date();
            const jam = now.getHours();

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
        }

        // Update greeting every hour
        updateGreeting();
        setInterval(updateGreeting, 3600000); // 3600000 ms = 1 hour

        // document.getElementById('presence-form').addEventListener('submit', function(event) {
        //     // Mencegah formulir dari pengiriman langsung
        //     event.preventDefault();

        //     // Mendapatkan lokasi dan mengirimkan formulir setelah mendapatkan lokasi
        //     if (navigator.geolocation) {
        //         navigator.geolocation.getCurrentPosition(function(position) {
        //             // Mendapatkan latitude dan longitude
        //             var latitude = position.coords.latitude;
        //             var longitude = position.coords.longitude;

        //             // Mengatur nilai latitude dan longitude di input tersembunyi
        //             document.getElementById('latitude-input').value = latitude;
        //             document.getElementById('longitude-input').value = longitude;

        //             // Mengirimkan formulir setelah penundaan singkat untuk memastikan nilai input diperbarui
        //             setTimeout(function() {
        //                 document.getElementById('presence-form').submit();
        //             }, 100); // Penundaan untuk memungkinkan nilai input diatur sebelum pengiriman formulir
        //         }, function(error) {
        //             console.error('Error mendapatkan lokasi: ', error);
        //             alert('Tidak dapat mengambil lokasi. Silakan coba lagi.');
        //         });
        //     } else {
        //         alert('Geolocation tidak didukung oleh browser ini.');
        //     }
        // });

        document.getElementById('deleteButton').addEventListener('click', function() {
            alert('Apakah Anda yakin ingin menghapus?');
        });
    </script>
@endsection
