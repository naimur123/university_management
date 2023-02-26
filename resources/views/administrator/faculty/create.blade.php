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
                        <h3>Faculty {{ $title ?? "" }}</h3>
                        <input type="hidden" name="id" value="{{ $data->id ?? 0 }}">
                        <hr/>
                    </div>

                    
                    <!-- Faculty First Name -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control " value="{{ old("first_name") ?? ($data->first_name ?? "")}} " name="first_name">
                            @error('first_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Faculty Last Name -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Last Name </label>
                            <input type="text" class="form-control " value="{{ old("last_name") ?? ($data->last_name ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="last_name" required >
                            @error('last_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Faculty Last Name -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control " value="{{ old("email") ?? ($data->email ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="email">
                            @error('email')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!--Rnak -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Rank</label>
                            <select class="form-control select2" name="rank">
                                <option value="Professor">Professor</option>
                                <option value="Assistant Professor">Assistant Professor</option>
                                <option value="Dr.">Dr.</option>
                                <option value="Faculty">Faculty</option>                           
                                <option value="Teaching Assistant">Teaching Assistant(T.A)</option>                           
                            </select>
                        </div>
                    </div>

                    <!-- Faculty DOB -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Date Of Birth</label>
                            <input type="date" class="form-control " value="{{ old("dob") ?? ($data->dob ?? "")}}" name="dob" required >
                            @error('dob')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Faculty Phone Number -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="tel" class="form-control " value="{{ old("mobile") ?? ($data->mobile ?? "")}}" name="mobile" required >
                            @error('mobile')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!--Sex -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Sex</label>
                            <select class="form-control select2" name="sex">
                                <option value="m">Male</option>
                                <option value="f">Female</option>
                                <option value="o">Others</option>                           
                            </select>
                        </div>
                    </div>

                    <!-- Nationality -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Nationality</label>
                            <input type="text" class="form-control " value="{{ old("nationality") ?? ($data->nationality ?? "")}}" name="nationality">
                            @error('nationality')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Religion -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Religion</label>
                            <input type="text" class="form-control " value="{{ old("religion") ?? ($data->religion ?? "")}}" name="religion">
                            @error('religion')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!--Marital Status -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Marital Status</label>
                            <select class="form-control select2" name="maritalstatus">
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                                <option value="divorced">Divorced</option>                           
                            </select>
                        </div>
                    </div>
                    <!--Set Status -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Department<span class="text-danger">*</span></label>
                            <select class="form-control select2" name="department_id" required >
                                <option value="">Select Department</option>
                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}"  {{ old('department_id') && old('department_id') == $department->id ? 'selected' : (isset($data->department) && $data->department == $department->id ? "selected" : Null) }}> {{ $department->name }} </option>     
                                @endforeach                           
                            </select>
                        </div>
                    </div>
                
                    <!-- Present Address -->
                    <div class="col-6">
                        <div class="form-group">
                            <label>Present Address</label>
                            <textarea class="form-control editor" name="presentaddress">{{ old("presentaddress") ?? ($data->presentaddress ?? "")  }}</textarea>
                            @error('presentaddress')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <!-- Permanent Address -->
                    <div class="col-6">
                        <div class="form-group">
                            <label>Permanent Address</label>
                            <textarea class="form-control editor" name="permanentaddress">{{ old("permanentaddress") ?? ($data->permanentaddress ?? "")  }} </textarea>
                            @error('permanentaddress')
                            <strong class="text-danger">{{ $message }}</strong>
                            @enderror
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

@endsection