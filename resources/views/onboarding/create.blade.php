@extends('app')

@section('content')

    <div class="rightside bg-grey-100">
        <div class="container-fluid">

            <!-- Error Log -->
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

            {!! Form::Open(['url' => 'onboarding','id'=>'onboardingform','files'=>'true']) !!}

            <!-- Member Details -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel no-border">
                        <div class="panel-title">
                            <div class="panel-head font-size-20">Enter details of the onboarding screen</div>
                        </div>
                        <div class="panel-body">
                            @include('onboarding.form')
                        </div>
                    </div>
                </div>
            </div>


            @if(Request::is('onboarding/create'))

                <!-- Submit Button Row -->
                <div class="row">
                    <div class="col-sm-2 pull-right">
                        <div class="form-group">
                            {!! Form::submit('Create', ['class' => 'btn btn-primary pull-right']) !!}
                        </div>
                    </div>
                </div>

            @endif

            {!! Form::Close() !!}

        </div> <!-- content -->
    </div> <!-- rightside -->


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
