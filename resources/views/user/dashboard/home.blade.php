@extends('user.masterPage')
@section('content')
   
      
   <div class="row justify-content-center">
        <div class="col-12 col-lg-12 mt-2 mb-2">
               @include('administrator.includes.alert')
        </div>
        <div class="col-12 col-lg-12 mt-2 mb-2">
            <div class="card">
                @if(!empty($registrationTime))
                    <div class="card-body">
                        @if(\Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($registrationTime)) <= 7)
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary" href="{{ route('student.course.registration') }}" role="button">Go to Registration</a>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="card-body">

                    </div>
                
                @endif
            </div>
        </div>
    </div>
      
@endsection