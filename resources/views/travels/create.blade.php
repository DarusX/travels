@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1 class="title">@lang('string.travel')</h1>
        </div>
        <div class="col-md-6">
            <form action="{{route('travels.store')}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="">@lang('string.travel')</label>
                    <input type="text" name="travel" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label for="">@lang('string.budget')</label>
                    <input type="number" name="budget" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label for="">@lang('string.start_datetime')</label>
                    <input type="datetime-local" name="start_datetime" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <label for="">@lang('string.end_datetime')</label>
                    <input type="datetime-local" name="end_date" class="form-control form-control-sm" required>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i> @lang('button.save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0,
        changeMonth: true,
        changeYear: true
    })
</script>
@endsection