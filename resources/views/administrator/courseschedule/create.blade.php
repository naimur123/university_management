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
                            <label>Course List<span class="text-danger">*</span></label>
                            <select class="form-control" id="course_id" name="course_id" required > 
                            <option value="">Choose Course</option>
                            @foreach($courses as $course)
                              <option value="{{ $course->id }}"  {{ old('course_id') && old('course_id') == $course->id ? 'selected' : (isset($data->course_id) && $data->course_id == $course->id ? "selected" : Null) }}> {{ $course->course_name }} </option>
                            @endforeach     
                            </select>
                        </div>
                    </div>
                    <!--Set Faculty -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Available Faculty<span class="text-danger">*</span></label>
                            <select class="form-control" id="faculty_id" name="faculty_id" required >
                                {{-- @foreach($faculties as $faculty) --}}
                                    {{-- <option value="{{ $faculty->id }}"  {{ old('faculty_id') && old('faculty_id') == $faculty->id ? 'selected' : (isset($data->faculty_id) && $data->faculty_id == $faculty->id ? "selected" : Null) }}> {{ $faculty->first_name .''. $faculty->last_name}} </option>      --}}
                                    <option value=""  >Choose Faculty</option>     
                                {{-- @endforeach                            --}}
                            </select>
                        </div>
                    </div>
                    
                    <!-- Course days -->
                    <div class="col-6 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Days<span class="text-danger">*</span></label><br>                                
                                @foreach($days as $day)
                                    <label>
                                        <input type="checkbox" name="day[]" value="{{ $day }}" {{ isset($data->day) && in_array($day, $data->day) ? 'checked' : Null }} >
                                        {{ $day }}
                                    </label>
                                @endforeach
                                <br>
                                @error('day')
                                 <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                        </div>
                    </div>

                    <!-- Start time  -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Start Time<span class="text-danger">*</span></label>                                
                            <input type="time" name="start_time" class="form-control"  value="{{ isset($data->start_time) ? Carbon\Carbon::parse($data->start_time)->format('h:i') : now()->format('H:i') }}"  required >
                        </div>                        
                    </div>   

                     <!--Set Section -->
                     <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Available Section<span class="text-danger">*</span></label>
                            <select class="form-control" id="section_id" name="section_id" required >
                                {{-- @foreach($sections as $section) --}}
                                    {{-- <option value="{{ $section->id }}"  {{ old('section_id') && old('section_id') == $section->id ? 'selected' : (isset($data->section_id) && $data->section_id == $section->id ? "selected" : Null) }}> {{ $section->name}} </option>      --}}
                                    <option value=""> Choose Section </option>     
                                {{-- @endforeach                            --}}
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
    $(document).ready(function() {
        $('#course_id').on('change', function () {
            var courseId = this.value;
            var dpt_id = {!! json_encode($dpt_id) !!};
            // console.log('{{ $dataUrl }} ?course_id='+ courseId)
            // console.log('{{ $dataUrl }} ?dpt_id='+ dpt_id + 'course_id='+ courseId)
            $('#faculty_id').html('');
            $('#section_id').html('');
            $.ajax({
                url: '{{ $dataUrl }} ?dpt_id='+ dpt_id + '&course_id='+ courseId,
                type: 'GET',
                success: function(response) {
                    if(response){
                        $.each(response.faculties, function (key, value) {
                            $('#faculty_id').append('<option value="' + value
                                .id + '">' + value.first_name + ' ' + value.last_name + '</option>');
                        });
                        $.each(response.sections, function (key, value) {
                            $('#section_id').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                    
                }
            });
           
        });
    });
</script>


@endsection