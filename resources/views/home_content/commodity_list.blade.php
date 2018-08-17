<div>
<ul class="dashboard-stat-list">
    @foreach($commodityList as $commodity)
        <li>
        {{ $commodity->name }}
        <span class="pull-right"><b>&#8369; {{ number_format($commodity->price, 2, '.', ',') }}</b> <small>&#8369; {{ number_format($commodity->suki_price, 2, '.', ',') }}</small></span>
        </li>
    @endforeach
</ul>
<!-- {{ $commodityList->links() }} -->
</div>