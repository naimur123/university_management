@extends('user.masterPage')
@section('content')
<div class="row">
    <div class="row">
        <div class="col-md-4 mx-2 my-2">
            @foreach ($datas as $data)
               <h5>{{ $data->course_name }} [{{ $data->section_name }}]</h5>
               <div class="card" style="border-radius: 0;">
                    <div class="card-body d-flex align-items-center">
                        <img src="https://img.freepik.com/premium-vector/business-man-cartoon-character-smart-clothes-office-style_51635-5680.jpg?w=360" alt="" height="100px" width="100px" style="margin-right: 10px;">
                        <div>
                            <p class="mb-1"><strong>{{ $data->faculty_name }}</strong></p>
                            <p class="mb-1"><strong>{{ $data->faculty_email }}</strong></p>
                            <p class="mb-1"><strong>{{ $data->faculty_rank }}</strong></p>
                        </div>
                    </div>
               </div>
            @endforeach
        </div>
        <div class="col-md-6 my-2">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Time</th>
                    <th scope="col">Class type</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                    <tr>
                        @php
                            $days = json_decode($data->day);
                            $dayShortNames = [
                                'Saturday' => 'Sat',
                                'Sunday' => 'Sun',
                                'Monday' => 'Mon',
                                'Tuesday' => 'Tue',
                                'Wednesday' => 'Wed',
                                'Thursday' => 'Thu',
                                'Friday' => 'Fri'
                            ];
                        @endphp
                        @foreach($days as $day)
                            <tr>
                                  <td>{{ $dayShortNames[$day] }} {{ date('h:i A', strtotime($data->start_time)) }} - {{ $dayShortNames[$day] }} {{ date('h:i A', strtotime($data->end_time)) }}</td>
                                @if ($data->course_credit == 3)
                                   <td>Theory</td>
                                @else
                                   <td>Lab</td>
                                @endif
                                
                            </tr>
                        @endforeach                     
                        
                      </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
    
    
    <ul class="nav nav-tabs mx-1">
        <li class="nav-item">
            <a class="{{ $class }}" href="#notes">Notes</a>
        </li>
        <li class="nav-item">
            <a data-toggle="tab" class="{{ isset($class) ? 'nav-link' : $noticeClass }}" href="#notice">Notice</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="notes" class="tab-pane fade{{ $class ? ' show active' : '' }}">
            <style>
                .table tbody tr:last-child td {
                    border-bottom: none;
                }
            </style>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Upload Date</th>
                    <th scope="col">Size</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($fileInfo as $file)
                  <tr>
                    <td></ion-icon><a class="text-decoration-none" href="{{ route('student.document.download', basename($file['path'])) }}">{{ basename($file['path']) }} </a></td>
                    <td>{{ $file['upload_date'] }}</td>
                    <td>{{ $file['size'] }}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
        </div>

        <div id="notice" class="tab-pane fade {{ isset($noticeClass) ? ' show active' : '' }}">
            <h3>Menu 2</h3>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem
                aperiam.</p>
        </div>
    </div>
</div>

@endsection
