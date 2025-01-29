<table class="w-full">
    <thead>
        <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-100">
            <th class="px-6 py-3 text-center">Formulario</th>
            <th class="px-6 py-3 text-center">Descripción</th>
            <th class="px-6 py-3 text-center">Pertenece a</th>
            <th class="px-6 py-3 text-center">Envíos</th>
            <th class="px-6 py-3 text-center"></th>
        </tr>
    </thead>
    <tbody class="text-sm text-gray-600">
        @foreach ($forms as $form)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="px-6 py-3 text-left whitespace-nowrap">
                    {{ $form->title }}
                </td>
                <td class="px-6 py-3 text-left">
                    {{ $form->description }}
                </td>

                <td class="px-6 py-3 text-left">
                    {{ $form->user->name }}
                </td>
                <td class="px-6 py-3 text-left">
                    <p class="flex justify-center">{{ $form->messages->count() }}</p>
                </td>
                <td class="px-6 py-3 text-center">
                    <div class="flex justify-center item-center">
                        @if ($form->messages->count())
                            <a href="{{ route('forms.messages', $form->id) }}">Mensajes enviados</a>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="px-6 py-4">
    {{ $forms->links() }}
</div>
