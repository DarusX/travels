@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="title">{{$travel->travel}}</h1>
            <h4><span class="badge badge-dark">{{"{$travel->start_date} - {$travel->end_date}"}}</span></h4>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{asset('images/visits.jpg')}}" alt="Card image cap">
                <div class="card-img-overlay text-white">
                    <h2 class="title">{{__('ToDo')}}</h2>
                    <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#activityModal">
                        {{__('Register')}}
                    </button>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                </div>
            </div>
        </div>
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
@endsection