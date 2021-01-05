<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logo_rpms.png') }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap/dist/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login_style.css') }}">
</head>
<body>
	<div class="card" style="width: 25rem;">
    <div class="card-header text-center">
      <img src="{{ asset('assets/img/logo_rpms.png') }}" class="card-img-top w-25" alt="...">
    </div>
    <div class="card-body">
      <h5 class="card-title text-center">Login</h5>
        <form method="post" action="{{ url('/loginAction') }}">
        @csrf
          <div class="row">
            <div class="col">
            	@if(session('message'))
            		<div class="alert alert-danger" role="alert">
            		  {{ session('message') }}
            		</div>
            	@endif
              <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" name="email" placeholder="Enter Email Address" value="{{ old('email') }}">
                @error('email')
                <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>   

          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter Password" name="password" value="{{ old('password') }}">
                @error('password')
                <div id="validationServer03Feedback" class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>            

          <div class="row text-center mt-3">
            <div class="col-md-12">
              <button type="submit" class="btn btn-primary w-100">Login</button>
            </div>
          </div>
        </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/fontawesome/js/fontawesome.min.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>