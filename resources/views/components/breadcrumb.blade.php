<div class="col-sm-12">
    <h1 class="title">{{$travel->travel}}</h1>
    <h4>
        <span class="badge badge-dark">{{"{$travel->start_date->format('D, M d, Y')} - {$travel->end_date->format('D, M d, Y')}"}}</span>
        <span class="badge badge-dark">{{$travel->start_date->diffForHumans()}}</span>
    </h4>
</div>
<div class="col-md-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('travels.show', $travel)}}"><i class="fas fa-globe"></i> {{$travel->travel}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('visits.index', $travel)}}"><i class="fas fa-map-marker"></i> @lang('string.visits')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('visits.index', $travel)}}"><i class="fas fa-road"></i> @lang('strings.trips')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('visits.index', $travel)}}"><i class="fas fa-coins"></i> @lang('strings.expenses')</a>
            </li>
        </ol>
    </nav>
</div>