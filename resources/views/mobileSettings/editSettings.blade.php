@extends('app')
@section('content')

<div class="rightside bg-grey-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
                </ul>
                </div>
                @endif

                {!! Form::Open(['method' => 'POST','id' => 'mobileSettings','action' => ['MobileController@update']]) !!}
                    <div class="row margin-top-15 margin-bottom-15">
                        <div class="col-xs-12 col-md-3 pull-right">
                            {!! Form::submit('Save', ['class' => 'btn btn-sm btn-primary pull-right']) !!}

                        </div>
                    </div>
                    <table id="mobileSettings" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="text-center">Label</th>
                            <th class="text-center">Description</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">On/Off</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($mobileSettings as $mobileSetting)
                            <tr>
                                <td class="text-center">{{ $mobileSetting->label}}</td>
                                <td class="text-center">{{ $mobileSetting->description}}</td>
                                <td class="text-center"><span class="{{ Utilities::getActiveInactive ($mobileSetting->status) }}">{{ Utilities::getStatusValue ($mobileSetting->status) }}</span></td>
                                <td class="text-center">
                                    <div class="checkbox checkbox-theme">
                                            <?php $status = ($mobileSetting->status == 1 ? 'checked="checked"' : '') ?>
                                        <input type="checkbox" name="mobileSettings[{{$mobileSetting->key}}]" id="mobile_settings_{{$mobileSetting->id}}" value="{{$mobileSetting->id}}" {{ $status }}>
                                        <label for="mobile_settings_{{$mobileSetting->id}}"></label>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

            {!! Form::Close() !!}
            </div>
        </div>
    </div>
</div>
@stop
@section('footer_scripts') 
<script src="{{ URL::asset('assets/js/userUpdate.js') }}" type="text/javascript"></script>
@stop