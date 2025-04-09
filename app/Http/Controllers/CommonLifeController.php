<?php

namespace App\Http\Controllers;

use App\Models\CommonLife;
use Illuminate\Http\Request;


class CommonLifeController extends Controller
{
    public function index() {
        $tasksToDo = CommonLife::all()->where('status', 0);
        $tasksDone = CommonLife::all()->where('status', 1);
        return view('pages.commonLife.index',  compact('tasksToDo', 'tasksDone'));
    }

    public function taskDone($taskId) {
        $task = CommonLife::find($taskId);

        $task->update([
            'status' => 1
        ]);
        return redirect()->back();
    }
}
