@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="title">{{$travel->travel}}</h1>
            <h4><span class="badge badge-dark">{{"{$travel->start_date} - {$travel->end_date}"}}</span></h4>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{asset('images/visits.jpg')}}" alt="Card image cap">
                <div class="card-img-overlay text-white">
                    <h2 class="title">{{__('Visits')}}</h2>
                    <button type="button" class="btn btn-sm btn-light" data-toggle="modal" data-target="#visitModal">
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
            <div class="modal-body">
                <div class="embed-responsive embed-responsive-4by3">
                    <div class="embed-responsive-item" id="map"></div>
                </div>
                <form action="" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="">{{__('Name')}}</label>
                        <input type="text" name="name" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="">{{__('Address')}}</label>
                        <input type="text" name="address" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="">{{__('StartDateTime')}}</label>
                        <div class="input-group">
                            <input type="text" name="start_date" class="form-control form-control-sm" required>
                            <input type="time" name="start_time" class="form-control form-control-sm" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">{{__('EndDateTime')}}</label>
                        <div class="input-group">
                            <input type="text" name="end_date" class="form-control form-control-sm" required>
                            <input type="time" name="end_time" class="form-control form-control-sm" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    var map;
    function initMap() {
        var geocoder = new google.maps.Geocoder
        map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 0, lng: 0 },
            zoom: 2
        });
        map.addListener('click', function (event) {
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
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC6--aTCfHnIWexIQGMs9VvTMVAnrvVwRE&language=th&callback=initMap"></script>
@endsection