<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <form action="POST" wire:submit="addTodo">
        <input type="text" wire:model="task" wire:keydown.enter="addTodo">
        <button type="submit">Add</button>
    </form>
</div>
