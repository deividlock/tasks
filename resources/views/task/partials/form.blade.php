<form action="" class="form-horizontal" novalidate>
    <div class="item form-group">
        {!!Field::select('id_project',null,old('id_project'),['label' => 'Project','id' => 'project','required'=>''])!!}
    </div>
	<div class="item form-group">
        {!! Form::label('name','Name Task') !!}
        {!! Form::text('name',null, ['required', 'class' => 'form-control upper', 'maxlength' => '500',]) !!}
	</div>
    <div class="item form-group">
        {!! Form::label('name','Priority') !!}
        {!! Form::number('priority',null, ['required', 'class' => 'form-control upper', 'maxlength' => '500',]) !!}
    </div>
	<div class="form-group pull-right">
		{!! Form::submit('Save',['class' => 'btn btn-success', 'id' => 'save']) !!}
        <a class="btn btn-primary" href="{{ route('task.index') }}">Return</a>
	</div>
</form>
