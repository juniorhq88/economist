<form method="GET" action="" class="flex justify-center p-4 mb-6 space-x-4">
    <input type="text" name="search" placeholder="Buscar..." value="{{ request('search') }}"
        class="w-1/3 p-2 border border-gray-300 rounded-lg" />
    <button type="submit" class="px-4 py-2 text-white bg-blue-800 rounded-lg hover:bg-blue-700">
        Filtrar
    </button>
    <a href="{{ route('users.index') }}" class="px-4 py-2 text-white bg-gray-500 rounded-lg hover:bg-gray-600">
        Limpiar
    </a>
</form>
