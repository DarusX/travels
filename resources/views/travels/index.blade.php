@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">@lang('string.travels')</h1>
        </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>@lang('string.travel')</th>
                        <th>@lang('string.budget')</th>
                        <th>@lang('string.start_datetime')</th>
                        <th>@lang('string.end_datetime')</th>
                        <th>@lang('string.actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($travels as $travel)
                    <tr>
                        <td>{{$travel->travel}}</td>
                        <td>{{number_format($travel->budget, 2)}}</td>
                        <td>{{$travel->start_datetime->timezone(Session::get('timezone'))->format('D, M d, Y, H:i')}}</td>
                        <td>{{$travel->end_datetime->timezone(Session::get('timezone'))->format('D, M d, Y, H:i')}}</td>
                        <td>
                            <a href="{{route('travels.show', $travel)}}" class="btn btn-sm btn-dark"><i class="fas fa-eye"></i></a>
                            <a href="{{route('travels.edit', $travel)}}" class="btn btn-sm btn-dark"><i class="fas fa-pen"></i></a>
                            <a href="{{route('travels.destroy', $travel)}}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection