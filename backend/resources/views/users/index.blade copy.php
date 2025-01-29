<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-ocampo dark:text-gray-200 leading-tight">
            {{ __('Lista de Empleados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                    <div
                        class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                        <div class="flex items-center flex-1 space-x-4">
                            <h5>
                                <span class="text-gray-500">Empleados:</span>
                                <span class="dark:text-white">{{ $employees->total() }}</span>
                            </h5>
                        </div>
                        <form action="{{ route('employee.index') }}" method="GET" class="mb-6" id="search-form">
                            <div class="flex">
                                <a href="{{ route('employee.index') }}" class="text-red-500 rounded-full p-2"> <i class="fas fa-times"></i></a>
                                <input type="text" name="search" id="find" placeholder="Buscar..." value="{{ $search }}"
                                       class="flex-grow px-4 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-800">
                                <button type="submit" class="bg-ocampo text-white px-4 py-2 rounded-r-md hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-800">
                                    <span id="button-text">Buscar</span>
                                        <span id="button-loader" class="hidden">
                                        </span>
                                </button>
                            </div>
                        </form>
                        <x-secondary-button onclick="window.history.back()">
                            {{ __('Regresar') }}
                        </x-secondary-button>
                        <div
                            class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                            <x-custom-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'csvImportModal')"
                        >{{ __('Importar CSV') }}</x-custom-button>
                            <a href="{{ route('employee.create') }}"
                                class="bg-ocampo text-white hover:bg-green-ocampo text-white-800 font-bold py-2 px-4 rounded inline-flex items-center">
                                <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                </svg>
                                <span>Nuevo Empleado</span>
                            </a>
                            
                        </div>
                    </div>
                    <div class="overflow-x-auto p-4 shadow" id="results-table">
                        @include('employee.partials.table-results')
                    </div>

                </div>
            </div>
        </div>
        @include('employee.partials.csv-import-form')
        <input type="hidden" name="url" id="url" value="{{ asset('/') }}">

        <script type="text/javascript">
            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('search-form');
                const resultsTable = document.getElementById('results-table');

                const buttonText = document.getElementById('button-text');
                const buttonLoader = document.getElementById('button-loader');
                const searchButton = document.getElementById('find');

                function showLoading() {

                    buttonText.classList.add('hidden');
                    buttonLoader.classList.remove('hidden');
                    buttonLoader.innerHTML = '<span class="loader"></span>';
                    searchButton.disabled = true;
                }

                function hideLoading() {
                    buttonText.classList.remove('hidden');
                    buttonLoader.classList.add('hidden');
                    buttonLoader.innerHTML = ''
                    searchButton.disabled = false;
                }

                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    const searchTerm = document.getElementById('find').value;

                    showLoading();

                    const urlApi = document.getElementById('url').value;

                    axios.get(urlApi + 'employee', {
                            params: {
                                search: searchTerm
                            }
                        })
                        .then(function(response) {
                            resultsTable.innerHTML = response.data;
                            $('#btn-search-reference').prop('disabled', false);
                            $('#btn-search-reference').text('Buscar');
                        })
                        .catch(function(error) {
                            console.error('Error:', error);
                        })
                        .finally(function() {
                            hideLoading();
                        });
                });

                /*$('#btn-clear-search').on('click', function() {
                    const resultsTable = document.getElementById('results-table');

                    $('#find').val('');
                    $('#find').focus();
                    resultsTable.innerHTML = '';
                })*/
            });
        </script>
</x-app-layout>
