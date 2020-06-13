@extends('layouts.app')

@section('title')
    Projects List
@endsection

@section('content')
    <div class="row pb-4 text-right">
        <div class="col-md-12">
            <a href="{{ route('project.create')}}" class="btn btn-primary btn-md">Create</a>
        </div>
    </div>
    <table class="table table-striped table-bordered" style="width:100%" id="project-datatable">
        <thead class="column-title">
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <td class="text-center">Actions</td>
            </tr>
        </thead>
        <tbody>
        @foreach ($projects as $key=> $project)
            <tr>
                <td class="text-center">{{ $key+1 }}</td>
                <td class="text-center">{{$project->name}}</td>
                <td class="text-center">
                    <form action="{{ route ('project.destroy',[$project->id])}}"  method="POST">
                        {{ csrf_field() }}
                        <button class="btn btn-primary btn-xs" type="button" onclick="location.href='{{ route ('project.show',[$project->id])}}'"><i class="fa fa-search"></i></button>
                        <button class="btn btn-warning btn-xs" type="button" onclick="location.href='{{ route ('project.edit',[$project->id])}}'"><i class="fa fa-edit"></i></button>
                        <input type="hidden" name="_method" value="DELETE">
                        <button class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?') "><i class="fa fa-times"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th class="text-center">ID</th>
                <th class="text-center">Name</th>
                <td class="text-center">Actions</td>
            </tr>
        </tfoot>
    </table>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){

            // Datatable Initialization
            $('#project-datatable').DataTable();
        });
    </script>
@endsection

