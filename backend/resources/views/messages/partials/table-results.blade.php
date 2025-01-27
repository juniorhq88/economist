<table class="w-full">
    <thead>
        <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-100">
            <th class="px-6 py-3 text-center">Titulo</th>
            <th class="px-6 py-3 text-center">Pertenece a</th>
            <th class="px-6 py-3 text-center">Formulario</th>
        </tr>
    </thead>
    <tbody class="text-sm text-gray-600">
        @foreach ($messages as $message)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="px-6 py-3 text-left whitespace-nowrap">
                    {{ $message->title }}
                </td>
                 <td class="px-6 py-3 text-left">
                    {{ $message->user->name }}
                </td>
                <td class="px-6 py-3 text-left">
                    {{ $message->form->title }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="px-6 py-4">
    {{ $messages->links() }}
</div>
