@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        @breadcrumb(['travel' => $task->travel])
        @endbreadcrumb
        <div class="col-sm-12">
            <h2 class="title">{{$task->task}} <span class="badge badge-{{$task->class_color}}">{{$task->priority}}</span></h2>
            @isset($task->description)
            <p>{{$task->description}}</p>
            @endisset
        </div>
        <div class="col-sm-12">
            <form action="{{route('comments.store', ['travel' => $task->travel, 'task' => $task])}}" method="post">
                {{csrf_field()}}
                <label for="basic-url">@lang('string.comment')</label>
                <div class="input-group mb-3">
                    <input type="text" name="comment" class="form-control">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> @lang('button.save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        @foreach($task->comments as $comment)
        <div class="col-sm-3">
            <div class="card bg-light">
                <div class="card-body d-flex justify-content-between align-items-center py-0 pl-0">
                    <div>
                        <a class="btn btn-light delete" href="{{route('comments.destroy', ['travel' => $task->travel, 'task' => $task, 'comment' => $comment])}}"><i class="fas fa-trash"></i></a> {{$comment->comment}}
                    </div>
                    <span class="badge badge-dark">{{$comment->created_at->timezone(Session::get('timezone'))->format('d-m-Y H:i')}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection