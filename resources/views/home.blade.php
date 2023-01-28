@extends('layouts.app')

@section('content')
{{-- <div class="loading-skeleton" style="display: none;">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
          </div>
        </div>
      </div>
    </div>
  </div> --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script>
    // JavaScript code to toggle the visibility of the loading skeleton
$(document).ready(function() {
  $('.loading-skeleton').show(); // Show the loading skeleton when the page is loading
  
  // Make an AJAX request to load the data
  $.ajax({
    url: '/home',
    type: 'GET',
    success: function(response) {
      $('.loading-skeleton').hide(); // Hide the loading skeleton when the data is loaded
      $('.main-content').html(response); // Insert the data into the main content div
    }
  });
});

</script> --}}
@endsection
