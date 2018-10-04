@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">@lang('string.travels')</h1>
        </div>
        @foreach(Auth::user()->travels as $travel)
        <div class="col-md-4">
            <div class="card bg-borboleta">
                <div class="card-body">
                    <h5 class="card-title title">{{$travel->travel}}</h5>
                    <p class="card-text">{{$travel->start->format('D, d M, Y')}} <i class="fas fa-arrow-right"></i> {{$travel->end->format('D, d M, Y')}}</p>
                    <p class="card-text">{{$travel->start->diffForHumans()}}</p>
                    <a href="{{route('travels.show', $travel)}}" class="btn btn-dark">@lang('button.show_more')</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection