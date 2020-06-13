@extends('layouts.app')

@section('title')
	Update Project
@endsection

@section('content')
	<div class="row justify-content-center">
		@include('project.partials.errors')
        <div class="col-lg-8 col-md-8 col-xs-12">
			{!! Form::model($project, ['route'=> ['project.update', $project->id],'method' => 'PUT']) !!}
				@include('project.partials.form')
			{!!Form::close()!!}
		</div>
	</div>
@endsection
