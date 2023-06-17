
<div class="col-md-10 modal" id="regCoursesModal" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button class="close btn btn-danger btn-sm" id="buttonClose">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="modalClose" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<script>
     let table;
                $(function() {
                    table = $('#table').DataTable({
                        ajax: '{{ isset($registeredCourseUrl) && !empty($registeredCourseUrl) ? $registeredCourseUrl : URL::current() }}',
                        columns: [
                                @foreach($dataTableColumns as $column)
                                    { data: '{{ $column }}', name: '{{ $column }}' },
                                @endforeach                
                            ]  
                    });
                });

        $("#modalClose").click(function(){
            $('#regCoursesModal').modal('hide');
        })
        $("#buttonClose").click(function(){
            $('#regCoursesModal').modal('hide');
        })
</script>
