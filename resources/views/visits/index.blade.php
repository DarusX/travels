@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            @breadcrumb(['travel' => $travel])
            @endbreadcrumb
        </div>
        <div class="col-sm-12">
            <h1 class="title">{{$travel->travel}}</h1>
            <h4><span class="badge badge-dark">{{"{$travel->start_date} - {$travel->end_date}"}}</span></h4>
        </div>
        <div class="col-md-8">
            <div class="embed-responsive embed-responsive-16by9">
                <div class="embed-responsive-item" id="map-show"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="{{asset('images/visits.jpg')}}" alt="Card image cap">
                <div class="card-img-overlay text-white">
                    <h2 class="title">{{__('Visits')}}</h2>
                    <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#visitModal">
                        {{__('Register')}}
                    </button>
                </div>
                <ul class="list-group list-group-flush text-dark">
                    @foreach($travel->visits as $visit)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{$visit->name}}
                        <span class="badge badge-dark">{{$visit->start_datetime->timezone(Session::get('timezone'))}}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="row pt-5">
        <div class="col-md-8">
            <div class="embed-responsive embed-responsive-16by9">
                <div id="scheduler_here" class="dhx_cal_container embed-responsive-item">
                    <div class="dhx_cal_navline">
                        <div class="dhx_cal_prev_button">&nbsp;</div>
                        <div class="dhx_cal_next_button">&nbsp;</div>
                        <div class="dhx_cal_today_button"></div>
                        <div class="dhx_cal_date"></div>
                        <div class="dhx_cal_tab" name="day_tab" style="right:204px;"></div>
                        <div class="dhx_cal_tab" name="week_tab" style="right:140px;"></div>
                        <div class="dhx_cal_tab" name="month_tab" style="right:76px;"></div>
                    </div>
                    <div class="dhx_cal_header"></div>
                    <div class="dhx_cal_data"></div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="visitModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('RegisterVisit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <form action="{{route('visits.store', $travel)}}" method="post">
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-4by3">
                        <div class="embed-responsive-item" id="map"></div>
                    </div>
                    {{csrf_field()}}
                    <input type="hidden" name="latitude">
                    <input type="hidden" name="longitude">
                    <div class="form-group">
                        <label for="">{{__('Name')}}</label>
                        <input type="text" name="name" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="">{{__('Address')}}</label>
                        <input type="text" name="address" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="">{{__('StartDateTime')}} {{Session::get('timezone')}}</label>
                        <div class="input-group">
                            <input type="text" name="start_date" class="form-control form-control-sm datepicker"
                                required>
                            <input type="time" name="start_time" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">{{__('EndDateTime')}} {{Session::get('timezone')}}</label>
                        <div class="input-group">
                            <input type="text" name="end_date" class="form-control form-control-sm datepicker" required>
                            <input type="time" name="end_time" class="form-control form-control-sm" required>
                        </div>
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
@section('css')
<link rel="stylesheet" href="{{asset('lib/dhtmlx/scheduler/dhtmlxscheduler_material.css')}}">
<style>
    .datepicker {
        z-index: 1600 !important;
    }
</style>
@endsection
@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6--aTCfHnIWexIQGMs9VvTMVAnrvVwRE&language=es"></script>
<script src="{{asset('lib/dhtmlx/scheduler/dhtmlxscheduler.js')}}"></script>
<script>
    var map
    var mapShow
    var events = []
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        changeYear: true,
        minDate: new Date(Date.parse("{{str_replace('-', '/', $travel->start_date)}}")),
        maxDate: new Date(Date.parse("{{str_replace('-', '/', $travel->end_date)}}"))
    })

    initMap()
    function initMap() {
        var geocoder = new google.maps.Geocoder
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 0, lng: 0 },
            zoom: 2
        });
        mapShow = new google.maps.Map(document.getElementById('map-show'), {
            center: { lat: 0, lng: 0 },
            zoom: 2
        });
        map.addListener('click', function (event) {
            $("input[name='latitude']").val(event.latLng.lat())
            $("input[name='longitude']").val(event.latLng.lng())
            geocoder.geocode({
                location: event.latLng
            }, function (results, status) {
                if (status === "OK") {
                    $("#visitModal").find("input[name='address']").val(results[0].formatted_address)
                } else {
                    $("#visitModal").find("input[name='address']").val("")
                }
            })
        })
    }
    scheduler.init('scheduler_here', new Date(), "month");
    
</script>
@foreach($travel->visits as $visit)
<script>
    new google.maps.Marker({
        position: new google.maps.LatLng("{{$visit->latitude}}", "{{$visit->longitude}}"),
        map: mapShow,
        title: "{{$visit->name}}"
    })
    events.push({
        id: "{{$visit->id}}",
        text: "{{$visit->name}}",
        start_date: "{{$visit->start_datetime->timezone(Session::get('timezone'))->format('m/d/Y H:i')}}",
        end_date: "{{$visit->end_datetime->timezone(Session::get('timezone'))->format('m/d/Y H:i')}}"
    })
    scheduler.parse(events, "json");
</script>
@endforeach

@endsection