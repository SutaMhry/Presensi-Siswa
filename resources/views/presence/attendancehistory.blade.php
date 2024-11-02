@extends('index')
@section('content')
    <div class="row d-sm-flex align-items-center justify-content-between mb-1 mt-4">
        <div class="col">
            <h4 class="mb-0 text-info font-weight-bold mb-2">Kehadiran Siswa Izin</h4>
        </div>
    </div>

    <hr class="divider">

    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center py-3 flex-wrap">
            <h6 class="m-0 font-weight-bold text-primary" id="date-range-header">Kehadiran Siswa Bulan
                {{ date('F Y', strtotime($month)) }}</h6>
            <div>
                <label for="month" class="fw-bold text-muted me-2">Pilih Bulan:</label>
                <input type="month" id="month" name="month" class="form-control"
                    value="{{ $month }}" onchange="filterByMonth()" />
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Keterangan</th>
                            <th>Jam Hadir</th>
                            <th>Jam Pulang</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presences as $presence)
                            <tr>
                                <td>{{ $presence->date }}</td>
                                <td>{{ $presence->student->name ?? 'Tidak ada' }}</td> <!-- Nama Siswa -->
                                <td>{{ $presence->student->nisn ?? 'Tidak ada' }}</td> <!-- NISN -->
                                <td>{{ $presence->information }}</td>
                                <td>{{ $presence->check_in_time ?? 'Tidak ada' }}</td>
                                <td>{{ $presence->check_out_time ?? 'Tidak ada' }}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#detailsModal{{ $presence->id }}">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal untuk Detail Izin -->
                            <div class="modal fade" id="detailsModal{{ $presence->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="detailsModalLabel{{ $presence->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailsModalLabel{{ $presence->id }}">Detail
                                                Izin</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Tanggal:</strong> {{ $presence->date }}</p>
                                            <p><strong>Keterangan:</strong> {{ $presence->information }}</p>
                                            <p><strong>Jam Hadir:</strong>
                                                {{ $presence->check_in_time ?? 'Tidak ada jam hadir' }}</p>
                                            <p><strong>Jam Pulang:</strong>
                                                {{ $presence->check_out_time ?? 'Tidak ada jam pulang' }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>NISN</th>
                            <th>Keterangan</th>
                            <th>Jam Hadir</th>
                            <th>Jam Pulang</th>
                            <th>Detail</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <script>
        function filterByMonth() {
            const monthInput = document.getElementById('month');
            const selectedMonth = monthInput.value;
            const currentUrl = window.location.href.split('?')[0]; // Ambil URL dasar
            window.location.href =
                `${currentUrl}?month=${selectedMonth}`; // Arahkan dengan bulan yang dipilih sebagai parameter query
        }
    </script>
@endsection
