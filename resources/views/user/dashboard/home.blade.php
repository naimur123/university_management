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
  
   
   
        <div class="col-12" id="registration">
            <div class="card">
                <div class="card-header text-white" style="background-color: #004ea2;">Registration
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($getRegisteredCourses as $registeredCourses)
                        <div class="col-12 col-lg-4 mt-2">
                            <div class="card h-100">
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