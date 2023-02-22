<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">


    <!-- Icons -->
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous"> --}}
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet"> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> --}}

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}

    <!-- jquery lib-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    {{-- toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.2/datatables.min.js"></script>


    <!-- Scripts -->
    @vite(['resources/sass/app.scss','resources/js/administrator/app.js','resources/css/administrator/app.css'])
</head>

<body>
    {{-- {!! Toastr::message() !!} --}}
    <div class="container-fluid" id="app"> 
        
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="topbar">
            
            <div class="container">
                <a class="navbar-brand">
                    XYZ University 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                           
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('admin')->user()->first_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </li>
                       
                    </ul>
                </div>
            </div>
        </nav>

        <div class="row flex-nowrap">
          <div class="col-2">
                <div class="sidebar">
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample" aria-expanded="false" aria-controls="multiCollapseExample">
                        FACULTY</button>
                            <div class="collapse multi-collapse" id="multiCollapseExample">
                                <a class="collapse-item text-decoration-none" href="{{ route('admin.assign_faculty') }}"><span class="material-icons">
                                    account_circle
                                    </span>Assign Faculty</a>
                                <a class="collapse-item text-decoration-none" href="{{ route('admin.faculty.list') }}"><span class="material-icons">
                                    format_list_bulleted
                                    </span>Faculty List</a>
                            </div>
                    
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">
                                FACULTY2</button>
                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                <a class="collapse-item text-decoration-none" href="#"><i class="fas fa-star"></i>Action</a>
                                <a class="collapse-item text-decoration-none" href="#">Another action</a>
                            </div>

                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3" aria-expanded="false" aria-controls="multiCollapseExample3">
                                FACULTY3</button>
                            <div class="collapse multi-collapse" id="multiCollapseExample3">
                                <a class="collapse-item text-decoration-none" href="#">Action</a>
                                <a class="collapse-item text-decoration-none" href="#">Another action</a>
                            </div>
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample4" aria-expanded="false" aria-controls="multiCollapseExample2">
                                FACULTY2</button>
                            <div class="collapse multi-collapse" id="multiCollapseExample4">
                                <a class="collapse-item text-decoration-none" href="#">Action</a>
                                <a class="collapse-item text-decoration-none" href="#">Another action</a>
                            </div> 
                </div> 
                    
            </div>
            <div class="col-10">
                <div class="contents">
                    @yield('content')
                </div>  
            </div>
        </div>

        
    </div>
        

        

    
    
    
    {{-- <script>
    
    </script> --}}
    
   
</body>
</html>
