<div class="body">
    <div class="table-responsive">
        <table class="table table-hover dashboard-task-infos">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Reason</th>
                    <th>Amount</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 1; ?>
                @foreach($cashAdvanceToday as $cashAdvance)
                    <tr>
                        <td>{{ $count }}</td>
                        <td>
                            {{$cashAdvance->customer->fname.' '.$cashAdvance->customer->mname.' '.$cashAdvance->customer->lname}}
                        </td>
                        <td>{{ $cashAdvance->reason }}</td>
                        <td>&#8369; {{ number_format($cashAdvance->amount, 2, '.', ',') }}</td>
                        <td>&#8369; {{ number_format($cashAdvance->balance, 2, '.', ',') }}</td>
                    </tr>
                    <?php $count++; ?>
                @endforeach
            </tbody>
        </table>
        <!-- {{ $paymentLogs->links() }} -->
    </div>
</div>