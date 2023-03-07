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
                        <h3>{{ $title ?? "" }}</h3>
                       
                        <hr/>
                    </div>
                    <input type="hidden" name="id" value="{{ $data->id ?? 0 }}">
                    
                    <!-- Batch From -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Batch From</label>
                            <input type="text" class="form-control " value="{{ old("from") ?? ($data->from ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="from" required >
                            @error('from')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <!-- Batch To -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Batch To</label>
                            <input type="text" class="form-control " value="{{ old("to") ?? ($data->to ?? "")}} {{--  {{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" id="first_name" value="{{ old("first_name") ?? ($data->first_name ?? "")}}--}}" name="to" required >
                            @error('to')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <!-- Start date  -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Start date<span class="text-danger">*</span></label>                                
                            <input type="date" name="start_date" class="form-control"  value="{{ isset($data->start_time) }}"  required >
                        </div>                        
                    </div>   
                    <!-- Start time  -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label>Start Time<span class="text-danger">*</span></label>                                
                            <input type="time" name="start_time" class="form-control"  value="{{ isset($data->start_time) ? Carbon\Carbon::parse($data->start_time)->format('h:i') : now()->format('H:i') }}"  required >
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
        </div>
    </div>
</div>


@endsection