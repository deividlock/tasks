<?php

namespace App\Http\Controllers;

use App\Task;
use App\Project;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $task = [];
        $project = Project::orderBy('id', 'asc')->get();

        foreach ($project as $prj) {
            $array = Task::where("id_project","=",$prj->id)->orderBy('priority', 'asc')->get();
            $task[] = $array;
        }

        return view('task.index', compact('project', 'task'));
    }
}
