@extends('user.master')
@section('title')
    Library | New Additions
@endsection

@section('main_content')
    <p class="text-center">
        <button class="btn btn-lg btn-default" data-toggle="modal" data-target="#loginModal">Add New Book</button>
    </p>

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center">Add New Book</h4>
                </div>

                <div class="modal-body">
                    <!-- The form is placed inside the body of modal -->
                    <form id="loginForm" method="post"  class="form-horizontal" action="{{ route('submitsuggestion') }}">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">Book Title</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" name="title" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">Authors</label>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" name="author" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">Publication</label>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" name="publication" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">Edition</label>
                            <div class="col-xs-5">
                                <input type="text" class="form-control" name="edition" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-5 col-xs-offset-3">
                                <button type="submit" class="btn btn-primary">Add Book</button>
                            </div>
                        </div>
                    </form> <!-- End of Form -->
                </div>
            </div>
        </div>
    </div>



<div class="row mt">
<?php
    $results = DB::table('new_add_options')->get();

    foreach ($results as $item) {
        //$user_id = Auth::user()->get()->id;
        //$user_id = 1;
        $decide = DB::table('nao_details')->where('user_id',Auth::user()->get()->id)->where('nao_id',$item->id)->get();
?>
        
            <div class="col-lg-3 col-md-3 col-sm-3 mb">
                <div class="content-panel pn" style="height:185px">
                    <div style="min-height:110px;">
                        <h5>Title:{{$item->title}}</h5>
                        <h5>Author:{{$item->author}}</h5>
                        <h5>Publication:{{$item->publication}}</h5>
                        <h5>Edition:{{$item->edition}}</h5>
                    </div>
                    <div class="panel panel-default">
                    <?php
                        if (sizeof($decide) == 0) {
                    ?>
                            <div class="text-center"><button href="#" id="{{ $item->id }}" value="up" class="btn btn-lg btn-block btn-success" style="border-radius:0px;" role="button">UpVote</button></div>
                    <?php    
                        }
                        else{
                    ?>
                            <div class="text-center"><button href="#" id="{{ $item->id }}" value="down" class="btn btn-lg btn-block btn-danger" style="border-radius:0px;" role="button">Downvote</button></div>
                    <?php
                        }
                    ?>
                    </div>
                </div>
            </div>
       
<?php
    }
?>
 </div>
@endsection

@section('user-new-additions')
    active
@endsection


@section('scripts')
    
    <script>
        $(document).ready(function() {
            $('button').click(function(event) {
                var tobevoted = parseInt(this.id);
                var extra = this.id;
                var action = this.value;
                var formData = {
                    'id' : tobevoted,
                    'action' : action,
                    'user_id' : {{ Auth::user()->get()->id }}
                };
                $.ajax({
                    type        : 'POST',
                    url         : "{{ route('upvote') }}",
                    data        : formData, 
                    dataType    : 'json',
                    encode      : true
                })
                    .done(function(data) {
                        console.log(data.user_id);
                        console.log(data.id);
                        console.log(data.message);
                        var a = $("#"+extra);
                        if(a.hasClass("btn-success"))
                        {
                            a.removeClass("btn-success");
                            a.addClass("btn-danger");
                            a.text("DownVote");
                            a.val("down");
                        }
                        else
                        {
                            a.removeClass("btn-danger");
                            a.addClass("btn-success");
                            a.text("UpVote");
                            a.val("up");
                        }
                    })
                    .fail(function(data) {
                        console.log(data);
                    });
            });
        });

    </script>


@endsection