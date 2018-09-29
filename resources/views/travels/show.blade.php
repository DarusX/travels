@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        @breadcrumb(['travel' => $travel])
        @endbreadcrumb
        @foreach($statuses as $status)
            @switch($status->status)
                @case('Pending')
                    @pending(['status' => $status, 'travel' => $travel])
                    @endpending
                @break
                @case('Working')
                    @working(['status' => $status, 'travel' => $travel])
                    @endworking
                @break
                @case('Done')
                    @done(['status' => $status, 'travel' => $travel])
                    @enddone
                @break
            @endswitch
        @endforeach
        <div class="col-md-12 pb-5">
        </div>
        <div class="col-md-4">
            <div class="jumbotron bg-success">
                <h1 class="display-4">{{__('Visits')}}</h1>
                <hr class="my-4">
                <a class="btn btn-dark btn-lg" href="{{route('visits.index', $travel)}}" role="button">@lang('button.show_more')</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="jumbotron bg-warning">
                <h1 class="display-4">{{__('Trips')}}</h1>
                <hr class="my-4">
                <a class="btn btn-dark btn-lg" href="#" role="button">@lang('button.show_more')</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="jumbotron bg-danger">
                <h1 class="display-4">{{__('Expenses')}}</h1>
                <hr class="my-4">
                <a class="btn btn-dark btn-lg" href="#" role="button">@lang('button.show_more')</a>
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