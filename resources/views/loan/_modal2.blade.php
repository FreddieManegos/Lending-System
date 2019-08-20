@foreach($paid_loans as $loan)
    <div class="modal" tabindex="-1" role="dialog" id="delete2-{{$loan->id}}">
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

    <div class="modal" tabindex="-1" role="dialog" id="edit2-{{$loan->id}}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"><h3>Edit <{{$loan->customer->last_name}}, {{$loan->customer->first_name}}></h3></div>
                <div class="modal-body">
                    <p><{{$loan->customer->last_name}}, {{$loan->customer->first_name}}></p>
                    <table class="table" id="tblCustomers">
                    </table>
                </div>
            </div>
        </div>
    </div>
@endforeach
