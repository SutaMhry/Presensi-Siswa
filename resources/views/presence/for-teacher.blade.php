@extends('index')

@section('content')
<div class="row d-sm-flex align-items-center justify-content-between mb-1 mt-4">
    <div class="col">
        <h4 class="mb-0 text-info font-weight-bold mb-2">Kehadiran Siswa</h4>
    </div>
</div>

<hr class="divider">

<div class="card shadow mb-4">
    <div class="card-header d-flex justify-content-between align-items-center py-3 flex-wrap">
        <h6 class="m-0 font-weight-bold text-primary" id="date-range-header">Kehadiran Siswa Bulan
            {{ date('F Y', strtotime(request('month', date('Y-m')))) }}</h6>
        <div>
            <label for="month" class="fw-bold text-muted me-2">Pilih Bulan:</label>
            <input type="month" id="month" name="month" class="form-control"
                value="{{ request('month', date('Y-m')) }}" onchange="filterByMonth()" />
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Keterangan</th>
                        <th>Jam Hadir</th>
                        <th>Jam Pulang</th>
                        <th>Lokasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presences as $presence)
                        @php
                            $statusClass = '';
                            $showDetailButton = false;
                            switch ($presence->information) {
                                case 'hadir':
                                    $statusClass = 'status-hadir';
                                    break;
                                case 'izin':
                                    $statusClass = 'status-izin';
                                    $showDetailButton = true;
                                    break;
                                case 'alpa':
                                    $statusClass = 'status-alpa';
                                    break;
                            }
                        @endphp
                        <tr>
                            <td class="align-middle">{{ $presence->date }}</td>
                            <td class="align-middle">{{ $presence->user->name }}</td> <!-- Nama Siswa -->
                            <td class="align-middle">{{ $presence->user->nisn }}</td> <!-- NISN Siswa -->
                            <td class="{{ $statusClass }}">
                                <div class="d-flex">
                                    <div class="text-capitalize">{{ ucfirst($presence->information) }}</div>
                                    @if ($showDetailButton)
                                        <button type="button" class="btn btn-info btn-sm ml-2" data-toggle="modal" data-target="#exampleModal{{ $presence->id }}">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                            <td class="align-middle">{{ $presence->check_in_time }}</td>
                            <td class="align-middle">{{ $presence->check_out_time }}</td>
                            <td class="align-middle">
                                @if($presence->latitude && $presence->longitude)
                                    <a href="https://www.google.com/maps?q={{ $presence->latitude }},{{ $presence->longitude }}" target="_blank">
                                        Lihat Lokasi
                                    </a>
                                @else
                                    Lokasi tidak tersedia
                                @endif
                            </td>
                        </tr>

                        <!-- Modal for each presence -->
                        <div class="modal fade" id="exampleModal{{ $presence->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Presensi</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Tanggal:</strong> {{ $presence->date }}</p>
                                        <p><strong>Nama Siswa:</strong> {{ $presence->user->name }}</p> <!-- Nama Siswa -->
                                        <p><strong>NISN:</strong> {{ $presence->user->nisn }}</p> <!-- NISN Siswa -->
                                        <p><strong>Keterangan:</strong> {{ $presence->information }}</p>
                                        <p><strong>Jam Hadir:</strong> {{ $presence->check_in_time }}</p>
                                        <p><strong>Jam Pulang:</strong> {{ $presence->check_out_time }}</p>
                                        <p><strong>Lokasi:</strong>
                                            @if($presence->latitude && $presence->longitude)
                                                <a href="https://www.google.com/maps?q={{ $presence->latitude }},{{ $presence->longitude }}" target="_blank">
                                                    Lihat Lokasi
                                                </a>
                                            @else
                                                Lokasi tidak tersedia
                                            @endif
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info" data-dismiss="modal">Oke</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Keterangan</th>
                        <th>Jam Hadir</th>
                        <th>Jam Pulang</th>
                        <th>Lokasi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function filterByMonth() {
        const month = document.getElementById('month').value;
        window.location.href = `?month=${month}`;
    }
</script>
@endsection
