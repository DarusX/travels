@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        @breadcrumb(['travel' => $travel])
        @endbreadcrumb
        <div class="col-md-12">
            <h2 class="title">@lang('string.visits')</h2>
        </div>
        <div class="col-md-4 pb-4">
            <div class="card">
                <div class="card-header bg-dark text-white pl-0 py-1">
                    <button class="btn btn-sm btn-dark" data-toggle="modal" data-target="#visitModal"><i class="fas fa-plus"></i></button>
                    <strong>@lang('string.visits')</strong>
                </div>
                <ul class="list-group list-group-flush text-dark">
                    @foreach($travel->visits as $visit)
                    <li class="list-group-item d-flex justify-content-between align-items-center py-0 pl-0 bg-light">
                        <div>
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle dropdown-dots" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <button class="btn btn-sm btn-light zoom" data-lat='{{$visit->latitude}}' data-lng="{{$visit->longitude}}">
                                    <i class="fas fa-search"></i>
                                </button>
                                {{$visit->name}}
                                <div class="dropdown-menu">
                                    <a class="dropdown-item delete" href="{{route('visits.destroy', ['visit' => $visit, 'travel' => $travel])}}">@lang('string.delete')</a>
                                </div>
                            </div>
                        </div>
                        <span class="badge badge-{{$visit->class_color}}">{{$visit->start_datetime->timezone(Session::get('timezone'))->format('D, M d, Y, H:i')}}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-8 d-none d-sm-block">
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
                        <label for="">@lang('string.name')</label>
                        <input type="text" name="name" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="">@lang('string.address')</label>
                        <input type="text" name="address" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-group">
                        <label for="">@lang('string.start_datetime') {{Session::get('timezone')}}</label>
                        <div class="input-group">
                            <input type="text" name="start_datetime" class="form-control form-control-sm datetimepicker"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">@lang('string.end_datetime') {{Session::get('timezone')}}</label>
                        <div class="input-group">
                            <input type="text" name="end_datetime" class="form-control form-control-sm datetimepicker"
                                required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">@lang('string.priority')</label>
                        <div class="input-group">
                            <select name="priority" class="form-control form-control-sm">
                                <option value="low">@lang('string.low')</option>
                                <option value="medium" selected>@lang('string.medium')</option>
                                <option value="high">@lang('string.high')</option>
                            </select>
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
    $(".datetimepicker").bootstrapMaterialDatePicker({
        format: "YYYY-M-DD HH:mm",
        minDate: new Date(Date.parse("{{$travel->start_datetime->format('Y/m/d')}}")),
        maxDate: new Date(Date.parse("{{$travel->end_datetime->format('Y/m/d')}}"))
    })

    initMap()
    function initMap() {
        var geocoder = new google.maps.Geocoder
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 0, lng: 0 },
            zoom: 2,
            minZoom: 2,
            gestureHandling: "greedy"
        });
        mapShow = new google.maps.Map(document.getElementById('map-show'), {
            center: { lat: 0, lng: 0 },
            zoom: 2,
            minZoom: 2,
            gestureHandling: "greedy"
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
    scheduler.attachEvent("onClick", function () {
        return false
    })
    scheduler.config.resize_day_events = false;
    scheduler.config.readonly = true;
    
    scheduler.attachEvent("onClick", function (id, e) {
        alert(JSON.stringify(id))
        return true;
    });
    scheduler.init('scheduler_here', new Date("{{$travel->start_datetime->format('m/d/Y')}}"), "week");

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
        text: "<i class='fas fa-times'></i>  {{$visit->name}}",
        start_date: "{{$visit->start_datetime->timezone(Session::get('timezone'))->format('m/d/Y H:i')}}",
        end_date: "{{$visit->end_datetime->timezone(Session::get('timezone'))->format('m/d/Y H:i')}}",
        color: "{{$visit->color}}",
        holder: "{{Auth::user()->name}}"
    })
    scheduler.parse(events, "json");
</script>
@endforeach

@endsection