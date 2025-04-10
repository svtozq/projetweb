<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Bilans de connaissances') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">
                            Compétences à acquérir
                        </h3>
                    </div>
                    <div class="d-flex justify-content-center table">
                        <table class="table-bordered table-hover table-striped text-center align-middle" style="width: 100%;">
                            <thead class="table-light" style="margin-top: 20px; margin-bottom: 20px;">
                            <tr>
                                <th class="p-3"> COMPÉTENCE </th>
                                <th class="p-3"> DESCRIPTION </th>
                                <th class="p-3">  </th>
                                <th class="p-3">  </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($skillsToLearn as $skill)
                                @if($skill->student_id == Auth::id())
                                    <tr>
                                        <td class="p-3 table-light">{{$skill->skill}}</td>
                                        <td class="p-3 table-light">{{$skill->description}}</td>
                                        <td class="p-3 table-light">
                                            <form method="POST" action="{{ route('skill.learning', $skill->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"> <a class="btn-primary btn-sm"> En cours </a> </button>
                                            </form>
                                        </td>
                                        <td class="p-3 table-light">
                                            <form method="POST" action="{{ route('skill.learnt', $skill->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"> <a class="btn-success btn-sm"> Terminé </a> </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">
                            En cours d'apprentissage
                        </h3>
                    </div>
                    <div class="d-flex justify-content-center table">
                        <table class="table-bordered table-hover table-striped text-center align-middle" style="width: 100%;">
                            <thead class="table-light">
                            <tr>
                                <th class="p-3"> COMPÉTENCE </th>
                                <th class="p-3"> DESCRIPTION </th>
                                <th class="p-3">  </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($skillsLearning as $skill)
                                @if($skill->student_id == Auth::id())
                                    <tr>
                                        <td class="p-3 table-light">{{$skill->skill}}</td>
                                        <td class="p-3 table-light">{{$skill->description}}</td>
                                        <td class="p-3 table-light">
                                            <form method="POST" action="{{ route('skill.learnt', $skill->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"> <a class="btn-success btn-sm"> Terminé </a> </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">
                            Compétences acquises
                        </h3>
                    </div>
                    <div class="d-flex justify-content-center table">
                        <table class="table-bordered table-hover table-striped text-center align-middle" style="width: 100%;">
                            <thead class="table-light">
                            <tr>
                                <th class="p-3"> COMPÉTENCE </th>
                                <th class="p-3"> DESCRIPTION </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($skillsLearnt as $skill)
                                @if($skill->student_id == Auth::id())
                                    <tr>
                                        <td class="p-3 table-light">{{$skill->skill}}</td>
                                        <td class="p-3 table-light">{{$skill->description}}</td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>
