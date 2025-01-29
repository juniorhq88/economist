<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Nuevo Formulario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <form method="post" action="{{ route('users.store') }}" class="mt-6 space-y-6">
                @csrf
                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('users.partials.profile-information-form')
                    </div>
                </div>

                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('users.partials.password-form')
                    </div>
                </div>

                <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                    <div class="max-w-xl">
                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                @if (isset($users))
                                    {{ __('Actualizar') }}
                                @else
                                    {{ __('Guardar') }}
                                @endif
                            </x-primary-button>

                            <x-secondary-button onclick="window.history.back()">
                                {{ __('Regresar') }}
                            </x-secondary-button>

                            @if (session('status') === 'profile-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600 dark:text-green-400">{{ __('Saved.') }}</p>
                            @endif

                        </div>
                    </div>
                </div>



            </form>

        </div>
    </div>

</x-app-layout>
