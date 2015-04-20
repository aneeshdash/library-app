@extends('admin.master')
@section('head')
<?php
$cnt = DB::table('students_visiting')->count();
$book = DB::table('lost_book')->first();


?>
    @endsection
@section('content')
<section class="content">
<div class="row">

		<div class="col-lg-8">
	

        <div class="box box-info" >
        	<form  role ="form" id ="update">
                <div class="box-header">
                  <i class="fa fa-envelope"></i>
                  <h3 class="box-title">Post Updates</h3>
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                    <button class="btn btn-info btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div> <!-- /. tools -->

                  <br />
                </div>
                <div class="box-body">
                 
                    <div class="form-group">
                      <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"/>
                    </div>

                    <div>
                      <textarea class="textarea" placeholder="Message" name="message" id="message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                    </div>
                  
                </div>
                <div class="box-footer clearfix">
                  <button type="submit" class="pull-right btn btn-default" >Post <i class="fa fa-arrow-circle-right"></i></button>
                
                </div>
              </form>
              </div>
      </div>
				
        <div class="col-lg-4" style="float:right">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         <h4 class="box-title"><i class="fa fa-rss-square"></i>  Notifications Panel</h4>
                      
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body" >

                            <div class="list-group" style="height:20%;overflow:auto">
                            	<div class="list-group-item" style="background-color:#fcf8e3;color:#8a6d3b;border-color:#faebcc">
                                    <i class="fa fa-comment fa-group"></i>&nbsp&nbspVISITING:<strong> {{$cnt}}</strong> persons are going to visit the lab tommorrow             
                                </div>


                        	@foreach(DB::table('lost_book')->where("status",'REQUESTED')->get() as $book)
                            	<div class="list-group-item" style="background-color:#f2dede;color:#a94442;border-color:#ebccd1">
                                    <i class="fa fa-bell fa-fw"></i> REQUESTED: Lost Book Replacement <strong>{{ $book->title }} </strong> was requested by <strong>{{  DB::table('users')->where("id",$book->user_id)->pluck('name');}} </strong>          
                                </div>
                            @endforeach 


                            @foreach(DB::table('feedback')->get() as $feed)
                               <div class="list-group-item" style="background-color:#d9edf7;color:#31708f;border-color:#bce8f1">
                                    <i class="fa fa-pencil-square-o"></i>&nbsp&nbsp FEEDBACK: {{$feed->feedback}}               
                                </div>
                            @endforeach    
                           
                            @foreach(DB::table('transactions')->where('transaction_type',"REISSUE")->get() as $feed)
                               <div class="list-group-item" style="background-color:#dff0d8;color:#3c763d;border-color:#d6e9c6">
                                   <i class="fa fa-book"></i>&nbsp&nbsp {{ $feed->transaction_type }}: {{ DB::table('books')->where('id',$feed->book_id)->pluck('title') }} was reissued by {{DB::table('users')->where('id',$feed->user_id)->pluck('name')}}                  
                                </div>
                            @endforeach

                            @foreach(DB::table('transactions')->where('transaction_type',"MBT")->get() as $feed)
                               <div class="list-group-item" style="background-color:#dff0d8;color:#3c763d;border-color:#d6e9c6">
                                   <i class="fa fa-book"></i>&nbsp&nbsp {{ $feed->transaction_type }}: {{ DB::table('books')->where('id',$feed->book_id)->pluck('title') }} was mutually transferred  by {{DB::table('users')->where('id',$feed->user_id)->pluck('name')}}                  
                                </div>
                            @endforeach

                            </div>
                            <!-- /.list-group -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
	</div>
</section>
    @endsection

@section('script')
<script>
$('#update').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('func_updates') }}',
                method: 'POST',
                data: $('#update').serialize()
            })
                    .success(function (result) {
                        alert(result);
                        
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        });
</script>
    @endsection