<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;
use Livewire\Attributes\Rule;

class TodoList extends Component
{
    #[Rule('required|min:3|max:100')]
    public $task;

    public $todos;
    
    function mount()
    {
        $this->fetchTodos();
    }

    function fetchTodos()
    {
        $this->todos = Todo::all()->reverse();
    }

    function addTodo()
    {
        // we can access the request() helper to validate or get the data from view
        // $validated = request()->validate([
        //     'task' => 'required|min:3|max:100'
        // ]);
        // Todo::create($validated);
        // Todo::create([
        //     'task' => $validated['task']
        // ]);

        // $todo = new Todo();
        // $todo->task = $this->task;
        // $todo->save();

        // to validate from #[Rule()] we need to use validate() method
        $validated = $this->validate();

        Todo::create([
            'task' => $validated['task']
        ]);

        $this->task = ''; // alternative $this->reset(['task','otherVariable']);

        $this->fetchTodos();
    }

    function toggleStatus(Todo $todo)
    {
        $todo->status = $todo->status === 'done' ? 'open' : 'done';
        $todo->save();

        $this->fetchTodos();
    }

    function delete(Todo $todo)
    {
        $todo->delete();

        $this->fetchTodos();
    }

    public function render()
    {
        return view('livewire.todo-list');
    }
}
