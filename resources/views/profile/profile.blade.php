@extends('index')
@section('content')

<div class="row">
    <div class="col">
        <h4 class=" mb-0 text-info font-weight-bold mb-2">Profil</h4>
    </div>
    <div class="container mb-4">
        <div class="row">
            <div class="col-lg-4 ">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/image/' . auth()->user()->image) }}" alt="avatar" class="rounded-circle img-fluid" style="width: 193px; height: 193px;">
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-dark mb-0">{{ auth()->user()->name }}</p>
                            </div>
                        </div>
                        <hr>
                        
                        {{-- Tampilkan NISN atau NIP berdasarkan role pengguna --}}
                        @if(auth()->user()->role == 'student')
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">NISN</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-dark mb-0">{{ auth()->user()->nisn }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Date of Birth</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-dark mb-0">{{ auth()->user()->birth }}</p>
                            </div>
                        </div>
                        <hr>

                        @elseif(auth()->user()->role == 'teacher')
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">NIP</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-dark mb-0">{{ auth()->user()->nip }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Date of Birth</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-dark mb-0">{{ auth()->user()->birth }}</p>
                            </div>
                        </div>
                        <hr>
                        @endif

                        
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-dark mb-0">{{ auth()->user()->address }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Email</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-dark mb-0">{{ auth()->user()->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
