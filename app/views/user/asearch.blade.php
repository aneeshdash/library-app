

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

    


@endsection

@section('user-advanced_search')
    active
@endsection

@section('user-search')
    active
@endsection


@section('scripts')
    
@endsection
