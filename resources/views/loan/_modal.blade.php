@foreach($not_paid_loans as $loan)
    <div class="modal" tabindex="-1" role="dialog" id="delete-{{$loan->id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('loan.destroy', $loan->id) }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Loan:</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">Are you sure you want to delete Loan <<b>{{$loan->customer->last_name}}, {{ $loan->customer->first_name }}</b>>?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="edit-{{$loan->id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"><h3>Edit</h3></div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('loan.update', $loan->id) }}">
                    @csrf
                    @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="title">Collector:</label>
                                    <input type="text" class="form-control" id="loan_id"  name="loan_id" required value="{{$loan->id}}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="title">Collector:</label>
                                    <select class="form-control" name="collector_id" required>
                                        @foreach($collectors as $collector)
                                            @if($collector->id == $loan->collector->id)
                                                <option value="{{$collector->id}}" selected>{{$collector->name}}</option>
                                            @else
                                                <option value="{{$collector->id}}">{{$collector->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">First Name:</label>
                                    <input type="text" class="form-control" id="productName"  name="first_name" placeholder="First Name" required value="{{$loan->customer->first_name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Last Name:</label>
                                    <input type="text" class="form-control" id="productName"  name="last_name" placeholder="Last Name" required value="{{$loan->customer->last_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="title">Address:</label>
                            <input type="text" class="form-control" id="productName"  name="address" size="10" required value="{{$loan->customer->address}}">
                        </div>
                        <div class="form-group ">
                            <label for="title">Mobile Number:</label>
                            <input type="text" class="form-control" id="productName"  name="mobile_no" size="10" value="{{$loan->customer->mobile_no}}" >
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" data-dismiss="modal" class="btn btn-secondary">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="reloan-{{$loan->id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"><h3>Overdue Reloan</h3></div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
@endforeach
