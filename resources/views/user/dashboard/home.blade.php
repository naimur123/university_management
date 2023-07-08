@extends('user.masterPage')
@section('content')

<div class="row justify-content-center" >
    @foreach ($checkDate as $check)
        {{-- <p>{{ $check->start_date.' '.$today.' '.$check->end_date  }}</p> --}}
        @if ($check->start_date <= $today && $check->end_date >= $today)
            <div class="col-12 col-lg-12 mt-2 mb-2" id="regStart">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-danger" href="{{ route('student.course.registration') }}" role="button">Go to Registration</a>
                        </div>
                    </div>
                </div>
            </div>
            
        @endif
    @endforeach
  
    {{-- class schedule --}}
    <div class="col-12" id="class_schedule">
        <div class="card">
            <div class="card-header text-white">Class schedule</div>
            <div class="card-body">
                 <div class="row">
                     <div class="col-12 col-lg-12">
                        @foreach ($datesDays as $date => $name)
                        @php
                            $courses = $getRegisteredCourses->filter(function ($courseTime) use ($name) {
                                return in_array($name, $courseTime->course_time->day);
                            })->map(function ($courseTime) use ($date, $name) {
                                $courseName = $courseTime->course_time->courses->course_name;
                                $courseStartTime = $courseTime->course_time->start_time;
                                $courseEndTime = $courseTime->course_time->end_time;
                                $params = (object)[
                                    "courseName" => $courseName,
                                    "courseStartTime" => $courseStartTime,
                                    "courseEndTime" => $courseEndTime
                                ];
                                return  $params;
                            });
                        @endphp
        
                        @if ($courses->count() > 0)
                            @if (\Carbon\Carbon::today()->isSameDay($date))
                            <p><strong>Today</strong></p>
                            @else
                            <p><strong>{{ date('d-M-Y', strtotime($date))}}</strong></p>
                            @endif
                            @foreach ($courses as $course)      
                             <p>{{ $course->courseName }}[{{ date('h:i A', strtotime($course->courseStartTime)) }} - {{ date('h:i A', strtotime($course->courseEndTime)) }}]</p>
                            @endforeach
                            <hr>
                        @else
                            @if (\Carbon\Carbon::today()->isSameDay($date))
                                <p><strong>Today</strong></p>
                                <p>No classes today</p>
                                <hr>
                            @else
                                <p><strong>{{ date('d-M-Y', strtotime($date))}}</strong></p>
                                <p>No classes on this day</p>
                                <hr>
                            @endif
                        @endif
                        @endforeach
                     </div>
                 </div>
            </div>
        </div>
    </div>
    
    
    
    
    
        
    {{-- Registered course list --}}
    <div class="col-12" id="registration">
        <div class="card">
            <div class="card-header text-white" style="background-color: #004ea2;">Registration
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse ($getRegisteredCourses as $registeredCourses)
                    <div class="col-12 col-lg-4 mt-2">
                        <div class="card h-100" style="border-color: rgba(2,186,242,.2);">
                            <div class="card-body">
                                <p>{{ $registeredCourses->course_time->courses->code }}-{{ $registeredCourses->course_time->courses->course_name }} [{{ $registeredCourses->course_time->section->name }}]</p>
                                <p><b>Result:</b></p>
                            </div>
                            <div class="card-footer" style="background-color: #42a5f5;">
                                <div class="d-flex justify-content-center">
                                    <ion-icon name="document-text" style="font-size: 20px;color:azure"></ion-icon> <a href="{{ route('student.class.tab',["name"=>"notes","schedule_id" =>$registeredCourses->course_time_schedule_id]) }}" class="text-decoration-none text-white">Notes</a>&nbsp; &nbsp;
                                    <ion-icon name="megaphone" style="font-size: 20px;color:azure"></ion-icon><a href="{{ route('student.class.tab',["name"=>"notice","schedule_id" =>$registeredCourses->course_time_schedule_id]) }}" class="text-decoration-none text-white">Notices</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <p>No registered courses found.</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
        
    
    </div>
    
      
@endsection