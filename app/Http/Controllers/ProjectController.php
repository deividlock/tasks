<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use App\Http\Requests\ProjectRequest;
use Laracasts\Flash\Flash;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->project = new Project;
    }

    public function index() {

    $projects = Project::orderBy('id', 'asc')->get();
    return view('project.index', compact('projects'));

    }

    public function  create() {

    	return view('project.create');
    }

    public function store(ProjectRequest $request) {

        $project = new Project;
        $project->name = $request->name;
        $project->save();
        Flash::success('Project Saved')->important();
        return redirect()->route('project.index');

    }

    public function edit($id) {

        $project = Project::find($id);
    	return view('project.edit',compact('project'));

    }
    public function update(Projectrequest $request, $id) {

        $project = Project::find($id);
        $project->name = $request->name;
        $project->save();
        Flash::success('Project updated')->important();
        return redirect()->route('project.index');

    }

    public function destroy($id) {

        try{
            $project = Project::find($id);
            $project->delete();
            Flash::success('Project deleted')->important();
            return redirect()->route('project.index');

        }catch(\Illuminate\Database\QueryException $e){
            Flash::danger('error')->important();
            return redirect()->route('project.index');
        }
    }

    public function show($id) {

        $project = Project::where("id","=", $id)->orderBy('id', 'asc')->get();

        foreach ($project as $prj) {
            $array = Task::where("id_project","=",$prj->id)->orderBy('priority', 'asc')->get();
            $task[] = $array;
        }

        return view('task.index', compact('project', 'task'));

    }
}
