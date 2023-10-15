<?php use Carbon\Carbon; ?>


<div class="row">
	@if(isset($onboardingScreen))
	<?php
			$media = $onboardingScreen->getMedia('onboarding');
			$image = ($media->isEmpty() ? 'https://placeholdit.imgix.net/~text?txtsize=18&txt=NA&w=50&h=50' : url($media[0]->getUrl()));
    ?>
    <div class="col-sm-4">
	<div class="form-group">
{!! Form::label('photo','Photo') !!}
{!! Form::file('photo',['class'=>'form-control', 'id' => 'photo']) !!}
    </div>								
    </div>
    <div class="col-sm-2">
	<img style="width: 250px" alt="proof Pic" class="pull-right" src="{{ $image }}"/>
    </div>
	@else
	<div class="col-sm-6">
	<div class="form-group">
{!! Form::label('photo','Photo') !!}
{!! Form::file('photo',['class'=>'form-control', 'id' => 'photo']) !!}
    </div>								
    </div>
    @endif
		<div class="col-sm-6">
			<div class="form-group">
				{!! Form::label('name','Name',['class'=>'control-label']) !!}
				{!! Form::text('name',null,['class'=>'form-control', 'id' => 'name']) !!}
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				{!! Form::label('description','description',['class'=>'control-label']) !!}
				{!! Form::textArea('description',null,['class'=>'form-control', 'id' => 'description']) !!}
			</div>
		</div>
</div>
