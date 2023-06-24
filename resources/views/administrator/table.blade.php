@extends('administrator.masterPage')
@section('content')
<div class="page-body">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="{{ isset($create) && isset($report) ? 'col-8' : 'col-10' }}">
                  <h5>{{ ucfirst($pageTitle) }}</h5>
                </div>
                @if( isset($create) && isset($report) )
                <div class="col-4 d-flex justify-content-end">
                    <a class="ajax-click-page btn btn-primary btn-sm d-inline ms-1" href="{{ url($create) }}">Create new</a>
                    <a class="ajax-click-page btn btn-secondary btn-sm d-inline ms-1" href="{{ url($report) }}">Download</a>
                </div>
                @endif

                @if( isset($create) && !isset($report) )
                <div class="col-2 d-flex justify-content-end">
                    <a class="ajax-click-page btn btn-primary btn-sm" href="{{ url($create) }}">Create new</a>
                </div>
                @endif
              </div>
              
            
        </div>
      <div class="card-body">
            <div class="dt-plugin-buttons"></div>
                <div class="dt-responsive table-responsive">
                    <table id="table" class="table table-striped table-bordered nowrap">
                        <thead class="{{ isset($tableStyleClass) ? $tableStyleClass : 'bg-primary'}}">
                            <tr>
                                @foreach($tableColumns as $column)
                                    <th> @lang('table.'.$column)</th>
                                @endforeach                                
                            </tr>
                        </thead>

                        <tbody>
                            <tr class="loading-row">
                                <td colspan="{{ count($tableColumns) }}" class="text-center">
                                    <div class="spinner-grow text-primary" role="status">
                                    
                                    </div>
                                    <div class="spinner-grow text-secondary" role="status">
                                      
                                    </div>
                                    <div class="spinner-grow text-success" role="status">
                                      
                                    </div>
                                    <div class="spinner-grow text-danger" role="status">
                                      
                                    </div>
                                    <div class="spinner-grow text-warning" role="status">
                                      
                                    </div>
                                    <div class="spinner-grow text-info" role="status">
                                      
                                    </div>
                                    <div class="spinner-grow text-light" role="status">
                                      
                                    </div>
                                    <div class="spinner-grow text-dark" role="status">
                                      
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>  

{{-- <div class="loading-row">
    <img id="loading-image" src="{{ asset('load/loading.gif') }}" alt="Loading..." />
</div> --}}
                                                  
<script type="text/javascript">
    let table;
    $(document).ready(function() {
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
            "lengthMenu": [[100, 500, 1000, -1], [100, 500, 1000, "All"]],
            "language": {
                "lengthMenu": "_MENU_"
            },
            initComplete: function() {
                $('.loading-row').hide();
            },
            drawCallback: function() {
                if (table.ajax().data().length === 0) {
                    $('.loading-row').show();
                } else {
                    $('.loading-row').hide();
                }
            }
        });
    });
    // setInterval(function () {
    //       $('#table').DataTable().ajax.reload();
    // }, 60000);


</script>
@endsection

