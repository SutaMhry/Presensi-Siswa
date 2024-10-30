@extends('index')
@section('content')
    <!-- Page Heading -->
    <div class="row d-flex align-items-center justify-content-between mb-1 mt-4 ">
        <div class="col">
            <h4 class=" mb-0 text-info font-weight-bold mb-2">Pesan</h4>
        </div>
        <a href="{{ route('send-message') }}"> 
            <button class="btn btn-primary "><i class="fas fa-paper-plane"></i>Kirim</button>
        </a>
    </div>

    <hr class="divider">

    <div class="row">

        <div class="col-xl-6 col-md-12 mb-4">
            <a href="{{ route('lesson-schedule') }}">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <img src="img/undraw_profile.svg" alt="avatar" class="rounded-circle img-fluid" style="width: 50px;">
                            
                            <div class="col ml-3">
                                <div class="h5 mb-0 font-weight-bold text-dark">Petit</div>
                                <div class="font-weight-bold text-primary mt-2">
                                    Dari: Lorem</div>
                                <div class="font-weight-bold text-dark mt-2">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. ...</div>
                            </div>
                            <div class="col-auto">
                                <div class="font-weight-bold text-dark mt-2">
                                    13/08/2024</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-6 col-md-12 mb-4">
            <a href="{{ route('lesson-schedule') }}">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <img src="img/undraw_profile.svg" alt="avatar" class="rounded-circle img-fluid" style="width: 50px;">
                            
                            <div class="col ml-3">
                                <div class="h5 mb-0 font-weight-bold text-dark">Maharaya</div>
                                <div class="font-weight-bold text-primary  mt-2">
                                    Dari: Ipsum</div>
                                <div class="font-weight-bold text-dark mt-2">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. ...</div>
                            </div>
                            <div class="col-auto">
                                <div class="font-weight-bold text-dark mt-2">
                                    13/08/2024</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-6 col-md-12 mb-4">
            <a href="{{ route('lesson-schedule') }}">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                        <img src="img/undraw_profile.svg" alt="avatar" class="rounded-circle img-fluid" style="width: 50px;">
                            
                            <div class="col ml-3">
                                <div class="h5 mb-0 font-weight-bold text-dark">Suta</div>
                                <div class="font-weight-bold text-primary  mt-2">
                                    Dari: Dolor</div>
                                <div class="font-weight-bold text-dark mt-2">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. ...</div>
                            </div>
                            <div class="col-auto">
                                <div class="font-weight-bold text-dark mt-2">
                                    13/08/2024</div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
@endsection
