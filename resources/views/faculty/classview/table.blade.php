@extends('faculty.masterPage')
@section('content')
<div class="page-body">
    <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-6">
                <h5>{{ ucfirst($pageTitle) }}</h5>
            </div>
            <div class="col-6 gap-1 d-flex justify-content-end">
                <button id="modalShowNotice" class="btn btn-primary btn-sm" style="display: flex; align-items: center;"><ion-icon name="megaphone" style="font-size: 1.2rem; margin-right: 1px;"></ion-icon>Give notice</button>
                <button id="modalShow" class="btn btn-primary btn-sm" style="display: flex; align-items: center;"><ion-icon name="cloud-upload" style="font-size: 1.2rem; margin-right: 1px;"></ion-icon>Upload notes</button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="dt-responsive table-responsive">
            <table id="table" class="table table-striped table-bordered nowrap">
                <thead class="{{ isset($tableStyleClass) ? $tableStyleClass : 'bg-primary'}}">
                    <tr>
                        @foreach($tableColumns as $column)
                            <th> @lang('table.'.$column)</th>
                        @endforeach                                
                    </tr>
                </thead>
            </table>
          </div>
                
        </div>
    </div>
</div>  

{{-- Modal for file upload --}}
<div class="col-md-10 align-center modal" id="fileUpload" role="dialog">
    <div class="col-12 col-lg-12 mt-1 mb-2">
        @include('administrator.includes.alert')
    </div>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Upload file</h4>
          <button class="close btn btn-danger btn-sm" id="buttonClose">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ $uploadNotes }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <input type="file" class="form-control" name="files[]" multiple>
                </div>
                <div class="d-flex justify-content-end">
                  <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
      </div>
    </div>
 </div>

{{-- end --}}

{{-- Modal for give notice --}}
<div class="col-md-10 align-center modal" id="noticeUpload" role="dialog">
  <div class="col-12 col-lg-12 mt-1 mb-2">
      @include('administrator.includes.alert')
  </div>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Upload Notices</h4>
        <button class="close btn btn-danger btn-sm" id="buttonCloseNotice">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form method="POST" action="{{ $uploadNotices }}" enctype="multipart/form-data">
              @csrf
              <div class="mb-3">
                <label><strong>Subject</strong></label>
                <input type="text" class="form-control" name="subject">
              </div>
              <div class="mb-3">
                <label><strong>Details</strong></label>
                <textarea class="form-control" name="details"></textarea>
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>

{{-- end --}}
                                                  
<script type="text/javascript">
    let table;
    $(function() {
        table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: '{{ isset($dataTableUrl) && !empty($dataTableUrl) ? $dataTableUrl : URL::current() }}',
            columns: [
                @foreach($dataTableColumns as $column)
                    { data: '{{ $column }}', name: '{{ $column }}' },
                @endforeach                
            ],
            "lengthMenu": [[10, 20, 50, 100, 500, 1000, -1], [10, 20, 50, 100, 500, 1000, "All"]],
            "language": {
                "lengthMenu": "_MENU_"
            }
        });
    });

</script>
<script type="text/javascript">
    $(document).ready(function() {
    //for file modal
      $('#fileUpload').modal({
        show: false
      });

      $('#modalShow').click(function(e) {
        e.preventDefault();
        $('#fileUpload').modal('show');
      });

      $('#buttonClose').click(function() {
        $('#fileUpload').modal('hide');
      });

      //for notice modal
      $('#noticeUpload').modal({
          show: false
      });

      $('#modalShowNotice').click(function(e) {
        e.preventDefault();
        $('#noticeUpload').modal('show');
      });

      $('#buttonCloseNotice').click(function() {
        $('#noticeUpload').modal('hide');
      });
});
</script>
@endsection

