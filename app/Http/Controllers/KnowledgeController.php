<?php

namespace App\Http\Controllers;

use App\Models\Knowledge;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class KnowledgeController extends Controller
{
    /**
     * Display the page
     *
     * @return Factory|View|Application|object
     */
    public function index() {
        $allUsers = User::all();
        $skillsToLearn = Knowledge::query()->where('status', null)->get();
        $skillsLearning = Knowledge::query()->where('status', 0)->get();
        $skillsLearnt = Knowledge::query()->where('status', 1)->get();
        return view('pages.knowledge.index',  compact('allUsers', 'skillsToLearn', 'skillsLearning', 'skillsLearnt'));
    }

    public function skillLearning($skillId) {
        $skill = Knowledge::find($skillId);

        $skill->update([
            'status' => 0
        ]);
        return redirect()->back();
    }

    public function skillLearnt($skillId) {
        $skill = Knowledge::find($skillId);

        $skill->update([
            'status' => 1
        ]);
        return redirect()->back();
    }
}
