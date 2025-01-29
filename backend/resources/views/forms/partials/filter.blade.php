<div class="flex flex-wrap gap-4 mb-4">
    <!-- Filtro de fecha -->
    <div class="flex items-center gap-2">
        <input type="date" wire:model.live="dateFrom" class="form-input" placeholder="Fecha desde">
        <span>hasta</span>
        <input type="date" wire:model.live="dateTo" class="form-input" placeholder="Fecha hasta">
    </div>

    <!-- Filtro de usuario -->
    <select wire:model.live="selectedUser" class="form-select">
        <option value="">Todos los usuarios</option>
        @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>

    <!-- Filtro de archivos adjuntos -->
    <select wire:model.live="hasAttachment" class="form-select">
        <option value="">Todos los formularios</option>
        <option value="1">Con archivos adjuntos</option>
        <option value="0">Sin archivos adjuntos</option>
    </select>

    <button wire:click="resetFilters"
        class="px-4 py-2 font-bold text-white bg-blue-800 rounded hover:bg-blue-600">Limpiar Filtros</button>
</div>
