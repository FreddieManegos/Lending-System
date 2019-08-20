@foreach($customers as $customer)
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" id="view-loans-{{$customer->id}}">
        <div class="modal-dialog modal-" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Loans List</h2>
                    <p>
                        Customer Name : <strong>{{$customer->last_name}}, {{$customer->first_name}}</strong> <br>
                        Date Created : <strong>{{$customer->created_at->diffForHumans()}}</strong> <br>
                    </p>
                </div>
                <div class="modal-body">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th> Date Created </th>
                            <th> Total Loan </th>
                            <th> Amount Loaned </th>
                            <th> Per day</th>
                            <th> Status </th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($customer->loan != [])
                         @foreach($customer->loan->sortBy('is_paid') as $loan)
                            <tr>
                                <td scope="row">{{$loan->id}}</td>
                                <td> {{$loan->created_at->toDateString()}}</td>
                                <td>{{$loan->total_loan}}</td>
                                <td>{{$loan->amount_loaned}}</td>
                                <td>{{$loan->daily_payment}}</td>
                                @if($loan->is_paid == 1)
                                    <td style="color:green;">Paid</td>
                                @else
                                    <td style="color: red;">Not Paid</td>
                                @endif
                                <td>
                                    <a href="loan\{{$loan->id}}"><button class="btn btn-success"><i class="fa fa-fw fa-eye"></i></button></a>
                                    <a href="customer\pdf\{{$loan->id}}" target="_blank" ><button class="btn btn-warning"><i class="fa fa-fw fa-print"></i></button></a>
                                </td>

                            </tr>
                         @endforeach
                            </tbody>
                        @else
                            <p style="text-align: center">Nothing to Show!</p>
                        @endif
                        </table>
                </div>
            </div>
        </div>
    </div>
@endforeach
