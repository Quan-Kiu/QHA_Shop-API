@extends('layout.master2')
@section('content')
<div class="page-content d-flex align-items-center justify-content-center">

  <div class="row w-100 mx-0 auth-page">
    <div class="col-md-8 col-xl-6 mx-auto">
      <div class="card">
        <div class="row">
          <div class="col-md-4 pr-md-0">
            <div class="auth-left-wrapper" style="background-image: url({{ url('https://res.cloudinary.com/dprqzgmak/image/upload/c_lpad,h_452,w_219/v1644593113/logo_w20yia.png') }})">

            </div>
          </div>
          <div class="col-md-8 pl-md-0">
            <div class="auth-form-wrapper px-4 py-5">
              <a href="#" class="noble-ui-logo d-block mb-2">QHA<span>Shop  <img src="https://res.cloudinary.com/dprqzgmak/image/upload/c_scale,w_20/v1644594761/logo_zv67se.png"></span></a>
              <h5 class="text-muted font-weight-normal mb-4">Create a free account.</h5>
              <form class="forms-sample" method="POST" action="/register">
                @csrf
                <div class="form-group">
                  <label for="exampleInputUsername1">Username</label>
                  <input id="fullname" name="fullname" class="form-control" id="exampleInputUsername1" autocomplete="Username" placeholder="Username">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Email address</label>
                  <input id="email" name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input id="password" name="password" type="password" class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" id="exampleInputPassword1" autocomplete="current-password" placeholder="Password">
                </div>
                <div class="form-check form-check-flat form-check-primary">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    Remember me
                  </label>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-primary mr-2 mb-2 mb-md-0">Sing up</button>
                  
                </div>
                <a href="{{ url('/auth/login') }}" class="d-block mt-3 text-muted">Already a user? Sign in</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection