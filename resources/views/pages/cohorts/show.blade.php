<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">{{ $cohortId->name }}</span>
        </h1>
    </x-slot>

    <!-- begin: grid -->
    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">Étudiants</h3>
                    </div>
                    <div class="card-body">
                        <div data-datatable="true" data-datatable-page-size="30">
                            <div class="scrollable-x-auto">
                                <table class="table table-border" data-datatable-table="true">
                                    <thead>
                                    <tr>
                                        <th class="min-w-[135px]">
                                            <span class="sort asc">
                                                 <span class="sort-label">Nom</span>
                                                 <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Prénom</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        <th class="min-w-[135px]">
                                            <span class="sort">
                                                <span class="sort-label">Date de naissance</span>
                                                <span class="sort-icon"></span>
                                            </span>
                                        </th>
                                        @can('viewAny', \App\Models\Cohort::class)
                                        <th class="max-w-[50px]"></th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($cohortStudents as $students)
                                            <tr>
                                            <td>{{$students->last_name}}</td>
                                            <td>{{$students->first_name}}</td>
                                            <td>{{$students->date_of_birth}}</td>
                                                @can('viewAny', \App\Models\Cohort::class)
                                                <td class="cursor-pointer pointer">
                                                    <form method="POST" action="{{ route('cohort.delete.student', ['cohortId' => $cohortId, 'studentId' => $students->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit">
                                                        <i class="ki-filled ki-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                @endcan
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
                                <div class="flex items-center gap-2 order-2 md:order-1">
                                    Show
                                    <select class="select select-sm w-16" data-datatable-size="true" name="perpage"></select>
                                    per page
                                </div>
                                <div class="flex items-center gap-4 order-1 md:order-2">
                                    <span data-datatable-info="true"></span>
                                    <div class="pagination" data-datatable-pagination="true"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @can('viewAny', \App\Models\Cohort::class)
                <div class="lg:col-span-1">
                    <div class="card h-full">
                        <div class="card-header">
                            <h3 class="card-title">
                                Ajouter un étudiant à la promotion
                            </h3>
                        </div>
                        <form method="POST" action="{{ route('cohort.add.student', $cohortId) }}">
                            @csrf
                            <div class="card-body flex flex-col gap-5">
                                <label for="student_id" class="form-label">Étudiant</label>
                                <select id="student_id" name="student_id" class="form-select border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary text-sm shadow-sm">
                                    <option value="" disabled selected>{{ __('Sélectionner un étudiant') }}</option> <!-- Default empty option -->
                                    @foreach($allStudents as $student)
                                        <option value="{{ $student->id }}">
                                            {{ $student->last_name }} {{ $student->first_name }}
                                        </option>
                                    @endforeach
                                </select>

                                    <x-forms.primary-button>
                                        {{ __('Valider') }}
                                    </x-forms.primary-button>
                            </div>
                        </form>
                    </div>
                </div>
        @endcan
    </div>
    <!-- end: grid -->
</x-app-layout>
