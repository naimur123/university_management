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
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample" aria-expanded="false" aria-controls="multiCollapseExample">
                        FACULTY</button>
                            <div class="collapse multi-collapse" id="multiCollapseExample">
                                <a class="collapse-item text-decoration-none" href="{{ route('admin.assign_faculty') }}"><span class="material-icons">
                                    account_circle
                                    </span>Assign Faculty</a>
                                <a class="collapse-item text-decoration-none" href="{{ route('admin.faculty.list') }}"><span class="material-icons">
                                    format_list_bulleted
                                    </span>Faculty List</a>
                            </div>

                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">
                            Department Of Computer Science</button>
                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                <a class="collapse-item text-decoration-none" href="{{ route('admin.course.list', ['name' => 'cse']) }}"><span class="material-icons">
                                    format_list_bulleted
                                    </span>Course List</a>
                                    <a class="collapse-item text-decoration-none" href="{{ route('admin.assign_student', ['name' => 'cse']) }}"><span class="material-icons">
                                        account_circle
                                        </span>Assign Student</a>
                                    <a class="collapse-item text-decoration-none" href="{{ route('admin.student.list', ['name' => 'cse']) }}"><span class="material-icons">
                                        format_list_bulleted
                                        </span>Student List</a>
                            </div>
                        
                            
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3" aria-expanded="false" aria-controls="multiCollapseExample3">
                                FACULTY3</button>
                            <div class="collapse multi-collapse" id="multiCollapseExample3">
                                <a class="collapse-item text-decoration-none" href="#">Action</a>
                                <a class="collapse-item text-decoration-none" href="#">Another action</a>
                            </div>
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample4" aria-expanded="false" aria-controls="multiCollapseExample2">
                                FACULTY2</button>
                            <div class="collapse multi-collapse" id="multiCollapseExample4">
                                <a class="collapse-item text-decoration-none" href="#">Action</a>
                                <a class="collapse-item text-decoration-none" href="#">Another action</a>
                            </div> 
                </div> 
            </div>

            <div class="col-10">
                <div class="contents"