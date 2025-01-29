<section>
    <header>
        <h2 class="text-lg font-medium ">
            {{ __('Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <div class="my-3">
        <x-input-label for="update_password_password" :value="__('New Password')" />
        <x-text-input id="update_password_password" name="password" type="password" class="block w-full mt-1"
            autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
    </div>

    <div class="mb-3">
        <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
            class="block w-full mt-1" autocomplete="new-password" />
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
    </div>
</section>
