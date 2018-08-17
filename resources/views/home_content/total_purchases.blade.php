<div class="sparkline" data-type="line" data-spot-Radius="4" data-highlight-Spot-Color="rgb(233, 30, 99)" data-highlight-Line-Color="#fff" data-min-Spot-Color="rgb(255,255,255)" data-max-Spot-Color="rgb(255,255,255)" data-spot-Color="rgb(255,255,255)" data-offset="90" data-width="100%" data-height="75px" data-line-Width="2" data-line-Color="rgba(255,255,255,0.7)" data-fill-Color="rgba(0, 188, 212, 0)">
@foreach($latestPurchases as $purchase)
    {{ $purchase->total.' ,' }}
@endforeach
</div>
<ul class="dashboard-stat-list">
@foreach($topCommodities as $commodity)
<li>
    @foreach($commodity->commodityName as $comName)
        {{$comName->name}}
    @endforeach
    <span class="pull-right"><b>&#8369; {{ number_format($commodity->total, 2, '.', ',') }}</b></span>
</li>
@endforeach
</ul>