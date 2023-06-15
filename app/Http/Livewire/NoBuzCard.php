<?php

namespace App\Http\Livewire;

use Livewire\Component;

//Error Handling
class NoBuzCard extends Component
{ 
  public $title,$code,$desc; //came from resources/views/livewire/buz-profile.blade.php

  public function render()
  {
    return view('livewire.no-buz-card');
  }
}