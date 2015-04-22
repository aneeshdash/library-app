@extends('user.master')
@section('title')
    Library | Basic
@endsection

@section('link')
    <style>
        .drop-shadow {
            -webkit-box-shadow: 0 0 4px 2px rgba(0, 0, 0, .5);
            box-shadow: 0 0 4px 2px rgba(0, 0, 0, .5);
        }
        .panel.drop-shadow {
            padding-left:0;
            padding-right:0;
        }
        .modal .modal-body {
            max-height: 420px;
            overflow-y: auto;
        }

    </style>
@endsection

@section('main_content')

<!-- Basic Search Form -->
<div class="container" style="margin-top:5px;" >
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel drop-shadow">
                <div class="panel-heading"><div class="text-center" style="font-size:20px;"><strong>BASIC SEARCH</strong></div>
                    <div class="panel-body">
                        <form class="form-inline row" action="{{ route('validate_bsearch') }}" method="post">
                            <div class="form-group col-sm-10 col-sm-offset-1">
                                <label for="name"><strong>Keyword(s)</strong></label>
                                <input type="text" class="form-control" style="width:400px;" name="keyword">
                                <button type="submit" class="btn btn-info" style="margin-left:15px;">Search</button>
                            </div>
                        

                            <div class="form-group col-sm-4 col-sm-offset-1" style="margin-top:15px;">
                                <label for="select1">Connect as</label>
                                <select class="form-control" style="margin-left:3px;" name="connectors">
                                    <option value="or">OR</option>
                                    <option value="and">AND</option>
                                    <option value="exact">PHRASE</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4 " style="margin-top:15px;">
                                <label for="select2">In</label>
                                <select class="form-control" style="margin-left:3px;" name="basedon">
                                    <option value="title">Title</option>
                                    <option value="authors">Author</option>
                                    <!-- <option value="number">Number</option> -->
                                    <option value="any">Any field</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-sm-4 col-sm-offset-1 " style="margin-top:15px;">
                                <label for="select3" style="margin-left:23px;">Sort by</label>
                                <select class="form-control" style="margin-left:3px;" name="sortby">
                                    <option value="title">Title</option>
                                    <option value="authors">Author</option>
                                    <option value="number">Number</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-4 " style="margin-top:15px;">
                                <label for="select2" style="margin-left:-20px;">Order</label>
                                <select class="form-control" style="margin-left:3px;" name="order">
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                            </div>

                        </form>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Search Form -->


<!-- Book Card -->
<div class="row mt">

    <?php
    $wishes = DB::table('wishlist')->where('user_id', Auth::user()->get()->id)->get();
    $array = array();
    foreach($wishes as $wish){
        $array[] = $wish->book_name;
    }
    ?>

    <?php foreach($uniqueresults as $entry) {
        $countofcopies = 0;
        $countofavailable = 0;
        foreach ($results as $item) {
            if ($item->title == $entry->title && $item->authors == $entry->authors)
                $countofcopies++;
            if ($item->issue != 'h' && $item->title == $entry->title && $item->authors == $entry->authors)
                $countofavailable++;
        }
    ?>

        <!-- each card -->
        <div class="col-lg-3 col-md-3 col-sm-3 mb">
            <div class="content-panel pn">

                <div style="min-height:106px; margin-left:10px">

                    <h3><i class="fa fa-angle-right"> </i> {{ $entry->title}}</h3>
                    <h6>{{ $entry->authors}}</h6>
                </div>
                <div class="panel panel-default">
                    <div class="centered">
                        <h5><i class="fa fa-book"></i><br/><a data-toggle="modal" data-target="#myModal{{ $entry->id }}" href="#">Book Details</a></h5>
                    </div>
                    <div class="profile-01 centered">
                        <?php
                        if (in_array($entry->title,$array)) {
                        ?>
                        <p><i id="icon{{$entry->id}}" class="fa fa-check" onclick="wish({{ $entry->id }})"> ADDED TO WISHLIST</i></p>
                        <?php
                        }
                        else{
                        ?>
                        <p><i id="icon{{$entry->id}}" class="fa fa-heart" onclick="wish({{ $entry->id }})"> ADD TO WISHLIST</i></p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- end of each card -->

        <!-- Modal -->
        <div class="modal fade" id="myModal{{ $entry->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <a class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></a>
                        <h4 class="modal-title" id="myModalLabel">Details</h4>
                    </div>

                    <div class="modal-body">


                        <a class="btn btn-primary btn-sm pull-right" href="todo_list.html#">Google preview</a>
                        <table class="table table-hover">
                            <h4><i class="fa fa-angle-right"></i> Basic details</h4>
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>{{ $entry->title }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Authors</td>
                                <td>{{ $entry->authors}}</td>
                            </tr>
                            <tr>
                                <td>Edition</td>
                                <td>{{ $entry->edition }}</td>
                            </tr>
                            <tr>
                                <td>Total copies</td>
                                <td>{{ $countofcopies }}</td>
                            </tr>
                            <tr>
                                <td>Available copies</td>
                                <td>{{ $countofavailable }}</td>
                                <script type="text/javascript" src="http://books.google.com/books/previewlib.js"></script>
                                <script type="text/javascript">
                                    GBS_insertPreviewButtonPopup('ISBN:0738531367');
                                </script>

                            </tr>
                            @foreach ($results as $item)
                                @if ( $item->title == $entry->title && $item->authors == $entry->authors && $item->available == 1)
                                    <tr>
                                        <td>{{ $item->user->name }}</td>
                                        <td><button type="button" id="{{ $item->id }}" value="{{ $item->id }}">Ask</button></td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <div class=" add-task-row">
                            <a class="btn btn-primary btn-sm pull-left" href="todo_list.html#">Queue</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
<!-- End Of Modal -->
    
</div>
<!-- End Of Book Cards -->

@endsection


@section('user-bsearch')
    active
@endsection
@section('user-search')
    active
@endsection

@section('scripts')
    <script>
        function wish(id)
        {
            if($("#icon"+id).hasClass("fa-heart")) {
                var select_data = {
                    'book_id': id
                };

                $.ajax({
                    url: "{{ route('add_wish') }}",
                    method: 'POST',
                    data: select_data,
                    dataType: 'json',
                    encode: 'true'
                })

                        .success(function () {
                            alert("success");
                            $("#icon" + id).removeClass("fa fa-heart");
                            $("#icon" + id).addClass("fa fa-check");
                            $("#icon" + id).text("ADDED TO WISHLIST")
                        })
                        .fail(function () {
                            alert("Already added to WishList");
                        })
            }
            else{
                alert("hell o!");
            }
        }
    </script>

    <script>
        $(function() {
            function reposition() {
                var modal = $(this),
                        dialog = modal.find('.modal-dialog');
                modal.css('display', 'block');

                // Dividing by two centers the modal exactly, but dividing by three
                // or four works better for larger screens.
                dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
            }
            // Reposition when a modal is shown
            $('.modal').on('show.bs.modal', reposition);
            // Reposition when the window is resized
            $(window).on('resize', function() {
                $('.modal:visible').each(reposition);
            });
        });
    </script>



    <script>
         $('button').click(function(event) {
             if(this.type != "submit") {
                event.preventDefault();
                var tobesent = parseInt(this.value);
                $.ajax({
                    url: "{{ route('bookstransfer') }}",
                    method: 'POST',
                    dataType    : 'json',
                    encode      : true,
                    data: {id: tobesent}
                })
                 .success(function (data) {
                    alert("key: " + data.pin);
                })
                .fail(function () {
                    alert('There was an error. Please Try Again');
                });
             };
        });
    </script>

@endsection
