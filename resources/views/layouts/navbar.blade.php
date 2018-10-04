<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{asset('images/borboleta.svg')}}" alt="" height="25px"> {{config('app.name')}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{__('Travels')}} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a href="{{route('travels.index')}}" class="dropdown-item">@lang('string.travels')</a>
                        <a href="{{route('travels.create')}}" class="dropdown-item">@lang('string.register')</a>
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">@lang('string.login')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">@lang('string.register')</a>
                </li>
                @else
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#calcModal"><i class="fas fa-sync"></i></a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#timezoneModal"><i class="fas fa-globe"></i>
                        {{Session::get('timezone')}}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false" v-pre>
                        <i class="fas fa-user"></i> {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item logout" href="#">
                            @lang('string.logout')
                        </a>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
<div class="modal fade" id="timezoneModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('string.timezone')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('timezone')}}" method="POST">
                <div class="modal-body">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="">@lang('string.timezone')</label>
                        <select name="timezone" class="form-control form-control-sm select2" required>
                            @foreach($timezones as $timezone)
                            <option value="{{$timezone->timezone}}" {{($timezone->timezone == Session::get('timezone'))?'selected':''}}>{{$timezone->timezone}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('button.close')</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> @lang('button.save')</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="calcModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('string.timezone')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('timezone')}}" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">@lang('string.from') {{Session::get('timezone')}}</label>
                        <input type="text" name="datetime" class="form-control form-control-sm datetimepicker-calc">
                    </div>
                    <div class="form-group">
                        <label for="">@lang('string.to')</label>
                        <select name="timezone" class="form-control form-control-sm select2" required>
                            @foreach($timezones as $timezone)
                            <option value="{{$timezone->timezone}}">{{$timezone->timezone}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">@lang('string.to')</label>
                        <input type="text" name="to" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('button.close')</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> @lang('button.save')</button>
                </div>
            </form>
        </div>
    </div>
</div>