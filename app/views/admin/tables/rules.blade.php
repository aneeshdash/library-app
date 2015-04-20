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
            CSE Dept Library Rules
            <small>it starts here</small>
        </h1>
        <button class="btn btn-primary btn-md" style="margin-top: 1%" data-toggle="modal" data-target="#newModal">+ Add Rule</button>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Library Rules</h3>
                    </div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">Priority</th>
                                <th class="col-md-10">Rules</th>
                                <th class="col-md-1">Edit/Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach(Rules::all() as $rule)
                                <tr>
                                    <td>{{ $rule->priority }}</td>
                                    <td>{{ $rule->rule }}</td>
                                    <td><div class="btn-group">
                                            <button type="button" class="btn btn-info" onclick="edit({{ $i }},{{ $rule->id}})">Edit</button>
                                            <button type="button" class="btn btn-danger" onclick="del({{ $rule->id }},{{ $i }})">Delete</button>
                                        </div></td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            </tbody>
                            <tfoot>
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal" role="form" id="edit">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update</h4>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <label for="firstname" class="col-sm-3 control-label">Priority:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="priority" id="priority" placeholder="Change Priority" required>
                            </div>
                        </div>

                        <div class="form-group">
                             <label for="firstname" class="col-sm-3 control-label">Rule:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="rule" id="rule" placeholder="Update Rule" required>
                            </div>
                        </div>
                        
                    <input type="hidden" id="rule_id" name="id" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
             <form class="form-horizontal" role="form" id="new">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add New Rule</h4>
                </div>
                <div class="modal-body">
                   
                       <div class="form-group">
                        <label for="firstname" class="col-sm-3 control-label">Priority:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="priority" id="new-priority" placeholder="Priority" required>
                            </div>
                        </div>

                        <div class="form-group">
                             <label for="firstname" class="col-sm-3 control-label">Rule:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="rule" id="new-rule" placeholder="New Rule" required>
                            </div>
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Rule</button>
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
                    <h4 class="modal-title" id="myModalLabel">Delete Rule</h4>
                </div>
                <div class="modal-body">
                    <p style="font-size: x-large">Do you really want to delete this Rule ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline" value="" id="delbutt" onclick="del_send()" >Yes</button>
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
        var table=$('#table').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true
        });
        //            $('.edit').click(alert('hi'));
        function edit(id, rule_id) {
            var data=table.fnGetData(id);
            $('#priority').val(data[0]);
            $('#rule').val(data[1]);
            $('#rule_id').val(rule_id);
            row=id;
            $('#editModal').modal('show');
        }

        $('#edit').on('submit', function(e) {
            $('#editModal').modal('hide');
            e.preventDefault();
            $.ajax({
                url: '{{ route('func_edit') }}',
                method: 'POST',
                data: $('#edit').serialize() + "&table=rule"
            })
                    .success(function (result) {
                        alert(result);
                        table.fnUpdate($('#priority').val(),row,0);
                        table.fnUpdate($('#rule').val(),row,1);
                      
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        });

        $('#new').on('submit', function(e) {
            $('#newModal').modal('hide');
            e.preventDefault();
            $.ajax({
                url: '{{ route('func_new') }}',
                method: 'POST',
                data: $('#new').serialize() + "&table=rule"
            })
                    .success(function (result) {
                        alert(result);
                        location.reload();
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        });

        function del(id, row_id) {
            row = row_id;
            $('#delbutt').val(id);
            $('#deleteModal').modal('show');
        }

        function del_send() {
            $('#deleteModal').modal('hide');
            $.ajax({
                url: '{{ route('func_del') }}',
                method: 'POST',
                data: {type: 'rule', id: $('#delbutt').val() }
            })
                    .success(function (result) {
                        alert(result);
                        table.fnDeleteRow(row);
                    })
                    .fail(function () {
                        alert('There was an error. Please Try Again');
                    });
        }


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