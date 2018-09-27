<div class="col-md-4">
    <div class="card bg-dark text-white">
        <div class="card-header">
            <button class="btn btn-sm btn-light" data-toggle="modal" data-target="#taskModal"><i class="fas fa-plus"></i></button>
            <strong>{{$status->status}}</strong>
        </div>
        <ul class="list-group list-group-flush text-dark">
            @foreach($status->tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <form action="{{route('tasks.update', ['travel' => $travel, 'task' => $task])}}" method="post">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <input type="hidden" name="status_id" value="{{App\Status::whereStatus('Working')->first()->id}}">
                    <button class="btn btn-sm btn-dark"><i class="fas fa-check"></i></button>
                    {{$task->task}}
                </form>
                <span class="badge badge-{{$task->color}}">{{$task->priority}}</span>
            </li>
            @endforeach
        </ul>
    </div>
</div>