<div>
<ul class="dashboard-stat-list">
    @foreach($truckList as $truck)
        <li>
        {{ $truck->name }}
        <span class="pull-right"><b>{{ $truck->plate_no }}</b></span>
        </li>
    @endforeach
</ul>
<!-- {{ $truckList->links() }} -->
</div>