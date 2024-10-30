@extends('index')
@section('content')
    <!-- Begin Page Content -->

    <!-- Page Heading -->
    <div class="row d-sm-flex align-items-center justify-content-between mb-1 mt-4">
        <div class="col">
            <h4 class=" mb-0 text-info font-weight-bold mb-2">Kehadiran Siswa</h4>
        </div>
        <button class="btn btn-danger">
            <i class="fas fa-file-alt"></i>
            Cetak
        </button>
    </div>

    <hr class="divider">


    <!-- Date Range Picker -->
    <div class="card shadow mb-4">
        <div class="card-header d-flex justify-content-between align-items-center  py-3">
            <h6 class="m-0 font-weight-bold text-primary" id="date-range-header">Kehadiran Siswa</h6>
            <div>
                <input type="date" id="start-date" class="form-control" />
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Keterangan</th>
                            <th>Jam Hadir</th>
                            <th>Jam Pulang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($studentsattendance as $studentattendance)
                            <tr>
                                <td>{{ $studentattendance->date }}</td>
                                <td>{{ $studentattendance->user->name }}</td>
                                <td>{{ $studentattendance->user->nisn }}</td>
                                <td>{{ $studentattendance->information }}</td>
                                <td>{{ $studentattendance->check_in_time }}</td>
                                <td>{{ $studentattendance->check_out_time }}</td>
                                <td>
                                    {{-- <button class="btn btn-primary">Statistik Hadir</button> --}}
                                    <!-- Button trigger modal -->
                                    {{-- <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#staticBackdropEdit-{{ $studentattendance->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button> --}}
                                    <!-- Button trigger modal -->
                                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Launch demo modal
                                    </button> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Keterangan</th>
                            <th>Jam Hadir</th>
                            <th>Jam Pulang</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    {{-- <tbody>
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
                                        $showDetailButton = true; // Tampilkan tombol detail
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
                                            @if ($showDetailButton)
                                                <button type="button" class="btn btn-info btn-sm ml-2" data-toggle="modal"
                                                    data-target="#detailsModal{{ $presence->id }}">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                <td>{{ $presence->check_in_time }}</td>
                                <td>{{ $presence->check_out_time }}</td>
                                <td>{{ $presence->location->latitude ?? 'N/A' }}</td>
                                <td>{{ $presence->location->longitude ?? 'N/A' }}</td>
                            </tr>
                            <!-- Modal untuk Detail Izin -->
                            @if ($showDetailButton)
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
                            @endif
                        @endforeach
                    </tbody> --}}
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- MODAL EDIT MENU --}}
    {{-- @foreach ($menus as $menu) --}}
    {{-- <div class="modal fade" id="staticBackdropEdit-{{ $studentattendance->id }}" data-bs-backdrop="static"
        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog"> --}}
            {{-- <form action="{{ url('/menus/' . $menu->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Menu {{ $menu->name }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama</label>
                                <input name="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="{{ old('name', $menu->name) }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <select name="type" class="form-select @error('type') is-invalid @enderror"
                                    id="floatingSelect" aria-label="Floating label select example">
                                    <option value="">Makanan atau Minuman</option>
                                    <option value="makanan" {{ old('type', $menu->type) == 'makanan' ? 'selected' : '' }}>
                                        Makanan</option>
                                    <option value="minuman" {{ old('type', $menu->type) == 'minuman' ? 'selected' : '' }}>
                                        Minuman</option>
                                </select>
                                <label for="floatingSelect">Type Menu</label>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Rp.</span>
                                <input name="price" type="text"
                                    class="form-control @error('price') is-invalid @enderror"
                                    aria-label="Amount (to the nearest dollar)" value="{{ old('price', $menu->price) }}">
                                <span class="input-group-text">.00</span>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="formFile" class="form-label @error('image') is-invalid @enderror">Foto</label>
                                <input name="image" class="form-control" type="file" id="formFile">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="fileName" class="form-text"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>
                </form> --}}
        </div>
    </div>
    {{-- @endforeach --}}



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
