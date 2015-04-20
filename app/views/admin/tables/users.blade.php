@extends('admin.master')
@section('head')
    <link href="{{ asset('admin_template/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
    <style>
        @-moz-document url-prefix() {
            fieldset {
                display: table-cell;
            }
        }
            .btech { background-color: #00c0ef }
    </style>
    @endsection
@section('content')
    <section class="content-header">
        <h1>
            Users Table
            <small>it starts here</small>
        </h1>
        <button class="btn btn-primary btn-lg" style="margin-top: 1%" data-toggle="modal" data-target="#newModal">+ Add User</button>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
            <div class="box-header">
                <h3 class="box-title">Details of Users</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Roll Number</th>
                        <th>Webmail</th>
                        <th>Books Issued</th>
                        <th>Fine</th>
                        <th>Category</th>
                        <th class="col-md-1">Edit/Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0; ?>
                    @foreach(User::all() as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->roll }}</td>
                        <td>{{ $user->webmail }}</td>
                        <td>{{ $user->no_books_issued }}</td>
                        <td>{{ $user->fine }}</td>
                        <td class="{{$user->type}}">
                            @if($user->type === 'BTECH')
                                B. Tech
                            @elseif($user->type === 'MTECH')
                                M. Tech
                            @elseif($user->type === 'MSC')
                                M. Sc.
                            @elseif($user->type === 'PHD')
                                Ph. D.
                            @elseif($user->type === 'FAC')
                                Faculty
                                @endif
                        </td>
                        <td id="hi"><div class="btn-group">
                                <button type="button" class="btn btn-info" onclick="edit({{ $i }}, this.id, {{ $user->id }})" id="{{ $user->type }}">Edit</button>
                                <button type="button" class="btn btn-danger" onclick="del({{ $user->id }}, {{ $i }})" id="del">Delete</button>
                            </div></td>
                    </tr>
                        <?php $i++; ?>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Roll Number</th>
                        <th>Webmail</th>
                        <th>Books Issued</th>
                        <th>Fine</th>
                        <th>Category</th>
                        <th class="col-md-1">Edit/Delete</th>
                    </tr>
                    </tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal" role="form" id="edit">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">Name:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Webmail:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="webmail" placeholder="Enter Webmail" name="webmail" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Roll Number:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="roll" placeholder="Enter Roll Number" name="roll" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Books Issued</label>
                            <div class="col-sm-9">
                                <label class="control-label" style="font-weight: 500" id="books"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Fine</label>
                            <div class="col-sm-9">
                                <label class="control-label" style="font-weight: 500" id="fine"></label>
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
                        <input type="hidden" id="user_id" name="id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Save Changes">
                </div>
            </div>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal" role="form" id="new">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">Name:</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" id="new-name" placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Webmail:</label>
                            <div class="col-sm-9">
                                <input type="text" name="webmail" class="form-control" id="new-webmail" placeholder="Enter Webmail" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Roll Number:</label>
                            <div class="col-sm-9">
                                <input type="number" name="roll" class="form-control" id="new-roll" placeholder="Enter Roll Number" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Category</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="cat" id="new-cat">
                                    <option value="BTECH">BTECH</option>
                                    <option value="MTECH">MTECH</option>
                                    <option value="PHD">PHD</option>
                                    <option value="MSC">MSC</option>
                                    <option value="FAC">FAC</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary" value="Create User">
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="modal fade modal-danger" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                </div>
                <div class="modal-body">
                    <p style="font-size: x-large">Do you really want to delete this user ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" value="" id="delbutt" onclick="del_send()">Yes</button>
                    <button type="button" class="btn btn-outline" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
    @endsection
@section('script')
    <!-- DATA TABES SCRIPT -->
    <script src="{{ asset('admin_template/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_template/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        var row=0;
        //set attribute of datatable
        var table=$('#table').dataTable({
                "bPaginate": true,
                "bLengthChange": true,
                "bFilter": true,
                "bSort": true,
                "bInfo": true,
                "bAutoWidth": true
            });
        //fill edit modal with values from table
        function edit(id, cat, user_id) {
            var data=table.fnGetData(id);
            $('#name').val(data[0]);
            $('#webmail').val(data[2]);
            $('#roll').val(data[1]);
            $('#books').html(data[3]);
            $('#fine').html(data[4]);
            $('#cat').val(cat);
            $('#user_id').val(user_id);
             row=id;
            $('#editModal').modal('show');
        }

        //view modal for delete confirmation
        function del(id, row_id) {
            row=row_id;
            $('#delbutt').val(id);
            $('#deleteModal').modal('show');
        }

        //submit values to edit database
        $('#edit').on('submit', function(e) {
            $('#editModal').modal('hide');
            e.preventDefault();
            $.ajax({
                url: '{{ route('func_edit') }}',
                method: 'POST',
                data: $('#edit').serialize() + "&table=user"
            })
                    .success(function (result) {
                        alert(result);
                        table.fnUpdate($('#name').val(),row,0);
                        table.fnUpdate($('#roll').val(),row,1);
                        table.fnUpdate($('#webmail').val(),row,2);
                        table.fnUpdate($('#cat').val(),row,5);
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        });

        //submit values to create the new user
        $('#new').on('submit', function(e) {
            $('#newModal').modal('hide');
            e.preventDefault();
            $.ajax({
                url: '{{ route('func_new') }}',
                method: 'POST',
                data: $('#new').serialize() + "&table=user"
            })
                    .success(function (result) {
                        alert(result);
                        location.reload();
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        });

        //delete user
        function del_send() {
            $('#deleteModal').modal('hide');
            $.ajax({
                url: '{{ route('func_del') }}',
                method: 'POST',
                data: {type: 'user', id: $('#delbutt').val() }
            })
                    .success(function (result) {
                        alert(result);
                        table.fnDeleteRow(row);
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        }

        //position modal in center of page
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
    @endsection