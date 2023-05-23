<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Traits\MakeQrCodeTrait;

//use SimpleSoftwareIO\QrCode\Facades\QrCode;



class CardImage extends Component
{
  use MakeQrCodeTrait;

  public $id_user, $name, $github_url, $linkedin_url, $user_name;

  public function mount($id){

    $user = User::find($id);

    $this->id_user = $id;
    
    $this->name=$user->name;
    $this->github_url=$user->github_url;
    $this->linkedin_url=$user->linkedin_url;
    $this->user_name=$user->user_name;

    $this->generateQrCode($this->user_name);

  }


  public function render(){ 
    
    $user = User::find($this->id_user);

    return view('livewire.card-image',['user' => $user])->layout('layouts.guest');

    }
}
