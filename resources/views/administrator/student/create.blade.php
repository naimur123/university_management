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
                            <h3>Student {{ $title ?? "" }}</h3>
                            <input type="hidden" name="id" value="{{ $data->id ?? 0 }}">
                            <hr/>
                        </div>
    
                        
                        <!-- Student First Name -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control " value="{{ old("first_name") ?? ($data->first_name ?? "")}} " name="first_name">
                                @error('first_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <!-- Student Middle Name -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Middle Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control " value="{{ old("middle_name") ?? ($data->middle_name ?? "")}} " name="middle_name">
                                @error('middle_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
    
                        <!-- Student Last Name -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Last Name </label>
                                <input type="text" class="form-control " value="{{ old("last_name") ?? ($data->last_name ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="last_name" required >
                                @error('last_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <!-- Student Father Name -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Father Name </label>
                                <input type="text" class="form-control " value="{{ old("father_name") ?? ($data->father_name ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="father_name" required >
                                @error('father_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <!-- Student Mother Name -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Mother Name </label>
                                <input type="text" class="form-control " value="{{ old("mother_name") ?? ($data->mother_name ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="mother_name" required >
                                @error('mother_name')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <!-- Student Email -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control " value="{{ old("email") ?? ($data->email ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="email" required >
                                @error('email')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <!-- Student DOB -->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Date Of Birth</label>
                                <input type="date" class="form-control " value="{{ old("dob") ?? ($data->dob ?? "")}}" name="dob" required >
                                @error('dob')
                                    <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
    
                        <!-- Student Phone Number -->
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

                        <!--Department-->
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label>Department<span class="text-danger">*</span></label>
                                <select class="form-control select2" name="department_id" required >
                                     <option value="{{ $department->first()->id }}" {{ old('department_id') && old('department_id') == $department->first()->id ? 'selected' : (isset($data->department) && $data->department == $department->first()->id ? "selected" : Null) }}> {{ $department->first()->name }} </option>                           
                                   </select>
                            </div>
                        </div>
                    
                        <!-- Present Address -->
                        <div class="col-4">
                            <div class="form-group">
                                <label>Present Address</label>
                                <textarea class="form-control editor" name="presentaddress">{{ old("presentaddress") ?? ($data->presentaddress ?? "")  }}</textarea>
                                @error('presentaddress')
                                <strong class="text-danger">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
    
                        <!-- Permanent Address -->
                        <div class="col-4">
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