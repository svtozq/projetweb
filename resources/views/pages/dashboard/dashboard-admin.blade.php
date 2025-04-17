<x-app-layout>
    <x-slot name="header">
        <h1 class="flex items-center gap-1 text-sm font-normal">
            <span class="text-gray-700">
                {{ __('Dashboard') }}
            </span>
        </h1>
    </x-slot>

    <!-- begin: grid -->

    <div class="grid lg:grid-cols-3 gap-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="d-flex justify-content-center table">
                        <table class="table-bordered table-hover table-striped text-center align-middle" style="width: 100%;">
                            <thead class="table-light" style="margin-top: 20px; margin-bottom: 20px;">
                            <tr>
                                <th class="p-3"> <a href=" {{ route('cohort.index') }} " class="hover:text-primary"> PROMOTIONS </a> </th>
                                <th class="p-3"> <a href=" {{ route('teacher.index') }} " class="hover:text-primary"> ENSEIGNANTS </a> </th>
                                <th class="p-3"> <a href=" {{ route('student.index') }} " class="hover:text-primary"> ÉLÈVES </a> </th>
                                <th class="p-3"> <a href=" {{ route('group.index') }} " class="hover:text-primary"> GROUPES </a> </th>
                            </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td class="p-3 table-light">{{$cohorts}}</td>
                                        <td class="p-3 table-light">{{$teachers}}</td>
                                        <td class="p-3 table-light">{{$students}}</td>
                                        <td class="p-3 table-light">{{$groups}}</td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>
