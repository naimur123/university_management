@extends('administrator.masterPage')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-12 mt-2 mb-2">
           @include('administrator.includes.alert')
    </div>
    <div class="col-12 col-lg-12 mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <form action="{{ $form_url }}" class="row form-horizontal" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12 mt-10">
                        <h3>CSE {{ $title ?? "" }}</h3>
                       
                        <hr/>
                    </div>
                    <input type="hidden" name="id" value="{{ $data->id ?? 0 }}">
                    
                    <!--Set Courses -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Course<span class="text-danger">*</span></label>
                            <select class="form-control" name="course_id" required > 
                            @foreach($courses as $course)
                              <option value="{{ $course->id }}"  {{ old('course_id') && old('course_id') == $course->id ? 'selected' : (isset($data->course_id) && $data->course_id == $course->id ? "selected" : Null) }}> {{ $course->course_name }} </option>
                            @endforeach     
                            </select>
                        </div>
                    </div>
                    <!--Set Faculty -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Choose Faculty<span class="text-danger">*</span></label>
                            <select class="form-control" name="faculty_id" required >
                                @foreach($faculties as $faculty)
                                    <option value="{{ $faculty->id }}"  {{ old('faculty_id') && old('faculty_id') == $faculty->id ? 'selected' : (isset($data->faculty_id) && $data->faculty_id == $faculty->id ? "selected" : Null) }}> {{ $faculty->fist_name .''. $faculty->last_name}} </option>     
                                @endforeach                           
                            </select>
                        </div>
                    </div>
                    
                    <!-- Course days -->
                    <div class="col-6 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Days<span class="text-danger">*</span></label>                                
                            {{-- <select id="example-multiple-selected" class="form-control multi-select" multiple name="day[]"> --}}
                                @foreach($days as $day)
                                    {{-- <option value="{{ $day }}" {{ old('day') && is_array( old('day') ) && in_array($day, old('day')) ? 'selected' : ( isset($data->day) && is_array($data->day) && in_array($day, $data->day) ? "selected" : Null ) }} >{{ $day }}</option> --}}
                                    <label>
                                        <input type="checkbox" class="advisor_type" name="day[]" value="{{ $day }}" {{ isset($data->day) && in_array($day, $data->day) ? 'checked' : Null }} >
                                        {{ $day }}
                                    </label>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Start time  -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Start Time<span class="text-danger">*</span></label>                                
                            <input type="time" name="start_time" class="form-control"  value="{{ isset($data->start_time) ? Carbon\Carbon::parse($data->start_time)->format('h:i') : now()->format('H:i') }}"  required >
                        </div>                        
                    </div>   

                    {{-- <!-- End time  -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>End Time<span class="text-danger">*</span></label>                                
                            <input type="time" name="end_time" class="form-control"  value="{{ isset($data->start_time) ? Carbon\Carbon::parse($data->start_time)->format('h:i') : now()->format('H:i') }}"  required >
                        </div>                        
                    </div>    --}}
                     <!--Set Section -->
                     <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Choose Section<span class="text-danger">*</span></label>
                            <select class="form-control" name="section_id" required >
                                @foreach($sections as $section)
                                    <option value="{{ $section->id }}"  {{ old('section_id') && old('section_id') == $section->id ? 'selected' : (isset($data->section_id) && $data->section_id == $section->id ? "selected" : Null) }}> {{ $section->name}} </option>     
                                @endforeach                           
                            </select>
                        </div>
                    </div>

                    <!--Session-->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Session</label>
                            <input class="form-control " value="{{ $session ?? $data->session }}" name="session" readonly>
                        </div>
                    </div>
                          
                   
                    <!--submit -->
                    <div class="col-12 text-right py-2">
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-info">Submit </button>
                        </div>
                    </div>
                </form>
                
   
</div>
<script type="text/javascript">
    $('#example-multiple-selected').multiselect({
        templates: {
        button: '<button type="button" class="multiselect dropdown-toggle btn btn-secondary" data-bs-toggle="dropdown" aria-expanded="false"><span class="multiselect-selected-text"></span></button>',
      },
     
      buttonWidth: "100%",
    });
    
    

</script>

@endsection