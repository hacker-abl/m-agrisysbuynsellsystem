<div>
    <table id="payment-logs-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Payment Method</th>
                <th>Amount</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1;?>
            @foreach($paymentLogs as $payment)
                <tr>
                    <td>{{ $count }}</td>
                    <td>
                    @foreach($payment->customerName as $customer)
                        {{$customer->fname.' '.$customer->mname.' '.$customer->lname}}
                    @endforeach
                    </td>
                    <td>{{ $payment->paymentmethod }}</td>
                    <td>&#8369; {{ number_format($payment->paymentamount, 2, '.', ',') }}</td>
                    <td>{{ date('F d, Y', strtotime($payment->created_at )) }}</td>
                </tr>
                <?php $count++;?>
            @endforeach
        </tbody>
    </table>
    <!-- {{ $paymentLogs->links() }} -->
</div>