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
             New ADD
            <small>it starts here</small>
        </h1>
        
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Books Details</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <table id="table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Publication</th>
                                <th>Edition</th>
                                <th>Votes</th>
                                <th class="col-md-1">Edit/Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach(NewAdd::all() as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->publication }}</td>
                                    <td>{{ $book->edition }}</td>
                                    <td>{{ $book->votes }}</td>
                                    <td><div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-info" onclick="edit({{ $i }}, {{ $book->id}})" >Edit</button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="del({{ $book->id }},{{ $i }})">Delete</button>
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
    <!--  Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="form-horizontal" role="form" id="edit">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Change Details</h4>
                </div>
                <div class="modal-body">
                    
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">Title:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Author:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="author" id="author" placeholder="Enter Authors" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Publication:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="publication" id="publication" placeholder="Enter Book Publication" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Edition:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="edition" id="edition" placeholder="Enter Edition" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Votes</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="votes" id="votes" placeholder="Enter Votes" required>
                            </div>
                        </div>
                     <input type="hidden" id="new_id" name="id" value="">    
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
       </form>
        </div>
    </div>

    <!-- Modal -->
    
    <!--Delete Pop-up-->
    <div class="modal fade modal-danger" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p style="font-size: x-large">Do you really want to delete this Book ?</p>
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
        var table=$('#table').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true
        });
        //            $('.edit').click(alert('hi'));
        function edit(id,book_id) {
//         
            var data=table.fnGetData(id);
            $('#title').val(data[0]);
            $('#author').val(data[1]);
            $('#publication').val(data[2]);
            $('#edition').val(data[3]);
            $('#votes').val(data[4]);
            $('#new_id').val(book_id);
            row = id;            
            $('#editModal').modal('show');
        }

        $('#edit').on('submit', function(e) {
            $('#editModal').modal('hide');
            e.preventDefault();
            $.ajax({
                url: '{{ route('func_edit') }}',
                method: 'POST',
                data: $('#edit').serialize() + "&table=new"
            })
                    .success(function (result) {
                        alert(result);
                        table.fnUpdate($('#title').val(),row,0);
                        table.fnUpdate($('#author').val(),row,1);
                        table.fnUpdate($('#publication').val(),row,2);
                        table.fnUpdate($('#edition').val(),row,3);
                        table.fnUpdate($('#votes').val(),row,4);
                        
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
                data: {type: 'new', id: $('#delbutt').val() }
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