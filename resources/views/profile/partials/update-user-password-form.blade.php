<div class="card">
    <div class="card-header" id="auth_password">
        <h3 class="card-title">
            Password
        </h3>
    </div>

    <form method="POST" action="{{ route('profile.update', auth()->user()) }}">
        @method('PUT')
        @csrf
        <div class="card-body grid gap-5">
            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">
                        Current Password
                    </label>
                    <div class="flex flex-col items-start grow gap-7.5 w-full">
                        <x-forms.input
                            name="current_password" type="password" placeholder="Your current password"
                            :messages="$errors->get('current_password')" />
                    </div>
                </div>
            </div>
            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">
                        New Password
                    </label>
                    <div class="flex flex-col items-start grow gap-7.5 w-full">
                        <x-forms.input
                            name="password" type="password" placeholder="New password"
                            :messages="$errors->get('password')" />
                    </div>
                </div>
            </div>
            <div class="w-full">
                <div class="flex items-baseline flex-wrap lg:flex-nowrap gap-2.5">
                    <label class="form-label max-w-56">
                        Confirm New Password
                    </label>
                    <div class="flex flex-col items-start grow gap-7.5 w-full">
                        <x-forms.input
                            name="password_confirmation" type="password" placeholder="Confirm new password"
                            :messages="$errors->get('password_confirmation')" />
                    </div>
                </div>
            </div>
            <div class="flex justify-end pt-2.5">
                <button class="btn btn-primary">
                    {{ __('Save Password') }}
                </button>
            </div>
        </div>
    </form>
</div>
