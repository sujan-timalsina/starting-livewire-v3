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

    public function create()
    {
        // validate
        // create the todo
        // clear the input
        // send flash message

        $validated = $this->validateOnly('name'); // we have other properties like search which doesn't originates from create task form, so we only want to validate the name property

        Todo::create($validated);

        $this->reset('name');

        session()->flash('message', 'Task created successfully!');
    }
    
    public function render()
    {
        // $todos = Todo::where('name', 'like', '%'.$this->search.'%')->get();
        $todos = Todo::latest()->paginate(5);

        return view('livewire.todo-list',[
            'todos' => $todos,
        ]);
    }
}
