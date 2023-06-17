<script>
    @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}")
    @endif
</script>
<script>
     @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
     @endif
</script>

<script>
    @if(Session::has('selectCourse'))
        toastr.error("{{ Session::get('selectCourse') }}")
    @endif
</script>