@extends('user.masterPage')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-12 mt-2 mb-2">
           @include('administrator.includes.alert')
    </div>
    <div class="col-12 col-lg-12 mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                  @if($registrationTime->from >= $id || $registrationTime <= $id)
                      <h1>Your Registration Page</h1>
                  @else
                    <div class="alert alert-danger">
                        <h1>Your registration doesnot started yet</h1>
                        <a class="btn btn-secondary" href="{{ route('student.home') }}">Back</a>
                    </div> 
                  @endif
            </div>
        </div>
    </div>
</div>
@endsection