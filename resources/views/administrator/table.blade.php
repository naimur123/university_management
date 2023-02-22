@extends('administrator.home')
@section('content')
<div class="page-body">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="{{ isset($create) ? 'col-10' : 'col-12' }}" >
                    <h5>{{ ucfirst( str_replace(['_','-'], ' ', $pageTitle) ) }}</h5>
                </div>
                @if( isset($create) && $create )
                    <div class="col-2 text-right">
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
                    </table>
                </div>
        </div>
    </div>
</div>  
  
                                                  
<script type="text/javascript">
    let table;
    $(function() {
        table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ isset($dataTableUrl) && !empty($dataTableUrl) ? $dataTableUrl : URL::current() }}',
            columns: [
                @foreach($dataTableColumns as $column)
                    { data: '{{ $column }}', name: '{{ $column }}' },
                @endforeach                
            ],
            "lengthMenu": [[25, 50, 100, 500,1000, -1], [25, 50, 100, 500,1000, "All"]],
        });
    });
</script>
@endsection

