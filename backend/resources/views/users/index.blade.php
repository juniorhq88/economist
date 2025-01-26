<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="container px-4 py-8 mx-auto">
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <div class="flex items-center justify-between px-6 py-4 border-b bg-gray-50">
                <h1 class="text-2xl font-bold text-gray-800">Usuarios</h1>
                <a href="{{ route('users.create') }}"
                    class="px-4 py-2 font-bold text-white bg-blue-800 rounded hover:bg-blue-600">
                    Crear Usuario
                </a>
            </div>

            @if (session('success'))
                <div class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded"
                    role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @include('users.partials.filter')

            <div class="p-4 overflow-x-auto shadow" id="results-table">
                @include('users.partials.table-results')
            </div>
        </div>
    </div>

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
        });
    </script>
</x-app-layout>
