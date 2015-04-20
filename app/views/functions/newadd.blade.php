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
				        </tbody>
				    </table>
				</div>
				<div class="modal-footer">
				    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>