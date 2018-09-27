<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('travels.show', $travel)}}"><i class="fas fa-globe"></i> {{$travel->travel}}</a></li>
        <li class="breadcrumb-item"><a href="{{route('visits.index', $travel)}}"><i class="fas fa-map-marker"></i> Visits</a></li>
        <li class="breadcrumb-item"><a href="{{route('visits.index', $travel)}}"><i class="fas fa-road"></i> Trips</a></li>
        <li class="breadcrumb-item"><a href="{{route('visits.index', $travel)}}"><i class="fas fa-coins"></i> Expenses</a></li>
    </ol>
</nav>