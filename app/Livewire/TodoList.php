<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Todo;

class TodoList extends Component
{
    public $content = '';

    public function add()
    {
        $this->validate([
            'content' => 'required|min:3',
        ]);

        Todo::create([
            'content' => $this->content,
            'is_completed' => false,
        ]);

        $this->reset('content');
    }

    public function toggle($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $todo->is_completed = !$todo->is_completed;
            $todo->save();
        }
    }

    public function delete($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            $todo->delete();
        }
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->get(),
        ]);
    }
}
