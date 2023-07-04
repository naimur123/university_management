@extends('faculty.masterPage')
@section('content')
<div class="page-body">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="{{ isset($upload) ? 'col-8' : 'col-12' }}">
                  <h5>{{ ucfirst($pageTitle) }}</h5>
                </div>
                <div class="col-4 d-flex justify-content-end" >
                    <button id="modalShow" class="btn btn-primary btn-sm" style="display: flex; align-items: center;"><ion-icon name="cloud-upload-outline" style="font-size: 1.2rem; margin-right: 1px;"></ion-icon>Upload notes</button>
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

{{-- Modal --}}
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
            <form method="POST" action="{{ $upload }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <input type="file" class="form-control" name="files[]" multiple>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
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
});
</script>
@endsection

