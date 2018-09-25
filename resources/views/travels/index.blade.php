@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">{{__('Travels')}}</h1>
        </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>{{__('Travel')}}</th>
                        <th>{{__('Budget')}}</th>
                        <th>{{__('StartDate')}}</th>
                        <th>{{__('EndDate')}}</th>
                        <th>{{__('Actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($travels as $travel)
                    <tr>
                        <td>{{$travel->travel}}</td>
                        <td>{{number_format($travel->budget, 2)}}</td>
                        <td>{{$travel->start_date}}</td>
                        <td>{{$travel->end_date}}</td>
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