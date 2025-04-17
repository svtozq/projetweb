<div class="card">
    <div class="card-header" id="delete_account">
        <h3 class="card-title">
            Delete Account
        </h3>
    </div>
    <form method="post" action="{{ route('profile.delete') }}" class="p-6">
        @csrf
        @method('delete')
    <div class="card-body flex flex-col lg:py-7.5 lg:gap-7.5 gap-3">
        <div class="flex flex-col gap-5">
            <div class="text-2sm text-gray-800">
                We regret to see you leave. Confirm account deletion below. Your data will be permanently removed. Thank you for being part of our
                community. Please check our
                <a class="link" href="#">
                    Setup Guidelines
                </a>
                if you still wish continue.
            </div>
            <label class="checkbox-group">
                <input class="checkbox checkbox-sm" name="delete" type="checkbox" value="1" required>
                <span class="checkbox-label">
                Confirm deleting account
               </span>
            </label>
        </div>
        <div class="flex flex-col items-start grow gap-7.5 w-full">
            <x-forms.input
                name="password" type="password" placeholder="Confirm your password"
                :messages="$errors->userDeletion->get('password')" />
        </div>
        <div class="flex justify-end gap-2.5">
            <button class="btn btn-light">
                Deactivate Instead
                <button class="btn btn-danger">
                    {{ __('Delete Account') }}
                </button>
            </button>
        </div>
    </div>
    </form>
</div>
