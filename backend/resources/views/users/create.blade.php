<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="container px-4 py-8 mx-auto">
        <div class="max-w-md mx-auto overflow-hidden bg-white rounded-lg shadow-md">
            <div class="px-6 py-4 border-b bg-gray-50">
                <h1 class="text-2xl font-bold text-gray-800">Crear Usuario</h1>
            </div>

            <form action="{{ route('users.store') }}" method="POST" class="p-6">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block mb-2 text-sm font-bold text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        required>
                </div>

                <div class="mb-4">
                    <label for="email" class="block mb-2 text-sm font-bold text-gray-700">Email</label>
                    <input type="email" name="email" id="email"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        required>
                </div>

                <div class="mb-4">
                    <label for="password" class="block mb-2 text-sm font-bold text-gray-700">Contraseña</label>
                    <input type="password" name="password" id="password"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        required>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="block mb-2 text-sm font-bold text-gray-700">Confirmar
                        Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 text-sm font-bold text-gray-700">Roles</label>
                    @foreach ($roles as $role)
                        <div class="flex items-center">
                            <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                                id="role-{{ $role->id }}" class="mr-2 leading-tight">
                            <label for="role-{{ $role->id }}" class="text-gray-700">
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 focus:outline-none focus:shadow-outline">
                        Crear Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
