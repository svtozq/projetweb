@extends('layouts.modal', [
    'id'    => 'teacher-modal',
    'title'  => 'Informations enseignant',] )

@section('modal-content')
    <form id="teacherUpdateForm" method="POST" action="{{ route('teacher.update', $teacher->id) }}">
        @csrf
        @method('PUT')
        <div class="card-body flex flex-col gap-5">
            <x-forms.input id="last_name" name="last_name" :label="__('Nom')" value="" />

            <x-forms.input id="first_name" name="first_name" :label="__('Prénom')" value="" />

            <x-forms.input id="email" type="email" name="email" :label="__('Email')" value="" />

            <x-forms.primary-button type="submit" id="submitTeacherForm">
                {{ __('Modifier') }}
            </x-forms.primary-button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/custom/teacher-modal.js') }}"></script>
@endpush
