@extends('user.master')
@section('title')
    Library | Accounts
@endsection
@section('link')
    <link rel="stylesheet" href="{{asset('user-assets/js/gritter/css/jquery.gritter.css')}}" />
    <link rel="stylesheet" href="{{asset('user-assets/css/zabuto_calendar.css')}}" />

@endsection

@section('main_content')
    <div class="row">
        <div class="col-lg-9 main-chart">

             <div class="row mt">
                 <div class="col-md-12 mb">
            <!-- WHITE PANEL - TOP USER -->
                        <div class="white-panel pn"  style="color:Black;">
                        <div class="white-header" style="color:Black;">
                            <h5>USERNAME</h5>
                        </div>
                        
                        <p><img src="{{asset('user-assets/img/icon.jpg')}}" class="img-circle" width="80"></p>
                        <p><b>{{Auth::user()->get()->name}}</b></p>
                        <div class="row">
                            <div class="col-md-6" style="color:Black;">
                                <p class="small mt">BATCH OF</p>
                                <p>2017</p>
                            </div>
                            <div class="col-md-6" style="color:Black;">
                                 <p class="small mt">Roll no.:</p>

                                <p>{{Auth::user()->get()->roll}}</p>
                            </div>
                        </div>
                        </div>
                </div>
            </div>

            <div class="row mt">
                <!--CUSTOM CHART START -->
                <div class="col-md-12 mb">

                    <div class="content-panel">
                        <table class="table table-striped table-advance table-hover">
                            <h4><i class="fa fa-angle-right"></i>Accounts Table</h4>
                            <hr>
                            <thead>
                            <tr>
                                <th><i class="fa fa-bullhorn"></i> Title</th>
                                <th class="hidden-phone"><i class="fa fa-question-circle"></i> Issue Date</th>
                                <th><i class="fa fa-bookmark"></i> Return date</th>
                                <th><i class=" fa fa-edit"></i> Status</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                                
                                @foreach (Book::where('issue',Auth::user()->get()->id)->get() as $book)
                                    <tr>
                                        <td><a href="basic_table.html#">:{{$book->title}}</a></td>
                                        <td class="hidden-phone">{{$book->issue_date}} </td>
                                        <td>{{$book->return_date}}</td>
                                        @if($book->available)
                                        <td><button id="{{$book->id}}" class="btn btn-lg btn-block btn-danger" value="avail" role="button"> Available for Mutual Transfer</button></td>
                                        @else
                                        <td><button id="{{$book->id}}" class="btn btn-lg btn-block btn-success" value="navail" role="button"> Make Available for Mutual Transfer</button></td>
                                
                                        @endif
                                        </td>

                                    </tr>
                                @endforeach
                             </tbody>
                        </table>
                    </div><!-- /content-panel -->

                </div>

            </div>
        </div>


    <div class="col-lg-3 ds">
        <!--COMPLETED ACTIONS DONUTS CHART-->
        <h3>NOTIFICATIONS</h3>

        <!-- First Action -->
        <div class="desc">
            <div class="thumb">
                <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
            </div>
            <div class="details">
                <p><muted>2 Minutes Ago</muted><br/>
                    <a href="#">James Brown</a> subscribed to your newsletter.<br/>
                </p>
            </div>
        </div>
        <!-- Second Action -->
        <div class="desc">
            <div class="thumb">
                <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
            </div>
            <div class="details">
                <p><muted>3 Hours Ago</muted><br/>
                    <a href="#">Diana Kennedy</a> purchased a year subscription.<br/>
                </p>
            </div>
        </div>
        <!-- Third Action -->
        <div class="desc">
            <div class="thumb">
                <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
            </div>
            <div class="details">
                <p><muted>7 Hours Ago</muted><br/>
                    <a href="#">Brandon Page</a> purchased a year subscription.<br/>
                </p>
            </div>
        </div>
        <!-- Fourth Action -->
        <div class="desc">
            <div class="thumb">
                <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
            </div>
            <div class="details">
                <p><muted>11 Hours Ago</muted><br/>
                    <a href="#">Mark Twain</a> commented your post.<br/>
                </p>
            </div>
        </div>
        <!-- Fifth Action -->
        <div class="desc">
            <div class="thumb">
                <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
            </div>
            <div class="details">
                <p><muted>18 Hours Ago</muted><br/>
                    <a href="#">Daniel Pratt</a> purchased a wallet in your store.<br/>
                </p>
            </div>
        </div>

        <!-- CALENDAR-->
        <div id="calendar" class="mb">
            <div class="panel green-panel no-margin">
                <div class="panel-body">
                    <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                        <div class="arrow"></div>
                        <h3 class="popover-title" style="disadding: none;"></h3>
                        <div id="date-popover-content" class="popover-content"></div>
                    </div>
                    <div id="my-calendar"></div>
                </div>
            </div>
        </div><!-- / calendar -->

    </div><!-- /col-lg-3 -->
        </div><!--row-->
@endsection

@section('user-accounts')
    active
@endsection


@section('scripts')
    <script type="text/javascript" src="{{asset('user-assets/js/gritter/js/jquery.gritter.js')}}"></script>
    <script type="text/javascript" src="{{asset('user-assets/js/gritter-conf.js')}}"></script>
    <script src="{{asset('user-assets/js/sparkline-chart.js')}}"></script>
    <script src="{{asset('user-assets/js/zabuto_calendar.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            var unique_id = $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: 'Welcome to Dashboard!',
                // (string | optional) the image to display on the left
                image: "{{asset('user-assets/img/ui-sam.jpg')}}",
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: true,
                // (int | optional) the time you want it to be alive for before fading out
                time: '',
                // (string | optional) the class name you want to apply to that specific message
                class_name: 'my-sticky-class'
            });

            return false;
        });
    </script>

    <script>
    $(document).ready(function() {
            $('button').click(function(event) {
                var tobechanged = parseInt(this.id);
                var extra = this.id;
                var action = this.value;
                var formData = {
                    'id' : tobechanged,
                    'action' : action,
                };
                $.ajax({
                    type        : 'POST',
                    url         : "{{ route('available') }}",
                    data        : formData, 
                    dataType    : 'json',
                    encode      : true
                })
                    .done(function(data) {
                        console.log(data.user_id);
                        console.log(data.id);
                        // console.log(data.message);
                        console.log("succeeded");
                        var a = $("#"+extra);
                        if(a.hasClass("btn-success"))
                        {
                            a.removeClass("btn-success");
                            a.addClass("btn-danger");
                            a.text("Available for mutual transfer");
                            a.val("avail");
                        }
                        else
                        {
                            a.removeClass("btn-danger");
                            a.addClass("btn-success");
                            a.text("Make available for mutual transfer");
                            a.val("navail");
                        }
                    })
                    .fail(function(data) {
                        console.log("failed");
                        console.log(data.message);
                        console.log(data);
                    });
            });
        });
    </script>

    <script type="application/javascript">
        $(document).ready(function () {
            $("#date-popover").popover({html: true, trigger: "manual"});
            $("#date-popover").hide();
            $("#date-popover").click(function (e) {
                $(this).hide();
            });

            $("#my-calendar").zabuto_calendar({
                action: function () {
                    return myDateFunction(this.id, false);
                },
                action_nav: function () {
                    return myNavFunction(this.id);
                },
                ajax: {
                    url: "show_data.php?action=1",
                    modal: true
                }
            });
        });


        function myNavFunction(id) {
            $("#date-popover").hide();
            var nav = $("#" + id).data("navigation");
            var to = $("#" + id).data("to");
            console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
        }
    </script>
@endsection