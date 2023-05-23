<?php

namespace App\Http\Livewire;

use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Models\User;

use Illuminate\Support\Facades\Request;

class BuzProfile extends Component
{

  public $params;

  public function mount(Request $url){
    
    $this->params = Request::route()->parameters['user_name'];
  }
    
  public function render()
  {
    $user = User::where('user_name',$this->params)->first();

    return view('livewire.buz-profile',['user'=>$user])->layout('layouts.guest');
  }
}
