@extends('user.master')
@section('title')
    Library | Wish_List
@endsection

@section('main_content')
    <?php
    $wishlist = DB::table('wishlist')->where('user_id', Auth::user()->get()->id)->get();
    ?>
    <?php foreach($wishlist as $wish) {
    $entry = DB::table('books')->where('id',$wish->book_id)->first();
    ?>

    <!-- each card -->
    <div class="col-lg-3 col-md-3 col-sm-3 mb">
        <div class="content-panel pn">

            <div style="min-height:106px;margin-left:10">
                <h3>{{ $entry->title}}</h3>
                <h6>{{ $entry->authors}}</h6>
            </div>
            <div class="panel panel-default">
                <div class="centered">
                    <h5><i class="fa fa-book"></i><br/><a data-toggle="modal" data-target="#myModal{{ $entry->id }}" href="#">Book Details</a></h5>
                </div>
                <div class="profile-01 centered">
                    <p><i id="icon{{$entry->id}}" class="fa fa-check" onclick="del_wish({{ $wish->id }})"> Remove from wishlist</i></p>
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
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
                            <td></td>
                        </tr>
                        <tr>
                            <td>Available copies</td>
                            <td></td>
                        </tr>

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
@endsection

@section('user-wish_list')
    active
@endsection


@section('scripts')
    <script src="{{asset('user-assets/js/bootbox.min.js')}}"></script>
    <script>
        function del_wish(id)
        {
            var select_data = {
                'val' : id
            };

            $.ajax({
                url: "{{ route('del_wish') }}",
                method: 'POST',
                data: select_data,
                dataType: 'json',
                encode: 'true'
            })

                    .success(function () {
                        bootbox.alert("Deleted Successfully", function() {
                            window.location.reload();
                        });
                    })
                    .fail(function () {
                        bootbox.alert("Unsuccessful try again", function() {
                        });
                    })
        }
    </script>

@endsection