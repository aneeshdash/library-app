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

            <div class="modals">
                <div class="row">
                    <form action="{{ route('adminuser') }}" method="post" id="chkusr">
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

            </br>




            <div class="panel panel-info menu">
                <div class="panel-heading">
                    <div class="modals">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="pull-right">
                                    USER DETAILS
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <button type="button" class="btn btn-flat btn-success pull-right"  data-toggle="modal" data-target="#editModal">Edit</button>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <caption></caption>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Name</td>
                            <td>{{ $user->name }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Category</td>
                            <td>{{ $user->type }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Roll No.</td>
                            <td>{{ $user->roll }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Contact</td>
                            <td>{{ $user->contact }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Webmail</td>
                            <td>{{ $user->webmail }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Alternate Email</td>
                            <td>{{ $user->alt_email }}</td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td>Dues </td>
                            <td id="fine">{{ $user->fine }}</td>  <!-- include the variable-->
                            <td><button type="button" class="btn btn-md btn-success" data-toggle="modal"  data-target="#payment">Pay</button></td>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                    <input type="hidden" id="user" value="{{ $user->id }}">
                </div>
            </div>
            </br>

            <div class="menu">
                <div class="row">
                    <div class="col-md-4">
                        <div class="pull-right">
                            Book ID
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" id="book_id">
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-flat btn-success" onclick="show_book()">Submit</button>
                    </div>
                </div>
            </div>
            </br>



            <!-- Default box -->
            <div class="box menu">
                <!--Expand and collapse buttonss-->
                <div class="box-header with-border">
                    <h3 class="box-title">Books</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                        <!--<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>-->
                    </div>
                </div>
                <!--Main content of the box-->
                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12 row-md-12">
                            <table>
                                @foreach($user->books as $book)
                                <tr>
                                    <td class="col-md-6 row-md-6">{{ $book->title }}</td>

                                    <td class="col-md-6 row-md-6" id="{{ $book->id }}">
                                        <button type="button" class="btn-xs btn-flat btn-info" onclick="book_detail($(this).closest('td').attr('id'))" data-toggle="modal" data-target="#details">
                                            Details
                                        </button>
                                    </td>
                                </tr>
                                    @endforeach
                            </table>
                        </div>

                    </div>
                </div><!-- /.box-body -->


            </div><!-- /.box -->
        </section><!-- /.content -->


        <!-- Roll No. Modal -->
        <div class="modal fade" id="roll" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-flat btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Issue Modal -->
        <div class="modal fade" id="issue" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="form-horizontal" role="form">
                <div class="modal-content" id="show_book">

                </div>
                    </form>
            </div>
        </div>




        <!-- Book Details Modal -->
        <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content" style="color:#00a65a" id="book_detail">

                </div>
            </div>
        </div>


        <!-- Payment Modal -->
        <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="payModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="payModalLabel">No Dues Panel</h4>
                    </div>
                    <div class="modal-body">
                            <table class="table" margin="0">
                                <tr>
                                    <th>Amount Payable</th>
                                    <td>
                                        <form role="form">
                                            <div class="form-group">
                                                <input type="number" class="form-control" placeholder="Amount" id="pay_fine">
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            </table>
                        </br>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="pay_fine()">Pay</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lost Modal -->

        <div class="modal fade" id="lost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 900px">
                <form class="form-horizontal" role="form" id="lost_form">
                <div class="modal-content " style="color:#00a65a" id="lost_book">

                </div>
                </form>
            </div>
        </div>

        <!-- Modal edit -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="form-horizontal" role="form" id="edit">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit User Details</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="firstname" class="col-sm-3 control-label">Name:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ $user->name }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="col-sm-3 control-label">Webmail:</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="webmail" placeholder="Enter Webmail" name="webmail" value="{{ $user->webmail }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="col-sm-3 control-label">Roll Number:</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="roll" placeholder="Enter Roll Number" name="roll" value="{{ $user->roll }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="col-sm-3 control-label">Books Issued</label>
                                <div class="col-sm-9">
                                    <label class="control-label" style="font-weight: 500" id="books"> {{ $user->no_books_issued }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="col-sm-3 control-label">Fine</label>
                                <div class="col-sm-9">
                                    <label class="control-label" style="font-weight: 500" id="fine">{{ $user->fine }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="col-sm-3 control-label">Category</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="cat" name="cat">
                                        <option value="BTECH">BTECH</option>
                                        <option value="MTECH">MTECH</option>
                                        <option value="PHD">PHD</option>
                                        <option value="MSC">MSC</option>
                                        <option value="FAC">FAC</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="user_id" name="id" value="{{ $user->id }}">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                        </div>
                    </div>
                </form>
            </div>
        </div>
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

        function book_detail(id) {
            $.ajax({
                url: '{{ route('func_book_detail') }}',
                method: 'POST',
                data: { id: id }
            })
                    .success(function (result) {
                        $('#book_detail').html(result);
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        }

        function pay_fine() {
            max=parseInt($('#fine').html());
            amt=$('#pay_fine').val();
            if(amt > max) {
                alert('Amount exceeds fine amount');
            }
            else {
                user =$('#user').val();
                $.ajax({
                    url: '{{ route('func_pay_fine') }}',
                    method: 'POST',
                    data: { user: user, amt: amt }
                })
                        .success(function (result) {
                            alert(result);
                            if(result == 'Fine Paid') {
                                $('#fine').html(max-amt);
                            }
                        })
                        .fail(function () {
                            alert('There was an error. Please Try Again');
                        });
            }
            $('#payment').modal('hide');
        }

        function show_book() {
            code=$('#book_id').val();
            if(code=='' || code==0) {
                alert('Please fill book code');
            }
            else {
                $.ajax({
                    url: '{{ route('func_show_book') }}',
                    method: 'POST',
                    data: {id: code}
                })
                        .success(function (result) {
                            $('#show_book').html(result);
                            $('#issue').modal('show');
                        })
                        .fail(function () {
                            alert('There was an error. Please Try Again');
                        });
            }
        }

        function issue(code) {
            user=$('#user').val();
            $.ajax({
                url: '{{ route('func_issue_book') }}',
                method: 'POST',
                data: {code: code, user: user }
            })
                    .success(function (result) {
                        alert(result);
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        }

        function lost(code) {
            $.ajax({
                url: '{{ route('func_lost_book') }}',
                method: 'POST',
                data: {code: code}
            })
                    .success(function (result) {
                        $('#lost_book').html(result);
                        $('#lost').modal('show');
//                        alert(result);
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        }

        function edit() {
            $.ajax({
                url: '{{ route('func_edit') }}',
                method: 'POST',
                data: $('#edit').serialize() + '&type=user'
            })
                    .success(function (result) {
                        alert(result);
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        }

        $('#edit').on('submit', function(e) {
            $('#editModal').modal('hide');
            e.preventDefault();
            $.ajax({
                url: '{{ route('func_edit') }}',
                method: 'POST',
                data: $('#edit').serialize()
            })
                    .success(function (result) {
                        alert(result);
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        });

        function ret(book) {
            user=$('#user').val();
            $.ajax({
                url: '{{ route('func_ret_book') }}',
                method: 'POST',
                data: { user: user, book: book }
            })
                    .success(function (result) {
                        alert(result);
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        }

        function reissue(book) {
            user=$('#user').val();
            $.ajax({
                url: '{{ route('func_reissue') }}',
                method: 'POST',
                data: { user: user, book: book }
            })
                    .success(function (result) {
                        alert(result);
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        }

        $('#lost_form').on('submit', function(e) {
            e.preventDefault();
            user=$('#user').val();
            $.ajax({
                url: '{{ route('func_ret_book') }}',
                method: 'POST',
                data: $('#lost_form').serialize()
            })
                    .success(function (result) {
                        alert(result);
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        });

    </script>


@endsection