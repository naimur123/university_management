<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>XYZ Uni</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    {{--  --}}

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                       Admin Login
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.login') }}">
                            @csrf
                            @if ($errors->any())  
                                <div class="alert alert-danger">
                                    @foreach ($errors->getMessages() as $error)
                                        <strong>{!! nl2br(e( strip_tags($error[0]))) !!}</strong>
                                    @endforeach  
                                </div>
                            @endif
                           

                            <div class="form-group">
                                <label for="user_id_or_email">Enter User ID or Email</label>
                                <input type="text" name="user_id_or_email"  id="user_id_or_email" class="form-control @error('user_id_or_email') is-invalid @enderror">
                            </div>
                            <div class="form-group">
                                <label for="password">Enter Password</label>
                                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">

                                {{-- @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror --}}
                            </div>
                            <div class="d-flex justify-content-center mt-2">
                                <button type="submit" class="btn btn-primary btn-block ">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Toastr::message() !!}
    
</body>

{{-- @endsection --}}

