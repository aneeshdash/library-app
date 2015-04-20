@extends('admin.master')
@section('head')
		
    @endsection
@section('content')

	<section class="content">


    <h1 class="page-header">Requested</h1>
    <div class="row">
	@foreach(DB::table('lost_book')->where('status','REQUESTED')->get() as $book)
		
            <div class="col-md-4">
              <!-- small box -->
              	<div class="small-box bg-red" >
                	<div class="inner">
                  		<h4>{{ DB::table('books')->where('id',$book->book_id)->pluck('title') }}</h4>
                  		<h5>{{ DB::table('books')->where('id',$book->book_id)->pluck('authors') }}</h5>
                	</div>
                  
                	<a href="#" class="small-box-footer" data-toggle="modal" data-target="#myModal" onclick="lost({{$book->id}})" >More info <i class="fa fa-arrow-circle-right"></i></a>
                
              </div>
            </div>


@endforeach
</div>

 <h1 class="page-header">Accepted</h1>
 <div class="row">
@foreach(DB::table('lost_book')->where('status','ACCEPTED')->get() as $book)
    
            <div class="col-md-4">
              <!-- small box -->
                <div class="small-box bg-green" >
                  <div class="inner">
                      <h4>{{ DB::table('books')->where('id',$book->book_id)->pluck('title') }}</h4>
                      <h5>{{ DB::table('books')->where('id',$book->book_id)->pluck('authors') }}</h5>
                  </div>
                  
                  <a href="#" class="small-box-footer" data-toggle="modal" data-target="#myModal" onclick="lost({{$book->id}})" >More info <i class="fa fa-arrow-circle-right"></i></a>
                
              </div>
            </div>

@endforeach
</div> 

<h1 class="page-header">Updated</h1>
 <div class="row">
@foreach(DB::table('lost_book')->where('status','UPDATED')->get() as $book)
    
            <div class="col-md-4">
              <!-- small box -->
                <div class="small-box bg-yellow" >
                  <div class="inner">
                      <h4>{{ DB::table('books')->where('id',$book->book_id)->pluck('title') }}</h4>
                      <h5>{{ DB::table('books')->where('id',$book->book_id)->pluck('authors') }}</h5>
                  </div>
                  
                  <a href="#" class="small-box-footer" data-toggle="modal" data-target="#myModal" onclick="lost({{$book->id}})" >More info <i class="fa fa-arrow-circle-right"></i></a>
                
              </div>
            </div>

@endforeach
</div>

<h1 class="page-header">Rejected</h1>
 <div class="row">
@foreach(DB::table('lost_book')->where('status','REJECTED')->get() as $book)
    
            <div class="col-md-4">
              <!-- small box -->
                <div class="small-box bg-aqua" >
                  <div class="inner">
                      <h4>{{ DB::table('books')->where('id',$book->book_id)->pluck('title') }}</h4>
                      <h5>{{ DB::table('books')->where('id',$book->book_id)->pluck('authors') }}</h5>
                  </div>
                  
                  <a href="#" class="small-box-footer" data-toggle="modal" data-target="#myModal" onclick="lost({{$book->id}})" >More info <i class="fa fa-arrow-circle-right"></i></a>
                
              </div>
            </div>

@endforeach
</div>

     <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 800px;" >
    <form  role="form" id="lost_form">
    <div class="modal-content"  id="lost_book">
      
    </div>
  </form>
  </div>
</div>
    </section>
	@endsection

@section('script')
		 <script type="text/javascript">
    

        function lost(code) {
            $.ajax({
                url: '{{ route('func_lost_book') }}',
                method: 'POST',
                data: {code: code}
            })
                    .success(function (result) {
                        $('#lost_book').html(result);
                        $('#myModal').modal('show');
//                        alert(result);
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        }

      
      $('#lost_form').on('submit', function(e) {
            
            e.preventDefault();
      $.ajax({
                url: "{{ route('func_update_lostbook') }}",
                method: 'POST',
                data: $('#lost_form').serialize()
            })
                    .success(function () {
                        alert("Tables were successfully updated");
                        $('#myModal').modal('hide');
                        location.reload();

                       
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });

    });
</script>
      
    @endsection    