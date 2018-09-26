@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="title">{{$travel->travel}}</h1>
            <h4><span class="badge badge-dark">{{"{$travel->start_date} - {$travel->end_date}"}}</span></h4>
        </div>
        @foreach($statuses as $status)
        <div class="col-md-4">
            <div class="card bg-dark text-white">
                <div class="card-header">
                    @if($status->status == 'Pending')
                    <button class="btn btn-sm btn-light" data-toggle="modal" data-target="#taskModal"><i class="fas fa-plus"></i></button>
                    @endif
                    <strong>{{$status->status}}</strong>
                </div>
                <ul class="list-group list-group-flush text-dark">
                    @foreach($status->tasks as $task)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <form action="{{route('tasks.update', ['travel' => $travel, 'task' => $task])}}" method="post">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            @switch($task->status->status)
                            @case('Pending')
                            <input type="hidden" name="status_id" value="{{$statuses->where('status', 'Working')->first()->id}}">
                            @break
                            @case('Working')
                            <input type="hidden" name="status_id" value="{{$statuses->where('status', 'Done')->first()->id}}">
                            @break
                            @endswitch
                            <button class="btn btn-sm btn-dark"><i class="fas fa-check"></i></button>
                            {{$task->task}}
                        </form> 
                        <span class="badge badge-{{$task->color}}">{{$task->priority}} {{$task->created_at->timezone(Session::get('timezone'))}}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endforeach
        <div class="col-md-12 pb-5">
        </div>
        <div class="col-md-4">
            <div class="jumbotron bg-success">
                <h1 class="display-4">{{__('Visits')}}</h1>
                <hr class="my-4">
                <a class="btn btn-dark btn-lg" href="{{route('visits.index', $travel)}}" role="button">Learn more</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="jumbotron bg-warning">
                <h1 class="display-4">{{__('Trips')}}</h1>
                <hr class="my-4">
                <a class="btn btn-dark btn-lg" href="#" role="button">Learn more</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="jumbotron bg-danger">
                <h1 class="display-4">{{__('Expenses')}}</h1>
                <hr class="my-4">
                <a class="btn btn-dark btn-lg" href="#" role="button">Learn more</a>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('RegisterTask')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <form action="{{route('tasks.store', $travel)}}" method="post">
                <div class="modal-body">
                    {{csrf_field()}}
                    <input type="hidden" name="status_id" value="{{$statuses->where('status','Pending')->first()->id}}">
                    <div class="form-group">
                        <label for="">{{__('Task')}}</label>
                        <input type="text" name="task" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="">{{__('Priority')}}</label>
                        <select name="priority" class="form-control form-control-sm">
                            <option value="low">{{__('Low')}}</option>
                            <option value="medium" selected>{{__('Medium')}}</option>
                            <option value="high">{{__('High')}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">{{__('Description')}}</label>
                        <textarea rows="5" name="description" class="form-control form-control-sm"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection