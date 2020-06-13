<?php

namespace App\Services;

use App\Task;

class TaskService
{
    /**
     * Explode Tasks
     *
     * @return void
     */
    public function getTask($data)
    {
        $explode = explode('-', $data);
        return $explode;
    }

    public function getArrayTask($array) {

        foreach ($array as $i => $arr) {
            $data = $this->getTask($arr);
            $tasks = Task::find($data[1]);
            $tasks->priority = $i+1;
            $tasks->save();

            $arrayTask[] = array(
                'id_project' => $data[0],
                'id' => $data[1],
                'name' => $tasks->name,
                'priority' => $tasks->priority
            );
        }

        return $arrayTask;
    }

}
