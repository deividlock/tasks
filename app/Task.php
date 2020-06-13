<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    protected $fillable= [

    'name',
    'priority'

    ];

    // Find task for ID
    public function findTask($id) {

        $task = DB::table('tasks')
            ->join('projects', 'tasks.id_project', '=', 'projects.id')
            ->select('projects.id as id_project', 'projects.name as project_name', 'tasks.id', 'tasks.name', 'tasks.priority')
            ->where('tasks.id', '=', $id)
            ->first();

        return $task;
    }
}
