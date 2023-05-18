<?php

namespace App\Http\Livewire\Api;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Laravel\Jetstream\Features;
use Illuminate\Http\Request;
use Livewire\Component;

class ApiBuzCard extends Component
{

    public function getAllUsers() {
      $users = User::orderByDesc('id')->get()->toJson(JSON_PRETTY_PRINT);
      return response($users, 200);
    }

    public function createUser(Request $request) {
      
      $user = new User;
      $user->name = $request->name;
      $user->github_url = 'https://www.github.com/'.Str::slug($request->name,'');
      $user->linkedin_url = 'https://www.linkedin.com/in/'.Str::slug($request->name,'');
      $user->email = Str::slug($request->name,'').'@gmail.com';
      $user->email_verified_at = now();
      $user->created_at= now();
      $user->updated_at = now();
      $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'; // password
      $user->remember_token = Str::random(10);
      $user->profile_photo_path = null;
      $user->current_team_id = null;
      $user->user_name = Str::slug($request->name,'');
      $user->my_history = 'Timestamps allows you to automatically record the time of certain events against your entities. This can be used to provide similar behaviour to the timestamps feature in Laravels Eloquent ORM.';
      $user->save();
  
      return response()->json([
          "message" => "User record created"
      ], 201);
    }

    public function getUser($id) {
      if (User::where('id', $id)->exists()) {
        $user = User::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
        return response($user, 200);
      } else {
        return response()->json([
          "message" => "User not found"
        ], 404);
      }
    }

    public function updateUser(Request $request, $id) {
      if (User::where('id', $id)->exists()) {
        $user = User::find($id);
        $user->name = is_null($request->name) ? $user->name : $request->name;
        $user->github_url = is_null($request->name) ? $user->github_url : 'https://www.github.com/'.Str::slug($request->name,'');
        $user->linkedin_url = is_null($request->name) ? $user->linkedin_url : 'https://www.linkedin.com/in/'.Str::slug($request->name,'');
        $user->email = is_null($request->name) ? $user->email : Str::slug($request->name,'').'@gmail.com';
        $user->remember_token = Str::random(10);
        $user->user_name = is_null($request->name) ? $user->user_name : Str::slug($request->name,'');

        $user->save();

        return response()->json([
            "message" => "records updated successfully"
        ], 200);
        } else {
        return response()->json([
            "message" => "User not found"
        ], 404);
        
    }
  }

    public function deleteUser ($id) {
      if(User::where('id', $id)->exists()) {
        $user = User::find($id);
        $user->delete();

        return response()->json([
          "message" => "records deleted"
        ], 202);
      } else {
        return response()->json([
          "message" => "User not found"
        ], 404);
      }
    }

}
