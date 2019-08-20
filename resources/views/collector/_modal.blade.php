<div class="modal" tabindex="-1" role="dialog" id="add_collector">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('collector.store') }}" enctype="multipart/form-data" >
                @csrf
                <div class="modal-header">
                    <h2 class="modal-title">Create Collector</h2>
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
                    <h2 class="modal-title">Delete Employee</h2>
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

<div class="modal" tabindex="-1" role="dialog" id="edit-{{$collector->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('collector.update', $collector->id) }}">
                @csrf
                @method('PATCH')

                <div class="modal-header">
                    <h2 class="modal-title">Edit Employee</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$collector->name}}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Update</button>
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="view-clients-{{$collector->id}}">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-10">
                        <h2>Clients List</h2>
                    </div>
                </div>
            </div>
            <div class="modal-body">
            <table class="display myTable" >
                @if($collector->loan != '[]')
                <thead>
                <tr>
                    <th scope="col">Loan #</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Balance</th>
                    <th scope="col">Total Loan</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($collector->loan as $loan)
                    <tr>
                        <th scope="row">{{$loan->customer['id']}}</th>
                        <td>{{$loan->customer['first_name']}}</td>
                        <td>{{$loan->customer['last_name']}}</td>
                        <td>{{$loan->balance}}</td>
                        <td>{{$loan->total_loan}}</td>
                        <td><a href="{{route('loan.show',$loan->id)}}"><button class="btn btn-warning">View Loan</button></a></td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                    <p style="text-align: center;">Nothing to show</p>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="print-{{$collector->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-header">
            <div class="row">
                <div class="col-md-10">
                    <h2>Print Collection</h2>
                </div>
            </div>
        </div>
        <div class="modal-content">

        </div>
    </div>
</div>
@endforeach


