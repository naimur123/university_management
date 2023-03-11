@extends('user.masterPage')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-12 mt-2 mb-2">
           @include('administrator.includes.alert')
    </div>
    <div class="col-12 col-lg-12 mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                @foreach ($registrationTime as $regTime)
                    @if( intval(str_replace('-', '', $regTime->from)) <= $id || intval(str_replace('-', '', $regTime->to)) >= $id)
                    @foreach ($courses as $course)
                        <input class="form-check-input" type="hidden" value="" id="defaultCheck1" name="course_id[]" value="{{ $course->id}}">
                        <label class="form-check-label" for="defaultCheck1">
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
                                            <input type="checkbox" id="section" name="section[]" value="{{ $schedule->section->id }}" />
                                            <label for="section">{{ $schedule->section->name }}</label>
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
                    @endforeach
                    @else
                        <div class="alert alert-danger">
                            <h1>Your registration doesnot started yet</h1>
                            <a class="btn btn-secondary" href="{{ route('student.home') }}">Back</a>
                        </div> 
                    @endif
                @endforeach
                  
            </div>
        </div>
    </div>
</div>
@endsection