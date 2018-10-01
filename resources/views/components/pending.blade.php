<div class="col-md-4 pb-4">
    <div class="card bg-dark text-white">
        <div class="card-header pl-0 py-1">
            <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#taskModal"><i class="fas fa-plus"></i></button>
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
                            <a class="dropdown-item task-update" data-status="{{$task->status->status}}" href="{{route('tasks.update', ['travel' => $travel, 'task' => $task])}}">@lang('string.working')</a>
                            <a class="dropdown-item" href="{{route('tasks.show', ['travel' => $travel, 'task' => $task])}}">@lang('string.show')</a>
                            <a class="dropdown-item" href="{{route('tasks.edit', ['travel' => $travel, 'task' => $task])}}">@lang('string.edit')</a>
                            <a class="dropdown-item delete" href="{{route('tasks.destroy', ['travel' => $travel, 'task' => $task])}}">@lang('string.delete')</a>
                        </div>
                    </div>
                </div>
                <span class="badge badge-{{$task->class_color}}">{{$task->priority}}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>