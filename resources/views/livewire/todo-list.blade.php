<div class="container mx-auto mt-8">
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <h1 class="text-2xl font-semibold mb-4">Livewire v3 Todo</h1>
    @if(session()->has('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-4 w-72">
            {{ session('success') }}
        </div>
    @endif
    <div class="inline-block bg-gray-100 p-4 shadow rounded p-8">
        <!-- Todo Form -->
        <form id="todoForm" class="mb-8" wire:submit="addTodo">
            <label class="block mb-2 text-gray-800 font-medium" for="todoInput">Todo:</label>
            <input wire:model="task" class=" px-4 py-2 block rounded border border-gray-200" type="text" id="todoInput" placeholder="Enter your todo here">
            @error('task') <span class="block text-red-400 text-sm">{{ $message }}</span> @enderror 
            <button class="mt-2 px-4 py-1 bg-gray-500 text-white rounded" type="submit">Add</button>
        </form>

        <h2 class="text-lg font-semibold mb-2">Todos</h2>
        <ul id="todos" class="list-inside">
            @forelse($todos as $todo)
                <li wire:key="{{ $todo->id }}" class="mb-2">
                    <input wire:click="toggleStatus({{ $todo->id }})" type="checkbox" {{ $todo->status == 'done' ? 'checked' : '' }} class="mr-2">
                    <span class="{{ $todo->status === 'done' ? 'line-through text-gray-500' : '' }}">{{ $todo->task }}</span>
                    <button wire:click="delete({{ $todo->id }})" class="ml-2 px-2 py-1 bg-red-500 text-white rounded-xl hover:bg-red-600 focus:outline-none focus:bg-red-600 text-xs">Delete</button>
                </li>
            @empty
                <li class="text-red-500">No todos yet.</li>
            @endforelse
        </ul>
    </div>
</div>
