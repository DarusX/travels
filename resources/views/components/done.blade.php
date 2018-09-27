<div class="col-md-4">
    <div class="card bg-dark text-white">
        <div class="card-header">
            <strong>{{$status->status}}</strong>
        </div>
        <ul class="list-group list-group-flush text-dark">
            @foreach($status->tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{$task->task}}
                <span class="badge badge-{{$task->color}}">{{$task->priority}}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>