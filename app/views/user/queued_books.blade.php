@extends('user.master')
@section('title')
    Library | Home
@endsection

@section('link')
        <link rel="stylesheet" href="{{asset('user-assets/css/to-do.css')}}">

@endsection

@section('main_content')
    <div class="row mt">
        <div class="col-md-8 col-md-offset-2">
            <section class="task-panel tasks-widget">
                <div class="panel-heading">
                    <div class="text-center"><strong style="font-size:20px;">Admin Notifications</strong></div>
                    <br>
                </div>
                <div class="panel-body">
                    <div class="task-content">
                        <ul class="task-list">
	                        
<?php
	$results = DB::table('admin_notifications')->orderBy('created_at', 'desc')->take(5)->get();
	foreach ($results as $item) {
?>
		<li>
            <div class="task-title">
	    <span>
	    	{{ $item->created_at }}:
	    	<br>
	        <strong style="font-size:16px">{{ $item->subject }}:</strong>
	        {{ $item->message }}
	   	</span>
		   	</div>
        </li>

<?php
	}
?>	                               	
                                
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="row mt">
        <div class="col-md-8 col-md-offset-2">
            <section class="task-panel tasks-widget">
                <div class="panel-heading">
                    <div class="text-center"><strong style="font-size:20px;">Book Notifications</strong></div>
                    <br>
                </div>
                <div class="panel-body">
                    <div class="task-content">
                        <ul class="task-list">
<?php
	$now = time();
	$days = 5; ///u can change days here
	$string = "+".$days." days";
	$tocompare = date('Y-m-d H:i:s', strtotime($string,$now));
	$results = DB::table('books')->where('issue',Auth::user()->get()->id)->where('return_date','<',$tocompare)->orderBy('return_date', 'desc')->get();
	foreach ($results as $item) {
	$toshow = Book::find($item->id);
?>
        <li>
            <div class="task-title">
                <span>
			    	{{ $toshow->title}}
			    	<br>
			        <strong style="font-size:16px">Due date:{{ $item->return_date }}</strong>
			   	</span>
            </div>
        </li>
<?php
	}
?>               
                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="row mt">
        <div class="col-md-8 col-md-offset-2">
            <section class="task-panel tasks-widget">
                <div class="panel-heading">
                    <div class="text-center"><strong style="font-size:20px;">Mutual Transfer Notifications</strong></div>
                    <br>
                </div>
                <div class="panel-body">
                    <div class="task-content">
                        <ul class="task-list">
	                        

	                    
	                        <li>
	                            <div class="task-title">
	                                <span>
	                                    <strong style="font-size:15px">hey hi</strong>
	                               	</span>
                                </div>
                            </li>
                        


                        </ul>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('user-queued_books')
    active
@endsection



@section('scripts')

@endsection