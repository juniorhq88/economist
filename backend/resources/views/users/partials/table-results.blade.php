<table class="w-full">
    <thead>
        <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-100">
            <th class="px-6 py-3 text-left">Nombre</th>
            <th class="px-6 py-3 text-left">Email</th>
            <th class="px-6 py-3 text-center">Roles</th>
            <th class="px-6 py-3 text-center">Acciones</th>
        </tr>
    </thead>
    <tbody class="text-sm text-gray-600">
        @foreach ($users as $user)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="px-6 py-3 text-left whitespace-nowrap">
                    {{ $user->name }}
                </td>
                <td class="px-6 py-3 text-left">
                    {{ $user->email }}
                </td>
                <td class="px-6 py-3 text-center">
                    @foreach ($user->roles as $role)
                        <span class="px-3 py-1 text-xs text-blue-600 bg-blue-200 rounded-full">
                            {{ $role->name }}
                        </span>
                    @endforeach
                </td>
                <td class="px-6 py-3 text-center">
                    <div class="flex justify-center item-center">
                        <a href="{{ route('users.edit', $user) }}"
                            class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Estás seguro?')"
                                class="w-4 transform hover:text-red-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="px-6 py-4">
    {{ $users->links() }}
</div>
