@extends('layouts.modal', [
    'id'    => 'student-modal',
    'title'  => 'Informations étudiant',] )

@section('modal-content')
    <form method="POST" action="{{ route('student.update') }}">
        @method('PUT')
        @csrf
        <div class="card-body flex flex-col gap-5">
            <x-forms.input type="email" name="current_email" :label="__('Email')"/>

            <x-forms.input type="email" name="email" :label="__('Nouvel Email')"/>

            <x-forms.input name="last_name" :label="__('Nom')"/>

            <x-forms.input name="first_name" :label="__('Prénom')"/>

            <x-forms.input type="date" name="birth_date" :label="__('Date de Naissance')"/>

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

            <x-forms.primary-button>
                {{ __('Modifier') }}
            </x-forms.primary-button>
        </div>
    </form>
@endsection
