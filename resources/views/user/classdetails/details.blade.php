@extends('user.masterPage')
@section('content')
<div class="container">
    {{-- upper side --}}
    <div class="row">
        <div class="col-md-5 mx-1 my-2">
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
            <table class="table" style="width: 50%px">
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
    
    
    {{-- <ul class="nav nav-tabs mx-1">
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
    </div> --}}
    <div class="container ml-1">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#notes" style="color: #428bca">Notes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#notice" style="color: #428bca">Notice</a>
          </li>
        </ul>

        <!--Notes Tab panes -->
        <div class="tab-content mt-1 ml-0">
          <div class="tab-pane container active" id="notes">
            <table class="table table-responsive" id="tabTable">
                <thead>
                  <tr>
                    <th style="width: 5%;"></th>
                    <th style="width: 45%;">Title</th>
                    <th style="width: 30%;">Upload Date</th>
                    <th style="width: 20%;">Size</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($fileInfo as $file)
                  <tr>
                    <td><ion-icon name="documents"></ion-icon></td>
                    <td></ion-icon><a class="text-decoration-none" href="{{ route('student.document.download', basename($file['path'])) }} " style="color: #428bca">{{ basename($file['path']) }} </a></td>
                    <td>{{ $file['upload_date']->format('d-M-Y H:i:s') }}</td>
                    <td>{{ $file['size'] }}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
          </div>
          <div class="tab-pane container fade" id="notice">
            <style>
                
                
            </style>
            <table class="table table-responsive" id="tabTable">
                <thead>
                  <tr>
                    <th style="width: 75%;">Subject</th>
                    <th style="width: 25%;">Post Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($facultyNotices as $facultyNotice)
                  <tr>
                    <td id="noticeTd"><a id="noticeGet" class="text-decoration-none" data-id="{{ $facultyNotice->id }}" style="color: #428bca">{{ $facultyNotice->subject }}</a></td>
                    <td>{{ $facultyNotice->created_at->format('d-M-Y H:i:s') }}</td>
                  </tr>
                  @endforeach
                </tbody>
            </table>
          </div>
        </div>
    </div>
</div>

{{-- Modal for show notice details--}}
<div class="col-md-10 align-center modal" id="noticeShow" role="dialog">
    <div class="col-12 col-lg-12 mt-1 mb-2">
        @include('administrator.includes.alert')
    </div>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Notice</h4>
          <button class="close btn btn-priamry btn-sm" id="buttonCloseNotice">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h6><strong>Subject</strong></h6>
            <p id="subject"></p>
            <h5><strong>Details</strong></h5>
            <p id="details"></p>
        </div>
      </div>
    </div>
  </div>
  
  {{-- end --}}

<script type="text/javascript">
    $(document).ready(function() {
      //for notice modal
      $('#noticeShow').modal({
          show: false
      });

      $('#noticeGet').click(function(e) {
        e.preventDefault();
        $('#noticeShow').modal('show');
        var id = $('#noticeGet').attr('data-id');
        $.ajax({
            url: '/student/notices',
                type: 'GET',
                data: { id: id },
                success: function(response) {
                    response.forEach(function(notice) {
                        $("#subject").append(notice.subject)
                        $("#details").append(notice.details)
                    })
                },
        });
        
      });

      $('#buttonCloseNotice').click(function() {
        $('#noticeShow').modal('hide');
      });
    });
</script>

@endsection
