<?php

namespace App\Http\Controllers;

use App\Models\Retro;
use App\Models\Cohort;
use GuzzleHttp\Promise\Create;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class RetroController extends Controller
{
    /**
     * Display the page
     *
     * @return Factory|View|Application|object
     */
    public function index() {
        $cohorts = Cohort::all();
        $retros = Retro::all();
        return view('pages.retros.index',  compact('cohorts','retros'));
    }

    /**
     * Display a specific cohort
     * @param Cohort $cohort
     * @return Application|Factory|object|View
     */
    public function create(Cohort $cohort) {
        $cohorts = Cohort::all();

        $creates = Retro::create([
            'retro_id' => $schedule->date,
            'cohort_id' => $schedule->begin_time,
            'commentary'=> $request -> doctor_id,
        ]);

        $students = Student::all();
        $myStudents = Student::query()->where('cohort_id', $cohorts->first->id)->get();
        return view('pages.cohorts.show',  compact('cohort', ));
    }
}
