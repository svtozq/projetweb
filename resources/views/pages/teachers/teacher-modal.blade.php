@extends('layouts.modal', [
    'id'    => 'teacher-modal',
    'title'  => 'Informations enseignant',] )

@section('modal-content')
    <form method="POST" action="{{ route('teacher.update', $teacher->id) }}">
        @method('PUT')
        @csrf
        <div class="card-body flex flex-col gap-5">
            <x-forms.input name="last_name" :label="__('Nom')" value="{{old('last_name', $teacher->last_name)}}" />

            <x-forms.input name="first_name" :label="__('Prénom')" value="{{old('first_name', $teacher->first_name)}}" />


            <x-forms.input type="email" name="email" :label="__('Email')" value="{{old('email', $teacher->email)}}" />

            <x-forms.primary-button>
                {{ __('Modifier') }}
            </x-forms.primary-button>
        </div>
    </form>
@overwrite
