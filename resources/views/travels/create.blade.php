@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">{{__('Travel')}}</h1>
        </div>
        <div class="col-md-6">
            <form action="{{route('travels.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="">{{__('Travel')}}</label>
                    <input type="text" name="travel" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label for="">{{__('Timezone')}}</label>
                    <select name="timezone" class="form-control form-control-sm select2" required>
                        @foreach(timezone_identifiers_list() as $timezone)
                        <option value="$timezone">{{$timezone}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">{{__('Budget')}}</label>
                    <input type="number" name="budget" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label for="">{{__('StartDate')}}</label>
                    <input type="text" name="start_date" class="form-control form-control-sm datepicker" required>
                </div>
                <div class="form-group">
                    <label for="">{{__('EndDate')}}</label>
                    <input type="text" name="end_date" class="form-control form-control-sm datepicker" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(".select2").select2()
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0,
        changeMonth: true,
        changeYear: true
    })
</script>
@endsection