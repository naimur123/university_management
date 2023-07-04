<body>
    <div class="container-fluid" id="app"> 
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id="topbar">
            <div class="container">
                <a class="navbar-brand" href="{{ route('student.home') }}">
                    XYZ University 
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                {{-- <div class="col-md-10">
                    <a class="d-flex justify-content-end align-items-center" href="#" style="position: relative; padding-right: 15px;">
                        <ion-icon name="notifications-outline" style="font-size: 20px;"></ion-icon>
                        <span class="badge bg-danger badge-sm" style="position: absolute; top: -5px; right: -1px; font-size: 10px;">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    </a>
                </div> --}}
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <!-- Notifications -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="position: relative; padding-right: 15px;">
                                <ion-icon name="notifications-outline" style="font-size: 20px;"></ion-icon>
                                <span class="badge bg-danger badge-sm" style="position: absolute; top: -5px; right: -1px; font-size: 10px;">
                                    {{ auth()->user()->unreadNotifications->count() }}
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" style="width: 300px;">
                                <div class="dropdown-body">
                                    @foreach (auth()->user()->unreadNotifications as $notification)
                                        <a href="#" class="text-info text-decoration-none">
                                            <div class="list-item mx-2"><span class="bullet" style="font-size: 20px">&#8226;</span>{{ $notification->data['data'] }}</div>
                                        </a>
                                    @endforeach
                        
                                    @foreach (auth()->user()->readNotifications as $notification)
                                        <a href="#" class="text-info text-decoration-none">
                                            <div class="list-item mx-2"><span class="bullet" style="font-size: 20px">&#8226;</span>{{ $notification->data['data'] }}</div>
                                        </a>
                                    @endforeach

                                    @if (auth()->user()->unreadNotifications)
                                    <div class="dropdown-footer d-flex justify-content-center">
                                        <a href="{{ route('student.noti.markRead') }}" class="btn btn-sm btn-secondary text-bold my-1">Mark All as Read</a>
                                    </div>
                                    @endif
                        
                                </div>
                            </div>
                        </li>
                        
                        <!--END-->


                        <!-- Authentication Links -->
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::guard('user')->user()->first_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('student.logout') }}">
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