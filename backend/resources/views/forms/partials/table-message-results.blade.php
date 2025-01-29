<table class="w-full">
    <thead>
        <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-100">
            <th class="px-6 py-3 text-center">Asunto</th>
            <th class="px-6 py-3 text-center">Mensaje</th>
            <th class="px-6 py-3 text-center"></th>
        </tr>
    </thead>
    <tbody class="text-sm text-gray-600">
        @foreach ($messages as $message)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="px-6 py-3 text-left whitespace-nowrap">
                    {{ $message->subject }}
                </td>
                <td class="px-6 py-3 text-left">
                    {{ $message->body }}
                </td>

                <td class="px-6 py-3 text-center">
                    <div class="flex justify-center item-center">

                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="px-6 py-4">
    {{ $messages->links() }}
</div>
