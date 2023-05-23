<?php

namespace App\Http\Livewire;

use Livewire\Component;

class NoBuzCard extends Component
{ public $title,$code,$desc;

    public function render()
    {
        return view('livewire.no-buz-card');
    }
}