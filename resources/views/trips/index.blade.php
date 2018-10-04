@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        @breadcrumb(['travel' => $travel])
        @endbreadcrumb
        <div class="col-md-12">
            <h2 class="title">@lang('string.trips')</h2>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-dark text-white pl-0 py-1">
                    <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#tripModal"><i class="fas fa-plus"></i></button>
                    <strong>@lang('string.trips')</strong>
                </div>
                <ul class="list-group list-group-flush text-dark">
                    @foreach($travel->trips as $trip)
                    <li class="list-group-item d-flex justify-content-between align-items-center py-0 pl-0 bg-light">
                        <div>
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle dropdown-dots" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                {{$trip->trip}}
                                <div class="dropdown-menu">
                                    <a class="dropdown-item delete" href="{{route('trips.destroy', ['travel' => $travel, 'trip' => $trip])}}">@lang('string.delete')</a>
                                </div>
                            </div>
                        </div>
                        <span class="badge badge-dark">{{$trip->start->format('D, M d, Y, H:i')}}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-12 pb-5">
                    <div class="embed-responsive embed-responsive-16by9">
                        <div class="embed-responsive-item" id="map-show"></div>
                    </div>
                </div>
                <div class="col-md-12">
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
    </div>
</div>

<div class="modal fade" id="tripModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('RegisterVisit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <form action="{{route('trips.store', $travel)}}" method="post">
                <div class="modal-body">
                    <div class="embed-responsive embed-responsive-4by3">
                        <div class="embed-responsive-item" id="map"></div>
                    </div>
                    {{csrf_field()}}
                    <input type="hidden" name="start_latitude">
                    <input type="hidden" name="start_longitude">
                    <input type="hidden" name="end_latitude">
                    <input type="hidden" name="end_longitude">
                    <div class="form-group">
                        <label for="">@lang('string.trip')</label>
                        <input type="text" name="trip" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="">@lang('string.start_datetime') {{Session::get('timezone')}}</label>
                        <div class="input-group">
                            <input type="text" name="start_datetime" class="form-control form-control-sm datetimepicker" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">@lang('string.end_datetime') {{Session::get('timezone')}}</label>
                        <div class="input-group">
                            <input type="text" name="end_datetime" class="form-control form-control-sm datetimepicker" required readonly>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal"> @lang('button.close')</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> @lang('button.save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('css')
<link rel="stylesheet" href="{{asset('lib/dhtmlx/scheduler/dhtmlxscheduler_terrace.css')}}">
<style>
    .datetimepicker {
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
    var addresses = {start: "", end: ""}
    var color
    var bounds = new google.maps.LatLngBounds()
    initMap()
    $(".datetimepicker").datetimepicker({
        dateFormat: "yy-mm-dd",
        minDate: new Date(Date.parse("{{$travel->start->format('Y/m/d')}}")),
        maxDate: new Date(Date.parse("{{$travel->end->format('Y/m/d')}}"))
    })
    function initMap() {
        var geocoder = new google.maps.Geocoder
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 0, lng: 0 },
            zoom: 2,
            minZoom: 2,
            gestureHandling: "greedy",
        });
        mapShow = new google.maps.Map(document.getElementById('map-show'), {
            center: { lat: 0, lng: 0 },
            zoom: 2,
            minZoom: 2,
            gestureHandling: "greedy"
        });
        start = new google.maps.Marker({
            position: new google.maps.LatLng(0,0),
            map: map,
            draggable: true,
            label: "A",
            title: "@lang('string.start')"
        }).addListener('dragend', function (event) {
           $("input[name='start_latitude']").val(event.latLng.lat())
           $("input[name='start_longitude']").val(event.latLng.lng())
           geocoder.geocode({
                location: event.latLng
            }, function (results, status) {
                if (status === "OK") {
                    $.each(results[0].address_components, (i, component) => {
                        $.each(component.types, (j, type) => {
                            if(type == "administrative_area_level_1") addresses.start = component.long_name
                        })
                    })
                }
                $("input[name='trip']").val(getTripRoute())
            })
        })
        end = new google.maps.Marker({
            position: new google.maps.LatLng(0,0),
            map: map,
            draggable: true,
            label: "B",
            title: "@lang('string.end')"
        }).addListener('dragend', function (event) {
           $("input[name='end_latitude']").val(event.latLng.lat())
           $("input[name='end_longitude']").val(event.latLng.lng())
           geocoder.geocode({
                location: event.latLng
            }, function (results, status) {
                if (status === "OK") {
                    $.each(results[0].address_components, (i, component) => {
                        $.each(component.types, (j, type) => {
                            if(type == "administrative_area_level_1") addresses.end = component.long_name
                        })
                    })
                }
                $("input[name='trip']").val(getTripRoute())
            })
        })
    }
    function getTripRoute(){
        return addresses.start + " - " + addresses.end
    }
    scheduler.attachEvent("onClick", function () {
        return false
    })
    scheduler.config.resize_day_events = false
    scheduler.config.readonly = true
    scheduler.skin = "terrace"
    
    scheduler.attachEvent("onClick", function (id, e) {
        return true;
    });
    scheduler.init('scheduler_here', new Date("{{$travel->start->format('m/d/Y')}}"), "week");

</script>
@foreach($travel->trips as $trip)
<script>
    color = "{{$trip->color}}"
    events.push({
        id: "{{$trip->id}}",
        text: "<i class='fas fa-times'></i>  {{$trip->trip}}",
        start_date: "{{$trip->start->format('m/d/Y H:i')}}",
        end_date: "{{$trip->end->format('m/d/Y H:i')}}",
        color: color,
    })
    scheduler.parse(events, "json");
    new google.maps.Polyline({
          path: [
              new google.maps.LatLng("{{$trip->start_latitude}}", "{{$trip->start_longitude}}"),
              new google.maps.LatLng("{{$trip->end_latitude}}", "{{$trip->end_longitude}}"),
          ],
          geodesic: true,
          strokeColor: color,
          strokeOpacity: 1.0,
          strokeWeight: 2,
        }).setMap(mapShow);
</script>
@endforeach
@endsection