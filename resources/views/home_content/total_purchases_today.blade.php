<div class="container">
<br>
<table class="table table-striped">
    <thead>
        <tr>
            <th>COMMODITY</th>
            <th>NET WEIGHT (Kilos)</th>
            <th>TOTAL PRICE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($topCommoditiesToday as $commodity)
        <tr>
            <td>
                @foreach($commodity->commodityName as $comName)
                    <span>{{$comName->name}}</span>
                @endforeach
            </td>
            <td>
            <span>{{$commodity->net}}</span>
            </td>
            <td>
            <span><b>&#8369; {{ number_format($commodity->total, 2, '.', ',') }}</b></span>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="text-danger">
            <th>TOTAL</th>
            <th>{{$topCommoditiesTodayTotals['net']}}</th>
            <th>&#8369; {{number_format($topCommoditiesTodayTotals['total'], 2, '.', ',')}}</th>
        </tr>
    </tfoot>
</table>
</div>
