@extends('faculty.masterPage')
@section('content')

<div class="row justify-content-center" >
    <div class="col-12" id="registration">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @forelse ($getCourseList as $courseList)
                        <div class="col-12 col-lg-4 mt-2">
                            <div class="card h-100">
                                <div class="card-body">
                                    <p>{{ $courseList->courses->course_name }} - [{{ $courseList->section->name }}] </p>

                                </div>
                                <div class="card-footer" style="background-color: #42a5f5;">
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('faculty.class.view',$courseList->id) }}" class="text-decoration-none text-white">Go to class</a><ion-icon name="arrow-forward-outline" style="font-size: 25px;color: white;"></ion-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <p>No registered courses found.</p>
                        </div>
                    @endforelse


                </div>
            </div>
        </div>
    </div>
</div>
    
      
@endsection