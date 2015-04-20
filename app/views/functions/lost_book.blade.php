<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Book Details</h4>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="title" class="col-sm-2 control-label">Title</label>
        <div class="col-sm-5">
            <label class="control-label" style="font-weight: 500" id="title">{{ $book->title }}</label>
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="title" placeholder="Book Title" value="{{ $book->lostbook->title }}" required>
        </div>
    </div>
    <div class="form-group">
        <label for="authors" class="col-sm-2 control-label">Authors</label>
        <div class="col-sm-5">
            <label class="control-label" style="font-weight: 500" id="author">{{ $book->authors }}</label>
        </div>
        <div class="col-sm-5">
            <input type="text" class="form-control" name="authors" placeholder="Authors" value="{{ $book->lostbook->authors }}" required>
        </div>
    </div>
    <div class="form-group">
        <label for="publication" class="col-sm-2 control-label">Publication</label>
        <div class="col-sm-5">
            <label class="control-label" style="font-weight: 500" id="publication">{{ $book->publication->name }}</label>
        </div>
        <div class="col-sm-5">
            <select class="form-control" name="publication">
                @foreach(Publication::orderBy('name')->get() as $pubs)
                    @if($pubs->id == $book->lostbook->publication)
                        <option value="{{ $pubs->id }}" selected>{{ $pubs->name }}</option>
                    @else
                        <option value="{{ $pubs->id }}">{{ $pubs->name }}</option>
                    @endif
                    @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="isbn" class="col-sm-2 control-label">ISBN</label>
        <div class="col-sm-5">
            <label class="control-label" style="font-weight: 500" id="isbn">{{ $book->ISBN }}</label>
        </div>
        <div class="col-sm-5">
            <input type="number" class="form-control" name="isbn" placeholder="ISBN No" value="{{ $book->lostbook->ISBN }}" required>
        </div>
    </div>
</div>
<input type="hidden" name="code" value="{{ $book->id }}">
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <input type="submit" class="btn btn-primary" onclick="ret_lost()"  value="Update Details">
</div>