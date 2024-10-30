@extends('index')

@section('content')
    <!-- Page Heading -->
    <div class="row d-sm-flex align-items-center justify-content-between mb-0 mt-4">
        <div class="col">
            <h4 class=" text-info font-weight-bold mb-2">Agenda & Kalender</h4>
        </div>
    </div>

    <hr>

    <!-- Page Heading -->
    <div class="row d-sm-flex align-items-center justify-content-between mb-3 mt-4">
        <div class="col">
            <h4 class=" text-info font-weight-bold mb-2">Jadwal Pelajaran</h4>
        </div>
    </div>

    <div class="row">

        <!-- Content Col -->
        <div class="col">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Berlaku, (12-08-2024) - (16-08-2024)</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Senin</th>
                                    <th>Selasa</th>
                                    <th>Rabu</th>
                                    <th>Kamis</th>
                                    <th>Jumat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PKWU</td>
                                    <td>Agama</td>
                                    <td>Bahasa Indonesia</td>
                                    <td>Bahasa Inggris</td>
                                    <td>Bimbingan Konseling</td>
                                </tr>
                                <tr>
                                    <td>Bahasa Jawa</td>
                                    <td>PPKN</td>
                                    <td>PKWU</td>
                                    <td>Konsentrasi Keahlian</td>
                                    <td>Konsentrasi Keahlian</td>
                                </tr>
                                <tr>
                                    <td>Mapel Pilihan</td>
                                    <td>Konsentrasi keahlian</td>
                                    <td>Bahasa Inggris</td>
                                    <td>Matematika</td>
                                    <td>Konsentrasi Keahlian</td>
                                </tr>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                    <td>Konsentrasi keahlian</td>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- End of Page Wrapper -->

            </div>
        </div>
    </div>
@endsection
