<div class="item form-group">
    {!! Form::label('name','Name Project') !!}
    {!! Form::text('name',null, ['required', 'class' => 'form-control upper', 'maxlength' => '500',]) !!}
</div>
<div class="form-group pull-right">
    {!! Form::submit('Save',['class' => 'btn btn-success', 'id' => 'save']) !!}
    <a class="btn btn-primary" href="{{ route('project.index') }}">Return</a>
</div>

@section('scripts')
	{!! Html::script('/js/validator.js') !!}
@endsection
