@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        @breadcrumb(['travel' => $travel])
        @endbreadcrumb
        <div class="col-md-12">
            <h2 class="title">@lang('string.expenses')</h2>
        </div>
        <div class="col-sm-12">
            <form action="{{route('expenses.store', ['travel' => $travel])}}" method="post">
                {{csrf_field()}}
                <label for="basic-url">@lang('string.comment')</label>
                <div class="input-group mb-3">
                    <input type="text" name="expense" class="form-control" placeholder="@lang('string.expense')">
                    <input type="number" name="ammount" class="form-control" placeholder="@lang('string.ammount')">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-dark"><i class="fas fa-save"></i> @lang('button.save')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        @foreach($travel->expenses as $expense)
        <div class="col-sm-3">
            <div class="card bg-light">
                <div class="card-body d-flex justify-content-between align-items-center py-0 pl-0">
                    <div>
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle dropdown-dots" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            {{$expense->expense}}
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">@lang('string.show')</a>
                                <a class="dropdown-item" href="#">@lang('string.edit')</a>
                                <a class="dropdown-item delete" href="{{route('expenses.destroy', ['travel' => $travel, 'expense' => $expense])}}">@lang('string.delete')</a>
                            </div>
                        </div>
                    </div>
                    <span class="badge badge-dark">$ {{number_format($expense->ammount, 2)}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection