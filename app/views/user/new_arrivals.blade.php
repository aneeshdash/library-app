@extends('user.master')
@section('title')
    Library | New Arrivals
@endsection

@section('link')
<style>
#truncate{
	display:inline-block;
    width: 100%;
    white-space: nowrap;
    overflow:hidden;
    text-overflow: ellipsis;
}
</style>
@endsection

@section('main_content')
	<h3><i class="fa fa-angle-right"></i> New Arrivals</h3>

	@if (count($new_books)>0)	
	<div class='row'>
	@foreach ($new_books as $book)
		<!--Thumbnail start-->
		<span title="{{ $book->title }}">
		<div class="col-sm-3 col-md-4">
			<div class="content panel pn" style="height: 180px;">	
				<div class="panel-body">
					<span title="{{ $book->title }}"><h4 id="truncate">{{ $book->title }}</h4></span>
					<p>{{ $book->authors }}</p>
					<p>Added on {{ $book->created_at }}</p>
							
					<p><a href="#myModal" class="btn btn-primary" role="button" data-toggle="modal" onclick="newadd({{ $book->id }})">More Details</a></p>								
				</div>
			</div>
		</div></span>
	<!--Thumnail end-->
    @endforeach
    </div>
    @else
    	<p>No new arrivals in the past {{ $limit_days }} day(s)</p>
    @endif	
    
	<!--Modal start-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content" id="newadd">

	</div>

@endsection

@section('user-new_arrivals')
    active
@endsection

@section('scripts')
<script>
	$(document).ready(function(){
	    $('.thumbnail img').css({
	        'height': $('.thumbnail img').height()
	    });
	});

    function newadd(id) {
        $.ajax({
            url: '{{ route('func_newadd') }}',
            method: 'POST',
            data: { id: id }
        })
                .success(function (result) {
                    $('#newadd').html(result);
                })
                .fail(function () {
                    alert('There was an error. Please Try Again');
                });
    }
</script>
@endsection