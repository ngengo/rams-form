<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $name = '';

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => 'required|min:3',
        ]);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3',
        ]);

        session()->flash('message', 'Welcome, ' . $this->name . '!');
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}