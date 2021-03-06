<div class="col-md-4 pb-4">
    <div class="card bg-dark text-white">
        <div class="card-header pl-4 py-1">
            <strong>{{$status->status}}</strong>
        </div>
        <ul class="list-group list-group-flush text-dark">
            @foreach($status->tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center py-0 pl-0 bg-light">
                <div>
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle dropdown-dots" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        {{$task->task}}
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('tasks.show', ['travel' => $travel, 'task' => $task])}}">@lang('string.show')</a>
                            <a class="dropdown-item" href="{{route('tasks.edit', ['travel' => $travel, 'task' => $task])}}">@lang('string.edit')</a>
                            <a class="dropdown-item delete" href="{{route('tasks.destroy', ['travel' => $travel, 'task' => $task])}}">@lang('string.delete')</a>
                        </div>
                    </div>
                </div>
                <span class="badge badge-{{$task->class_color}}"><i class="fas fa-info-circle"></i> {{$task->priority}}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>