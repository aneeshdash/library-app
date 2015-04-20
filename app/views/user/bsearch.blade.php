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
                                    <option value="number">Number</option>
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
<!-- <div class="row mt">
    <! each card -->
    <!-- <div class="col-lg-3 col-md-3 col-sm-3 mb">
        <div class="content-panel pn">

            <div style="min-height:106px;margin-left:10">
                <h3>Book name</h3>
                <h6>Authors</h6>
                <h6>Edition</h6>
            </div>

            <div class="panel panel-default">
                <div class="centered">
                    <h5><i class="fa fa-book"></i><br/><a data-toggle="modal" data-target="#myModal" href="#">Book Details</a></h5>
                </div>
                <div class="profile-01 centered">
                    <p><i id="icon" class="fa fa-heart" onclick="wish(1)"> ADD TO WISHLIST</i></p>
                </div>
            </div>
        </div>
    </div> -->
    <!-- end of each card -->
<!-- </div>  -->
<!-- End Of Book Cards -->

<!-- Modal --><!-- 
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
                            <th>Attributes</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Author</td>
                        <td>Authorname</td>
                    </tr>
                    <tr>
                        <td>Publication</td>
                        <td>Publication</td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <td>ISBN number</td>

                    </tr>
                    <tr>
                        <td>Edition</td>
                        <td>Edition</td>

                    </tr>
                    <tr>
                        <td>Author</td>
                        <td>Authorname</td>
                    </tr>
                    <tr>
                        <td>Publication</td>
                        <td>Publication</td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <td>ISBN number</td>

                    </tr>
                    <tr>
                        <td>Edition</td>
                        <td>Edition</td>

                    </tr>
                    <tr>
                        <td>Author</td>
                        <td>Authorname</td>
                    </tr>
                    <tr>
                        <td>Publication</td>
                        <td>Publication</td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <td>ISBN number</td>

                    </tr>
                    <tr>
                        <td>Edition</td>
                        <td>Edition</td>

                    </tr>
                    <tr>
                        <td>Author</td>
                        <td>Authorname</td>
                    </tr>
                    <tr>
                        <td>Publication</td>
                        <td>Publication</td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <td>ISBN number</td>

                    </tr>
                    <tr>
                        <td>Edition</td>
                        <td>Edition</td>

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
</div> -->
<!-- End Of Modal -->


@endsection


@section('user-bsearch')
    active
@endsection
@section('user-search')
    active
@endsection

@section('scripts')

@endsection
