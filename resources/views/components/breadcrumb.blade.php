<div class="col-sm-12">
    <h1 class="title">{{$travel->travel}}</h1>
    <h4>
        <span class="badge badge-dark"><i class="fas fa-calendar"></i> {{"{$travel->start_datetime->format('D, M d, Y H:i')} - {$travel->end_datetime->format('D, M d, Y H:i')}"}}</span>
        <span class="badge badge-dark"><i class="fas fa-calendar"></i> {{$travel->start_datetime->timezone(Session::get('timezone'))->diffForHumans()}}</span>
    </h4>
</div>
<div class="col-md-12">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('travels.show', $travel)}}"><i class="fas fa-caret-right"></i> {{$travel->travel}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('visits.index', $travel)}}"><i class="fas fa-caret-right"></i> @lang('string.visits')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('trips.index', $travel)}}"><i class="fas fa-caret-right"></i> @lang('string.trips')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('expenses.index', $travel)}}"><i class="fas fa-caret-right"></i> @lang('string.expenses')</a>
            </li>
        </ol>
    </nav>
</div>