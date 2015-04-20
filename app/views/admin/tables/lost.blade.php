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
            Lost Books Table
            <small>it starts here</small>
        </h1>
        <button class="btn btn-primary btn-md" style="margin-top: 1%" onclick="add()">+ Add Lost Book</button>
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
                                <th>ID</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Code</th>
                                <th>ISBN</th>
                                <th>EDN</th>
                                <th> PUB</th>
                                <th>Status</th>
                                <th class="col-md-1">Edit/Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i=0; ?>
                            @foreach(LostBook::all() as $book)
                                <tr>
                                    <td>{{$book->book_id}}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->authors }}</td>
                                    <td>{{ $book->code }}</td>
                                    <td>{{ $book->ISBN}}</td>
                                    <td>{{ $book->edition }}</td>
                                    <td>{{ $book->publication }}</td>
                                    <td>{{$book->status}}</td>
                                    <td><div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-info" onclick="edit({{ $i }}, this.id)" id="BTECH">Edit</button>
                                            <button type="button" class="btn btn-sm btn-danger" onclick="del({{ $book->id }})">Delt</button>
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
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Change Book Details</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">Book ID:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="name" placeholder="Enter book_id" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">Title:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" placeholder="Enter Title" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Authors:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="webmail" placeholder="Enter Authors" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Code:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="roll" placeholder="Enter Book Code" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">ISBN</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="roll" placeholder="Enter ISBN" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Publication</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="roll" placeholder="Enter Publication" required>
                            </div>
                        </div>
                        <<div class="form-group">
                            <button type="radio" class="col-md-3 btn-lg btn-primary">requested</button>
                            <button type="radio" class="col-md-3 btn-lg btn-success">updated</button>
                            <button type="radio" class="col-md-3 btn-lg btn-info">accepted</button>
                            <button type="radio" class="col-md-3 btn-lg btn-warning">rejected</button>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Lost Book</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">Title:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" placeholder="Enter Title" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Authors:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="webmail" placeholder="Enter Authors" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Code:</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="roll" placeholder="Enter Book Code" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">ISBN</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="roll" placeholder="Enter ISBN" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Publication</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="roll" placeholder="Enter Publication" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="radio" class="col-md-3 btn-lg btn-primary">requested</button>
                            <button type="radio" class="col-md-3 btn-lg btn-success">updated</button>
                            <button type="radio" class="col-md-3 btn-lg btn-info">accepted</button>
                            <button type="radio" class="col-md-3 btn-lg btn-warning">rejected</button>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
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
                    <button type="button" class="btn btn-outline">Yes</button>
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
        function edit(id, cat) {
//            var row=$(this).attr('id').val();
//            alert(id);
            var data=table.fnGetData(id);
            $('#name').val(data[0]);
            $('#webmail').val(data[2]);
            $('#roll').val(data[1]);
            $('#books').html(data[3]);
            $('#fine').html(data[4]);
            $('#cat').val(cat)
//            alert(cat);
            $('#editModal').modal('show');
        }

        function add() {
            $('#newModal').modal('show');
        }

        function del(id) {
            $('#deleteModal').modal('show');
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