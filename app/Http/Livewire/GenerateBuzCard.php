<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

use App\Traits\NotificaTrait;
use App\Traits\MakeGravatarTrait;
use Faker\Factory as Faker;
use Ottaviano\Faker\Gravatar;

use Illuminate\Support\Str;


class GenerateBuzCard extends Component
{
  use NotificaTrait; //call a toast notification trait
  use MakeGravatarTrait; // call a trait to generate an random avatar to the new user

  public $name, $github_url, $linkedin_url;

  public function createUser() {

    if($this->name) {

      $faker = Faker::create(); //generate a fake user

      $user = new User();

      $user->name = $this->name; // association of typed user to this new user
      
      //if the github or linkedin field don't is filled, these lines make a link based on the provided username.
      $user->github_url = is_null($this->github_url) ? 'https://www.github.com/'.Str::slug($this->name,''): $this->github_url;
      $user->linkedin_url = is_null($this->linkedin_url) ? 'https://www.linkedin.com/in/'.Str::slug($this->name,''): $this->linkedin_url;
      
      $user->email = $faker->email();
      $user->email_verified_at = $faker->dateTime();
      $user->created_at= $faker->dateTime();
      $user->updated_at = $faker->dateTime();
      $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
      $user->remember_token = Str::random(10);

      //It generates a profile picture based on the MakeGravatarTrait.
      //It is possible that, depending on your environment, it may not save the picture, but this is a configuration of the asset directory.
      $user->profile_photo_path = Gravatar::gravatar('img/avatars',$this->makeGravatar(),null,144); 
      $user->current_team_id = null;
      $user->user_name = Str::slug($this->name, '');
      $user->my_history = $faker->realText(500);

      $user->save();

      $this->notifica('User sucessfully created!','success');

      $this->reset();

      return redirect()->route('card-image', ['id' => $user->id ]);

    } else {

      $this->notifica('You need to fill the Name!','danger');
      
      $this->reset('name');

    }
  }

  public function render()
  {
    return view('livewire.generate-buzcard')->layout('layouts.guest'); // The layout is used to avoid depending on the Jetstream layout.
  }
}
