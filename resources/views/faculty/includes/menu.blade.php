<body>
    <div class="container-fluid" id="app"> 
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="topbar">
            <div class="container">
                <a class="navbar-brand" href="{{ route('faculty.home') }}">
                    XYZ University 
                </a>
                <div class="navbar navbar-expand-md" id="sidebarNavbar">
                    <button class="navbar-toggler ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarCollapse" aria-controls="sidebarCollapse" aria-expanded="false" aria-label="Toggle Sidebar">
                    <ion-icon name="reorder-four-outline"></ion-icon>
                    </button>
                </div>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('faculty')->user()->first_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('faculty.logout') }}">
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
                        Academics</button>
                            <div class="collapse multi-collapse" id="multiCollapseExample">
                                {{-- <a class="collapse-item text-decoration-none" href="{{ route('admin.assign_faculty') }}"><span class="material-icons">
                                    account_circle
                                    </span>Assign Faculty</a>
                                <a class="collapse-item text-decoration-none" href="{{ route('admin.faculty.list') }}"><span class="material-icons">
                                    format_list_bulleted
                                    </span>Faculty List</a> --}}
                            </div>

                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">
                            Grade Reports</button>
                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                {{-- <a class="collapse-item text-decoration-none" href="{{ route('admin.course.list', ['name' => 'cse']) }}"><span class="material-icons">
                                    format_list_bulleted
                                    </span>Course List</a>
                                    <a class="collapse-item text-decoration-none" href="{{ route('admin.assign_student', ['name' => 'cse']) }}"><span class="material-icons">
                                        account_circle
                                        </span>Assign Student</a>
                                    <a class="collapse-item text-decoration-none" href="{{ route('admin.student.list', ['name' => 'cse']) }}"><span class="material-icons">
                                        format_list_bulleted
                                        </span>Student List</a>
                                    <a class="collapse-item text-decoration-none" href="{{ route('admin.course_schedule', ['name' => 'cse']) }}"><span class="material-icons">
                                        calendar_month
                                        </span>Course Schedule</a> --}}
                            </div>
                        
                            
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3" aria-expanded="false" aria-controls="multiCollapseExample3">
                                Library</button>
                            <div class="collapse multi-collapse" id="multiCollapseExample3">
                                {{-- <a class="collapse-item text-decoration-none" href="{{ route('admin.student.reg.time') }}"><span class="material-icons">
                                    hourglass_empty
                                    </span>Create</a> --}}
                            </div>
                        <button class="btn" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample4" aria-expanded="false" aria-controls="multiCollapseExample2">
                                Others</button>
                            <div class="collapse multi-collapse" id="multiCollapseExample4">
                                <a class="collapse-item text-decoration-none" href="#">Action</a>
                                <a class="collapse-item text-decoration-none" href="#">Another action</a>
                            </div> 
                </div> 
            </div>

            <div class="col-10">
                <div class="contents"