@extends('admin.master')
@section('head')

@endsection
@section('content')
 
   <section class="content">
    
        <section class="wrapper site-min-height" style="background-color:#fff">
                <div class="row">
       <div class="col-lg-10 main-chart">

             <div class="row mt">
                 <div class="col-md-12 mb col-md-offset-1">
            <!-- WHITE PANEL - TOP USER -->
                        
                        <div class="white-panel pn"  style="color:Black;">
                        
                        <br />
                        <p><img src="{{ asset('user-assets/img/icon.jpg') }}" class="img-circle" width="80"><button class="btn btn-primary  btn-danger pull-right" style="height:50%" data-toggle="modal" data-target="#mymodal">Change Password</button></p>
                         
                        
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1" style="color:Black;">
                            <p>ADMINNAME:</p>
                            <p><b>{{Auth::admin()->get()->username}}</b></p>
                            </div>
                            <div class="col-md-2" style="color:Black;">
                                 <p class="small mt">email:</p>

                                <p>{{Auth::admin()->get()->email}}</p>
                            </div>
                            <div class="col-md-3 " style="color:Black;">
                                <p>Joined on:</p>
                                <p>{{Auth::admin()->get()->created_at}}</p>
                            </div>
                             <div class="col-md-3" style="color:Black;">
                                <p>last Updated password on:</p>
                                <p>{{Auth::admin()->get()->updated_at}}</p>
                            </div>
                        </div>
                        </div>
                </div>
            </div>


   
        </div><!--row-->
        </section><!--/wrapper-->
    </section><!-- /MAIN CONTENT -->

<div class="modal fade" id="mymodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal" role="form" id="password">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Change Admin Details</h4>
                </div>
                <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">Old Password:</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="old" id="old"  required>
                            </div>
                        </div>
                       <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">New Password:</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="new" id="new" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">Confirm Password:</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="confirm" id="confirm" required>
                            </div>
                        </div>
                    
                    
                   <input type="hidden" id="admin_id" name="id" value="{{Auth::admin()->get()->id}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
         </form>
        </div>
    </div>
    
@endsection
@section('script')
<script>
    $('#password').on('submit', function(e) {
            $('#mymodal').modal('hide');
            e.preventDefault();
            var pass1 = $('#new').val();
            var pass2 = $('#confirm').val();
            if( pass1 != pass2){
                alert( "passwords don't match");
            } 
            else{
                $.ajax({
                url: '{{ route('func_changepassword') }}',
                method: 'POST',
                data: $('#password').serialize() 
            })
                    .success(function (result) {
                        alert(result);
                       
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
            }
            
           
        });
</script>

    @endsection