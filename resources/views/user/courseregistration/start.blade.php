@extends('user.masterPage')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-12 mt-2 mb-2">
           @include('administrator.includes.alert')
    </div>
    <div class="col-12 col-lg-12 mt-2 mb-2">
        <div class="card border-0">
            <div class="card-body">
                @forelse ($registrationTime as $regTime)
                    {{-- @if( intval(str_replace('-', '', $regTime->from)) <= $id && intval(str_replace('-', '', $regTime->to)) >= $id) --}}
                    @if($today >= $regTime->start_date && $now >= $regTime->start_time || $today <= $regTime->end_date && $now <= $regTime->end_time)
                    <form action="{{ $form_url }}" class="row form-horizontal" method="POST" enctype="multipart/form-data">
                        @csrf
                        @foreach ($courses as $course)
                            {{-- <input class="form-check-input" type="hidden" id="defaultCheck1" name="course_id[]" value="{{ $course->id }}"> --}}
                            <label class="form-check-label">
                                <b>{{ $course->course_name }}</b>
                                @if ($course->credit == 3)
                                    [Theory]
                                @else
                                    [Lab]
                                @endif 
                            </label>
                            <div class="row">
                                @foreach ($course->courseTimeSchedule as $schedule)
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li>
                                            @php
                                                $isChecked = false;
                                            @endphp
                                            @foreach ($takenCourses as $takenCourse)
                                                @if ($takenCourse->course_time->id == $schedule->id)
                                                    @php
                                                        $isChecked = true;
                                                        break;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <input type="checkbox" id="schedule" name="course_schedule_id[]" value="{{ $schedule->id }}" {{ $isChecked ? 'checked' : '' }}/>
                                            <label for="schedule">{{ $schedule->section->name }}</label>
                                            <b class="d-print-inline-block"></b>
                                            @foreach ($schedule->day as $day)
                                                <span class="d-print-inline-block">
                                                    {{ $day }} {{ date('h:i A', strtotime($schedule->start_time)) }}-{{ date('h:i A', strtotime($schedule->end_time)) }}
                                                </span>
                                            @endforeach
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                            
                            
                            </div>
                            <hr>
                        @endforeach
                        
                        <!--submit -->
                        <div class="col-12 d-flex justify-content-center">
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-info btn-sm"><strong>Confirm</strong></button>
                            </div>
                        </div>
                    </form>
                    @else
                    <p>{{ $regTime->start_time.' '. $now.' '.$regTime->end_time.' '.$now }}</p>
                    @endif
                @empty
                
                <div class="alert alert-danger">
                    <h1>Your registration doesnot started yet</h1>
                    <a class="btn btn-secondary" href="{{ route('student.home') }}">Back</a>
                </div> 
                        
                @endforelse
                  
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
</script>
@endsection