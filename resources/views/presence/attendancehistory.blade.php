@extends('index')
@section('content')
    <!-- Begin Page Content -->

    <!-- Page Heading -->
    <div class="row d-sm-flex align-items-center justify-content-between mb-1 mt-4">
        <div class="col">
            <h4 class=" mb-0 text-info font-weight-bold mb-2">{{ $title }}</h4>
        </div>
    </div>

    <!-- Date Range Picker -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center  py-3">
            <h6 class="m-0 font-weight-bold text-primary" id="date-range-header">Pilih Rentang Tanggal</h6>
            <div>
                <input type="date" id="start-date" class="form-control" />
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Keterangan</th>
                            <th>Jam Hadir</th>
                            <th>Jam Pulang</th>
                            {{-- <th>Latitude</th>
                            <th>Longitude</th> --}}
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Date</th>
                            <th>Keterangan</th>
                            <th>Jam Hadir</th>
                            <th>Jam Pulang</th>
                            {{-- <th>Latitude</th>
                            <th>Longitude</th> --}}
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($presences as $presence)
                            @php
                                $statusClass = '';
                                // $showDetailButton = false;
                                switch ($presence->information) {
                                    case 'hadir':
                                        $statusClass = 'status-hadir';
                                        break;
                                    case 'izin':
                                        $statusClass = 'status-izin';
                                        // $showDetailButton = true; // Tampilkan tombol detail
                                        break;
                                    case 'alpa':
                                        $statusClass = 'status-alpa';
                                        break;
                                }
                            @endphp
                            <tr>
                                <td>{{ $presence->date }}</td>
                                    <td class="{{ $statusClass }}">
                                        <div class="d-flex ">
                                            <div class="text-capitalize">
                                                {{ $presence->information }}
                                            </div>
                                            {{-- @if ($showDetailButton)
                                                <button type="button" class="btn btn-info btn-sm ml-2" data-toggle="modal"
                                                    data-target="#detailsModal{{ $presence->id }}">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                            @endif --}}
                                        </div>
                                    </td>
                                <td>{{ $presence->check_in_time }}</td>
                                <td>{{ $presence->check_out_time }}</td>
                                {{-- <td>{{ $presence->location->latitude ?? 'N/A' }}</td>
                                <td>{{ $presence->location->longitude ?? 'N/A' }}</td> --}}
                            </tr>
                            <!-- Modal untuk Detail Izin -->
                            {{-- @if ($showDetailButton)
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
                                                <!-- Ganti dengan detail izin yang sesuai -->
                                                <p><strong>Keterangan:</strong>
                                                    {{ $presence->izin_details ?? 'Tidak ada detail' }}</p>
                                                <!-- Tambahkan detail lain sesuai kebutuhan -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->

    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const startDateInput = document.getElementById('start-date');
            const endDateInput = document.getElementById('end-date');
            const dateRangeHeader = document.getElementById('date-range-header');

            // Function to update the header and the end date based on the start date
            function updateDateRange() {
                const startDate = new Date(startDateInput.value);
                if (isNaN(startDate.getTime())) return; // Exit if invalid date

                // Calculate end date as 7 days after start date
                const endDate = new Date(startDate);
                endDate.setDate(startDate.getDate() + 6);

                // Format the dates
                const options = {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit'
                };
                const startDateFormatted = startDate.toLocaleDateString('id-ID', options);
                const endDateFormatted = endDate.toLocaleDateString('id-ID', options);

                // Update header
                dateRangeHeader.textContent = `${startDateFormatted} Sampai ${endDateFormatted}`;

                // Update end date input
                endDateInput.value = endDate.toISOString().split('T')[0];
            }

            // Attach event listeners
            startDateInput.addEventListener('change', updateDateRange);
            endDateInput.addEventListener('change', updateDateRange);
        });
    </script>
@endsection
