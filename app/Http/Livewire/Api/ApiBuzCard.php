<?php

namespace App\Http\Livewire\Api;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Livewire\Component;
use Faker\Factory as Faker;

use App\Traits\MakeGravatarTrait;
use Illuminate\Support\Facades\App;
use Ottaviano\Faker\Gravatar;

class ApiBuzCard extends Component
{
  use MakeGravatarTrait; //import a random avatar type from 6 diferent modes

  public function getAllUsers() {
    
    $users = User::all(); // retrieve all model data

    if($users->isNotEmpty()){

      $users->toJson(JSON_PRETTY_PRINT); //Convert the users collection into JSON format.

      return response($users, 200);

    }else{

      return response()->json(["message" => "Model Empty"], 404);
      
    }
  }

  public function createUser(Request $request) {

    $faker = Faker::create(); // the faker just use a name from request to generate

    $user = new User;

    $user->name = $request->name;
    $user->github_url = 'https://www.github.com/'.Str::slug($request->name,'');
    $user->linkedin_url = 'https://www.linkedin.com/in/'.Str::slug($request->name,'');
    $user->email = $faker->email();
    $user->email_verified_at = $faker->dateTime();
    $user->created_at= $faker->dateTime();
    $user->updated_at = $faker->dateTime();
    $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
    $user->remember_token = Str::random(10);

    //It is necessary to check which environment is being used (production, local, or testing)
    //in order to save the avatar in the right directory.

    if (App::environment('testing')) {

      $filepath='./public/img/avatars';

    } else {

      $filepath='img/avatars';
      
    }
    
    // As this line below, in order to save the avatar with the right fullname,
    // you gotta remove the './public/' part. It's only used to generate the avatar
    // sbecause, in testing mode, the image path needs to be like the $filepath variable above.

    $user->profile_photo_path = str_replace('./public/','',Gravatar::gravatar($filepath,$this->makeGravatar(),null,144));

    $user->current_team_id = null;
    $user->user_name = Str::slug($request->name,'');
    $user->my_history = $faker->realText(500);

    $user->save();

    return response()->json(["message" => "User record created"], 201);
  }

  public function getUser($id) {

    if (User::where('id', $id)->exists()) {

      $user = User::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);

      return response($user, 200);

    } else {

      return response()->json(["message" => "User not found"], 404); // Return a 404 status code for a non-existent user provided
    }
  }

  public function updateUser(Request $request, $id) {
    
    if (!is_null($request->name)) {// If no name is provided to update the current value, it keeps the previous value.
    
      if (User::where('id', $id)->exists()) {

        $user = User::find($id);

        // Update only the relevant fields of the users
        
        $user->name = $request->name;
        $user->github_url = 'https://www.github.com/'.Str::slug($request->name, '');
        $user->linkedin_url = 'https://www.linkedin.com/in/'.Str::slug($request->name, '');
        $user->email = Str::slug($request->name, '').'@gmail.com';
        $user->remember_token = Str::random(10);
        $user->user_name = Str::slug($request->name, '');

        $user->save();

        return response()->json(["message" => "records updated successfully"], 200);

      } else {
          
        return response()->json(["message" => "User not found"], 404);

      }

    } else {

      return response()->json(["message" => "No name provided"], 404);
        
    }
  }

  public function deleteUser ($id) {

    if(User::where('id', $id)->exists()) {

      User::find($id)->delete();

      return response()->json(["message" => "Record deleted"], 202);

    } else {

      return response()->json(["message" => "User not found"], 404);
    }
  }

}
