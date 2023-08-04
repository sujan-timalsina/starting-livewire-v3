<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Rule;

class TodoList extends Component
{
    use WithPagination;
    
    #[Rule('required|min:3|max:50')]
    public $name;

    public $search = '';

    public $editingTodoId;

    public $editingTodoName;

    public function create()
    {
        // validate
        // create the todo
        // clear the input
        // send flash message

        $validated = $this->validateOnly('name'); // we have other properties like search which doesn't originates from create task form, so we only want to validate the name property

        Todo::create($validated);

        $this->reset('name');

        session()->flash('success', 'Task created successfully!');
    }

    public function delete(Todo $todo)
    {
        $todo->delete();

        session()->flash('success', 'Task deleted successfully!');
    }

    public function toggle(Todo $todo)
    {
        $todo->update([
            'completed' => !$todo->completed
        ]);

        session()->flash('success', $todo->name.' status updated successfully!');
    }

    public function edit($todoId)
    {
        $this->editingTodoId = $todoId;
        $this->editingTodoName = Todo::find($todoId)->name;
    }

    public function update()
    {
        $validated = $this->validate([
            'editingTodoName' => 'required|min:3|max:50'
        ]);
        
        Todo::find($this->editingTodoId)->update([
            'name' => $validated['editingTodoName'],
        ]);

        session()->flash('success', 'Task updated successfully!');

        $this->cancelEdit();
    }

    public function cancelEdit()
    {
        $this->editingTodoId = null;
        $this->editingTodoName = null;
    }
    
    public function render()
    {
        $todos = Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(5);

        return view('livewire.todo-list',[
            'todos' => $todos,
        ]);
    }
}
