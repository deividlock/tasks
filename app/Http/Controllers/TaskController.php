<?php

namespace App\Http\Controllers;

use Laracasts\Flash\Flash;
use App\Project;
use Illuminate\Http\Request;
use App\Task;
use App\Http\Requests\TaskRequest;
use App\Services\TaskService;

class TaskController extends Controller
{
    public function __construct(TaskService $taskService) {

        $this->tasks = new Task;
        $this->taskService = $taskService;
    }

    public function index() {

        $task = [];
        $project = Project::orderBy('id', 'asc')->get();

        foreach ($project as $prj) {
            $array = Task::where("id_project","=",$prj->id)->orderBy('priority', 'asc')->get();
            $task[] = $array;
        }

        return view('task.index', compact('project', 'task'));
    }

    public function  create() {

    	return view('task.create');
    }

    public function store(TaskRequest $request) {

        $tasks = new Task;
        $tasks->name = $request->name;
        $tasks->id_project  = $request->id_project;
        $tasks->priority = $request->priority;
        $tasks->save();
        Flash::success('Task Saved')->important();
        return redirect()->route('task.index');
    }

    public function edit($id) {

    	$task = $this->tasks->findTask($id);
    	return view('task.edit',compact('task'));
    }

    public function update(TaskRequest $request, $id) {

        $tasks = Task::find($id);
        $tasks->name = $request->name;
        $tasks->priority = $request->priority;
        $tasks->save();
        Flash::success('Task Updated')->important();
        return redirect()->route('task.index');
    }

    public function destroy($id) {

        try{
            $task = Task::find($id);
            $task->delete();
            Flash::success('Task deleted')->important();
            return redirect()->route('task.index');

        }catch(\Illuminate\Database\QueryException $e){
            Flash::danger('error')->important();
            return redirect()->route('task.index');
        }
    }

    public function updatePriority(Request $request) {

        $array = $request->input('order');
        $arrayTask = $this->taskService->getArrayTask($array);
        return response()->json($arrayTask);
    }
}
