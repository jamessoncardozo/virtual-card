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
  use NotificaTrait;
  use MakeGravatarTrait;

  public $name, $github_url, $linkedin_url;

  public function createUser() {

    if($this->name) {

      $faker = Faker::create();

      $user = new User();

      $user->name = $this->name;

      $user->github_url = is_null($this->github_url) ? 'https://www.github.com/'.Str::slug($this->name,''): $this->github_url;
      $user->linkedin_url = is_null($this->linkedin_url) ? 'https://www.linkedin.com/in/'.Str::slug($this->name,''): $this->linkedin_url;
      $user->email = $faker->email();
      $user->email_verified_at = $faker->dateTime();
      $user->created_at= $faker->dateTime();
      $user->updated_at = $faker->dateTime();
      $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
      $user->remember_token = Str::random(10);
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
    return view('livewire.generate-buzcard')->layout('layouts.guest');
  }
}
