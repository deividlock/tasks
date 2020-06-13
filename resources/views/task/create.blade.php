@extends('layouts.app')

@section('title')
    Create Task
@endsection

@section('content')
	<div class="row justify-content-center">
		@include('task.partials.errors')
        <div class="col-lg-8 col-md-8 col-xs-12">
            {!! Form::open(['route'=> 'task.store']) !!}
                @include('task.partials.form')
            {!!Form::close()!!}
		</div>
	</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $('#project').select2({
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
    </script>
@endsection
