@extends('layouts.auth')
@section('title','Masuk')
@section('content')
<section class="row flexbox-container" style="background-image: {{ asset('hd-wallpaper-3605547.jpg') }};">
    <div class="col-xl-8 col-11 d-flex justify-content-center">
        <div class="card bg-authentication rounded-0 mb-0">
            <div class="row m-0">
                {{-- <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                    <img src="{{asset('backend/images/logo/logo-login.png')}}" alt="branding logo">
                </div> --}}
                <div class="col-lg-12 col-12 p-0">
                    <div class="card rounded-0 mb-0 px-2" style="background-color: rgb(255,200,1);">
                        <div class="card-header pb-1">
                            @if( count($errors) )
                            <div class="col-xs-12 col-md-12 col-lg-12 p-0">
                                <div class="alert alert-danger">
                                    {{ $errors->all()[0] }}
                                </div>
                            </div>
                            @endif
                            <div class="card-title" style="width:100%;">
                                <h4 class="mb-0">
                                    <center>LGI</center>
                                </h4>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="card-body pt-1">
                                <form action="{{ route('login') }}" method="POST">
                                    {{ csrf_field() }}
                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                        <input type="text" name="NIK" class="form-control" id="NIK" placeholder="NIK" value="{{ old('NIK') }}" required>
                                        <div class="form-control-position">
                                            <i class="feather icon-user"></i>
                                        </div>
                                        <label for="NIK">NIK</label>
                                    </fieldset>

                                    <fieldset class="form-label-group position-relative has-icon-left">
                                        <input type="password" name="password" class="form-control" id="user-password" placeholder="Password" required>
                                        <div class="form-control-position">
                                            <i class="feather icon-lock"></i>
                                        </div>
                                        <label for="user-password">Password</label>
                                    </fieldset>
                                    <button type="submit" class="btn float-right btn-inline btn-block" style="background-color: rgb(46,49,146); color: white;">
                                        Masuk
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="login-footer">
                            <div class="divider">
                                <div class="divider-text" style="background-color: rgb(255,200,1);">
                                    <a href="#" style="color: black;">
                                        Corsec Application
                                    </a>
                                </div>
                            </div>
                            {{-- <p style="font-size:10px">Jika ingin mendaftar silahkan hubungi nomor ini : 0822-4888-5062</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection