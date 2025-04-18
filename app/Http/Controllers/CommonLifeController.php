<?php

namespace App\Http\Controllers;

use App\Models\CommonLife;
use Illuminate\Http\Request;


class CommonLifeController extends Controller
{
    public function index() {
        // Get all tasks w status 0
        $tasksToDo = CommonLife::all()->where('status', 0);
        // Get all tasks w status 1
        $tasksDone = CommonLife::all()->where('status', 1);

        return view('pages.commonLife.index',  compact('tasksToDo', 'tasksDone'));
    }

    public function taskDone($taskId) {
        // Find the task
        $task = CommonLife::find($taskId);

        // Set it done
        $task->update([
            'status' => 1
        ]);

        return redirect()->back();
    }
}
