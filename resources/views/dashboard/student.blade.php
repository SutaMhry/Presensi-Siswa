@extends('index')
@section('content')
    <!-- Page Heading -->
    <h6 id="greeting" class="text-dark font-weight-bold">.-.-.-</h6>
    <h2 class="text-dark font-weight-bold mb-4">{{ auth()->user()->name }}</h2>

    <hr class="divider">

    <!-- Page Heading Pintasan -->
    <div class="row d-sm-flex align-items-center justify-content-between mb-1 mt-4">
        <div class="col">
            <h4 class=" mb-0 text-info font-weight-bold mb-2">Pintasan</h4>
        </div>
    </div>

    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <a href="{{ route('presencestudent') }}">
                <div class="card bg-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h4 mb-0 font-weight-bold text-gray-800">Presensi Kehadiran</div>
                                <div class="text-xs font-weight-bold text-gray-800 text-uppercase mt-2">
                                    Senin, 04 Oktober 2024</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <a href="{{ route('profile') }}">
                <div class="card bg-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h4 mb-0 font-weight-bold text-gray-800">Profile</div>
                                <div class="text-xs font-weight-bold text-gray-800 text-uppercase mt-2">
                                    {{ auth()->user()->name }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
@endsection
