@extends('user.masterPage')
@section('content')
   
      
   <div class="row justify-content-center">
        <div class="col-12 col-lg-12 mt-2 mb-2">
               @include('administrator.includes.alert')
        </div>
        <div class="col-12 col-lg-12 mt-2 mb-2">
            <div class="card">
                    <div class="card-body">
                        @if($start_date <= $now && $end_date >= $now)
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-primary" href="{{ route('student.course.registration') }}" role="button">Go to Registration</a>
                            </div>
                        @endif
                    </div>
            </div>
        </div>
    </div>
      
@endsection