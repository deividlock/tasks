@extends('layouts.app')

@section('title')
	Update Task
@endsection

@section('content')
	<div class="row justify-content-center">
		@include('task.partials.errors')
        <div class="col-lg-8 col-md-8 col-xs-12">
			{!! Form::model($task, ['route'=> ['task.update', $task->id],'method' => 'PUT']) !!}
				@include('task.partials.form')
			{!!Form::close()!!}
		</div>
	</div>
@endsection

@section('scripts')
    <script type="text/javascript">
     let project = $('#project').select2({
            placeholder: 'Select a project',
            ajax: {
                url: '/api/project/{id}',
                dataType: 'json',
                delay: 250,
                data: function (params) {

                    return {
                        term: params.term, // search term
                        page: params.page,
                    };
                },
                processResults: function (data) {

                    return {
                        results: data,
                    };
                },
                cache: true
            }
        });

     project.append($('<option>', {
             value: '{{ $task->id_project }}',
             text: '{{ $task->project_name }}'
         }));

     project.val('{{ $task->id_project }}').trigger("change");
    </script>
@endsection
