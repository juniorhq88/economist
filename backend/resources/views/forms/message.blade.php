<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Forms') }}
        </h2>
    </x-slot>

    <div class="container px-4 py-8 mx-auto">
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-between px-6 py-4 border-b bg-gray-50">
                <h1 class="text-2xl font-bold text-gray-800">Mensajes de {{ $messages->first()->user->name }}</h1>
                <a href="{{ route('forms.index') }}"
                    class="px-4 py-2 font-bold text-white bg-blue-800 rounded hover:bg-blue-600">
                    < Regresar </a>
            </div>

            @if (session('success'))
                <div class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-4 overflow-x-auto shadow" id="results-table">
                @include('forms.partials.table-message-results')
            </div>
        </div>
    </div>

    <input type="hidden" name="url" id="url" value="{{ asset('/') }}">

</x-app-layout>
