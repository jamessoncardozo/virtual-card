<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;

use Livewire\Component;

class GenerateBuzCard extends Component
{

  public $showModal = false;

  public function render()
  {
      return view('livewire.generate-buzcard');
  }
}
