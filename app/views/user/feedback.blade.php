@extends('user.master')
@section('title')
    Library | Feedback
@endsection

@section('main_content')

	<h3><i class="fa fa-angle-right"></i> Feedback</h3>
	<br>
	<p>Your feedback will help improve our services</p>

	<form action="{{ route('feedback') }}" method="post">
		<div class="form-group">
			<textarea class="form-control" rows="7" id="feedbackText" placeholder="Your feedback here" name="text"></textarea>
		</div>
		<button id="formbtn" type="submit"  class="btn btn-default">Submit</button>
		<button type="reset" class="btn btn-default">Reset</button>
	</form>



@endsection

@section('user-feedback')
    active
@endsection

@section('scripts')

@endsection