@extends('layouts.home')

@section('title') {{'Videos'}} @endsection

@section('content')

   <div class="container-fluid tm-container-content tm-mt-60" id="data-columns">
        
    </div> 
<!-- container-fluid, tm-container-content -->


<script type="text/javascript">
  $(function () {


      /*------------------------------------------
     --------------------------------------------
     Pass Header Token
     --------------------------------------------
     --------------------------------------------*/ 
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
    

      /*------------------------------------------
    --------------------------------------------
    Render Columns
    --------------------------------------------
    --------------------------------------------*/
    function showdata(){
                    $.ajax({
                        data: "{ _token: {{csrf_token()}}",
                        url: "{{ url('allvideos') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            $('#data-columns').html(data.data);
                        },
                        error: function (data) {
                            //console.log('Error:', data);
                            //$('#data-columns').html('No videos to display');
                        }
                    });     
}
var columnsdata = showdata();

  });
</script>
@endsection
