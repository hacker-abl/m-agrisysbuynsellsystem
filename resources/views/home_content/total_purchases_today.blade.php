
<ul class="dashboard-stat-list">
    @foreach($topCommoditiesToday as $commodity)
    <li>
        @foreach($commodity->commodityName as $comName)
            {{$comName->name}}
        @endforeach
        <span class="pull-right"><b>&#8369; {{ number_format($commodity->total, 2, '.', ',') }}</b></span>
    </li>
    @endforeach
</ul>