@extends('user.masterPage')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-12 mt-2 mb-2">
           @include('user.includes.alert')
    </div>
    @if ($takenCourses->isNotEmpty())
    <div class="col-12 col-lg-12 d-flex justify-content-center">
        <button class="btn btn-danger btn-sm" id="modalShow">Registered Course List</button>
    </div>
    <hr>
    @endif
    {{-- Modal Popup --}}
     <div class="col-md-10 modal" id="regCoursesModal" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button class="close btn btn-danger btn-sm" id="buttonClose">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table" class="table table-striped table-bordered nowrap">
                        <thead class="bg-primary">
                            <tr>
                                <th>Course name</th>
                                <th>Course credit</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" id="modalClose" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>
    {{-- end --}}

    <div class="col-12 col-lg-12 mt-2 mb-2">
        <div class="card border-0">
            <div class="card-body">
                @forelse ($registrationTime as $regTime)
                    @if($today >= $regTime->start_date && $today <= $regTime->end_date && ($today != $regTime->start_date || $now >= $regTime->start_time))
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
                        <div class="alert alert-danger">
                            <h1>Your registration doesnot started yet</h1>
                            <a class="btn btn-secondary" href="{{ route('student.home') }}">Back</a>
                        </div> 
                    @endif
                @empty                        
                @endforelse
                  
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#modalShow").click(function(event){
            event.preventDefault()
            $('#regCoursesModal').modal('show');
            $.ajax({
                url: '{{ $registeredCourseUrl }}',
                type: 'GET',
                success: function(response) {
                    if(response){
                       var jsonData = JSON.parse(response);
                       console.log(jsonData);
                        var tableBody = $('#table tbody');
                        tableBody.empty(); 
                        jsonData.forEach(function(item) {
                            console.log(item.course_time.courses.credit)
                            var row = '<tr>' +
                                '<td>' + item.course_time.courses.course_name + '</td>' +
                                '<td>' + item.course_time.courses.credit + '</td>' +
                                '</tr>';
                            tableBody.append(row);
                        });
                    }
                    
                }
            })
            
        });
        $("#modalClose").click(function(){
            $('#regCoursesModal').modal('hide');
        })
        $("#buttonClose").click(function(){
            $('#regCoursesModal').modal('hide');
        })
    });
</script>
@endsection