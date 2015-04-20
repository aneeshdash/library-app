@extends('admin.master')
@section('content')
    <div class="row">
        <div class="col-md-12">

            <!-- Content Header (Page header) -->
            <section class="content-header callout callout-info">
                <h1>
                    Transaction
                    <small>Details</small>
                </h1>
            </section>

            <!-- Main content -->
            <section class="content" style="color:#00733e">
            @if(Session::has('error'))
                {{ Session::get('error') }}
                @endif
                <div class="modals">
                    <div class="row">
                        <form action="{{ route('adminuser') }}" method="POST" id="chkusr">
                        <div class="col-md-4">
                            <div class="pull-right">
                                Roll No.
                            </div>
                        </div>
                        <div class="col-md-2">
                            <input type="number" class="form-control" id="Roll" name="roll" required>
                        </div>
                        <div class="col-md-3">
                            <input type="submit" class="btn btn-flat btn-success" value="Submit">
                        </div>
                        </form>
                    </div>
                </div>
                </section>

                </br>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#showmenu').click(function() {
                $('.menu').slideToggle("fast");
            });
        });
    </script>


@endsection