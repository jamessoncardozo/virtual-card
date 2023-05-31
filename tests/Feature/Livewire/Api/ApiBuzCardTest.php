<?php

namespace Tests\Feature\Livewire\Api;

use App\Http\Livewire\Api\ApiBuzCard;
use App\Models\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ApiBuzCardTest extends TestCase
{
    /*use RefreshDatabase;
    protected $seed = true;*/

    /** @test */

    //sudo php artisan test --filter ApiBuzCardTest::the_api_can_put_one_user

    public function the_api_can_del_one_user(){
  
    $this->json('get', '/api/users')
         ->assertStatus(200);
      /*$response = $this->json('DELETE', '/api/user', ['id' => 41]);
      $response
            ->assertStatus(202)
            ->assertJson([
              "message" => "records deleted",
            ]);

      Http::fake();

      $response = Http::withToken('afnhU05Lig99tQpr5lhBT5yQXyePc4tGsOMTPVSO')->delete('/api/user',['id'=>7]);

      $this->assertEquals(true,$response->successful());*/

    }

    //sudo php artisan test --filter ApiBuzCardTest::the_api_can_put_one_user

    public function the_api_can_put_one_user(){
  
      Http::fake();
      $user=User::factory()->create();
      dump($user->name);
      $response = Http::put('/api/user/41',['name' => $user->name,]);

      $this->assertEquals(true,$response->successful());

    }

    //sudo php artisan test --filter ApiBuzCardTest::the_api_can_post_one_user

    public function the_api_can_post_one_user(){
  
      Http::fake();
      $user=User::factory()->create();
      dump($user->name);
      $response = Http::post('/api/users',['name' => $user->name,]);

      $this->assertEquals(true,$response->successful());

    }
    //sudo php artisan test --filter ApiBuzCardTest::the_api_return_one_user

    public function the_api_return_one_user(){
      
      Http::fake();
      
      $response = Http::get('/api/user/15');

      $this->assertEquals(true,$response->successful());

    }

    //sudo php artisan test --filter ApiBuzCardTest::the_api_return_all_users

    public function the_api_return_all_users(){
      
      Http::fake();
      
      $response = Http::get(route('api.users'));

      $this->assertEquals(true,$response->successful());

    }


  
    public function the_component_can_render()
    {
        $component = Livewire::test(ApiBuzCard::class);

        $component->assertStatus(200);
        
    }
}

