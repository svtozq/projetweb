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
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="{{route('cohort.index')}}">
                            Promotions
                            </a>
                        </h3>
                    </div>
                    <div class="card-body flex flex-col gap-5">
                        <p> {{$cohorts}} </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="{{route('teacher.index')}}">
                            Enseignants
                            </a>
                        </h3>
                    </div>
                    <div class="card-body flex flex-col gap-5">
                        <p> {{$teachers}} </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="{{route('student.index')}}">
                            Étudiants
                            </a>
                        </h3>
                    </div>
                    <div class="card-body flex flex-col gap-5">
                        <p> {{$students}} </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2">
            <div class="grid">
                <div class="card card-grid h-full min-w-full">
                    <div class="card-header">
                        <h3 class="card-title">
                            <a href="{{route('group.index')}}">
                            Groupes
                            </a>
                        </h3>
                    </div>
                    <div class="card-body flex flex-col gap-5">
                        <p> {{$groups}} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end: grid -->
</x-app-layout>
