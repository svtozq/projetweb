@extends('layouts.modal', [
    'id'    => 'student-modal',
    'title'  => 'Informations étudiant',] )

@section('modal-content')
    <form method="POST" action="{{ route('student.update', $student->id) }}">
        @method('PUT')
        @csrf
        <div class="card-body flex flex-col gap-5">
            <x-forms.input name="last_name" :label="__('Nom')" value="{{old('last_name', $student->last_name)}}" />

            <x-forms.input name="first_name" :label="__('Prénom')" value="{{old('first_name', $student->first_name)}}" />

            <x-forms.input type="date" name="birth_date" :label="__('Date de Naissance')" value="{{old('birth_date', $student->birth_date)}}" />

            <x-forms.input type="email" name="email" :label="__('Email')" value="{{old('email', $student->email)}}" />

            <x-forms.primary-button>
                {{ __('Modifier') }}
            </x-forms.primary-button>
        </div>
    </form>
@endsection
