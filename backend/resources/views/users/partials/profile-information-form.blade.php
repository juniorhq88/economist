<section>
    <header>
        @if (isset($user))
            <h2 class="text-lg font-medium">
                {{ __('Actualizar Usuario') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Modifica tu Usuario') }}
            </p>
        @else
            <h2 class="text-lg font-medium">
                {{ __('Nuevo Usuario') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Cree tu Usuario') }}
            </p>
        @endif
    </header>
    <div class="my-3">
        <x-input-label for="name" :value="__('Nombre completo')" />
        @if (isset($user))
            <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name', $user->name)" required
                autofocus autocomplete="name" />
        @else
            <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name')"
                required autofocus autocomplete="name" />
        @endif
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div class="mb-3">
        <x-input-label for="email" :value="__('Correo electrónico')" />
        @if (isset($user))
            <input type="email" id="email" name="email" type="text"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1"
                value="{{ $user->email }}" required autofocus autocomplete="email" />
        @else
            <input type="email" id="email" name="email" type="text"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full mt-1"
                :value="old('email')" required autofocus autocomplete="email" />
        @endif
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>
    @if (Auth::user()->hasRole(\App\Enum\UserType::SuperAdmin->value))
        <div class="mb-3">
            <div class="mb-3">
                <label>Rol de usuario:</label>
                @foreach ($roles as $role)
                    <div class="mb-2">
                        <input type="radio" id="role_{{ $role->id }}" name="role" value="{{ $role->name }}"
                            {{ isset($user) && $user->hasRole($role->name) ? 'checked' : '' }} required>
                        <label for="role_{{ $role->id }}" class="pl-2">{{ $role->name }}</label>
                    </div>
                @endforeach
            </div>
    @endif
</section>
