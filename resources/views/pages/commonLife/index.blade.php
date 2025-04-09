<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Vie Commune') }}
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
                            Tâches à faire
                        </h3>
                    </div>
                    <div class="d-flex justify-content-center table">
                        <table class="table-bordered table-hover table-striped text-center align-middle" style="width: 100%;">
                            <thead class="table-light" style="margin-top: 20px; margin-bottom: 20px;">
                            <tr>
                                <th class="p-3"> TÂCHE </th>
                                <th class="p-3"> DESCRIPTION </th>
                                <th class="p-3"> COMMENTAIRE </th>
                                <th class="p-3">  </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasksToDo as $task)
                                @if($task)
                                    <tr>
                                        <td class="p-3 table-light">{{$task->task}}</td>
                                        <td class="p-3 table-light">{{$task->description}}</td>
                                        <td class="p-3 table-light">{{$task->commentary}}</td>
                                        <td class="p-3 table-light">
                                            <form method="POST" action="{{ route('task.done', $task->id) }}">
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
                            Tâches terminés
                        </h3>
                    </div>
                    <div class="d-flex justify-content-center table">
                        <table class="table-bordered table-hover table-striped text-center align-middle" style="width: 100%;">
                            <thead class="table-light">
                            <tr>
                                <th class="p-3"> TÂCHE </th>
                                <th class="p-3"> DESCRIPTION </th>
                                <th class="p-3"> COMMENTAIRE </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasksDone as $task)
                                @if($task)
                                <tr>
                                    <td class="p-3 table-light">{{$task->task}}</td>
                                    <td class="p-3 table-light">{{$task->description}}</td>
                                    <td class="p-3 table-light">{{$task->commentary}}</td>
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
