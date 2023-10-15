@extends('app')

@section('content')

<div class="rightside bg-grey-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                {!! Form::model($onboardingScreen, ['method' => 'POST','files'=>'true','action' => ['OnboardingController@update',$onboardingScreen->id],'id'=>'onboardingupdateform']) !!}

            
                <div class="panel no-border">
                    <div class="panel-title">
                        <div class="panel-head font-size-20">Enter details of the onboarding screen</div>
                    </div>
                    <div class="panel-body">

                        @include('onboarding.form')
                    </div><!-- / Panel Body -->
                </div><!-- / Panel-no-border -->

            <div class="row">
                <div class="col-sm-2 pull-right">
                    <div class="form-group">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary pull-right']) !!}
                    </div>
                </div>
            </div>

            {!! Form::Close() !!}

            </div><!-- / Main Col -->
        </div><!-- / Main Row -->
    </div><!-- / Container -->
</div><!-- / Rightside -->

@stop
@section('footer_scripts')
    <script src="{{ URL::asset('assets/js/onboarding.js') }}" type="text/javascript"></script>
@stop

@section('footer_script_init')
    <script type="text/javascript">
        $(document).ready(function(){
            gymie.loaddatepickerstart();
            gymie.chequedetails();
            gymie.subscription();
        });
    </script>
@stop
