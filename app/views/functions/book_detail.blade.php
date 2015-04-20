<div class="modal-header" style="color:blue">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Book Details</h4>
</div>
<div class="modal-body">

    <table class="table table-hover">
        <tbody>
        <tr>
            <th>Name</th>
            <td>{{ $book->title }}</td>
        </tr>
        <tr>
            <th>Authors</th>
            <td>{{ $book->authors }}</td>
        </tr>
        <tr>
            <th>
                Edition
            </th>
            <td>
                {{ $book->edition }}
            </td>
        </tr>
        <tr>
            <th>
                Publication
            </th>
            <td>
                {{ $book->publication->name }}
            </td>
        </tr>
        <tr>
            <th>ISBN</th>
            <td>{{ $book->ISBN }}</td>
        </tr>
        <tr>
            <th>Book Code</th>
            <td>{{ $book->code }}</td>
        </tr>
        <tr>
            <th>Issue Date</th>
            <td>{{ $book->issue_date }}</td>
        </tr>
        <tr>
            <th>
                Return Date
            </th>
            <td>
                {{ $book->return_date }}
            </td>
        </tr>
        </tbody>
    </table>

</div>
<div class="modal-footer">
    @if($book->lost !== 1)
    <button type="button" class="btn btn-flat btn-info" onclick="ret({{ $book->id  }})">Return</button>
    <button type="button" class="btn btn-flat btn-warning" onclick="reissue({{ $book->id  }})">Reissue</button>
    @else
    <button type="button" class="btn btn-flat  btn-danger" onclick="lost({{ $book->id }})">Return Lost Book</button>
    @endif
    <button type="button" class="btn btn-flat btn-danger" data-dismiss="modal">Close</button>
</div>