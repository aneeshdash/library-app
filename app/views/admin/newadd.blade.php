@extends('admin.master')
@section('head')
    @endsection
@section('content')

<section class="content">
 	
    @foreach(DB::table('new_add_options')->get() as $book)
        <div class="col-md-4" id="{{ $book->id }}">
            <div class="box box-default collapsed-box box-solid">
                <div class="box-header with-border" >
                	<h3 class="box-title">{{$book->title}}</h3>

                    <div class="box-tools pull-right">

                    	<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                  		<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
              	<div class="box-body">
                    <div class="row">
                     <div class="col-md-6">
                        No of Votes:
                     </div>
                     <div class="col-md-4">
                        {{ $book->votes }}
                     </div>
                   </div>

                   <div class="row">
                     <div class="col-md-6">
                        Name of the Book:
                     </div>
                     <div class="col-md-4">
                        {{ $book->title }}
                     </div>
                   </div>

                   <div class="row">
                     <div class="col-md-6">
                         Author:
                     </div>
                     <div class="col-md-4">
                        {{ $book->author }}
                     </div>
                   </div>

                   <div class="row">
                     <div class="col-md-6">
                        Publication:
                     </div>
                     <div class="col-md-4">
                        {{ $book-> publication }}
                     </div>
                   </div>

                   <div class="row">
                     <div class="col-md-6">
                        Edition:
                     </div>
                     <div class="col-md-4">
                        {{ $book->edition }}
                     </div>
                   </div>
                  <br />
                  <div class="row">
                  <button type="button" class="btn btn-block btn-danger btn" data-toggle="modal" data-target="#myModal" style="width:30%;float:right;margin-right:4%" onclick="$('#id').val({{$book->id}})">Delete</button>
                  <!-- Button trigger modal -->
                  </div>

                          <!-- Modal -->
                      



                </div><!-- /.box-body -->
                 
            </div><!-- /.box -->
        </div><!-- /.col -->
        @endforeach

          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                         
                          <div class="modal-dialog modal-danger">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Confirm</h4>
                              </div>
                              <div class="modal-body">
                                <p> Do You Want to Permantely Delete the Book </p>
                                <input type="hidden" id="id" value="" >
                              </div>
                              <div class="modal-footer">
                                <button  type="button" class="btn btn-danger delete" >YES</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                              </div>
                            </div>
                          </div>
                        </div>
  
</section>    
	@endsection

@section('script')
<script>
      $('.delete').click(function() {
        id=$('#id').val();
      $.ajax({
                url: "{{ route('func_new_del') }}",
                method: 'POST',
                data: {id:$('#id').val()}
            })
                    .success(function () {
                        alert("Successfully deleted the rows from the table");
                        $('#myModal').modal('hide');
                        $('#'+id).remove();

                       
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });

    });
 </script>     





    @endsection  