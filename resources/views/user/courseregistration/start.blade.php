@extends('user.masterPage')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-12 mt-2 mb-2">
           @include('administrator.includes.alert')
    </div>
    <div class="col-12 col-lg-12 mt-2 mb-2">
        <div class="card">
            <div class="card-body">
                <h1>{{ Auth::user()->program ?? "NULL" }}</h1>
                @foreach ($registrationTime as $regTime)
                    @if($regTime->from == $id || $regTime->to == $id)
                        <h1>Your Registration Page</h1>
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