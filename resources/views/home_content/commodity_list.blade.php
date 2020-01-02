<div>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Regular Price</th>
            <th>Discounted Price</th>
        </tr>
        </thead>
        <tbody>

    @foreach($commodityList as $commodity)
        <tr>
            <td>{{ $commodity->name }}</td>
            <td><b>&#8369; {{ number_format($commodity->price, 2, '.', ',') }}</b></td>
            <td>&#8369; {{ number_format($commodity->suki_price, 2, '.', ',') }}</td>
        </tr>
    @endforeach
        </tbody>
    </table>
</div>