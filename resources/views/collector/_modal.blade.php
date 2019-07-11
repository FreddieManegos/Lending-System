<div class="modal" tabindex="-1" role="dialog" id="add_collector">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('collector.store') }}" enctype="multipart/form-data" >
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Create Collector:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label class="col-3">Name:</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required placeholder="Name" autocomplete="off">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($collectors as $collector)

<div class="modal" tabindex="-1" role="dialog" id="delete-{{$collector->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('collector.destroy', $collector->id) }}">
                @csrf
                @method('DELETE')

                <div class="modal-header">
                    <h5 class="modal-title">Delete Employee:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Are you sure you want to delete Collector <<b>{{ $collector->name }}</b>>?</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
