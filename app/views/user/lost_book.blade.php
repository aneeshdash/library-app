@extends('user.master')
@section('title')
    Library | Lost-Form
@endsection

@section('link')
    <link rel="stylesheet" href="{{asset('user-assets/css/to-do.css')}}">
    <style>
        /*.drop-shadow {*/
            /*-webkit-box-shadow: 0 0 4px 2px rgba(0, 0, 0, .5);*/
            /*box-shadow: 0 0 4px 2px rgba(0, 0, 0, .5);*/
        /*}*/
        /*.panel.drop-shadow {*/
            /*padding-left:0;*/
            /*padding-right:0;*/
        /*}*/
        .effect1{
            -webkit-box-shadow: 0 8px 5px -6px #777;
            -moz-box-shadow: 0 8px 5px -6px #777;
            box-shadow: 0 8px 5px -6px #777;
        }
    </style>
@endsection

@section('main_content')
    <div class="container" style="margin-top:5px;">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel effect1  panel-info">
                    <div class="panel-heading" >
                        <div class="text-center"><strong style="font-size: 20px;">LOST BOOK FORM</strong></div>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="lost_book"  role="form">

                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label">Name</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ Auth::user()->get()->name }}</p>
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label" >Roll Number</label>
                                <div class="col-sm-9">
                                    <p class="form-control-static">{{ Auth::user()->get()->roll }}</p>
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label" for="book_title">Book Title</label>
                                <div class="col-sm-6">
                                    <select id="publications_select" class="form-control" name="book_title" onchange="update_form()">
                                        <option value="select" style="display:none;">Select Book</option>
                                        <?php $books = DB::table('books')->where('issue', Auth::user()->get()->id )->get();
                                            foreach ($books as $book)
                                                {
                                                    echo '<option value="'.$book->id.'">'.$book->title.'</option>';
                                                }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label" for="authors">Authors</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="authors" name="authors">
                                    <p class="help-block">Use semicolons(;) to seperate entries</p>
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label" for="publications">Publications</label>
                                <div class="col-sm-3">
                                    <select id="publication_select" onchange="show_publication()" class="form-control" name="pub" >
                                        <option value="other">Other</option>
                                        <?php $pubs = DB::table('publications')->get();
                                            foreach ($pubs as $pub)
                                            {
                                                echo '<option value="'.$pub->id.'">'.$pub->name.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div id="pub_field" class="col-sm-6">
                                    <input type="text" id="new_pub" class="form-control" placeholder="Enter Publication Name" name="new_pub">
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label" for="edition">Edition</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="edition" name="edition">
                                </div>
                            </div>

                            <div class="form-group form-group-lg">
                                <label class="col-sm-3 control-label" for="isbn">ISBN</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="isbn" name="isbn">
                                </div>
                                    <input type="hidden" name="userid" value="{{ Auth::user()->get()->id }}" >
                            </div>
                            <div class="col-sm-10 col-md-offset-3">
                                <button type="button" id="formbtn" class="btn btn-default">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt">
        <div class="col-md-8 col-md-offset-2">
            <section class="task-panel tasks-widget">
                <div class="panel-heading">
                    <div class="text-center"><strong style="font-size:20px;">Lost-Book Log</strong></div>
                    <br>
                </div>
                <div class="panel-body">
                    <div class="task-content">

                        <ul class="task-list">

                            @foreach(DB::table('lost_book')->where('user_id', Auth::user()->get()->id )->get() as $log)
                                <li id="li-{{$log->id}}">
                                    <div class="task-title">
                                        <span>{{$log->title}}<div class="text-center">created on {{$log->created_at}} </div></span>
                                        <div class="pull-right">
                                            <a id="btn1-{{$log->id}}" class="btn btn-info btn-xs" href="{{route('printLog',Crypt::encrypt($log->id))}}" target="_blank"><i class="fa fa-print"></i></a>
                                            <button id="btn2-{{$log->id}}" class="btn btn-danger btn-xs" onclick="del({{$log->id}})"><i class="fa fa-trash-o "></i></button>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
        </div><!-- /col-md-12-->
    </div><!-- /row -->



@endsection

@section('user-lost_form')
    active
@endsection

@section('user-lost_book')
    active
@endsection

@section('scripts')

    <script src="{{asset('user-assets/js/bootbox.min.js')}}"></script>
    <script src="{{asset('user-assets/js/tasks.js')}}" type="text/javascript"></script>

    <script>
        function del(id)
        {
            var select_data = {
                'val' : id
            };

                $.ajax({
                    url: "{{ route('del_log') }}",
                    method: 'POST',
                    data: select_data,
                    dataType: 'json',
                    encode: 'true'
                })

                        .success(function (authors) {
                            document.getElementById("li-"+id).style.visibility = "hidden";
                            bootbox.alert("Deleted Successfully", function() {
                                window.location.reload();
                            });
                        })
                        .fail(function (authors) {
                            bootbox.alert("Unsuccessful try again", function() {
                            });
                        })
        }
    </script>

    <script>
        function update_form()
        {
            var select_data = {
                'val' : $("#publications_select").val() //book_id
            };

            if($("#publications_select").val() != "select" && $("#publications_select").val() != null) {
                $.ajax({
                    url: "{{ route('update_form') }}",
                    method: 'POST',
                    data: select_data,
                    dataType: 'json',
                    encode: 'true'
                })

                        .success(function (authors) {
                            document.getElementById('authors').value = authors.auths;
                            document.getElementById('edition').value = authors.edition;
                            document.getElementById('isbn').value = authors.isbn;
                            document.getElementById('publication_select').value = authors.pub;
                            document.getElementById("pub_field").style.display = "none";
                        })
            }
        }


    </script>


    <!-- javascript for form validation -->
    <script>

        function Ajax_Post(){
            $.ajax({
                url: "{{ route('user_add_lost_book') }}",
                method: 'POST',
                data: $('#lost_book').serialize()
            })
                    .success(function () {
                        bootbox.alert("your response has been recorded", function() {
                        });
                    })
                    .fail(function () {
                        bootbox.alert("Failed! Please Try Again", function() {
                        });
                    })
        }




        function isValidISBN (isbn) {
            isbn = isbn.replace(/[^\dX]/gi, '');
            if(isbn.length == 10) {
                var chars = isbn.split('');
                if(chars[9].toUpperCase() == 'X') {
                    chars[9] = 10;
                }
                var sum = 0;
                for(var i = 0; i < chars.length; i++) {
                    sum += ((10-i) * parseInt(chars[i]));
                }
                return (sum % 11 == 0);
            }
            else if(isbn.length == 13) {
                var chars = isbn.split('');
                var sum = 0;
                for (var i = 0; i < chars.length; i++) {
                    if(i % 2 == 0) {
                        sum += parseInt(chars[i]);
                    } else {
                        sum += parseInt(chars[i]) * 3;
                    }
                }
                return (sum % 10 == 0);
            }
            else {
                return false;
            }
        }

        function validateform(id)
        {

            if( $("#"+id).val() == null || $("#"+id).val() == "" )
            {
                var div = $("#"+id).closest("div");
                div.removeClass("has-success has-warning");
                $("#glypcn"+id).remove();
                div.addClass("has-error has-feedback");
                div.append('<span id="glypcn'+id+'" class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>');
                return false;
            }
            else
            {
                var div = $("#"+id).closest("div");
                div.removeClass("has-error has-warning");
                div.addClass("has-success has-feedback");
                $("#glypcn"+id).remove();
                div.append('<span id="glypcn'+id+'" class="glyphicon glyphicon-ok form-control-feedback" aria-hidden="true"></span>');
                return true;
            }
        }

        $(document).ready(
                function()
                {
                    $("#formbtn").click(function()
                    {
                      var check = 0;
                        if(!validateform("authors"))
                        {
                            return false;
                        }
                        if($("#publication_select").val() == "other"){
                            if(!validateform("new_pub"))
                            {
                                return false;
                            }
                        }

                        if(!validateform("edition"))
                        {
                            return false;
                        }
                        if(!validateform("isbn"))
                        {
                            return false;
                        }
                        else if(!isValidISBN(document.getElementById("isbn").value))
                        {

                            var div = $("#isbn").closest("div");
                            div.removeClass("has-success");
                            $("#glypcn"+"isbn").remove();
                            div.addClass("has-warning has-feedback");

                            div.append('<span id="glypcn'+'isbn'+'" class="glyphicon glyphicon-warning-sign form-control-feedback" aria-hidden="true"></span>');
//                            var cnf1 = confirm("The ISBN you entered doesn't meet ISO standards\n\n Do You still want to submit?");
                            check = 1;
                            bootbox.confirm("The ISBN you entered doesn't meet ISO standards\n\n Do You still want to submit?", function(result) {
                                if(result == false)
                                {

                                    console.log("Alert dismissed");
                                }
                                else{
                                    Ajax_Post();
                                }

                            });

                        }
                        if(check != 1) {
                            bootbox.confirm("Do you want to submit the form?", function (result) {
                                if (result == false) {
                                    console.log("Alert dismissed");
                                }
                                else {
                                    Ajax_Post();
                                }
                            });
                            check = 0;
                        }
                    });
                }
        );
    </script>

    <!-- javascript for publications -->
    <script>
        function show_publication() {

            var x = document.getElementById("publication_select").value;
            var div = $("#new_pub").closest("div");

            if(x == "other"){
                document.getElementById("pub_field").style.visibility = "visible";
                div.removeClass("has-success has-error");
                $("#glypcn"+"new_pub").remove();

            }
            else{
                document.getElementById("pub_field").style.visibility = "hidden";
            }
        }
    </script>

@endsection