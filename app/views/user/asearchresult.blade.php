

@extends('user.master')
@section('title')
    Library | Home
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
    </style>
@endsection

@section('main_content')
    <div class="container" style="margin-top:5px;" >
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                <div class="panel drop-shadow">
                    <div class="panel-heading"><div class="text-center" style="font-size:20px;"><strong>SEARCH CATALOG</strong></div>
                        <div class="panel-body">
                            <form class="form-inline" action="" method="post">
                            <div>
                              <div class="form-group col-sm-offset-1">
                                <label for="keyword1">Keyword</label>
                                <input type="text" class="form-control input-sm" name="keyword1">
                              </div>
                              <div class="form-group">
                                <label for="select1" style="margin-left:15px;">Connect as</label>
                                <select class="form-control input-sm" name="connectors1">
                                    <option value="or">OR</option>
                                    <option value="and">AND</option>
                                    <option value="exact">PHRASE</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="select2" style="margin-left:15px;">In</label>
                                <select class="form-control input-sm" name="basedon1">
                                    <option value="title">TITLE</option>
                                    <option value="authors">AUTHOR</option>
                                    <option value="number">NUMBER</option>
                                </select>
                              </div>
                              <div class="form-group" style="margin-top:10px;margin-left:55px;">
                                <label class="radio-inline">
                                  <input type="radio" checked name="radio2" id="inlineRadio1" value="or"> OR
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="radio2" id="inlineRadio2" value="and"> AND
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" name="radio2" id="inlineRadio3" value="not"> NOT
                                </label>
                              </div>
                            </div>
                            <div style="margin-top:10px;">
                              <div class="form-group col-sm-offset-1">
                                <label for="keyword1">Keyword</label>
                                <input type="text" class="form-control input-sm" name="keyword2">
                              </div>
                              <div class="form-group">
                                <label for="select1" style="margin-left:15px;">Connect as</label>
                                <select class="form-control input-sm" name="connectors2">
                                    <option value="or">OR</option>
                                    <option value="and">AND</option>
                                    <option value="exact">PHRASE</option>
                                </select>
                              </div>
                              <div class="form-group ">
                                <label for="select2" style="margin-left:15px;">In</label>
                                <select class="form-control input-sm" name="basedon2">
                                    <option value="title">TITLE</option>
                                    <option value="authors">AUTHOR</option>
                                    <option value="number">NUMBER</option>
                                </select>
                              </div>
                              <div class="form-group" style="margin-top:10px;margin-left:55px;">
                                <label class="radio-inline">
                                  <input type="radio" id="inlineRadio1" value="or" checked name="radio3"> OR
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" id="inlineRadio2" value="or" name="radio3"> AND
                                </label>
                                <label class="radio-inline">
                                  <input type="radio" id="inlineRadio3" value="or" name="radio3"> NOT
                                </label>
                              </div>
                            </div>
                            <div style="margin-top:10px;">
                              <div class="form-group col-sm-offset-1">
                                <label for="keyword1">Keyword</label>
                                <input type="text" class="form-control input-sm" name="keyword3">
                              </div>
                              <div class="form-group">
                                <label for="select1" style="margin-left:15px;">Connect as</label>
                                <select class="form-control input-sm" name="connectors3">
                                    <option value="or">OR</option>
                                    <option value="and">AND</option>
                                    <option value="exact">PHRASE</option>
                                </select>
                              </div>
                              <div class="form-group ">
                                <label for="select2" style="margin-left:15px;">In</label>
                                <select class="form-control input-sm" name="basedon3">
                                    <option value="title">Title</option>
                                    <option value="authors">Author</option>
                                    <option value="number">Number</option>
                                </select>
                              </div>
                              </div>
                              <div style="margin-top:25px;">
                                <div class="form-group col-sm-offset-1">
                                <label for="select1" >Sort By</label>
                                <select class="form-control input-sm" name="sortby">
                                    <option value="title">TITLE</option>
                                    <option value="authors">AUTHOR</option>
                                </select>
                              </div>
                              <div class="form-group ">
                                <label for="select2" style="margin-left:15px;">ORDER</label>
                                <select class="form-control input-sm" name="order">
                                    <option value="asc">Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                              </div>
                              </div>
                              <button type="submit" class="btn btn-primary pull-right" style="margin-top:10px;">Search</button>  
                            </form>
                        </div>
                     </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Book Card -->
<div class="row mt">


    <?php foreach($finalresult as $entry) {
        $countofcopies = 0;
        $countofavailable = 0;
        foreach ($copy as $item) {
            if ($item->title == $entry->title && $item->authors == $entry->authors)
                $countofcopies++;
            if ($item->issue != 'h' && $item->title == $entry->title && $item->authors == $entry->authors)
                $countofavailable++;
        }
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
                        <p><i id="icon" class="fa fa-heart" onclick="wish({{ $entry->id }})"> ADD TO WISHLIST</i></p>
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
                                <td>{{ $countofcopies }}</td>
                            </tr>
                            <tr>
                                <td>Available copies</td>
                                <td>{{ $countofavailable }}</td>
                            </tr>
                            @foreach ($copy as $item)
                                @if ($item->title == $entry->title && $item->authors == $entry->authors && $item->available == 1)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><button id="{{ $item->id }}" value="{{ $item->id }}">Ask</button></td>
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

@section('user-advanced_search')
    active
@endsection

@section('user-search')
    active
@endsection


@section('scripts')
    <script>
        function func(id)
        {
            var select_data = {
                'book_id' : id,
                'user_id' : $("#user_id").val()
            };

            $.ajax({
                url: "{{ route('add_wish') }}",
                method: 'POST',
                data: select_data,
                dataType: 'json',
                encode: 'true'
            })

                    .success(function () {
                        alert("hello1");
                    })
                    .fail(function () {
                        alert("hello2");
                    })
        }
    </script>
    <script>
         $('button').click(function(event) {
                event.preventDefault();
                var tobesent = parseInt(this.value);
                $.ajax({
                    url: "{{ route('bookstransfer') }}",
                    method: 'POST',
                    data: {'id': tobesent}
                })
                 .success(function (result) {
                    alert(result);
                    Key:{{$book->mutualtransfer->pin}}
                })
                .fail(function () {
                    alert('There was an error. Please Try Again');
                });
        });
    </script>


@endsection
