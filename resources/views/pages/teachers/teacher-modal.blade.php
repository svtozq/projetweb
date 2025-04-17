@extends('layouts.modal', [
    'id'    => 'teacher-modal',
    'title'  => 'Informations enseignant',] )

@section('modal-content')
    <form id="teacherUpdateForm" method="POST" action="{{ route('teacher.update') }}">
        @csrf
        @method('PUT')
        <div class="card-body flex flex-col gap-5">
            <x-forms.input id="current_email" type="email" name="current_email" :label="__('Email')"/>

            <x-forms.input id="email" type="email" name="email" :label="__('Nouvel Email')"/>

            <x-forms.input id="last_name" name="last_name" :label="__('Nom')"/>

            <x-forms.input id="first_name" name="first_name" :label="__('Prénom')"/>

            <div>
                <label for="cohort_id" class="form-label"> Promotions </label>
                <select name="cohort_id" id="cohort_id"
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary text-sm shadow-sm">
                    <option value="">{{ __('Lier à une promotion') }}</option>
                    @foreach($cohorts as $cohort)
                        <option value="{{ $cohort->id }}">
                            {{ $cohort->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <x-forms.primary-button type="submit" id="submitTeacherForm">
                {{ __('Modifier') }}
            </x-forms.primary-button>
        </div>
    </form>
@endsection
