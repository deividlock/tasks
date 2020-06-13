@extends('layouts.app')

@section('content')
    <div class="text-info"><h1>Task</h1></div>
    <div class="row text-right pb-lg-2">
        <div class="col-lg-12 col-md-12 col-xs-12 pb-4">
            <a href="{{ route('task.create')}}" class="btn btn-primary btn-md">Create</a>
        </div>
    </div>
    @if(count($project) == 0)
        <div class="alert alert-primary" role="alert">
            Tasks list is empty
        </div>
    @else
        @foreach ($project as $i => $prj)
            <div class="row pb-lg-2">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="card mb-2 py-1 border-left-primary">
                        <div class="card-body">
                            <h4>{{ $prj->name }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pb-lg-4">
                <div class="col-lg-12 col-md-12 col-xs-12">
                    <table class="table table-striped table-bordered task" id="table{{$prj->id}}">
                        <thead class="column-title">
                        <tr>
                            <th class="text-center">Priority</th>
                            <th class="text-center">Name</th>
                            <td class="text-center">Actions</td>
                        </tr>
                        </thead>
                        <tbody class="sortable text-center">
                        @foreach ($task[$i] as $key => $task[$i])
                            <tr id={{ $prj->id.'-'.$task[$i]->id }}>
                                <td class="key{{ $key+1 }}">{{ $key+1 }}</td>
                                <td>{{ $task[$i]->name }}</td>
                                <td>
                                    <form action="{{ route ('task.destroy',[$task[$i]->id])}}"  method="POST">
                                        {{ csrf_field() }}
                                        <button class="btn btn-warning btn-xs" type="button" onclick="location.href='{{ route ('task.edit',[$task[$i]->id])}}'"><i class="fa fa-edit"></i></button>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?') "><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th class="text-center">Priority</th>
                            <th class="text-center">Name</th>
                            <td class="text-center">Actions</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        @endforeach
    @endif

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            // Datatable Initialization
            $('.task').DataTable();

            // Lets move tasks
            $(function() {
                $('.sortable').sortable({
                    update: function(event, ui) {
                        let order = $(this).sortable('toArray');
                        console.log(order);
                        $.ajax({
                            type: 'GET',
                            url: "{{url('/task/updatePriority')}}",
                            data: {'order': order},
                            dataType : 'json',
                            success: function (response) {
                                update(response);
                            }
                        });
                        $('#text').text(order.toString());
                    }
                });
                $('.sortable').disableSelection();
            });

            // Update the new position
            function update(response) {
                let length = response.length;

                for (let k = 0; k < length; k++) {
                    let id_project = response[k].id_project;
                    let table = $('#table'+id_project).DataTable();

                    // Build variables of the data
                    let task_id = response[k].id;
                    let route_edit = '/task/'+task_id+'/edit';
                    let route_destroy = '/task/'+task_id+'/destroy';
                    let field = '<form action="'+route_destroy+'" method="POST">{{ csrf_field() }} <button class="btn btn-warning btn-xs" type="button" onclick="location.href=\''+route_edit+'\'"><i class="fa fa-edit"></i></button><input type="hidden" name="_method" value="DELETE"> <button class="btn btn-danger btn-xs" onclick="return confirm(\'Are you sure\') "><i class="fa fa-times"></i></button>';
                    let num = id_project+'-'+task_id;

                    // Build the rows with the new position
                    table
                        .row('#'+num)
                        .remove();
                    table
                        .row.add( [ response[k].priority, response[k].name , field ])
                        .draw()
                        .node().id = num;
                }
            }
        });

    </script>
@endsection
